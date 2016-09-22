<?php

namespace App\Http\Controllers;

use App\WShare;
use App\WUser;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class WUserController extends Controller
{
    private $request;


    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Add WUser
     *
     * @return mixed
     */
    public function add()
    {
        $share_id = $this->request->share_id;
        $openid = $this->request->openid;
        $name = $this->request->name;
        $phone = $this->request->phone;

        if(isset($share_id) && isset($openid) && isset($name) && isset($phone))
        {
            $wuser = WUser::where('openid', $openid)->first();

            if($wuser == null)
            {
                $wuser = new WUser;
                $wuser -> share_id = $share_id;
                $wuser -> openid = $openid;
                $wuser -> name = $name;
                $wuser -> phone = $phone;

                try
                {
                    $rs = $wuser->save();
                    if($rs)
                        return response()->json(['result' => 'success']);
                    else
                        return response()->json(['result' => 'fail']);
                }catch(\Exception $e)
                {
                    return response()->json(['result' => $e->getMessage()]);
                }
            }else
                return response()->json(['result' => 'openid already exists']);
        }

        return response()->json(['result' => 'param error']);
    }

    /**
     * Get WUser by share_id
     *
     * @param $share_id
     * @return mixed
     */
    public function getByShareId($share_id)
    {
        if(isset($share_id))
        {
            $wuser = WUser::where('share_id', $share_id)->get();
            return response()->json($wuser);
        }

        return response()->json(['result' => 'param error']);
    }

    /**
     * Get WUser by openid
     *
     * @param $share_id
     * @return mixed
     */
    public function getByOpenId($openid)
    {
        if(isset($openid))
        {
            $wuser = WUser::where('openid', $openid)->get();
            return response()->json($wuser);
        }

        return response()->json(['result' => 'param error']);
    }


    /**
     * Update WUser of card_list by share_id
     *
     * @return mixed
     */
    public function updateByShareId()
    {
        $share_id = $this->request->share_id;
        $card_list = $this->request->card_list;
        $openid = $this->request->openid;

        if(isset($share_id) && isset($card_list) && isset($openid))
        {
            $wuser = WUser::where('share_id', $share_id)->first();

            if($wuser != null)
            {
                if($wuser -> card_list != $card_list)
                {
                    // Ready to update card_list field
                    $wuser -> card_list = $card_list;

                    // Ready to save WShare
                    $wshare = new WShare();
                    $wshare -> id = $share_id.$openid;
                    $wshare -> share_id = $share_id;
                    $wshare -> openid = $openid;

                    try
                    {
                        DB::transaction(function () use($wshare, $wuser) {
                            $wshare->save();

                            $wuser->save();
                        });

                        return response()->json(['result' => 'success']);

                    }catch(\Exception $e)
                    {
                        return response()->json(['result' => $e->getMessage()]);
                    }

                }else
                    return response()->json(['result' => 'same card_list']);
            }else
                return response()->json(['result' => 'not found share_id']);

        }

        return response()->json(['result' => 'param error']);
    }

    /**
     * Delete WUser with WShare
     *
     * @param $openid
     * @return mixed
     */
    public function reset($openid)
    {
        if(isset($openid))
        {
            $wuser = WUser::where('openid', $openid)->first();
            if($wuser != null)
            {

                $wshares = WShare::where('share_id', $wuser->share_id)->get();

                try
                {
                    DB::transaction(function () use($wshares, $wuser) {
                        foreach ($wshares as $wshare)
                        {
                            $wshare->forceDelete();
                        }

                        $wuser->forceDelete();
                    });

                    return response()->json(['result' => 'success']);

                }catch(\Exception $e)
                {
                    return response()->json(['result' => $e->getMessage()]);
                }

            }else
                return response()->json(['result' => 'not found openid']);

        }

        return response()->json(['result' => 'param error']);
    }

    /**
     * Update WUser Openid field By phone
     *
     * @return mixed
     */
    public function updateOpenidByPhone()
    {
        $phone = $this->request->phone;
        $openid = $this->request->openid;

        if(isset($phone) && isset($openid))
        {
            $wuser = WUser::where('phone', $phone)->first();
            if($wuser != null)
            {
                if($wuser->openid != $openid)
                {
                    $wuser->openid = $openid;
                    $wuser->save();

                    return response()->json(['result' => 'success']);
                }else
                    return response()->json(['result' => 'same openid']);

            }else
                return response()->json(['result' => 'not found phone']);
        }

        return response()->json(['result' => 'param error']);
    }

    /**
     * Get WUser by phone
     *
     * @param $phone
     * @return mixed
     */
    public function getByPhone($phone)
    {
        if(isset($phone))
        {
            $wuser = WUser::where('phone', $phone)->get();
            return response()->json($wuser);
        }

        return response()->json(['result' => 'param error']);
    }

}

<?php

namespace App\Http\Controllers;

use App\Track;
use Illuminate\Http\Request;

use App\Http\Requests;

class TrackController extends Controller
{
    private $request;


    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Add PV by out_trade
     *
     * @return mixed
     */
    public function pv()
    {
        $out_trade = $this->request->out_trade;

        if(isset($out_trade))
        {
            $track = new Track;
            $track -> out_trade = $out_trade;
            $track -> ip = $this->request->getClientIp();
            $track -> platform = $this->getPlatForm();
            $track -> type = "pv";

            $rs = $track -> save();
            if($rs)
                return response()->json(['result' => 'success']);
            else
                return response()->json(['result' => 'fail']);
        }

        return response()->json(['result' => 'param error']);
    }

    /**
     * Add Click by out_trade
     *
     * @return mixed
     */
    public function click()
    {
        $out_trade = $this->request->out_trade;
        $type = $this->request->type;

        if(isset($out_trade) && isset($type))
        {
            $track = new Track;
            $track -> out_trade = $this->request->out_trade;
            $track -> ip = $this->request->getClientIp();
            $track -> platform = $this->getPlatForm();
            $track -> type = $type;

            $rs = $track -> save();
            if($rs)
                return response()->json(['result' => 'success']);
            else
                return response()->json(['result' => 'fail']);
        }

        return response()->json(['result' => 'param error']);
    }

    /**
     * Add Share by out_trade
     *
     * @return mixed
     */
    public function share()
    {
        $out_trade = $this->request->out_trade;
        $type = $this->request->type;

        if(isset($out_trade) && isset($type))
        {
            $track = new Track;
            $track -> out_trade = $out_trade;
            $track -> ip = $this->request->getClientIp();
            $track -> platform = $this->getPlatForm();
            $track -> type = $type;

            $rs = $track -> save();
            if($rs)
                return response()->json(['result' => 'success']);
            else
                return response()->json(['result' => 'fail']);
        }

        return response()->json(['result' => 'param error']);
    }


    private function getPlatForm()
    {
        $userAgent = strtolower($this->request->server('HTTP_USER_AGENT'));

        if(strpos($userAgent, 'windows nt')) {
            $platform = 'windows';
        } elseif(strpos($userAgent, 'macintosh')) {
            $platform = 'mac';
        } elseif(strpos($userAgent, 'ipod')) {
            $platform = 'ipod';
        } elseif(strpos($userAgent, 'ipad')) {
            $platform = 'ipad';
        } elseif(strpos($userAgent, 'iphone')) {
            $platform = 'iphone';
        } elseif (strpos($userAgent, 'android')) {
            $platform = 'android';
        } elseif(strpos($userAgent, 'unix')) {
            $platform = 'unix';
        } elseif(strpos($userAgent, 'linux')) {
            $platform = 'linux';
        } else {
            $platform = 'other';
        }

        return $platform;
    }


    
}

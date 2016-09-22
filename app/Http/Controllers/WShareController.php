<?php

namespace App\Http\Controllers;

use App\WShare;
use Illuminate\Http\Request;

use App\Http\Requests;

class WShareController extends Controller
{
    private $request;


    public function __construct(Request $request) {
        $this->request = $request;
    }
    
}

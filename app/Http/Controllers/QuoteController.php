<?php

namespace App\Http\Controllers;
// use DB;
class QuoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $aData = \App\Quote::select('name', 'quote')->get()->toArray();
        return $aData;
    }

    //
}

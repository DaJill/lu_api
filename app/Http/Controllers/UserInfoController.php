<?php
namespace App\Http\Controllers;
use \App\DbModel\UserInfo;

// use DB;
class UserInfoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        return UserInfo::select('Nickname', 'UserName', 'Password')->get()->toArray();
    }

    public function getUser($_iUserID){
        return $_iUserID;
    }

    public function delUser($_iUserID){
        return UserInfo::where('UserID', $_iUserID)->delete();
    }

    public function addUser(Request $req, $_iUserID){
        return UserInfo::where('UserID', $_iUserID)->delete();
    }
}

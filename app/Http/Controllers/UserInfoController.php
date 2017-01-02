<?php
namespace App\Http\Controllers;
use \App\DbModel\UserInfo;
use Illuminate\Http\Request;

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
        return UserInfo::select('UserID', 'Nickname', 'UserName', 'Password')->orderBy('UserID', 'DESC')->get()->toArray();
    }

    public function getUser($_iUserID){
        return $_iUserID;
    }

    public function delUser($_iUserID){
        $aReturn = array(
            'event' => false
        );
        $iQuery = UserInfo::where('UserID', $_iUserID)->delete();
        if($iQuery == 1){
            $aReturn['event'] = true;
        }
        return json_encode($aReturn);
    }

    public function addUser(Request $req){
        $aReturn = array(
            'event' => false
        );
        $sUserName = $req->input('UserName');
        $sPassword = $req->input('Password');
        $sNickname = $req->input('Nickname');

        $aUser = array($sUserName, $sPassword, $sNickname);
        if(in_array('', $aUser)){
            return json_encode($aReturn);
        }
        
        $iLastID = UserInfo::insertGetId(
            [
                'UserName' => $sUserName,
                'Password' => $sPassword,
                'Nickname' => $sNickname
            ]
        );
        $aReturn['event'] = true;
        $aReturn['UserID'] = $iLastID;
        return json_encode($aReturn);
    }
}

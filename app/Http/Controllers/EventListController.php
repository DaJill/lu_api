<?php
namespace App\Http\Controllers;
// use \App\DbModel\UserInfo;
use Illuminate\Http\Request;

// use DB;
class EventListController extends Controller
{
    // Status : 0活動尚未開始, 1活動中, 2活動結束
    // EMS : 0活動正常運行, 1活動緊急停止
    private $aEventList = array(
        1=> array(
            'EventID' => 1,
            'EventName' => '新年好運到',
            'EventStartDate' => '2016-01-01', //發放開始日
            'EventEndDate' => '2016-01-31', //發放結束日
            'PayStartDate' => '2016-02-31', //兌獎開始日
            'PayEndDate' => '2016-03-31', //兌獎開始日
            'Status' => 0,
            'EMS' => 0
        ),
        2=> array(
            'EventID' => 2,
            'EventName' => '中秋好禮來相送，紅包好禮等你抽',
            'EventStartDate' => '2016-09-01',
            'EventEndDate' => '2016-09-30',
            'PayStartDate' => '2016-10-01',
            'PayEndDate' => '2016-10-31',
            'Status'=> 1,
            'EMS' => 0
        ),
        3=> array(
            'EventID' => 3,
            'EventName' => '「體」面紅包，包包驚喜',
            'EventStartDate' => '2016-09-30',
            'EventEndDate' => '2016-09-30',
            'PayStartDate' => '2016-10-01',
            'PayEndDate' => '2016-10-31',
            'Status'=> 1,
            'EMS' => 1
        ),
        4=> array(
            'EventID' => 4,
            'EventName' => '悠亞抱抱，包包抱抱',
            'EventStartDate' => '2016-09-30',
            'EventEndDate' => '2016-09-30',
            'PayStartDate' => '2016-10-01',
            'PayEndDate' => '2016-10-31',
            'Status'=> 2,
            'EMS' => 0
        )
    );

    private $aStatusList = array(0, 1, 2, -1);

    //取得活動List By 活動狀態 ($_iStatus : 0活動尚未開始, 1活動中, 2活動結束, -1 全部)
    public function getListByStatus($_iStatus)
    {
        $aResult = array(
            'event'=>false,
            'data'=>array()
        );
        if(!in_array($_iStatus, $this->aStatusList)){
            return $aResult;
        }

        $aResult['event'] =  true;
        if($_iStatus == -1){
            $aResult['data'] =  $this->aEventList;
            return $aResult;
        }

        $aEventList = array();
        foreach ($this->aEventList as $iEventID => $aRowEvent) {
            if($_iStatus != $aRowEvent['Status']){
                continue;
            }
            $aEventList[$iEventID] = $aRowEvent;
        }
        
        $aResult['data'] =  $aEventList;
        return $aResult;
    }

    //取得活動List By 日期 : Y-m-d
    public function getListByDate($_dStart, $_dEnd)
    {
        $aResult = array(
            'event'=>false,
            'data'=>array()
        );
        if( !$this->checkDate($_dStart) || !$this->checkDate($_dStart) ){
            return $aResult;
        }

        $iSearchStart = strtotime($_dStart);
        $iSearchEnd = strtotime($_dEnd);

        $aEventList = array();
        foreach ($this->aEventList as $iEventID => $aRowEvent) {
            $iEventStart = strtotime($aRowEvent['EventStartDate']); // 發放開始日
            $iEventEnd = strtotime($aRowEvent['PayEndDate']); // 兌獎結束日
            if(($iSearchStart < $iEventEnd) && ($iSearchEnd < $iEventStart)){
                $aEventList[$iEventID] = $aRowEvent;                
            }
        }
        $aResult['event'] =  true;
        $aResult['data'] =  $aEventList;
        return $aResult;
    }

    private function checkDate($_dDate, $_sFormat = 'Y-m-d'){
        $oDate = DateTime::createFromFormat($_sFormat, $_dDate);
        return $oDate && $oDate->format($_sFormat) == $_dDate;
    }
}

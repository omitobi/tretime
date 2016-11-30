<?php
/**
 * Created by PhpStorm.
 * User: omitobisam
 * Date: 30.11.16
 * Time: 19:10
 */

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

$get = isValidRequest($_GET);
if(in_array('false', $get)){ echo json_encode($get); exit;}

$result =getTimeDiff($get['start'], $get['end']);
echo json_encode($result);
exit;

function getTimeDiff($strt, $en){
    $start_date = new DateTime('2007-09-01'.$strt.':00');
    $since_start = $start_date->diff(new DateTime('2007-09-01 '.$en.':00'));
    
    $hourMsg = responseMsg($since_start->h,'%s');
    $minuteMsg = responseMsg($since_start->i,'%s');
    
    return array(
        "hour" => $hourMsg,
        "minute" => $minuteMsg
    );
}



function isValidRequest($data){
    $res = array();

    if(!in_array('start', array_keys($data)) || !in_array('end', array_keys($data)) ){
        array_push($res, responseMsg('', "start or%s end parameters missing"));
    }
    if($res) { $res[] = 'false'; return $res;}
    $start = isset($_GET['start']) ? isValidTime($_GET['start']) : false;
    $end = isset($_GET['end']) ? isValidTime($_GET['end']) : false;

    if(!$start){
        array_push($res,responseMsg($data['start']));
    }
    if(!$end){
        array_push($res,responseMsg($data['end']));
    }

    if($res){
        $res[] = 'false';
        return $res;
    }
    return $data;
}

function isValidTime($time){
    if(!preg_match("/(2[0-4]|[01][1-9]|10):([0-5][0-9])/", $time)) return false;
    return $time;
}

function responseMsg($arg, $message = false){
    $msg = "";
    if(!$message) {
        $message = "The argument %s's value is invalid";
        return sprintf($message, $arg);
    }
    return sprintf($message, $arg);
}
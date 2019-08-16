<?php
function validiator($data)
{
    if(strlen($data)==0 || empty($data) || $data=null || $data=="" || trim($data)=="User type"){
        return false;
    }else{
        return true;
    }
}

function output($Stat,$msg)
{
    $msgStat=array(
        "status"=>$Stat,
        "message"=>$msg
    );
    echo json_encode($msgStat);
}
function dataOutput($Stat,$msg,$data)
{
    $msgStat=array(
        "status"=>$Stat,
        "message"=>$msg,
        "data"=>$data
    );
    echo json_encode($msgStat);
}
function create($data){
    ksort($data);
}
function date_and_time(){
   return date("m-d-Y H:i:s");
}
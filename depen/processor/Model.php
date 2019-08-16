<?php
// require "https://yourthoughts.com.ng/eh/forestry/processor/config.php";
// require "./eh/forestry/processor/config.php";
// require "config.php";
// require "funcs.php";
/**
 * 
 */
/**
 * 
 */
$dbh=new PDO("mysql:host=".HOST.";dbname=".DB,UNAME,PASS);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
class Model 
{
  
  function insert($data,$tbl){
    global $dbh;
    ksort($data);
    $keys=array_keys($data);
    $bd="`".implode("`,`",$keys)."`";
    $vals="'".implode("','",$data)."'";
    $stmt=$dbh->prepare("INSERT INTO `$tbl` (".$bd.") VALUES (".$vals.")");
    $stmt->execute();
    $resId= $dbh->lastInsertId();
    // print_r($resId);
    return $resId;
}

function update($data,$where,$table)
{
    global $dbh;
    global $updateVals;
    ksort($data);
    // print_r($data);
    $keys=array_keys($data);
    $bd="`".implode("`=.`",$keys)."`=";
    $pki=":".implode(",:",$keys);
    $pkey=explode(",",$pki);
    // Makers
    $vals=implode(",",$data);
    $valsArr=explode(",",$vals);
    $keyArr=explode(".",$bd);
    foreach ($keyArr as $key => $value) {
        // $updateVals= $value.$pkey[$key].",";
        // echo $updateVals;
        $updateVals.= $value."'".$valsArr[$key]."',";
        
    }
   $updateVals= rtrim($updateVals,",");
//    track_id
    $sql="UPDATE `$table` SET $updateVals WHERE `user_track_id` = '$where'";
    
    $stmt=$dbh->prepare($sql);
    if($stmt->execute()){
        // echo "Updated";
        return true;
    }else{
        return false;
    }

    // $resId= $dbh->lastInsertId();
    // print_r($resId);
    // return $resId;
   
        // print_r($bd);
        // print_r($vals);
        // print_r($keyArr);
        // print_r($valsArr);
    // print_r($data);


    
}
// ###############update Appointments################################################
function updateByKey($data,$where,$key,$table)
{
    global $dbh;
    global $updateVals;
    ksort($data);
    
    $keys=array_keys($data);
    $bd="`".implode("`=.`",$keys)."`=";
    $pki=":".implode(",:",$keys);
    $pkey=explode(",",$pki);
    // Makers
    $vals=implode(",",$data);
    $valsArr=explode(",",$vals);
    $keyArr=explode(".",$bd);
    foreach ($keyArr as $key => $value) {
        // $updateVals= $value.$pkey[$key].",";
        // echo $updateVals;
        $updateVals.= $value."'".$valsArr[$key]."',";
        
    }
   $updateVals= rtrim($updateVals,",");
//    track_id
    $sql="UPDATE `$table` SET $updateVals WHERE `id` = '$where'";
     
    $stmt=$dbh->prepare($sql);
    if($stmt->execute()){
        // echo "Updated";
        return true;
    }else{
        return false;
    }

    
}
function searchSelect($key,$value,$table)
{
    global $dbh;
    $key=strtolower($key);
    $sql="SELECT * FROM `$table` WHERE `$key`='$value'";
    $stmt=$dbh->prepare($sql);
    if($stmt->execute()){
        $count=$stmt->rowCount();
        if($count>0){
            $rs=$stmt->fetchAll();
            return $rs;    
        }else{
            return false;
        }
        
    }else{
        return false;
    }
}



function delete($tbl,$key,$val)
{
    global $dbh;

    $sql="DELETE FROM `$tbl` WHERE `$key` = '$val'";
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();
    if(isset($count) && !empty($count)){
        return true;
    }else{
        return false;
    }
}

function select($sql,$dbh=null)
{
    global $dbh;
    $stmt=$dbh->prepare("SELECT * FROM `$sql` ORDER BY 'login_username' ASC");
    $stmt->execute();
    $rs=$stmt->fetchAll();
    return $rs;
}

function selectList($table,$fields,$needle){
    global $dbh;
    $vals= "`".implode("`, `",$fields)."`";
    // echo $vals;
    // die();
    $stmt=$dbh->prepare("SELECT $vals FROM $table WHERE `role`= '$needle'");
   
    $stmt->execute();
    
    $rs=$stmt->fetchAll();
  
    return $rs;
}

function login($username=null,$password=null,$dbh=null)
{
    global $dbh;
    $sql="SELECT `id`, `login_username`, `password` FROM `login` WHERE `login_username` = '$username' AND `password` = '$password' LIMIT 1";
    // var_dump($dbh);
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    $count=$stmt->rowCount();
    if($count>0){
        $rs=$stmt->fetchAll();
        return $rs;
    }else{
        return false;
    }
}


}

?>
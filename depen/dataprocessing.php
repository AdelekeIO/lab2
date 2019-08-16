<?php
// echo("Login here");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dataprocessing
 *   all processes is done 
 * @author adeleke
 */
class dataprocessing {
    // $con = new Model();
// $model->$dbh)
 function __construct()
    {
     $db=new Model();
    }

    function myid() {
        session::init();
        $state = $_SESSION["MapProjectAccessGranted"];
        $id = session::get("id");
//        $type = session::get("type");
//        echo $state;
        return $id;
//        here will check if am  a login user or not 
    }

    function logout() {
        session::init();
        session::destroy();
//        header("Location: " . URL);
        echo 'logged out';
    }

    //put your code here
    function register() {
        session::init();
        // print_r($_REQUEST);
        // return;
        
 
        $reg_username=validiator($_REQUEST['reg_username'])?$_REQUEST['reg_username']:die(output(false,"Kindly Supply the username"));
        $reg_password=validiator($_REQUEST['reg_password'])?$_REQUEST['reg_password']:die(output(false,"Kindly Supply the last password"));

            
        // ------------------------------------
        $data=array(
        "login_username"=>$reg_username,
        "password"=>hash("sha512",$reg_password),
        "status"=>0
);

        $db=new Model();
        // $res=$db->register($username,$password);
        $res = $db->searchSelect("login_username",$reg_username,"login");
        
        if (!empty($res) || isset($res[0]['email'])) {
            # code...
            output(false,"The email '$reg_username' has already been used on this platform, Kindly Supply another username.");
                die();
        }
        $res=$db->insert($data,"login");
        
        if (!empty($res)) {
            dataOutput(true,"Registration Is Successful",$res);
        }else{
            dataOutput(false,"Registration Not Successful",$res);
        }        
    }

       function login() {
        // print_r($_REQUEST);
        // die();
        $username = $_POST['login_username'];
        $password = $_POST['login_password'];
        $username=validiator($_REQUEST['login_username'])?$_REQUEST['login_username']:die(output(false,"Kindly supply the login username"));
        $user_name=validiator($_REQUEST['login_password'])?$_REQUEST['login_password']:die(output(false,"Kindly supply the login password"));
       
        $db=new Model();
       $password = hash("sha512",$password);
        $res=$db->login($username,$password);
        // print_r($res);
        // die();

        if(isset($res) && !empty($res) && $res!=false){
            Session::init();
            $_SESSION["lab2AccessGranted"] = TRUE;
            $_SESSION["id"] = $res[0]['id'];
            $_SESSION["login_username"] = $res[0]['login_username'];
            // print_r($_SESSION);
            // die();
            // output(true,"Login Successfull");
            dataOutput(true,"Login Successfull",$_SESSION['login_username']);

        }else{
            output(false,"Invaled Username Or Password.");
        }
//      
}

 
    function all_users()
    {
        $db=new Model();
        $res = $db->select("login");
        return $res;
    }
}




//https://support.ladesk.com/061754-How-to-make-REST-calls-in-PHP
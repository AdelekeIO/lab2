<?php 
// echo md5("Administrator<br>");//user1
// echo hash("sha512",$password);
require_once "depen/etc/header.php";
?>
    <div class="p-3" style="width: 340px;margin: 50px auto; border: black solid 2pt;padding: 20pt; ">
            
            <form action="" method="post" id="register">
                <div>
                    <h2 class="text-center">Register</h2>    
                    <div class="alert alert reg_messages"></div>   
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" id="reg_username" name="reg_username"  required="required">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" id="reg_password" name="reg_password" required="required">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Comfirm password" id="reg_cPassword" name="reg_cPassword" required="required">
                    </div>
                    <div class="form-group">
                        <button type="submit" id="reg_submit" name="reg_submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <div class="clearfix text-center">
                    <p>
                            I already have an account.<br/>
                            <button id="switchToLogin"><p> Login </p></button>

                        <!-- <button id="switchToReg"><p href="#"> Create an accout </p></button> -->
                    </p>   
                    </div>
                </div>
            </form>

            <form action="" method="post" id="login">
                <h2 class="text-center">Log in</h2>     
                <div class="alert alert login_messages"></div>  
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" id="login_username" name="login_username" required="required">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" id="login_password" name="login_password" required="required">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" id="login_submit" name="login_submit">Log in</button>
                </div>
                <div class="clearfix text-left">
                    <!-- <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label> -->
                    <!-- <a href="#" class="">Forgot Password?</a> -->
                </div>        
            
                <div class="text-center">
                <p>
                    <!-- <button id="switchToLogin"><p href="#"> Login </p></button> -->
                    I don't have an account. 
                    <button id="switchToReg"><p> Create an accout </p></button>

                </p>
                </div>
            </form>
            
    </div>
    

    <script src="libs/js/jquery-1.11.1.min.js"></script>
    <script src="libs/js/bootstrap.js"></script>
    
    <script >
        $(document).ready(function(){
            $("#login").show();
            $("#register").hide();

            $("#switchToReg").click(function(e){
                e.preventDefault();
                $("#login").hide();
                $("#register").show();

            });
            
            $("#switchToLogin").click(function(){
                // alert();
                $("#login").show();
                $("#register").hide();

            });
            
            // Process Registration and login
            $("#login_submit").click(function(e){
                $("#login_submit").attr("disabled",true);
                e.preventDefault();
                let login_username = $("#login_username").val();
                let login_password = $("#login_password").val();
                if (login_username==="" || login_password==="" || login_password===undefined || login_username===undefined) {
                    // alert("Username or password is not enterd.");
                    $("#login_submit").attr("disabled",false);

                    $(".login_messages").addClass("alert-danger").html("Username or password is not enterd.");
                    $("#login_username").focus();
                    return;
                }
                let lgDetails={
                    login_username:login_username,
                    login_password:login_password,
                    login_key: 1 
                }

                let url = 'http://localhost/lab2/depen/reqHandler.php';
               let promise = costomPost(url,lgDetails);
               promise.done(function (res) {
                let admin = "Administrator";
                var json = JSON.parse(res);
                if (json.status === true) {
                    if (json.data!==admin) {
                        window.location.replace('http://localhost/lab2/lab2.php');    
                    }else{
                        window.location.replace('http://localhost/lab2/admin/');
                    }
                    
                } else if (json.status === false) {
                    $("#login_submit").attr("disabled",false);
                    $(".login_messages").addClass("alert-danger").html(json.message);
                }
            }).fail(function (err) {
                $("#login_submit").attr("disabled",false);
               console.log(err);
            });
              
            });

            // Registratin Phase

            $("#reg_submit").click(function(e){
                // alert(111);
                e.preventDefault();
                let reg_username = $("#reg_username").val();
                let reg_password = $("#reg_password").val();
                let reg_cpassword = $("#reg_cPassword").val();
                if (reg_username==="" || reg_password==="" || reg_password===undefined || reg_username===undefined || reg_cpassword===undefined || reg_cpassword==="") {
                    // alert("Username or password is not enterd.");
                    $(".reg_messages").addClass("alert-danger").html("Username, Password or Comfirm password is not enterd.");
                    $("#reg_username").focus();
                    return;
                }
                if(reg_password!==reg_cpassword){
                    $(".reg_messages").addClass("alert-danger").html("Password & Comfirm password does not match.");
                    $("#reg_password").focus();
                    return;
                }
                let lgDetails={
                    reg_username:reg_username,
                    reg_password:reg_password,
                    reg_key: 1 
                }

               let url = 'http://localhost/lab2/depen/reqHandler.php';
               let promise = costomPost(url,lgDetails);
               promise.done(function (res) {
                let admin = "Administrator";
                var json = JSON.parse(res);
                if (json.status === true) {
                    $(".reg_messages").addClass("alert-success").html(json.message).removeClass("alert-danger");                    
                } else if (json.status === false) {
                    $(".reg_messages").addClass("alert-danger").html(json.message).removeClass("alert-success");
                }
            }).fail(function (err) {
               console.log(err);
            });
            });







            function costomPost(endpoint, fd) {
                return $.ajax({
                    url: endpoint,
                    data: fd,
                    type: 'post'
                });
            }
        });
        
    </script>
</body>
</html>
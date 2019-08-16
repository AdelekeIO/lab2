<?php session_start(); 
    if (!isset($_SESSION['id'])) {
        header("Location: http://localhost/lab2/");
    }
    // echo hash("sha512","user1");
?>

<?php 
require_once "depen/etc/header.php";
require_once "./depen/processor/config.php";
?>
    
    <div class="container" style="border: solid burlywood 1pt; padding: 100pt; padding-top: 0pt;">
        <div style="border-bottom: solid burlywood 1pt">
            <h1>Welcome to lab 2</h1>
        </div>
        <div style="text-align: right; font-size: 14pt">
            <a href="http://localhost/lab2/logout.php">Logout</a>
        </div>
        <div style="display:flex; flex-direction: row; ">
        
            
            <div style="flex: 2; height: auto;border: solid burlywood 1pt;margin-top: 5pt;border-radius: 50pt;border-top: 0pt;">
                <img src="<?php echo URL?>libs/img/off_bulb.jpg" alt="Light on" id="bulb_off" class="show" style="height: 350pt;" >
                <img src="<?php echo URL?>libs/img/on_bulb.jpeg" alt="Light off" id="bulb_on" class="hide" style="height: 350pt;" >
            </div>
            <div style="flex: 2; margin-top: 150pt;">
                <div style="padding: 20pt; padding-left: 5;margin-top: 20pt;float: left;">
                    <button class="btn btn-lg btn-success show" style=" font-size: 24pt" id="on_light" >Turn On</button>
                    <button class="btn btn-lg btn-danger hide" style=" font-size: 24pt" id="off_light" >Turn Off</button>
                </div>
            </div>
       
        </div>
        
    </div>
    <script src="libs/js/jquery-1.11.1.min.js"></script>
    <script src="libs/js/bootstrap.js"></script>
    <script>
        $(document).ready(function(){
            // $("#bulb_on").hide();
            // $("#off_light").hide();

            // $("#bulb_off").show();
            // $("#on_light").show();
            
            
            $("#on_light").click(function(){
                lightFade(4);
                $("#bulb_on").addClass("show").removeClass("hide");
                $("#bulb_off").addClass("hide").removeClass("show");
                
                $("#on_light").addClass('hide').removeClass('show');
                $("#off_light").addClass('show').removeClass('hide');

            });
            $("#off_light").click(function(){
                
                $("#bulb_on").addClass("hide").removeClass("show");
                $("#bulb_off").addClass("show").removeClass("hide");
                
                $("#on_light").addClass('show').removeClass('hide');
                $("#off_light").addClass('hide').removeClass('show');

            });

            // Light Emitting Coding
            function lightFade(lightId) {
                let lightOn = true;
                let bri = 255;
                let authCode = 'IH7ZmizjifMbsjzOAyrs6sO24zAsMY--IiF59vH';

                var urlStr = "http://130.166.45.108/api/";
                urlStr+=authCode;
                urlStr+="/lights"+lightId+"/state";

                // sendAjax(urlStr, "PUT", JSON.stringify({"bri":bri, "on": lightOn}));
                var promise = costomPost(urlStr,JSON.stringify({"bri":bri, "on": lightOn}));
                // promise
                // .done(res=> {
                //     console.log(res);
                // })
                // .fail(err =>{
                //     console.log(err);
                    
                // });
                for (let i = 0; i < 12; i++) {
                   if (bri <= 0) {
                       lightOn = false;
                   } 
                var promise = costomPost(urlStr,JSON.stringify({"bri":bri, "on": lightOn}));

                //    sendAjax(urlStr,"PUT", JSON.stringify({"bri":bri, "on": lightOn}));
                   bri -= 25;
                //    Method sleepMs()
                sleepMs(200);
                }

            }

            function sleepMs(msec) {
                var stat = new Date().getTime();
                while ((new Date().getTime()) < (stat+msec));
            }

            function sendAjax(url, method, str) {
                var req = new XMLHttpRequest();
                req.open(method, url, true);
                req.setRequestHeader("Content-Type", "application/json");
                req.send(str);
            }

            function costomPost(endpoint, fd) {
                return $.ajax({
                    url: endpoint,
                    data: fd,
                    type: 'PUT'
                });
            }
        });
    </script>
</body>
</html>
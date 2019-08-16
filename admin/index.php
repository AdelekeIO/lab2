<?php session_start(); 
    if (!isset($_SESSION['id'])) {
        header("Location: http://localhost/lab2/");
    }
    require_once "labs/../../depen/Session.php";
    require "./../depen/processor/config.php";
    require "./../depen/processor/funcs.php";
    require './../depen/dataprocessing.php';
    require "./../depen/processor/Model.php";

    // require_once "labs/../../depen/reqHandler.php";
        $dp = new dataprocessing();
    $all_users = $dp->all_users();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost/lab2/libs/css/bootstrap.css">
    <title>Admin</title>
</head>
<body>
    <div class="container">
        <div>
        <h1>Welcome Admin</h1>
        <span class="pull-right p-5" style="font-size: 14pt;padding-right: 10pt">
            <a href="http://localhost/lab2/logout.php">Logout</a>
        </span>
        </div>
        <div>
            <table class="table">
                <thead class="bg-dark">
                    <th>#</th>
                    <th>Username</th>
                    <th>Password</th>
                </thead>
                <tbody>
                    <?php $id=0;
                        foreach ($all_users as $key => $value) {
                            # code...
                            echo ("<tr>
                                    <td>".++$id."</td>
                                    <td>".$value[1]."</td>
                                    <td>".$value[2]."</td>
                                  </tr>");
                        }
                    ?>
                    
                </tbody>
            </table>
        </div>  
    </div>
    
    <script>
    
    </script>
</body>
</html>
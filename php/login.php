<?php
        require_once 'user.dao.php';
        if(!empty($_POST)){
            define('APP','1');
            require_once 'checkFormLib.php';
            $fields=array("name","pass");
            foreach($fields as $v){
                if(isset($_POST[$v])){
                    $save_data[$v]=test_input($_POST[$v]);
                }else{
                    $save_data[$v]='';
                }
            }
            $result=findUserByName($save_data['name']);
            if(count($result)>0){
                foreach($result as $v){
                    $pass=$result['upass'];
                }
                if($save_data['pass']==$pass){
                    header("Location:userlist.php");
                }else{
                    echo '<script>alert("密码错误")</script>';
                }
            }else{
                echo '<script>alert("账户错误")</script>';
            }

        }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="">
    <h5 style="margin-left:100px">用户登录</h5>
    账户: <input type="text" name="name"><br>
    密码: <input type="password" name="pass"><br>
    <input type="submit" value="登录" style="margin-top:20px;margin-left:100px">
    </form>
</body>
</html>
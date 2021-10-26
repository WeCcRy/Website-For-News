<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(!empty($_POST)){
            $fields=array('username','userpwd','code');
            foreach($fields as $v){
                $save_data[$v]=isset($_POST[$v]) ? $_POST[$v] : '';
            }
            session_start();
            if(empty($_SESSION['verify_code'])){
                die('输入验证码时间过长。');
            }
            if (strtolower($code) === strtolower($_SESSION['verify_code'])){
                echo ("<script>alert('验证码正确')</script>"); 
            } else{
                echo ("<script>alert('验证码输入错误')</script>");
            }
            unset($_SESSION['verify_code']); //清除SESSION数据
            require_once 'user.dao.php';
            $result=findUserByName($save_data['username']);
            if($result){
                if($result['upass']==$save_data['userpwd']){
                    
                    $userinfo=array('username'=>$save_data['username'],'userID'=>$result['uid']);
                    $_SESSION['user']=$userinfo;
                    header("location:newslist.php?page=1");
                }else{
                    echo '密码输入错误';
                }
            }else{
                    echo '用户名输入错误';
                }

        }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
	
    <?php
		require_once 'user.dao.php';
        if(!empty($_POST)){
            define('APP','1');
            require_once 'checkFormLib.php';
            $fields=array("uname","pass","repass","email","gender");
        }
        foreach($fields as $v){
            if(isset($_POST[$v])){
                $save_data[$v]=test_input($_POST[$v]);
            }else{
                $save_data[$v]='';
            }
        }
        $error=array();
        $result=checkPassword($save_data['pass']);
        if($result!==true){
            $error['pword']=$result;
        }
        $result=checkConfirmPassword($save_data['repass'],$save_data['pass']);
        if($result!==true){
            $error['reword']=$result;
        }
        $result=checkEmail($save_data['email']);
        if($result!==true){
            $error['email']=$result;
        }
        if(!empty($error)){
            require_once 'error.php';
        }else{

		$result=addUser($save_data['uname'],$save_data['pass'],$save_data['email'],$save_data['gender'],1);

				header("location:newslist.php?page=1");
		
    }
    ?>
</body>
</html>
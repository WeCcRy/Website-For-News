<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title></title>
</head>
<body>
	
</body>
</html>


<?php
	date_default_timezone_set("PRC");
    define('APP','nws');
	require_once 'checkFormLib.php';
	require_once 'news.dao.php';
	require_once 'newsclass.dao.php';
    if(!empty($_POST)){
        $fields=array('title','uid','classid','content','stop');
        foreach($fields as $v){
            $save_data[$v]=isset($_POST[$v])  ?test_input($_POST[$v]):'';
        }
        $error = array();
        $result=checkNewsTitle($save_data['title']);
		if(!empty($_FILES)){
		    $myfile=$_FILES['image'];
		    $errorNum=$myfile['error'];
		    $filename=$myfile['name'];
		    $size=$myfile['size'];
		    $type=$myfile['type'];
		    $tmp_name=$myfile['tmp_name'];
		    $error=array();
		    if($errorNum>0){
		        $error['myfile']='文件上传发生错误';
		    }else if($size>5000000){
		        $error['myfile']='文件大小不符合要求';
		    }else if(!(($type=='image/png')||($type=='image/bmp')||($type=='image/jpeg')||($type=='image/gif'))){
		        $error['myfile']='文件格式不符合要求';
		    }else{
		        $extension=substr(strrchr($filename,'.'),1);
		        $rand=rand(30,999);
		        $newfilename=$rand.'.'.$extension;
		        move_uploaded_file($tmp_name,"newsimg/".$newfilename);
		    }
		}

        if($result!==true){
            $error['title']=$result;
        }
        if(empty($error)){
            addNews($save_data['title'],$save_data['content'],$save_data['uid'],$save_data['classid'],$rand,$save_data['stop']);
            header("location:newslist.php?page=1");
        }else{
            require_once'error.php';
        }
    }
?>
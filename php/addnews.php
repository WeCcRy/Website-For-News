<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="styledform.css">
	<link rel="stylesheet"  href="../dist/css/bootstrap.css"/>
	<link rel="stylesheet"  href="../css/body.css"/>
	<script src="../js/jquery-3.4.1.js"></script>
	<script src="../dist/js/bootstrap.js"></script>
</head>
<body>
<?php
    require_once 'news.dao.php';
    require_once 'newsclass.dao.php';
    require_once 'checkFormLib.php';
	session_start();
	if(!isset($_SESSION['user'])){
	    header("location:logic.php");
	}
	$userinfo=$_SESSION['user'];
    $rst=findnewsclass();
    $rs=finduser();
?>
<div style="margin-top: 200px;font-size: 16px;">
<form method="post" enctype="multipart/form-data" action="addnews_ok.php">
    <div class=tableRow>
    <p></p>
    <p class="heading">添加新闻</p>
    </div>
    <div class=tableRow>
    <p>标题:</p>
    <p><input type="text" name="title"></p>
    </div>
    <div class=tableRow>
    <p>内容:</p>
    <p><textarea name="content" id="" cols="50" rows="20"></textarea></p>
    </div>
	<div class="tableRow">
	<p>新闻图片:</p>
	<p><input type="file" value="浏览" name="image"></p>
	</div>
	<div class="tableRow">
	<p>置顶:</p>
	<p><input type="radio" name="stop" value="1">是<input type="radio" name="stop" value="0">否</p>
	</div>
    <div class=tableRow>
    <p>用户编号:</p>
    <p><input type="hidden" name="uid" value="<?php echo $userinfo['userID'] ?>"><?php echo $userinfo['username'] ?></p>
    </div>
    <div class=tableRow>
    <p>新闻类型:</p>
    <p>
    <select name="classid" id="">
    <?php
        foreach($rst as $row){
            $classid=$row['classid'];
            $classname=$row['classname'];
            echo "<option value='$classid'>$classname</option>";
        }
    ?>
    </select>
    </p>
    </div>
    <div class=tableRow>
    <p></p>
    <p><input type="submit" value="修改"></p><a href="newslist.php?page=1">返回</a>
    </form>
	</div>
</body>
</html>

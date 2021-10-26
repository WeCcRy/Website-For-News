<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<link rel="stylesheet"  href="../dist/css/bootstrap.css"/>
	<link rel="stylesheet"  href="../css/body.css"/>
	<script src="../js/jquery-3.4.1.js"></script>
	<script src="../dist/js/bootstrap.js"></script>
    <style type="text/css">
        /*新闻展示样式*/
        .news_show {
            margin: 0 auto;
			background-color: #FFFFFF;
			padding-top: 10px;
			color: #4B4B4B;
        }

        .news_show .show_title {
            text-align: center;
            font-size: 14px;
            border-bottom: 1px dotted #c7c7c7;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .news_show h2 {
            font-size: 24px;
        }

        .news_show span {
            padding-right: 10px;
        }

        .news_show .paging {
            text-align: center;
        }

        .news_show a {
            color: #0871A5;
            text-decoration: none;
        }

        .news_show .content {
            font: 18px "Hiragino Sans GB","Microsoft Yahei",sans-serif;
			line-height: 2;
            text-indent: 28px;
        }
		.imgs{
			margin-top: 20px;
			width: 666px;
			height: auto;
			overflow: hidden;
		}
    </style>
</head>

<body>
    <?php
	date_default_timezone_set("PRC");
    if (isset($_GET['newsid'])) {
		session_start();
		if(!isset($_SESSION['user'])){
		    header("location:logic.php");
		}
		$userinfo=$_SESSION['user'];
        require_once 'news.dao.php';
		require_once 'newsclass.dao.php';
		$ad=add($_GET['newsid']);
		$rst1=findnewsclass();
        $news = findNewsByID($_GET['newsid']);
        $title = $news['title'];
        $content = $news['content'];
        $uid = $news['uid'];
        $publishtime = $news['publishtime'];
        $classid = $news['classid'];
        $viewcount = $news['viewcount'];
        $likecount = $news['likecount'];
		$img=$news['newsimg'];
        require_once 'user.dao.php';
        require_once 'newsclass.dao.php';
        $user = findUserById($uid);
        $username = $user['uname'];
        $newsclass = findNewsClassByID($classid);
        $classname = $newsclass['classname'];
    } else {
        header("location:newslist.php");
    }
    ?>
	<div class="panel panel-default" style="height: 100px;margin-top: 5px;">
		<!-- 面板 -->
	    <div class="panel-body">
	        <div class="container">
				<div class="row" style="height: 90px;">
				<div class="col-md-2" style="border-right:solid gray;">
					<img src="../img/news.jpg" >
				</div>
	        	<div class="col-md-8" style="margin-top: 8px;font-size: 15px;">
	        		<nav class="navbar navbar-static-top" role="navigation">
	        		    <div class="container-fluid">
	        		    <div>
	        		        <ul class="nav navbar-nav">
	        		            <!-- 导航栏 -->
	        		                <li><a href="newslist.php?page=1" style="color: #4F4F4F;">首页</a></li>
	        		                <?php
	        		                    foreach($rst1 as $row){
	        		                        $classid=$row['classid'];
	        		                        $classname=$row['classname'];
	        		                        echo "<li><a href='newslist.php?classid=$classid&page=1' style='color: #4F4F4F;'>$classname</a></li>";
	        		                    }
	        		                ?>
	        		            
	        		        </ul>
	        		    </div>
	        		    </div>
	        		</nav>
	        	</div>
				<div class="col-md-2" style="margin-top: 15px;font-size: 10px;">
					<ul class="nav nav-tabs" style="border: none;">
						<li><a href="#" style="color: #828282;">
						<?php
						if(!isset($_SESSION['user'])){
						    echo "登录";
						}else{
							$userinfo=$_SESSION['user'];
							echo "你好,",$userinfo['username'];
						}
						?>
						</a></li>
						<li>
						<?php
						if(!isset($_SESSION['user'])){
						    echo "注册";
						}else{
							echo "<a href=logic.php?action=logout style='color: #828282;'>注销</a>";
						}
						?>
						</li>
					</ul>
				</div>
				</div>
			</div>
		</div>
	</div>
    <div class="container">
		<div class="row">
			<div class="news_show col-md-9">
				<div class="show_title">
				<h1><?php echo $title; ?></h1>
				<span>发布时间:<?php echo $publishtime; ?></span>
				<span>作者:<?php echo $username; ?></span>
				<span>所在分类:<?php echo $classname; ?></span>
				<span>点赞数:<?php echo $likecount; ?></span>
				<span>阅读量:<?php echo $viewcount; ?></span>
				</div>
				<div class="col-md-1"></div>
				<div class="content col-md-10">
				<?php echo htmlspecialchars_decode($content); ?>
				<div class="imgs">
				<?php echo "<img src=newsimg/".$img.".jpg class='center-block' style='width:100%;'>"; ?>
				</div>
				<div class="button-group" style="margin:10px auto 10px 250px;">    
					<form method="post" action="">
					<a href="#"><button class="btn btn-primary" name="button" value="1">点赞</button></a>
					
					<?php 
					if(isset($_POST['button'])){
						$newsid=$_GET['newsid'];
						$r=dianzan($newsid);
						echo "<script>alert('点赞成功!')</script>";
					}
					?>
					<a href="newslist.php?page=1"><button class="btn btn-secondary" name="button2" value="2">返回</button></a>   
					</form>
				</div>
				</div>
				<div class="col-md-1"></div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
				    <div class="panel-body" style="color: red;">
				        <span style="font-size: 20px;font-weight: 700;">热点新闻</span>
						
				    </div>
					<?php
						$rst3=find10hotNews();
						echo "<ul class='list-group'>";
						foreach($rst3 as $row){
							$newsid=$row['newsid'];
							echo "<li class='list-group-item'><a href='newsdetail.php?newsid=$newsid'>".$row['title']."</a></li>";
						}
						echo "</ul>";
					?>
				</div>
			</div>
		</div>
	</div>
	<div style="width: 100%;background-color: #C7C7C7;height: 200px;margin-top: 10px;">
		<div class="container">
			<div class="row">
				<div class="text-left col-md-4" style="padding-left: 16px;">
					<ul  class="list-unstyled">
						<li class="h3"style="font-weight: bold;">联系我们</li>
						<li><a href="addnews.php">上传新闻</a></li>
						<li><a href="#">错误反馈</a></li>
						<li><a href="#">读者论坛</a></li>
					</ul>
				</div>
				<div class="text-center col-md-4" style="margin-top: 150px;padding-right:20px ;">
					<ul>
						<p class="copyright">Copyright © 2021 CCC Inc. All rights reserved.</p>
					</ul>
				</div>
				<div class="text-right col-md-4" style="padding-right: 110px;">
					<ul  class="list-unstyled">
						<li class="h3"style="font-weight: bold;">合作媒体</li>
						<li><a href="#">新浪新闻</a></li>
						<li><a href="#">环球时报</a></li>
						<li><a href="#">观察者网</a></li>
						<li><a href="#">人民日报</a></li>
						<li><a href="#">新民晚报</a></li>
					</ul>
				</div>
	
			</div>
		</div>
	</div>
</body>

</html>
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
</head>
<body>
    <?php
        require_once 'news.dao.php';
		require_once 'newsclass.dao.php';
		session_start();
		if(!isset($_SESSION['user'])){
		    header("location:logic.php");
		}
		$userinfo=$_SESSION['user'];
		// echo '欢迎您'.$userinfo['username']."<a href=?action=logout>注销用户</a>";
		$rst1=findnewsclass();
		$page=1;
        $pagesize=9;
        if(isset($_GET['classid'])){
            $classid=$_GET['classid'];
			if(isset($_GET['page'])){
				$page=$_GET['page'];
				$maxpage=maxpage_findNewsByClassID($classid,$pagesize);
				$page=$page>$maxpage?$maxpage:$page;
				$page=$page<1?1:$page;
				$rst=findNewsByClassID_page($classid,$page,$pagesize);
				$param_str="?";
				$page_html="<li><a href='newslist.php".$param_str."classid=".$classid."&"."page=1'>首页&gt;&gt;</a></li>";
				$page_html.="<li><a href='newslist.php".$param_str."classid=".$classid."&"."page=".(($page-1)>0?($page-1):1)."'>上一页&gt;&gt;</a></li>";
				$page_html.="<li><a href='newslist.php".$param_str."classid=".$classid."&"."page=".(($page+1)<$maxpage?($page+1):$maxpage)."'>下一页&gt;&gt;</a></li>";
				$page_html.="<li><a href='newslist.php".$param_str."classid=".$classid."&"."page=$maxpage'>尾页&gt;&gt;</a></li>";
			}
            $rst=findNewsByClassID($classid);
			$rst2=find3NewsByClassID($classid);
			foreach($rst2 as $row){
				$title[]=$row['title'];
				$img[]=$row['newsimg'];
				$newsid[]=$row['newsid'];
			}
			$rst4=find9News_pageByClassID($classid,$page,$pagesize);
			foreach($rst4 as $row){
				$len=$row['title'];
				$title1[]=strlen($len)>50 ? mb_substr($len,0,22,'utf8').'...': $len;
				$img1[]=$row['newsimg'];
				$newsid1[]=$row['newsid'];
			}
        }
		// else if(isset($_GET['keyword'])){
        //     $keyword=$_GET['keyword'];
        //     $search_field=$_GET['search_field'];
        //     $rst=findNewsByName($keyword,$search_field);
        // }
		else{
			if(isset($_GET['page'])){
				$page=$_GET['page'];
				$maxpage=maxpage_findNews($pagesize);
				$page=$page>$maxpage?$maxpage:$page;
				$page=$page<1?1:$page;
				$rst=findNews_page($page,$pagesize);
				$param_str="?";
				$page_html="<li><a href='newslist.php".$param_str."page=1'>首页&gt;&gt;</a></li>";
				$page_html.="<li><a href='newslist.php".$param_str."page=".(($page-1)>0?($page-1):1)."'>上一页&gt;&gt;</a></li>";
				$page_html.="<li><a href='newslist.php".$param_str."page=".(($page+1)<$maxpage?($page+1):$maxpage)."'>下一页&gt;&gt;</a></li>";
				$page_html.="<li><a href='newslist.php".$param_str."page=$maxpage'>尾页&gt;&gt;</a></li>";
			}
			$rst2=find3News();
			foreach($rst2 as $row){
				$title[]=$row['title'];
				$img[]=$row['newsimg'];
				$newsid[]=$row['newsid'];
			}
			
			$rst4=find9News_page($page,$pagesize);
			foreach($rst4 as $row){
				$len=$row['title'];
				$title1[]=strlen($len)>50 ? mb_substr($len,0,22,'utf8').'...': $len;
				$img1[]=$row['newsimg'];
				$newsid1[]=$row['newsid'];
			}


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
						<li>
						<?php
						if(!isset($_SESSION['user'])){
						    echo "<a href='logic.php' style='color: #828282;'>登录";
						}else{
							$userinfo=$_SESSION['user'];
							echo "<a href='newslist.php?page=1' style='color: #828282;'>你好,",$userinfo['username'];
						}
						?>
						</a></li>
						<li>
						<?php
						if(!isset($_SESSION['user'])){
						    echo "注册";
						}else{
							echo "<a href='logic.php' style='color: #828282;'>注销</a>";
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
			<div class="col-md-8" style="border-right: solid 3px #808080;">
			<div id="myCarousel" class="carousel slide col-md-12" style="height: 500px;">
				<!-- 轮播（Carousel）指标 -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>   
				<!-- 轮播（Carousel）项目 -->
				<div class="carousel-inner">
					<div class="item active">
						<a href='newsdetail.php?newsid=<?php echo $newsid[0] ?>'><img src=<?php echo "newsimg/".$img[0].".jpg" ?> alt="First slide" style="width: 1200px;height: 450px;margin-top: 25px;" class="center-block"></a>
						<div class="carousel-caption"><?php echo $title[0] ?></div>
					</div>
					<div class="item">
						<a href='newsdetail.php?newsid=<?php echo $newsid[1] ?>'><img src=<?php echo "newsimg/".$img[1].".jpg" ?> alt="Second slide" style="width: 1200px;height: 450px;margin-top: 25px;" class="center-block"></a>
						<div class="carousel-caption"><?php echo $title[1] ?></div>
					</div>
					<div class="item">
						<a href='newsdetail.php?newsid=<?php echo $newsid[2] ?>'><img src=<?php echo "newsimg/".$img[2].".jpg" ?> alt="Third slide" style="width: 1200px;height: 450px;margin-top: 25px;" class="center-block"></a>
						<div class="carousel-caption"><?php echo $title[2] ?></div>
					</div>
				</div>
				<!-- 轮播（Carousel）导航 -->
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div> 
			<!-- 缩略图 -->

			<div class="col-md-4" style="margin-left: -17px;margin-top: 10px;">
			        <div class="thumbnail">
			            <a href='newsdetail.php?newsid=<?php echo $newsid1[0] ?>'><img src=<?php echo "newsimg/".$img1[0].".jpg" ?> style="width:100%;height:150px"></a>
			            <div class="caption">
			                <p><?php echo $title1[0] ?></p>
			            </div>
			        </div>
			</div>
			<div class="col-md-4" style="margin-left: 8px;margin-top: 10px;">
			        <div class="thumbnail">
			            <a href='newsdetail.php?newsid=<?php echo $newsid1[1] ?>'><img src=<?php echo "newsimg/".$img1[1].".jpg" ?> style="width:100%;height:150px"></a>
			            <div class="caption">
			                <p><?php echo $title1[1] ?></p>
			            </div>
			        </div>
			</div>
			<div class="col-md-4" style="margin-left: 8px;margin-top: 10px;">
			        <div class="thumbnail">
			            <a href='newsdetail.php?newsid=<?php echo $newsid1[2] ?>'><img src=<?php echo "newsimg/".$img1[2].".jpg" ?> style="width:100%;height:150px"></a>
			            <div class="caption">
			                <p><?php echo $title1[2] ?></p>
			            </div>
			        </div>
			</div>
			<div class="col-md-4" style="margin-left: -17px;">
			        <div class="thumbnail">
			            <a href='newsdetail.php?newsid=<?php echo $newsid1[3] ?>'><img src=<?php echo "newsimg/".$img1[3].".jpg" ?> style="width:100%;height:150px"></a>
			            <div class="caption">
			                <p><?php echo $title1[3] ?></p>
			            </div>
			        </div>
			</div>
			<div class="col-md-4" style="margin-left: 8px;">
			        <div class="thumbnail"></a></a></a>
			            <a href='newsdetail.php?newsid=<?php echo $newsid1[4] ?>'><img src=<?php echo "newsimg/".$img1[4].".jpg" ?> style="width:100%;height:150px"></a>
			            <div class="caption">
			                <p><?php echo $title1[4] ?></p>
			            </div>
			        </div>
			</div>
			<div class="col-md-4" style="margin-left: 8px;">
			        <div class="thumbnail">
			            <a href='newsdetail.php?newsid=<?php echo $newsid1[5] ?>'><img src=<?php echo "newsimg/".$img1[5].".jpg" ?> style="width:100%;height:150px"></a>
			            <div class="caption">
			                <p><?php echo $title1[5] ?></p>
			            </div>
			        </div>
			</div>
			<div class="col-md-4" style="margin-left: -17px;">
			        <div class="thumbnail">
			            <a href='newsdetail.php?newsid=<?php echo $newsid1[6] ?>'><img src=<?php echo "newsimg/".$img1[6].".jpg" ?> style="width:100%;height:150px"></a>
			            <div class="caption">
			                <p><?php echo $title1[6] ?></p>
			            </div>
			        </div>
			</div>
			<div class="col-md-4" style="margin-left: 8px;">
			        <div class="thumbnail">
			            <a href='newsdetail.php?newsid=<?php echo $newsid1[7] ?>'><img src=<?php echo "newsimg/".$img1[7].".jpg" ?> style="width:100%;height:150px"></a>
			            <div class="caption">
			                <p><?php echo $title1[7] ?></p>
			            </div>
			        </div>
			</div>
			<div class="col-md-4" style="margin-left: 8px;">
			        <div class="thumbnail">
			            <a href='newsdetail.php?newsid=<?php echo $newsid1[8] ?>'><img src=<?php echo "newsimg/".$img1[8].".jpg" ?> style="width:100%;height:150px"></a>
			            <div class="caption">
			                <p><?php echo $title1[8] ?></p>
			            </div>
			        </div>
			</div>
			</div>

			
			<!-- 热点新闻 -->
			
			<div class="col-md-3" style="height: 1000px;">
				<div class="panel panel-default">
				    <div class="panel-body" style="color: red;">
				        <span style="font-size: 20px;font-weight: 700;">热点新闻</span>
						
				    </div>
					<?php
						if(isset($_GET['classid'])){
						$classid=$_GET['classid'];
						$rst3=findhotNewsByClassID($classid);
						echo "<ul class='list-group'>";
						foreach($rst3 as $row){
							$newsid=$row['newsid'];
							echo "<li class='list-group-item'><a href='newsdetail.php?newsid=$newsid'>".$row['title']."</a></li>";
						}
						echo "</ul>";
						}else{
						$rst3=findhotNews();
						echo "<ul class='list-group'>";
						foreach($rst3 as $row){
							$newsid=$row['newsid'];
							echo "<li class='list-group-item'><a href='newsdetail.php?newsid=$newsid'>".$row['title']."</a></li>";
						}
						echo "</ul>";
						}
					?>
				</div>
			</div>
			
		</div>
		
	</div>
	<div class="container">
		<div class="row">
			<div class="text-center">
				<ul class="pager">
					<?php echo $page_html; ?>
				</ul>
			</div>
		</div>
	</div>
	<div style="width: 100%;background-color: #C7C7C7;height: 200px;margin-top: 10px;">
		<div class="container">
			<div class="row">
				<div class="text-left col-md-4" style="padding-left: 16px;">
					<ul  class="list-unstyled">
						<li class="h3"style="font-weight: bold;">联系我们</li>
						<li><?php
						if(!isset($_SESSION['user'])){
						    echo "<a href='addnews.php'>上传新闻(请先登录)</a>";
						}else{
							$userinfo=$_SESSION['user'];
							echo "<a href='addnews.php'>上传新闻</a>";
						}
						?></li>
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
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
	<div class="container">
		<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8" style="font-size: 20px;">
			<form method="post" action="logic_ok.php">
			<div class="tableRow">
				<p></p>
				<p class="heading">用户登录</p>
			</div>
			<div class="tableRow">
				<p>用户名:</p>
				<p><input type="text" name="username" ></p>
			</div>
			<div class="tableRow">
				<p>密码:</p>
				<p><input type="password" name="userpwd" ></p>
			</div>
			<div class="tableRow">
				<p>验证码:</p>
				<p><input type="text" name="code"></p>
			</div>
			<div class="tableRow">
				<p></p>
				<p><img src="code.php" id="img1"><a href="#" id="change" style="font-size: 10px;">看不清，换一张</a></p>
			</div>
			<div class="tableRow">
				<p></p>
				<p><input type="submit" value="登录"></p>
			</div>
			</form>
		</div>
		<div class="col-md-2"></div>
		</div>
	</div>
</body>
<script>
var change=document.getElementById("change");
var img1=document.getElementById("img1");
change.onclick=function(){
    img1.src="code.php?t="+Math.random();
    return false;
}
</script>
</html>
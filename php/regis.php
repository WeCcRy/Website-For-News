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
		<div class="col-md-8" style="font-size: 20px;margin-top: 200px;">
			<form method="POST" enctype="multipart/form-data" action="regis2.php">
			    <div class="tableRow">
			    <p></p>
			    <p class="heading">用户注册</p>
			    </div>
			    <div class="tableRow">
			    <p>用户名:</p>
			    <p><input type="text" name="uname"></p>
			    </div>
			    <div class="tableRow">
			    <p>密码:</p>
			    <p><input type="password" name="pass"></p>
			    </div>
			    <div class="tableRow">
			    <p>重复密码:</p>
			    <p><input type="password" name="repass"></p>
			    </div>
			    <div class="tableRow">
			    <p>电子邮箱:</p>
			    <p><input type="text" name="email"></p>
			    </div>
			    <div class="tableRow">
			    <p>性别:</p>
			    <p><input type="radio" name="gender" value="1">男<input type="radio" name="gender" value="1">女</p>
			    </div>
			    <div class="tableRow"><p></p><p><input type="submit" value="注册" ></p></div>
			</form>
		</div>
		<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>

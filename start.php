<html>
<head>
<style>
body{
	background-image:url("a.jpg");
    background-repeat:no-repeat;
    background-size:100%;
}
#box{
	width:500px;
	height:400px;
	background-color:#000;
    margin:0px auto;
    text-align:center;
    margin-top:150px;
    border-radius:7px;
	opacity:.5;
}
img{
	width:110px;
	height:110px;
	border-radius:400px;
	background:#fff;
	padding:3px;
	margin-top:-60px;
	margin-bottom:20px;
	
}

input{
	background-color:#ffffff;
    border: none;
	color: black;
	font-weight: bold;
    padding: 16px 40px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
	border-bottom:5px solid #27AE60;
	border-radius:7px;
}

</style>
</head>
<body>
<div id="box">
<img src="mw.jpg">
<br>
<br>
<form id="login" action="login.php" method="post">
    <input id="login" type="submit" name="Login" value="  Login  ">
</form>
<br>
<form id="signup" action="addstudent.php" method="post">
    <input id="sign_up" type="submit" name="Sign_up" value="Sign up ">
</form>
</div>
</body>
</html>
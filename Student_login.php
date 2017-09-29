<html>
<head>
<style>
    form{
    position:relative;
    left:30px;
    top:100px;

        font-family: "Callibari", Times, serif;
        font-size: 1.5em;
        font-weight: bold;

    }
    .dimbo{
    background-color: #db8432;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

 body{
	 background-image: url("a5.jpg");
        background-size: cover;
     background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center bottom;       }
	</style>
</head>
<body>

<?php
if (isset($_GET['s_name'])  && isset($_GET['ns_id'])  )
{
    $s_name = $_GET['s_name'];
    $ns_id = $_GET['ns_id'];
    echo "<center><b><div style='position:relative;left: 30px;top:50px;font-size:20px'>";
    echo "Welcome $s_name<br> ";
    echo "Your ID is and password are sent to you on email<br> ";
     echo"Continue with login";
     echo "</center></div>";
}
else
{
    echo "<center><b><div style='position:relative;left: 30px;top:50px;font-size:20px'>";
    $m_name = $_GET['m_name'];
    $nm_id = $_GET['nm_id'];
    echo "Welcome $m_name<br> ";
   echo "Your ID is and password are sent to you on email<br> ";
    echo"Continue with login";
    echo "</center></b></div>";
}
?>
<center>
<div>
<form action="http://localhost:1234/login.php" method="post">
	<p>
	<input class="dimbo" type="submit" name="login" value="login" />
	</p>
</form>
</div>
</center>
</body>
</html>

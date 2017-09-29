<?php
include("ownwindow.php");

if(isset($_POST['submit']))
{
	$ID= $_POST['id'];
	$Name= $_POST['name'];
	$flag= $_POST['flag'];
	$privacy = $_POST['sec'];
	$name = $_FILES['myfile']['name'];
	$tmp_name = $_FILES['myfile']['tmp_name'];
	//echo $ID;
	if($name)
	{
		$location = "D:/xampp/htdocs/uploads/".basename($_FILES['myfile']['name']);
		move_uploaded_file($tmp_name,$location);
		GLOBAL $dbc;
		require_once('../mysqli_connect.php');
		$query= "INSERT INTO uploads (File_name,ID,privacy) VALUES (?,?,?)";
		$stmt = mysqli_prepare($dbc, $query);

        mysqli_stmt_bind_param($stmt, "sss", $name, $ID, $privacy);

        mysqli_stmt_execute($stmt);

		mysqli_stmt_close($stmt);

        mysqli_close($dbc);
	}
	//$url = "http://localhost:1234/ownwindow.php?ID=$ID&Name=$name&flag=$flag" ;
	//header("Location:$url");
    //exit;
}


?>
<html>
<head>
	<title>Upload File</title>
	<style>
    form{
    position:relative;
    left:50px;

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
	</style>
</head>
<body >
	<form method="post" enctype="multipart/form-data">
	<label><br><br>Choose a file</label>
	<input type="hidden" name= "id" value="<?php echo $_GET['ID'];?>">
	<input type="hidden" name= "name" value="<?php echo $_GET['name'];?>">
	<input type="hidden" name= "flag" value="<?php echo $_GET['flag'];?>">
	<p>
	<input class="dimbo" type="file" name="myfile">
	</p>
	<input type="radio" name="sec" value="public"> Public<br>
	<input type="radio" name="sec" value="private"> Private<br>
	<p>
	<input class="dimbo" type="submit" name="submit" value= "Upload">
	</p>
	</form>
</body>
</html>

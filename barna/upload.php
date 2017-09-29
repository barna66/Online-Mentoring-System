<?php

if(isset($_POST['submit']))
{
	$ID= $_POST['id'];
	$name= $_POST['name'];
	$flag= $_POST['flag'];
	$privacy = $_POST['sec'];
	$name = $_FILES['myfile']['name'];
	$tmp_name = $_FILES['myfile']['tmp_name'];
	echo $ID;
	if($name)
	{
		$location = "C:/xampp/htdocs/uploads/".basename($_FILES['myfile']['name']);
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
</head>
<body>
	<form method="post" enctype="multipart/form-data">
	<label>Choose a file</label>
	<input type="hidden" name= "id" value="<?php echo $_GET['ID'];?>">
	<input type="hidden" name= "name" value="<?php echo $_GET['name'];?>">
	<input type="hidden" name= "flag" value="<?php echo $_GET['flag'];?>">
	<p>
	<input type="file" name="myfile">
	</p>
	<input type="radio" name="sec" value="public"> Public<br>
	<input type="radio" name="sec" value="private"> Private<br>
	<p>
	<input type="submit" name="submit" value= "Upload">
	</p>
	</form>
</body>
</html>

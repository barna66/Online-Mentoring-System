<?php
include("ownwindow.php");

if(isset($_POST['submit']))
{
	$ID= $_POST['id'];
	echo $ID."<br>";
	$Name= $_POST['name'];
	$flag= $_POST['flag'];
	require_once('../mysqli_connect.php');
	if($flag==1)
	{
		if(!empty($_POST["Contact_number"]))
		{
			echo "lalalalal";
			$cn  = $_POST['Contact_number'];
			echo $cn;
			$query="UPDATE student SET Contact_number='$cn' WHERE S_ID=$ID";
			$response= @mysqli_query($dbc, $query);
			mysqli_error($dbc);
		}
		if(!empty($_POST["Password"]))
		{
			echo "passsssssss";
			$pss = $_POST['Password'];
			$query="UPDATE student SET Password='$pss' WHERE S_ID=$ID";
			$response= @mysqli_query($dbc, $query);
		}
		if(!empty($_FILES['image']['name']))
		{
			//echo "imageeeeeeeee";
			$image = $_FILES['image']['name'];
			//echo $image;
			$query="UPDATE student SET Image='$image' WHERE S_ID=$ID";
			$response= @mysqli_query($dbc, $query);
			$dest = "D:/xampp/htdocs/photos/".basename($_FILES['image']['name']);
			move_uploaded_file($_FILES['image']['tmp_name'],$dest);
		}
	}
	else
	{
		if(!empty($_POST["Contact_number"]))
		{
			$cn  = trim($_POST['Contact_number']);
			$query="UPDATE mentor SET Contact_number='$cn' WHERE M_ID=$ID";
			$response= @mysqli_query($dbc, $query);
		}
		if(!empty($_POST["Password"]))
		{
			$pss = trim($_POST['Password']);
			$query="UPDATE mentor SET Password='$pss' WHERE M_ID=$ID";
			$response= @mysqli_query($dbc, $query);
		}
		if(!empty($_FILES['image']['name']))
		{
			$image = $_FILES['image']['name'];
			$query="UPDATE mentor SET Image='$image' WHERE M_ID=$ID";
			$response= @mysqli_query($dbc, $query);
			$dest = "D:/xampp/htdocs/photos/".basename($_FILES['image']['name']);
			move_uploaded_file($_FILES['image']['tmp_name'],$dest);
		}
	}
	$url = "http://localhost:1234/ownwindow.php?ID=$ID&Name=$Name&flag=$flag" ;
	header("Location:$url");
    exit;
}


?>
<html>
<head>
	<title>Settings</title>
</head>
<body>
	<form method="post" enctype="multipart/form-data">
	<label>Profile settings</label>
	<input type="hidden" name= "id" value="<?php echo $_GET['ID'];?>">
	<input type="hidden" name= "name" value="<?php echo $_GET['name'];?>">
	<input type="hidden" name= "flag" value="<?php echo $_GET['flag'];?>">
	<p class="bText">Change Password:
		<input type="password" name="Password" size="20" value="" />
	</p>
	<p class="bText">Change contact number:
		<input type="text" name="Contact_number" size="13" value="" />
	</p>
	<p class="bText"> Change Profile Picture:
		<input type="file" name="image" value="">
	</p>
	<p>
	<input type="submit" name="submit" value= "Change">
	</p>
	</form>
</body>
</html>

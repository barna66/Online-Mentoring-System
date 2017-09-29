<?php
include("ownwindow.php");
	require_once('../mysqli_connect.php');
	$query = "SELECT About FROM algorithm WHERE Mentor_ID=$ID";
	$response= @mysqli_query($dbc, $query);
	if($response)
	{
		while($row=mysqli_fetch_array($response))
		{
			//echo "<div style='position:relative;left: 50px;top:50px;font-size:20px'><u>Algorithm</u> :</div>";
			$about=$row['About'];
            echo "<div style='position:relative;left: 50px;top:50px;font-size:20px'><u>Algorithm</u> :  ".$about."<br><br>"."</div>";		}

	}
	$query = "SELECT About FROM database1 WHERE Mentor_ID=$ID";
	$response= @mysqli_query($dbc, $query);
	if($response)
	{
		while($row=mysqli_fetch_array($response))
		{
            $about=$row['About'];
            echo "<div style='position:relative;left: 50px;top:50px;font-size:20px'><u>Database1</u> :  ".$about."<br><br>"."</div>";
		}

	}
	$query = "SELECT About FROM system_programming WHERE Mentor_ID=$ID";
	$response= @mysqli_query($dbc, $query);
	if($response)
	{
		while($row=mysqli_fetch_array($response))
		{
			//echo "<div style='position:relative;left: 50px;top:50px;font-size:20px'><u>System Programming</u> :</div>";
			$about=$row['About'];
            echo "<div style='position:relative;left: 50px;top:50px;font-size:20px'><u>System Proramming</u> :  ".$about."<br><br>"."</div>";		}

	}

?>

<?php
if(isset($_POST["submit"]))
{
	$ID=$_POST["m_id"];
	$name=$_POST["m_name"];
	if(!empty($_POST["spclcrs"]))
    {
        foreach($_POST["spclcrs"] as $spclcrs)
        {
            GLOBAL $dbc;
			$abtCrs = "text".$spclcrs;
			$about= $_POST[$abtCrs];
			echo $about;
            require_once('../mysqli_connect.php');
			$query="UPDATE $spclcrs SET Type=1,About= '$about' WHERE Mentor_ID=$ID";

			$response= @mysqli_query($dbc, $query);

			
			//$stmt = mysqli_prepare($dbc, $query);
			//mysqli_stmt_bind_param($stmt, "ssss", $ID, $name , $type , $about);
			//mysqli_stmt_execute($stmt);
			if($response)
			echo "####3hoise";
			
        }
    }
}
?>
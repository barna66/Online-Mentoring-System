<?php
if(isset($_POST["submit"]))
{
	$ID=$_POST["m_id"];
	$name=$_POST["m_name"];
    if(!empty($_POST["crs"]))
    {
		//echo "dfdfklbdfkl";
        foreach($_POST["crs"] as $crs)
        {
            GLOBAL $dbc;
            require_once('../mysqli_connect.php');
			echo $crs;
			$query = "INSERT INTO $crs (Mentor_ID ,Name, Type, About) VALUES (?,?,?,?)";

          //  $response= @mysqli_query($dbc, $query);
			$type=0;
			$about=NULL;
			$stmt = mysqli_prepare($dbc, $query);
			mysqli_stmt_bind_param($stmt, "ssss", $ID, $name , $type , $about);
			mysqli_stmt_execute($stmt);
			mysqli_error($dbc);
			
			$tbl = $_POST["m_id"];
            $tbl_name= $tbl.$crs;
			//echo $tbl_name;
            $query = "CREATE TABLE $tbl_name (Student_ID VARCHAR(30), Name VARCHAR(30) , Mentor_ID VARCHAR(50));";
          //  $response= @mysqli_query($dbc, $query);
			$stmt = mysqli_prepare($dbc, $query);
			mysqli_stmt_execute($stmt);
			mysqli_error($dbc);
				
			$tbl_name= "forum".$tbl_name;
			$query = "CREATE TABLE $tbl_name (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, topic VARCHAR(9999) , creator VARCHAR(9999), replies VARCHAR(9999), content VARCHAR(9999), date DATE, view INT(11));";
			  //  $response= @mysqli_query($dbc, $query);
			$stmt = mysqli_prepare($dbc, $query);
			mysqli_stmt_execute($stmt);
			mysqli_error($dbc);

			$tbl_name= "reply".$tbl_name;
			$query = "CREATE TABLE $tbl_name (id INT(11), replier VARCHAR(999) , date DATE, content MEDIUMTEXT);";
			  //  $response= @mysqli_query($dbc, $query);
			$stmt = mysqli_prepare($dbc, $query);
			mysqli_stmt_execute($stmt);
			mysqli_error($dbc);

		
        }
    }
	$url;
	if($_POST['spcl_fld']=='yes')
        $url = "hudai3.php?m_name=$name&m_id=$ID";
	else
		$url = "student_login.php?s_name=$name&ns_id=$ID";
	
	header("Location:$url");
    exit;
}

?>
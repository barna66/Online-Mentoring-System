
<?php
include("ownwindow.php");

$uplds[0]=0;
	require_once('../mysqli_connect.php');
	$query5 = "SELECT File_name FROM uploads WHERE ID=$ID";
	$response5= @mysqli_query($dbc, $query5);
	if($response5)
	{
		$idx =0;
		while($row=mysqli_fetch_array($response5))
		 {
			$uplds[$idx++]=$row['File_name'];
			//echo $uplds[$idx-1];
		 }

	}

?>

<!DOCTYPE html>
<html>
<head>
<style>

section{
	margin-left: 250px;
}
ul
{
list-style-type: none;
    margin: 0;
    padding: 0;
overflow:
    hidden;
background-color:
#333;
}
li
{
float:
    left;
}

li a, .dropbtn
{
display:
    inline-block;
color:
    white;
text-align:
    center;
    padding: 14px 16px;
text-decoration:
    none;
}

li a:
hover, .dropdown:
hover .dropbtn
{
background-color:
    yellow;
}

li.dropdown
{
display:
    inline-block;
}

.dropdown-content
{
display:
    none;
position:
    absolute;
background-color:
#f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}
#pic{
float: left;
width:248px;
padding-bottom: 400px;
}
.dropdown-content a
{
color:
    black;
    padding: 12px 16px;
text-decoration:
    none;
display:
    block;
text-align:
    left;
}

.dropdown-content a:
hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
display:
    block;
}


</style>
</head>
<body>
<?php
	$flag=0;

	foreach($uplds as $upload)
	{
		echo "<div style='position:relative;left: 50px;top:50px;font-size:20px'>".str_repeat('&nbsp;', 5).$upload."    <a href='download1.php?name=".$upload."'>download</a></div><br> ";
		$flag=1;
	}
	if($flag==0)
	{
		echo "<div style='position:relative;left: 50px;top:50px;font-size:20px'>".str_repeat('&nbsp;', 5)."Nothing to show";
	}
?>
</body>
</html>



<?php
session_start();
$state =  $_SESSION["state"];
if($state==0){

echo "<script> window.location.replace('start.php')</script>";


}
$is_true = 0 ;
$ID=0;
$name;
$rowP;
$course;
$req[0]="";
$req_sid[0]="";
$group[0]="";
$crs[0]="";
$batch[0]="";
$flag= $_SESSION["flag"];
//echo $flag;
$dbc;


    $ID = $_SESSION["ID"];

    $name = $_SESSION["Name"];

	//$image= $_GET['Image'];
    // echo "Hi ".$name."<!!!br/>";
require_once('../mysqli_connect.php');
$query1 = "SELECT Course_Name  FROM course_info";

$query2 = "SELECT Mentor_ID ,Student_ID , Course_ID FROM request_from_student";
$query3 = "SELECT Name,S_ID,Batch FROM student";
$response1 = @mysqli_query($dbc, $query1);
$response2 = @mysqli_query($dbc, $query2);



if($response1)
{
    // echo "Hi ".$name."<!!!br/>";

    $idx =0;
    while($row=mysqli_fetch_array($response1))
    {

        $course[$idx++]=$row['Course_Name'];
        // echo $course[$idx-1] . "<br/>";
    }
}

if($response2)
{
    // echo "Hi2 ".$name."<!!!br/>";

    $idx =0;
    while($row=mysqli_fetch_array($response2))
    {
        if($ID == $row['Mentor_ID'])
        {

             $sid= $row['Student_ID'];
            $req[$idx++]=find_name($sid,$idx);
            $crs[$idx-1]=$row['Course_ID'];
          echo "<script> window.location.replace('http://localhost:1234/mentorwindow.php')</script>";


            //echo $sid." ****".$req[$idx-1]."*** ".$crs[$idx-1]."<br/>";

        }
    }
}


$fname = $ID.".txt";
if (file_exists($fname)) {
 $myfile = fopen($fname, "r");
$i=0;$j=0;
while(!feof($myfile))
{
    $str=fgets($myfile) ;
    if(($i%2)==0){

    $group[$j]=$str;
    //echo $str;

  $j++;

  }

  $i++;
}
fclose($myfile);
}

function find_name($sid,$i)
{
    GLOBAL $dbc;
    GLOBAL $query3;
    GLOBAL $batch;
    $response3 = @mysqli_query($dbc, $query3);
    if($response3){
    while($row=mysqli_fetch_array($response3))
    {
        if($sid == $row['S_ID'])
        {
            $req_sid[$i-1]=$sid;
            $batch[$i-1]=$row['Batch'];
            return $row['Name'];
            break;
        }
    }
    }
}

//mysqli_close($dbc);
?>

<!DOCTYPE html>
<html>
<head>
<style>
 body{
	 background-image: url("a3.jpg");
       background-size: cover;
     background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center bottom;       }


section{
	margin-left: 245px;
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
width:240px;
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
#srch {
    width: 130px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url('searchicon.png');
    background-size: 40px 40px;
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}


</style>
</head>
<body>


<div id="pic">
	<?php
GLOBAL $dbc;
require_once('../mysqli_connect.php');
if($flag==1)
$queryP= "SELECT * FROM student WHERE S_ID=$ID ";
else
	$queryP= "SELECT * FROM mentor WHERE M_ID=$ID ";
$responseP= @mysqli_query($dbc, $queryP);
$rowP= mysqli_fetch_array($responseP);
		echo "<img width='248' src='photos/".$rowP['Image']."' >";
	//echo "<p>".$rowP['Name']."</p>";
	?>
</div>
<section>
<ul>

<li><a href="ownwindow.php"> <?php echo $name; ?> </a></li>
<li><a href="#news">Enrolled courses</a></li>


<li class="dropdown">
    <a href="#" class="dropbtn">Notification</a>
        <div class="dropdown-content">

            <?php $i=0;
            foreach ($req as $snm ) : ?>
            <?php if($snm != null): ?>
                <a href="http://localhost:1234/mentorwindow.php?sid=<?php echo $req_sid[$i]; ?>&name=<?php echo $snm; ?>&batch=<?php echo $batch[$i]; ?>">
                <?php echo $snm ." from batch ".$batch[$i]." has sent you request for enrolling in ". "$crs[$i] course"; $i++; ?></a>
                <?php endif; ?>

<?php endforeach; ?>

</div>
</li>

<li class="dropdown">
    <a href="#" class="dropbtn">Groups</a>
        <div class="dropdown-content">

            <?php $i=0;
            foreach ($group as $snm ) : ?>
            <?php if($snm != null): ?>
                <a href="http://localhost:1234/groupwindow.php?sid=<?php echo $ID; $_SESSION["groupname"]=$snm; ?>&groupname=<?php echo $snm;  ?>">
                <?php echo $snm; ?>
                <?php endif; ?>

<?php endforeach; ?>

</div>
</li>

<li class="dropdown">
    <a href="#" class="dropbtn">Course list</a>
        <div class="dropdown-content">

            <?php foreach ($course as $crs) : ?>


                <a href="http://localhost:1234/coursewindow.php?course=<?php echo $crs; ?>&sname=<?php echo $name; ?>&id=<?php echo $ID; ?>"><?php echo $crs; ?></a>

<?php endforeach; ?>

</div>
</li>
<li><a href="http://localhost:1234/uploaded.php?ID=<?php echo $ID; ?>&Name=<?php echo $name; ?>&flag=<?php echo $flag; ?>">Uploaded Files</a></li>

<li><a href="upload.php?ID=<?php echo $ID;?>">Upload File</a></li>

<li><a href="about.php?ID=<?php echo $ID;?>&name=<?php echo $name; ?>&flag=<?php echo $flag; ?>">About</a></li>

<li><a href="settings.php?ID=<?php echo $ID; ?>&name=<?php echo $name; ?>&flag=<?php echo $flag; ?>">Settings</a></li>


<li><a href="change_state.php">LogOut</a></li>

</ul>

</section>

</body>
</html>


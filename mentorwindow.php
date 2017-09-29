
<?php
session_start();

$state =  $_SESSION["state"];
if($state==0){

echo "<script> window.location.replace('start.php')</script>";


}
//include("ownwindow.php");
$is_true = 0 ;
$ID=0;
$name;
$course;
$req[0]="";
$req_sid;
$crs[0]="";
$group[0]="";
$batch[0]="";
$sid;
/*if (isset($_GET['ID'])  && isset($_GET['Name']))
{

    $ID = $_GET['ID'];
    $name = $_GET['Name'];
    //echo "Hi ".$name."<!!!br/>";
}*/
 $ID = $_SESSION["ID"];

    $name = $_SESSION["Name"];
    $flag = $_SESSION["flag"];
require_once('../mysqli_connect.php');
$query1 = "SELECT Course_Name  FROM course_info";
$query2 = "SELECT Mentor_ID ,Student_ID , Course_ID ,Bool FROM request_from_student";
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
        if($ID == $row['Mentor_ID'] && $row['Bool']!=true)
        {
           // echo "hi";
             $sid= $row['Student_ID'];
            $req[$idx]=find_name($sid,$idx);
            $crs[$idx]=$row['Course_ID'];
         // echo "<script> window.location.replace('http://localhost:1234/mentorwindow.php?ID=$ID&Name=$name')</script>";


           // echo $sid." ****".$req[$idx]."*** ".$crs[$idx]."<br/>";
            $idx++;

        }
    }
   // mysqli_close($dbc);
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
    GLOBAL $req_sid;
    $response3 = @mysqli_query($dbc, $query3);

    $query4 = "SELECT Name,M_ID,Batch FROM mentor";
     $response4 = @mysqli_query($dbc, $query4);

     $flag=0;

    if($response3){
    while($row=mysqli_fetch_array($response3))
    {
        if($sid == $row['S_ID'])
        {
            $req_sid[$i]=$sid;
            $batch[$i]=$row['Batch'];
            $flag=1;
             return $row['Name'];
            break;
        }

    }

    }


    if($response4 && $flag==0){
    while($row=mysqli_fetch_array($response4))
    {
        if($sid == $row['M_ID'])
        {
            $req_sid[$i]=$sid;
            $batch[$i]=$row['Batch'];
            $flag=1;
             return $row['Name'];
            break;
        }

    }

    }
}

?>

<!DOCTYPE html>
<html>
<head>>
<!DOCTYPE html>
<html>
<head>
<style>


body{
        background-image: url("ownwindow.jpg");
        background-size:cover;
        }
section{
	margin-left: 242px;
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

body{
	background-image: url('a.jpg');
	background-size:cover;
}
</style>

</head>
<body>

<div id="pic">
	<?php
GLOBAL $dbc;
require_once('../mysqli_connect.php');
$queryP= "SELECT * FROM mentor WHERE M_ID=$ID ";
$responseP= @mysqli_query($dbc, $queryP);
$rowP= mysqli_fetch_array($responseP);
		echo "<img width='248' src='photos/".$rowP['Image']."'>";
	//echo "<p>".$rowP['Name']."</p>";
	?>
</div>

<ul>

<li><a href="mentorwindow.php"> <?php echo $name; ?> </a></li>
<li><a href="#news">Enrolled courses</a></li>


<li class="dropdown">
    <a href="#" class="dropbtn">Notification</a>
        <div class="dropdown-content">

            <?php $i=0;
            foreach ($req as $snm ) : ?>
            <?php if($snm != null): ?>
                <a href="http://localhost:1234/issue_request.php?sid=<?php echo $req_sid[$i]; ?>&name=<?php echo $snm; ?>&mentorname=<?php echo $name; ?>&batch=<?php echo $batch[$i]; ?>&course=<?php echo $crs[$i] ?>&mid=<?php echo $ID; ?>">
                <?php echo $snm ." from batch ".$batch[$i]." has sent you request for enrolling in ". "$crs[$i] course"; ?></a>
                <?php $i++;endif; ?>

<?php endforeach; ?>

</div>
</li>


<li class="dropdown">
    <a href="#" class="dropbtn">Groups</a>
        <div class="dropdown-content">

            <?php $i=0;
            foreach ($group as $snm ) : ?>
            <?php if($snm != null): ?>
                <a href="http://localhost:1234/groupwindow.php?sid=<?php echo $ID;$_SESSION["groupname"]=$snm; ?>&groupname=<?php echo $snm; ?>">
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

<li><a href="upload.php?ID=<?php echo $ID; ?>&name=<?php echo $name; ?>&flag=<?php echo $flag; ?>">Upload File</a></li>

<li><a href="settings.php?ID=<?php echo $ID; ?>&name=<?php echo $name; ?>&flag=<?php echo $flag; ?>">Settings</a></li>

<li><a href="change_state.php">LogOut</a></li>


</ul>


</body>


</head>
</html>

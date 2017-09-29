
<?php
$is_true = 0 ;
$isOwnWin=0;
$ID=0;
$name;
$rowP;
$course;
$req[0]="";
$req_sid[0]="";
$group[0]="";
$crs[0]="";
$batch[0]="";
$flag=0;
if (isset($_GET['ID'])  && isset($_GET['Name']))
{

    $ID = $_GET['ID'];
    if(isset($_GET['flag']))
    $flag = $_GET['flag'];
    $name = $_GET['Name'];
	//$image= $_GET['Image'];
    // echo "Hi ".$name."<!!!br/>";
}
require_once('../mysqli_connect.php');
$query1 = "SELECT Course_Name  FROM course_info";

$query2 = "SELECT Mentor_ID ,Student_ID , Course_ID FROM ,request_from_student";
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
          //echo "<script> window.location.replace('http://localhost:1234/mentorwindow.php?ID=$ID&Name=$name')</script>";


            //echo $sid." ****".$req[$idx-1]."*** ".$crs[$idx-1]."<br/>";

        }
    }
}


/*$fname = $ID.".txt";
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
fclose($myfile);*/


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
body
{
	background-image: url("a4.jpg");
    background-size: cover;
     background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center bottom;



}
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
	<li><a href="#home"> <?php echo $name; ?> </a></li>

<li><a href="#news">Enrolled courses</a></li>

<li class="dropdown">
    <a href="#" class="dropbtn">Groups</a>
        <div class="dropdown-content">

            <?php $i=0;
            foreach ($group as $snm ) : ?>
            <?php if($snm != null): ?>
                <a href="http://localhost:1234/groupwindow.php?sid=<?php echo $ID; ?>&groupname=<?php echo $snm; ?>">
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

<li><a href="http://localhost:1234/publicUPLD.php?ID=<?php echo $ID; ?>&flag=<?php echo $flag; ?>&Name=<?php echo $name; ?>">Uploaded Files</a></li>

</ul>
</section>
</body>
</html>

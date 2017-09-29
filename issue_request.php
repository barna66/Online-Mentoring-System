
<html>
<head>


<style>
body{
	background-image: url("a.jpg");
    background-size:cover;
}
form{
        position: relative;
        left: 600px;
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
    .btext{
        font-family: "times new roman", Times, serif;
        font-size: 1.5em;
        font-weight: bold;
        }
</style>
</head>
<body>

<?php
$name;
$sid=0;
$batch;
$course;
$mid;
$mname;
$dbc;
$flag;
if(isset($_GET['sid'] ) && isset($_GET['batch']) && isset($_GET['name']) && isset($_GET['course']) && isset($_GET['mid']) )
{


    $flag=1;
    $mid = $_GET['mid'];
    $sid = $_GET['sid'];
    $name = $_GET['name'];
    $mname = $_GET['mentorname'];
    $course = $_GET['course'];

//echo "<center><b>".$_GET['name']." "."is requested to enrolled under you for ".$_GET['course']."</center></b>";



}



?>
<p>
<center>

<h3> Requst for course <?php echo $_GET['course'] ?> </h3>


    <h3> <a href="http://localhost:1234/publicWindow.php?ID=<?php echo $sid; ?>&flag=<?php echo $flag; ?>&Name=<?php echo $name; ?>">View Student's Profile </a></h3>
</center>

                 </p>

                 <p>
                 <form  method="post" action="http://localhost:1234/create_group.php?mid=<?php echo $mid; ?>&sname=<?php echo $name; ?>&mname=<?php echo $mname; ?>&sid=<?php echo $sid; ?>&course=<?php echo $course; ?>">
                 <input class="dimbo" type="submit" name ="submit1" value="Accept" />
                </p>

                <p>
                 <input class="dimbo" type="submit" name ="submit2" value="Ignore" />
                 </form>




                 </p>

                 </html>
                 <body>

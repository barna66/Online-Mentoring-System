<?php
$sid;
$mid;
$mnane;
$sname;
$flag=0;
$course;
if(isset($_GET['mid']))
{
    $sid = $_GET['sid'];
    $mid = $_GET['mid'];
    $mname = $_GET['mname'];
    $sname = $_GET['sname'];
    $course = $_GET['course'];
}
if(isset($_POST['submit1']))
{
    //echo "Accepted";
    notify_student();
    $flag=1;

}
else if(isset($_POST['submit2']))
{
    //echo "Ignore";
    $flag=1;
    delete_request();

}

//echo $mname;
function delete_request()
{
    GLOBAL $dbc;
    GLOBAL $sid;
    GLOBAL $mid;
    GLOBAL $course;
    require_once('../mysqli_connect.php');
    $query = "DELETE FROM request_from_student
             WHERE
             Mentor_ID = '$mid' AND Course_ID = '$course' AND  Student_ID= '$sid'  AND Bool = 'FALSE'
             ";

    $response = @mysqli_query($dbc, $query);
    if($response)
        echo $response." ";
    else
        echo mysqli_error($dbc);

}

function notify_student()
{

    GLOBAL $sid;
    GLOBAL $mid;
    GLOBAL $dbc;
    GLOBAL $course;
    require_once('../mysqli_connect.php');
    $query = "UPDATE request_from_student
             SET BOOL = 1 WHERE
             Student_ID= $sid AND Mentor_ID = $mid
             ";

    $response = @mysqli_query($dbc, $query);
    if(!$response)

            echo mysqli_error($dbc);



    //mysqli_close($dbc);
    insert_into_group($sid , $course);
}
function insert_into_group($sid , $group)
{
    GLOBAL $dbc;
    GLOBAL $mid;
    GLOBAL $sid;
    GLOBAL $sname;
    GLOBAL $course;
    $table;

    if($course=="algorithm")
        $table = "algorithm";
    else if($course =="database1")
        $table = "database1";
    else if($course == "system_programming")
        $table = "system_programming";
    $table = $mid . $table;
    //echo $sname ." ".$sid;

    require_once('../mysqli_connect.php');
    $query = "INSERT INTO $table (Name, Student_ID )
             VALUES (?,?)";

    $stmt = mysqli_prepare($dbc, $query);

    mysqli_stmt_bind_param($stmt, "ss", $sname, $sid );

    mysqli_stmt_execute($stmt);

    $affected_rows = mysqli_stmt_affected_rows($stmt);


    if(!$affected_rows)
    {

        mysqli_error($dbc);
    }
    else
        mysqli_stmt_close($stmt);

    mysqli_close($dbc);

        $fname = $sid.".txt";
        $myfile = fopen($fname, "w");
        $db =$mid.$course;
        $course = $course;
        fwrite($myfile, $course);
        fwrite($myfile, "\r\n");
        fwrite($myfile, $db);
        fclose($myfile);


        $fname = $mid.".txt";
        $myfile = fopen($fname, "w");
        $db =$mid.$course;
        $course = $course;
        fwrite($myfile, $course);
        fwrite($myfile, "\r\n");
        fwrite($myfile, $db);
        fclose($myfile);

        $fname = $table.".txt";
        $myfile = fopen($fname, "w");

        fwrite($myfile, $sid);
        fclose($myfile);




}
echo "<script> window.location.replace('http://localhost:1234/mentorwindow.php?ID=$mid&&Name=$mname')</script>";


?>

<html>
<body>
<?php
if (isset($_GET['m_name'])  && isset($_GET['m_id'])  )
{
    $m_name = $_GET['m_name'];
    $m_id = $_GET['m_id'];
    echo $m_name;
}
?>
<form action="hudai2.php" method="post">
    <br>
    <b>Become a Mentor</b>
    <br>
    <p id="Be a Mentor of Courses">Courses : <br>
        <input type="hidden" name="m_id" value=<?php echo $m_id; ?>>
	   <input type="hidden" name="m_name" value=<?php echo $m_name; ?>>

        <input type="checkbox" name="crs[]" value="algorithm">Algorithm<br>
        <input type="checkbox" name="crs[]" value="database1"> Database<br>
        <input type="checkbox" name="crs[]" value="system_programming"> System Programming<br><br>
    </p>
    <p> Field of Expertise?<br>
        <input type="radio" name="spcl_fld" value="yes">Yes<br>
        <input type="radio" name="spcl_fld" value="no"> No<br><br>
    </p>
    <input type="submit" name="submit" value="Send" />


</form>
</body>
</html>

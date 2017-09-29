<html>
<head>
<style>
body{
	background-image: url('a.jpg');
	background-size:cover;
}
form{
        position: relative;
        left: 500px;
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
if (isset($_GET['m_name'])  && isset($_GET['m_id'])  )
{
    $m_name = $_GET['m_name'];
    $m_id = $_GET['m_id'];
    //echo $m_name;
}
?>
<form action="hudai2.php" method="post">
    <br>
    <b class="btext" >Become a Mentor</b>
    <br>
    <p class="btext" id="Be a Mentor of Courses">Courses : <br>
        <input type="hidden" name="m_id" value=<?php echo $m_id; ?>>
	   <input type="hidden" name="m_name" value=<?php echo $m_name; ?>>

        <input class="btext" type="checkbox" name="crs[]" value="algorithm">Algorithm<br>
        <input class="btext" type="checkbox" name="crs[]" value="database1"> Database<br>
        <input class="btext" type="checkbox" name="crs[]" value="system_programming"> System Programming<br><br>
    </p>
    <p class="btext" > Field of Expertise?<br>
        <input class="btext" type="radio" name="spcl_fld" value="yes">Yes<br>
        <input class="btext" type="radio" name="spcl_fld" value="no"> No<br><br>
    </p>
    <input class="dimbo" type="submit" name="submit" value="Send" />


</form>
</body>
</html>

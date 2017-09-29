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
<form action="hudai4.php" method="post" enctype="multipart/form-data">
    
    <p> Your Special Fields?<br><br>
		<input type="hidden" name="m_id" value=<?php echo $m_id; ?>>
	    <input type="hidden" name="m_name" value=<?php echo $m_name; ?>>
        <input type="checkbox" name="spclcrs[]" value="algorithm">Algorithm<br>
		What did you achieve in this field?<br>
		<textarea name="textalgorithm" rows="4" cols="50">Enter text here...</textarea><br><br>
        <input type="checkbox" name="spclcrs[]" value="database1">Database<br>
		What did you achieve in this field?<br>
		<textarea name="textdatabase1" rows="4" cols="50">Enter text here...</textarea><br><br>
        <input type="checkbox" name="spclcrs[]" value="system_programming">System Programming<br>
		What did you achieve in this field?<br>
		<textarea name="textsystem_programming" rows="4" cols="50">Enter text here...</textarea><br><br>
    </p>
    <input type="submit" name="submit" value="Send" />


</form>
</body>
</html>

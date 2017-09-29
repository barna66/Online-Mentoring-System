<?php

// Get a connection for the database

require_once('../mysqli_connect.php');
 
// Create a query for the database

$query = "SELECT Name, Student_ID , Batch , Email , Contact_number , Password FROM student";
 
// Get a response from the database by sending the connection
// and the query
$response = @mysqli_query($dbc, $query);
 
// If the query executed properly proceed
if($response){
 
echo '<table align="left"
cellspacing="5" cellpadding="8">
 
<tr><td align="left"><b>Name</b></td>
<td align="left"><b>Student_ID</b></td>
<td align="left"><b>Batch</b></td>
<td align="left"><b>Email</b></td>
<td align="left"><b>Contact_number</b></td>
<td align="left"><b>Password</b></td</tr>';
 
// mysqli_fetch_array will return a row of data from the query
// until no further data is available
while($row = mysqli_fetch_array($response)){
 
echo '<tr><td align="left">' . 
$row['Name'] . '</td><td align="left">' . 
$row['Student_ID'] . '</td>
<td align="left">' . 
$row['Batch'] . '</td>
<td align="left">' . 
$row['Email'] . '</td>
<td align="left">' . 
$row['Contact_number'] . '</td>
<td align="left">' . 
$row['Password'] . '</td>';
 
echo '</tr>';
}
 
echo '</table>';
 
} else {
 
echo "Couldn't issue database query<br />";
 
echo mysqli_error($dbc);
 
}
 
// Close connection to the database
mysqli_close($dbc);
 
?>
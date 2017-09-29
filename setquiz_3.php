<?php
//session_start();
include("groupwindow.php");

$state =  $_SESSION["state"];
if($state==0){

echo "<script> window.location.replace('start.php')</script>";


}
$setter= $_SESSION["id"];
?>
<html>
<head>
<style>
#quiz{
font-size: 1.5em;
        font-weight: bold;

}
body{
	 background-image: url("a.jpg");
       background-size: cover;
     background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center bottom;
        }
textarea
{
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    font-size: 16px;
    resize: none;
    }
</style>
<script type='text/javascript'>
function addFields()
{
    // Number of inputs to create
    var number = document.getElementById("member").value;
    // Container <div> where dynamic content will be placed
    var container = document.getElementById("container");
    // Clear previous contents of the container
    while (container.hasChildNodes())
    {
        container.removeChild(container.lastChild);
    }
    var p=1;
    for (i=0; i<number; i++,p=1)
    {
        // Append a node with a random text

        container.appendChild(document.createTextNode("Question " + (i+1)));

        // Create an <input> element, set its type and name attributes

        var input = document.createElement("input");
        var input2 = document.createElement("input");
        var input3 = document.createElement("input");
        var input4 = document.createElement("input");
        var input5 = document.createElement("input");
        var input6 = document.createElement("input");

        input.type = "textarea";
        input.style = "width : 800px ; height: 100px; background-color: lightgreen;";
        input.name = "question" + (i+1);
        container.appendChild(input);

        container.appendChild(document.createElement("br"));
        container.appendChild(document.createElement("br"));

        container.appendChild(document.createTextNode("Option: " + (i+1)));

        input2.type = "textarea";
        input2.style = "width : 400px ; height: 50px; background-color: lightgreen;";
        input2.name = "op1" + (i+1);
        console.log(input2.name);
        container.appendChild(input2);

        container.appendChild(document.createElement("br"));
        container.appendChild(document.createElement("br"));

        container.appendChild(document.createTextNode("Option:  " + (i+2)));


        input3.type = "textarea";
        input3.style = "width : 400px ; height: 50px; background-color: lightgreen;";
        input3.name = "op2"+ (i+1);
        container.appendChild(input3);

        console.log(input3.name);

	container.appendChild(document.createElement("br"));
	container.appendChild(document.createElement("br"));

	container.appendChild(document.createTextNode("Option:  " + (i+3)));

        input4.type = "textarea";
        input4.style = "width : 400px ; height: 50px; background-color: lightgreen;";
        input4.name = "op3"+(i+1);
        console.log(input4.name);
        container.appendChild(input4);
        // Append a line break
        container.appendChild(document.createElement("br"));
        container.appendChild(document.createElement("br"));

        container.appendChild(document.createTextNode("Correct Answer:"));
         container.appendChild(document.createElement("br"));
        container.appendChild(document.createElement("br"));

        input5.type = "number";
        input5.style = "width : 50px ; height: 50px; background-color: lightgreen;";
        input5.name = "ans"+ (i+1);
        console.log(input5.name);
        container.appendChild(input5);
        // Append a line break
        container.appendChild(document.createElement("br"));
        container.appendChild(document.createElement("br"));

     container.appendChild(document.createTextNode("Difficulty Level:"));
         container.appendChild(document.createElement("br"));
        container.appendChild(document.createElement("br"));

        input6.type = "number";
        input6.style = "width : 50px ; height: 50px; background-color: lightgreen;";
        input6.min="1" ;
        input6.max="3" ;
        input6.step="1";
        input6.name = "DL"+ (i+1);
        console.log(input6.name);
        container.appendChild(input6);
        // Append a line break
        container.appendChild(document.createElement("br"));
        container.appendChild(document.createElement("br"));


    }

    container.appendChild(document.createTextNode("Submit "));
    container.appendChild(document.createElement("br"));
    var butn= document.createElement("BUTTON");


    butn.type = "submit" ;
    butn.name = "submit" ;
    butn.value = "POST";
    butn.style = "width : 50px ; height : 25px; background-color: lightgreen;";

    container.appendChild(butn);
        // Append a line break
        container.appendChild(document.createElement("br"));
        container.appendChild(document.createElement("br"));

}
</script>
</head
<body>

<center>
Number of members:(max. 10)<br />
<input type="textarea" style = "padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: lightgreen;
    font-size: 16px;
    resize: none;"  id="member" name="member" value="">
<button onclick="addFields()">Fill Details</button>
<br><br>
<form action = "load.php?setter=<?php echo $setter ?>" method="POST">

<div id="container"/>
<center>
</form>
</body>
</html>


<html>
<head>
<title>Add Member</title>
<style>
    body{
		background-image: url("a.jpg");
		background-size:cover;
	}
    b{
        font-family: "Broadway", Times, serif;
        font-size: 2.5em;
    }
    form{
        position: relative;
        left: 200px;
    }
    .bText{
        font-family: "Harrington", Times, serif;
        font-size: 1.5em;
        font-weight: bold;
    }
    #memberT{
        font-family: "Harrington", Times, serif;
        font-size: 1.5em;
        font-weight: bold;
    }
    input[type=submit] {
        background-color: rgb(79,32,219);
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        font-family: "Harrington", Times, serif;
        display: inline-block;
        font-size: 2em;
        font-weight: bold;
        margin: 4px 2px;
        border-radius: 50%;
}
</style>
</head>
<body>
<form action="http://localhost:1234/studentadded.php"

method="post" enctype="multipart/form-data">
<br>
<b>Add a New Member</b>
<br>
<p class="bText">Name:
<input type="text" name="Name" size="30" value="" />
</p>
<p class="bText">Student_ID:
<input type="text" name="Student_ID" size="30" value="" />
</p>


 <p class="bText">Batch:
<input type="text" name="Batch" size="10" value="" />
</p>

<p class="bText">Email:
<input type="text" name="Email" size="64" value="" />
</p>

<p class="bText">Contact_number:
<input type="text" name="Contact_number" size="13" value="" />
</p>

<p class="bText">Password:
<input type="password" name="Password" size="20" value="" />
</p>
<div>
<p class="bText"> Upload Profile Picture:
	<input type="file" name="image">
</p>
</div>

<p id="memberT">Member_Type:<br>

<input type="radio" name="Mtype" value="Student" checked>Student<br>
  <input type="radio" name="Mtype" value="Mentor"> Mentor<br>
</p>

<p>
<input type="submit" name="submit" value="Send" />
</p>

</form>
</body>
</html>

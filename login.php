<html>
<head>
<title>Add Student</title>
</head>
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
        left: 500px;
    }
    .dimbo{
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
        padding: 30px 64px;
        text-align: center;
        font-family: "Harrington", Times, serif;
        display: inline-block;
        font-size: 4em;
        font-weight: bold;
        margin: 4px 2px;
        border-radius: 100%;
}
</style>
<body>

<form action="http://localhost:1234/verification.php" method="post">


<p>ID:
<input class = "dimbo" type="text" name="ID" size="30" value="" />
</p>

<p>Password:
<input class = "dimbo" type="password" name="Password" size="20" value="" />
</p>


<p>
<input type="submit" name="submit" value="Send" />
</p>

</form>
</body>
</html>


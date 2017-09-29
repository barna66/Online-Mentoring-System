
<?php
session_start();
$is_true = 0 ;
$ID=0;
$gname;
$course;
$req[0]="";
$req_sid[0]="";
$group[0]="";
$crs[0]="";
$batch[0]="";
$mentor="";
$dbname;

//if ( isset($_GET['groupname']))
//{

    //$ID = $_GET['sid'];
    $ID = $_SESSION["ID"];
    $gname = $_SESSION["groupname"];
     //$dbname =$ID.$gname;

     $_SESSION["id"]= $ID;

    $i = 0;

    $fname = $ID .".txt";

    $myfile = fopen($fname , "r");
    while(!feof($myfile))
    {
        $str = fgets($myfile);
        $str = trim($str);
        $grp = trim($gname);
        if((strcmp($str,$grp))==0)
        {

          $dbname = fgets($myfile);
           $_SESSION["dbname"]= $dbname;
          break;
        }
    }
    fclose($myfile);
    for(;$i < strlen($dbname); $i++){

        if(!($dbname[$i] >= "a" && $dbname[$i] <="z" ))
        {
            $mentor = $mentor . $dbname[$i];
        }
        else break;
    }
    //echo $mentor."<br>";
    if($ID == $mentor)
        $mentor = "You are the mentor of this group\n";
    else{
        require_once('../mysqli_connect.php');
        $query = "SELECT Name  FROM mentor WHERE M_ID = $mentor";
  //      echo $mentor;
         $response = @mysqli_query($dbc, $query);

        if($response)
        {
            $row=mysqli_fetch_array($response);

            $mentor = $row['Name'];
            //echo $mentor;

        }
    }
    $_SESSION["dbname"]=$dbname;
    $_SESSION["gname"]=$gname;
    $_SESSION["ID"]=$ID;

//}

?>

<!DOCTYPE html>
<html>
<head><style>


body{
        background-image: url("a1.jpg"); background-size: cover;
     background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center bottom;
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
padding-bottom: 400px;
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
#srch {
    width: 200px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url('searchicon.png');
    background-size: 40px 40px;
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}


</style>
</head>
<body>


<ul>
<li><a href="ownwindow.php">Home</a></li>


<li><a href="http://localhost:1234/groupwindow.php?sid=<?php echo $ID; ?>&groupname=<?php echo $gname; ?>"><?php echo $gname?></a></li>
<li><a href="http://localhost:1234/forum.php?sid=<?php echo $ID; ?>&dbname=<?php echo $dbname; ?>&groupname=<?php echo $gname; ?>">Forum</a></li>
<li><a href="quiz_view.php?gname=<?php echo $gname; ?>">Quiz</a></li>
<li><a href="setquiz.php?gname=<?php echo $gname; ?>">Set A Quiz</a></li>

<li class="dropdown">
    <a href="#" class="dropbtn">Mentor</a>
        <div class="dropdown-content">

             <?php echo $mentor; ?>

</div>
</li>

<li><form action="search.php"><input id="srch" type="search" name="search" placeholder="Search in forum"/></form></li>
</ul>


</body>
</html>

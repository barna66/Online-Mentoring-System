
<?php


//session_start();
$dbname = "quiz2017algorithm";
// $gname = $_SESSION["gname"];
//$dbname =trim($_SESSION["dbname"]);
//$dbname = "quiz".$dbname;
//$id=trim($_SESSION["id"]);
// $mid = trim($_SESSION["mid"]);
$mid = "2017";

if(isset($_POST['submit2']))
{

    $idx =1;
     require_once('../mysqli_connect.php');
        $tempq = "SELECT id FROM $dbname";
        $resp = @mysqli_query($dbc, $tempq);
        $id=0;
        if($resp)
        {
            $prv_id=0;
            while($rw=mysqli_fetch_array($resp))
            {
                $id=$rw['id'];
            }
        }
        $id++;
    for($idx = 1 ; $idx <= 5 ; $idx++)
    {
        $q = "q".$idx;
        $option1 = $q."a";
        $option2 = $q."b";
        $option3 = $q."c";

        $n="";
        $ques= @$_POST[$q];
        $op1= @$_POST[$option1];
        $op2= @$_POST[$option2];
        $op3= @$_POST[$option3];
        $topic= @$_POST['topic'];
        $date = date("y-m-d");
//      echo $ques ." ".$op1." ".$op2." ".$op3;


        $query = "INSERT INTO $dbname (id,topic,question,option1,option2,option3,M_ID,date) VALUES (?,?,?,?,?,?,?,?)";

        GLOBAL $dbc;
        $stmt = mysqli_prepare($dbc, $query);

        mysqli_stmt_bind_param($stmt, "ssssssss", $id,$topic,$ques,$op1,$op2,$op3,$mid,$date);

        mysqli_stmt_execute($stmt);

        $affected_rows = mysqli_stmt_affected_rows($stmt);



        if( $affected_rows)
            echo "Succesfully inserted\n";
        else
            mysqli_error($dbc);
    }

}
?>


<!DOCTYPE html>
<html>
<head>
<style>
body{
	background-image: url("a.jpg");
    background-size:cover;
}

textarea
{
    width: 800px;
    height: 100px;
    padding: 12px 20px;
box-sizing:
    border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
background-color:
#f8f8f8;
    font-size: 16px;
resize:
    none;
}
</style>
</head>

<body>
<center>
<b>We need to set at least 5 question in a package </b>
</br>
</br>
<form action = "add_question.php" method="POST">
               <b>Topic Name :
               </b> <br/><input type="textarea" name="topic" style= "width : 700px;"></br><br/>
                                     <b>Question : 1 :
                                     </b> <br/>

                                     <textarea name="q1"></textarea></br></br>
                                             <b>Option A</b> <input type="textarea" name="q1a" style= "width : 400px;"></br></br>
                                                     <b>Option B:
                                                     </b> <input type="textarea" name="q1b" style= "width : 400px;"></br></br>
                                                             <b>Option C:
                                                             </b> <input type="textarea" name="q1c" style= "width : 400px;"></br></br>

                                                                     </br>

                                                                     <b>Question : 2 </b> <br/>

                                                                     <textarea name="q2"></textarea></br></br>
                                                                             <b>Option A</b> <input type="textarea" name="q2a" style= "width : 400px;"></br></br>
                                                                                     <b>Option B:
                                                                                     </b> <input type="textarea" name="q2b" style= "width : 400px;"></br></br>
                                                                                             <b>Option C:
                                                                                             </b> <input type="textarea" name="q2c" style= "width : 400px;"></br></br>
                                                                                                     </br>

                                                                                                     <b>Question : 3 </b> <br/>

                                                                                                     <textarea name="q3"></textarea></br></br>
                                                                                                             <b>Option A</b> <input type="textarea" name="q3a" style= "width : 400px;"></br></br>
                                                                                                                     <b>Option B:
                                                                                                                     </b> <input type="textarea" name="q3b" style= "width : 400px;"></br></br>
                                                                                                                             <b>Option C:
                                                                                                                             </b> <input type="textarea" name="q3c" style= "width : 400px;"></br></br>
                                                                                                                                     </br>

                                                                                                                                     <b>Question : 4</b> <br/>

                                                                                                                                     <textarea name="q4"></textarea></br></br>
                                                                                                                                             <b>Option A</b> <input type="textarea" name="q4a" style= "width : 400px;"></br></br>
                                                                                                                                                     <b>Option B:
                                                                                                                                                     </b> <input type="textarea" name="q4b" style= "width : 400px;"></br></br>
                                                                                                                                                             <b>Option C:
                                                                                                                                                             </b> <input type="textarea" name="q4c" style= "width : 400px;"></br></br>
                                                                                                                                                                     </br>

                                                                                                                                                                     <b>Question : 5</b> <br/>

                                                                                                                                                                     <textarea name="q5"></textarea></br></br>
                                                                                                                                                                             <b>Option A</b> <input type="textarea" name="q5a" style= "width : 400px;"></br></br>
                                                                                                                                                                                     <b>Option B:
                                                                                                                                                                                     </b> <input type="textarea" name="q5b" style= "width : 400px;"></br></br>
                                                                                                                                                                                             <b>Option C:
                                                                                                                                                                                             </b> <input type="textarea" name="q5c" style= "width : 400px;"></br></br>
                                                                                                                                                                                                     </br>
                                                                                                                                                                                                     <input type="submit" name="submit2" value="POST">
                                                                                                                                                                                                             </form>

                                                                                                                                                                                                             </center>

                                                                                                                                                                                                             </body>
                                                                                                                                                                                                             </html

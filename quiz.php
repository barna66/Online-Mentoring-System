
<!DOCTYPE html>
<html>
<head>


<style>
textarea
{   width: 800px;
    height: 200px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    font-size: 16px;
    resize: none;
    }
    </style>
    </head>
<body>
<center>
<br/>

<?php
session_start();
if(isset($_POST['submit']))
{
    $correct=0;
   $idx = $_SESSION["number of question"];
    $i=0;
     $ans = $_SESSION["answer_script"];

    for($i=0 ; $i <= $idx-1 ; $i++)
    {
           $given_answer = $_POST[$i];
        if(intval($ans[$i]) == intval($given_answer))
            $correct++;
    }

    echo "you have given ".$correct." correct answers"."<br><br>";

     echo "<a href='quiz_view.php' class='button'>Back to get more quiz</a>";
     //$url = "quiz_view.php";
       //     header("Location:$url");
         //   exit;
}
else
{



$dbname ="quiz".$_SESSION["dbname"];
$id = $_GET['id'];
$question;
$answer;
require_once('../mysqli_connect.php');
echo $id."</br>";
$query = "SELECT question,option1,option2,option3,answer,topic from $dbname where id = $id";
$response = @mysqli_query($dbc, $query);
$idx=0;
$topic;
$pos=0;
$op0=0;$op1=1;$op2=2;

 $rdname;
if($response)
{
    echo "<form action = 'quiz_dup.php' method='POST'>";
    while($row=mysqli_fetch_array($response))
    {
        $topic = $row['topic'];
        $question[$idx] = $row['question'];

        $op1 = $row['option1'];
        $op2 = $row['option2'];
        $op3 = $row['option3'];
        $answer[$idx] = $row['answer'];
        //echo $answer[$idx]."aaaaaaaaaaa".$op1;
        $rdname[$pos] = $pos;
        echo "<textarea style ='text-align:center'>".$question[$idx]."</textarea></br></br>";
        echo "<input type='radio' name= $rdname[$pos] value = 1 >". $op1."</br>";
        echo "<input type='radio' name= $rdname[$pos] value = 2 >". $op2."</br>";
        echo "<input type='radio' name= $rdname[$pos] value = 3 >". $op3."</br>";
        $idx++;
        $pos++;
    }
    $one =0;
    $rwo = 1;
    $_SESSION["answer_script"] =$answer;

    $_SESSION["number of question"] =$idx;
     echo "<input type='submit' name='submit' value = 'post' >";
}

}
?>

</center>
</body>
</html>


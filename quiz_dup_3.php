
<!DOCTYPE html>
<html>
<head>


<style>
textarea
{
    width: 800px;
    height: 200px;
    padding: 12px 20px;
box-sizing:
    border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
background-color:
#e5bda2;
font-family: 'times new roman', Times, serif;
    font-size: 1.2em;
resize:
    none;

}
</style>
</head>
<body>
<center>
<br/>

<?php
//session_start();
include("groupwindow.php");

$state =  $_SESSION["state"];
if($state==0){

echo "<script> window.location.replace('start.php')</script>";


}

function next_to_show($DL)
{
    $op1=$_SESSION["op1"];
    $op2=$_SESSION["op2"];
    $op3= $_SESSION["op3"];


    $is_showed_any = 0;
    $total_ques = $_SESSION["total_ques"];
    $correct = $_SESSION["no of cr_ans"];
    if($total_ques==0)
     {
            $total_ques = -1;
            echo "Correct answer ".$correct."<br>";
            echo "<a href='quiz_view.php' class='button'>GO back for more quizes</a>";
    }
    $que = "question".$DL;
    $question = $_SESSION[$que];
    $id = "idx".$DL;
    $idx = $_SESSION[$id];

    echo $idx." ".$DL."<br>";

    if($idx)
    {
        $_SESSION["cur_DL"]= $DL;
        echo "<br><br><br>";
        echo "<form action = 'quiz_dup.php' method='POST'>";
        echo "<textarea style ='text-align:center ;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: lightgreen;
    font-size: 16px;
    resize: none;'>".$question[$idx-1]."</textarea></br></br>";
        echo "<input type='radio' name= 'q' value = 1 >". $op1[$idx-1]."</br>";
        echo "<input type='radio' name= 'q' value = 2 >". $op2[$idx-1]."</br>";
        echo "<input type='radio' name= 'q' value = 3 >". $op3[$idx-1]."</br>";
        echo "<input type='submit' name='submit' value = 'post' >";
        $idx--;
        $_SESSION[$id] = $idx;
        $total_ques--;


        $_SESSION["total_ques"]=  $total_ques;
    }
    else if($idx ==0 && $total_ques!=-1)
    {
       //echo $id." ".$DL."<br>";


        if($DL==1)
            $DL = 2;
        else if($DL==2)
            $DL = 3;

        next_to_show($DL);
    }

}
if(isset($_POST['submit']))
{


    $correct = $_SESSION["no of cr_ans"];

    $dl =$_SESSION["cur_DL"];

    $ans = "answer_script".$dl;
    $ans = $_SESSION[$ans];

    $idx = "idx".$dl;
    $idx = $_SESSION[$idx];

    for($i=1; $i<=3 ; $i++)
    {
        if( $_POST["q"]==$i)
        {
            $given_answer = $i;

            if(intval($ans[$idx]) == intval($given_answer))
                $correct++;

            if($correct == $_SESSION["no of cr_ans"]){
                $dl = $_SESSION["cur_DL"]-1;
                if($dl < 1)
                    $dl = 1;
                }
	    else{
		 $dl++;
		 if($dl > 3)
		     $dl=3;
	    }
            $_SESSION["no of cr_ans"]=$correct;
            break;
        }
    }

    //echo "adsds";
    next_to_show($dl);
}
else
{

    //echo "***adsds";
    $dbname ="quiz".$_SESSION["dbname"];
    $id = $_GET['id'];
    $question1;
    $question2;
    $question3;
    $answer1;
    $answer2;
    $answer3;
    require_once('../mysqli_connect.php');
    //echo $id."</br>";
    $query = "SELECT question,option1,option2,option3,answer,topic,DL from $dbname where id = $id";
    $response = @mysqli_query($dbc, $query);
    $idx1=0;
    $idx2=0;
    $idx3=0;
    $topic;
    $pos=0;
    $tot_ques=0;
    $op1;
    $op2;
    $op3;
    $arr_DL;
    $first_DL=0;
    for($i=0 ; $i<=100 ; $i++)
        $is_shown[$i]=0;
    $rdname;
    if($response)
    {
        echo "<form action = 'quiz_dup.php' method='POST'>";
        while($row=mysqli_fetch_array($response))
        {
            $topic = $row['topic'];
            //$question[$idx] = $row['question'];


            if($row['DL'] == 1)
            {

                $op1[$idx1] = $row['option1'];
                echo $op1[$idx1];
                $op2[$idx1] = $row['option2'];
                 echo $op2[$idx1];
                $op3[$idx1] = $row['option3'];
                 echo $op3[$idx1];
                $answer1[$idx1] = $row['answer'];
                $arr_DL[$idx1] = $row['DL'];
                $question1[$idx1]= $row['question'];
                $idx1++;
                if($first_DL < 1)
                $first_DL=1;

            }
            if($row['DL'] == 2)
            {

                $op1[$idx2] = $row['option1'];
                $op2[$idx2] = $row['option2'];
                $op3[$idx2] = $row['option3'];
                $answer2[$idx2] = $row['answer'];
                $arr_DL[$idx2] = $row['DL'];
                $question2[$idx2]= $row['question'];
                $idx2++;
                if($first_DL < 2)
                $first_DL=2;
            }
            if($row['DL'] == 3)
            {

                $op1[$idx3] = $row['option1'];
                $op2[$idx3] = $row['option2'];
                $op3[$idx3] = $row['option3'];
                $answer3[$idx3] = $row['answer'];
                $arr_DL[$idx3] = $row['DL'];
                $question3[$idx3]= $row['question'];
                $idx3++;
                if($first_DL < 3)
                $first_DL=3;
            }

            $tot_ques++;
        }
        $correct= 0;

        $_SESSION["total_ques"] =$tot_ques;
        $_SESSION["answer_script1"] =$answer1;
        $_SESSION["answer_script2"] =$answer2;
        $_SESSION["answer_script3"] =$answer3;

        $_SESSION["no of cr_ans"]=$correct;

        $_SESSION["idx1"]= $idx1;
        $_SESSION["idx2"]= $idx2;
        $_SESSION["idx3"]= $idx3;

        $_SESSION["is_shown"]= $is_shown;
        $_SESSION["arr_DL"]= $arr_DL;

        $_SESSION["question1"]= $question1;
        $_SESSION["question2"]= $question2;
        $_SESSION["question3"]= $question3;

        $_SESSION["op1"]= $op1;
        $_SESSION["op2"]= $op2;
        $_SESSION["op3"]= $op3;
        $one = 1;

        next_to_show($first_DL);

    }



}
?>

</center>
</body>
</html>


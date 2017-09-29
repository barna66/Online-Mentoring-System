
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
#f8f8f8;
    font-size: 16px;
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
function next_to_show($DL)
{
    $op11=$_SESSION["op11"];
    $op21=$_SESSION["op21"];
    $op31= $_SESSION["op31"];

     $op12=$_SESSION["op12"];
    $op22=$_SESSION["op22"];
    $op32= $_SESSION["op32"];

     $op13=$_SESSION["op13"];
    $op23=$_SESSION["op23"];
    $op33= $_SESSION["op33"];




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
    //$opidx = "idx"."$DL"
   //echo $idx." ".$DL."<br>";

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



 //echo $op1." ".$op2." ".$op3." ".$idx."<br>";
if($DL == 1){

        echo "<input type='radio' name= 'q' value = 1 >". $op11[$idx-1]."</br>";
        echo "<input type='radio' name= 'q' value = 2 >". $op21[$idx-1]."</br>";
        echo "<input type='radio' name= 'q' value = 3 >". $op31[$idx-1]."</br>";
        echo "<input type='submit' name='submit' value = 'post' >";}
        if($DL==2)
        {
            echo "<input type='radio' name= 'q' value = 1 >". $op12[$idx-1]."</br>";
        echo "<input type='radio' name= 'q' value = 2 >". $op22[$idx-1]."</br>";
        echo "<input type='radio' name= 'q' value = 3 >". $op32[$idx-1]."</br>";
        echo "<input type='submit' name='submit' value = 'post' >";
        }

        if($DL==3)
        {
             echo "<input type='radio' name= 'q' value = 1 >". $op13[$idx-1]."</br>";
        echo "<input type='radio' name= 'q' value = 2 >". $op23[$idx-1]."</br>";
        echo "<input type='radio' name= 'q' value = 3 >". $op33[$idx-1]."</br>";
        echo "<input type='submit' name='submit' value = 'post' >";
        }
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
    $question1[0]=0;
    $question2[0]=0;
    $question3[0]=0;
    $answer1[0]=0;
    $answer2[0]=0;
    $answer3[0]=0;
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
    $op11[0]=0;
    $op21[0]=0;
    $op31[0]=0;

    $op12[0]=0;
    $op22[0]=0;
    $op32[0]=0;

    $op13[0]=0;
    $op23[0]=0;
    $op33[0]=0;
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

                $op11[$idx1] = $row['option1'];
                $op21[$idx1] = $row['option2'];
                $op31[$idx1] = $row['option3'];
                $answer1[$idx1] = $row['answer'];
                $arr_DL[$idx1] = $row['DL'];
                $question1[$idx1]= $row['question'];
                // echo $op11[$idx1]." ".$op21[$idx1]." ".$op31[$idx1]."<br>";

                $idx1++;
                if($first_DL < 1)
                $first_DL=1;


            }
            if($row['DL'] == 2)
            {

                $op12[$idx2] = $row['option1'];
                $op22[$idx2] = $row['option2'];
                $op32[$idx2] = $row['option3'];
                $answer2[$idx2] = $row['answer'];
                $arr_DL[$idx2] = $row['DL'];
                $question2[$idx2]= $row['question'];
                $idx2++;
                if($first_DL < 2)
                $first_DL=2;
                //echo $op12[$idx2-1]." ".$op22[$idx2-1]." ".$op32[$idx2-1]."<br>";

            }
            if($row['DL'] == 3)
            {

                $op13[$idx3] = $row['option1'];
                $op23[$idx3] = $row['option2'];
                $op33[$idx3] = $row['option3'];
                $answer3[$idx3] = $row['answer'];
                $arr_DL[$idx3] = $row['DL'];
                $question3[$idx3]= $row['question'];
                $idx3++;
                if($first_DL < 3)
                $first_DL=3;
               // echo $op13[$idx3-1]." ".$op23[$idx3-1]." ".$op33[$idx3-1]."<br>";

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

        $_SESSION["op11"]= $op11;
        $_SESSION["op21"]= $op21;
        $_SESSION["op31"]= $op31;

        $_SESSION["op12"]= $op12;
        $_SESSION["op22"]= $op22;
        $_SESSION["op32"]= $op32;

        $_SESSION["op13"]= $op13;
        $_SESSION["op23"]= $op23;
        $_SESSION["op33"]= $op33;


        $one = 1;

        next_to_show($first_DL);

    }



}
?>

</center>
</body>
</html>


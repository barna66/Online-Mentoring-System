<?php


include("groupwindow.php");
$gname = $_SESSION["dbname"];
//$dbname = "quiz2017algorithm";
 //$gname = $_SESSION["dbname"];
$dbname =trim($_SESSION["dbname"]);
$dbname = "quiz".$dbname;
//$id=trim($_SESSION["id"]);
 $mid =  $_GET["setter"];
//$mid = "2017";

if(isset($_POST['submit']))
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
    for($idx = 1 ; $idx <= 20 ; $idx++)
    {
        $q = "question".$idx;
        $option1 = "op1".$idx;
        $option2 = "op2".$idx;
        $option3 = "op3".$idx;
        $answer = "ans".$idx;
        $dl = "DL".$idx;
        //echo $answer;
        $n="";
        if(!($ques= @$_POST[$q]))
            break;
        $op1= @$_POST[$option1];
        $op2= @$_POST[$option2];
        $op3= $_POST[$option3];
        $dl = $_POST[$dl];
        $answer= intval($_POST[$answer]);
       // $topic= @$_POST['topic'];
       $topic= "algo";
        $date = date("y-m-d");
      //echo $ques ." ".$op1." ".$op2." ".$op3;
    //echo $id."<br> ".$topic." <br>".$ques."<br> ".$op1."<br>".$op2."<br>".$op3."<br> ".$mid." ".$date." ".$answer." ".$dl;


        $query = "INSERT INTO $dbname (id,topic,question,option1,option2,option3,answer,M_ID,date,DL) VALUES (?,?,?,?,?,?,?,?,?,?)";


        $stmt = mysqli_prepare($dbc, $query);

        mysqli_stmt_bind_param($stmt, "ssssssssss", $id,$topic,$ques,$op1,$op2,$op3,$answer,$mid,$date,$dl);

        mysqli_stmt_execute($stmt);

        $affected_rows = mysqli_stmt_affected_rows($stmt);



       // if( $affected_rows)
           // echo "Succesfully inserted\n";
        //else
            mysqli_error($dbc);



    }

 	echo "<form action = 'setquiz.php' method='POST'>";
	echo "<input type='submit' name='submit' value = 'Upload Another Set of Quiz' >";

}
?>


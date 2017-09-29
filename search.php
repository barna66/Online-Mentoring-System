<?php
include("groupwindow.php");
$topic = $_GET['search'];
//echo $topic;


require_once('../mysqli_connect.php');
$query= "SELECT Table_Name from all_tables";
$response = @mysqli_query($dbc, $query);
if($response)
{
    while($row=mysqli_fetch_array($response))
    {
        $table = $row['Table_Name'];
        $query2= "SELECT content ,id from $table";
        $response2 = @mysqli_query($dbc, $query2);
         //echo "gdhjehe";
        if($response2)
        {
             //echo "nnfjjjfoe";
            while($row2=mysqli_fetch_array($response2))
            {
                // echo "gdhjehe";
                $content = $row2['content'];
                $positions = KMP($content, $topic);
                $idx = $row2['id'];
                  //echo "gdhjehe";
                if($positions[0] != 0)
                {

                    //echo "gdhjehe";
                    $link = "topic.php?id=$idx";
                    $link_name = "topic ".$idx;
                    echo "<div style='position:relative;left: 300px;top:50px;font-size:30px'>Search Result:</div>";
                    echo " <a  style='position:relative;left: 600px;top:50px;font-size:30px' href=$link >$link_name</a>";
                }
            }

        }


    }
}

function failure_function($pattern)
{
    $len = strlen($pattern);
    $F[0] = $F[1] = 0;
    for($index = 2; $index <= $len; $index++)
    {
        $previous = $F[$index - 1];
        while(true)
        {
            if($pattern[$previous] == $pattern[$index - 1])
            {
                $F[$index] = $previous + 1;
                break;
            }
            else if($previous != 0) $previous = $F[$previous];
            else
            {
                $F[$index] = 0;
                break;
            }
        }
    }

    return $F;
}


function KMP($text, $pattern)
{
    $F = failure_function($pattern);
    $text_length = strlen($text);
    $pattern_length = strlen($pattern);


    $occurrence = array(0);
    if($pattern_length > $text_length) return $occurrence;

    for($ti = $pid = 0; $ti < $text_length; $ti++)
    {
        while(true)
        {
            if($text[$ti] == $pattern[$pid])
            {
                $pid++;
                if($pid == $pattern_length)
                {
                    $occurrence[0]++;
                    $occurrence[$occurrence[0]] = $ti - $pattern_length + 1;
                    $pid = $F[$pid];
                }

                break;
            }
            else if($pid != 0) $pid = $F[$pid];
            else break;
        }
    }

    return $occurrence;
}

$stringText = "aaa.... darao.. hahahaha... hahahhahahahahaha...hahhahahhahaha.. ya habiby.. habibi.. bi.";
$stringPattern = "ha";

$positions = KMP($stringText, $stringPattern);
foreach($positions as $x)
//echo $x . " ";
?>


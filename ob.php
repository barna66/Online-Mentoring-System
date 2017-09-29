<?php
echo "<html><head><style>body{background-image: url('a.jpg');background-size:cover;}</style></head><body></body></html>";
$dbc;
$sname;
class Observer
{
    private $query;
    private $response;
    private $mentor;
    private $batch;
    private $idx=-1;

    public function __construct()
    {
        GLOBAL $dbc;
        //GLOBAL $response;
        require_once('../mysqli_connect.php');
        $this->query = "SELECT M_ID FROM mentor";
        $this->response = @mysqli_query($dbc, $this->query);
        $this->fetch();

    }
    private function fetch()
    {

        while(($row=mysqli_fetch_array($this->response)))
        {
            $this->idx++;
            $this->mentor[$this->idx]=$row['M_ID'];


        }
    }
    public function update($mid , $sid , $cid)
    {
        $bool = 'FALSE';
        GLOBAL $sname;
        echo $sname;
        while($this->idx>= 0)
        {

            if($this->mentor[$this->idx] == $mid)
            {
                GLOBAL $dbc;

                $query = "INSERT INTO request_from_student ( Mentor_ID , Course_ID , Student_ID , Bool )VALUES (?,?, ? ,? )";
                echo $mid." ".$cid." ".$sid." ".$bool;
                $stmt = mysqli_prepare($dbc, $query);

                mysqli_stmt_bind_param($stmt, "ssss",  $mid,  $cid , $sid ,$bool);

                mysqli_stmt_execute($stmt);

                $affected_rows = mysqli_stmt_affected_rows($stmt);

                if($affected_rows != 1)
                {
                    echo 'Error Occurred<br />';
                    echo mysqli_error();
                    mysqli_stmt_close($stmt);

                mysqli_close($dbc);

                }
                else
                    echo "<h3>Your request to mentor has been sent </h3>";


                mysqli_stmt_close($stmt);

                mysqli_close($dbc);

                echo "<script> window.location.replace('http://localhost:1234/ownwindow.php?ID=$sid&Name=$sname')</script>";


            }
            $this->idx--;
        }
    }

}
class Subject
{
    private $query;
    private $response;
    private $mentor;
    private $batch;
    private $idx=-1;
    private $MyObserver;

    public function attach($observer)
    {
        $this->MyObserver = $observer;
    }

    public function change_state($mid , $sid , $cid)
    {

        //echo $mid ." ".$sid." " .$cid."<br/>";
        //$s_mentr = $mi
        $s_mentr = fopen("s_mentr.txt", "w") or die("Unable to open file!");
        $txt = $sid." ".$mid." ".$cid;
        fwrite($s_mentr, $txt);
        fclose($s_mentr);
         $this->notify($mid , $sid , $cid);

    }
    public function notify($mid , $sid ,$cid)
    {
         $this->MyObserver->update($mid , $sid , $cid);
    }
}
if (isset($_GET['crs']))
{
    $cid = $_GET['crs'];
    $sid= $_GET['sid'];
    $observer1 = new Observer();
    $mid= $_GET['mid'];
    $sname = $_GET['sname'];
    //echo $mid ." ".$sid." " .$cid."<br/>";
    $subject = new Subject();
    $subject->attach($observer1);
    $subject->change_state($mid , $sid , $cid);
}

?>

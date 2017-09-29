<?php
$is_true = 0 ;
$ID = " " ;
$Password = " ";
//$query1; $query2 ; $response1 ; $response2;

class myiterator{
    private  $response, $row;
    public function __construct($response)
    {
        $this->response = $response;
    }
    public function hasNextrow()
    {
        if ($this->row = mysqli_fetch_array($this->response))
        {

            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
   public function getNextSID()
    {
        //echo $this->row['S_ID']."  sss </br>";

        return $this->row['S_ID'];
    }
    public function getNextMID()
    {
        return $this->row['M_ID'];
    }
    public function getNextPassword()
    {
        return $this->row['Password'];
    }
    public function getNextName()
    {
        return $this->row['Name'];
    }
}

if (isset($_POST['ID']) && isset($_POST['Password']))
{

    $is_true=0;
    $ID = $_POST['ID'];
    $Password = $_POST['Password'];

    require_once('../mysqli_connect.php');
    $query1 = "SELECT S_ID,Password,Name FROM student";
    $response1 = @mysqli_query($dbc, $query1);

    $query2 = "SELECT M_ID,Password,Name FROM mentor";
    $response2 = @mysqli_query($dbc, $query2);

    function check($id , $password)
    {

//echo $id . " ccc " . $password."</br>";
    GLOBAL $ID ,$Password;

        if($id == $ID  && $Password == $password)
        {
            $is_true = 1;
            return 1;
        }

    }


    //Iterator my_Iterator ;
    if($response1)
    {
        $my_Iterator = new myiterator($response1);
        //iterator($response1 , $S_ID  );
        while($my_Iterator->hasNextrow())
        {
            $id = $my_Iterator->getNextSID();
            $password = $my_Iterator->getNextPassword();
            if(check($id , $password))
            {
                $Name = $my_Iterator->getNextName();                echo "<script> window.location.replace('http://localhost:1234/ownwindow.php?ID=$ID&Password=$Password&Name=$Name&Flag=1')</script>";


            }

        }
    }
    else
    {

        echo 'Couldn\'t issue database query<br />';

        echo mysqli_error($dbc);

    }

    if($response2)
    {
        $my_Iterator = new myiterator($response2);
        while($my_Iterator->hasNextrow())
        {
            $id = $my_Iterator->getNextMID();
            $password = $my_Iterator->getNextPassword();
            if(check($id , $password))
            {
                $Name = $my_Iterator->getNextName();
                echo "<script> window.location.replace('http://localhost:1234/ownwindow.php?ID=$ID&Password=$Password&Name=$Name&Flag=0')</script>";

            }

        }
    }
    else
    {

        echo 'Couldn\'t issue database query<br />';

        echo mysqli_error($dbc);

    }


    if($is_true != 1)
    {
        echo 'Wrong ID or password<br />';
    }

    mysqli_close($dbc);


}


// Close connection to the database

?>

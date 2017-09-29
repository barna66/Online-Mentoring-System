<html>
<head>
<title>Add Student</title>
</head>
<body>
<?php

$dbc;
class StrategyContext {
    private $strategy = NULL; 
    public function __construct($entryType) {
        switch ($entryType) {
            case "1": 
                $this->strategy = new StrategyStudent();
            break;
            case "0": 
                $this->strategy = new StrategyMentor();
            break;
        }
    }
	private $name;
	private $d_id;
    public function getUrl($name,$d_id) {
		$this->$name = $name;
		$this->d_id = $d_id;
		return $this->strategy->returnUrl($name,$d_id);
    }
}
interface StrategyInterface {
    public function returnUrl($name,$d_id);
}
 
class StrategyStudent implements StrategyInterface {
		private $name;
		private $d_id;
    public function returnUrl($name,$d_id) {
		$this->$name = $name;
		$this->d_id = $d_id;
        $URL = "http://localhost:1234/student_login.php?s_name=$name&ns_id=$d_id";
        return $URL;
    }
}

class StrategyMentor implements StrategyInterface {
		private $name;
		private $d_id;
		
    public function returnUrl($name,$d_id) {
		$this->$name = $name;
		$this->d_id = $d_id;
        $URL = "http://localhost:1234/mentor.php?m_name=$name&m_id=$d_id";
        return $URL;
    }
}

class SingletonObj
{
    private static $obj = NULL;
    private static $isGiveObj = FALSE;
    private function __construct()
    {
    }

    static function pass_singleton_obj()
    {
        if (FALSE == self::$isGiveObj)
        {
            if (NULL == self::$obj)
                self::$obj =new SingletonObj();

            self::$isGiveObj = TRUE;
            return self::$obj;
        }
        else
        {
            return NULL;
        }
    }

    function returnObj(SingletonObj $obj)
    {
        self::$isGiveObj = FALSE;
    }
    function CreateObj($is_stud,$name ,$id ,$batch,$email ,$cn , $pss ,$d_id,$image,$target)
    {
        GLOBAL $dbc;
	    $dest = "C:/xampp/htdocs/photos/".basename($_FILES['image']['name']);

        $isPic=0;
        require_once('../mysqli_connect.php');
        if($is_stud == 1)

            $query = "INSERT INTO student (Name, Student_ID , Batch , Email , Contact_number , Password ,S_ID, Image)
                     VALUES (?,?,?,?,?,?,?,?)";
        else if($is_stud == 0)
            $query = "INSERT INTO mentor (Name, Mentor_ID , Batch , Email , Contact_number , Password ,M_ID, Image)
                     VALUES (?,?,?,?,?,?,?,?)";


        $stmt = mysqli_prepare($dbc, $query);

        mysqli_stmt_bind_param($stmt, "ssssssss", $name, $id , $batch , $email , $cn , $pss , $d_id, $image);

        mysqli_stmt_execute($stmt);

        $affected_rows = mysqli_stmt_affected_rows($stmt);

        if($affected_rows == 1)
        {
            if($is_stud == 1)
            {
                echo 'A Student Entered';

                $msg = "You have enrolled as a student in online mentoring System</br>";
            }
            else
            {
                echo 'A Mentor Entered';

                $msg = "You have joined as a mentor in online mentoring System</br>";
            }
            mail($email,"subject",$msg);
		 if(move_uploaded_file($_FILES['image']['tmp_name'],$dest))
		{
			$isPic=1;
		}
		else{
			echo "There was a problem uploading image"; 
		}

            mysqli_stmt_close($stmt);

            mysqli_close($dbc);
			
		$Context;
		if($is_stud == 1)
            {
				$Context = new StrategyContext('1');
}
		else{
			$Context = new StrategyContext('0');
		}
		$url=$Context->getUrl($name,$d_id);
            header("Location:$url");
            exit;
        }



        else
        {

            echo 'Error Occurred<br />';
            echo mysqli_error($dbc);

            mysqli_stmt_close($stmt);

            mysqli_close($dbc);

        }


    }
}
class student
{
}
class mentor
{
}
class factory
{
    private $query;
    private $response;
    private $is_stud;
    private $name ;
    private $id ;
    private $batch ;
    private $email ;
    private $cn  ;
    private $pss ;
    private $image;
    private $d_id;
    private $target;
    public function __construct()
    {
        GLOBAL $dbc;
        GLOBAL $response;
        require_once('../mysqli_connect.php');

    }

    function load($is_stud,$name ,$id ,$batch,$email ,$cn , $pss ,$d_id,$image,$target)
    {
        $this->name = $name;
        $this->is_stud = $is_stud;
        $this->id = $id;
        $this->batch = $batch;
        $this->email = $email;
        $this->cn = $cn;
        $this->pss = $pss;
	   $this->image=$image;
        $this->d_id = $d_id;
        $this->target = $target;
    }
    function store()
    {
        $sobj =   SingletonObj::pass_singleton_obj();
        $sobj->CreateObj($this->is_stud,$this->name ,$this->id ,$this->batch,$this->email ,$this->cn , $this->pss ,$this->d_id,$this->image,$this->target);
        $sobj->returnObj($sobj);
    }


}
if(isset($_POST['submit']) )
{
    $target = "photos/".basename($_FILES['image']['name']);
    $is_stud=0;
    if($_POST['Mtype']=='Student')
        $is_stud = 1;
    $name = trim($_POST['Name']);
    $id = trim($_POST['Student_ID']);
    $batch = trim($_POST['Batch']);
    $email = trim($_POST['Email']);
    $cn  = trim($_POST['Contact_number']);
    $pss = trim($_POST['Password']);
    $image = $_FILES['image']['name'];
    $d_id = $batch . $id;

    $MyFactory = new Factory();
    $MyFactory->load($is_stud,$name ,$id ,$batch,$email ,$cn , $pss,$d_id,$image,$target);
    $MyFactory->store();



}

?>
</body>
</html>


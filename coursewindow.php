<?php
$course_name;
$dbc;
$ID;
$sname;
class mentor
{
    private $query;
    private $response;
    private $mentor;
    private $batch;
    private $idx=0;
    private $mid;
    public function __construct($table)
    {
        GLOBAL $dbc;
        GLOBAL $response;
        require_once('../mysqli_connect.php');
        $this->query = "SELECT Name  ,Mentor_ID FROM $table";
        $this->response = @mysqli_query($dbc, $this->query);
        $this->fetch();

    }
    private function fetch()
    {

        while(($row=mysqli_fetch_array($this->response)))
        {

            $this->mentor[$this->idx]=$row['Name'];
            $this->mid[$this->idx]=$row['Mentor_ID'];
            $this->idx++;

        }
    }

    public function HasMentorList()
    {
        if($this->idx >= 0)
            return true;
        else false;
    }
    public function MentorList()
    {
            $this->idx--;

        if($this->idx >=0)
        {
            return $this->mentor[$this->idx];
        }

    }
    public function batchlist()
    {


        if($this->idx >=0)
        {
            return $this->batch[$this->idx];
        }
    }
    public function prevM()
    {
        if($this->idx >=0)
        {
        return $this->mentor[$this->idx];
        }
    }

     public function mid()
    {
       // echo $this->mid[$this->idx];
        $index = ($this->idx) ;
        if($index >=0)
        return $this->mid[$index];
    }
}

if (isset($_GET['course'])   )
{
    $table;
    $sname = $_GET['sname'];
    $course_name = $_GET['course'];
    echo "<b style = 'font-size:25px;'>Welcome to ".$course_name." course</b><br/><br/> ";
    if($course_name=="algorithm")
        $table = "algorithm";
    else if($course_name =="database1")
        $table = "database1";
    else if($course_name == "system_programming")
        $table = "system_programming";
        $MentorList2 = new mentor($table);
$MentorList = new mentor($table);

    $ID = $_GET['id'];

}
else
{

    echo"<b>return back</b> ";
}
function go()
{
    echo"</br></br><b>go and return back</b> ";
}

?>


<!DOCTYPE html>
<html>
<head>
<style>

#choose {
    width: 130px;
    box-sizing: border-box;
    font-size: 16px;
    background-color: #333;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}

 body{
	 background-image: url("a2.jpg");
    background-size: cover;
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
</style>
</head>
<body>
<section>

<ul>

<li><a href="#home"> About the course </a></li>
<li class="dropdown">
    <a href="#" class="dropbtn1">Mentor</a>
        <div class="dropdown-content">

            <?php

                while ($MentorList->HasMentorList())
            {
                    $flag2=0;

                     $link_name = $MentorList->MentorList();
                      $id = $MentorList->mid();
                    $link = "publicWindow.php?ID=$id&Name=$link_name&flag=$flag2";

                    echo " <a href=$link >$link_name</a><br>";
            }

?>
<li class="dropdown2">
    <a href="#" class="dropbtn2">Send Request</a>
    </li>
    <li>
        <div id="choose" class="dropdown-content2">

            <select name="Mentor" id="mentor"  onchange="object(this.value);">
            <option  value="Choose" >Choose</option>


            <?php

                while ($MentorList2->HasMentorList())
                {
                    $mentr = $MentorList2->MentorList();
                    $mid = $MentorList2->mid();
                    ?>

                     <?php if($mid != null): ?>
                    <option value="<?php echo $mid; ?>"><?php echo $mentr;
                    ?></option>
                     <?php endif; ?>
                    <?php
            } ?>


</select>
</div>

<script>
function object(id){
 window.location.replace('http://localhost:1234/ob.php?sname=<?php echo $sname; ?>&sid=<?php echo $ID; ?>&crs=<?php echo $course_name; ?>&mid='+id);
}

</script>
</li>
</ul>
</section>

</body>
</html>

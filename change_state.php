
<?php
session_start();
//$_SESSION["state"] = 0;

interface State
{
    public function doAction($context,$state);
}

class StartState implements State
{
    private $state ;
    public function doAction($context , $stat)
    {
        //echo $stat;
        $this->state = $stat;
        $context->setState($stat);
    }
}


class StopState implements State
{
    private $state ;
    public function doAction($context , $stat)
    {
        //echo $stat;
        $this->state = $stat;
        $context->setState($stat);
    }

}
class Context
{
    private $state;
    public function __construct()
    {
        $this->state = null;
    }
    public function setState($state)
    {

        $this->state = $state;
        $_SESSION['state']=$this->state;
    }

}


$context = new Context();
$startState = new StartState();

$stopState = new StopState();

$cur_state= $_SESSION['state'];
if($cur_state==1)
{
    $stopState->doAction($context,0);
    echo "<script> window.location.replace('start.php')</script>";

}


if($cur_state==0)
{
    $startState->doAction($context,1);


    echo "<script> window.location.replace('ownwindow.php')</script>";
}





?>

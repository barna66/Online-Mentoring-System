

/*<html>
<body>

<form action="http://localhost:1234/ownwindow.php" method="post" enctype="multipart/form-data">
    <p>File:
    <input type="file" name="image"/></p> <p> <input type ="submit" value="Upload" name="Upload" />
    </p>
</form>



<?php


if(isset($_POST['Upload']))
{

require_once('../mysqli_connect.php');
     echo "Please select an image.";

    $file = $_FILES['image']['tmp_name'];

    if(!isset($file))
        echo "Please select an image.";
    else
    {

        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

        $image_name = addslashes($_FILES['image']['name']);
        $image_size = getimagesize($_FILES['image']['tmp_name']);

        if($image_size == FALSE)
            echo "That's not an image.";
        else
        {
            //if(!$insert = mysql_query("UPDATE student SET Photo = $image WHERE S_ID = 1312" ))
              //  echo "Problem uploading image.";
              $query="UPDATE student SET Photo = $image WHERE S_ID = 1312";
                $stmt = mysqli_prepare($dbc, $query);


            mysqli_stmt_execute($stmt);

            $affected_rows = mysqli_stmt_affected_rows($stmt);
                if($affected_rows != 1)
            echo "Problem uploading image.";

            else
            {
                 echo 'hi';
                echo "Image uploaded.<p/>Yout image:<p/><img src=http://localhost:1234/getimage.php?ID=$ID";
            }
        }
         echo '**hi';
    }
}
?>
</body>
</html>
*/

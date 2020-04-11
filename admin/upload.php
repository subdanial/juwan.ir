<?php
session_start();
if(@$_SESSION['isAdmin'] != true){
    header("location:login.php");
    die();
  }
?>
<?php
include('autoload.php');
$database = new Database();
?>

<?php
  if(!empty($_FILES['uploaded_file']))
  {
    $path = "../assets/img/home/";
    $path = $path .rand(1,100000) . basename( $_FILES['uploaded_file']['name']) ;
    $id = $_POST['id'];
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
     
    $database->category_update($id,'image',explode("..",$path)[1]);

    header("Location: index.php?upload=1");

    } else{
      header("Location: index.php?upload=0");
    }
  }

?>
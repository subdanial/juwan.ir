


<?php
session_start();
if(@$_SESSION['isAdmin'] != true){
    header("location:login.php");
    die();
  }
?>


<?php include('autoload.php');
$database=new Database();


if (isset($_POST['updatepostions'])) {
   foreach($_POST['positions'] as $position) {
      $index=$position[0];
      $newPosition=$position[1];
      $database->category_update_ordering($newPosition, $index);
   }

   exit('success');
}

if (isset($_POST['rename'])) {
   $database->category_update($_POST['id'], 'name', $_POST['value']);
   exit('success');
}

if(isset($_POST['remove'])){
   $database->product_remove($_POST['product_id']);
   exit('success');
}

if(isset($_POST['remove_image'])){
   var_dump($database->image_remove($_POST['remove_image']));
}
?>
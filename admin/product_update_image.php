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
$id = $_POST['product_id'];
$images_parameter = [];
$total = count($_FILES['image']['name']);

for( $i=0 ; $i < $total ; $i++ ) {
  $tmpFilePath = $_FILES['image']['tmp_name'][$i];
  if ($tmpFilePath != ""){
    $newFilePath = "../uploads/img/" . rand(1000,1000000000) . $_FILES['image']['name'][$i];
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {

      array_push($images_parameter,"\"http://".$_SERVER['HTTP_HOST'].implode(explode("..",$newFilePath))."\"");
      
    }
  }
}

$images_parameter = "[" . implode(",",$images_parameter) . "]";
$db = $database->image_add($id,$images_parameter);
if($db){
  header("location:"."http://".$_SERVER['HTTP_HOST']."/admin/product_edit.php?item=".$id);
}
?>
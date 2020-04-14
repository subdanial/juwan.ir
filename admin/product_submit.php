
<?php
include('autoload.php');
$database = new Database();



$code  = $_POST['code'];
$name =  $_POST['name'];
$brand = $_POST['brand'];
$style = $_POST['style'];
$price = $_POST['price'];
$material = $_POST['material'];
$category_id = $_POST['category_id'];
$colors =  ($_POST['colors']);
$sizes =  ($_POST['sizes']);
$images = ($_FILES['image']);

$images_parameter = [];
$colors_parameter = [];
$sizes_parameter = [];



$total = count($_FILES['image']['name']);

if(!$database->is_product_exist($code)){



  for( $i=0 ; $i < $total ; $i++ ) {
  $tmpFilePath = $_FILES['image']['tmp_name'][$i];

  if ($tmpFilePath != ""){
    $newFilePath = "../uploads/img/" . rand(100000,10000000).$_FILES['image']['name'][$i];
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
      array_push($images_parameter,"\"http://".$_SERVER['HTTP_HOST'].implode(explode("..",$newFilePath))."\"");
    
    }
  }
}




$images_parameter = "[" . implode(",",$images_parameter)."]";
foreach(explode(",",$colors) as $color){
  array_push($colors_parameter,"\"".$color."\"");
}
$colors_parameter = "[" . implode(",",$colors_parameter) ."]";


foreach(explode(",",$sizes) as $size){
  array_push($sizes_parameter,"\"".$size."\"");
}
$sizes_parameter = "[" . implode(",",$sizes_parameter) ."]";
$result = $database->product_add($category_id,$code,$name,$price,$material,$brand,$style,$sizes_parameter,$colors_parameter,$images_parameter);



header("location:product_add.php?sent=$result");

}else{
  header("location:product_add.php?res=codeExist");
}

?>
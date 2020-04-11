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


$id  = $_POST['id'];
$code  = $_POST['code'];
$name =  $_POST['name'];
$brand = $_POST['brand'];
$style = $_POST['style'];
$price = $_POST['price'];
$material = $_POST['material'];
$category_id = $_POST['category_id'];
$colors =  ($_POST['colors']);
$sizes =  ($_POST['sizes']);

$colors_parameter = [];
$sizes_parameter = [];


  

foreach(explode(",",$colors) as $color){
  array_push($colors_parameter,"\"".$color."\"");

}
$colors_parameter = array_unique($colors_parameter);
$colors_parameter = "[" . implode(",",$colors_parameter) ."]";


foreach(explode(",",$sizes) as $size){
  array_push($sizes_parameter,"\"".$size."\"");
}
$sizes_parameter = array_unique($sizes_parameter);
$sizes_parameter = "[" . implode(",",$sizes_parameter) ."]";



$result = $database->product_update($id,$category_id,$code,$name,$price,$material,$brand,$style,$sizes_parameter,$colors_parameter);

if($result)
echo "1";

?>
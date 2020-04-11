<?php
include_once('classes/autoload.php');
$database = new Database();
$categories = $database->categories_index();
foreach($categories as $category) :?>
<li><a href="category/<?=$category['id']?>" class=""><?=$category['name']?></a></li>
<?php endforeach; ?>
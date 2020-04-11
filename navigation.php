<?php
include_once('classes/autoload.php');
$database = new Database();
$categories = $database->categories_index();
foreach($categories as $category) :?>
<a href="category/<?=$category['id']?>" class="p-3 border-dark-bottom fw-2"><?=$category['name']?></a>
<?php endforeach; ?>
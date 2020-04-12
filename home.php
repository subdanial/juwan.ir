<!DOCTYPE html>
<html dir="rtl">
<?php
include('classes/autoload.php');
$database = new Database();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-extension.min.css">
    <link rel="stylesheet" href="assets/css/aos.min.css">
    <link rel="stylesheet" href="assets/css/root.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/mmenu.min.css" />
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
<nav id="my-menu" class="z-100">
        <ul>
            <?php include("navigation.mobile.php")?>
        </ul>
    </nav>
    <div class="container pt-5">

        <nav class=" pb-lg-0 ">
            <div class="nav-icon d-block pt-2 pb-2 border-bottom">

                <div class="row">
                    <div class="col-3"> <a href="#my-menu">
                            <i class="fas f-2 pt-2 mt-1 pl-4 fa-bars"></i>
                        </a></div>
                    <div class="col-6 p-0">
                        <div class="row">
                            <div class="main-logo mx-auto mb-5">
                                <img src="assets/img/logo/logo-dark.png" class="d-block  w-50 mx-auto">
                                <span class="text-center  w-100 pt-1 d-block" style="font-size:1.4rem">فروشگاه لباس عمده ژوان </span>
                            </div>
                        </div>
                        <div class="col-3"></div>
                    </div>
                </div>
        </nav>
        <div class="row">
            <?php
  $categories = $database->categories_index();
  foreach($categories as $category) : ?>
            <div class="col-lg-3 col-6 w-100 hover-bright pointer hover-zoom d-block mb-5 text-white text-center">
                <a href="category/<?=$category['id']?>">
                    <img src="<?=$category['image']?>" class="w-100 d-block mx-auto">
                    <span class="text-white bg-dark d-block p-md-4 p-2"><?=$category['name']?></span>
                    <span class="d-block pt-3">[ مشاهده بیشتر ]</span>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>


    <div class="home-footer-background bg-min-light z-n1 mt-n7">
    <div class="container">

    <div class="row pl-3 text-center ">
    <p style="padding-top:7.5rem" class="w-100 mb-n1 fw-2"><strong>آدرس  :  </strong>
    خیابان فردوسي، خیابان منوچهري، پاساژ سينا، طبقه همكف، پلاک 
    ١٢<br>
    <strong>تماس : </strong><a href="09014444230" dir="ltr">0901 444 4230</a>
    </p>
        
    </div>
        
    </div>
    </div>

   

    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-extension.min.js"></script>
    <script src="assets/js/aos.min.js"></script>
    <script src="assets/js/mmenu.min.js"></script>
    <script src="assets/js/app.js"></script>

</body>

</html>
<?php
include('classes/autoload.php');
$database = new Database();
$product_id = 1;
if(isset($_GET["product"])){$product_id = $_GET["product"];}
$product = $database->product_get($product_id);
$active = '';
?>
<!DOCTYPE html>
<html dir="rtl">

<head>
   <meta charset="utf-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-extension.min.css">
    <link rel="stylesheet" href="assets/css/aos.min.css">
    <link rel="stylesheet" href="assets/css/vertical.css">
    <link rel="stylesheet" href="assets/css/root.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/mmenu.min.css" />
    <link rel="stylesheet" href="assets/css/styles.css">

</head>

<body>

    <!-- navigation begin -->
    <nav id="my-menu" class="z-100">
        <ul>
            <?php include("navigation.mobile.php")?>
        </ul>
    </nav>
    

    <footer class="d-none d-lg-block position-fixed  w-100 bg-white" style="z-index:10; bottom:0px;">
        <div class="container border-top">
            <div class="row p-1">
                <div class="col">
                    <strong>آدرس : </strong>
                    خیابان فردوسي، خیابان منوچهري، پاساژ سينا، طبقه همكف، پلاک
                    ١٢
                </div>
                <div class="col">
                    <strong>تماس : </strong><a class="mr-1" href="09014444230" dir="ltr">0901 444 4230</a> |
                    <strong class="ml-1"> تلگرام : </strong><a href="https://t.me/Juwanorder" dir="ltr">@Juwanorder</a>
                </div>
            </div>
        </div>
    </footer>

    <div class="container-fluid">
        <nav class="pb-4 pb-lg-0 mb-4">
            <div class="nav-icon d-block pt-2 pb-2 d-md-none border-bottom">
                <div class="row">
                    <div class="col-2"> <a href="#my-menu">
                            <i class="fas f-2 pt-3 mt-1 pl-4 fa-bars"></i>
                        </a></div>
                    <div class="col-8 p-0"> <img src="/assets/img/logo/logo-dark-mini.png"
                            class="d-block mt-2 mx-auto w-50" alt="">
                        <span class="d-block text-center fw-2 pt-1">فروشگاه لباس عمده ژوان</span></div>

                    <div class="col-2">
                    <a href="javascript:history.back()"><i class="fas fa-chevron-left f-2 pt-3 mt-1 ml-n2 "></i></a>
                    </div>
                </div>
            </div>


            <div class="logo d-none d-md-block w-10 mx-auto pt-3">
                <a href="index.php"> <img src="assets/img/logo/logo-dark-mini.png" class="w-75 mx-auto d-block"> </a>
            </div>

            <div class="d-none d-md-flex justify-content-center">
                <?php include_once('navigation.php'); ?>
            </div>
        </nav>
        <!-- navigation end -->

    </div>
    <div class="container pr-lg-7 pl-lg-7">


    
        <div class="row">
            <div class="col-lg-5 col-md-12 order-lg-2 col-md-6 p-0">
                <div id="carousel-product" class="carousel slide p-2 mx-auto" data-ride="carousel">
                    <ol class="carousel-indicators d-lg-none">
  
                    </ol>

                    <div class="carousel-inner">


                        <?php 
                        $i=0; 
                        foreach(json_decode($product['images']) as $product_image): $i++?>
                        
                        <div class="carousel-item <?php if($i == 1) echo 'active' ?>">
                            <img src="<?=$product_image?>" class="d-block w-100">
                        </div>
                        <?php
                          endforeach;
                         ?>


                    </div>

                    <a class="carousel-control-prev" href="#carousel-product" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-product" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-1 d-none d-lg-block order-lg-3 p-0">

                <?php $i=0; 
                foreach(json_decode($product['images']) as $product_image):?>
                <a data-target="#carousel-product" data-slide-to="<?=$i?>" class="thumbnail active">
                    <img src="<?=$product_image?>" class="w-100 pointer mt-2 d-block mx-auto" alt="">
                </a>
                <?php $i++;if($i==0){$active='active';}else{$active='';}endforeach;?>

            </div>
            <div class="col-lg-6 order-lg-1 p-2 pr-5">
                <span class="fw-2 d-block f-15"><?=$product['name']?></span>
                <span class="fw-2 d-block ">کد : <?=$product['code']?></span>
                <hr>
                <span class="fw-2 d-block mt-2">قیمت : </span>
                <span class="fw-2 d-block f-15"><?= number_format($product['price'])?> تومان</span>
                <hr>
                <span class="fw-2 d-block mt-2">رنگ های موجود : </span>
                <div class="form-inline">



                    <?php
                    foreach(json_decode($product['color']) as $product_color):?>
                    <div class="colorbox mr-1">
                        <div class="color border border-light" style="background-color:<?=$product_color?>"></div>
                    </div>
                    <?php endforeach; ?>

                </div>
                <hr>
                <span class="fw-2 d-block mt-2">سایز ها : </span>
                <div class="form-inline">

                    <?php
                foreach(json_decode($product['size']) as $product_size):?>
                    <div class="fw-2 d-block border text-center p-1 sizebox mr-1"> <?=$product_size?> </div>
                    <?php endforeach; ?>

                </div>

            </div>


        </div>

        <span class="fw-2 d-none  mt-4 f-15 d-none"> کالاهای مشابه : </span>
        <hr class="p-0 m-0 d-none  mb-3 ">
        <div class="row  pb-3 pr-2 d-none  pl-2 mb-5 mt-3">

            <div class="col-lg-3 col-6  p-0 ">
                <a href="cloth.html">
                    <img src="assets/img/catalog/1.jpg" class="w-100 pl-2 pr-1 pt-1 pb-1 p-lg-2 d-block mx-auto" alt="">
                    <span class="d-block  text-center fw-2"> شلوار اسلش اسلیم فیت </span>
                    <span class="d-block  text-center fw-2"> کد : 39210</span>
                    <span class="d-block text-center"> 280,000 تومان <s class="d-none text-danger ml-2">300،000
                            تومان</s></span>
                </a>
            </div>

            <div class="col-lg-3 col-6 p-0 ">
                <a href="cloth.html">
                    <img src="assets/img/catalog/2.jpg" class="w-100 pl-2 pr-1 pt-1 pb-1 p-lg-2 d-block mx-auto" alt="">
                    <span class="d-block  text-center fw-2"> پلوشرت طراح دار ورساچه </span>
                    <span class="d-block  text-center fw-2"> کد : 39210</span>
                    <span class="d-block text-center"> 168,000 تومان <s class="d-none text-danger ml-2">300،000
                            تومان</s></span>
                </a>
            </div>

            <div class="col-lg-3 col-6 p-0 ">
                <a href="cloth.html">
                    <img src="assets/img/catalog/3.jpg" class="w-100 pl-2 pr-1 pt-1 pb-1 p-lg-2 d-block mx-auto" alt="">
                    <span class="d-block  text-center fw-2"> شلوار اسلش اسلیم فیت </span>
                    <span class="d-block  text-center fw-2"> کد : 39210</span>
                    <span class="d-block text-center"> 280,000 تومان <s class="d-none text-danger ml-2">300،000
                            تومان</s></span>
                </a>
            </div>

            <div class="col-lg-3 col-6 p-0 ">
                <a href="cloth.html">
                    <img src="assets/img/catalog/4.jpg" class="w-100 pl-2 pr-1 pt-1 pb-1 p-lg-2 d-block mx-auto" alt="">
                    <span class="d-block  text-center fw-2"> شلوار اسلش اسلیم فیت </span>
                    <span class="d-block  text-center fw-2"> کد : 39210</span>
                    <span class="d-block text-center"> 280,000 تومان <s class="d-none text-danger ml-2">300،000
                            تومان</s></span>
                </a>
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

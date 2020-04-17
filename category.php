<?php
include('classes/autoload.php');
$database = new Database();
$cat_id = 1;
$page_id = 1;

$perpage = 36;
$colors = "`color`";
$materials = "`material`";
$styles = "`style`";
$brands = "`brand`";
$price0 = 0;
$price1 = 100000000;
function parameter_generator($old_parameter,$is_color = false){
    $new_parameter_array = [];    
    $old_parameter_array= explode(',',$old_parameter);
    foreach($old_parameter_array as $old_parameter){
        if(!$is_color)
        array_push($new_parameter_array,"'".$old_parameter."'");
        else
        array_push($new_parameter_array,"#".$old_parameter."");
    }
    if(!$is_color){
        $new_parameters = implode(',',$new_parameter_array);
        return($new_parameters);
    }
    else{
        $new_parameters = implode('|',$new_parameter_array);
        return("'".$new_parameters."'");
    }
    
}

if(isset($_GET["cat"])){$cat_id = $_GET["cat"];}
if(isset($_GET["page"])){
    ($page_id = $_GET["page"]);
}


if(isset($_GET["styles"])){$styles = parameter_generator($_GET["styles"]);} 
if(isset($_GET["brands"])){$brands = parameter_generator($_GET["brands"]);} 
if(isset($_GET["materials"])){$materials = parameter_generator($_GET["materials"]);} 
if(isset($_GET["colors"])){$colors = parameter_generator($_GET["colors"],true);} 
if(isset($_GET["prices"]))
{
    $price0 = intval(explode(",",$_GET['prices'])[0]);
    $price1 = intval(explode(",",$_GET['prices'])[1]);
} 


$products =  $database->products_show($cat_id,$colors,$materials,$styles,$brands,$price0,$price1,$page_id,$perpage);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/mmenu.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
    <link rel="stylesheet" href="assets/css/root.css">
    <link rel="stylesheet" href="assets/css/styles.css">



</head>

<body>

    <input type="hidden" id="cat_id" value="<?=$cat_id?>">
    <input type="hidden" id="page_id" value="<?=$page_id?>">
    <!-- navigation begin -->

    <?php
    $number_of_results = $database->number_of_results($cat_id);
    $number_of_pages = ceil($number_of_results/$perpage);
?>

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

    <nav id="my-menu" class="z-100">
        <ul>
            <?php include("navigation.mobile.php")?>
        </ul>
    </nav>



    <div class="container-fluid mb-5">
        <nav class=" pb-lg-0 ">
            <div class="nav-icon d-block pt-2 pb-2 d-md-none border-bottom">
                <div class="row">
                    <div class="col-2"> <a href="#my-menu">
                            <i class="fas f-2 pt-2 mt-1 pl-4 fa-bars"></i>
                        </a></div>
                    <div class="col-8 p-0">
                        <a href="home.php"><img src="assets/img/logo/logo-dark-mini.png"
                                class="d-block mt-2 mx-auto w-50" alt=""></a>
                        <span class="d-block text-center fw-2 pt-1">فروشگاه لباس عمده ژوان</span></div>

                    <div class="col-2"></div>
                </div>
            </div>
            <div class="logo d-none d-md-block w-10 mx-auto pt-3">
                <a href="home.php"> <img src="assets/img/logo/logo-dark-mini.png" class="w-75 mx-auto d-block"> </a>
            </div>

            <div class="d-none d-md-flex justify-content-center  ">
                <?php include_once('navigation.php'); ?>
            </div>
        </nav>
        <!-- navigation end -->

        <div class="container mt-3 ">
            <div class="row">
                <div class="d-none d-lg-block col-lg-2">
                    <div class="sidebar">
                        <p>
                            <a class="fw-2" data-toggle="collapse" href="#filter1" role="button" aria-expanded="true">
                                جنس
                            </a>
                        </p>
                        <div class="collapse show" id="filter1">

                            <?php foreach($database->get_attributes('material',$cat_id) as $attr): ?>
                            <div class="form-check">
                                <div class="pretty p-default ml-n4  pl-1">
                                    <input type="checkbox" class="material url_filter" value="<?=$attr['material']?>" />
                                    <div class="state">
                                        <label></label>
                                    </div>
                                </div>
                                <label class="form-check-label ml-1 "><?=$attr['material']?></label>
                            </div>
                            <?php endforeach;?>

                        </div>
                        <hr>
                        <!-- material end -->
                        <p>
                            <a class="fw-2" data-toggle="collapse" href="#filter2" role="button" aria-expanded="true">
                                رنگ
                            </a>
                        </p>
                        <div class="collapse show" id="filter2">
                            <div class="form-inline">

                                <?php foreach($database->get_colors($cat_id) as $color): ?>
                                <div class="pretty p-default ml-n1 pl-2 mb-2">
                                    <input type="checkbox" class="color url_filter" value="<?=$color?>" />
                                    <div class="state color" data-content="<?=$color?>">
                                        <label></label>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <hr>
                        <!-- color end -->
                        <p>
                            <a class="fw-2" data-toggle="collapse" href="#filter3" role="button" aria-expanded="true">
                                برند
                            </a>
                        </p>
                        <div class="collapse show" id="filter3">
                            <?php foreach($database->get_attributes('brand',$cat_id) as $attr): ?>
                            <div class="form-check">
                                <div class="pretty p-default ml-n4 pl-1">
                                    <input type="checkbox" class="brand url_filter" value="<?=$attr['brand']?>" />
                                    <div class="state">
                                        <label></label>
                                    </div>
                                </div>
                                <label class="form-check-label ml-1 "><?=$attr['brand']?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <hr>
                        <!-- brand end -->
                        <p>
                            <a class="fw-2" data-toggle="collapse" href="#filter4" role="button" aria-expanded="true">
                                استایل
                            </a>
                        </p>
                        <div class="collapse show" id="filter4">
                            <?php foreach($database->get_attributes('style',$cat_id) as $attr): ?>
                            <div class="form-check">
                                <div class="pretty p-default ml-n4  pl-1">
                                    <input type="checkbox" class="style url_filter" value="<?=$attr['style']?>" />
                                    <div class="state">
                                        <label></label>
                                    </div>
                                </div>
                                <label class="form-check-label ml-1 "><?=$attr['style']?></label>
                            </div>
                            <?php endforeach; ?>

                        </div>
                        <hr>
                        <!-- style end -->
                        <!-- <p>
                            <a class="fw-2" data-toggle="collapse" href="#filter5" role="button" aria-expanded="true">
                                قیمت
                            </a>
                        </p>
                        <div class="collapse show" id="filter5">
                            <div class="input-group-sm form-inline w-100">
                                <span class="mr-2">از</span>
                                <input type="number" class="price-box form-control input-sm w-85 d-block float-right"
                                    id="price0" placeholder="  قیمت پایه | هزارتومان">
                            </div>
                            <div class="input-group-sm form-inline w-100 mt-2">
                                <span class="mr-2">تا</span>
                                <input type="number" class="price-box form-control input-sm w-85 d-block float-right"
                                    id="price1" placeholder="حداکثر قیمت | هزارتومان">
                            </div>
                            <div class="form-group d-block">
                                <button class="btn d-block btn-dark btn-sm mt-3 w-85 ml-3 btn-price">جستجو</button>
                            </div>
                        </div>
                        <hr> -->


                        <!-- price end -->
                    </div>
                </div>

                <div class="col-12 col-lg-10">


                    <span class="f-08 mt-0">مشاهده محصولات</span>
                    <h2 class="h2 fw-2 f-15 mb-0 pb-0"><?=$database->category_show($cat_id)['name']?></h2>


                    <div class="row">
                        <!-- catalog begin -->

                        <?php 
                        $i = 0;
                        foreach ($products as $product) :?>
                        <div class="col-lg-3 col-6 p-0 ">
                            <div class="hover-colors">
                                <?php foreach( json_decode($product['color']) as $color) :?>
                                <div class="color-circle border border-light" style="background-color: <?=$color?>">
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <button class="hover-link rounded-circle bg-white border-light position-absolute"
                                data-content="لینک محصول ذخیره شد، میتوانید از ایدی <a href='https://t.me/Juwanorder' class='text-primary' >Juwanorder@</a> در تلگرام سفارش دهید"
                                data-toggle="popover"
                                data-clipboard-text="http://<?=$_SERVER['HTTP_HOST']?>/product/<?=$product['id']?>"><i
                                    class="fas fa-link    "></i></button>


                            <a href="product/<?=$product['id']?>">
                                <img src="<?=json_decode($product['images'])[0]?>"
                                    class="w-100 pl-2 pr-1 pt-1 pb-1 p-lg-2 d-block mx-auto" alt="">
                                <span class="d-block  text-center fw-2"> <?=$product['name']?></span>
                                <span class="d-block  text-center fw-2"> کد : <?=$product['code']?></span>
                                <!-- <span class="d-block text-center"> <?=number_format($product['price'])?> تومان</span> -->
                            </a>

                        </div>
                        <?php  $i++;endforeach; ?>
                        <!-- catalog end -->
                        <nav class="position-absolute d-block float-right" style="bottom:0px;left:0">
                            <ul class="pagination">

                                <?php  for ($page=1;$page<=$number_of_pages;$page++) :?>
                                <li class="page-item"><a class="page-link text-dark"
                                        href="javascript:document.location.href=urlmanager(<?=$page?>)"><?=$page?></a>
                                </li>



                                <?php endfor;?>
                            </ul>
                        </nav>
                    </div>

                </div>


            </div>



        </div>

        <div class="bottom-bar z-100 bg-white d-lg-none p-0 w-100 overflow-auto pb-5">
            <p>
                <a class="fw-2" data-toggle="collapse" href="#filter1" role="button" aria-expanded="true">
                    جنس
                </a>
            </p>
            <div class="collapse show" id="filter1">

                <?php foreach($database->get_attributes('material',$cat_id) as $attr): ?>
                <div class="form-check">
                    <div class="pretty p-default ml-n4  pl-1">
                        <input type="checkbox" class="material url_filter" value="<?=$attr['material']?>" />
                        <div class="state">
                            <label></label>
                        </div>
                    </div>
                    <label class="form-check-label ml-1 "><?=$attr['material']?></label>
                </div>
                <?php endforeach;?>

            </div>
            <hr>
            <!-- material end -->
            <p>
                <a class="fw-2" data-toggle="collapse" href="#filter2" role="button" aria-expanded="true">
                    رنگ
                </a>
            </p>
            <div class="collapse show" id="filter2">
                            <div class="form-inline">

                                <?php foreach($database->get_colors($cat_id) as $color): ?>
                                <div class="pretty p-default ml-n1 pl-2 mb-2">
                                    <input type="checkbox" class="color url_filter" value="<?=$color?>" />
                                    <div class="state color" data-content="<?=$color?>">
                                        <label></label>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
            <hr>
            <!-- color end -->
            <p>
                <a class="fw-2" data-toggle="collapse" href="#filter3" role="button" aria-expanded="true">
                    برند
                </a>
            </p>
            <div class="collapse show" id="filter3">
                <?php foreach($database->get_attributes('brand',$cat_id) as $attr): ?>
                <div class="form-check">
                    <div class="pretty p-default ml-n4 pl-1">
                        <input type="checkbox" class="brand url_filter" value="<?=$attr['brand']?>" />
                        <div class="state">
                            <label></label>
                        </div>
                    </div>
                    <label class="form-check-label ml-1 "><?=$attr['brand']?></label>
                </div>
                <?php endforeach; ?>
            </div>
            <hr>
            <!-- brand end -->
            <p>
                <a class="fw-2" data-toggle="collapse" href="#filter4" role="button" aria-expanded="true">
                    استایل
                </a>
            </p>
            <div class="collapse show" id="filter4">
                <?php foreach($database->get_attributes('style',$cat_id) as $attr): ?>
                <div class="form-check">
                    <div class="pretty p-default ml-n4  pl-1">
                        <input type="checkbox" class="style url_filter" value="<?=$attr['style']?>" />
                        <div class="state">
                            <label></label>
                        </div>
                    </div>
                    <label class="form-check-label ml-1 "><?=$attr['style']?></label>
                </div>
                <?php endforeach; ?>

            </div>
            <hr>
            <!-- style end -->
            <!-- <p>
                <a class="fw-2" data-toggle="collapse" href="#filter5" role="button" aria-expanded="true">
                    قیمت
                </a>
            </p>
            <div class="collapse show" id="filter5">
                <div class="input-group-sm form-inline w-100">
                    <span class="mr-2">از</span>
                    <input type="number" class="price-box form-control input-sm w-85 d-block float-right" id="price0"
                        placeholder="  قیمت پایه | هزارتومان">
                </div>
                <div class="input-group-sm form-inline w-100 mt-2">
                    <span class="mr-2">تا</span>
                    <input type="number" class="price-box form-control input-sm w-85 d-block float-right" id="price1"
                        placeholder="حداکثر قیمت | هزارتومان">
                </div>
                <div class="form-group d-block">
                    <button class="btn d-block btn-dark btn-sm mt-3 w-85 ml-3 btn-price">جستجو</button>
                </div>
            </div>
            <hr> -->


            <!-- price end -->
        </div>


        <div class="row bottom-bar-button d-block d-lg-none">
            <button class="btn w-100 d-block mx-auto btn-large btn-dark rounded-0 filter">فیلتر</button>
        </div>


        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-extension.min.js"></script>
        <script src="assets/js/aos.min.js"></script>
        <script src="assets/js/mmenu.min.js"></script>
        <script src="assets/js/app.js"></script>
        <script>
            new ClipboardJS('.hover-link');
            //filter

            if ($.cookie("footer") == "foo") {
                $('.bottom-bar').show();
            }


            $('.filter').click(function () {
                $('.bottom-bar').toggle();

                if ($.cookie("footer") == "foo") {
                    $.cookie("footer", null);
                } else {
                    $.cookie("footer", "foo");
                }

            })


            var page_id = $("#page_id").val();

            //color
            $(".color").each(function () {
                $(this).css('background-color', $(this).attr('data-content'));
            })





            //urlmanager
            var u_brands = [];
            var u_colors = [];
            var u_styles = [];
            var u_materials = [];
            var u_prices = [];



            //urlmanager
            //urlprice
            var price0 = 0;
            var price1 = 0;
            $('.btn-price').click(function () {
                u_prices[0] = 0;
                u_prices[1] = 0;

                price0 = $("#price0").val();
                price1 = $("#price1").val();

                if (parseInt(price1) >= parseInt(price0) && price0 != "" && price1 != "") {
                    u_prices[0] = price0 * 1000;
                    u_prices[1] = price1 * 1000;

                    $("#price0").removeClass('is-invalid');
                    $("#price1").removeClass('is-invalid');
                    document.location = urlmanager(page_id);
                } else {
                    $("#price0").addClass('is-invalid');
                    $("#price1").addClass('is-invalid');
                }
            })


            var searchParams = new URLSearchParams(window.location.search);

            if (searchParams.has('brands'))
                u_brands = searchParams.get('brands').split(",");

            if (searchParams.has('colors'))
                u_colors = searchParams.get('colors').split(",");

            if (searchParams.has('styles'))
                u_styles = searchParams.get('styles').split(",");

            if (searchParams.has('materials'))
                u_materials = searchParams.get('materials').split(",");

            if (searchParams.has('prices')) {
                u_prices = searchParams.get('prices').split(",");
                $("#price0").val(u_prices[0] / 1000);
                $("#price1").val(u_prices[1] / 1000);
            }



            $(".url_filter").each(function () {

                if ($(this).hasClass('material')) {
                    if ($.inArray($(this).val(), u_materials) != -1)
                        $(this).prop("checked", true);
                }

                if ($(this).hasClass('brand')) {
                    if ($.inArray($(this).val(), u_brands) != -1)
                        $(this).prop("checked", true);
                }

                if ($(this).hasClass('style')) {
                    if ($.inArray($(this).val(), u_styles) != -1)
                        $(this).prop("checked", true);
                }

                if ($(this).hasClass('color')) {
                    if ($.inArray($(this).val().split("#")[1], u_colors) != -1)
                        $(this).prop("checked", true);
                }

            });


            $(".url_filter").change(function () {
                var filter_class = $(this).prop("classList")[0];
                if (this.checked) {
                    switch (filter_class) {
                        case "material":
                            if ($.inArray($(this).val(), u_materials) == -1) {
                                u_materials.push($(this).val());
                            }
                            break;
                        case "style":
                            if ($.inArray($(this).val(), u_styles) == -1) {
                                u_styles.push($(this).val());
                            }
                            break;
                        case "color":
                            if ($.inArray($(this).val().split("#")[1], u_colors) == -1) {
                                u_colors.push($(this).val().split('#')[1]);
                            }
                            break;
                        case "brand":
                            if ($.inArray($(this).val(), u_brands) == -1) {
                                u_brands.push($(this).val());
                            }
                            break;
                    }
                } else {
                    switch (filter_class) {
                        case "material":
                            if ($.inArray($(this).val(), u_materials) != -1) {
                                u_materials.splice($.inArray($(this).val(), u_materials), 1);
                            }
                            break;
                        case "style":
                            if ($.inArray($(this).val(), u_styles) != -1) {
                                u_styles.splice($.inArray($(this).val(), u_styles), 1);
                            }
                            break;
                        case "color":
                            if ($.inArray($(this).val().split("#")[1], u_colors) != -1) {
                                var c = $(this).val().split("#")[1];
                                u_colors = $.grep(u_colors, function (value) {
                                    return value != c;
                                });
                            }
                            break;
                        case "brand":
                            if ($.inArray($(this).val(), u_brands) != -1) {
                                u_brands.splice($.inArray($(this).val(), u_brands), 1);
                            }
                            break;
                    }
                }
                document.location = urlmanager(page_id);

            })

            function urlmanager(page_id) {
                var url_href = document.location.href.split("?")[0];
                var url_string = `?cat=` + $("#cat_id").val();
                url_string += `&page=` + page_id;
                if (u_brands.length != 0)
                    url_string += `&brands=` + u_brands.toString()
                if (u_colors.length != 0)
                    url_string += `&colors=` + u_colors.toString()
                if (u_styles.length != 0)
                    url_string += `&styles=` + u_styles.toString()
                if (u_materials.length != 0)
                    url_string += `&materials=` + u_materials.toString()
                if (u_prices.length != 0)
                    url_string += `&prices=` + u_prices.toString()
                var new_url = url_href + url_string;
                return (new_url);
            }

            $(document).ready(function () {

                $('[data-toggle="popover"]').popover({
                    html: true,
                    placement: 'top',
                    delay: {
                        hide: 1000 // doesn't do anything
                    }
                }).on('shown.bs.popover', function () {
                    setTimeout(function (a) {
                        a.popover('hide');
                    }, 3000, $(this));
                });
            });
        </script>
        </button>
</body>
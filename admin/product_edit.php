<?php
session_start();
if(@$_SESSION['isAdmin'] != true){
    header("location:login.php");
    die();
  }
?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">
<?php
include('autoload.php');
$database = new Database();
$categories = $database->categories_index();
$product = $database->product_get($_GET['item']);
?>



<head>
  <title>add_product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/bootstrap-extension.min.css">
  <link rel="stylesheet" href="../assets/css/root.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
  <link rel="stylesheet" href="../assets/css/mmenu.min.css" />
  <link rel="stylesheet" href="jquery-ui.min.css">
  <link rel="stylesheet" href="jquery.fancybox.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />
  <link rel="stylesheet" href="admin.css">

</head>

<body class="bg-light">





  <!-- nav begin -->
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">کنترل پنل ادمین</a>
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
        aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item ">
            <a class="nav-link" href="index.php">دسته بندی<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="products.php">محصولات</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">خروج</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- nav end -->
  <!-- main begin -->
  <div class="container mt-4">
  <div class="alert alert-success d-none alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>محصول با موفقیت بروز رسانی شد</strong> 
  </div>

    <form action="/" id="new-product" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="col-8">
          <section class="bg-white border-light p-4 mb-4">
            <div class="form-group">
              <label class="fw-2" for="">کد : </label>
              <input type="number" name="code" id="code" class="form-control" value="<?=$product['code']?>"
                placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group">
              <label class="fw-2" for="">نام : </label>
              <input type="text" name="name" id="name" class="form-control" value="<?=$product['name']?>" placeholder=""
                aria-describedby="helpId">
            </div>
            <div class="form-group">
              <label class="fw-2" for="">قیمت : </label>
              <input type="number" name="price" id="price" class="form-control" value="<?=$product['price']?>"
                placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group">
              <label class="fw-2" for="">جنس : </label>
              <input type="text" name="material" id="material" class="form-control" value="<?=$product['material']?>"
                placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group">
              <label class="fw-2" for="">برند : </label>
              <input type="text" name="brand" id="brand" class="form-control" value="<?=$product['brand']?>"
                placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group">
              <label class="fw-2" for="">استایل : </label>
              <input type="text" name="style" id="style" class="form-control" value="<?=$product['style']?>"
                placeholder="" aria-describedby="helpId">
            </div>
          </section>

          <!-- size section begin -->
          <section class="bg-white border-light p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
              <label class="fw-2" for=""> سایزها :</label>
              <div class="form-inline">
                <div class="dropup">
                  <button type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown">
                    سایز های آماده
                  </button>
                  <div class="dropdown-menu">
                    <div class="w-100 text-center d-flex justify-item-between flex-wrap">
                      <div class="w-50 p-1"><button type="button" class="btn size_add btn-outline-dark w-100 "
                          data-content="XS">XS</button></div>
                      <div class="w-50 p-1"><button type="button" class="btn size_add btn-outline-dark w-100 "
                          data-content="S">S</button></div>
                      <div class="w-50 p-1"><button type="button" class="btn size_add btn-outline-dark w-100 "
                          data-content="M">M</button></div>
                      <div class="w-50 p-1"><button type="button" class="btn size_add btn-outline-dark w-100 "
                          data-content="L">L</button></div>
                      <div class="w-50 p-1"><button type="button" class="btn size_add btn-outline-dark w-100 "
                          data-content="XL">XL</button></div>
                      <div class="w-50 p-1"><button type="button" class="btn size_add btn-outline-dark w-100 "
                          data-content="XXL">XXL</button>
                      </div>
                    </div>
                  </div>
                </div>

                <button type="button" class="btn size_add btn-outline-dark ml-2" data-content=""> افزودن <i
                    class="fa fa-plus"></i></button>

              </div>
            </div>
            <div class="form-group">
              <div name="add_name" id="add_name">
                <div class="table-responsive">
                  <table class="table table-bordered" id="size_field">



                  </table>
                </div>
              </div>
            </div>
          </section>
          <!-- size section end -->

          <!-- color section begin -->
          <section class="bg-white border-light p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
              <label class="fw-2" for=""> رنگ ها :</label>
              <div class="form-inline">
                <div class="dropup">
                  <button type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown">
                    پالت رنگ
                  </button>
                  <div class="dropdown-menu ">
                    <div class="colorbox d-flex p-2">
                      <div class="color pointer color_add m-1" data-content="#FFFFFF" name="white"></div>
                      <div class="color pointer color_add m-1" data-content="#85C774" name="cactus"></div>
                      <div class="color pointer color_add m-1" data-content="#7EF7D7" name="ment"></div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="form-group">
              <div name="add_name" id="add_name">

                <div class="d-flex" id="color_field">

                </div>
              </div>
            </div>

          </section>
          <!-- color section end -->



          <section class="bg-white border-light p-4 mb-4">
          <div class="row">
            <div class="col-6">
              
              <button class="w-100 p-3 btn btn-dark" id="main_submit">ثبت مقادیر جدید</button>
            </div>
            <div class="col-6">
              <a href="products.php"><span class="w-100 p-3 btn btn-outline-dark" id="main_back">بازگشت</button></a>
              
            </div>
          </div>
          </section>


        </div>
        <div class="col-4">
          <!-- submin begin -->
     
          <!-- submit end -->

          <section class="bg-white border-light p-4 mb-4">
            <label class="fw-2" for=""> تصاویر فعلی</label>
            <div class="images_currenct row"></div>


          </section>



          <section class="bg-white border-light p-4 mb-4">
            <label class="fw-2" for=""> دسته :</label>

            <?php foreach($categories as $category) :?>

            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input categories" name="category_id" value="<?=$category['id']?>"
                  value="checkedValue"><span><?=$category['name']?></span>
              </label>
            </div>

            <?php endforeach;?>


          </section>

    </form>


    <section class="bg-white border-light p-4 mb-4">
    <form action="product_update_image.php" id="pic-form" method="POST" enctype="multipart/form-data">
    <label class="fw-2" for="">تصاویر جدید:</label>
    <div class="custom-file">
      <input type="file" class="custom-file-input" id="customFile" name="image[]" multiple>
      <label class="custom-file-label" for="customFile">Choose file</label>
    </div>
    <input type="hidden" name="product_id" value="<?=$product['id']?>">
        <button type="submit" class="btn btn-dark mt-1 w-100 btn-upload-data"> آپلود تصاویر</a>
    </form>

    </section>

    <!-- picture section end -->

  </div>


  </div>






  </div>
  <!-- main end -->




  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js">
  </script>
  <script src="../assets/js/bootstrap-extension.min.js"></script>
  <script type="text/javascript" src="jquery.fancybox.min.js"></script>
  <script type="text/javascript">
    var files = [];


    // fancybox
    $(document).ready(function () {
      $("a#single_image").fancybox();
      $("a#inline").fancybox({
        'hideOnContentClick': true
      });
      $("a.group").fancybox({
        'transitionIn': 'elastic',
        'transitionOut': 'elastic',
        'speedIn': 600,
        'speedOut': 200,
        'overlayShow': false
      });
    });


    //size_manager


    var sizes = [];
    $('.size_add').click(function () {
      isize++;
      $('#size_field').append(`<tr id="size_row` + isize +
        `"><td><input type="text" value="` + $(this).attr('data-content') +
        `"  placeholder="سایز" class="form-control input_size" id="size` + isize +
        `" /></td><td><button type="button" name="remove" id="` +
        isize + `" class="btn btn-dark size_remove">&times</button></td></tr>`);
    });
    $(document).on('click', '.size_remove', function () {
      var button_id = $(this).attr("id");
      $('#size_row' + button_id + '').remove();
    });

    //color_manager
    var icolor = 0;
    var colors = [];

    $(".color").each(function () {
      $(this).css('background-color', $(this).attr('data-content'));
    })

    $('.color_add').click(function () {
      icolor++;
      $('#color_field').append(
        `<div id="color_row` + icolor + `" class="d-flex mx-2 border border-dark">
    <div class="color m-1 input_color" id="color` + icolor + `" data-content="` + $(this).attr('data-content') +
        `" style="background-color:` + $(this).attr('data-content') +
        `" "> </div><span class="pt-1 pr-2 pl-1 pointer color_remove" id=` + icolor + `>&times</span>
    </div>`
      );
    });
    $(document).on('click', '.color_remove', function () {
      var button_id = $(this).attr("id");
      $('#color_row' + button_id + '').remove();
    });





    //serialize
    function serialize_color() {
      $(".input_color").each(function () {
        var color_values = $(this).attr('data-content');
        colors.push(color_values);
        colors = $.unique(colors);
      })
    }

    function serialize_sizes() {
      $(".input_size").each(function () {
        var size_values = $(this).val();
        sizes.push(size_values);
        sizes = $.unique(sizes);
        sizes = sizes.filter(item => item);
      })
    }

    //form_validator
    var form_is_valid = false;
    $("#main_submit").click(function (e) {
      e.preventDefault();
      $(document).scrollTop( 0 );
      serialize_color();
      serialize_sizes();
      
      $('input[type="text"],input[type="number"]').each(function () {
        if (!$(this).val()) {
          $(this).addClass("is-invalid");
        } else {
          $(this).removeClass("is-invalid");
          $(this).addClass("is-valid");
          if ($(".input_size")[0] && $(".input_color")[0]) {
            $(".input_size").each(function () {
              if (!$(this).val()) {
                $(this).addClass("is-invalid");
              } else {
                form_is_valid = true;
              }
            })
          }
        }
      });
      var sizes = [];
      $(".input_size").each(function () {
        sizes.push($(this).val());
      });
      var colors = [];
      $(".input_color").each(function () {
        colors.push($(this).attr('data-content'));
      });

      var category = $(".categories:checked").val();
      var id = $("#id").val();
      var code = $("#code").val();
      var name = $("#name").val();
      var price = $("#price").val();
      var material = $("#material").val();
      var brand = $("#brand").val();
      var style = $("#style").val();



      var data = new FormData();
      data.append("id", <?=$_GET['item']?>);
      data.append("code", code);
      data.append("name", name);
      data.append("brand", brand);
      data.append("price", price);
      data.append("material", material);
      data.append("style", style);
      data.append("sizes", sizes);
      data.append("colors", colors);
      data.append("category_id", category);

      if (form_is_valid) {

        $.ajax({
          url: "product_update.php",
          data: data,
          type: "POST",
          cache: false,
          processData: false,
          contentType: false,
        }).done(function (msg) {

          if(msg ==1){
            $('.alert-success').removeClass('d-none');
          }
          else{
            console.log("product_edit.php line 417 error darim")
          }
        });

      } 
      else {
        alert("مقدار فیلد ها را بررسی کنید");
      }

    });

    //checkboxselet
  </script>



  <script>
    var product_sizes = <?= $product['size'] ?> ;
    var product_colors = <?= $product['color'] ?> ;
    var product_images = <?= $product['images'] ?> ;
    var product_category = <?= $product['category_id']?>;

    $('.categories').each(function(){
      if($(this).val() == product_category){
        $(this).prop("checked", true);
      }
    });


    //size load
    $.each(product_sizes, function (index, value) {
      index++;
      $('#size_field').append(
        `<tr id="size_row` + index +
        `"><td><input type="text" value="` + value +
        `"  placeholder="سایز" class="form-control input_size" id="size` + index +
        `" /></td><td><button type="button" name="remove" id="` +
        index + `" class="btn btn-dark size_remove">&times</button></td></tr>`);
    });

    //color load
    $.each(product_colors, function (index, value) {
      index++;

      $('#color_field').append(
        `<div id="color_row` + index + `" class="d-flex mx-2 border border-dark">
    <div class="color m-1 input_color" id="color` + index + `" data-content="` + value +
        `" style="background-color:` + value +
        `" "> </div><span class="pt-1 pr-2 pl-1 pointer color_remove" id=` + index + `>&times</span>
    </div>`
      );
    });

    //imagecorent 
    $.each(product_images, function (index, value) {
      index++
      $('.images_currenct').append(
        `<div class="image ` + index + ` col-6 mb-2" id="pic`+index+`">
        <a class="fancybox group" rel="ligthbox" href="` + value + `"><img class="img-thumbnail d-block " src="` +
        value + `"></a>
        
        <a class="btn w-95 mx-auto d-block mt-1 btn-sm btn-dark text-white btn-remove-picture" data-content="` +
        value + `" id="pic`+index+`">حذف</a>
        </div>
        `
      )
    });

    $(".btn-remove-picture").click(function () {

      $("div#"+$(this).attr('id')).remove();

      var the_image = $(this).attr('data-content');
      $.ajax({
        url: "operator.php",
        data: {
          "remove_image": the_image
        },
        type: "post",
      }).done(function (msg) {
        console.log(msg);
      });
    });

    //lastsizeindex
    $.each($(".input_size"),function(){
      isize = parseInt($(this).attr('id').split('size')[1]);
    });
    //lastcolorindex
    $.each($(".input_color"),function(){
      icolor = parseInt($(this).attr('id').split('color')[1]);
    });
  </script>
</body>
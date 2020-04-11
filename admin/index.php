<!DOCTYPE html>
<html dir="rtl" lang="fa">
<?php
include('autoload.php');
$database = new Database();

session_start();
if(isset($_POST['name']) && isset($_POST['password'])){

if($_POST['name'] == "admin"){
  if($_POST['password'] == "a"){
    $_SESSION['isAdmin'] = true;
  }
}
  else
  {
    $_SESSION['isAdmin'] = false;
  }
}
if(@$_SESSION['isAdmin'] != true){
  header("location:login.php");
  die('لطفا لاگین کنید');
}

?>

<head>
  <title>admin-panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/bootstrap-extension.min.css">
  <link rel="stylesheet" href="../assets/css/root.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
  <link rel="stylesheet" href="../assets/css/mmenu.min.css" />
  <link rel="stylesheet" href="jquery-ui.min.css">
  <link rel="stylesheet" href="jquery.fancybox.min.css">
  <link rel="stylesheet" href="admin.css">
  <style>

  </style>
</head>

<body>


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
          <li class="nav-item active">
            <a class="nav-link" href="index.php">دسته بندی<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item ">
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

  <div class="container mt-4">

    <div class="alert alert-success alert-upload alert-dismissible fade mr-4 d-none show" role="alert">
      تصویر با موفقیت آپلود شد.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span>&times;</span>
      </button>
    </div>

    <div class="alert alert-danger alert-upload-danger alert-dismissible fade mr-4 d-none show" role="alert">
      فایل آپلود شده معتبر نیست.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span>&times;</span>
      </button>
    </div>



    <span class="display-7"> ترتیب و دسته بندی </span>

    <div class="row w-100 mt-3">
      <div class="d-flex justify-content-center  w-100">
        <div class="row w-100 p-2" id="sortable">

          <!-- table begin -->
          <table class="table grab table-stripped table-hover table-bordered">
            <thead>
              <tr>
                <td>ردیف</td>
                <td>نام فعلی</td>
                <td>نام جدید</td>
                <td>تصویر فعلی</td>
                <td>تصویر جدید (سایز مناسب 390x590)</td>
              </tr>
            </thead>
            <tbody>
              <?php foreach($database->categories_index() as $category) :?>

              <tr data-index="<?=$category['id']?>" category-position="<?=$category['ordering']?>">
                <td class="w-10"><?=$category['ordering']?></td>
                <td class="w-25"><?=$category['name']?></td>
                <td class="w-25">
                  <form class="form-inline">
                    <div class="form-group w-100">
                      <input type="text" id="<?=$category['id']?>" class=" w-60 form-control">
                      <button class="btn btn-dark ml-2 btn-rename" id="<?=$category['id']?>">ثبت</button>
                    </div>
                  </form>
                </td>
                <td class="w-10"> <a id="single_image" href="<?=$category['image']?>">مشاهده</a></td>
                <td class="w-20">
                  <!-- upload begin -->
                  <form enctype="multipart/form-data" action="upload.php" class="pointer" method="POST">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <button type="submit" class="input-group-text pointer" id="inputGroupFileAddon01">آپلود</button>
                      </div>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="uploaded_file">
                        <input type="hidden" value="<?=$category['id']?>" name="id">
                        <label class="custom-file-label" for="inputGroupFile01">انتخاب عکس</label>
                      </div>
                    </div>
                  </form>

                  <!-- upload end -->
                </td>
              </tr>

              <?php endforeach ?>
            </tbody>
          </table>
          <!-- table end -->

        </div>
      </div>
    </div>
  </div>

</body>
<script src="../assets/js/modernizr.min.js"></script>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/bootstrap-extension.min.js"></script>
<script src="../assets/js/mmenu.min.js"></script>
<script src="jquery-ui.min.js"></script>
<script type="text/javascript" src="jquery.fancybox.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.14.1/js/mdb.min.js"></script>



<script type="text/javascript">
  // sortable
  $(document).ready(function () {
    $('table tbody').sortable({
      update: function (event, ui) {
        $(this).children().each(function (index) {
          if ($(this).attr('data-position') != (index + 1)) {
            $(this).attr('data-position', (index + 1)).addClass('updated');
          }
        });
        saveNewPositions();
      }
    });
  });

  function saveNewPositions() {
    var positions = [];
    $('.updated').each(function () {
      positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
      $(this).removeClass('updated');
    });
    $.ajax({
      url: 'operator.php',
      method: 'POST',
      dataType: 'text',
      data: {
        updatepostions: 1,
        positions: positions
      },
      success: function (response) {
        console.log(response);
      }
    });
  }
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

  //rename
  $('.btn-rename').click(function () {
    var id = $(this).attr('id');
    $.ajax({
      url: 'operator.php',
      method: 'POST',
      dataType: 'text',
      data: {
        rename: 1,
        id: id,
        value: $("[type=text]#" + id).val()
      },
      success: function (response) {
        console.log(response);
        url.split('?')[0]
        location.reload();
      }
    });
  });

  //upload-alers
  $(document).ready(function () {
    let searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has('upload')) {
      let param = searchParams.get('upload')
      if (param == 1) {
        $('.alert-upload').removeClass("d-none");
      }
      if (param == 0) {
        $('.alert-upload-danger').removeClass("d-none");
      }
    }
  })
</script>
</body>
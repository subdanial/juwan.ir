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

function json_read($json_value){
  $values = "";
  $json_value = json_decode($json_value);
  foreach($json_value as $value){
  $values .= "[ ". $value ." ] ";
  }
  return($values);
}

function json_read_color($json_value){
  $values = "";
  $json_value = json_decode($json_value);
  foreach($json_value as $value){
  $values .= "<div class='color float-right mx-1' style='background-color:".$value." '></div>";
  }
  return($values);
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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />
  <link rel="stylesheet" href="admin.css">

</head>

<body>
  <!-- remove modal -->
  <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="removeModalLabel">حذف محصول</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        آیا از حذف این محصول مطمعن هستید؟
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر</button>
        <button type="button" class="btn btn-primary btn-yes-remove">بله</button>
      </div>
    </div>
  </div>
</div>
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
  <div class="container mt-4">
    <div class="row">
      <div class="col">
        <div class="display-7">محصولات</div>
      </div>
      <div class="col">
        <a href="product_add.php" class="btn btn-dark float-right d-block">اضافه کردن محصول جدید <sub> <i
        class="fas fa-plus text-white ml-2 "></i></sup></a>
      </div>
    </div>
    <hr>
    
    <table id="products" class="table mt-4 table-striped">
      <thead>
        <tr>
          <th>کد</th>
          <th>نام</th>
          <th>دسته</th>
          <th>سایز</th>
          <th>رنگ</th>
          <th>برند</th>
          <th>جنس</th>
          <th>استایل</th>
          <th>عملیات</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($database->products_index() as $product) :?>
        <tr>
          <td>
            <?= $product['code'] ?>
          </td>
          <td>
            <?= $product['name'] ?>
          </td>
          <td>
            <?=$database->find_category_name($product['category_id'])['name'];?>
          </td>
          <td>
            <span class="badge tool badge-dark p-2 pointer" data-toggle="tooltip" data-html="true" data-placement="right"
              title="<?=json_read($product['size'])?>">مشاهده</span>
          </td>
          <td>
          <span class="badge tool badge-dark p-2 pointer" data-toggle="tooltip" data-placement="right" data-html="true" 
          title="<?=json_read_color($product['color'])?>" >مشاهده</span>
          </td>
          <td>
            <?= $product['brand'] ?>
          </td>
          <td>
            <?= $product['material'] ?>
          </td>
          <td>
            <?= $product['style'] ?>
          </td>
          <td>
            <div class="btn-group btn-group-sm">
              <a href="product_edit.php?item=<?=$product['id']?>" class="btn btn-dark">
                <i class="fas fa-edit text-white"></i>
              </a>
      



              <a class="btn btn-dark btn-remove" id="<?=$product['id']?>"  data-toggle="modal" data-target="#removeModal">
                <i class="fas fa-trash text-white" ></i>
              </a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
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
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
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
  var product_for_remove_id = 0;

  //delet
  $('.btn-remove').click(function(){
    product_for_remove_id = parseInt($(this).attr("id"));
  })
  $('.btn-yes-remove').click(function(){
    $.ajax({
      url:"operator.php",
      method:"post",
      data:{
      remove:true,
      product_id:product_for_remove_id,
      }
    }).done(function(){
      document.location.reload()
    });
  })

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





  //datatable
  $(document).ready(function () {
    $('#products').DataTable({
      "pageLength":60,
      "dom": 'frtp',
      
      "language": {
        "search": "<span class='font-weight-bold'> جستجو </span>",
        "zeroRecords": "مورد مشابهی با این مشخصات یافت نشد",
        "paginate": {
          "first": "اولین",
          "last": "آخرین",
          "next": "<i class='fas fa-chevron-left'></i>",
          "previous": "<i class='fas fa-chevron-right'></i>"
        },
      },
    });
  });

  //tooltip
    $('[data-toggle="tooltip"]').tooltip({
      content: function () {
        return $(this).prop('title');
    },
    track:true

    });
</script>
</body>
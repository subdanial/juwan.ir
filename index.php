<?php
require 'vendor/autoload.php';
$klein = new \Klein\Klein();

$klein->respond('GET', '/index.php', function(){
    header('location:home.php');
});

$klein->respond('GET', '/', function(){
    header('location:home.php');
});


$klein->respond('/category', function(){
    header('location:home.php');
});


$klein->respond('GET', '/product/[:product]', function($request){
    header("location:../product.php?product=$request->product");
});

$klein->respond('GET', '/product', function(){
    header('location:product.php');
});

$klein->respond('GET', '/category/[:id]', function($request){
    header("location:../category.php?cat=$request->id");
});




$klein->dispatch();




 
<?php
    
    include_once 'ROUTE.php';
  
	ROUTE::get('/',function(){
	    header('location:home.php');
	    });

	 
	ROUTE::get('/category/{id}',function($id){
	 	header("location:../category.php?cat=$id");
	    });


	ROUTE::get('/product/{id}', function($id){
	    header("location:../product.php?product=$id");
	});


?>

<?php 

session_start();
$active_page = 'index';
include('./includes/class-autoload.inc.php');
require_once('./templates/header.php');
require_once('navbar.php'); 
$memberss = new Member();
$id_member  = $_SESSION['id_member'];

$members = $memberss->getMemberDashboard();

$checkadmin = $memberss->getProfile($id_member);

if ($checkadmin['admin'] == "1") {
      header('location: admin_dashboard.php');

    }

$products = new Product();

?>

<main class="main">
	<div class="container">
		<div class="row mt-2 pb-3" id="product-list" >
		</div>
	</div>
</main>
<footer class="py-4 bg-dark mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-center small">
                            <div class="text-muted">Copyright &copy; QueenTech 2020</div>
                            
                        </div>
                    </div>
                </footer>



    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js
"></script>
    <script type="text/javascript">
    	$(function(){

    		 function getCart(){
		    	$.get("cart.process.php", {count_cart : "count_cart"})
		    	.done(function(data){
		    		$('#cart-count').html(data);
		    	});
		    }

		    getCart();

           load_data();

      function load_data(page)  
      {  
           $.ajax({  
                url:"pagination.php",  
                method:"POST",  
                data:{page:page},  
                success:function(data){  
                $('#product-list').html(data);
                }  
           })  
      }

      $(document).on('click', '.pagination_link', function(){  
           var page = $(this).attr("id");  
           load_data(page);  
      });
    	
    	$('#button-search').click(function(e){
    		e.preventDefault();

    		var fd = $("input[name=search]").val();
    		var ct = $("#category").val()


    		$.post("search.process.php", {search: fd, category: ct})
    		.done(function(data){
    			$('#product-list').html(data);
    		});

    	});



    	});
    </script>
    
  </body>
</html>
<?php 
session_start();
require_once('./templates/header.php');

$_SESSION['timestamp'] = time();
 ?>
<nav class="navbar navigations">
  <a class="navbar-brand ml-5" href="index.php">QueenTech</a>
  <span class="text-white mr-auto font-16">Reset Password</span>
</nav>

 <main class="main">
 	<div class="container">
 		<div class="row justify-content-center align-items-center" style="height: 500px">
                            <!-- <div class="col-lg-5"> -->
                                <div class="card border-0 mt-5 pt-3 pb-4 rounded-0 shadow text-center" id="card-forgot">
                                	<button class="btn bg-transparent text--primary position-absolute" id="btn-back" style="left: 10px; top: 30px; width: 50px"><i class="fas fa-arrow-left fa-lg"></i></button>
                                    <div class="card-body">
                                        <h4 class=" font-weight-light mb-5">Reset Password</h4>
                                        <form method="POST" id="form-submit">
                                            <input type="text" class="form-control mx-auto" name="email" placeholder="Email">
 										<button class="btn bg--primary mt-3 text-white" id="btn-submit">Berikutnya</button>
                                        </form>
                                    </div>
                                </div>
                        </div>

 	</div>
 </main>

 <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
 <script type="text/javascript" src="js/bootstrap.min.js"></script>
 
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js
 "></script>
     <script>
     	$(function(){
     	
     	$('#btn-submit').click(function(e){
     		e.preventDefault();

     		var email = $('input[name=email]').val();

     		$.post("forgot_password.process.php", {email: email})
     		.done(function(data){
     			toastr.info(data);
     		})
     	})
     	})
     </script>
     
   </body>
 </html>
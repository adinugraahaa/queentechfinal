<?php 
session_start();
$active_page = "login";
include('./includes/class-autoload.inc.php');
require_once('./templates/header.php');
require_once('navbar.php');

?>

<main class="main">
	<div class="container mt-4">
		<div class="row">
			<div class="col-md-8">
				<div class="row justify-content-center">
				<div id="carouselExampleCaptions" class="carousel slide mt-5" data-ride="carousel"  >
					  <ol class="carousel-indicators">
					    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
					    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
					  </ol>
					  <div class="carousel-inner">
					    <div class="carousel-item active">
					      <img src="img/banner1.jpg" class="d-block w-100" alt="..." style="height: 450px">
					      
					    </div>
					    <div class="carousel-item">
					      <img src="img/banner3.jpg" class="d-block w-100" alt="..." style="height: 450px">
					      
					    </div>
					  </div>
					  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
					</div>
					</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header bg-sec"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputUsername">Username</label>
                                                <input class="form-control py-4" id="inputUsername" type="text" name="username" placeholder="Enter username" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" name="password" placeholder="Enter password" />
                                            </div>
                                            <div class="form-group d-none">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="#">Forgot Password?</a>
                                                <button type="submit" name="submit" class="btn bg-sec text-white" id="btn-submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
			</div>
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

<!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
        <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js
    "></script>
        <script>
        	$(function(){

                toastr.options = {
                  "closeButton": false,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": false,
                  "positionClass": "toast-top-center",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "3000",
                  "hideDuration": "1000",
                  "timeOut": "4000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut",
                }
                $('#btn-submit').click(function(e){
                    e.preventDefault();
                    var fd = $('form').serialize();
                    $.post("login.process.php", fd, function(data){
                        if(data.status){
                            toastr.success(data.message);
                            setTimeout(function(){
                                window.location.href = "login_otp.php";
                            },3000);
                        }else {
                            toastr.warning(data.message);
                        }
                    }, "json");
                });
        	});
        </script>
        
      </body>
    </html>


<?php 
// require_once('./templates/footer.php');
 ?>
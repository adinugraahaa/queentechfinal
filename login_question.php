<?php 

session_start();
// session_destroy(); die;

include('./includes/class-autoload.inc.php');
require_once('./templates/header.php');
// require_once('navbar.php');

if (!($_SESSION['Login_OTP'])) {
   header("location: login_otp.php");
}else{

$id_member = $_SESSION['id_member'];

}

 ?>

 <main class="bg-question-login main">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="row ">
                            <div class="col-md-4">
                                <div class="card border-0 mt-3 bg-transparent">
                                    <div class="card-body bg-transparent">
                                        <h3 class="text-center font-weight-light my-4">Login Personal Question</h3>
                                    	<?php $questions = new Questions(); ?>

                                    	<?php $question = $questions->getQuestionLogin($id_member); ?>
                                        <form action="" method="POST">
                                        	<div class="form-group">
												    <label for="question1" class="small mb-1">Pertanyaan 1 </label>
												    
													<textarea class="form-control py-4 mb-2" id="inputQuestion1" type="text" name="inputQuestion1" disabled ><?= $question[0]['deskripsi_pertanyaan']?></textarea>

													<input class="form-control py-4" id="inputAnswear1" type="text" name="inputAnswear1" placeholder="Enter Answear" />
												</div>
                                            <div class="form-group">
												    <label for="question2" class="small mb-1">Pertanyaan 2 </label>
												    
													<textarea class="form-control py-4 mb-2" id="inputQuestion2" type="text" name="inputQuestion2"  disabled ><?= $question[1]['deskripsi_pertanyaan']?></textarea>
													
													<input class="form-control py-4" id="inputAnswear1" type="text" name="inputAnswear2" placeholder="Enter Answear" />
												</div>
                                            <div class="form-group d-flex align-items-center justify-content-center mt-4 mb-0">
                                                <button type="submit" name="submit" class="btn" id="btn-submit" style="width: 100%">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 offset-md-1 mt-3">
                                <img src="img/login_question.jpg" alt="" class="" style="width: 100%; height: 600px">
                            </div>
                        </div>
			</div>
		</div>

	</div>
</main>
<footer class="py-4 bg-dark">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; QueenTech 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js
"></script>
    <script>
        $(function(){

             toastr.options = {
                  "closeButton": true,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": false,
                  "positionClass": "toast-top-center",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "3000",
                  "hideDuration": "1000",
                  "timeOut": "3000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut",
                };

            $('#btn-submit').click(function(e){
                e.preventDefault();

                    var fd = $('form').serialize();

                $.post('login_question.process.php', fd,function(data){
                    if (data.status == true) {
                        toastr.success(data.message);
                        setTimeout(function(){
                            window.location.href = 'index.php';
                        }, 3000);
                    }else if(data.status == "admin"){
                      toastr.success(data.message);
                        setTimeout(function(){
                            window.location.href = 'admin_dashboard.php';
                        }, 3000);
                    }
                     else{

                        toastr.warning(data.message);

                    }
                }, "json");

            }); 
        });
    </script>
    
  </body>
</html>
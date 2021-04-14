<?php 
include('./includes/class-autoload.inc.php');
require_once('./templates/header.php');
require_once('navbar.php'); 
?>



<main style="min-height: 572px">
	<div class="container mt-2">
		<?php $questions = new Questions();  ?>
		<div id="message" class="text-center"></div>
		<div class="row mt-2">
            <div class="col-6 col-md-7 mt-3">
                <img src="img/register_img.jpg" alt="ilustrator" class="img-fluid">
            </div>
            <div class="col-6 col-md-5 mt-3">
                <h4 class="h4" style="font-weight: 600">Sign Up</h4>
                <form action="" class="mt-4" >
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputUsername">Username</label>
                                    <input class="form-control form-control-sm" id="inputUsername" type="text" name="username" placeholder="Enter Username"  required/>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputPassword">Password</label>
                                    <input class="form-control form-control-sm" id="inputPassword" type="password" name="password" placeholder="Enter password" required />
                                </div>
                                    </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputNama">Nama</label>
                                    <input class="form-control form-control-sm" id="inputNama" type="text" name="nama" placeholder="Enter Nama"  required/>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputEmail">Email</label>
                                    <input class="form-control form-control-sm" id="inputEmail" type="email" name="email" placeholder="Enter Nama" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="question1" class="small mb-1">Pertanyaan 1 </label>
                            <select class="custom-select custom-select-sm" name="question1" id="question1">
                                <option selected>Choose...</option>
                                <?php foreach ($questions->getQuestion() as $question) : ?>
                                <option value="<?= $question['id'] ?>" > <?= $question['deskripsi_pertanyaan'] ?></option>
                                <?php endforeach; ?>
                              </select>
                          </div>
                          <div class="form-group">
                            <input type="text" class="form-control form-control-sm" name="questionInput1">
                          </div>
                          <div class="form-group">
                            <label for="question2" class="small mb-1">Pertanyaan 2 </label>
                            <select class="custom-select custom-select-sm" name="question2" id="question2">
                                <option selected>Choose...</option>
                                <?php foreach ($questions->getQuestion() as $question) : ?>
                                <option value="<?= $question['id'] ?>" > <?= $question['deskripsi_pertanyaan'] ?></option>
                                <?php endforeach; ?>
                              </select>
                          </div>
                          <div class="form-group">
                            <input type="text" class="form-control form-control-sm" name="questionInput2">
                          </div>        
                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small" href="login.php">Already have an account?</a>
                            <button id="btn-submit" name="submit" class="btn btn--primary">Register</button>
                        </div>
                    </form>
            </div>
		</div>
	</div>
</main>


<footer class="py-4 bg-dark mt-auto">
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
                  "closeButton": true,
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

			$.post('register.process.php', fd, function(response){
          if (response.status == true) {

				toastr.success(response.message);
				setTimeout(function(){ window.location.href = "index.php"; }, 4000);
          }else{
            toastr.warning(response.message)
            $('form')[0].reset();
          }
			}, "json");
		});


        $('#question1').change(function(){

            $('#question2 option').prop('disabled',false);

            var val1 = $(this).children("option:selected").val();

            $('#question2').children('option[value=' + val1 + ']').attr('disabled', 'disabled');
        });

        $('#question2').change(function(){

            $('#question1 option').prop('disabled',false);

            var val1 = $(this).children("option:selected").val();

            $('#question1').children('option[value=' + val1 + ']').attr('disabled', 'disabled');
        });

    	});

    </script>
  </body>
</html>

<?php 
// require_once('./templates/footer.php')
?>
<?php 
session_start();
date_default_timezone_set('Asia/Jakarta');

if(!$_SESSION['Login_Password']){
    
   header("location: login.php");
}

include('./includes/class-autoload.inc.php');
require_once('./templates/header.php');
// require_once('navbar.php'); 

?>
<div id="layoutAuthentication">
            <div id="layoutAuthentication_content" class="container-fluid">
                <main class="login-otp-bg row">
                    <div class="col-lg-4 otp-card">
                        <div class="card shadow-lg border-0 rounded-lg mt-5 text-center">
                                    <div class="card-header"><h4 class="text-center font-weight-light my-2" style="color: #39A1FF; font-weight: 900">Please enter the one time password <br> to verify your account</h4></div>
                                    <div class="card-body">
                                            <h5 class="text-center">A Code has been sent to your email</h5>
                                            <div class="d-flex bd-highlight flex-column align-items-center">
                                                
                                        <form method="" class="digit-group bd-highlight" data-group-name="digits" data-autosubmit="false" autocomplete="off" id="form-otp">
                                            <input type="hidden" name="otp1" value="">
                                    <input type="text" class="dgt" id="digit-1" name="digit-1" data-next="digit-2" autofocus="" />
                                    <input type="text" class="dgt" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
                                    <input type="text" class="dgt" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
                                    <input type="text" class="dgt" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" />
                                    <input type="text" class="dgt" id="digit-5" name="digit-5" data-next="digit-6" data-previous="digit-4" />
                                    <input type="text" class="dgt" id="digit-6" name="digit-6" data-previous="digit-5" />
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn--primary mt-4" id='btn-submit'>Submit</button>
                                    </div>
                                </form>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <span>Didn't get code?</span> <span class="resend text--primary font-weight-bold">Resend it</span>
                                </div>
                    </div>
                </div>
                </main>
            </div>
            
        </div>



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


    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js
    "></script>
    <script type="text/javascript">
        $(function(){

            function sendOTP(){
                $.post("login_otp.process.php", {sendOTP: "sendOTP"})
                .done(function(data){
                    $('input[name=otp1]').val(data);
                });
            }
            sendOTP();

            $('.resend').click(function(){
                sendOTP();
            })

            $('.digit-group').find('input').each(function() {
                $(this).attr('maxlength', 1);
                $(this).on('keyup', function(e) {
                    var parent = $($(this).parent());
                    
                    if(e.keyCode === 8 || e.keyCode === 37) {
                        var prev = parent.find('input#' + $(this).data('previous'));
                        
                        if(prev.length) {
                            $(prev).select();
                        }
                    } else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                        var next = parent.find('input#' + $(this).data('next'));
                        
                        if(next.length) {
                            $(next).select();
                        } else {
                            if(parent.data('autosubmit')) {
                                parent.submit();
                            }
                        }
                    }
                });
            });

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
                  "timeOut": "3000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut",
                }



            $('#btn-submit').click(function(e){
                    e.preventDefault();
                    var fd = $('form').serialize();
                         $.post( "login_otp.process.php", fd, function(data){
                            if (data.status) {
                                toastr.success(data.message);
                            //     setTimeout(function(){
                            //     window.location.href = "login_question.php";
                            // }, 3000);
                            }else{
                                toastr.warning(data.message);
                                $('.dgt').val('');
                            // setTimeout(function()
                            //     { location.reload(); }, 3000);
                            }
                         }, "json");
                      });

           

        
        });


    </script>
  </body>
</html>
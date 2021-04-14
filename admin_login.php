<?php 
include('./includes/class-autoload.inc.php');
// $active_page = "admin";
require_once('./templates/header.php');
require_once('navbar.php'); 
 ?>

 <div id="layoutAuthentication">
            <div id="layoutAuthentication_content2">
                <main class="main">
                    <div class="container">
                        <div class="row justify-content-center align-items-center" style="height: 500px">
                            <!-- <div class="col-lg-5"> -->
                                <div class="card border-0 mt-5 bg-transparent">
                                    <div class="card-body">
                                        <h2 class="text-center font-weight-light mb-5">Sign in</h2>
                                        <h6 class="text-center mb-5">Sign in and start managing your customer</h6>
                                        <form method="POST" id="form-submit">
                                            <input type="hidden" name="admin" value="true">
                                            <div class="form-group mb-4 d-flex justify-content-center">
                                                <label class="small mb-1 d-none" for="inputUsername">Username</label>
                                                <input class="form-control" id="inputUsername" type="username" name="username" placeholder="Login" />
                                            </div>
                                            <div class="form-group mb-4 d-flex justify-content-center">
                                                <label class="small mb-1 d-none" for="inputPassword">Password</label>
                                                <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Password" />
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-center mt-5">
                                                <a class="small d-none" href="password.html">Forgot Password?</a>
                                                <button type="submit" name="submit" class="btn btn-primary" id="btn-submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </main>
            </div>
           </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js
"></script>
    <script>
        $(function(){
            
            $('#btn-submit').click(function(e){
                e.preventDefault();

                var fd  = $('form').serialize();

                $.post("login.process.php", fd, function(data){
                        if(data.status){
                            toastr.success(data.message);
                            setTimeout(function(){
                                window.location.href = "login_otp.php";
                            },3000);
                        }else {
                            toastr.warning(data.message);
                            setTimeout(function(){
                                location.reload();
                            },3000);
                        }
                    }, "json");
            })
        })
    </script>
    
  </body>
</html>
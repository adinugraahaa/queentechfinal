<?php 
include('./includes/class-autoload.inc.php');
require_once('./templates/header.php');
require_once('navbar.php');
 ?>

 <main>
 	
 	<input type="checkbox" class="ids" name="ids[]" value="2">
<input type="checkbox" class="ids" name="ids[]" value="3">
<input type="checkbox" class="ids" name="ids[]" value="4">
<input type="checkbox" class="ids" name="ids[]" value="5">
<input type="checkbox" class="ids" name="ids[]" value="6">

<div id="response"></div>
<button id="submit">Submit</button>

 </main>



 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
 
     <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js
 "></script>
     <script>
     	$(function(){
     	$('#submit').click(function() {

			$.ajax({
			    url: "stub.php",
			    type: "post",
			    data: $('.ids:checked').serialize(),
			    success: function(data) {
			    $('#response').html(data);
			    }
			});


			});
     	})
     </script>
     
   </body>
 </html>
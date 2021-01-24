<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to CodeIgniter 4!</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
	<link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

	<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>

	<!-- STYLES -->

</head>
<body>
	<!-- Image and text -->
	<nav class="navbar navbar-light bg-light">
	  <a class="navbar-brand" href="#">
	    <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
	    Bootstrap
	  </a>
	</nav>
	<div class="container mt-4">
		<?php if(session()->getFlashdata('pesan')) : ?>
		<div class="alert alert-success" role="alert">
		  <?= session()->getFlashdata('pesan') ?>
		</div>
		<?php endif; ?>

		<div class="card">
		  <h5 class="card-header">Isi data kamu</h5>
		  <div class="card-body">
		    <form>
		      <?= csrf_field(); ?>
		      <?php
		      		$name = '';
                    if(session()->get('name')!=''){
                        $name = session()->get('name');
                    }
                    $email = '';
                    if(session()->get('email')!=''){
                        $email = session()->get('email');
                    }
                    $phone = '';
                    if(session()->get('phone')!=''){
                        $phone = session()->get('phone');
                    }
                ?>
		      <div class="form-group">
			    <label for="nama">Nama</label>
			    <input type="text" class="form-control" id="name" name="name" aria-describedby="nama" placeholder="Nama" autofocus="autofocus" required onkeyup="validate()" value="<?=$name; ?>">
			    <div class="invalid-feedback">
        			Tidak boleh kosong
      			</div>
			    <small id="emailHelp" class="form-text text-muted">Nama lengkap kamu</small>
			  </div>
			  <div class="form-group">
			    <label for="email">Email</label>
			    <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Email" required onkeyup="validate()" value="<?=$email; ?>" pattern="/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i">
			    <div class="invalid-feedback">
        			Tidak boleh kosong
      			</div>
			    <small id="emailHelp" class="form-text text-muted">Email Kamu</small>
			  </div>
			  <div class="form-group">
			    <label for="phone">No. Handphone</label>
			    <input type="phone" class="form-control" id="phone" name="phone" aria-describedby="phone" placeholder="No. Handphone" required onkeyup="validate()" value="<?=$phone; ?>" pattern="/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/">
			    <div class="invalid-feedback">
        			Tidak boleh kosong
      			</div>
			    <small id="emailHelp" class="form-text text-muted">No. Handphone Kamu</small>
			  </div>
			   <div class="form-group">
			    <input type="hidden" class="form-control" id="lat" name="lat">
			    <input type="hidden" class="form-control" id="longt" name="longt">
			  </div>
			  <p id="demo"></p>
			  <div class="form-check">
			  </div>
			  <button type="button" class="btn btn-primary" id="send">Submit</button>
			</form>
		  </div>
		</div>
	</div>

	<script type="text/javascript">
	  	$(".alert").delay(5000).slideUp(1000);


	  	(function($) {
          $.fn.inputFilter = function(inputFilter) {
            return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
              if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
              } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
              } else {
                this.value = "";
              }
            });
          };
        }(jQuery));
        
	  	$("#phone").inputFilter(function(value) {
	            return /^[+-]?\d*$/.test(value); 
	    });

		var x = document.getElementById("demo");

		getLocation();
		function getLocation() {
		  if (navigator.geolocation) {
		    navigator.geolocation.getCurrentPosition(showPosition);
		  } else { 
		    x.innerHTML = "Geolocation is not supported by this browser.";
		  }
		}

		function showPosition(position) {
			$("#lat").val(position.coords.latitude);
			$("#longt").val(position.coords.longitude);
		}

		function validate(){
			if($("#name").val()==""){
				$("#name").addClass("is-invalid");
				$("#name").removeClass("is-valid");
			}else{
				$("#name").addClass("is-valid");
				$("#name").removeClass("is-invalid");
			}

			if($("#email").val()==""){
				$("#email").addClass("is-invalid");
				$("#email").removeClass("is-valid");
			}else{
				$("#email").addClass("is-valid");
				$("#email").removeClass("is-invalid");
			}

			if($("#phone").val()==""){
				$("#phone").addClass("is-invalid");
				$("#phone").removeClass("is-valid");
			}else{
				$("#phone").addClass("is-valid");
				$("#phone").removeClass("is-invalid");
			}
		}


		function post(){
			$.ajax({
				type  : 'POST',
			    url: "/home/post",
			    headers: {'X-Requested-With': 'XMLHttpRequest'},
			    dataType : 'json',
	            data: {
	                name:$('#name').val(),
	                email:$('#email').val(),
	                phone:$('#phone').val(),
	                lat:$('#lat').val(),
	                longt:$('#longt').val(),
	                csrf:$("input[name=csrf_test_name]").val()
	            },
	            success : function(data){
	            	location.reload();
	            }
			});
		}

		 $('#send').click(function(){
		 	getLocation();
		 	navigator.geolocation.watchPosition(function(position) {
			},function(error) {
			    if (error.code == error.PERMISSION_DENIED){
			      alert("Please Allow Location");
			    }
			});
			if($("#name").val()!="" && $("#email").val()!="" && $("#phone").val()!=""){ 
				// $(this).closest('form').trigger('submit');
				post();
			}else{
				alert("Data tidak boleh kosong");
				if($("#name").val()==""){
					$("#name").addClass("is-invalid");
				} else if($("#email").val()==""){
					$("#email").addClass("is-invalid");
				} else if($("#phone").val()==""){
					$("#phone").addClass("is-invalid");
				}
			}
	    });

	</script>
</body>
</html>

<!-- Ajax Register -->

<script language="javascript">
$(document).ready(function() {
	
		// show a simple loading indicator
		var loader = jQuery('<div id="loader"><img src="img/fancybox_loading@2x.gif" alt="loading..."></div>')
			.css({
				position: "relative",
				top: "1em",
				left: "25em",
				display: "inline"
			})
			.appendTo("body")
			.hide();
		jQuery().ajaxStart(function() {
			loader.show();
		}).ajaxStop(function() {
			loader.hide();
		}).ajaxError(function(a, b, e) {
			throw e;
		});
            //the min chars for username  
            var min_chars = 3;  
      
            //result texts  
            var checking_html = 'Checking...';  
      
            //when input changed  
            $('#email2').change(function(){  
                //run the character number check  
				var email = $('#email2').val();  
				//use ajax to run the check  

				$('#email2-error').removeClass('has-error'); // add the error class to show red input
				$('#email2-error').html(''); // add the actual error message under our input
				if (validateEmail(email)) {
					$('#email2-error').html(checking_html);  
					check_email_availability();
				
				} else { 
					$('#email2-error').addClass('has-error'); // add the error class to show red input
					$('#email2-error').html('<div class="help-block">Email :' + email + ' tidak valid</div>'); // add the actual error message under our input
					$("#submit").attr("disabled",true);
					email.focus;
					return false;
				}	
            });  
      
      });  
	function validateEmail(email) {
	  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	  return re.test(email);
	}      
    //function to check email availability  
    function check_email_availabilityx(){  
            //get the email  
            var email = $('#email2').val();  
            //use ajax to run the check  
			
            $.post("<?php echo $this->baseUrl();?>/user/cekemail", {email:email}, 
                function(result){  
					alert(result);

                    //if the result is 1  
                    if(result == 0){  
                        //show that the email is available  
						$('#email2-error').addClass('has-error'); // add the error class to show red input
						$('#email2-error').html('<div class="help-block">Email :' + email + ': OK</div>'); // add the actual error message under our input
						$("#submit").attr("disabled",false);
                    }else{  
                        //show that the username is NOT available  
						$('#email2-error').addClass('has-error'); // add the error class to show red input
						$('#email2-error').html('<div class="help-block">Email :' + email + ' sudah terdaftar</div>'); // add the actual error message under our input
						$("#submit").attr("disabled",true);
						//$('#email').val("");
                    }  
            });  
      
    }  
function check_email_availability(){
//var n_user = document.getElementById('n_user').value ;
 var email = $('#email2').val(); 
 //alert(email);
var url = "<?php echo $this->baseUrl();?>/user/cekemail";
var opt = {email:email};

jQuery.get(url,opt, function(data) {	

                    if(data == 0){  
                        //show that the email is available  
						$('#email2-error').addClass('has-error'); // add the error class to show red input
						$('#email2-error').html('<div class="help-block">Email :' + email + ': OK</div>'); // add the actual error message under our input
						$("#submit").attr("disabled",false);
                    }else{  
                        //show that the username is NOT available  
						$('#email2-error').addClass('has-error'); // add the error class to show red input
						$('#email2-error').html('<div class="help-block">Email :' + email + ' sudah terdaftar</div>'); // add the actual error message under our input
						$("#submit").attr("disabled",true);
						//$('#email').val("");
                    }  


});

alert(data);
}    

function KirimData()
    {
		//alert('Testing2');
        $("#registerForm").ajaxSubmit(inst_data);
    }
	
	var inst_data = {
		target:'',
		beforeSubmit: function() {	
			var email 	 = document.getElementById('email2').value;
			var nama 	 = document.getElementById('nama').value;
			var phone 	 = document.getElementById('phone').value;
			
			var recaptcha= document.getElementById("recaptcha").value;
			var validRecaptcha=0;

			//alert (d_wbls_incident);
				if (!email) {
					//alert('Uraian Harus Diisi.');
					document.getElementById('email2-error').innerHTML ='Email Harus Diisi.';
					document.getElementById('email2').focus();
					exit;
				}else document.getElementById('email2-error').innerHTML ='';
				if (!nama) {
					//alert('Perkiraan Waktu Harus Diisi.');
					document.getElementById('nama-error').innerHTML ='Nama Harus Diisi.';
					document.getElementById('nama').focus();
					exit;
				}else document.getElementById('nama-error').innerHTML ='';
				if (phone) {
					if(!/^[0-9]+$/.test(phone)){
					//alert("Please only enter numeric characters only for your Age! (Allowed input:0-9)")
	  					//alert('Silahkan isi Terlapor.');
						document.getElementById('phone-error').innerHTML ='Silahkan isi dengan angka: 0-9.';
						document.getElementById('phone').focus();
						exit;
					}else document.getElementById('phone-error').innerHTML ='';
				}
				for(var z=0; z<6; z++){
					if(recaptcha.charAt(z)!= captcha[z]){
						validRecaptcha++;
					}
				}
				if (recaptcha == ""){
					//alert('Kode Captcha Harus Diisi');
					document.getElementById('recaptcha-error').innerHTML ='Kode Captcha Harus Diisi.';
					document.getElementById('recaptcha').focus();
					//document.getElementById('errCaptcha').innerHTML = 'Re-Captcha must be filled';
					exit;
				} else if (recaptcha != code){
					//alert('Maaf,Kode Captcha salah.');
					document.getElementById('recaptcha-error').innerHTML ='Maaf,Kode Captcha salah.';
					document.getElementById('recaptcha').focus();
					//document.getElementById('errCaptcha').innerHTML = 'Sorry, Wrong Re-Captcha';
					exit;
				}else document.getElementById('recaptcha-error').innerHTML =''; 			
			}, 
		success:function(){	
			//$("#pengaduan").hide();
			$('#registerBox').modal('hide');
			//$('#bodybook').html(resp.message);       
			$('#confirmRegister').modal('show');	
			document.getElementById('registerForm').reset();
			//location.href="#";		
			//location.reload(true)
			//open_url_to_div('<?php echo $this->baseUrl(); ?>/pengaduan/index');
		},
		url: '<?php echo $this->baseUrl();?>/user/register',
		type: 'post',
		resetForm: false
	};
</script>
<!-- Modal Poppup Register -->
<div class="modal hide fade" id="registerBox">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content form-elegant">
      
        <!-- Modal Header -->
        <div class="modal-header text-center">
					<h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"><strong>Register</strong></h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
		</div>
        
        <!-- Modal body -->
        <div class="modal-body mx-4">
            <form id="registerForm" method="post">
				<div class="md-form mb-5">
				  <input type="email" class="form-control" name="email2" id="email2" placeholder="Alamat Email" required="required">
				  <label id="email2-error" for="email2" class="error"></label>
				</div>
				<div class="md-form mb-5">
				  <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required="required">
					<label id="nama-error" for="nama" class="error"></label>
				</div>
				<div class="md-form mb-5">
				  <input type="text" class="form-control" name="phone" id="phone" placeholder="Telephone">
					<label id="phone-error" for="nama" class="error"></label>
				</div>
				<div class="md-form mb-5">
					<div id="captcha2"></div><button type="button" class='btn btn-danger btn-sm mar-ed-button' onclick="recaptchaa()">Recaptcha</button>
					<input type="text" name="recaptcha" id="recaptcha" placeholder="Type the captcha"/ class="form-control">
					<label id="recaptcha-error" for="recaptcha" class="error"></label>
				</div>
				
				
 
                <div class="row form-row">
                    <div class="col-lg-12 mb-3">
                        <!-- <input type="submit" value="Register" class="btn btn-success"> -->
						<div class="text-center mb-3">
						  <button type="button" id="submit" value="Register" class="btn blue-gradient btn-block btn-rounded z-depth-1a" onClick="KirimData()">REGISTER</button>

						</div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer mx-5">
          <p class="font-small grey-text d-flex justify-content-end">Memiliki Akun? <a data-toggle="modal" class="blue-text ml-1" data-dismiss="modal" href="#loginBox">Login</a></p>
        </div>
        
      </div>
    </div>
  </div>
<!-- End Modal Register -->
<!-- NOTIF REGISTER-->
<div class="modal hide fade" tabindex="-1" role="dialog" id="confirmRegister">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodybook">Terima kasih Anda telah melakukan registrasi akun di WBS PT. Dirgantara Indonesia. Silakan cek email Anda untuk melakukan cek password Anda.
      </div>

    </div>
  </div>
</div>
<script>
var code;
function createCaptcha() {	
  //clear the contents of captcha div first 
  document.getElementById('captcha2').innerHTML = "";
  var charsArray =
  "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
  var lengthOtp = 6;
  var captcha = [];
  for (var i = 0; i < lengthOtp; i++) {
    //below code will not allow Repetition of Characters
    var index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
    if (captcha.indexOf(charsArray[index]) == -1)
      captcha.push(charsArray[index]);
    else i--;
  }
  var canv = document.createElement("canvas");
  canv.id = "captcha";
  canv.width = 100;
  canv.height = 50;
  var ctx = canv.getContext("2d");
  ctx.font = "25px Georgia";
  ctx.strokeText(captcha.join(""), 0, 30);
  //storing captcha so that can validate you can save it somewhere else according to your specific requirements
  code = captcha.join("");
  document.getElementById("captcha2").appendChild(canv); // adds the canvas to the body element
}
function validateCaptcha() {
  event.preventDefault();
  debugger
  if (document.getElementById("cpatchaTextBox").value == code) {
    alert("Valid Captcha")
  }else{
    alert("Invalid Captcha. try Again");
    createCaptcha();
  }
}
function recaptchaa() {
    createCaptcha();
}
createCaptcha();
</script>
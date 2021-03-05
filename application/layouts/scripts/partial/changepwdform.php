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
		
		jQuery.validator.addMethod("pwdCheck", function(value) {
		   return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) && /[a-z]/.test(value) && /\d/.test(value) // has a digit
		});

	// process the form
		var v=$("#chgpwdForm").validate({
			rules: {
				oldpassword: {
					required: true
				},
				newpassword: {
					required: true,
					minlength: 6,
					pwdCheck: true
				},
				newpassword2: {
					required: true,
					minlength: 6,
					equalTo: "#newpassword",
					pwdCheck: true
		                 // set this on the field you're trying to match
				}
			},
			messages: {
				oldpassword: {
			            required: "Masukkan Kata Sandi Lama",
			            minlength: "Kata Sandi tidak kurang dari 6 karakter"
			        },
				newpassword: {
			            required: "Masukkan Kata Sandi Baru",
			            minlength: "Kata Sandi tidak kurang dari 6 karakter",
				    pwdCheck: "Password Anda harus mengandung huruf kecil, huruf besar, dan angka"
			        },
			        newpassword2: {
			            required: "Masukkan Ulang Kata Sandi Baru",
			            minlength: "Kata Sandi tidak dkurang dari 6 karakter",
			            equalTo: "Password Baru tidak cocok", // custom message for mismatched passwords,
				    pwdCheck: "Password Anda harus mengandung huruf kecil, huruf besar, dan angka"

				}
				
			},
       submitHandler: function(form,e) {
       //alert("OK");
            e.preventDefault();
            console.log('Form submitted');
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->baseUrl();?>/user/changepwd',
                dataType: "html",
                data: $('form').serialize(),
                success: function(result) {
					 //window.location.href = "./";
					 //v.resetForm();
                    // disablePopup();
		    $('#chgpwdBox').modal('hide');
		    $('#confirmChgpwd').modal('show');
		    document.getElementById('chgpwdBox').hide();
		    document.getElementById('chgpwdForm').reset();
                },
                error : function(error) {

                }
            });
            return false;
        }			
	});
});
</script>
<!-- Modal Poppup Change Password -->
<div class="modal hide fade" id="chgpwdBox2" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content form-elegant">
      
        <!-- Modal Header -->
        <div class="modal-header text-center">
					<h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"><strong>Ganti Password</strong></h3>
		</div>
        
        <!-- Modal body -->
        <div class="modal-body mx-4">
            <form id="chgpwdForm" method="post">
				<div class="md-form mb-5">
				  <input type="hidden" class="form-control" name="email3" id="email3" value="<?php echo $this->email;?>">
				  <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="Kata Sandi Lama" required="required">
				</div>
				<div class="md-form mb-5">
				  <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="Kata Sandi Baru" required="required">
				</div>
				<div class="md-form mb-5">
				  <input type="password" class="form-control" name="newpassword2" id="newpassword2" placeholder="Ulang Kata Sandi Baru" required="required">
				</div>
                <!-- <div class="row form-row">
                    <div class="col-lg-4 form-left">
                        <label for="">Captcha <span class="mandatory">*</span></label>
                    </div>
                    <div class="col-lg-3">
                        <p>
                            <input data-validation="recaptcha" data-validation-recaptcha-sitekey="[RECAPTCHA_SITEKEY]">
                        </p>
                    </div>
                </div> -->
                <div class="row form-row">
                    <div class="col-lg-12 mb-3">
                        <!-- <input type="submit" value="Register" class="btn btn-success"> -->
						<div class="text-center mb-3">
						  <button type="submit" value="Register" class="btn blue-gradient btn-block btn-rounded z-depth-1a">Simpan</button>
						</div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal footer -->

        
      </div>
    </div>
  </div>
<!-- End Modal Change Passsword -->
<!-- NOTIF REGISTER-->
<div class="modal hide fade" tabindex="-1" role="dialog" id="confirmChgpwd">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Anda telah berhasil mengganti password akun Anda.</p>
      </div>

    </div>
  </div>
</div>
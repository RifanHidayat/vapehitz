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

	// process the form
	
		var v=$("#loginform").validate({
			rules: {
				email: {
					required: true,
					email: true
				},
				password: {
					required: true
				},
			},
			messages: {
				email: {
					required: "Masukkan Email Anda",
					email: "Masukkan format email yang benar"
				},
				password: {
					required: "Silakan Masukkan password Anda"
				}
			},
       submitHandler: function(form,e) {
       //alert("OK");
            e.preventDefault();
            console.log('Form submitted');
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->baseUrl();?>/user/login',
                dataType: "html",
                data: $('form').serialize(),
		success: function(data){
		
		   //if(data.success == true){ // if true (1)
		      //setTimeout(function(){// wait for 5 secs(2)
		           location.reload(); // then reload the page.(3)
		      //}, 5000); 
		  // }
		},
                error : function(error) {

                }
            });
            return false;
        }			
		});
		
});



</script>
<!-- Modal Poppup Login -->
<div class="modal hide fade" id="loginBox">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content form-elegant">
      
        <!-- Modal Header -->
	
        <div class="modal-header text-center">
					<h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"><strong>Login</strong></h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
		</div>
        
        <!-- Modal body -->
        <div class="modal-body mx-4">
           <form  class="form-login" id="loginform" method="POST">
				<div class="md-form mb-5">
				  <input type="email" class="form-control" name="email" id="email" placeholder="Alamat Email" required="required">
				<?php
				  echo $this->hasil;
				?>
				</div>
				<div class="md-form mb-5">
				  <input type="password" class="form-control" name="password" id="password" placeholder="Kata Sandi" required="required">
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
                        <!-- <input type="submit" value="login" class="btn btn-success"> -->
						<div class="text-center mb-3">
						  <button type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a">LOGIN</button>
						</div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer mx-5">
          <p class="font-small grey-text d-flex justify-content-end">Belum Memiliki Akun? <a data-toggle="modal" class="blue-text ml-1" data-dismiss="modal" href="#registerBox">Daftar</a> &nbsp;| <a data-toggle="modal" class="blue-text ml-1" data-dismiss="modal" href="#forgetBox">Lupa Password</a></p>
        </div>
        
      </div>
    </div>
  </div>
<!-- End Modal Login -->

<!-- Ajax Forget -->
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
		var v=$("#forgetForm").validate({
			rules: {
				email4: {
					required: true,
					email: true
				}
			},
			messages: {
				email4 :{
					required: "Masukkan Email Anda",
					email: "Masukkan format email yang benar"
				}
				
			},
       submitHandler: function(form,e) {
       //alert("OK");
            e.preventDefault();
            console.log('Form submitted');
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->baseUrl();?>/user/forgetpwd',
                dataType: "html",
                data: $('form').serialize(),
                success: function(result) {
					 //window.location.href = "./";
					 //v.resetForm();
                    // disablePopup();
                    $('#forgetBox').modal('hide');
                    $('#confirmForget').modal('show');
					document.getElementById('forgetForm').reset();
                },
                error : function(error) {

                }
            });
            return false;
        }			
		});
});
</script>
<!-- Modal Poppup Forget -->
<div class="modal hide fade" id="forgetBox">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content form-elegant">
      
        <!-- Modal Header -->
        <div class="modal-header text-center">
					<h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"><strong>Lupa Password</strong></h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
		</div>
        
        <!-- Modal body -->
        <div class="modal-body mx-4">
            <form id="forgetForm" method="post">
				<div class="md-form mb-5">
				  <input type="email" class="form-control" name="email4" id="email4" placeholder="Alamat Email" required="required">
				</div>
                <div class="row form-row">
                    <div class="col-lg-12 mb-3">
                        <!-- <input type="submit" value="Forget" class="btn btn-success"> -->
						<div class="text-center mb-3">
						  <button type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a">KIRIM</button>
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
<div class="modal hide fade" tabindex="-1" role="dialog" id="confirmForget">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Password sudah dikirim ke email Anda</p>
      </div>

    </div>
  </div>
</div>
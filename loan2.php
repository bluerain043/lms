<?php
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	$currDir = dirname(__FILE__); 
	include_once("{$currDir}/config/db.php");
	include_once("{$currDir}/class/Users.php");
	include_once("{$currDir}/lib/functions.php");
	include_once("{$currDir}/template/header.php");


?>

<!-- start loan div -->
 
   <div class="notika-email-post-area mg-tb-30">
        <div class="container">
            <div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="notika-icon notika-form"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Book Loan Form</h2>
										<p>Fill-up form to loan a book</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									<button data-toggle="tooltip" data-placement="left" title="" class="btn waves-effect" data-original-title="Download Report"><i class="notika-icon notika-sent"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<!-- page content goes here -->
						<div class="form-element-list">
						
						<div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" placeholder="Full Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-mail"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" placeholder="Email Address">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-phone"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" placeholder="Contact Number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-map"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" placeholder="Location">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-next"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" placeholder="Postal Code">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-mail"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" placeholder="Message">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-star"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" placeholder="Notification">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-travel"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" placeholder="Flight">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-dollar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" placeholder="Dollar">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-wifi"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" placeholder="Internet">
                                    </div>
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-cloud"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-house"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" placeholder="Home Address">
                                    </div>
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-success"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int form-elet-mg">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" placeholder="Layer">
                                    </div>
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-chat"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="btn-list mg-tb-30">
                            <button class="btn btn-default notika-btn-default waves-effect">Clear</button>
                            <button class="btn btn-success notika-btn-success waves-effect">Save</button>
                            <button class="btn btn-danger notika-btn-danger waves-effect">Cancel</button>
                        </div>
                    </div>
					<!-- end page content -->
                </div>
            </div>
        </div>
    </div>
<!-- end load div -->

<?php
	include_once("{$currDir}/template/footer.php"); ?>

<script type='text/javascript'>
    $(document).ready(function() {
    	
    	/*$('#login').on('click', function(e){
    		 e.preventDefault();
    		 alert('login');
    		 $('#login-form').submit();

    	});*/
    });
</script>
</body>

</html>


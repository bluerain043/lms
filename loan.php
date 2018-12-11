<?php
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	$currDir = dirname(__FILE__); 
	include_once("{$currDir}/config/db.php");
	include_once("{$currDir}/class/Users.php");
	include_once("{$currDir}/lib/functions.php");
	include_once("{$currDir}/layout/header.php");

	$allBooks = Books::getBookByStatus();




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



                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 loan">
					<!-- page content goes here -->
						<div class="form-element-list">
						    <form action="" method="post" class="loan-form">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                              <i class="notika-icon notika-support">  Patron </i>
                                            </div>
                                            <div class="chosen-select-act fm-cmp-mg">

                                            <select class="chosen" name="members" data-placeholder="Choose a Member...">
                                                <?php
                                                    foreach ($members as $key => $value) {
                                                        echo  "<option value=".$value['members'].">".$value['name']."</option>";
                                                    }
                                                ?>

                                            </select>
                                                <input type="hidden" name="action" value="entry"/>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-star"> ISBN</i>
                                            </div>
                                            <!--<div class="nk-int-st">
                                                <input type="text" class="form-control isbn" data-mask="999-99-999-9999-9" placeholder="ISBN">
                                            </div>-->
                                            <div class="chosen-select-act fm-cmp-mg">
                                                <select class="chosen isbn" name="isbn_no" data-placeholder="Choose a Member...">
                                                    <?php
                                                    foreach ($allBooks as $key => $value) {
                                                        /*echo  "<option value=".$value['isbn_no'].">".$value['isbn_no']."</option>";*/
                                                        echo  "<option class ='status-".$value['status']."' value=".$value['isbn_no'].">".$value['isbn_no']."</option>";
                                                        /*echo  "<option value=".$value['isbn_no'].">".$value['text-display']." </option>";*/

                                                    }
                                                    ?>
                                                   <!-- <option data-content="<i class='fa fa-address-book-o' aria-hidden='true'></i>Option1"></option>-->
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                 </div>

                                 <div class="row">

                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                         <div class="form-group ic-cmp-int">
                                             <div class="form-ic-cmp">
                                                 <i class="notika-icon notika-star"> Book Title</i>
                                             </div>
                                             <div class="nk-int-st">
                                                 <input type="text" class="form-control type book_title" name="book_title" placeholder="Book Title" disabled>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                         <div class="form-group ic-cmp-int">
                                             <div class="form-ic-cmp">
                                                 <i class="notika-icon notika-support"> Author</i>
                                             </div>
                                             <div class="nk-int-st">
                                                 <input type="text" class="form-control author_name" name="author_name" placeholder="Author" disabled>
                                             </div>
                                         </div>
                                     </div>

                                 </div>

                                <div class="row">

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-star"> Book Type</i>
                                            </div>
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control type booktype" name ="book_type" placeholder="Book Type" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-support"> Publisher</i>
                                            </div>
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control publisher" name ="publisher" placeholder="Publisher" disabled>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-support"> Issued By</i>
                                            </div>
                                            <div class="nk-int-st">
                                                <input type="hidden" name="issued_by" value="<?php echo $_SESSION['userid']; ?>">
                                                <input type="text" class="form-control issued" name ="Publisher" placeholder="Issued By" value="<?php echo $_SESSION['name']; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                        <div class="form-group nk-datapk-ctm form-elet-mg ic-cmp-int" id="data_1">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-calendar   "> Due Date</i>
                                            </div>
                                            <div class="input-group date nk-int-st">
                                                <span class="input-group-addon"></span>
                                                <input type="text" class="form-control" name="due_date" value="03/19/2018">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="btn-list mg-tb-30">
                                    <button class="btn btn-default btn-clear notika-btn-default waves-effect">Clear</button>
                                    <button class="btn btn-success btn-save notika-btn-success waves-effect">Save</button>
                                    <!--<button class="btn btn-danger btn-cancel notika-btn-danger waves-effect">Cancel</button>-->
                                </div>
                            </form>
                    </div>
					<!-- end page content -->
                </div>
            </div>
        </div>
    </div>
<!-- end load div -->

<?php
	include_once("{$currDir}/layout/footer.php"); ?>

<script type='text/javascript'>
    $(document).ready(function() {
        $form = $('.loan-form');
           $(".isbn").bind("blur change ", function(e) {
                   e.preventDefault();
                   $isbn = $(this).val();
                   if($isbn){
                       var sFormData = { 'isbn' : $isbn, 'action' : 'loan' },
                           fnCallback = function (res){console.log(res);
                               $.each(res, function(k, v) {
                                   console.log(k);
                               });
                                /*if(res['status'] == 1) alert('Book is currently not available');
                                else{
                                    $('.book_title').val(res['book_title']);
                                    $('.author_name').val(res['author_name']);
                                    $('.booktype').val(res['booktype']);
                                    $('.author_name').val(res['author_name']);
                                    $('.edition').val(res['edition']);
                                    $('.pages').val(res['pages']);
                                    $('.price').val(res['price']);
                                    $('.publisher').val(res['publisher']);
                                    $('.publisher').val(res['publisher']);
                                }*/

                           };
                       common.request
                           .fnAjax('./services/ajaxGetBookDetails.php', 'GET', 'json', sFormData)
                           .done($.isFunction(fnCallback) ? fnCallback : null);
                   }

           });

           $('.btn-clear').on('click', function(e){
               e.preventDefault();
               $form[0].reset();
           });

        $('.btn-save').on('click', function(e){
            e.preventDefault();
            console.log($form.serialize());
            fnCallback = function (response){
                if(response == 'success')alert("Book Loan Successfully");
                else if(response == 'failed') alert("Book is currently unavailable")
                else alert(response);
                $form[0].reset();
            };
            common.request
                .fnAjax('./services/ajaxGetBookDetails.php', 'POST', 'json', $form.serializeArray())
                .done($.isFunction(fnCallback) ? fnCallback : null);
        });



    });
</script>
</body>

</html>


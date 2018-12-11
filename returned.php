<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require __DIR__.'/config/db.php';
require __DIR__.'/class/Users.php';
require __DIR__.'/lib/functions.php';
require __DIR__.'/class/Books.php';
require __DIR__.'/class/BookIssued.php';
require __DIR__.'/layout/header.php';

//$d = BookIssued::getBookIssuedByIsbn('978-0-8308-5810-1');var_dump($d);die;


$allBooks = Books::getBookByStatus(Books::BOOK_STAT_ISSUED);




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
                                    <h2>Book Returned Form</h2>
                                    <p>Please enter ISBN number of the returned book</p>
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
                                        <i class="notika-icon notika-star"> ISBN</i>
                                    </div>
                                    <div class="chosen-select-act fm-cmp-mg">
                                        <select class="chosen isbn" name="isbn_no" data-placeholder="Choose a Member...">
                                            <?php
                                            foreach ($allBooks as $key => $value) {
                                                echo  "<option class ='status-".$value['status']."' value=".$value['isbn_no'].">".$value['isbn_no']."</option>";
                                             }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support">  Patron </i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control name" name="name" placeholder="Author" disabled>
                                    </div>

                                    <input type="hidden" name="action" value="returned"/>
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
                                        <input type="hidden" name="cleared_by" value="<?php echo $_SESSION['userid']; ?>">
                                        <input type="text" class="form-control issued" name ="Publisher" placeholder="Issued By" value="<?php echo $_SESSION['name']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                <div class="form-group nk-datapk-ctm form-elet-mg ic-cmp-int" id="data_1">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-calendar"> Due Date</i>
                                    </div>
                                    <div class="input-group date nk-int-st">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control due_date" name="due_date" value="03/19/2018">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--<div class="cmp-tb-hd cmp-int-hd">
                            <h2>Members Details</h2>
                        </div>-->
                        <div class="breadcomb-wp  mg-tb-30">
                            <div class="breadcomb-icon">
                                <i class="notika-icon notika-support"></i>
                            </div>
                            <div class="breadcomb-ctn">
                                <h2>Member's Details</h2>
                                <p>Members details are not editable in these page.</p>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"> Patron Name</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control name" placeholder="Full Name" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-mail"> Email</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control email" placeholder="Email Address" disabled>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-phone"> Contact No.</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control contact" placeholder="Contact Number" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-map"> Community</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control community_name" placeholder="Community" disabled>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-calendar"> Signup Date</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control signup_date" placeholder="Signup Date" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-travel"> Is Banned?</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control is_banned" placeholder="Is Banned?" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-calendar"> Number of overdue days:</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control days_of_overdue" placeholder="Number of overdue days" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-dollar fines-label"> Total Fines</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control total_fines" placeholder="Total Fines">
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

require __DIR__.'/layout/footer.php';
?>

<script type='text/javascript'>
    $(document).ready(function() {
        $form = $('.loan-form');
        $(".isbn").bind("blur change ", function(e) {
            e.preventDefault();
            $isbn = $(this).val();
            if($isbn){
                var sFormData = { 'isbn' : $isbn, 'action' : 'returned' },
                    fnCallback = function (res){
                        $.each(res, function(k, v) {
                            if(k == 'is_banned' && v == 0) $('.'+k).val('No');
                            else if(k == 'is_banned' && v == 1) $('.'+k).val('Yes');
                            else $('.'+k).val(v);

                        });

                       /* if(res['status'] == 0) alert('Book is currently not available');
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


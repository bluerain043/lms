<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$currDir = dirname(__FILE__);
include_once("{$currDir}/config/db.php");
include_once("{$currDir}/class/Users.php");
include_once("{$currDir}/class/Types.php");
include_once("{$currDir}/lib/functions.php");
include_once("{$currDir}/layout/header.php");

$types = Types::getAllTypes();

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
                                    <h2>Book Entry</h2>
                                    <p>Fill-up form to add a book entry</p>
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
                    <form action="./services/ajaxGetBookDetails.php" method="post" class="add-books-form">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-star"> ISBN No</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control isbn" name="isbn_no" data-mask="999-99-999-9999-9" placeholder="ISBN" required>
                                    </div>

                                </div>

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">

                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"> Book Title</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control type book_title" name="book_title" placeholder="Book Title" required>
                                    </div>
                                    <input type="hidden" name="action" value="addBooks"/>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"> Author</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control author_name" name="author_name" placeholder="Author" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-star"> Book Type</i>
                                    </div>
                                    <div class="bootstrap-select fm-cmp-mg">
                                        <select class="selectpicker book_type" name="book_type" data-placeholder="Choose book type" required>
                                            <?php
                                                foreach ($types as $key => $value) {
                                                    echo  "<option value=".$value['id'].">".$value['name']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">


                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"> Publisher</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control publisher" name ="publisher" placeholder="Publisher">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"> Edition</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control edition" name ="edition" placeholder="Edition">
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                <div class="form-group nk-datapk-ctm form-elet-mg ic-cmp-int" id="data_1">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-calendar"> Purchase Date</i>
                                    </div>
                                    <div class="input-group date nk-int-st">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" name="purchase_date" value="2018/03/19">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-app"> Pages</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control pages" name ="pages" placeholder="Pages" data-mask="999999">
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-dollar"> Price</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control price" name ="price" placeholder="Price" data-mask="9999.99" >
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="btn-list mg-tb-30">
                            <button class="btn btn-default btn-clear notika-btn-default waves-effect">Clear</button>
                            <button class="btn btn-success btn-save notika-btn-success waves-effect">Add</button>
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
        $form = $('.add-books-form');

        $('.btn-clear').on('click', function(e){
            e.preventDefault();
            $form[0].reset();
        });

        $('.btn-save').on('click', function(e){
            e.preventDefault();
            console.log($form.serialize());
            fnCallback = function (response){
                 if(response == 'success') alert("Books added successfully");
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


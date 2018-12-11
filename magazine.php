<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$currDir = dirname(__FILE__);
include_once("{$currDir}/config/db.php");
include_once("{$currDir}/class/Magazines.php");
include_once("{$currDir}/lib/functions.php");
include_once("{$currDir}/layout/header.php");

$magazines = Magazines::getAllMagazines();

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
                                    <h2>Magazine Entry</h2>
                                    <p>Fill-up form to add a magazine on the list</p>
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
                    <form action="./services/ajaxGetBookDetails.php" method="post" class="add-magazine-form">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">

                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"> Magazine Name</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control type name" name="name" placeholder="Book Title" required>
                                    </div>
                                    <input type="hidden" name="action" value="addMagazine"/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                <div class="form-group nk-datapk-ctm form-elet-mg ic-cmp-int" id="data_1">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-calendar"> Date of Receipt </i>
                                    </div>
                                    <div class="input-group date nk-int-st">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" name="date_of_receipt" value="yyyy/mm/dd">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                <div class="form-group nk-datapk-ctm form-elet-mg ic-cmp-int" id="data_1">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-calendar"> Date of Published </i>
                                    </div>
                                    <div class="input-group date nk-int-st">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" name="date_published" value="yyyy/mm/dd">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"> Publisher</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="publisher" placeholder="Publisher">
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="row">


                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"> Pages</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="number" class="form-control" name ="pages" placeholder="Pages">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-dollar"> Price</i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control price" name ="price" placeholder="Price" data-mask="99.99" >
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="btn-list mg-tb-30">
                            <button class="btn btn-default btn-clear notika-btn-default waves-effect">Clear</button>
                            <button class="btn btn-success btn-save notika-btn-success waves-effect" type="submit">Add</button>
                            <!--<button class="btn btn-danger btn-cancel notika-btn-danger waves-effect">Cancel</button>-->
                        </div>
                    </form>
                </div>
                <!-- end page content -->
            </div>


            <!--- magazine list table -->

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="notika-icon notika-form"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Magazine</h2>
                                    <p>List of recorded magazines stored</p>
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
                <div class="data-table-list">

                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date of Receipt</th>
                                <th>Date Published</th>
                                <th>Pages</th>
                                <th>Prices</th>
                                <th>Publisher</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(count($magazines)> 0){
                                foreach ($magazines as $k=>$row) {
                                    echo "<tr>
                                                    <td>".ucwords($row['name'])."</td>
                                                    <td>".$row['date_of_receipt']."</td>
                                                    <td>".$row['date_published']."</td>
                                                    <td>".$row['pages']."</td>
                                                    <td>".$row['price']."</td>
                                                    <td>".$row['publisher']."</td>
                                                    
                                                </tr>";
                                }
                            }else{
                                echo "<tr colspan='7'>No Magazines Found</tr>";
                            }


                            ?>


                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- end page content -->
            </div>
            <!-- end magazine list table -->
        </div>



    </div>

</div>
<!-- end load div -->

<?php
include_once("{$currDir}/layout/footer.php"); ?>
<script type='text/javascript'>
    $(document).ready(function() {
        $form = $('.add-magazine-form');

        $('.btn-clear').on('click', function(e){
            e.preventDefault();
            $form[0].reset();
        });

    });
</script>
</body>

</html>


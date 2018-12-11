<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$currDir = dirname(__FILE__);

include_once("{$currDir}/config/db.php");
include_once("{$currDir}/class/Community.php");
include_once("{$currDir}/lib/functions.php");
include_once("{$currDir}/layout/header.php");

$communities = Community::getAllCommunity();



?>





<!-- Start Email Statistic area-->
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
                                    <h2>Community</h2>
                                    <p>List of registered communities</p>
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
                                <th>Description</th>
                                <th>Allow Signup</th>
                                <th>Needs Approval</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(count($communities)> 0){
                                foreach ($communities as $k=>$row) {
                                    echo "<tr>
                                                    <td>".$row['name']."</td>
                                                    <td>".ucwords($row['description'])."</td>
                                                    <td>".(($row['allowSignup'] == 0) ? 'Yes' : 'No')."</td>
                                                    <td>".(($row['needsApproval'] == 0) ? 'Yes' : 'No')."</td>
                                                    
                                                </tr>";
                                }
                            }else{
                                echo "<tr colspan='4'>No Community Found</tr>";
                            }


                            ?>


                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- end page content -->
            </div>
        </div>
    </div>
</div>
<!-- End Email Statistic area-->

<?php
include_once("{$currDir}/layout/footer.php"); ?>

</body>

</html>
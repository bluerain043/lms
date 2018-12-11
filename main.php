<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $currDir = dirname(__FILE__); 
    include_once("{$currDir}/config/db.php");
    include_once("{$currDir}/class/Books.php");
    include_once("{$currDir}/lib/functions.php");
    include_once("{$currDir}/layout/header.php");

    $books = Books::getBookByStatus();
   

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
										<h2>Books</h2>
										<p>List of available books from different community</p>
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
							<div class="basic-tb-hd">
								<p>List of Books from different community</p>
							</div>
							<div class="table-responsive">
								<table id="data-table-basic" class="table table-striped">
									<thead>
										<tr>
											<th>ISBN No</th>
											<th>Book Title</th>
											<th>Book Type</th>
                                            <th>Author Name</th>
											<th>Purchase Date</th>
											<th>Price</th>
                                            <th>Publisher</th>
                                            <th>Status</th>
										</tr>
									</thead>
									<tbody>
                                        <?php 
                                            if(count($books)> 0){
                                                foreach ($books as $book=>$row) {
                                                    echo "<tr>
                                                    <td>".$row['isbn_no']."</td>
                                                    <td>".ucwords($row['book_title'])."</td>
                                                    <td>".ucwords($row['booktype'])."</td>
                                                    <td>".ucwords($row['author_name'])."</td>
                                                    <td>".$row['purchase_date']."</td>
                                                    <td>".$row['price']."</td>
                                                    <td>".ucwords($row['publisher'])."</td>
                                                    <td>";
                                                        if($row['status'] == Books::BOOK_STAT_AVAILABLE) echo 'Available';
                                                        else if($row['status'] == Books::BOOK_STAT_ISSUED) echo 'Issued';
                                                        else if($row['status'] == Books::BOOK_STAT_OVERDUE) echo 'Overdue';
                                                        else if($row['status'] == Books::BOOK_STAT_RETURNED) echo 'Return';
                                                   echo "</td>
                                                </tr>";
                                                }
                                            }else{
                                                echo "<tr colspan='6'>No Books Found</tr>";
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
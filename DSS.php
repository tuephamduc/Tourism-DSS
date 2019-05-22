<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Tour</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
	<link rel="icon" type="image/png" href="assets/img/favicon.png" />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>
	<div class="image-container set-full-height" style="background-image: url('assets/img/wizard-book.jpg')">
	    <!--   Creative Tim Branding   -->
	    <a>
	         <div class="logo-container">
	            <div class="logo">
	                <img src="assets/img/new_logo.png">
	            </div>
	            <div class="brand">
	                DSS Team 9
	            </div>
	        </div>
	    </a>


	    <!--   Big container   -->
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		            <!--      Wizard container        -->
		            <div class="wizard-container">
		                <div class="card wizard-card" data-color="red" id="wizard">
		                    <form action="Topsis.php" method="POST">
		                <!--        You can switch " data-color="blue" "  with one of the next bright colors: "green", "orange", "red", "purple"             -->

		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
		                        		Tourist
		                        	</h3>
									<h5>This information will let us know more about you.</h5>
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li><a href="#details" data-toggle="tab">About You</a></li>
			                            <li><a href="#captain" data-toggle="tab">Tour Type</a></li>
			                            <li><a href="#description" data-toggle="tab">Extra Details</a></li>
			                        </ul>
								</div>

		                        <div class="tab-content">
		                            <div class="tab-pane" id="details">
		                            	<div class="row">
			                            	<div class="col-sm-12">
			                                	<h4 class="info-text"> Let's start with the basic details.</h4>
			                            	</div>
		                                	<div class="col-sm-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Your Name</label>
			                                          	<input name="name" type="text" class="form-control">
			                                        </div>
												</div>

												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">lock_outline</i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Your Phone Number</label>
			                                          	<input name="phonenumber" type="tel" class="form-control">
			                                        </div>
												</div>

		                                	</div>
		                                	<div class="col-sm-6">
		                                    	<div class="form-group label-floating">
		                                        	<label class="control-label">Adress</label>
	                                        		<select class="form-control" name="adress">	
														
													
	                                        			<?php 
														$server='localhost';
														$user='root';
														$pass='';
														$mydb='dss';
														$connect =new mysqli($server,$user,$pass,$mydb);
														if (!$connect) {
    																  die ("Cannot connect to server");
    																}
   													
   													
   														mysqli_set_charset($connect, 'UTF8');
														$sql = "SELECT *
																FROM xuatphat";
														$result = $connect->query($sql);
														while ($row=$result->fetch_object()) {
														?>
	                                                	<option value= "<?php echo($row->ID)?>" ><?php echo($row->Ten); ?> </option>
														<?php } ?>
	                                                	
		                                        	</select>
		                                    	</div>

		                                	</div>
		                            	</div>
		                            </div>
		                        
		                            <div class="tab-pane" id="captain">
		                                <h4 class="info-text">What type of tour would you want? </h4>
		                                <div class="row">
		                                    <div class="col-sm-10 col-sm-offset-1">
		                                        <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-checkbox">
		                                                <input type="checkbox" name="type[]" value="1">
		                                                <div class="icon">
		                                                    <i class="fa fa-pencil"></i>
		                                                </div>
		                                                <h6>Thám hiểm</h6>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-checkbox">
		                                                <input type="checkbox" name="type[]" value="2">
		                                                <div class="icon">
		                                                    <i class="fa fa-terminal"></i>
		                                                </div>
		                                                <h6>Tâm linh</h6>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-checkbox">
		                                                <input type="checkbox" name="type[]" value="3">
		                                                <div class="icon">
		                                                    <i class="fa fa-laptop"></i>
		                                                </div>
		                                                <h6>Tham quan</h6>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-checkbox">
		                                                <input type="checkbox" name="type[]" value="6">
		                                                <div class="icon">
		                                                    <i class="fa fa-plane"></i>
		                                                </div>
		                                                <h6>Du lịch ẩm thực</h6>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-4">
		                                           <div class="choice" data-toggle="wizard-checkbox">
		                                                <input type="checkbox" name="type[]" value="5">
		                                                <div class="icon">
		                                                    <i class="fa fa-car"></i>
		                                                </div>
		                                                <h6>Tắm biển</h6>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="tab-pane" id="description">
		                                <div class="row">
		                                    <h4 class="info-text">About tour</h4>
		                                    <div class="col-sm-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">transfer_within_a_station</i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Số hành khách</label>
			                                          	<input name="numbertravelers" type="number" class="form-control" required>
			                                        </div>
												</div>
													<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">backup</i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Số ngày</label>
			                                          	<input name="days" type="number" class="form-control" required>
			                                        </div>
												</div>
											</div>
													<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">atm</i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Số tiền tối đa bạn có thể chi trả (Triệu Đồng)</label>
			                                          	<input name="money" type="number" class="form-control" required>
			                                        </div>
												</div>



		                                </div>
		                            </div>
		                        </div>
	                        	<div class="wizard-footer">
	                            	<div class="pull-right">
	                                    <input type='button' class='btn btn-next btn-fill btn-danger btn-wd' name='next' value='Next' />
	                                    <input type='submit' class='btn btn-finish btn-fill btn-danger btn-wd' name='finish' value='Finish' />
	                                </div>
	                                <div class="pull-left">
	                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />

	                                </div>
	                                <div class="clearfix"></div>
	                        	</div>
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	    	</div> <!-- row -->
		</div> <!--  big container -->


	</div>

</body>
	<!--   Core JS Files   -->
	<script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/jquery.bootstrap.js" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="assets/js/material-bootstrap-wizard.js"></script>

	<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="assets/js/jquery.validate.min.js"></script>
</html>




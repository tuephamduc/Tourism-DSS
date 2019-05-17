
<?php 
function distance($lat1, $lon1, $lat2, $lon2) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    //$unit = strtoupper($unit);
      return ($miles * 1.609344);
  }
}

	$trongso= array(
	'Khoang_cach'=>0.25,
	'Suc_thu_hut'=>0.2,
	'Chi_phi'=>0.15,
	'Khach_san'=>0.1,
	'Do_an'=>0.15,
	'Review'=>0.15
);


	$server = 'localhost';//
	$user = 'root';
	$pass = '';
	$mydb = 'htgqd';
	$db=new mysqli($server,$user,$pass,$mydb);
	mysqli_set_charset($db, 'UTF8');			

    $type = array();

    $songuoi = $_POST['numbertravelers'];
    $songay = $_POST['days'];
    $tongtien = $_POST['money'];

    $tien = $tongtien*10/ $songay/ $songuoi ;
 


	if(isset($_POST['type'])){
     	$type1=$_POST['type'];
     	foreach ($type1 as $a) {
 			array_push($type, $a);
     	}
     }
 
  
      	if($type==""){
     		$sql="SELECT * from datadulich where Chi_phi <=  (1.1*$tien)" ;
     	}
     	else{
     	$sql="SELECT * from datadulich where  (Chi_phi <=  (1.1*$tien))AND (Loai_Hinh IN ('" . implode("', '", $type) . "'))";
    }
$result=$db->query($sql);
$SuThuHut=array();
$Chiphi=array();
$Khachsan=array();
$Doan=array();
$Review=array();
$Vido=array();
$Kinhdo=array();
$Chiphi=array();
$KC=array();

$powSuThuHut=0;
$powKhachsan=0;
$powChiphi=0;
$powDoan=0;
$powReview=0;
$powKC=0;
while($row=$result->fetch_object()){

	if(!isset($SuThuHut[$row->Dia_diem])){
		$SuThuHut[$row->Dia_diem]=array();
	}
	$SuThuHut[$row->Dia_diem]=$row->Su_thu_hut;
	$powSuThuHut=$powSuThuHut+pow($row->Su_thu_hut,2);

	if(!isset($Khachsan[$row->Dia_diem])){
		$Khachsan[$row->Dia_diem]=array();
	}
	$Khachsan[$row->Dia_diem]=$row->Khach_san;
	$powKhachsan=$powKhachsan+pow($row->Khach_san,2);

//cost

	if(!isset($Chiphi[$row->Dia_diem])){
		$Chiphi[$row->Dia_diem]=array();
	}
	$Chiphi[$row->Dia_diem]=$row->Chi_phi;




	if(!isset($Doan[$row->Dia_diem])){
		$Doan[$row->Dia_diem]=array();
	}
		$Doan[$row->Dia_diem]=$row->Do_an;
		$powDoan += pow($row->Do_an,2);

	if(!isset($Review[$row->Dia_diem])){
		$Review[$row->Dia_diem]=array();
	}
		$Review[$row->Dia_diem]=$row->Review;
		$powReview += pow($row->Review,2);


	if(!isset($Kinhdo[$row->Dia_diem])){
		$Kinhdo[$row->Dia_diem]=array();
	}
	$Kinhdo[$row->Dia_diem]=$row->Kinh_do;

	if(!isset($Vido[$row->Dia_diem])){
		$Vido[$row->Dia_diem]=array();
	}

	$Vido[$row->Dia_diem]=$row->Vi_do;

 	$xuatphat=$_POST['adress'];
 	
 	$sql1 = "SELECT * from xuatphat where xuatphat.ID = $xuatphat";
 	$result1 = $db->query($sql1);
 	$row1=$result1->fetch_object();

  	$KC[$row->Dia_diem]=Distance($row1->Vi_do,$row1->Kinh_do,$row->Vi_do,$row->Kinh_do);

 }


 	$vecSuThuHut=array();
 	$vecKhachsan=array();
 	$Chiphi1= array();
 	$vecChiPhi=array();
 	$vecDoan=array();
 	$vecReview=array();
 	$KC1=array();
 	$vecKC=array();
	$result=$db->query($sql);
	$maxChiPhi=max($Chiphi);
	$maxKC=max($KC);
	$a=0;
	if ($maxChiPhi>$tien) $a=$maxChiPhi-$tien;
	$maxChiPhi=$maxChiPhi+$a;
while ($row=$result->fetch_object()) {
	if ($row->Chi_phi < $tien) {
		$Chiphi1[$row->Dia_diem] = $maxChiPhi - $row->Chi_phi +$a;
	}
	else $Chiphi1[$row->Dia_diem] = $maxChiPhi - $row->Chi_phi;
	$powChiphi += pow($Chiphi1[$row->Dia_diem],2);
	$KC1[$row->Dia_diem] = $maxKC - $KC[$row->Dia_diem];
	$powKC += pow($KC1[$row->Dia_diem], 2);
}


	$result=$db->query($sql);
	while($row=$result->fetch_object()){
		$vecSuThuHut[$row->Dia_diem] = round(($SuThuHut[$row->Dia_diem]/sqrt($powSuThuHut) * $trongso['Suc_thu_hut']),5);
		$vecKhachsan[$row->Dia_diem] = round(($Khachsan[$row->Dia_diem]/sqrt($powKhachsan)* $trongso['Khach_san']),5);
		$vecDoan[$row->Dia_diem] = round(($Doan[$row->Dia_diem]/sqrt($powDoan)*$trongso['Do_an']),5);
		$vecReview[$row->Dia_diem] = round(($Review[$row->Dia_diem]/sqrt($powReview) *$trongso['Review']),5);
		$vecChiPhi[$row->Dia_diem] = round(($Chiphi1[$row->Dia_diem]/sqrt($powChiphi) *$trongso['Chi_phi']),5);
		$vecKC[$row->Dia_diem] = round(($KC1[$row->Dia_diem]/sqrt($powKC) *$trongso['Khoang_cach']),5);
	}
 // Tim cac phuong an tot nhat, toi nhat
	$maxSuThuHut = max($vecSuThuHut);
	$maxKhachsan = max($vecKhachsan);
	$maxDoan = max($vecDoan);
	$maxReview = max($vecReview);
	$maxChiPhi1 = max($vecChiPhi);
	$maxKC1 = max($vecKC);

	$minSuThuHut = min($vecSuThuHut);
	$minKhachsan = min($vecKhachsan);
	$minDoan = min($vecDoan);
	$minReview = min($vecReview);
	$minChiPhi1 = min($vecChiPhi);
	$minKC1 = min($vecKC);

//tinh khoang cach tung phuong an toi phuong an tot nhat, toi nhat
	$KCtot = array();
	$KCxau = array();
	$KQua = array();
	$result=$db->query($sql);
	while($row=$result->fetch_object()){
		$KCtot[$row->Dia_diem] =sqrt(pow(($maxSuThuHut-$vecSuThuHut[$row->Dia_diem]),2)+pow(($maxKhachsan-$vecKhachsan[$row->Dia_diem]),2)+pow(($maxDoan-$vecDoan[$row->Dia_diem]),2)+pow(($maxReview-$vecReview[$row->Dia_diem]),2)+pow(($maxChiPhi1-$vecChiPhi[$row->Dia_diem]),2)+pow(($maxKC1-$vecKC[$row->Dia_diem]),2));

		$KCxau[$row->Dia_diem] =sqrt(pow(($minSuThuHut-$vecSuThuHut[$row->Dia_diem]),2)+pow(($minKhachsan-$vecKhachsan[$row->Dia_diem]),2)+pow(($minDoan-$vecDoan[$row->Dia_diem]),2)+pow(($minReview-$vecReview[$row->Dia_diem]),2)+pow(($minChiPhi1-$vecChiPhi[$row->Dia_diem]),2)+pow(($minKC1-$vecKC[$row->Dia_diem]),2));

		$KQua[$row->Dia_diem] = $KCxau[$row->Dia_diem]/($KCxau[$row->Dia_diem]+$KCtot[$row->Dia_diem]);
	}

	arsort($KQua);
	
	
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Material Bootstrap Wizard by Creative Tim</title>

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
			

	    <div class="container">
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		        	<div class="wizard-container">
		                <div class="card wizard-card" data-color="red" id="wizard">
		           <form>
		           			    <div class="wizard-header">
		                        	<h3 class="wizard-title">
		                        		Hello <?php if(isset($_POST['name'])){echo($_POST['name']);}?>
		                        	</h3>
		                        	Với các yêu cầu của bạn và chi phí trung bình cho một người một ngày <?php echo($tien*100000);?> VND
									<h5>Sau đây là các địa điểm phù hợp với bạn </h5>
		                    	</div>
		                    	<div class="list-group">

		                    	<?php 
		                    	$cout=0;
		                    	foreach ($KQua as $key => $value) {
		                    		$cout +=1;
		                    		if ($cout <=3){
		                    			?>

    				<a href="#" class="list-group-item list-group-item-action">
        			<div class="d-flex w-100 justify-content-between">
            		 <i><font color="red"><h3><?php echo($key); ?></h3></font></i>
            		<p><small>Khoảng cách:<font color="blue"> <?php echo($KC[$key]); ?></font></small></p>
        			</div>


   					     <h4><p>Các điểm đánh giá chung :</p></h4><br/>
								Khách sạn : <?php echo($Khachsan[$key]); ?><br/>
								Review: <?php echo($Review[$key]); ?><br/>
								Đồ ăn: <?php echo($Doan[$key]); ?><br/>
								Sự thu hút: <?php echo($SuThuHut[$key]); ?><br/>
   					 </a>
		               
		        		<?php            		} 

		                    	}
		                    	?>
		           </form>
		            </div>

		            </div>
		        </div>
		        </div>
		    </div>
			

		</div>

</body>
</html>

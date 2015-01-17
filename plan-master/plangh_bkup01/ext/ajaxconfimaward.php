<?php
include("adb.php");
$student_applicant_id=get_data("student_applicant_id");
if($student_applicant_id==false)
{
    echo "{\"result\":0,\"message\":\"unkown application id\"}";
    exit();
}
$school_id=get_data("school_id");
$scholarship_start_date=get_data("scholarship_start_date");
$scholarship_end_date=get_data("scholarship_start_date");
$school_start_date=get_data("school_start_date");
$school_end_date=get_data("school_end_date");
$entry_level=get_data("entry_level");
$entry_class=get_data("entry_class");
$program=get_data("program");
$attendance=get_data("attendance");



$db=new adb();

if(!$db->sql_query("SELECT `app_amount`,`app_grant_id`,`app_status`+0 as app_status,student_resident_programarea_id
  FROM student_applicant WHERE `student_applicant_id`=$student_applicant_id limit 1")){
  $error="error finding applicant {$db->error}";
  echo "{\"result\":0,\"message\":\"$error\"}";
  exit();
};
$row=$db->fetch();  
if(!$row){
  $error="error finding applicant {$db->error}";
  echo "{\"result\":0,\"message\":\"$error\"}";
  exit();
}
$app_amount=$row['app_amount'];  
$app_grant_id=$row['app_grant_id'];
$app_status=$row['app_status'];
$programarea_id=$row['student_resident_programarea_id'];

if($app_status!=1 or $app_grant_id==0 or $app_amount==0){
  $error="application status or grant awarded is not correct";
  echo "{\"result\":0,\"message\":\"$error\"}";
  exit();
	
}  

$scholarship_type_row=get_scholarship_type($attendance,$programarea_id);
if($scholarship_type_row==false){
  $error="error while calculating scholarship type.";
  echo "{\"result\":0,\"message\":\"$error\"}";
  exit();
}

$scholarship_type=$scholarship_type_row['scholarship_type_id'];
$amount=($scholarship_type_row['scholarship_type_scale'])*$app_amount;

if(!$db->sql_query("INSERT INTO sponsored_student(`student_firstname`,`student_middlename`,`student_lastname`
  ,`student_picture`,`student_applicant_student_applicant_id`,`student_resident_programarea_id`)
  SELECT `student_firstname`,`student_middlename`,`student_lastname`,`student_picture`,`student_applicant_id`,`student_resident_programarea_id`
  FROM student_applicant WHERE `student_applicant_id`=$student_applicant_id;")){
  $error="error confirming {$db->error}";
  echo "{\"result\":0,\"message\":\"$error\"}";
  exit();
}

$sponsored_student_id=$db->get_insert_id();
if($sponsored_student_id==0 or $sponsored_student_id===false){
	$error="error confirming {$db->error}";
	echo "{\"result\":0,\"message\":\"$error\"}";
	exit();
}

$str_query="INSERT INTO scholarship_package(`start_date`,`end_date`,`status`,
`scholarship_type`,`scholarship_type_scholarship_type`,`annual_amount`,
  `grant_package_grant_package_id`,`sponsored_student_sponsored_student_id`)
  VALUES('$scholarship_start_date','$scholarship_end_date',1,
  $scholarship_type,$scholarship_type,$amount,$app_grant_id,$sponsored_student_id )";
if(!$db->sql_query($str_query)){
  echo $str_query;
  $error="error confirming {$db->error}";
  echo "{\"result\":0,\"message\":\"$error\"}";
  exit();
}

if(!$db->sql_query("INSERT INTO school_attendance(`start_date`,`end_date`,
  `entry_class`,`entry_level`,`attendance_type`,`program`,`schools_school_id`,`sponsored_student_sponsored_student_id`)
  VALUES('$school_start_date','$school_end_date',$entry_class,$entry_level,$attendance,'$program', $school_id,$sponsored_student_id)")){
  $error="error confirming {$db->error}";
  echo "{\"result\":0,\"message\":\"$error\"}";
  exit();
}

if(!$db->sql_query("UPDATE student_applicant SET app_status=2 WHERE `student_applicant_id`=$student_applicant_id")){
  $error="error confirming {$db->error}";
  echo "{\"result\":0,\"message\":\"$error\"}";
  exit();
}

echo "{\"result\":1,\"message\":\"award confirmed\"}";

function get_scholarship_type($attendance,$programarea_id){
	$str_query="SELECT  s.`scholarship_type_id`,s.`scholarship_type_scale`  
		FROM scholarship_type s 
		WHERE s.`programarea_programarea_id`=$programarea_id AND s.`attendance_type`=$attendance";
	
	$db=new adb();
	if(!$db->sql_query($str_query)){
		return false;
	}
	
	if($db->get_num_rows()!=0){
		return $db->fetch();
	}
	
	$str_query="SELECT  s.`scholarship_type_id`,s.`scholarship_type_scale`  
		FROM scholarship_type s 
		WHERE s.`programarea_programarea_id`=0 AND s.`attendance_type`=$attendance";
		
	if(!$db->sql_query($str_query)){
		return false;
	}
	
	if($db->get_num_rows()!=0){
		return $db->fetch();
	}
	
	return array("scholarship_type_id"=>1,"scholarship_type_scale"=>100);
}
?>

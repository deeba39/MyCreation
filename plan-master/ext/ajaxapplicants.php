<?php
session_start();

if(!isset($_SESSION["PlanGhana"]["PROGRAM_AREA"])){
    echo "{\"result\":0,\"message\":\"no access\"}";
    exit();
}

include_once("const.php");
$cmd=get_data("cmd");
$userlevel=get_user_level();

switch($cmd)
{
    case 1:
        add_new_applicant();
        break;
    case 2:
        get_applicants();
        break;
    case 3:
        //award
        update_applicant();
        break;
    case 4:
        check_sponsor_child();
        break;
    case 5:
        delete_applicant();
        break;
    case 6:
        award_scholarship();
        break;
    case 7:
        cancel_scholarship();
        break;
    case 8:
        update_applicaiton_point();
        break;
    case 9:
        comfirm_scholarship();
        break;
    default:
        echo "{\"result\":0,\"message\":\"unknown action\"}";
        break;
}

function add_new_applicant(){
    global $userlevel;
   if($userlevel!=USER_LEVEL_ADMIN and $userlevel!=USER_LEVEL_PUOFFICER 
           and $userlevel!=USER_LEVEL_LEARNING_ADVISOR and $userlevel!=USER_LEVEL_DATA_ENTRY){
         echo "{\"result\":0,\"message\":\"you dont have access to complete this task\"}";
         return;
    }
    
    $error_msg="";
    $error=false;
    $programarea_id=  get_programarea();
    $firstname=  get_data('fn');
    $lastname=  get_data('ln');

    if(!$firstname or !$lastname){
        $error_msg.="first and last name ";
        $error=true;
    }
    $gender=get_data('gender');
    if(!$gender){
        $error_msg.=" gender ";
        $error=true;
    }
    $birthdate=get_data('bd');
    if(count($birthdate)<=0){
        $error_msg.=" birth date ";
        $error=true;
    }
    if(stripos($birthdate, "/")===false){
        $error_msg.=" birth date ";
        $error=true;
    }
    $birthdate=conv_to_mysql_date($birthdate);
    
    if(!$gender){
        $error_msg.=" birthdate ";
        $error=true;
    }
    $middlename=  get_data('mn');

    $community_id=get_data('cid');
     if(!$community_id){
        $error_msg.=" community ";
        $error=true;
    }
    $mother_name=get_data('pmn');
    $mother_alive=get_data('pma');
    $mother_ocupation= get_data('pmoid');
    $father_name=get_data('pfn');
    $father_alive=get_data('pfa');
    $father_occupation=get_data('pfoid');
    $gurdian_name=get_data('pgn');
    $gurdian_relation=get_data('pgr');
    $gurdian_occupation=get_data('pgoid');
    $address=get_data('ad');
    $telephone1=  get_data('t1');
     if(!$telephone1){
        $error_msg.=" telephone ";
        $error=true;
    }
    $telephone2=  get_data('t2');
    $jss_school_id=  get_data('jss_id');
    if(!$jss_school_id){
        $error_msg.=" JSS ";
        $error=true;
    }
    $app_referees=  get_data('rf');
    $grade=get_data('gd');
    if(!$grade){
        $error_msg.=" grade ";
        $error=true;
    }

    $school_admitted_to=get_data('sid');
    $sponsored_child_no=get_data('sno');
    
    if($error){
         echo "{\"result\":0,\"message\":\"$error_msg are required\"}";
         return;
    }
    
    include_once 'applicants.php';
    $app=new applicants();
    //get the admission year from system
    $year=$app->get_admission_year();
    
    $id=$app->add_applicant($programarea_id, $year, $firstname, $lastname, $middlename, $gender, 
            $birthdate, $community_id, $mother_name, $mother_alive, $mother_ocupation, 
            $father_name, $father_alive, $father_occupation, $gurdian_name, 
            $gurdian_relation, $gurdian_occupation, $app_referees,$grade, 
            $address, $telephone1, $telephone2, 
            $jss_school_id, $school_admitted_to, $sponsored_child_no);
     if($id==false){
         echo "{\"result\":0,\"message\":\"application not accepted {$app->str_error}\"}";
         return;   
    }
    $prudential_staff=get_data("pb");
    $str_error="";
    if($prudential_staff==1){
        $prudential_staff_relation=get_data('pbr');
        if(!$app->add_prudential_relation($id,$prudential_staff_relation)){
            $str_error=",but the prudential bank realtion was not recorded.";
        };
    }
    $row=$app->get_applicant($id);
    echo "{\"result\":1,\"message\":\"$lastname, $firstname added $str_error. Applicatin given {$row['app_points']}\"}";
    
}

function get_applicants(){
    global $userlevel;
    if($userlevel!=USER_LEVEL_ADMIN and $userlevel!=USER_LEVEL_PUOFFICER 
           and $userlevel!=USER_LEVEL_LEARNING_ADVISOR and $userlevel!=USER_LEVEL_DATA_ENTRY){
         echo "{\"result\":0,\"message\":\"you dont have access to complete this task\"}";
         return;
    }
    $programarea_id=  get_programarea();
    $year=get_data("year");
    $status=get_data("st");
    $search_text=get_data("search_text");
    $order=  get_data("od");
    $page=  get_data("page");
    
    include_once 'applicants.php';
    $app=new applicants();
    
    if(!$app->get_applicants_programarea($programarea_id,$year,0,$status,$search_text,$order,$page,25)){
        echo "{\"result\":0,\"message\":\"Error getting applicants {$app->error}\"}";
        return;
    }
    
    echo "{\"result\":1,\"count\":$app->count,\"applicants\":[";
    $row=$app->fetch();
    while($row){
        echo json($row);
        $row=$app->fetch();
        if($row){
            echo ",";
        }
    }
    echo "]}";
}

function update_applicant(){
    global $userlevel;
    if($userlevel!=USER_LEVEL_ADMIN and $userlevel!=USER_LEVEL_PUOFFICER 
           and $userlevel!=USER_LEVEL_LEARNING_ADVISOR and $userlevel!=USER_LEVEL_DATA_ENTRY){
         echo "{\"result\":0,\"message\":\"you dont have access to complete this task\"}";
         return;
    }
        $error_msg="";
    $error=false;
    $id=get_data("id");
    if(!$id){
        echo "{\"result\":0,\"message\":\"unknown applicant\"}";
        return;
    }
    $programarea_id=  get_programarea();
    $firstname=  get_data('fn');
    $lastname=  get_data('ln');

    if(!$firstname or !$lastname){
        $error_msg.="first and last name ";
        $error=true;
    }
    $gender=get_data('gender');
    if(!$gender){
        $error_msg.=" gender ";
        $error=true;
    }
    $birthdate=get_data('bd');
    if(count($birthdate)<=0){
        $error_msg.=" birth date ";
        $error=true;
    }
    if(stripos($birthdate, "/")===false){
        $error_msg.=" birth date ";
        $error=true;
    }
    $birthdate=conv_to_mysql_date($birthdate);
    
    if(!$gender){
        $error_msg.=" birthdate ";
        $error=true;
    }
    $middlename=  get_data('mn');

    $community_id=get_data('cid');
     if(!$community_id){
        $error_msg.=" community ";
        $error=true;
    }
    $mother_name=get_data('pmn');
    $mother_alive=get_data('pma');
    $mother_ocupation= get_data('pmoid');
    $father_name=get_data('pfn');
    $father_alive=get_data('pfa');
    $father_occupation=get_data('pfoid');
    $gurdian_name=get_data('pgn');
    $gurdian_relation=get_data('pgr');
    $gurdian_occupation=get_data('pgoid');
    $address=get_data('ad');
    $telephone1=  get_data('t1');
     if(!$telephone1){
        $error_msg.=" telephone ";
        $error=true;
    }
    $telephone2=  get_data('t2');
    $jss_school_id=  get_data('jss_id');
    if(!$jss_school_id){
        $error_msg.=" JSS ";
        $error=true;
    }
    $app_referees=  get_data('rf');
    $grade=get_data('gd');
    if(!$grade){
        $error_msg.=" grade ";
        $error=true;
    }

    $school_admitted_to=get_data('sid');
    $sponsored_child_no=get_data('sno');
    
    if($error){
         echo "{\"result\":0,\"message\":\"$error_msg are required\"}";
         return;
    }
    
    include_once 'applicants.php';
    $app=new applicants();
    //get the admission year from system
    $year=$app->get_admission_year(); //for some reason year is not updated
    
    $result=$app->update_applicant($id,$programarea_id,$firstname, $lastname, $middlename, $gender, 
            $birthdate, $community_id, $mother_name, $mother_alive, $mother_ocupation, 
            $father_name, $father_alive, $father_occupation, $gurdian_name, 
            $gurdian_relation, $gurdian_occupation, $app_referees,$grade, 
            $address, $telephone1, $telephone2, 
            $jss_school_id, $school_admitted_to, $sponsored_child_no);
     if($result==false){
         echo "{\"result\":0,\"message\":\"application could not be updated{$app->str_error}\"}";
         return;   
    }
    $prudential_staff=get_data("pb");
    $str_error="";
    if($prudential_staff==1){
        $prudential_staff_relation=get_data('pbr');
        if(!$app->add_prudential_relation($id,$prudential_staff_relation)){
            $str_error=",but the prudential bank realtion was not recorded.";
        };
    }else{
        $app->remove_prudential_relation($id);
    }
    $row=$app->get_applicant($id);
    echo "{\"result\":1,\"message\":\"$lastname, $firstname updated. Application given {$row['app_points']} points\"";
    echo ",\"applicant\":". json($row)  ."}";
    return;
}

function check_sponsor_child(){
    global $userlevel;
    if($userlevel!=USER_LEVEL_ADMIN and $userlevel!=USER_LEVEL_PUOFFICER 
           and $userlevel!=USER_LEVEL_LEARNING_ADVISOR and $userlevel!=USER_LEVEL_DATA_ENTRY){
         echo "{\"result\":0,\"message\":\"you dont have access to complete this task\"}";
         return;
    }
    echo "{\"result\":1,\"fullname\":\"Aelaf Dafla\",\"birthdate\":\"1976-10-30\"}";
}

function delete_applicant(){
    global $userlevel;
    if($userlevel!=USER_LEVEL_ADMIN and $userlevel!=USER_LEVEL_PUOFFICER 
           and $userlevel!=USER_LEVEL_LEARNING_ADVISOR and $userlevel!=USER_LEVEL_DATA_ENTRY){
         echo "{\"result\":0,\"message\":\"you dont have access to complete this task\"}";
         return;
    }
    $id=get_data("id");
    if(!$id){
        echo "{\"result\":0,\"message\":\"unknown applicant\"}";
        return;
    }
    
    include_once 'applicants.php';
    $app=new applicants();
    $row=$app->get_applicant($id);
    if($row['app_status']>0){   //application can not be updated
        echo "{\"result\":0,\"message\":\"Awarded or confirmed application can not be deleted.\"}";
        return;
    }
    if(!$app->delete_application($id)){
        echo "{\"result\":0,\"message\":\"Error deleting {$app->error}\"}";
        return;
    }
    echo "{\"result\":1,\"message\":\"deleted\"}";
}

function award_scholarship(){
    global $userlevel;
    if($userlevel!=USER_LEVEL_ADMIN and $userlevel!=USER_LEVEL_PUOFFICER and $userlevel!=USER_LEVEL_LEARNING_ADVISOR){
         echo "{\"result\":0,\"message\":\"you dont have access to complete this task\"}";
         return;
    }
    
    $str=get_data("ids");
    if($str==false)
    {
        echo "{\"result\":0,\"message\":\"unknown application id\"}";
        return;
    }
    $ids=  explode(",", $str);
    $grant_id=get_data("gid");
    if($grant_id==false)
    {
        echo "{\"result\":0,\"message\":\"unknown grant\"}";
        return;
    }

    include_once 'applicants.php';
    $app=new applicants();
    
    echo "{\"result\":1,\"astatus\":["; //i changed 'statuss' to 'status'
    $length=count($ids);
    $i=0;
    foreach($ids as $id){
        $r=1;
        if(!$app->award_applicant_scholarship($id, $grant_id)){
            $r=0;
        }
        echo '{"id":'.$id.',"status":'.$r.'}';
        $i++;
        if($i<=$length-1){
            echo ",";
        }
    }
    
    echo "]}";
   
}

function update_applicaiton_point(){
    global $userlevel;
    if($userlevel!=USER_LEVEL_ADMIN and $userlevel!=USER_LEVEL_PUOFFICER and $userlevel!=USER_LEVEL_LEARNING_ADVISOR){
         echo "{\"result\":0,\"message\":\"you dont have access to complete this task\"}";
         return;
    }
    
    $str=get_data("ids");
    if($str==false)
    {
        echo "{\"result\":0,\"message\":\"unknown application id\"}";
        return;
    }
    $ids=  explode(",", $str);
    
    include_once 'applicants.php';
    $app=new applicants();
    
    echo "{\"result\":1,\"astatus\":["; //i changed 'statuss' to 'status'
    $length=count($ids);
    $i=0;
    foreach($ids as $id){
        $r=$app->update_applicant_point($id);
        echo '{"id":'.$id.',"status":'.$r.'}';
        $i++;
        if($i<=$length-1){
            echo ",";
        }
    }
    
    echo "]}";
   
}

function cancel_scholarship(){
    global $userlevel;
    if($userlevel!=USER_LEVEL_ADMIN and $userlevel!=USER_LEVEL_PUOFFICER and $userlevel!=USER_LEVEL_LEARNING_ADVISOR){
         echo "{\"result\":0,\"message\":\"you dont have access to complete this task\"}";
         return;
    }
    
    $str=get_data("ids");
    if($str==false)
    {
        echo "{\"result\":0,\"message\":\"unknown application id\"}";
        return;
    }
    $ids=  explode(",", $str);
    
    include_once 'applicants.php';
    $app=new applicants();
    
    echo "{\"result\":1,\"astatus\":["; //i changed 'statuss' to 'status'
    $length=count($ids);
    $i=0;
    foreach($ids as $id){
        $r=1;
        if(!$app->cancel_applicant_scholarship($id)){
            $r=0;
        }
        echo '{"id":'.$id.',"status":'.$r.'}';
        $i++;
        if($i<=$length-1){
            echo ",";
        }
    }
    
    echo "]}";
   
}

function comfirm_scholarship(){
    global $userlevel;
    if($userlevel!=USER_LEVEL_ADMIN and $userlevel!=USER_LEVEL_PUOFFICER 
           and $userlevel!=USER_LEVEL_LEARNING_ADVISOR and $userlevel!=USER_LEVEL_DATA_ENTRY){
         echo "{\"result\":0,\"message\":\"you dont have access to complete this task\"}";
         return;
    }
    //"student_applicant_id=1&school_id=1&school_start_date=2011-08-01&school_end_date=2013-05-01&scholarship_start_date=2011-08-01&scholarship_end_date=2013-05-01&entry_level=something&entry_class=1&program=BA";
    $student_applicant_id=get_data("student_applicant_id");
    $school_id=get_data("school_id");
    $scholarship_start_date=get_data("scholarship_start_date");
    $scholarship_end_date=get_data("scholarship_start_date");
    $school_start_date=get_data("school_start_date");
    $school_end_date=get_data("school_end_date");
    $entry_level=get_data("entry_level");
    $entry_class=get_data("entry_class");
    $program=get_data("program");
    $attendace=get_data("attendance");

    /*echo "school=$school_id sid=$student_applicant_id sd=$scholarship_start_date ed=$scholarship_end_date</br>";
    echo "ssd=$school_start_date sed=$school_end_date el=$entry_level ec=$entry_class pm=$program attendace=$attendace</br>";*/
    

    include_once("applicants.php");
    $app=new applicants();
    if($student_applicant_id==false)
    {
        echo "{\"result\":0,\"message\":\"unkown application id\"}";
        return;
    }
    if(!$app->confirm_applicant_scholarship($student_applicant_id,$scholarship_start_date,$scholarship_end_date,$school_id,
            $school_start_date,$school_end_date,$entry_class,$entry_level,$attendace,$program))
    {
        
        echo "{\"result\":0,\"message\":\"could not confirm scholarship {$app->error}\"}";
        return;
    }
    echo "{\"result\":1,\"message\":\"scholarship confirmed\"}";
}
?>

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
    case 1://get districts in program area
        get_districts();
        break;
    case 2://get districts in program area
        get_communities();
        break;
    case 3:
        add_student_record();
        break;
    case 4:
        get_student_detail();
        break;
    case 5:
        add_students_to_request();
        break;
    case 6:
        remove_students_from_request();
        break;
    case 7:
        add_community();
        break;
    case 8:
        get_strudent_list();
        break;
    case 9:
        get_student_attendance();
        break;
    case 10:
        update_student();
        break;
    case 11:
        add_to_payment();
        break;
    case 12:
        get_student_payments();
        break;
    case 13:
        get_paid_for_students();
        break;
    case 14:
        get_payment_request_students();
        break;
    case 15:
        remove_students_from_payment_request();
        break;       
    case 16:
        get_student_performance();
        break;
    case 17:
        record_student_performance();
        break;
    case 18:
        get_scholarship_ending_student();
        break;
    case 19:
        change_students_scholarship_status() ;
        break;
    case 20:
        get_student_scholarship_pacakges();
        break;
    case 21:
        change_schoarship_status();
        break;
    case 22:
        change_school();
        break;
    default:
        echo "{\"result\":0,\"message\":\"unknown action\"}";
        break;

}
function get_districts(){
    $programarea_id=get_data("programarea_id");

    include("programarea.php");
    $p=new programareas();
    if(!$p->get_districts($programarea_id)){
        echo "{\"result\":0,\"message\":\"districts not found {$p->error}\"}";
        return;
    }
    echo "{\"result\":1,\"districts\":[";
    $row=$p->fetch();
    while($row){
        echo "{\"districtID\":" . $row['DistrictID'];
        echo ",\"district\":\"" . $row['District'] ."\"";
        echo ",\"programarea_id\":" . $row['programarea_programarea_id'] ."}";
        $row=$p->fetch();
        if($row){
            echo ",";
        }
    }
    echo "]}";
}

function get_communities(){
    $district_id=get_data("district_id");

    include("programarea.php");
    $p=new programareas();
    if(!$p->get_communities($district_id)){
        echo "{\"result\":0,\"message\":\"communites not found {$p->error}\"}";
        return;
    }
    echo "{\"result\":1,\"communites\":[";
    $row=$p->fetch();
    while($row){
        echo "{\"communityID\":" . $row['community_id'];
        echo ",\"community\":\"" . $row['community'] ."\"";
        echo ",\"district_id\":" . $row['community_districts_DistrictID'] ."}";
        $row=$p->fetch();
        if($row){
            echo ",";
        }
    }
    echo "]}";
}

function add_student_record(){

    
    $firstname=get_data("firstname");
    $lastname=get_data("lastname");
    $birthdate=get_data("birthdate");
    $gender=get_data("gender");
    $school=get_data("school");
    $programarea=get_data("programarea");
    $community=get_data("community");
    $jss=get_data("jss");
    $startYear=get_data("startyear");
    $endYear=get_data("endyear");
    $entryLevel=get_data("entrylevel");
    $currentLevel=get_data("currentlevel");
    $attendanceType=get_data("attendancetype");
    $grant=get_data("grant");
    $academicProgram=get_data("program");

   
    $scholarshipType=1;
    if(strcmp($attendanceType,"BOARDER")==0){
        $scholarshipType=2;
    }else if(strcmp($attendanceType,"DAY")==0){
        $scholarshipType=0;
    }
    include("grant.php");
    $amount=300;
    $g=new grants();
    $row=$g->get_grant($grant);
    if($row)
    {
        $amount=$row['annual_amount'];
    }
        
    include("students.php");
    $s=new students();
    $r=$s->add_application_record($firstname,$lastname,$birthdate,$gender,$startYear,$endYear,$entryLevel,$currentLevel,$academicProgram,$attendanceType,
            $jss,$school,$community,$programarea,$scholarshipType,$grant,$amount);
    if(!$r){
        echo "{\"result\":0,\"message\":\"Record not added due to error {$s->error}\"}";
        return;
    }

    echo "{\"result\":1,\"message\":\"Record added {$s->error}\"}";
}

function get_student_detail(){
    $id=get_data("student_id");
    if(!$id){
      echo "{\"result\":0,\"message\":\"unknown studnet id\"}";
      return;
    }

    include("students.php");
    $s=new students();
    $row=$s->get_student_record($id);
    if(!$row){
        echo "{\"result\":0,\"message\":\"error while getting student record {$s->error}\"}";
        return;
    }
    $str=json($row);

    echo "{\"result\":1,\"student\":";
    echo $str;
    

    echo ",\"school_attendance\":[";
    if($s->get_student_attendance($id)){
        $row=$s->fetch();
        while($row){
            $str=json($row);
            echo $str;
            $row=$s->fetch();
            if($row){
                echo ",";
            }
        }

    
    }
    echo "]";
    echo ",\"scholarship_payments\":[";
    if($s->get_student_scholarhsip_payment($id)){
        $row=$s->fetch();
        while($row){
            $str=json($row);
            echo $str;
            $row=$s->fetch();
            if($row){
                echo ",";
            }
        }


    }
    echo "]";
    echo "}";
}

function get_strudent_list(){
    include_once 'students.php';
    $year=get_data("year");
    if($year==false){
        $year=0;
    }
    
    $search_text=get_data('search_text');
    $scholarship_status=get_data("spst");
    if($scholarship_status===false){
        $scholarship_status=1;
    }
    $page=get_data("page");
    if($page===false){
        $page=0;
        $limit=0;
    }else{
        $limit=15;
    }
    
    $community_id=get_data("community_id");
    $district_id=get_data("district_id");
    $programarea_id=  get_programarea();        //get_data("programarea_id");
    $s=new students();
    
    $result=$s->get_students_from_programarea($programarea_id, $year, $scholarship_status,$search_text,$page,$limit);
    if($result==false){
         echo "{\"result\":0,\"message\":\"error while getting students {$s->error}\"}";
         return;
    }
    $count=$s->count;
    echo "{\"result\":1,\"count\":$count,\"students\":[";
    $row=$s->fetch();
    while($row){
        echo json($row);
        $row=$s->fetch();
        if($row){
            echo ",";
        }
    }
    echo "]}";
    
}

function add_students_to_request(){
    include_once 'payments.php';
    if($userlevel!=USER_LEVEL_ADMIN and $userlevel!=USER_LEVEL_PUOFFICER and $userlevel!=USER_LEVEL_LEARNING_ADVISOR){
         echo "{\"result\":0,\"message\":\"you dont have access to complete this task\"}";
         return;
    }
    $p=new payments();
    $school_id=get_data('school_id');
    $request_id=get_data('request_id');

    if(!$school_id){
        echo "{\"result\":0,\"message\":\"unkown school id \"}";
        return;
    }

    if(!$request_id){
        echo "{\"result\":0,\"message\":\"unkown request id \"}";
        return;
    }
    if(!$p->get_students_for_payment($school_id)){
        echo "{\"result\":0,\"message\":\"error while getting student records from this schools.\"}";
        return;
    }
    
   
    $counter=0;
    $row=$p->fetch();
    $p_foradding=new payments();
    while($row){
        if($p_foradding->add_student_to_payment_request($request_id, $row['sponsored_student_sponsored_student_id'])){
            $counter++;
        }
        $row=$p->fetch();
    }

    echo "{\"result\":1,\"message\":\"$counter students added.\"}";

}

function remove_students_from_request(){
    include_once 'payments.php';

    $p=new payments();
    $school_id=get_data('school_id');
    $request_id=get_data('request_id');

    if(!$school_id){
        echo "{\"result\":0,\"message\":\"unkown school id \"}";
        return;
    }

    if(!$request_id){
        echo "{\"result\":0,\"message\":\"unkown request id \"}";
        return;
    }
    if(!$p->get_students_for_payment($school_id)){
        echo "{\"result\":0,\"message\":\"error while getting student records from this schools.\"}";
        return;
    }
    $counter=0;
    $row=$p->fetch();
    $p_foradding=new payments();
    while($row){
        if($p_foradding->remove_student_from_payment_request($request_id, $row['sponsored_student_sponsored_student_id'])){
            $counter++;
        }
        $row=$p->fetch();
    }

    echo "{\"result\":1,\"message\":\"$counter students removed.\"}";

}

function add_community(){
    /*
     * TODO:permission level 1 or 2
     */
    $community_name=get_data("cn");
    $district_id=get_data("did");
    $community_category=get_data("cc");
    if(!($community_name and $district_id and $community_category)){
        echo "{\"result\":0,\"message\":\"Error while addint community. Data is not correct\"}";
        return;
    }
    include_once("programarea.php");
    $p=new programareas();
    $community_id=$p->add_community($community_name, $district_id, $community_category);
    if($community_id==false){
        echo "{\"result\":0,\"message\":\"error while adding community.\"}";
        return;
    }

    echo "{\"result\":1,\"community_id\":" .$community_id;
    echo ",\"community_name\":\"" .$community_name ."\"";
    echo ",\"message\":\"community added.\"}";
}

function get_student_attendance(){
    /*permission level 1 2 3*/
    $student_id=get_data("id");
    if($student_id==false){
        echo "{\"result\":0,\"message\":\"Student ID unknown\"}";
        return;
    }
    
    include_once 'students.php';
    $s=new students();
    if(!$s->get_student_attendance($student_id)){
        echo "{\"result\":0,\"message\":\"error while getting student record {$s->error}\"}";
        return;
    }
    echo "{\"result\":1,\"student_id\":$student_id, \"attendance\":[";
    $row=$s->fetch();
    while($row){
        echo json($row);
        $row=$s->fetch();
        if($row){
            echo ",";
        }
    }
    echo "]}";
    
    
    
    
}

function update_student(){
    /*permission level 1 2*/
    $student_id=get_data("student_id");
    if($student_id==false){
        echo "{\"result\":0,\"message\":\"Student ID unknown\"}";
        return;
    }
    $firstname=get_data("firstname");
    $lastname=get_data("lastname");
    $middlename=get_data("middlename");
    $birthdate=get_data("birthdate");
    $gender=get_data("gender");
    $telephone1=get_data("telephone1");
    $telephone2=get_data("telephone2");
    $community_id=get_data("community_id");
    
    
    if($gender==false || $community_id==false || $lastname==false || $firstname==false || $birthdate==false){
        echo "{\"result\":0,\"message\":\"required data is not provided\"}";
        return;
    }

    if($telephone2==false){
        $telephone2="none";
    }
    
    if($telephone1==false){
        $telephone1="none";
    }
    
    include_once 'students.php';
    $s=new students();
    
    $sbirthdate=  conv_to_mysql_date($birthdate);
    if($sbirthdate==false){
        $sbirthdate=$birthdate;
    }

    if(!$s->update_student_record($student_id, $community_id, $firstname, $lastname, $middlename, $sbirthdate, $gender, $telephone1, $telephone2)){
        echo "{\"result\":0,\"message\":\"error while updating record {$s->error}\"}";
        return;
    }
    
    echo "{\"result\":1,\"message\":\"record updated \"}";
    
}

function add_to_payment(){
    /*permission level 1 */
    global $userlevel;
    if($userlevel!=USER_LEVEL_ADMIN and $userlevel!=USER_LEVEL_PUOFFICER and $userlevel!=USER_LEVEL_LEARNING_ADVISOR){
         echo "{\"result\":0,\"message\":\"you dont have access to complete this task\"}";
         return;
    }
    
    $payment_request_id=get_data("prid");
    $str=get_data("ids");
    $student_ids=  explode(",", $str);

    include_once 'students.php';
    $s=new students();

    echo "{\"result\":1,\"astatus\":["; //i changed 'statuss' to 'status'
    $length=count($student_ids);
    $i=0;
    foreach($student_ids as $id){
        $r=$s->add_to_payment_request($id,$payment_request_id);
        echo '{"id":'.$id.',"status":'.$r.'}';
        $i++;
        if($i<=$length-1){
            echo ",";
        }
    }
    
    echo "]}";
    
}

function get_student_payments(){
    /*permission level 1 2 3*/
    $student_id=get_data("id");
    include_once 'students.php';
    $s=new students();
    if(!$s->get_student_scholarhsip_payment($student_id)){
        echo "{\"result\":0,\"message\":\"error getting list of students{$s->error}\"}";
        return;
    }
    
    echo "{\"result\":1,\"student_id\":$student_id, \"payments\":[";
    $row=$s->fetch();
    while($row){
        echo json($row);
        $row=$s->fetch();
        if($row){
            echo ",";
        }
    }
    echo "]}";
}

function get_paid_for_students(){
    /*permission level 1 2 3*/
    $financial_year_id=get_datan("fid");
    include_once("payments.php");
    $p=new payments();
    $row=$p->get_current_finacial_year();
    if($row==false){
        echo "{\"result\":0,\"message\":\"error accessing financial year\"}";
    }
    $financial_year_id=$row['financial_year_id'];
    
    $paid=get_datan("paid");
    
    $programarea_id=  get_programarea();

    $year=get_data("year");
    
    if($year==false){
        $year=0;
    }
    
    $scholarship_status=get_data("spst");
    if($scholarship_status==false){
        $scholarship_status=0;
    }
    
    $page=get_data("page");
    if($page===false){
        $page=0;
        $limit=0;
    }else{
        $limit=15;
    }
    
    include_once 'students.php';
    $s=new students();
   
    $result=$s->get_paid_for_students($paid,$financial_year_id,$programarea_id,$year,$scholarship_status,$page, $limit);
    
    if(!$result){
        echo "{\"result\":0,\"message\":\"no student paid for in this year\"}";
        return;  
    }
    $count=$s->count;
    echo "{\"result\":1,\"count\":$count,\"financial_year_id\":$financial_year_id, \"students\":[";
    $row=$s->fetch();
    while($row){
        echo json($row);
        $row=$s->fetch();
        if($row){
            echo ",";
        }
    }
    echo "]}";
}

function get_payment_request_students(){
    $payment_id=get_datan("prid");
    $year=get_datan("year");
    $programarea_id=get_datan("programarea_id");
   
    $page=get_data("page");
    if($page===false){
        $page=0;
        $limit=0;
    }else{
        $limit=15;
    }
    
    include_once 'students.php';
    $s=new students();
    if(!$s->get_payment_request_students($payment_id,$programarea_id,$year,$page,$limit)){
        echo "{\"result\":0,\"message\":\"no payment requested\"}";
        return;  
    }
    $count=$s->count;
    echo "{\"result\":1,\"count\":$count,\"payment_request_id\":$payment_id, \"students\":[";
    $row=$s->fetch();
    while($row){
        echo json($row);
        $row=$s->fetch();
        if($row){
            echo ",";
        }
    }
    echo "]}";
}

function remove_students_from_payment_request(){ 
    /*permission level 1 2 3*/
    global $userlevel;
    if($userlevel!=USER_LEVEL_ADMIN and $userlevel!=USER_LEVEL_PUOFFICER and $userlevel!=USER_LEVEL_LEARNING_ADVISOR){
         echo "{\"result\":0,\"message\":\"you dont have access to complete this task\"}";
         return;
    }
    //use the new funciton you will implement in students
    //following the steps in add_to_payment do the reverse. remove the students from the payments, 
    //and return the stuatus
    $payment_request_id=get_datan("prid");
    $str=get_data("ids");
    $student_ids=  explode(",", $str);

    include_once 'students.php';
    $s=new students();

    echo "{\"result\":1,\"astatus\":["; 
    $length=count($student_ids);
    $i=0;
    foreach($student_ids as $id){
        $r=$s->remove_from_payment_request($id,$payment_request_id);
        echo '{"id":'.$id.',"status":'.$r.'}';
        $i++;
        if($i<=$length-1){
            echo ",";
        }
    }
    
    echo "]}";
    
}

function get_student_performance(){
    $student_id=get_data("id");
    if(!$student_id){
        echo "{\"result\":0,\"message\":\"student id unkown\"}";
        return;
    }
    include_once "students.php";
    $s=new students();
    
    if(!$s->get_student_performance($student_id)){
        echo "{\"result\":0,\"message\":\"error {$s->str_error}\"}";
        return;
    }
    echo "{\"result\":1,\"performance\":[";
    $row=$s->fetch();
    while($row){
        echo json($row);
        $row=$s->fetch();
        if($row){
            echo ",";
        }
    }
    echo "]}";
    
}

function record_student_performance(){
    global $userlevel;
    if($userlevel!=USER_LEVEL_ADMIN and $userlevel!=USER_LEVEL_PUOFFICER and $userlevel!=USER_LEVEL_LEARNING_ADVISOR){
         echo "{\"result\":0,\"message\":\"you dont have access to complete this task\"}";
         return;
    }
    $student_id=get_data("id");
    $promoted=  get_datan("promoted");
    $math=get_data("math");
    $english=get_data("eng");
    
    if(!$student_id){
        echo "{\"result\":0,\"message\":\"student id unkown\"}";
        return;
    }
    include_once "students.php";
    include_once "applicants.php";
    $app=new applicants();
    
    $academic_year=$app->get_grade_record_year();
    $grade_year_id=0;
    $s=new students();
    
    $row=$s->get_current_student_attendance($student_id);
    if(!$row){
        echo "{\"result\":0,\"message\":\"could not get current school registration record\"}";
        return;
    }
    $school_attendance_id=$row['school_attendance_id'];

    $s=new students();
    if(!$s->set_promote($school_attendance_id, $academic_year, $promoted, $grade_year_id, $english, $math)){
         echo "{\"result\":0,\"message\":\"{$s->str_error}\"}";
         return;
    }
    
    echo "{\"result\":1,\"message\":\"student preformance recorded successfully.\"}";
 
}

function get_scholarship_ending_students(){
    $ending_year=get_data("year");      //assumed to be a 4 digit number like 2014
    if($ending_year==false){
        $ending_year=date("Y");
    }
    
    //can studnet class function 
    //complile and echo a json object just like get_student_list 
    
}

function  get_student_scholarship_pacakges(){
    $student_id=get_datan("id");
    if(!$student_id){
        echo "{\"result\":0,\"message\":\"student id unknown\"}";
        return;
    }
    include_once("students.php");
    $s=new students();
    if(!$s->get_scholarship_packages($student_id)){
        echo "{\"result\":0,\"message\":\"{$s->str_error}\"}";
        return;
    }
    
    echo "{\"result\":1,\"scholarship_packages\":[";
    $row=$s->fetch();
    while($row){
        echo json($row);
        $row=$s->fetch();
        if($row){
            echo ",";
        }
    }
    echo "]}";
}

function change_schoarship_status(){
    global $userlevel;
    if($userlevel!=USER_LEVEL_ADMIN and $userlevel!=USER_LEVEL_PUOFFICER and $userlevel!=USER_LEVEL_LEARNING_ADVISOR){
         echo "{\"result\":0,\"message\":\"you dont have access to complete this task\"}";
         return;
    }
    $scholarship_package_id=  get_datan("spid");
    $status=  get_datan("st");
    if(!$scholarship_package_id){
        echo "{\"result\":0,\"message\":\"the scholarhsip ID is not correct\"}";
        return;
    }
    include_once("students.php");
    $s=new students();
    if(!$s->change_scholarship_status($scholarship_package_id,$status)){
        echo "{\"result\":0,\"message\":\"error: {$s->str_error}\"}";
        return;
        
    }
     echo "{\"result\":1,\"message\":\"status changed\"}";
}

function change_students_scholarship_status(){
    global $userlevel;
    if($userlevel!=USER_LEVEL_ADMIN and $userlevel!=USER_LEVEL_PUOFFICER and $userlevel!=USER_LEVEL_LEARNING_ADVISOR){
         echo "{\"result\":0,\"message\":\"you dont have access to complete this task\"}";
         return;
    }
    $status=get_datan("spst");
    $str=get_data("ids");
    $student_ids=  explode(",", $str);
    
    include_once("students.php");
    $s=new students();
    
    echo "{\"result\":1,\"astatus\":["; 
    $length=count($student_ids);
    $i=0;
    foreach($student_ids as $id){
        $r=1;
        if(!$s->change_student_scholarship_status($id,$status)){
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

function change_school(){
    //get the student id from requst
    //get the current attendace from student class
    //end the crrent attendance using student calss function
    //add a new attendance 
    
}



?>

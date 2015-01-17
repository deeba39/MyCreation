<?php
include_once("const.php");
$cmd=get_data("cmd");
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


function get_student_detail()
{
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


function add_students_to_request(){
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
?>

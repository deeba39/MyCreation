<?php
session_start();

if(!isset($_SESSION["PlanGhana"]["PROGRAM_AREA"])){
    echo "{\"result\":0,\"message\":\"no access\"}";
    exit();
}

include_once("const.php");
$cmd=get_data("cmd");
$userlevel=get_user_level();
 
switch($cmd){
    case 1:
        get_finacial_years();
        break;
    case 2:
        get_payments();
        break;
    case 3:
        get_schools();
        break;
    case 4:
        get_students();
        break;
    case 5:
        get_payment_detail();
        break;
    case 6:
        change_status();
        break;
    case 7:
        create_payment_request();
        break;
    case 8:
        get_school_students();
        break;
    default:
        echo "{\"result\":0,\"message\":\"unknown action\"}";
        break;
}

function get_finacial_years(){
      //call payments class to echo all finacial years as json
    include("payments.php");
    $p = new payments();
    if (!$p->get_all_financial_year()){
        echo "{\"result\":0,\"message\":\"no financial years found {$p->error}\"}";
        return; 
    }
    echo "{\"result\":1,\"financialyears\":[";
    $row=$p->fetch();
    while($row){
        echo "{\"financial_year_id\":" . $row['financial_year_id'];
        echo ",\"year_name\":\"" . $row['year_name'] ."\"";
        echo ",\"date_start\":\"" . $row['date_start'] ."\"";
        echo ",\"date_end\":" . $row['date_end'] ."}";
        $row=$p->fetch();
        if($row){
            echo ",";
        }
    }
    echo "]}";  
}

function get_payments(){
    //use the payments class to echo payment request with a given status
    $financial_year_id=get_datan("fyid");
    $status=get_data("st");
    $programarea_id=  get_programarea();

    include("payments.php");
    $p= new payments();
    if (!$p->get_payment_requests($financial_year_id,$programarea_id,$status)){
        echo "{\"result\":0,\"message\":\"payments not found {$p->error}\"}";
        return;   
    }
    echo "{\"result\":1,\"status\":\"$status\", \"payments\":["; 
    $row=$p->fetch();
    while($row){
        echo json($row);
        $row=$p->fetch();
        if($row){
            echo ",";
        }
    }
    echo "]}";
    
}

function get_schools(){
    //use the payments class to echo schools in the payment request
    $payment_request_id=get_data("prid");
    include("payments.php");
    $p= new payments();
    if (!$p->get_payment_for_school($payment_request_id)){
        echo "{\"result\":0,\"message\":\"schools in a particular payment request is not found {$p->error}\"}";
        return;    
    }
    echo "{\"result\":1,\"payment_request_id\":$payment_request_id, \"schools\":["; 
    $row=$p->fetch();
    while($row){
        echo json($row);
        $row=$p->fetch();
        if($row){
            echo ",";
        }
    }
    echo "]}";    

}

function get_students(){
    //use the student class to get students in the payment request   
    $payment_id=get_datan("prid");
    $programarea_id=get_programarea();
    $year=get_datan("year");
    $page=get_datan("page");
    $limit=0;
    
    if($page!=0){
        $limit=15;
    }
    include_once ("payments.php");
    $p=new payments();
    if(!$p->get_payment_request_students_programarea($payment_id,$programarea_id,$year,$page,$limit)){
        echo "{\"result\":0,\"message\":\"{$p->str_error}\"}";
        return;  
    }
    echo "{\"result\":1,\"payment_request_id\":$payment_id, \"students\":[";
    $row=$p->fetch();
    while($row){
        echo json($row);
        $row=$p->fetch();
        if($row){
            echo ",";
        }
    }
    echo "]}";

}

function get_school_students(){
    //use the student class to get students in the payment request   
    $payment_id=get_datan("prid");
    $school_id=get_datan("schid");
    $programarea_id=get_programarea();
    $year=get_datan("year");
    $page=get_datan("page");
    $limit=0;
    
    if($page!=0){
        $limit=15;
    }
    include_once ("payments.php");
    $p=new payments();
    if(!$p->get_payment_request_students_school($payment_id,$school_id,$year,$page,$limit)){
        echo "{\"result\":0,\"message\":\"{$p->str_error}\"}";
        return;  
    }
    echo "{\"result\":1,\"payment_request_id\":$payment_id, \"students\":[";
    $row=$p->fetch();
    while($row){
        echo json($row);
        $row=$p->fetch();
        if($row){
            echo ",";
        }
    }
    echo "]}";

}

function get_payment_detail(){
    //get the payment request detail
    $payment_request_id=get_datan("prid");
    include_once ("payments.php");
    $p= new payments();
	$row=$p->get_payment_detail($payment_request_id);
    if (!$row){
        echo "{\"result\":0,\"message\":\"no payment detail {$p->error}\"}";
        return;    
    }
    echo "{\"result\":1,\"payment_request_id\":$payment_request_id, \"payment\":"; 
        echo json($row);
    
    echo "}"; 
}

function change_status(){
    $status=get_datan("st");
    $payment_request_id=  get_datan("prid");
    if(!$payment_request_id){
        echo "{\"result\":0,\"message\":\"payment request ID unknown\"}";
        return;
    }
    if($status==1){
        submit_payment_request($payment_request_id);
    }else if($status==2){
        disburse_payment_request($payment_request_id);
    }else if($status==3){
        liqudate_payment_request($payment_request_id);
    }
}

function submit_payment_request($payment_request_id){
    global $userlevel;
    if($userlevel!=USER_LEVEL_PUOFFICER and $userlevel!=USER_LEVEL_ADMIN){
        echo "{\"result\":0,\"message\":\"you dont have access to submit a request\"}";
        return;
    }
    include_once("payments.php");
    $programarea_id=  get_programarea();
    
    $p=new payments();
    $row=$p->get_payment_detail($payment_request_id);
    if(!$row['request_status']=="NEWREQ"){
        echo "{\"result\":0,\"message\":\"only new payment requests can be submitted\"}";
        return;
       
    }
    $user_id=  get_user_id();
    if($user_id!=$row['owner_id']){
         echo "{\"result\":0,\"message\":\"only owner of the request can submit\"}";
        return;
    }
    
    if($programarea_id!=0 and $programarea_id!=$row['programarea_id']){
        echo "{\"result\":0,\"message\":\"you can only submit tasks from your program unit\"}";
        return;
    }
    
    if(!$p->submit_payment_request($payment_request_id)){
         echo "{\"result\":0,\"message\":\"{$p->str_error}\"}";
        return;
    }
    echo "{\"result\":1,\"message\":\"status changed\"}";
}

function disburse_payment_request($payment_request_id){
    global $userlevel;
    if($userlevel!=USER_LEVEL_ACCOUNT and $userlevel!=USER_LEVEL_ADMIN){
        echo "{\"result\":0,\"message\":\"you dont have access to disburse a request\"}";
        return;
    }
    include_once("payments.php");
    $programarea_id=  get_programarea();
    
    $p=new payments();
    $row=$p->get_payment_detail($payment_request_id);
    if(!$row['request_status']=="REQUESTED"){
        echo "{\"result\":0,\"message\":\"only submitted requests can be disbursed\"}";
       return;
    } 
    
    if($programarea_id!=0 and $programarea_id!=$row['programarea_id']){
        echo "{\"result\":0,\"message\":\"you can only disburse requests from your program unit\"}";
        return;
    }
    
    if(!$p->disburse_payment_request($payment_request_id)){
         echo "{\"result\":0,\"message\":\"{$p->str_error}\"}";
        return;
    }
    echo "{\"result\":1,\"message\":\"status changed\"}";
}

function liqudate_payment_request($payment_request_id){
    global $userlevel;
    if($userlevel!=USER_LEVEL_PUOFFICER and $userlevel!=USER_LEVEL_ADMIN){
        echo "{\"result\":0,\"message\":\"you dont have access to liqudate a request.\"}";
        return;
    }
    include_once("payments.php");
    $programarea_id=  get_programarea();
    
    $p=new payments();
    $row=$p->get_payment_detail($payment_request_id);
    if(!$row['request_status']=="DISBURSED"){
        echo "{\"result\":0,\"message\":\"only disbusrsed requests can be liqudated.\"}";
       return;
    } 
    
    if($programarea_id!=0 and $programarea_id!=$row['programarea_id']){
        echo "{\"result\":0,\"message\":\"you can only liqudate requests from your program unit.\"}";
        return;
    }
    
    if(!$p->liqudate_payment_request($payment_request_id)){
        echo "{\"result\":0,\"message\":\"{$p->str_error}\"}";
        return;
    }
    
    echo "{\"result\":1,\"message\":\"status changed\"}";
    
}

function create_payment_request(){
    $programarea_id=  get_programarea();
    $request_name=get_data("rqname");
    $user_id=  get_user_id();
    if(!$request_name){
        echo "{\"result\":0,\"message\":\"enter request name\"}";
        return;
    }
    include_once("payments.php");
    $p=new payments();
    $finacial_year=$p->get_current_finacial_year();
    $payment_request_id=$p->create_payment_request($finacial_year['financial_year_id'], $programarea_id, $request_name,$user_id);
    if($payment_request_id==false){
        echo "{\"result\":0,\"message\":\"{$p->str_error}\"}";
        return;
    }
    
    $row=$p->get_payment_detail($payment_request_id);
    if (!$row){
        echo "{\"result\":0,\"message\":\"no payment detail {$p->error}\"}";
        return;    
    }
    echo "{\"result\":1,\"payment_request_id\":$payment_request_id, \"payment\":"; 
        echo json($row);
    echo "}"; 
    
}

?>
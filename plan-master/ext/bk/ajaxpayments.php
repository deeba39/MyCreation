<?php
session_start();
include_once("const.php");
$cmd=get_datan("cmd");
 
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
    $financial_year_id=get_datan("fid");
    $status=get_data("st");

    include("payments.php");
    $p= new payments();
    if (!$p->get_all_payment_request($financial_year_id,$status)){
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
    $page=get_datan("page");
    $limit=0;
    if($page==0){
        $limit=25;
    }
    include_once ("students.php");
    $s=new students();
    if(!$s->get_payment_request_students($payment_id,$page,$limit)){
        echo "{\"result\":0,\"message\":\"no payment requested\"}";
        return;  
    }
    echo "{\"result\":1,\"payment_request_id\":$payment_id, \"students\":[";
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


?>
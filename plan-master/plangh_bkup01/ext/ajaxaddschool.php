<?php
include("school.php");
$cmd=get_data("cmd");
switch($cmd){
    case 1://primary
        add_primary_school();
        break;
    case 2://jss
	add_jss_school();
        break;
    default:
        echo "{\"result\":0,\"message\":\"unknown action\"}";
        break;
}

function add_primary_school(){
    
    $school_name=get_data("school_name");
    $point=get_data("school_category");
    if($school_name==false){
        echo "{\"result\":0,\"message\":\"school name is not correct\"}";
        exit();
    }

    $s=new school();
    $id=$s->add_primary_school($school_name,(int)$point);
    if($id==false){
        echo "{\"result\":0,\"message\":\"{$s->error}\"}";
        exit();
    }

    echo "{\"result\":1,\"message\":\"school added\",\"school_id\":$id}";

}
function add_jss_school(){
    
    $school_name=get_data("school_name");
    $point=get_data("school_category");
    if($school_name==false){
        echo "{\"result\":0,\"message\":\"school name is not correct\"}";
        exit();
    }

    $s=new school();
    $id=$s->add_jss_school($school_name,(int)$point);
    if($id==false){
        echo "{\"result\":0,\"message\":\"{$s->error}\"}";
        exit();
    }

    echo "{\"result\":1,\"message\":\"school added\",\"school_id\":$id}";

}
?>
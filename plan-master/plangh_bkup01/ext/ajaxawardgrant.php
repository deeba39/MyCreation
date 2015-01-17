<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include("applicants.php");

$cmd=get_data("cmd");
switch($cmd)
{
    case 1:
        awardScholarship();
        break;
    case 2:
        cancelScholarship();
        break;
    case 3:
        comfirmScholarship();
        break;
    case 4:
        updatePromote();
        break;
    case 5:
        setPromoted();
        break;

    default:
        echo "{\"result\":0,\"message\":\"unknown action\"}";


}

function awardScholarship()
{
    $student_applicant_id=get_data("student_applicant_id");
    $grant_id=get_data("grant_id");
 
    if($student_applicant_id==false)
    {
        echo "{\"result\":0,\"message\":\"unknown application id\"}";
        return;
    }

    if($grant_id==false)
    {
        echo "{\"result\":0,\"message\":\"unknown grant\"}";
        return;
    }

    /*if($amount==false)
    {
        echo "{\"result\":0,\"message\":\"scholarship amount to award is not correct\"}";
        return;
    }

    if($payment_schedule==false)
    {
        echo "{\"result\":0,\"message\":\"payment schedule is not correct\"}";
        return;
    }*/

    $app=new applicants();
    if(!$app->award_applicant_scholarship($student_applicant_id, $grant_id))
    {
        echo "{\"result\":0,\"message\":\"could not award grant {$app->error}\"}";
        return;
    }

    echo "{\"result\":1,\"message\":\"grant awarded\"}";
}

function cancelScholarship()
{
   $student_applicant_id=get_data("student_applicant_id");
   if($student_applicant_id==false)
    {
        echo "{\"result\":0,\"message\":\"unkown application id\"}";
        return;
    }
    $app=new applicants();
    if(!$app->cancel_applicant_scholarship($student_applicant_id))
    {
        echo "{\"result\":0,\"message\":\"could not cancel award {$app->error}\"}";
        exit();
    }

    echo "{\"result\":1,\"message\":\"grant cancled\"}";
}

function comfirmScholarship()
{
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
    

    
    $app=new applicants();
    if($student_applicant_id==false)
    {
        echo "{\"result\":0,\"message\":\"unkown application id\"}";
        exit();
    }
    if(!$app->confirm_applicant_scholarship($student_applicant_id,$scholarship_start_date,$scholarship_end_date,$school_id,
            $school_start_date,$school_end_date,$entry_class,$entry_level,$attendace,$program))
    {
        
        echo "{\"result\":0,\"message\":\"could not confirm scholarship {$app->error}\"}";
        exit();
    }
    echo "{\"result\":1,\"message\":\"scholarship confirmed\"}";
}

function setPromoted(){
    $attendance_id=get_data("attendance_id");
    $academic_year=get_data("academic_year");
    $promoted=get_data("promoted");

    if($attendance_id==false){
        echo "{\"result\":0,\"message\":\"unknown record id\"}";
        exit();
    }

    $app=new applicants();
    if(!$app->set_promote($attendance_id, $academic_year,$promoted)){
        echo "{\"result\":0,\"message\":\"could not record promotion {$app->error}\"}";
        exit();
    }
   
    echo "{\"result\":1,\"message\":\"promoted\"}";
}

function updatePromote(){
    $grade_year_id=get_data("grade_year_id");
    $promoted=get_data("promoted");

    if($grade_year_id==false){
        echo "{\"result\":0,\"message\":\"unknown record id\"}";
        exit();
    }

    $app=new applicants();
    if(!$app->update_promote($grade_year_id, $promoted)){
        echo "{\"result\":0,\"message\":\"could not update promotion {$app->error}\"}";
        exit();
    }

    echo "{\"result\":1,\"message\":\"updated\"}";
}
?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'ext/applicants.php';
$app=new applicants();
$app2=new applicants();
$app->get_applicants("programarea_id=1");
$row=$app->fetch();
$i=0;

while($row and $i<10){
    
    echo " updating {$row['student_applicant_id']} ";
   
    $phones=clean_phones($row['student_telephone_1'],$row['student_telephone_2']);
   
    if(!$app2->update_applicant2($row['student_applicant_id'],
            $row['student_firstname'],
            $row['student_lastname'],
            $row['student_middlename'],
            $row['app_mother_name'],
            $row['app_father_name'],
            $row['app_guardian_name'],
            $row['student_gender'],
            $row['app_referees'],
            $row['student_address'],
            $phones[0],
            $phones[1]
            )){
        echo " did not update</br>";
        
    }else{
        echo "did update</br>";
    }
    $row=$app->fetch();
    $i++;
    
    
}

function clean_phones($telephone1,$telephone2){
    $replace=array("-");
    
    $telephone1=clean_str($telephone1);
    $telephone1=  str_replace($replace, "",$telephone1);
    $telephone2=clean_str($telephone2);
    $telephone2=  str_replace($replace, "",$telephone2);
    
    if(!$telephone2 or count($telephone2)==0 or strcmp($telephone2,'none')==0){
        $str=  explode("/", $telephone1);
        if(count($str)>=2){
            $telephone1=$str[0];
            $telephone2=$str[1];
        }else{
            $telephone2="0880000000";
        }

    }
    return array($telephone1,$telephone2);
    
    
}

?>

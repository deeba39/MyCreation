<?php
session_start();

if(!isset($_SESSION["PlanGhana"]["PROGRAM_AREA"])){
    echo "{\"result\":0,\"message\":\"no access\"}";
    exit();
}

include_once("const.php");
$cmd=get_data("cmd");
header('Content-type: application/excel');
header('Content-Disposition: attachment; filename="report.xls"');

$userlevel=get_user_level();
 
switch($cmd){
   
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
}



function get_payments(){
    //use the payments class to echo payment request with a given status
    $financial_year_id=get_datan("fyid");
    $status=get_data("st");
    $programarea_id=  get_programarea();

    include("payments.php");
    $p= new payments();
    echo "<table border='1'>";
    if (!$p->get_payment_requests($financial_year_id,$programarea_id,$status)){
        echo "<tr><td>Error while exporting payments not found {$p->error}\"</td></tr>";
        echo "</table>";
        return;   
    }
    
    echo "<tr><td>Download Date :</td><td>". date("d/m/Y") ."</td></tr>";
    echo "<tr><td>Program Area :</td><td>". get_programarea_name($programarea_id) ."</td></tr>";
    echo "<tr><td>Finacial Year :</td><td>"; 
    if($financial_year_id==0){
        echo "all"; 
    }else{
        echo "finacial year";
    }
    echo "</td></tr>";
    echo "<tr><td>Status :</td><td>". get_payment_status_name($status) ."</td></tr>";
    echo "<tr><td></td><td></td></tr>";
    $style="color:#FFFFFF; background-color: #2647A0; text-align:center";
    echo "<tr>
            <td style='$style'>Finacial Year</td>
            <td style='$style'>Payment Request</td>
            <td style='$style'>Program Area</td>
            <td style='$style'>Amount</td>
            <td style='$style'>Status</td>
            <td style='$style'>Request Date</td>
            
          </tr>";
    $row=$p->fetch();
    $i=0;
    while($row){
        if($i%2==0){
            $style="background-color:#EDF5FF";
        }else{
            $style="background-color:#FFFFFF";
        }
        echo "<tr >";
            echo "<td style='$style'>{$row['year_name']}</td>";
            echo "<td style='$style'>{$row['code']}</td>";
            echo "<td style='$style'>{$row['programarea_name']}</td>";
            echo "<td style='$style' >{$row['amount']}</td>";
            echo "<td style='$style'>{$row['request_status']}</td>";
            echo "<td style='$style'>{$row['request_date']}</td>";
        echo "</tr>";
         $row=$p->fetch();
         $i++;
    }
    echo "</table>";
 
    
}

function get_schools(){
    //use the payments class to echo schools in the payment request
    $payment_request_id=get_data("prid");
    include("payments.php");
    $p= new payments();
    echo "<table border='1'>";
    $row=$p->get_payment_detail($payment_request_id);
    if(!$row){
        echo "<tr><td>Error while exporting payments not found {$p->error}\"</td></tr>";
        echo "</table>";
        return;   
    }
    if (!$p->get_payment_for_school($payment_request_id)){
        echo "<tr><td>Error while exporting payments not found {$p->error}\"</td></tr>";
        echo "</table>";
        return;   
    }
    echo "<tr><td>Download Date :</td><td>". date("d/m/Y") ."</td></tr>";
    echo "<tr><td>Payment Request:</td><td>{$row['code']}</tr>";
    echo "<tr><td>Program Unit:</td><td>{$row['programarea_name']}</tr>";
    echo "<tr><td>Finaical Year:</td><td>{$row['year_name']}</tr>";
    echo "<tr><td>Status:</td><td>{$row['request_status']}</tr>";
    echo "<tr><td>Request Date:</td><td>{$row['request_date']}</tr>";
    echo "<tr><td></td><td></td></tr>";
    $style="color:#FFFFFF; background-color: #2647A0; text-align:center";
   
    $style="background-color:darkseagreen";
    $i=0;
    $row=$p->fetch();
    
    while($row){
      
       
      
        echo "<tr >";
            echo "<td style='$style'>School: {$row['school_name']}</td>";
            echo "<td style='$style'>Ghc: {$row['total_amount']}</td>";
            echo "<td style='$style'>Number of Students: {$row['payment_number']}</td>";
        echo "</tr>";
        get_school_students($payment_request_id,$row['school_id']);
        echo "<tr></tr>";
        $i++;
        $row=$p->fetch();
    }
    echo "</table>";    

}

function get_students(){
    //use the student class to get students in the payment request   
    $payment_request_id=get_data("prid");
    $year=get_data("year");
    $programarea_id=  get_programarea();
    include("payments.php");
    $p= new payments();
    echo "<table border='1'>";
    $row=$p->get_payment_detail($payment_request_id);
    if(!$row){
        echo "<tr><td>Error while exporting payments not found {$p->error}\"</td></tr>";
        echo "</table>";
        return;   
    }
    include_once ("payments.php");
    $p=new payments();
    if(!$p->get_payment_request_students_programarea($payment_request_id,$programarea_id,$year,0,0)){
       echo "<tr><td>Error while exporting payments not found {$p->error}\"</td></tr>";
        echo "</table>";
        return;   
    }
    echo "<tr><td>Download Date :</td><td>". date("d/m/Y") ."</td></tr>";
    echo "<tr><td>Payment Request:</td><td>{$row['code']}</tr>";
    echo "<tr><td>Program Unit:</td><td>{$row['programarea_name']}</tr>";
    echo "<tr><td>Finaical Year:</td><td>{$row['year_name']}</tr>";
    echo "<tr><td>Status:</td><td>{$row['request_status']}</tr>";
    echo "<tr><td>Request Date:</td><td>{$row['request_date']}</tr>";
    echo "<tr><td>Year :</td><td>"; 
        if($year==0){
            echo "all"; 
        }else{
            echo $year;
        }
    echo "</td></tr>";
    echo "<tr><td></td><td></td></tr>";


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

function get_school_students($payment_request_id,$school_id){
    //use the student class to get students in the payment request   
   
    
    $page=0;
    $limit=0;
    
   
    include_once ("payments.php");
    $p=new payments();
    if(!$p->get_payment_request_students_school($payment_request_id,$school_id,0,$page,$limit)){
       echo "<tr><td>Error while exporting payments not found {$p->error}\"</td></tr>";
        return; 
    }
   
    show_students($p);

}

function show_students($p){
        $style="color:#FFFFFF; background-color: #2647A0; text-align:center";
    echo "<tr>
            <td style='$style'>PU</td>
            <td style='$style'>Year</td>
            <td style='$style'>District</td>
            <td style='$style'>Community</td>
            <td style='$style'>Last Name</td>
            <td style='$style'>First Name</td>
            <td style='$style'>Gender</td>
            <td style='$style'>Birth Date</td>
            <td style='$style'>Telephone</td>    
            <td style='$style'>Amount</td>
            <td style='$style'>Grant</td>
          </tr>";
    $i=0;
    $row=$p->fetch();
    while($row){
        if($i%2==0){
            $style="background-color:#EDF5FF";
        }else{
            $style="background-color:#FFFFFF";
        }
        /*spa.`payment_request_payment_request_id`, spa.`scholarship_payment_id`, spa.`date`, spa.`status`, spa.`amount`, spa.`schools_school_id`,
        spack.`scholarship_package_id`,spack.`start_date`,spack.`end_date`,spack.`annual_amount` as scholarship_annaual_amount , ifnull(spack.`status`,0),
            v.`sponsored_student_id`, v.`student_firstname`, v.`student_middlename`, v.`student_lastname`,
            v.`student_applicant_student_applicant_id`, v.`programarea_id`, v.`programarea_name`, 
            v.`DistrictID`, v.`District`, v.`community_id`, v.`community`, v.`student_telephone_1`, 
            v.`student_telephone_2`, v.`student_dob`,v.`app_submission_year`, v.`student_gender`, 
            v.`school_name`, v.`app_grant_id`, v.`grant_package_id`, v.`grant_name`, v.`annual_amount`
                */
        echo "<tr >";
            echo "<td style='$style'>{$row['programarea_name']}</td>";
            echo "<td style='$style'>{$row['app_submission_year']}</td>";
            echo "<td style='$style'>{$row['District']}</td>";
            echo "<td style='$style'>{$row['community']}</td>";
            echo "<td style='$style'>{$row['student_lastname']}</td>";
            echo "<td style='$style'>{$row['student_firstname']}</td>";
            echo "<td style='$style'>{$row['student_gender']}</td>";
            echo "<td style='$style'>{$row['student_dob']}</td>";
             echo "<td style='$style'>{$row['student_telephone_1']}, {$row['student_telephone_2']}</td>";
            echo "<td style='$style'>{$row['annual_amount']}</td>";
            echo "<td style='$style'>{$row['grant_name']}</td>";
        echo "</tr>";
        $i++;
        $row=$p->fetch();
    }

}

function get_payment_status_name($status){
    switch($status){
        case 0:
            return "ALL";
        case 1:
            return "NEW REQUEST";
        case 2:
            return "REQUESTED";
        case 3:
            return "DISBURSED";
        case 4:
            return "LIQUDATED";
    }
}

function get_programarea_name($programarea_id){
    include_once("programarea.php");
    $progrmarea_name="all";
    if($programarea_id!=0){
        $p=new programareas();
        $row=$p->get_programarea($programarea_id);
        $progrmarea_name=$row["programarea_name"];
    }
    return $progrmarea_name;

    
}


?>
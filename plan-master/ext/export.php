<?php
session_start();
include_once("const.php");
$cmd=get_data("cmd");
header('Content-type: application/excel');
header('Content-Disposition: attachment; filename="report.xls"');
        
switch($cmd)
{

    case 8:
        get_strudent_list();
        break;
    
    case 13:
        get_paid_for_students();
        break;
    case 14:
        get_payment_request_students();
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
    $page=0;
    $limit=0;
    
    $community_id=get_data("community_id");
    $district_id=get_data("district_id");
    $programarea_id=  get_programarea();        //get_data("programarea_id");
    $s=new students();
    
    $result=$s->get_students_from_programarea($programarea_id, $year, $scholarship_status,$search_text,$page,$limit);
    echo "<table border='1'>";
    if($result==false){
         echo "<tr><td>Error while getting students {$s->error}</tr>";
         return;
    }else{
        $count=$s->count;
  
        echo "<tr><td>Download Date :</td><td>". date("d/m/Y") ."</td></tr>";
        echo "<tr><td>Program Area :</td><td>". get_programarea_name($programarea_id) ."</td></tr>";
        echo "<tr><td>Year :</td><td>"; 
        if($year==0){
            echo "all"; 
        }else{
            echo $year;
        }
        echo "</td></tr>";
        echo "<tr><td>Status :</td><td>". get_scholarship_name($scholarship_status) ."</td></tr>";
        echo "<tr><td></td><td></td></tr>";
        
        $style="color:#FFFFFF; background-color: #2647A0; text-align:center";
        echo "<tr>
                <td style='$style'>PU</td>
                <td style='$style'>District</td>
                <td style='$style'>Community</td>
                <td style='$style'>Year</td>
                <td style='$style'>Last Name</td>
                <td style='$style'>First Name</td>
                <td style='$style'>Birth Date</td>
                <td style='$style'>Gender</td>
                <td style='$style'>Tel 1</td>
                <td style='$style'>Tel 2</td>
                <td style='$style'>Grant</td>
                <td style='$style'>Status</td>
              </tr>";
        $row=$s->fetch();
        $i=0;
        while($row){
            if($i%2==0){
                $style="background-color:#EDF5FF";
            }else{
                $style="background-color:#FFFFFF";
            }
           /*
            * `sponsored_student_id`, `student_firstname`, `student_middlename`, 
            `student_lastname`, `student_picture`, `student_grades`, 
            `programarea_name`, `programarea_id`, `DistrictID`, `community`, `community_id`, 
            `District`, `student_telephone_1`, `student_telephone_2`, `student_dob`, 
            `app_submission_year`, `student_gender`, `school_name`, 
            `app_grant_id`, `grant_package_id`, `grant_name`, v.`annual_amount`,
            ifnull(sp.`status`,0) as scholarship_status
            */
            echo "<tr >";
                echo "<td style='$style'>{$row['programarea_name']}</td>";
                echo "<td style='$style'>{$row['District']}</td>";
                echo "<td style='$style'>{$row['community']}</td>";
                echo "<td style='$style'>{$row['app_submission_year']}</td>";
                echo "<td style='$style'>{$row['student_lastname']}</td>";
                echo "<td style='$style'>{$row['student_firstname']}</td>";
                echo "<td style='$style'>{$row['student_dob']}</td>";
                echo "<td style='$style'>{$row['student_gender']}</td>";
                echo "<td style='$style'>{$row['student_telephone_1']}</td>";
                echo "<td style='$style'>{$row['student_telephone_2']}</td>";
                echo "<td style='$style'>{$row['grant_name']}</td>";
                echo "<td style='$style'>".get_scholarship_name($row['scholarship_status'])."</td>";
            echo "</tr>";
             $row=$s->fetch();
             $i++;
        }
    }
    echo "</table>";
    
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

function get_paid_for_students(){
    /*permission level 1 2 3*/
    $financial_year_id=get_datan("fid");
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

function get_scholarship_name($status){
    
    switch($status){
        case 1:
             return "ACTIVE";
        case 2:
            return "SUSPENDED";
        case 3:
            return "ENDED";
        default:
            return "UNKNOWN";
    }
}
?>

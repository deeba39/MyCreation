<?php
session_start();
include_once("const.php");
$cmd=get_data("cmd");
header('Content-type: application/excel');
header('Content-Disposition: attachment; filename="report.xls"');
        
switch($cmd)
{

    case 2:
        get_applicants();
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


function get_applicants(){
    $programarea_id=  get_programarea();
    $year=get_data("year");
    $status=get_data("st");
    $search_text=get_data("search_text");
    $order=  1; //app point
 
    include_once 'applicants.php';
    $app=new applicants();
    $result=$app->get_applicants_programarea($programarea_id,$year,0,$status,$search_text,$order,0,0);

    echo "<table border='1'>";
    if($result==false){
         echo "<tr><td>Error while getting students {$s->error}</tr>";
         return;
    }else{
        $count=$app->count;
  
        echo "<tr><td>Download Date :</td><td>". date("d/m/Y") ."</td></tr>";
        echo "<tr><td>Program Area :</td><td>". get_programarea_name($programarea_id) ."</td></tr>";
        echo "<tr><td>Year :</td><td>"; 
        if($year==0){
            echo "all"; 
        }else{
            echo $year;
        }
        echo "</td></tr>";
        echo "<tr><td>Status :</td><td>"; 
  
        if($status==0){
            echo "All Applictions";
        }else if($status==1){
            echo "New Applictions";
        }else if($status==2){
            echo "Awarded Applictions";
        }else if($status==2){
            echo "Confirmed Applictions";
        }
        echo "</td></tr>";
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
                <td style='$style'>School Applied To</td>
                <td style='$style'>Point</td> 
                <td style='$style'>Sponsored Child</td>       
                <td style='$style'>Grant</td>
                <td style='$style'>Status</td>
              </tr>";
        $row=$app->fetch();
        $i=0;
        while($row){
            if($i%2==0){
                $style="background-color:#EDF5FF";
            }else{
                $style="background-color:#FFFFFF";
            }
          
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
                echo "<td style='$style'>{$row['school_name']}</td>";
                echo "<td style='$style'>{$row['app_points']}</td>";
                echo "<td style='$style'>{$row['sponsored_child_no']}</td>";
                echo "<td style='$style'>{$row['grant_name']}</td>";
                echo "<td style='$style'>".get_application_status_name($row['app_status'])."</td>";
            echo "</tr>";
             $row=$app->fetch();
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


function get_application_status_name($status){
    if($status==0){
        return "New App";
    }else if($status==1){
        return "Awarded";
    }else if($status==2){
        return "Confirmed";
    }else{
        return "Unknown";
    }

}

?>

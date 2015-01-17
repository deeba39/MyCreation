<?php
    include_once("const.php");
    include("applicants.php");
    include("occupation.php");


    if(!isset($_REQUEST['programarea_id'])){
        echo "unknown program area";
        //redirect_topage("../generate_summary.php");
        exit();
    }
    $programarea_id=$_REQUEST["programarea_id"];
    
    
    $list=new applicants();

    $app_year=$list->get_admission_year();
    if($app_year==false){
        echo "unknown year";
        //redirect_topage("../generate_summary.php");
        exit();
    }
    
    if(!$list->get_applicants_programarea($programarea_id,$app_year,0,1,"0",1,0,0)){
        echo "{$list->error} error while getting list of applicants ";
        exit();
    }
    if($list->get_num_rows()==0){
        echo "no record";
        exit();
    }
   
    header('Content-type: application/msword');
    //header("Content-Length: $len");
    header('Content-Disposition: attachment; filename="summary.xml"');
    
    readfile("summary_header.txt");
    $list_row=$list->fetch();
    $i=0;
    $app=new applicants();
    $occ=new occupation();
    while($list_row){
        $row=$app->get_applicant($list_row['student_applicant_id']);
        $row_occ=$occ->get_occupation($row['app_father_occupation']);
        $row["father_occupation_name"]=$row_occ['name'];
        $row["father_occupation_point"]=$row_occ['app_point'];
        $row_occ=$occ->get_occupation($row['app_mother_occupation']);
        $row["mother_occupation_name"]=$row_occ['name'];
        $row["mother_occupation_point"]=$row_occ['app_point'];
        $row_occ=$occ->get_occupation($row['app_guardian_occupation']);
        $row["guardian_occupation_name"]=$row_occ['name'];
        $row["guardian_occupation_point"]=$row_occ['app_point'];
        $row["grade_point"]=$app->get_grade_point($row['student_grades']);
      
        include("summary_body.php");
        $list_row=$list->fetch();
        if($list_row){
            ?>
             <w:p wsp:rsidR="00684A43" wsp:rsidRDefault="00684A43">
                <w:r><w:br w:type="page"/></w:r>
             </w:p>
            <w:p wsp:rsidR="00684A43" wsp:rsidRDefault="00684A43" wsp:rsidP="003067FE"/>
            <?php
        }
        $i++;
    }
?>

            <w:sectPr wsp:rsidR="00684A43" wsp:rsidSect="002F51BB">
            <w:pgSz w:w="11907" w:h="16839" w:code="9"/>
            <w:pgMar w:top="1440" w:right="1440" w:bottom="1440" w:left="1440" w:header="720" w:footer="720" w:gutter="0"/>
            <w:cols w:space="720"/>
            <w:docGrid w:line-pitch="360"/>
        </w:sectPr>
    </w:body>
</w:wordDocument>
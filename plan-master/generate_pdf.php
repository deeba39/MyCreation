<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "SelectionViewinfo.php" ?>
<?php include "userfn7.php" ?>
<?php include "header.php" ?>
<?php

        include_once("ext/const.php");
        include("ext/pdfapplicant2.php");
        include("ext/applicants.php");
        include("ext/occupation.php");
        
        
		$app_year=(int)get_data("app_year");
		if($app_year==0){
			$app_year=date("Y");
		}
		
		if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]==0){
			$programarea_id=(int)get_data("programarea_id");
		}
		else{
			//use the session value for selection
			$programarea_id=$_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"];
		}
		
        
		
?>
Generate Applicatin Summary as PDF for printing:

<form action="generate_pdf.php" method="GET">
<table>
	<tr>
		<td>
		<?php
			include("ext/programarea.php");
			if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]==0){
				echo "<b>Program Area :</b><select name='programarea_id' >";
                    echo "<option value='0'>select programme area</option>";
                    $p=new programareas();
                    if($p->get_programareas()){
                        $row=$p->fetch();
                        while($row){
                            $selected="";
                            if($programarea_id==$row['programarea_id'])
                            {
                                $selected="selected";
                            }

                            echo "<option value='{$row['programarea_id']}' $selected >{$row['programarea_name']}</option>";
                            $row=$p->fetch();
                        }
                    }
				echo "</select> ";
			}
			else{
				
				$p=new programareas();
                $row=$p->get_programarea($programarea_id);
				if(!$row){
					echo "Could not display programarea name.";
				}else{
					echo "<b>Program Area :</b> {$row["programarea_name"]} ";
				}
			}	
		?>
		</td>
		<td>
		<b>Application Year :</b> <select id="app_year" name="app_year">
            <?php
                $y=date("Y");
                for($i=0; $i<=10; $i++){
                    $x=$y-$i;
                    if($x==$app_year){
                        $selected="selected";
                    }else{
                        $selected="";
                    }

                    echo "<option $selected value='$x'>$x</option>";
                }
            ?>
        </select>
		</td>
		<td >
			Status :<input type="checkbox" name="not_awarded" value="1">not awarded
			<input type="checkbox" name="not_awarded" value="2">awarded
			<input type="checkbox" name="not_awarded" value="1">confirmed
		</td>	
	</tr>
	<tr>
		<td colspan="3" align="right">
			<input type="hidden" name="ck" value="1">
			<input type="submit" value="generate pdf">
		</td>
	</tr>
	</table>	
</form>
<?php
	$ck=get_data("ck");		
    if(!$ck)
	{
		exit();
	}
        $pdf = pdf_new();
        $filename="applicants{$programarea_id}{$app_year}.pdf";
        if(file_exists($filename))
        {
            delete($filename);
        }
      
        if(!pdf_open_file($pdf,$filename))
        {
                echo "Could not create pdf file.";
                exit();
        }

        $app=new applicants();
        $list=new applicants();
		
        $occ=new occupation();

        if(!$list->get_applicants_for_pdf($programarea_id,$app_year,true)){
            echo "{$list->error} error while getting list of applicants ";
            exit();
        }
		if($list->get_num_rows()==0){
			 echo "no record ";
            exit();
		}
        $list_row=$list->fetch();
        $i=0;
        echo "generating pdf file...<br>";
        while($list_row!=false and $i<PDF_REPORT_LIMIT){
            $row=$app->get_applicant($list_row['student_applicant_id']);
			//echo $list_row['student_applicant_id'] ."</br>";
            if(!$row){
                echo "{$app->error} error getting applicant record for {$list_row['student_applicant_id']}  ";
            }
            else
            {

                $row_occ=$occ->get_occupation($row['app_father_occupation']);
                $row["father_occupation_name"]=$row_occ['name'];
                $row_occ=$occ->get_occupation($row['app_father_occupation']);
                $row["mother_occupation_name"]=$row_occ['name'];
                $row_occ=$occ->get_occupation($row['app_guardian_occupation']);
                $row["guardian_occupation_name"]=$row_occ['name'];
				
                $pdftmp=new applicant_pdf2($pdf) ;
                //$photo=pdf_load_image($pdf,"jpeg","C:\\my_data\\websites\\plan\\pdf\\photo_sample.jpg","");


                pdf_begin_page($pdf, pin(8.27), pin(11.69));
                $pdftmp->get_page($row);
                //pdf_fit_image($pdf,$photo,pin(6),pin(9),"boxsize {200 100} position 0 fitmethod meet");
                pdf_end_page($pdf);
                //pdf_close_image($pdf,$photo);
            }
            $list_row=$list->fetch();
            $i++;
        }
        pdf_close($pdf);
        $_SESSION[APPLICATION_NAME]['pdffn']=$filename;
        redirect_topage("ext/getpdf.php?fn=$filename");

        echo "done<br>";
        echo "<a href='ext/getpdf.php?fn=$filename' >click here to open pdf if it does not download automatically</a>";
?>

        
    </body>
</html>

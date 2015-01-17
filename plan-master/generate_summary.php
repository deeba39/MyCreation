<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
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
Generate Application Summary as MSWORD/PDF for printing:

<form action="ext/summary.php" method="POST">
<table>
	<tr>
		<td>
		<?php
                    include("ext/programarea.php");
                    if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]==0){
                        echo "<b>Program Area/Unit :</b><select name='programarea_id' >";
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
                        echo "<input type='hidden' name='programarea_id' value='{$_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]}' >";
                        echo "<b>Program Area/Unit :</b> {$_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA_NAME"]} ";

                    }
		?>
		</td>
		<td>
		<b>Application Year :</b> 
            <?php
                
                $app=new applicants();
                $app_year=$app->get_admission_year();
                echo $app_year;
                echo "<input type='hidden' value='$app_year' name='app_year' >"

            ?>
                </td>
                <td>
                    <input type="submit" name="sub" value="generate summary" >
                </td>
                </tr>

	</table>	
</form>
   
    </body>
</html>

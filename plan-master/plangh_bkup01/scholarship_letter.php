<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "SelectionViewInfo.php" ?>
<?php include "userfn7.php" ?>
<?php include "header.php" ?>
<?php

        include_once("ext/const.php");
        include("ext/pdfapplicant2.php");
        include("ext/applicants.php");
        include("ext/occupation.php");
        
        
		$app=new applicants();
		$app_year=$app->get_admission_year();
		
		
		if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]==0){
			$programarea_id=(int)get_data("programarea_id");
		}
		else{
			//use the session value for selection
			$programarea_id=$_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"];
		}
		
		if(isset($_POST['ck'])){
			$signatory=get_data("signatory");
			$title=get_data("title");
			$body=get_data("body");
		}
		else{
			$signatory="";
			$title="Learning Advisor";
			$body="It is my pleasure to inform you that your scholarship application has been accepted, and you have been awarded an annual scholarship grant spcified below. Please confirm your acceptance by reading,signing and return the terms and conditions document attached to Plan office at ";	
		}
        
		
?>
<form action="ext/scholarship_letter.php" method="POST">
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
				
				echo "<input type='hidden' name='programarea_id' value='{$_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]}' >";
                                echo "<b>Program Area/Unit :</b> {$_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA_NAME"]} ";
			}
			
			
		?>
			</td>
			<td>
                            <b>Application Year :</b> <?php echo $app_year ?>
        
			</td>
		</tr>
		<tr>
			<td>
				Name of Signatory :<input type="text" size="30" name="signatory" value="<?php echo  $signatory ?>">
			</td>
			<td>
				Title :<input type="text" size="30" name="title" value="<?php echo  $title ?>">
			</td>
		</tr>
	
		<tr>
			<td colspan="2">
			Body :
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<textarea name="body" cols="100" rows="10"><?php echo $body ?></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				<input type="submit" value="generate letter">
			</td>
		</tr>
	</table>
	<input type="hidden" name="ck" value="1">
</form>
<?php		
        
    
?>

        
    </body>
</html>

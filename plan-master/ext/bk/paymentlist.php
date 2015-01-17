<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>

<?php include "usersinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php include "header.php" ?>

        <link href="ext/style.css" rel="stylesheet">

 
        <script type="text/javascript" src="ext/jquery-1.11.0.js"></script>
        <script type="text/javascript" src="ext/gen.js"></script>
        <script type="text/javascript">


            var page=1;
            var recCount=0;
            var searchType=0;
            var students=null;
            var schools=null;
            var payments=null;
            
            function next(){
                /*if(recCount==0){
                    return;
                }
                var nopages= (recCount/15);
                if(page>nopages){
                    return;
                }*/
                page=page+1;
                if(searchType==1){
                    getSchools();
                }else if(searchType==2){
                    getStudentsInPaymentRequest();
                }else{ 
                    getStudents();
                }
            }
            
            function prev(){
                if(page==1){
                    return;
                }
                page=page-1;
                if(searchType==1){
                    getSchools();
                }else if(searchType==2){
                    getStudentsInPaymentRequest();
                }else{ 
                    getStudents();
                }
            }
            
            function newSearch(searchType){
                page=1;
                recCount=0;
                if(searchType==1){
                    getSchools();
                }else if(searchType==2){
                    getStudentsInPaymentRequest();
                }else{ 
                    getStudents();
                }
            }
            
            var students=null;
            var schools=null;

            function getSchools(){
            //synchAjax is defined in ext/gen.js file
                var prid=$("#requestId").prop("value");
                var objResult=synchAjax("ext/ajaxpayments.php?cmd=3&prid="+prid);
                if(objResult.result==0){
                    showError(objResult.message);
                    return;
                }
                //check if synchAjax has returned successful result
                //objResult.schools will be an array of schools record. 
                //Each rechord will have school name, school id, amount the school to be paid, number students from the school 	
                showSchools(objResult);        
		searchType=1;
            }
        
            function getStudentsInPaymentRequest(){
                var prid=$("#requestId").prop("value");
                objResult=synchAjax("ext/ajaxpayments.php?cmd=4&prid="+prid+"&page="+page);
                //check if objResult has successful result
                if(objResult.result==0){
                    showError(objResult.message);
                    return;
                }
                showStudents(objResult);
                searchType=2;
            }
          
            function getPaymentDetail(){
                var prid=$("#requestId").prop("value");
				if(prid==0){
					return;
				}
                objResult=synchAjax("ext/ajaxpayments.php?cmd=5&prid="+prid);
                //we will deal with this later
		searchType=3;                      
            }
          
            function showSchools(objResult){
                
                  tableSchools.style.display="block";
                  tableStudents.style.display="none";
                    
                  clearTable(tableSchools,1);
                  for(i=0;i<objResult.schools.length;i++){
                   
                   var r=tableSchools.insertRow(-1);
                   if(i%2==0){
                       r.className="default_report_line1";
                   }else{
                       r.className="default_report_line2";
                   }
                 
                   var c=r.insertCell(0);
                     c.innerHTML="<input type='checkbox' id='"+objResult.schools[i].school_id+"' name='"+objResult.schools[i].school_id+"' value='"+objResult.schools[i].school_id+"'>";
                     var c=r.insertCell(1);
                     c.innerHTML=objResult.schools[i].school_name;
                     c=r.insertCell(2);        
                     c.innerHTML=objResult.schools[i].payment_number;
                     c=r.insertCell(3);        
                     c.innerHTML=objResult.schools[i].total_amount;
                    //amount is missing
                    //number of student is missing 
                    //look at the table below
                }
                showStatus("showing shcools in the selected payment request");
                schools=objResult.schools;
            }

            function showStudents(objResult){
                clearTable(tableStudents,1);
                tableSchools.style.display="none";
                tableStudents.style.display="block";
                
                for(i=0;i<objResult.students.length;i++){
                   
                   var r=tableStudents.insertRow(-1);
                   if(i%2==0){
                       r.className="default_report_line1";
                   }else{
                       r.className="default_report_line2";
                   }
                   var c=r.insertCell(0);
                   c.innerHTML="<input type='checkbox' id='"+objResult.students[i].sponsored_student_id+"' name='"+objResult.students[i].sponsored_student_id+"' value='"+objResult.students[i].sponsored_student_id+"'>";
                   var c=r.insertCell(1);
                   c.innerHTML=objResult.students[i].programarea_name;
                   c=r.insertCell(2);
                   c.innerHTML=objResult.students[i].app_submission_year;
                   c=r.insertCell(3)
                   c.innerHTML=objResult.students[i].community;
                   c=r.insertCell(4);
                   c.innerHTML="<b>" +objResult.students[i].student_lastname +"</b>, " +objResult.students[i].student_firstname;
                   c=r.insertCell(5);
                   if(validateGender(objResult.students[i].student_gender)){
                        c.innerHTML=objResult.students[i].student_gender;
                   }else{
                       c.innerHTML="<span class='default_error'>invalid</span>";
                   }
                   c=r.insertCell(6);
                   c.innerHTML=formatDateFromMysql(objResult.students[i].student_dob);
                   c=r.insertCell(7);
                   c.innerHTML=objResult.students[i].student_telephone_1 +", " +objResult.students[i].student_telephone_2;
                   c=r.insertCell(8);
                   c.innerHTML=objResult.students[i].school_name;
                   c=r.insertCell(9);
                   c.innerHTML=objResult.students[i].name;
                   
                }
                showStatus("showing students in the selected payment request");
                students=objResult.students;
            }
            
            
          
            
            
        </script>
        
        <div id="divStatus" class="default_status">
        </div>
                
        <div >
            <div>
                <?php
                
                include_once("ext/programarea.php");
                if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]==0){
                    
                    echo "<b>Program Area/Unit :</b><select name='programarea_id' id='programarea_id' >";
                    echo "<option value='0'>--include all---</option>";
                    $p=new programareas();
                    if($p->get_programareas()){
                        $row=$p->fetch();
                        while($row){
                            $selected="";
                            
                            echo "<option value='{$row['programarea_id']}' $selected >{$row['programarea_name']}</option>";
                            $row=$p->fetch();
                        }
                    }
              			echo "</select> ";
                        }else{
                        $programarea_id=$_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"];
                        $p=new programareas();
                        $row=$p->get_programarea($programarea_id);
                        if(!$row){
                                echo "Could not display programarea name.";
                        }else{
                                echo "<b>Program Area :</b> {$row["programarea_name"]} ";
                        }
                        
                }
                ?>
                    <b>Application Year :</b> 
                                <?php 
                                include_once "ext/applicants.php";
                                    $app=new applicants();
                                    if(!$app->get_years()){
                                        echo "<input id='app_year' name='app_year' value='$app_year' title='enter 0 to select all'>";
                                    }
                                    else
                                    {
                                        
                                 ?>
                                <select id="app_year" name="app_year">
                                    <option value="0" >--all---</option>
                                    <?php
                                        $row=$app->fetch();
                                        while($row)
                                        {
                                            $selected="";
                                            echo "<option value=\"{$row['app_year']}\" $selected>{$row['app_year']}</option>";
                                            $row=$app->fetch();
                                        }
                                    }
                                    ?>
                                </select>
     
					finacial year :<select>
								   </select>
                    payment request :
                   <?php
                        $programarea_id=0;
                        if(isset($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"])){
                            $programarea_id=$_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"];
                        }
                        $p=new programareas();
                        if($p->get_new_payment_requests($programarea_id)){
                            echo "<select id='requestId' onchange='getPaymentDetail()'>";
                            echo "<option value='0'>--select--</option>";
                            while($row=$p->fetch()){
                                echo "<option value='{$row['payment_request_id']}'>{$row['code']}</option>";
                            }
                            echo "<select>";
                        }
                    ?> 

                  <!--<?php
                        // $payment_id=0;
                        // if(isset($_SESSION[EW_PROJECT_NAME]["PAYMENT_REQUEST"])){
                        //     $payment_id=$_SESSION[EW_PROJECT_NAME]["PAYMENT_REQUEST"];
                        // }
                        // include "ext/students.php";
                        // $s=new students();
                        // if($s->get_payment_request_students($payment_id,0,0)){
                        //     echo "<select id='studentId'>";
                        //     echo "<option value='0'>--select--</option>";
                        //     while($row=$s->fetch()){
                        //         echo "<option value='{$row['payment_request_id']}'>{$row['code']}</option>";
                        //     }
                        //     echo "<select>";
                        // }
                    ?> -->
 
                      <!--<?php
                        // include_once "ext/payments.php";
                        // $f=new payments();
                        // if (!$f->get_all_financial_year()){
                        //     echo "no financial year found";
                        // }
                        // $row=$f->fetch();
                        // include_once "ext/payments.php";
                        // $py=new payments();
                        // if($py->get_all_payment_request($row['financial_year_id'],1)){
                        // $row=$f->fetch();
                        //     echo "<select id='requestId'>";
                        //     echo "<option value='0'>--select--</option>";
                            
                        //     while($result=$py->fetch()){
                        //         echo "<option value='{$result['payment_request_id']}'>{$row['code']}</option>";
                        //     }
                        //     echo "<select>";
                        // }
                    ?> -->

                
                    <span class="hotspot" onclick="getSchools()">get schools</span> | 
                    <span class="hotspot" onclick="getStudentsInPaymentRequest()">get students</span> |
                    
           </div>
            <div id="divPaymentDetail">
                <table id="tablePaymentDetail"></table>
            </div>
            <table width="100%">
                <td style="vertical-align: top">
                    <table width="100%">
                        <tr><td><span class="hotspot" onclick="prev()">prev</span> </td><td width="80%"><td><span class="hotspot" onclick="next()">next</span></td></tr>
                     </table>
                    <table id="tableSchools" style="width:100%;display:none">
                        <tr class="default_report_title">
                            <td></td>
                            <td>School</td>
                            <td>Total Amount</td>
                            <td>Number Students</td>
                        </tr>
                    </table>   
                    <table id="tableStudents" style="width:100%;display:none">
                        <tr class="default_report_title">
                            <td></td>
                            <td>PU</td>
                            <td>Year</td>
                            <td>Community</td>
                            <td>Name</td>
                            <td>Gender</td>
                            <td>Telephone</td>
                            <td>School</td>
                            <td>Grant</td>
                            <td>Amount</td>
                            <td>Type</td>
                        </tr>
                    </table>
                  
                </td>
               
                    
            </table>
        </div>
		<div id="divPayments">
			<table id="tablePayments">
				<tr class="default_report_title">
                    <td></td>
                    <td>Payment Request</td>
                    <td>Finacial Year</td>
                    <td>Program Area</td>
					<td>Amount</td>
				</tr>
			</table>
		</div>
    </body>
    
</html>

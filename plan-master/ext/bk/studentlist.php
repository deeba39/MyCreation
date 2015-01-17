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
            
            function next(){
                if(recCount==0){
                    return;
                }
                var nopages= (recCount/15);
                if(page>nopages){
                    return;
                }
                page=page+1;
                if(searchType==1){
                    getPaidForStudents(1);  //paid for
                }else if(searchType==2){
                    getPaidForStudents(0);  //not paid for
                }else if(searchType==3){
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
                    getPaidForStudents(1);  //paid for
                }else if(searchType==2){
                    getPaidForStudents(0);  //not paid for
                }else if(searchType==3){
                    getStudentsInPaymentRequest();
                }else{ 
                    getStudents();
                }
            }
            
            function newSearch(searchType){
                page=1;
                recCount=0;
                if(searchType==1){
                    getPaidForStudents(1);  //paid for
                }else if(searchType==2){
                    getPaidForStudents(0);  //not paid for
                }else if(searchType==3){
                    getStudentsInPaymentRequest();
                }else if(searchType==4){
                    getStudentsWithScholarshipStatus();
                }else if(searchType==5){
                    getScholarshipEndingStudents();
                }else{ 
                    getStudents();
                }
            }
            
            function getByScholarship(searchType){
                page=1;
                recCount=0
            }

            var currentIndex=-1;
            var currentStudentId=0;
            var currentTableRow=null;
            var currentColor="";
            var objDisplayRow=null;
            var displayIndex=-1;
            
            function openRecord(obj,index,id){
                if(students==null){
                    return;
                }
       
                cancel();
                currentIndex=index;
                currentStudentId=id;
                currentTableRow=obj.parentNode.parentNode;
                currentColor=currentTableRow.style.backgroundColor;
                currentTableRow.style.backgroundColor="yellow";
                
                showStatus("record open");
                divLeftPane.style.display="block";
                getStudentPerformance();
                
            }
            
            function openRecord2(obj,index,id){
                if(students==null){
                    return;
                }
       
                cancel();
                currentIndex=index;
                currentStudentId=id;
                currentTableRow=obj.parentNode.parentNode;
                currentColor=currentTableRow.style.backgroundColor;
                currentTableRow.style.backgroundColor="yellow";
                
                n=currentTableRow.rowIndex+1;
                objRow=tableStudents.insertRow(n);
                c=objRow.insertCell(0);
                c.colSpan=11;
                c.innerHTML="here";
                c.appendChild(document.getElementById("divLeftPane"));
                
                if(objDisplayRow!=null){
                    tableStudents.deleteRow(objDisplayRow.rowIndex);
                }
                //displayIndex=objRow.rowIndex;
                objDisplayRow=objRow;
                showStatus("record open");
                divLeftPane.style.display="block";
                //getStudentPerformance();
                
            }
           
            function cancel(){
                divLeftPane.style.display="none";
                if(currentStudentId==0){
                    return;
                }
                currentStudentId=0;
                currentIndex=0;
                if(currentTableRow!=null){
                    currentTableRow.style.backgroundColor=currentColor;
                    currentTableRow=null;
                }
                closePopups();
                
            }
            
            function closePopups(){
                divAttendance.style.display="none";
                divViewUpdate.style.display="none";
                divPayment.style.display="none";
                divPerformance.style.display="none"
            }
            
            
            
            
        </script>
        <script src="ext/studentlist.js"></script>
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
     
                <input type="text" value="" id="txtSearch" >
                <span class="hotspot" onclick="newSearch(0)">search</span>
            </div>
            <div>
                <div style="display:inline; background-color:#FFA07A">
                    payment request :
                    <?php
                        $programarea_id=0;
                        if(isset($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"])){
                            $programarea_id=$_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"];
                        }
                        $p=new programareas();
                        if($p->get_new_payment_requests($programarea_id)){
                            echo "<select id='requestId'>";
                            echo "<option value='0'>--select--</option>";
                            while($row=$p->fetch()){
                                echo "<option value='{$row['payment_request_id']}'>{$row['code']}</option>";
                            }
                            echo "<select>";
                        }
                    ?>
                
                    <span class="hotspot" onclick="newSearch(3)">get</span> | 
                    <span class="hotspot" onclick="addToPayment()">add </span> |
                    <span class="hotspot" onclick="removeFromPayment()">remove</span> |
                    <span class="hotspot" onclick="newSearch(1)">paid for</span> | 
                    <span class="hotspot" onclick="newSearch(2)">paid not for</span>
                   
                </div>
                &nbsp
                <div style="display:inline; background-color:#A0FF7A">
                    scholarship :
                    <select id="selectSchoarshipStatus">
                        <option value="1">active</option>
                        <option value="2">suspended</option>
                        <option value="3">ended</option>
                    </select> 
                    <span class="hotspot" onclick="getByScholarship(1)">get</span> |   
                    <span class="hotspot" onclick="getByScholarship(2)">ending on :</span>
                    <input type="text" id="txtEndingYear" value="2014" size="4">
                </div>
           
            </div>   
            
            <table width="100%">
                <td style="vertical-align: top">
                    <table width="100%">
                        <tr><td><span class="hotspot" onclick="prev()">prev</span> </td><td width="80%"><td><span class="hotspot" onclick="next()">next</span></td></tr>
                     </table>
                       
                    <table id="tableStudents" style="width:100%">
                        <tr class="default_report_title">
                            <td></td>
                            <td>PU</td>
                            <td>Year</td>
                            <td>Community</td>
                            <td>Name</td>
                            <td>Gender</td>
                            <td>Birth Date</td>
                            <td>Telephone</td>
                            <td>School</td>
                            <td>Grant</td>
                            <td></td>
                        </tr>
                    </table>
                  
                </td>
                <td  style="vertical-align: top;background-color: #ededd3">
                    <div id="divLeftPane" style="width:100%;vertical-align: top;background-color: #ededd3;display:none">
                        <div><span class="hotspot" onclick="cancel()">close</span>
                            | <span class="hotspot" onclick="getStudentPerformance()()">performance</span>
                                | <span class="hotspot" onclick="updateRecord()">update</span>
                                      | <span class="hotspot" onclick="getStudentAttendanceAndScholarship()">Attendance</span>
                              | <span class="hotspot" onclick="getStudentPayment()">payments</span>
                              
                        </div>
                        <div id="divViewUpdate" style="background-color: #ededd3; display: none; position: relative" >
                            <table>
                                <tr><td class="label">Last Name :</td><td><input type="text" id="lastname"></td></tr>
                                <tr><td class="label">First Name :</td><td><input type="text" id="firstname"></td></tr>
                                <tr><td class="label">Middle Name :</td><td><input type="text" id="middlename"></td></tr>
                                <tr><td class="label">District :</td><td>
                                    <select id="selectDistrictForCommunity" onchange="getCommunity(-1)">
                                        <option value="0"  selected>--select district--</option>
                                        <?php
                                            include_once("ext/programarea.php");
                                            $p=new programareas();
                                            if(!$p->get_districts()){

                                            }else{
                                                $row=$p->fetch();
                                                while($row){
                                                    echo "<option value='{$row['DistrictID']}' >{$row['District']}</option>";
                                                    $row=$p->fetch();
                                                }
                                            }
                                        ?>
                                    </select>    
                                    </td></tr>
                                <tr><td class="label">Community</td>
                                    <td>
                                        <select id="community">
                                            <option value="0">--select--</option>
                                        </select></td></tr>

                                <tr><td class="label">Date Birth</td>
                                    <td>
                                        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
                                        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
                                        <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
                                        <script>
                                            $(function() {
                                              $( "#birthdate" ).datepicker({
                                                    changeMonth: true,
                                                    changeYear: true,
                                                    minDate: "-25Y",
                                                    maxDate: "-1Y",
                                                    dateFormat: "dd/mm/yy"
                                                  });
                                            });
                                        </script>
                                        <input type="text" id="birthdate">
                                    </td>
                                </tr>
                                <tr><td class="label">Gender</td>
                                    <td>
                                        <select id="gender" >
                                            <option value="0">select</option>
                                            <option value="M">male</option>
                                            <option value="F">female</option>
                                        </select>
                                        </td></tr>
                                <tr><td class="label">Telephone 1</td><td><input type="text" id="telephone1" size="40"></td></tr>
                                <tr><td class="label">Telephone 2</td><td><input type="text" id="telephone2" size="40"></td></tr>
                                <tr><td rowspan="2"><span class="hotspot" onclicK="clean()" >clean</span> | <span class="hotspot" onclick="saveUpdate()">save</span> | <span class="hotspot" onclicK="cancel()" >cancel</span></td></tr>
                            </table>

                        </div>
                        
                        <div id="divAttendance" style="background-color: #ededd3;display: none;position:relative" >
                            School:
                            <table id="tableAttendance" style="width:100%;border-collapse:collapse;border:1" >
                                <tr class="default_report_title">
                                    <td>Start</td><td>End</td><td>Program</td><td>TYPE</td><td>School</td>
                                </tr>
                            </table>
                            <span onclick="showConfirmPopup()" class="hotspot" style="visibility: hidden" id="spanAttendanceNoRecord"></span>
                            <span onclick="closePopups()" class="hotspot">close</span> 
                            <?php include "ext/studentlist_add_school_attendance.php" ?>
                            Scholarship:
                            <table id="tableScholarshipPackage" style="width:100%;border-collapse:collapse;border:1" >
                                <tr class="default_report_title">
                                    <td>Start</td><td>End Date</td><td>Status</td><td>Type</td><td>Amount</td>
                                </tr>
                            </table>
                            
                        </div>
                        <div id="divPayment" style="background-color: #ededd3;display: none;position:relative" >
                            <table id="tablePayment" style="width:100%;border-collapse:collapse;border:1" >
                                <tr class="default_report_title">
                                    <td>Date</td><td>Status</td><td>Amount</td><td>School</td>
                                </tr>
                            </table>
                            <div>
                                   <span onclick="addToPaymentSingle()" class="hotspot" >add to payment</span>                          

                            </div>
                            <span onclick="closePopups()" class="hotspot">close</span> 

                        </div>
                        <div id="divPerformance" style="background-color:#ededd3; display: none;position:relative"">
                             <table id="tablePerformance" style="width:100%;border-collapse:collapse; border-width:1" >
                                <tr class="default_report_title">
                                    <td>Year</td><td>Class</td><td>Promoted</td><td>Math</td><td>Eng</td>
                                </tr>
                            </table>
                            <?php
                                  include_once 'ext/applicants.php';
                                  $a=new applicants();
                                  $year=$a->get_grade_record_year();
                                  if($year){
                            ?>
                            <span class="default_status">Record Performance</span>
                             <table>
                                 <tr>
                                     <td class="label">Academic Year:</td>
                                     <td><?php echo $year ?> </td>
                                 </tr>
                                 <tr>
                                     <td class="label">Math:</td>
                                     <td><input id="txtMath" type="text" > </td>
                                 </tr>
                                 <tr>
                                     <td class="label">English:</td>
                                     <td><input id="txtEng" type="text" > </td>
                                 </tr>
                                 <tr>
                                     <td colspan="2">
                                         <span class="hotspot" onclick="recordPerformance(1)">promoted</span> 
                                         <span class="hotspot" onclick="recordPerformance(0)">not promoted</span>
                                     </td>
                                 </tr>
                            </table> 
                                  <?php } ?>
                        </div>
                        
                    </div>
                    
                </td>
                    
            </table>
        </div>
        
        
        <script> newSearch();  </script>
    </body>
    
</html>

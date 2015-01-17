<?php
session_start(); // Initialize Session data
if(!isset($_SESSION["PlanGhana"]["PROGRAM_AREA"])){
    header("location: login.php");
    exit();
}
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
<?php
    include_once("ext/const.php");
    $userlevel=  get_user_level();
    if($userlevel!=USER_LEVEL_ADMIN and $userlevel!=USER_LEVEL_LEARNING_ADVISOR 
            and $userlevel!=USER_LEVEL_PUOFFICER and $userlevel!=USER_LEVEL_DATA_ENTRY){
        echo "</body></html>";
        exit();
    }
?>

        <link href="ext/style.css" rel="stylesheet">
        <script type="text/javascript" src="ext/jquery-1.11.0.js"></script>
        <script type="text/javascript" src="ext/gen.js"></script>
        <script type="text/javascript">
            var page=1;
            var recCount=0;
            var searchType=0;
            var applicants=null;
            
            function next(){
                cancel();
                if(recCount==0){
                    return;
                }
                var nopages= (recCount/25);
                if(page>nopages){
                    return;
                }
                page=page+1;
                getApplicants();
                 
                   
            }
            
            function prev(){
                cancel();
                if(page==1){
                    return;
                }
                page=page-1;
                getApplicants();
                
            }
            
            function newSearch(searchType){
                cancel();
                page=1;
                recCount=0;
                if(searchType==1){
                    getApplicants();  //paid for
                }else if(searchType==2){
                    getPaidForStudents(0);  //not paid for
                }else if(searchType==3){
                    getStudentsInPaymentRequest();
                }else if(searchType==5){
                    getScholarshipEndingStudents();
                }else{ 
                    getApplicants();
                }
            }

            var currentIndex=-1;
            var currentStudentId=0;
            var currentTableRow=null;
            var currentColor="";
            var objDisplayRow=null;
            var displayIndex=-1;
                        
            function openRecord(obj,index,id){
                if(applicants==null){
                    return;
                }
       
                cancel();
                currentIndex=index;
                currentStudentId=id;
                currentTableRow=obj.parentNode.parentNode;
                currentColor=currentTableRow.style.backgroundColor;
                currentTableRow.style.backgroundColor="yellow";
                
                n=currentTableRow.rowIndex+1;
                objRow=tableApplicnats.insertRow(n);
                c=objRow.insertCell(0);
                c.colSpan=13;
                c.appendChild(document.getElementById("divLeftPane"));
                
                //if there was a previous display row remove it first
                if(objDisplayRow!=null){
                    tableApplicnats.deleteRow(objDisplayRow.rowIndex);
                }
                //the new row is saved as display row
                objDisplayRow=objRow;
                showStatus("record open");
                divLeftPane.style.display="block";
                
                //load applicants data for updating
                
                
                if(applicants[currentIndex].app_status==1){
                    document.getElementById("divViewUpdateForm").style.display="none";
                    document.getElementById("divConfirmPopup").style.display="block";
                    loadDataForConfirmation();
                    
                }else{
                    document.getElementById("divViewUpdateForm").style.display="block";
                    document.getElementById("divConfirmPopup").style.display="none";
                    loadRecordForUpdate();
                }
                
            }
           
            function cancel(){
                var objPane=document.getElementById("divLeftPane");
                if(objPane==null){
                    return;
                }
                objPane.style.display="none";
                if(currentStudentId==0){
                    return;
                }
                document.body.appendChild(document.getElementById("divLeftPane"));
                if(objDisplayRow!=null){
                    tableApplicnats.deleteRow(objDisplayRow.rowIndex);
                }
                objDisplayRow=null;
                currentStudentId=0;
                currentIndex=0;
                if(currentTableRow!=null){
                    currentTableRow.style.backgroundColor=currentColor;
                    currentTableRow=null;
                }
                
                if(theFormIsLoaded){
                    clear();
                    theFormIsLoaded=false;
                }
                
            }
            
           
            
            
            
        </script>
        <script src="ext/applicants.js"></script>
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
                                    $year=$app->get_admission_year();
                                    echo $year;
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
                                            if($row['app_year']==$year){
                                                $selected="selected";
                                            }
                                            
                                            echo "<option value=\"{$row['app_year']}\" $selected>{$row['app_year']}</option>";
                                            $row=$app->fetch();
                                        }
                                    }
                                    ?>
                                </select>
                    <div style="display:inline; background-color:#A0FF7A">
                                scholarship :
                                <select id="selectApplicantStatus">
                                    <option value="0">all</option>
                                    <option value="1" selected>new</option>
                                    <option value="2">awarded</option>
                                    <option value="3">confirmed</option>
                                </select> 
                               
                    </div>
                    &nbsp;<input type="text" value="" id="txtSearch" >
                <span class="hotspot" onclick="newSearch(0)">search</span> |
                <span class="hotspot" onclick="exportApplicants()">export</span> |
                <div  style="display:inline; background-color:#FFA07A">
                    <?php

                        include_once("ext/grants.php");
                        $g=new grants();

                        if($g->get_grants()){
                            echo "Grants <select id='grant'>";
                            echo "<option value='0'>select grant</option>";
                            $row_grant=$g->fetch();
                            $str_amount="";
                            while($row_grant){
                                echo "<option value='{$row_grant['grant_package_id']}' >{$row_grant['name']} GHc {$row_grant['annual_amount']}</option>";
                                //$str_amount.="{$row_grant['annual_amount']},";
                                $row_grant=$g->fetch();

                            }
                            echo "</select>";
                            echo "<script>var grant_amount_list=new Array( {$str_amount} 0);</script>";
                        }
                        else
                        {
                            echo "error getting list of grants {$g->error}";
                        }
                   ?>
                </div>
                <span class="hotspot" onclick="awardGrant()" >award</span> |
                <span class="hotspot" onclick="cancelGrant()" >cancel</span> |
                <a href="application.php" >new applicant</a>
                <?php
                    if($userlevel==USER_LEVEL_ADMIN or $userlevel==USER_LEVEL_LEARNING_ADVISOR 
                        or $userlevel==USER_LEVEL_PUOFFICER ){
                            echo " | <span class='hotspot' onclick='refereshApplicationPoint()' >refresh app points</a>";
                    }
                ?>
            </div>
            
            <table width="100%">
                <td style="vertical-align: top">
                    <table width="100%">
                        <tr><td><span class="hotspot" onclick="prev()">prev</span> </td><td width="80%"><td><span class="hotspot" onclick="next()">next</span></td></tr>
                     </table>
                       
                    <table id="tableApplicnats" style="width:100%">
                        <tr class="default_report_title">
                            <td></td>
                            <td>PU</td>
                            <td>Year</td>
                            <td>Community</td>
                            <td>Name</td>
                            <td>Gender</td>
                            <td>Birth Date</td>
                            <td>Telephone</td>
                            <td>School Applied To</td>
                            <td>Status</td>
                            <td><span class="hotspot" onclick="setSort(1)">Point</span></td>
                            <td>Grant</td>
                            <td></td>
                        </tr>
                    </table>
                  
                </td>
                
                    
            </table>
        </div>
        
        
        <script> newSearch(1);  </script>
        <div id="divLeftPane" style="width:100%;vertical-align: top;background-color: #ededd3;display:none">
            <div id="divViewUpdateForm">
                <div>
                    <span class="hotspot" style="font-size:10pt" onclick="cancel();">close</span> | 
                    <span class="hotspot" style="font-size:10pt" onclick="editApplicant();">edit</span> |
                    <span class="hotspot" style="font-size:10pt" onclick="deleteApplicant();">delete</span>
                </div>
                <form id="formApplicant">
            
                <?php
                
                    include_once("ext/programarea.php");
                    if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]==0){
                    
                        echo "Program Area/Unit :<select name='uprogramarea_id' id='uprogramarea_id' >";
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
                        echo "<input type='hidden' name='uprogramarea_id' id='uprogramarea_id' value='$programarea_id' >";
                        $p=new programareas();
                        $row=$p->get_programarea($programarea_id);
                        if(!$row){
                                echo "Could not display programarea name.";
                        }else{
                                echo "Program Area : {$row["programarea_name"]} ";
                        }
                        
                    }
                
?>
              
                <table class="ewTable">
                    <tr>
                        <td class="ewTableHeader">Community: </td>
                                <td colspan="4">
                                    <select style="width:1.5in" id="selectFilterDistrict" title="filter communites by district" onchange="districtChanged()">
                                        <option value="0">--select--</option>
                                        <?php
                                            if($programarea_id!=0)
                                            $p=new programareas();
                                            $p->get_districts($programarea_id);
                                            while($row=$p->fetch()){
                                                echo "<opton value='{$row['DistrictID']}'>{$row['District']}</option>";
                                            }
                                        ?>        
                                    </select>
                                    <select id="selectCommunity" name="selectCommunity">
                                        <option value="0">--select --</option>
                                    </select>

                                </td>

                    </tr>
                    <tr>
                        <td class="ewTableHeader">Last Name</td><td><input type="text" id="txtLastname" name="txtLastname"> </td>
                        <td class="ewTableHeader">First Name</td><td><input type="text" id="txtFirstname" name="txtFirstname"> </td>
                        <td class="ewTableHeader">Middle Name</td><td><input type="text" id="txtMiddlename" name="txtMiddlename"> </td>
                    </tr>
                    <tr>
                        <td class="ewTableHeader">Gender</td>
                        <td>
                            <input type="radio" id="rGenderMale" name="rGender" value="M">Male
                            <input type="radio" id="rGenderFemale" name="rGender" value="F">Female
                        </td>
                        <td class="ewTableHeader">Birth Date</td>

                        <td>
                            <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
                            <script src="//code.jquery.com/jquery-1.10.2.js"></script>
                            <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
                            <input type="text" id="birthdate" name="birthdate">
                            <script>
                                $(function() {
                                  $( "#birthdate" ).datepicker({
                                        changeMonth: true,
                                        changeYear: true,
                                        minDate: "-35y",
                                        maxDate:"-1y",
                                        dateFormat: "dd/mm/yy",
                                        defaultDate:"-12Y"
                                      });
                                });
                            </script>

                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ewTableHeader">Mother Name</td><td><input type="text" id="txtMothername" name="txtMothername"> </td>
                        <td class="ewTableHeader">Is Alive ?</td>
                         <td>
                            <input type="radio" id="rMotherYes" name="rMother" value="1">Alive
                            <input type="radio" id="rMotherNo" name="rMother" value="0">Not Alive
                        </td>
                        <td class="ewTableHeader"> Occupation:</td>
                        <td> 
                            <select id="selectMotherOccupation">
                                <?php 
                                    include_once 'ext/occupation.php';
                                    $o=new occupation();
                                    $o->get_occupations();
                                    $row=$o->fetch();
                                    while($row){
                                        echo "<option value='{$row['application_occupation_id']}' >{$row['name']}</option>";
                                        $row=$o->fetch();
                                    }
                                ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="ewTableHeader">Father Name</td><td><input type="text" id="txtFathername" name="txtFathername"> </td>
                        <td class="ewTableHeader">Is Alive ?</td>
                         <td>
                            <input type="radio" id="rFatherYes" name="rFather" value="1">Alive
                            <input type="radio" id="rFatherNo" name="rFather" value="0">Not Alive
                        </td>
                        <td class="ewTableHeader"> Occupation:</td>
                        <td> 
                            <select id="selectFatherOccupation">
                                <?php 
                                    include_once 'ext/occupation.php';
                                    $o=new occupation();
                                    $o->get_occupations();
                                    $row=$o->fetch();
                                    while($row){
                                        echo "<option value='{$row['application_occupation_id']}' >{$row['name']}</option>";
                                        $row=$o->fetch();
                                    }
                                ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="ewTableHeader">Guardian Name</td><td><input type="text" id="txtGuardianName" name="txtGuardianName"> </td>
                        <td class="ewTableHeader">Relation </td>
                         <td>
                             <select id="selectGuardianRelation" name="selectGuardianRelation" title="">

                                 <option value="NA" selected="selected"> not applicable</option>
                                 <option value="grandparent"> grandparent</option>
                                 <option value="grandparent">grandparent</option>
                                 <option value="aunt">aunt</option>
                                 <option value="uncle">uncle</option>
                                 <option value="sibling">sibling</option>
                                 <option value="cousin">cousin</option>
                                 <option value="in law">in law</option>
                                 <option value="father family">father family</option>
                                 <option value="mother family">mother family</option>
                                 <option value="extended family">extended family</option>
                                 <option value="other relation">other relation</option>
                             </select>
                        </td>
                        <td class="ewTableHeader"> Occupation:</td>
                        <td> 
                            <select id="selectGuardianOccupation" name="selectGuardianOccupation">>
                                <?php 
                                    include_once 'ext/occupation.php';
                                    $o=new occupation();
                                    $o->get_occupations();
                                    $row=$o->fetch();
                                    while($row){
                                        echo "<option value='{$row['application_occupation_id']}' >{$row['name']}</option>";
                                        $row=$o->fetch();
                                    }
                                ?>

                            </select>
                        </td>
                    </tr> 
                    <tr>
                        <td class="ewTableHeader">Address</td>
                        <td>
                            <textarea id="taAddress" name="taAddress" rows="2"></textarea>
                        </td>
                        <td class="ewTableHeader">Telephone 1</td>
                        <td><input type="text" id="txtTelephone1" name="txtTelephone1" placeholder="02400000000"></td>
                        <td class="ewTableHeader">Telephone 2</td>
                        <td><input type="text" id="txtTelephone2" name="txtTelephone2" placeholder="02400000000"></td>
                    </tr>
                    <tr>
                         <td class="ewTableHeader"></td>
                         <td></td>
                        <td class="ewTableHeader">JSS</td>
                        <td>
                            <select id="selectJSS" name="selectJSS">
                                <option vlaue="0">--select--</option>
                                <?php
                                    include_once 'ext/school.php';
                                    $s=new school();
                                    $s->get_jss_schools();
                                    while($row=$s->fetch()){
                                        echo "<option value={$row['applicant_school_id']}>{$row['applicant_school_name']}</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td class="ewTableHeader">Aggregate Grade</td>
                        <td><input type="text" id="txtGrade" name="txtGrade" ></td>
                    </tr>
                    <tr>
                        <td class="ewTableHeader">Referee</td>
                        <td>
                            <input type="text" id="txtRefereeName" name="txtRefereeName" >
                        </td>

                        <td class="ewTableHeader">School Admitted To:</td>
                        <td>
                            <select id="selectSchool" name="selectSchool">
                                <option vlaue="0">--select--</option>
                                <?php
                                    include_once 'ext/school.php';
                                    $s=new school();
                                    $s->get_schools();
                                    while($row=$s->fetch()){
                                        echo "<option value={$row['school_id']}>{$row['school_name']}</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td class="ewTableHeader">Sponsored Child No:</td>
                        <td>
                            <input type="text" id="txtSponsored" name="txtSponsored" >
                            <span id="spanValidateSpnsoredChildResult"></span>
                            <span id="spanValidateSpnsoredChild" class="hotspot" onclick="">check</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="ewTableHeader">Prudential Staff?</td>
                        <td>
                            <input type="checkbox" id="cbPrudentialStaff" name="cbPrudentialStaff" onclick="prudentialStaffChecked()" value="1" >
                        </td>
                        <td class="ewTableHeader">Relation to Prudential Staff:</td>
                        <td>

                             <select id="selectPrudentialStaffRelation" name="selectPrudentialStaffRelation" title="" disabled="true">
                                 <option value="NA" selected="selected">not applicable</option>
                                 <option value="parent">parent</option>
                                 <option value="sibling">sibling</option>
                                 <option value="closefamily">close family</option>
                                 <option value="extended family">extended family</option>
                                 <option value="sponsor">sponsor</option>
                                 <option value="other relation">other relation</option>
                             </select>

                        </td>
                        <td class="ewTableHeader"></td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td class="ewTableHeader"></td>
                        <td></td>
                        <td class="ewTableHeader"></td>
                        <td> <input type="button" value="save" onclick="saveUpdate()"></td>
                        <td class="ewTableHeader"></td>
                        <td></td>
                    </tr>
                </table>
                </form>
            </div> 
            <div id="divConfirmPopup" style="display: none; position: relative">
                <div>
                    <span class="hotspot" style="font-size:10pt" onclick="cancel();">close</span> | 
                    <span class="hotspot" onclick="confirmScholarship()" style="color:blue; text-decoration:underline;cursor:pointer">confirm</span>
                </div>
                
                <table>
                    <tr>
                        <td class="ewTableHeader">School :</td>
                        <td>
                         <?php
                        include_once("ext/school.php");
                        $s=new school();
                        if($s->get_schools()){
                            echo "<select name='confirm_admitted_school_id' id='confirm_admitted_school_id'>";
                            echo "<option value='0'>select</option>";
                            $row=$s->fetch();
                            while($row){
                                echo "<option value='{$row['school_id']}' $selected >{$row['school_name']}</option>";
                                $row=$s->fetch();
                            }
                            echo "</select>";
                         }
                         else{
                             echo $s->error;
                         }


                        ?>
                   </td>
                    </tr>
                    <tr>
                        <td class="ewTableHeader">entry level :</td>
                        <td>
                            <select id="entry_level">
                                <option value="0">select school level</option>
                                <option value="1">SSS</option>
                                <option value="2">Tertiary</option>
                                <option value="3">JSS</option>
                                <option value="4">PRIMARY</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="ewTableHeader">Entry Class :</td>
                        <td>

                            <select id="entry_class">
                                    <option value="1" >1</option>
                                    <option value="2" >2</option>
                                    <option value="3" >3</option>
                                    <option value="4" >4</option>
                                    <option value="5" >5</option>
                                    <option value="6" >6</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="ewTableHeader">program :</td>
                        <td>
                            <select id="program">
                                <option value="0">select program</option>
                                <option value="BA">business</option>
                                <option value="SCI">science</option>
                                <option value="ART">arts</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="ewTableHeader">Attendance</td>
                        <td>

                            <select id="attendance">
                                <option value="0">select attendance</option>
                                <option value="1">boarding</option>
                                <option value="2">day</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td class="ewTableHeader"></td>
                        <td>
                            01/09/<select id="school_start_date">
                                <?php
                                    $y=date("Y");
                                    for($i=-4; $i<=5; $i++){
                                        $x=$y+$i;
                                        if($i==0){
                                            $selected="selected";
                                        }else{
                                            $selected="";
                                        }

                                        echo "<option $selected value='$x'>$x<option>";
                                    }
                                ?>
                            </select>
                            to
                            30/08/<select id="school_end_date">
                                <?php
                                    $y=date("Y");
                                    for($i=-4; $i<=5; $i++){
                                        $x=$y+$i;
                                        if($i==4){
                                            $selected="selected";
                                        }else{
                                            $selected="";
                                        }

                                        echo "<option $selected value='$x'>$x<option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="ewTableHeader" >
                           Scholarship Period :
                        </td>
                        <td>
                            01/09/<select id="scholarship_start_date">
                                <?php
                                    $y=date("Y");
                                    for($i=-4; $i<=5; $i++){
                                        $x=$y+$i;
                                        if($i==0){
                                            $selected="selected";
                                        }else{
                                            $selected="";
                                        }

                                        echo "<option $selected value='$x'>$x<option>";
                                    }
                                ?>
                            </select>
                            to
                            30/08/<select id="scholarship_end_date">
                                <?php
                                    $y=date("Y");
                                    for($i=-4; $i<=5; $i++){
                                        $x=$y+$i;
                                        if($i==4){
                                            $selected="selected";
                                        }else{
                                            $selected="";
                                        }

                                        echo "<option $selected value='$x'>$x<option>";
                                    }
                                ?>
                            </select>

                        </td>
                    </tr>
                </table>
                <div>
                    <span class="hotspot" onclick="confirmScholarship()" style="color:blue; text-decoration:underline;cursor:pointer">confirm</span>
                </div>
            </div>
        </div>

        <?php
    echo "<script type='text/javascript'>";
            include_once("ext/programarea.php");
            $p=new programareas();
            if($p->get_districts()){

                echo "districts=eval('[";
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
            }
            echo "]');";
    echo "</script>";
?>
    </body>
    
</html>

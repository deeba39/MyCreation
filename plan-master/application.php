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
    include_once "ext/applicants.php";
    $app=new applicants();
    $year=$app->get_admission_year();
    if(!$year){
        echo "addmission is not open";
        echo "</body></html>";
        exit();
    }
?>

        
        <link href="ext/style.css" rel="stylesheet">
        <script type="text/javascript" src="ext/jquery-1.11.0.js"></script>
        <script type="text/javascript" src="ext/gen.js"></script>
        <script type="text/javascript"></script>
        <script type="text/javascript" src="ext/applicants.js"></script>
        <div id="divStatus" class="default_status">
        </div>
                
        <div >
            <div>
                <?php
                
                include_once("ext/programarea.php");
                if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]==0){
                    
                    echo "<b>Program Area/Unit :</b><select name='programarea_id' id='programarea_id' onchange='onProgramAreaChanged()'>";
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
                        echo "<input type='hidden' name='programarea_id' id='programarea_id' value='$programarea_id' >";
                        $p=new programareas();
                        $row=$p->get_programarea($programarea_id);
                        if(!$row){
                                echo "Could not display programarea name.";
                        }else{
                                echo "<b>Program Area :</b> {$row["programarea_name"]} ";
                        }
                        
                }
                
?>
                    <b>Application Year :</b> <?php echo $year?> 
 
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

    
            <form>
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
                                            echo "<option value='{$row['DistrictID']}'>{$row['District']}</option>";
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
                        <input type="text" id="birthdate" name="birthdate">
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
                        
                        <span class="hotspot" onclick="addSchool(2)">add school</span>
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
                        
                        <span class="hotspot" onclick="addSSSchool()">add school</span>
                    </td>
                    <td class="ewTableHeader">Sponsored Child No:</td>
                    <td>
                        <input type="text" id="txtSponsored" name="txtSponsored" >
                        <span id="spanValidateSpnsoredChildResult"></span>
                        <span id="spanValidateSpnsoredChild" class="hotspot" onclick="checkSponsoredChild()">check</span>
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
                    <td> <input type="button" value="submit" onclick="saveNewApplicant()"></td>
                    <td class="ewTableHeader"></td>
                    <td></td>
                </tr>
            </table>
            </form>
            <div id="divAddSchool" style="visibility: hidden;position: absolute; background-color: #2647A0; color: white">

                School Name:<br/>
                <input type="text" size="30" id="txtSchoolName">
                <br/>
                School Type:<br/>
                <select id="selectSchoolCategory">
                            <option value="2" >public</option>
                            <option value="1">private</option>
                    </select>
                <br/>
                <input type="hidden" id="hiddenSchoolType" >
                <center>
                            <span onclick="completeAddingSchool()" style="text-decoration:underline;cursor:pointer">add</span>
                            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                            <span onclick="hideAddSchool()" style="text-decoration:underline;cursor:pointer">cancel</span>
                    </center>	

            </div>
            <div id="divAddSSSchool" style="visibility: hidden;position: absolute; background-color: #2647A0; color: white">

                School Name:<br/>
                <input type="text" size="30" id="txtSSSchoolName">
                <br/>
                School Address:<br/>
                <input type="text" size="30" id="txtSSSAddress"><br/>
                    School Town/City:<br/>
                <input type="text" size="30" id="txtSSSTown"><br/>
                    <select id="selectSSSProgramArea">
                            <option value="1">Central</option>
                            <option value="2">Eastern</option>
                            <option value="3">Mankessim</option>
                            <option value="4">Volta</option>
                            <option value="5">Wa</option>
                            <option value="6">Upper West</option>
                            <option value="8">Prudential</option>
                    </select>
                <br/>
                <input type="hidden" id="hiddenSchoolType" value="3">
                <center>
                            <span onclick="completeAddingSSSchool()" style="text-decoration:underline;cursor:pointer">add</span>
                            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                            <span onclick="hideAddSSSchool()" style="text-decoration:underline;cursor:pointer">cancel</span>
                    </center>	

            </div>
    </body>
    
</html>
            
  
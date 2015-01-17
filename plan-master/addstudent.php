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
<?php
$Security = new cAdvancedSecurity();
if (!$Security->IsLoggedIn()) {
        header("Location: login.php" );
}
?>
<?php include "header.php" ?>




        <link rel="stylesheet" href="ext/style.css">
        <script type="text/javascript">
                var districts;
        </script>
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
        <script type="text/javascript">
            function sendGETRequest(theUrl) {

                var request = new XMLHttpRequest();
                try {

                    request.open("GET", theUrl, false);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send();

                    if (request.status != 200) {
                        return { "result": 0, "message": request.statusText };
                    }
                    //alert(request.responseText);
                    return eval('('+request.responseText+ ')');
                } catch (ex) {
                    return { "result": 0, "message": ex };
                }
            }
            function onDistrictChange(){
                getCommunity();
            }
            function getCommunity(){
                 var objDistrict=document.getElementById("district");
                if(objDistrict==null){
                    return;
                }
                if(objDistrict.value==0){
                    return;
                }
                
             

                var theUrl="ext/ajax.php?cmd=2&district_id="+objDistrict.value;
                var obj=sendGETRequest(theUrl);
                if(obj.result==0){
                    return;
                }
                var objCommunity=document.getElementById("community");
                if(objCommunity==null){
                    return;
                }
                clearCommunity();
                var objNewOption;
                for(i=0;i<obj.communites.length;i++){
                    objNewOption=document.createElement("OPTION");
                    objNewOption.value=obj.communites[i].communityID;
                    objNewOption.text=obj.communites[i].community;
                    objCommunity.options.add(objNewOption);

                }
                    
            }
            function clearCommunity(){
                var objCommunity=document.getElementById("community");
                if(objCommunity==null){
                    return;
                }

                while(objCommunity.options.length>0){
                    objCommunity.options.remove();
                }
                var objNewOption=document.createElement("OPTION");
                objNewOption.value="0";
                objNewOption.text="--select--";
                objCommunity.options.add(objNewOption);

            }
            function getDistrict(){
                var obj=document.getElementById("programarea");
                if(obj==null){
                    return;
                }
                var pid=obj.value;
                if(pid==0){
                    return;
                }

                var objDistrict=document.getElementById("district");
                if(objDistrict==null){
                    return;
                }
                clearDistrict();
                var objNewOption;
                for(i=0;i<districts.length;i++){
                    if(districts[i].programarea_id==pid){
                        objNewOption=document.createElement("OPTION");
                        objNewOption.value=districts[i].districtID;
                        objNewOption.text=districts[i].district;
                        objDistrict.options.add(objNewOption);
                    }
                }

            }
            function clearDistrict(){
                var objDistrict=document.getElementById("district");
                if(objDistrict==null){
                    return;
                }

                while(objDistrict.options.length>0){
                    objDistrict.options.remove();
                }
                var objNewOption=document.createElement("OPTION");
                objNewOption.value="0";
                objNewOption.text="--select--";
                objDistrict.options.add(objNewOption);
            }
            function onProgramareaChange(){
                var obj=document.getElementById("district");
                if(obj==null){
                    return;
                }
               getDistrict();

            }
            function onBirthdateYearChanged(){
                
                
               var objBYear=document.getElementById("byear");
               var varBYear=objBYear.value;
               if(varBYear.length==0){
                   objBYear.style.backgroundColor="red";
                   return;
               }
               if(varBYear<1980 || varBYear>2000){
                    objBYear.style.backgroundColor="red";
                }else{
                    objBYear.style.backgroundColor="transparent";
                }
                
            }
            function sendPOSTRequest(theUrl, data) {

                request = new XMLHttpRequest();
                try {

                    request.open("POST", theUrl, false);
                    data = encodeURI(data);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.setRequestHeader("Content-length", data.length);
                    request.setRequestHeader("Connection", "close");
                    request.send(data);

                    if (request.status != 200) {
                        return { "result": 0, "error": request.statusText };
                    }

                    return eval('(' + request.responseText + ')');
                } catch (ex) {
                    return { "result": 0, "error": ex };
                }
            }
            function onSubmit(){
                var varFirstname=document.getElementById("firstname").value;
                var varLastname=document.getElementById("lastname").value;
                var varBDay=document.getElementById("bday").value;
                var varBMonth=document.getElementById("bmonth").value;
                var varBYear=document.getElementById("byear").value;
                var varGender=document.getElementById("gender").value;
                var varStartyear=document.getElementById("startyear").value;
                var varEndyear=document.getElementById("endyear").value;
                var varEntrylevel=document.getElementById("entrylevel").value;
                var varCurrentlevel=document.getElementById("currentlevel").value;
                var varProgramarea=document.getElementById("programarea").value;
                var varDistrict=document.getElementById("district").value;
                var varCommunity=document.getElementById("community").value;
                var varJss=document.getElementById("jss").value;
                var varSchool=document.getElementById("school").value;
                var varProgram=document.getElementById("program").value;
                var varAttendanceType=document.getElementById("attendanceType").value;
                var varGrant=document.getElementById("grant").value;

                var error=true;
                error=error && checkSelection(varFirstname.length,spanFirstname);
                error=error && checkSelection(varLastname.length,spanLastname);
                error=error && checkSelection(varGender,spanGender);
                error=error && checkSelection(varStartyear,spanStartyear);
                error=error && checkSelection(varEndyear,spanEndyear);
                error=error && checkSelection(varEntrylevel,spanEntrylevel);
                error=error && checkSelection(varCurrentlevel,spanCurrentlevel);
                error=error && checkSelection(varProgramarea,spanProgramarea);
                error=error && checkSelection(varDistrict,spanDistrict);
                error=error && checkSelection(varCommunity,spanCommunity);
                error=error && checkSelection(varJss,spanJss);
                error=error && checkSelection(varSchool,spanSchool);
                error=error && checkSelection(varProgram,spanProgram);
                error=error && checkSelection(varAttendanceType,spanAttendanceType);
                error=error && checkSelection(varGrant,spanGrant);

                if(varBDay==0 || varBMonth==0 || varBYear.length==0){
                    spanBirthdate.innerHTML="*";
                    spanBirthdate.style.color="RED";
                    error=false;
                }else{
                    spanBirthdate.innerHTML="";
                    error=error && true;
                }

               if(!error){
                   spanStatus.innerHTML="Please enter or select all required infromation.";
                   spanStatus.className="default_error";
                   return;
               }
                var varBirthdate=varBYear+"-"+varBMonth+"-"+varBDay;

              
                var u="ext/ajax.php?cmd=3&"+
                    "&firstname="+varFirstname+
                    "&lastname="+varLastname+
                    "&birthdate="+varBirthdate+
                    "&gender="+varGender+
                    "&startyear="+varStartyear+
                    "&endyear="+varEndyear+
                    "&entrylevel="+varEntrylevel+
                    "&currentlevel="+varCurrentlevel+
                    "&programarea="+varProgramarea+
                    "&district="+varDistrict+
                    "&community="+varCommunity+
                    "&jss="+varJss+
                    "&school="+varSchool+
                    "&programme="+varProgram+
                    "&attendancetype="+varAttendanceType+
                    "&grant="+varGrant;


                 
                 var r=sendGETRequest(u);
                 if(r.result==0){
                     spanStatus.innerHTML="Error while adding" + r.message;
                     return false;
                 }

                spanStatus.innerHTML=r.message;
                document.getElementById("firstname").value="";
                document.getElementById("lastname").value="";
                document.getElementById("bday").value="0";
                document.getElementById("bmonth").value="0";
                document.getElementById("byear").value="";
                document.getElementById("gender").value="0";
                document.getElementById("startyear").value="0";
                document.getElementById("endyear").value="0";
                document.getElementById("entrylevel").value="0";
                document.getElementById("currentlevel").value="0";
                


            }
            function checkSelection(val,obj){
                if(val==0){
                    obj.innerHTML="*";
                    obj.style.color="RED";
                    return false;
                }else{
                    obj.innerHTML="";
                    return true;
                }
            }
        </script>
    
        Add current sponsored student to database
        <div>
            <span id="spanStatus"></span>
        </div>
        <form method="POST"  action="action_addstudent.php">
            <table class="ewTable">
                <tr>
                    <td class="ewTableHeader" >
                        First name :
                    </td>
                    <td >
                        <input type="text" name="firstname" id="firstname" size="30"><span id="spanFirstname"></span>
                    </td>
                    <td class="ewTableHeader">
                        Last name :
                    </td>
                    <td>
                        <input type="text" name="lastname" id="lastname" size="30"><span id="spanLastname"></span>
                    </td>
                </tr>
                <tr>
                    <td class="ewTableHeader">
                        Birth date :
                    </td>
                    <td>
                        <select name="bday" id="bday">
                            <option value="0"></option>
                            <option value="01">1</option>
                            <option value="02">2</option>
                            <option value="03">3</option>
                            <option value="04">4</option>
                            <option value="05">5</option>
                            <option value="06">6</option>
                            <option value="07">7</option>
                            <option value="08">8</option>
                            <option value="09">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                            
                        </select>
                        <select name="bmonth" id="bmonth">
                            <option value="0"></option>
                            <option value="01">1</option>
                            <option value="02">2</option>
                            <option value="03">3</option>
                            <option value="04">4</option>
                            <option value="05">5</option>
                            <option value="06">6</option>
                            <option value="07">7</option>
                            <option value="08">8</option>
                            <option value="09">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                        <input type="text" name="byear" id="byear" size="4" onchange="onBirthdateYearChanged()" >
                        <span id="spanBirthdate"></span>
                    </td>
                    <td class="ewTableHeader">
                        Gender:
                    </td>
                    <td>
                        <select name="gender" id="gender">
                            <option value="0">--select--</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                        <span id="spanGender"></span>
                    </td>

                </tr>
                 <tr>
                    <td class="ewTableHeader">
                        Start Year :
                    </td>
                    <td>
                        <select id="startyear" name="startyear">
                            <option value="0">--select--</option>
                            <option value="2012">2012</option>
                            <option value="2011">2011</option>
                            <option value="2010">2010</option>
                            <option value="2009">2009</option>
                            <option value="2008">2008</option>
                            <option value="2007">2007</option>
                            <option value="2006">2006</option>
                            <option value="2005">2005</option>
                        </select>
                        <span id="spanStartyear"></span>
                    </td>
                    <td class="ewTableHeader">
                        End Year :
                    </td>
                    <td>
                        <select id="endyear" name="endyear">
                            <option value="0">--select--</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                            <option value="2014">2014</option>
                            <option value="2013">2013</option>
                            <option value="2012">2012</option>
                            <option value="2011">2011</option>
                            <option value="2010">2010</option>
                            <option value="2009">2009</option>
                        </select>
                        <span id="spanEndyear"></span>
                    </td>
                </tr>
                <tr>
                    <td class="ewTableHeader">
                        Entry Level  :
                    </td>
                    <td>
                        <select name="entrylevel" id="entrylevel">
                            <option value="0">--select--</option>
                            <option value="1">SSS</option>
                            <option value="2">TERTIARY</option>
                            <option value="3">JSS</option>
                            <option value="4">PRIMARY</option>
                        </select>
                        <span id="spanEntrylevel"></span>
                    </td>

                    <td class="ewTableHeader">
                        Current Level :
                    </td>
                    <td>
                        <select name="currentlevel" id="currentlevel">
                            <option value="0">--select--</option>
                            <option value="1">1</option>
                            <option vlaue="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                        <span id="spanCurrentlevel"></span>
                    </td>
                </tr>
                <tr>
                    <td class="ewTableHeader">
                        Programme Unit :
                    </td>
                    <td>
                        <?php
                            include_once("ext/programarea.php");
                            $p=new programareas();
                            if(!$p->get_programareas()){
                            }else{
                                echo "<select name='programarea' id='programarea' onchange='onProgramareaChange()'>";
                                    echo "<option value='0'>--select--</option>";
                                    $row=$p->fetch();
                                    while($row)
                                    {
                                        echo "<option value='{$row['programarea_id']}'>{$row['programarea_name']}</option>";
                                        $row=$p->fetch();
                                    }

                                echo "</select>";
                            }

                        ?>
                        <span id="spanProgramarea"></span>
                    </td>
                    <td class="ewTableHeader">
                        District
                    </td>
                    <td >
                        <select name="district" id="district" onchange="onDistrictChange()">
                            <option value="0">--select--</option>
                        </select>
                        <span id="spanDistrict"></span>
                    </td>
                </tr>
                <tr>
                    <td class="ewTableHeader">
                        Community
                    </td>
                    <td>
                        <select name="community" id="community">
                            <option value="0">--select--</option>
                        </select>
                        <span id="spanCommunity"></span>
                    </td>
                    <td>
                        
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td class="ewTableHeader" >JSS :</td>
                    <td>
                        <?php
                            include("ext/school.php");
                            $s=new school();
                            if(!$s->get_jss_schools()){
                                echo $s->error;
                            }else{
                                echo "<select id='jss'>";
                                    echo "<option value='0'>--select--</option>";
                                    $row=$s->fetch();
                                    while($row){
                                        echo "<option value='{$row['applicant_school_id']}'>{$row['applicant_school_name']}</option>";
                                        $row=$s->fetch();
                                    }
                                        
                                echo "</select>";
                            
                            }
                        ?>
                        <span id="spanJss"></span>
                    </td>

                    <td class="ewTableHeader">Current School :</td>
                    <td>
                        <?php
                            
                            $s=new school();
                            if(!$s->get_schools()){
                                
                            }else{
                                echo "<select id='school'>";
                                    echo "<option value='0'>--select--</option>";
                                    $row=$s->fetch();
                                    while($row){
                                        echo "<option value='{$row['school_id']}'>{$row['school_name']}</option>";
                                        $row=$s->fetch();
                                    }
                                        
                                echo "</select>";
                            
                            }
                        ?>
                        <span id="spanSchool"></span>
                    </td>
                </tr>
                <tr>
                    <td class="ewTableHeader">Academic Programme:</td>
                    <td>
                        <select name="program" id="program">
                            <option value="Science">--select--</option>
                            <option value="Science">Science</option>
                            <option value="Business">Business</option>
                            <option value="General Arts">General Arts</option>
                            <option value="Technical">Technical</option>
                            <option value="Agricaulture">Agriculture</option>
                            <option value="Home Economics">Home Economics</option>
                            <option value="Visual Arts">Visual Arts</option>
                        </select>
                        <span id="spanProgram"></span>
                    </td>
                    <td class="ewTableHeader">Attendance Type:</td>
                    <td>
                        <select name="attendaceType" id="attendanceType">
                            <option value="0">--select--</option>
                            <option value="BOARDING">boarding</option>
                            <option value="DAY">day</option>
                        </select>
                        <span id="spanAttendanceType"></span>
                    </td>
                </tr>
                <tr>
                    <td class="ewTableHeader">Grant :</td>
                    <td>
                        <?php
                            include_once("ext/grant.php");
                            $g=new grants();
                            if(!$g->get_grants()){
                                echo "error getting grants. {$g->error}";
                            }else{
                                echo "<select id='grant' >";

                                    echo "<option value='0'>--select--</option>";
                                    $row=$g->fetch();
                                    while($row)
                                    {
                                        echo "<option value='{$row['grant_package_id']}'>{$row['name']}</option>";
                                        $row=$g->fetch();
                                    }
                                echo "</select>";
                            }
                        ?>
                        <span id="spanGrant"></span>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="button" value="add" onclick="onSubmit()"></td>
                    <td></td>
                </tr>
            </table>
            
        </form>

   
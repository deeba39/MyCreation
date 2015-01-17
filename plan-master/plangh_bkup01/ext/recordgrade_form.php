<style>
    .hotspot
    {
        text-decoration: underline;
        color:blue;
        cursor:pointer;
    }
</style>
<script>
            var page = "ext/ajaxawardgrant.php";
            var objCurrentConfirmation;
            var currentAttendaceID=0;
            function showError(msg){
                spanStatus.innerText=msg;
                spanStatus.style.color="red";
            }
            function showStatus(msg){
                spanStatus.innerText=msg;
                spanStatus.style.color="black";
            }

            function sendGETRequest(theUrl) {

                var request = new XMLHttpRequest();
                try {

                    request.open("GET", theUrl, false);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.setRequestHeader("Connection", "close");
                    request.send();

                    if (request.status != 200) {
                        return { "result": 0, "message": request.statusText };
                    }
                    //alert(request.responseText);

                    return eval('('+request.responseText+ ')');
                    //return { "result": 0, "message": "OK" };
                } catch (ex) {
                    return { "result": 0, "message": ex };
                }
            }

            function startRecordGrade(obj,attendace_id){
                
                
                /*var objClass=document.getElementById("selClass");
                objClass.value=sclass;
                var objProgram=document.getElementById("selProgram");
                objProgram.value=program;
                var objDivGradePopup=document.getElementById("divGradePopup");
                //span.div.td.tr.tbody.table
                
                currentAttendaceID=attendace_id;

                
                objDivGradePopup.style.top=event.clientY;
                objDivGradePopup.style.left=event.clientX;

                objDivGradePopup.style.backgroundColor="#8D8D8D";
                objDivGradePopup.style.visibility="visible";
                objDivGradePopup=obj;
                currentAttendaceID=attendace_id;
                //showStatus("choose options and click ok");*/

            }
            function updatePromoted(obj,grade_year_id,promoted){
                
                


                spanStatus.innerText="";


                var u="ext/ajaxawardgrant.php?cmd=4&grade_year_id="+grade_year_id+"&promoted="+promoted;
                    
                    
                //spanStatus.innerText=u;


                var ru=sendGETRequest(u);
                if(ru.result==0){
                    showError("error:" + ru.message);
                    return 0;
                }

                showStatus(ru.message);
                if(promoted==1){
                    obj.parentNode.innerHTML="<span>passed </span>"+
                        " | <span class='hotspot' onclick='updatePromoted(this,"+grade_year_id+",0)'>update</span>";
                }else{
                    obj.parentNode.innerHTML="<span>failed</span>"+
                        " | <span class='hotspot' onclick='updatePromoted(this,"+grade_year_id+",0)'>update</span>";
                }
              
              
                currentAttendaceID=0;
                


            }

           function setPromoted(obj,attendance_id,academic_year,promoted){
               spanStatus.innerText="";


                var u="ext/ajaxawardgrant.php?cmd=5&attendance_id="+attendance_id+
                    "&academic_year="+academic_year+"&promoted="+promoted;


                //spanStatus.innerText=u;


                var ru=sendGETRequest(u);
                if(ru.result==0){
                    showError("error:" + ru.message);
                    return 0;
                }

                showStatus(ru.message);
                if(promoted==1){
                    obj.parentNode.innerHTML="<span>passed</span>";
                }else{
                    obj.parentNode.innerHTML="<span>failed</span>";
                }

                
           }
            function closePopup(){
                var objDivConfirmPopup=document.getElementById("divGradePopup");
                objDivConfirmPopup.style.visibility="hidden";
            }

</script>

<?php
include("ext/programarea.php");
echo '<form method="GET" action="view_sponsored_student_gradelist.php">';
    if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]==0){
    echo "<b>Program Area :</b><select id='programarea_id' name='programarea_id'>";
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

   echo '<input type="submit"  value="get applicants" >';
echo '</form>';
}else{
    echo "Program area:";
    echo $_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA_NAME"];
}


?>
<div id="divGradePopup" style="visibility:hidden; position: absolute">
class :<select id="selClass">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
</select>
<select id="selProgram">
    <option value="BA">business</option>
    <option value="SCI">science</option>
    <option value="ART">arts</option>
</select>
Pass :<select id="selPromote">
    <option value="1">PASS</option>
    <option value="0">FAIL</option>
</select>s
Aggregate/GPA <input type="text" id="txtGrade" value="">
</div>

<div>
    <span id="spanStatus"></span>
</div>
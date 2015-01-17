<style>
    .hotspot
    {
        text-decoration: underline;
        color:blue;
        cursor:pointer;
    }
</style>
<script>
			var acadamic_year=0;
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

            

           var currentObject;
           
           function cancelRecord(attendance_id,grade_year_id)
           {
           
               currentObject.innerHTML="<div class='hotspot' onclick='startRecording(this,"+attendance_id+","+ grade_year_id+ ")'>record</div>";
               /*currentObject.onclick=function (){
                   startRecording(currentObject,attendance_id,0)
               }
               currentObject.innerHTML="record";*/
              
           }

           function record(obj,promoted,attendance_id,grade_year_id)
           {
               RegExp()
               var m=document.getElementById("txtMath").value;
               var e=document.getElementById("txtEnglish").value;
               //var academic_year=2011;
			   
               
               if(grade_year_id==0){

                   var u="ext/ajaxawardgrant.php?cmd=5&attendance_id="+attendance_id+"&grade_year_id=0"+
                    "&academic_year="+academic_year+"&promoted="+promoted+"&math="+m+"&english="+e;
               }else{
                   var u="ext/ajaxawardgrant.php?cmd=5&attendance_id=0&grade_year_id="+grade_year_id+
                    "&academic_year="+academic_year+"&promoted="+promoted+"&math="+m+"&english="+e;
               }

                var ru=sendGETRequest(u);
                if(ru.result==0){
                    showError("error:" + ru.message);
                    return 0;
                }

                //showStatus("promoted");
                if(promoted==1){
                    obj.parentNode.innerHTML="<span>passed</span>"
                    +"<span class='hotspot' onclick='startRecording(this,"+attendance_id+","+ ru.grade_year.grade_year_id+ ")'>edit</span>";
                }else{
                    obj.parentNode.innerHTML="<span>failed</span>"
                    +"<span class='hotspot' onclick='startRecording(this,"+attendance_id+","+ ru.grade_year.grade_year_id+ ")'>edit</span>";
                }

                
                objClass=document.getElementById("divClass"+attendance_id);
                objClass.innerHTML=ru.grade_year.class;
                objYear=document.getElementById("divYear"+attendance_id);
                objYear.innerHTML=ru.grade_year.year;
                objProgramme=document.getElementById("divProgramme"+attendance_id);
                objProgramme.innerHTML=ru.grade_year.programme;
                objEnglish=document.getElementById("divEnglish"+attendance_id);
                objEnglish.innerHTML=ru.grade_year.english;
                objMath=document.getElementById("divMath"+attendance_id);
                objMath.innerHTML=ru.grade_year.math;;


           }
           function startRecording(obj,attendance_id,grade_year_id)
           {
               
               objEnglish=document.getElementById("divEnglish"+attendance_id);
               var e=objEnglish.innerHTML;
               objEnglish.innerHTML="<input type='text' value='"+e+"' size='4' id='txtEnglish'>";
               objMath=document.getElementById("divMath"+attendance_id);
               var m=objMath.innerHTML;
               objMath.innerHTML="<input type='text' value='"+m+"' size='4' id='txtMath'>";
               
               obj=obj.parentNode;
               obj.innerHTML="<div class='hotspot' onclick='record(this,1,"+attendance_id+","+grade_year_id+")'>promoted</div>" +
                               "<div class='hotspot' onclick='record(this,0,"+attendance_id+","+grade_year_id+")'>failed</div>" +
                               "<div class='hotspot' onclick='cancelRecord("+attendance_id+","+grade_year_id+")'>cancel</div>";
              
               
               currentObject=obj;
               document.getElementById("txtEnglish").focus();
               return;
           }
           
            

</script>

<?php
include("ext/programarea.php");

echo '<form method="GET" action="view_sponsored_student_gradelist.php">';
if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]==0){
    /*echo "<b>Program Area :</b><select id='programarea_id' name='programarea_id'>";
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
   $pid="programarea_id=$programarea_id&";
echo '</form>';*/
}else{
    echo "Program area:";
    echo $_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA_NAME"];
    $pid="";
}


?>



<div>
    <span id="spanStatus"></span>
</div>
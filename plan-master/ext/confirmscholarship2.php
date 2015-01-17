<?php
include_once("const.php");
?>

        <script>
            var page = "ext/ajaxawardgrant.php";
            var objCurrentConfirmation;
            var currentStudentID=0;
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
           function startConfirm(obj,student_id,nschool_id){
                var asid=document.getElementById("admitted_school_id");
                asid.value=nschool_id;
                var objDivConfirmPopup=document.getElementById("divConfirmPopup");
                //span.div.td.tr.tbody.table
                var objCurRow=obj.parentNode.parentNode.parentNode;
                var objTable=obj.parentNode.parentNode.parentNode.parentNode.parentNode;

                //objTable.moveRow(trConfirm.rowIndex,objCurRow.rowIndex);
                objDivConfirmPopup.style.top=event.clientY-(tableLayout2.offsetTop+100);
                objDivConfirmPopup.style.backgroundColor="#8D8D8D";

                objCurrentConfirmation=obj;
                currentStudentID=student_id;
                 showStatus("choose options and click ok");

            }
            function confirmScolarship(){
                
                if(currentStudentID==0){
					return;
				}
				
				
                spanStatus.innerText="";

                var s=document.getElementById("admitted_school_id").value;
                var ssd=document.getElementById("school_start_date").value+"-09-01";
                var sed=document.getElementById("school_end_date").value+"-08-31";
                var sd=document.getElementById("scholarship_start_date").value+"-09-01";
                var ed=document.getElementById("scholarship_end_date").value+"-08-31";
                var ec=document.getElementById("entry_class").value;
                var el=document.getElementById("entry_level").value;
                var pm=document.getElementById("program").value;
                var at=document.getElementById("attendance").value;
          
                
                if(s==0){
                    showError("please select school");
                    return 0;
                }

                if(pm==0){
                    showError("please select program");
                    return 0;
                }

                if(at==0){
                    showError("please select attendance type(boarding/day)");
                    return 0;
                }

                if(el==0){
                    showError("please select entry level");
                    return 0;
                }

                if(ec==0){
                    showError("please select entry class");
                    return 0;
                }
 
                var u="ext/ajaxawardgrant.php?cmd=3&student_applicant_id="+currentStudentID+"&school_id="+s+"&school_start_date="+ssd+"&school_end_date="+sed+"&scholarship_start_date="
                    +sd+"&scholarship_end_date="+ed+"&entry_level="+el+"&entry_class="+ec+"&program="+pm+"&attendance="+at;
                              
                var ru=sendGETRequest(u);
                if(ru.result==0){
                    showError("error:" + ru.message);
                    return 0;
                }
                
                showStatus(ru.message);
                objCurrentConfirmation.parentNode.innerText="Confrimed";

                //reset
				var objDivConfirmPopup=document.getElementById("divConfirmPopup");
				objDivConfirmPopup.style.backgroundColor="#FFFFFF"
				currentStudentID=0;
                document.getElementById("entry_class").value=0;
                document.getElementById("entry_level").value=1;
                document.getElementById("program").value=0;
                document.getElementById("attendance").value=0;
                

            }
            
            function selectSchool(nschool_id){
                var obj=document.getElementById("admitted_school_id");
                obj.value=nschool_id;
            }

            function deselectSchool(nschool_id){
                var obj=document.getElementById("admitted_school_id");
                obj.selectedIndex=0;
            }
            function closePopup(){
                var objDivConfirmPopup=document.getElementById("divConfirmPopup");
                objDivConfirmPopup.style.visibility="hidden";
            }

</script>

 

<div id="divConfirmPopup" style="position:static;">
    <div id="divStatus" style="background-color:#FFFFCC"><span id="spanStatus" class="sprompt"></span></div>
    <span class="hotspot" onclick="confirmScolarship()" style="color:blue; text-decoration:underline;cursor:pointer">ok</span>
    <table>
        <tr>
            <td>
            <span class="ewTableHeaderBtn">school :</span> <?php
            include("ext/school.php");
            $s=new school();
            if($s->get_schools()){
                echo "<select name='admitted_school_id' id='admitted_school_id'>";
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
            <td>
                <span class="ewTableHeaderBtn">entry level :</span><select id="entry_level">
                    <option value="0">select school level</option>
                    <option value="1">SSS</option>
                    <option value="2">Tertiary</option>
                    <option value="3">JSS</option>
                    <option value="4">PRIMARY</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <span class="ewTableHeaderBtn">entry class :</span>
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
            <td>
                <span class="ewTableHeaderBtn">program :</span>
                <select id="program">
                    <option value="0">select program</option>
                    <option value="BA">business</option>
                    <option value="SCI">science</option>
                    <option value="ART">arts</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <span class="ewTableHeaderBtn">attendance</span>
                <select id="attendance">
                    <option value="0">select attendance</option>
                    <option value="1">boarding</option>
                    <option value="2">day</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                
            </td>
        </tr>
        <tr>
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
            <td>
                <span class="ewTableHeaderBtn">scholarship period :</span>
            </td>
        </tr>
        <tr>
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
        <span class="hotspot" onclick="confirmScolarship()" style="color:blue; text-decoration:underline;cursor:pointer">ok</span>
    </div>
</div>

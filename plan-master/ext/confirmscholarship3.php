<div id="divConfirmPopup" style="display: block; position: relative">
    <div id="divConfirmStatus" style="background-color:#FFFFCC"><span id="spanStatus" class="sprompt"></span></div>
    <span class="hotspot" onclick="confirmScolarship()" style="color:blue; text-decoration:underline;cursor:pointer">confirm</span>
    <table>
        <tr>
            <td class="ewTableHeader">School :</td>
            <td>
             <?php
            include_once("ext/school.php");
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
        <span class="hotspot" onclick="confirmScolarship()" style="color:blue; text-decoration:underline;cursor:pointer">confirm</span>
    </div>
</div>
<script>
        

            
            function selectConfirmSchool(nschool_id){
                var obj=document.getElementById("admitted_school_id");
                obj.value=nschool_id;
            }

            function deselectConfirmSchool(nschool_id){
                var obj=document.getElementById("admitted_school_id");
                obj.selectedIndex=0;
            }
            
            function closeConfirmPopup(){
                var objDivConfirmPopup=document.getElementById("divConfirmPopup");
                objDivConfirmPopup.style.visibility="hidden";
            }

</script>

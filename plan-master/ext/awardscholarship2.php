<?php
include_once("const.php");
?>

<link href="style.css" rel="stylesheet">
<script>
    var page = "ext/ajaxawardgrant.php";
    function sendPOSTRequest(theUrl, data) {
        //alert("here");
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

            return eval('('+request.responseText+ ')');
        } catch (ex) {
            return { "result": 0, "error": ex };
        }
    }
    function sendGETRequest(theUrl) {

        var request = new XMLHttpRequest();
        try {

            request.open("POST", theUrl, false);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.setRequestHeader("Connection", "close");
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

    function awardScholarship(obj,student_id){
        if(obj.innerText=="cancel"){
            cancelScholarship(obj,student_id);
            return;
        }

        spanStatus.innerText="";
        var g=grant.value;
        
        if(g==0){
            spanStatus.innerText="please select grant";
            return 0;
        }

        /*if(s==0){
            spanStatus.innerText="please select payment schedule";
            return 0;
        }
        if(a.length<=0){
            spanStatus.innerText="please enter correct scholarship amount";
            return 0;
        }
        if(isNaN(a)){
            spanStatus.innerText="please enter correct scholarship amount";
            return 0;
        }*/

        var u=page+"?cmd=1&grant_id="+g+"&student_applicant_id="+student_id;
        //spanStatus.innerText=u;

        var ru=sendGETRequest(u);
        if(ru.result==0){
            spanStatus.innerText="error:" + ru.message;
            return;
        }

        spanStatus.innerText=ru.message;
        obj.innerText="cancel";
        obj.parentNode.children[0].innerText="Awarded "+grant.options[grant.selectedIndex].text+" ";
        /*obj.parentNode.innerHTML
        cancelScholarship(obj,student_id);
        obj.onclick.obj=obj;
        obj.onclick.student_id=student_id;*/


    }
    function cancelScholarship(obj,student_id){
        spanStatus.innerText="";
        var u=page+"?cmd=2&student_applicant_id="+student_id;
        var ru=sendGETRequest(u);
        if(ru.result==0){
            spanStatus.innerText="error:" + ru.message;
            return;
        }

        spanStatus.innerText=ru.message;
        obj.innerText="award";
        obj.parentNode.children[0].innerText="";

    }


    function onGrantSelected(){
        var obj=document.getElementById("grant")
        if(obj.selectedIndex<=0){
            return;
        }

        /*if(obj.selectedIndex-1>=grant_amount_list.length){
            return;
        }
        amount.value=grant_amount_list[obj.selectedIndex-1];*/

    }

    function getApplicants(){
        var obj=document.getElementById("programarea_id");
		if(obj==null){
			return;
		}
        document.location="SelectionViewlist.php?programarea_id="+obj.value;
    }

</script>


<?php
    if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]!=0)
    {
        $programarea_id=$_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"];
    }
    else
    {
        $programarea_id=get_data("programarea_id");
    }


    if($app_year==false){
		echo "The application for the current academic year is not open";
		exit();
    }
?>
<div class="menu_bar">
		
        <?php
    
                    echo "<b>Application Year:</b>$app_year</b>&nbsp&nbsp";
                    include("ext/programarea.php");
                    if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]==0){
                            echo "<b>Program Area :</b><select id='programarea_id' >";
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
				
				echo '<input type="button" onclick="getApplicants()" value="get applicants" >';
			}
			else{
				
				$p=new programareas();
                $row=$p->get_programarea($programarea_id);
				if(!$row){
					echo "Could not display programarea name.";
				}else{
					echo "<b>Program Area :</b> {$row["programarea_name"]} ";
				}
			}
		?>	
        

        &nbsp Grant to Award &nbsp
        
        <?php
			
            include_once("grants.php");
            $g=new grants();
						
            if($g->get_grants()){
                echo "<select id='grant' onchange='onGrantSelected()'>";
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

        
        <!--<input type="input" readonly value="0.0" id="amount">-->
        

</div>
<div id="divStatus" ><span id="spanStatus" class="sprompt"></span></div>
        

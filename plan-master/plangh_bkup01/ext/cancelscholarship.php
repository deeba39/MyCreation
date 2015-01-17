<?php
include_once("const.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="style.css" rel="stylesheet">
        <script>
            var page = "ajaxawardgrant.php";
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

            
            function cancelScholarship(obj,studnet_id){
                divStatus.innerText="";
                var u=page+"?cmd=2&student_applicant_id="+student_id;
                var ru=sendGETRequest(u);
                if(ru.result==0){
                    divStatus.innerText="error:" + ru.message;
                    return;
                }

                divStatus.innerText=ru.message;
                //obj.parentNode.innerHTML="<span clas='hotsopt' onclick='awardScolarship(this,"+student_id+")'>award</span>";

            }
            function filterSelect(f){
                if(f==1){
                    //community
                    formFilter.elements['programarea'].value="0";
                    formFilter.elements['region'].value="0";
                    formFilter.elements['district'].value="0";
                }
                else if(f==2){
                    //program area
                    formFilter.elements['community'].value="0";
                    formFilter.elements['region'].value="0";
                    formFilter.elements['district'].value="0";
                }
                else if(f==3){
                    //region
                    formFilter.elements['community'].value="0";
                    formFilter.elements['programarea'].value="0";
                    formFilter.elements['district'].value="0";
                }if(f==4){
                    //district
                    formFilter.elements['community'].value="0";
                    formFilter.elements['programarea'].value="0";
                    formFilter.elements['region'].value="0";
                }

                //formFileter.submit()
            }

        </script>
    </head>
    <body>

        <?php
            $programarea=get_data("programarea");
            if($programarea=="0")
            {
                $programarea=false;
            }
            $app_year=(int)get_data("app_year");
            if($app_year==0){
                $app_year=date("Y");
            }
          
        ?>
        <div class="menu_bar">
            <form id="formSelectApplicant" action="cancelscholarship.php" method="post">
                <select name="app_year">
                    <option value="0">all years</option>
                    <?php
                        include("applicants.php");
                        $app=new applicants();
                        if($app->get_years()){
                            $row=$app->fetch();
                            while($row){
                                $selected="";
                                if($app_year==$row['app_year'])
                                {
                                    $selected="selected";
                                }
                                echo "<option value='{$row['app_year']}' $selected >{$row['app_year']} </option>";
                                $row=$app->fetch();
                            }
                        }

                    ?>
                </select>
                <select name="programarea" >
                    <option value="0">all programme area</option>
                    <?php
                        include("programarea.php");
                        $p=new programareas();
                        if($p->get_programareas()){
                            $row=$p->fetch();
                            while($row){
                                $selected="";
                                if($programarea==$row['programarea_id'])
                                {
                                    $selected="selected";
                                }

                                echo "<option value='{$row['programarea_id']}' $selected >{$row['programarea_name']}</option>";
                                $row=$p->fetch();
                            }
                        }
                        


                    ?>
                </select> |
                
                
                <input type="hidden" name="cmd" value="1">
                <input type="submit" value="get applicants">
            </form>
                grant to award
                <select id="grant">
                    <option value="0">select grant</option>
                    <option value="1" selected>GAD GHA 0095</option>
                    <option value="2">GAD GHA 0115</option>
                    <option value="3">GAD GHA 0047</option>
                </select>
                <select id="schedule">
                    <option value="0">select schedule</option>
                    <option value="1" selected>annual</option>
                    <option value="2">term</option>
                    <option value="3">month</option>
                </select>
                <input type="input" value="0.0" id="amount">
                use default <input type="checkbox" value="true" id="useDefault" >
            <div>
                <a href="add_applicant_form.php">add new applicants</a> | 
                <?php echo "<a href='applicantgrantexcelreport.php?programarea=$programarea&app_year=$app_year'>export to excel</a>"; ?>
            </div>
        </div>
        <div id="divStatus">

        </div>
        <div id="content" style="width:10in">
        <?php

        //include("applicants.php");
        if($programarea==false)
        {
            exit();
        }
        $app=new applicants();
        $app->object_id="APPLICANT_LIST";
        $cmd=get_data("cmd");
        switch ($cmd){
            case 1:

                $result=$app->get_applicants_filter(false,false,false,$programarea);
                break;
            case 2:
                $result=$app->next();
                break;
            case 3:
                $result=$app->prev();
                break;
           default:
               $result=$app->get_applicants_filter(false,false,false,$programarea);
               break;

        }
        if(!$result)
        {
            echo "error while listing applicants. {$app->error}";
            exit();
        }
        $p=$programarea===false?0:$programarea;
        
        $str="programarea=$p&app_year=$app_year";
        echo "<table  width='100%'><tr>";
        if($app->page==4 or $app->page==1){
            //first page
            echo "<td align='left'>first page</td>";
        }
        else
        {
             echo "<td align='left'><a href='awardscholarship.php?cmd=3&$str'>prev</a></td>";
        }
        if($app->page==4 or $app->page==3){
            echo "<td align='right'>last page</td>";
        }
        else
        {
             echo "<td align='right'><a href='awardscholarship.php?cmd=2&$str'>next</a></td>";
        }
        echo "</tr></table>";

        
        echo "<table width='100%'>";
            echo "<tr class='default_report_title'>";
                echo "<td>applicant name</td>";
                echo "<td>brith date</td>";
                echo "<td>gender</td>";
                echo "<td>points</td>";
                echo "<td>school name</td>";
                echo "<td>community</td>";
                echo "<td>program area</td>";
                echo "<td>region</td>";
                echo "<td>scholarship</td>";
            echo "</tr>";
        $row=$app->fetch();
        
        while($row)
        {
            echo "<tr class='{$app->style_line}'>";
            echo "<td><a href='view_applicant.php?student_applicant_id={$row['student_applicant_id']}' >".
            formatted_fullname($row['student_lastname'],$row['student_firstname'],$row['student_middlename']).
            "</a></td>";
            echo "<td>".conv_mysql_uk($row['student_dob'])."</td>";
            echo "<td>". gender($row['student_gender'])."</td>";
            echo "<td>{$row['app_points']}</td>";
            echo "<td>{$row['school_name']}</td>";
            echo "<td>community</td>";
            echo "<td>program area</td>";
            echo "<td>region</td>";
            echo "<td>";
                if($row['app_grant_id']==0){
                    echo "<span class='hotspot' onclick='awardScolarship(this,{$row['student_applicant_id']})'>award</a>";
                }
                else{
                    echo "Awarded {$row['code']} {$row['app_amount']}";
                }

            echo "</td>";
            echo "</tr>";
            $row=$app->fetch();
        }
        echo "</table>";
        ?>
        </div>
        <div id="divAwardParam" style="visibility:hidden">
            <select id="sschedule">
                <option value="1">annual</option>
                <option value="2">term</option>
                <option value="3">month</option>
            </select>
            <input type="input" value="" id="samout">

        </div>
    </body>
</html>

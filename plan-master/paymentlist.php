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
<?php
    include_once("ext/const.php");
    $userlevel=  get_user_level();
    /*if($userlevel!=USER_LEVEL_ADMIN or $userlevel!=USER_LEVEL_LEARNING_ADVISOR or $userlevel!=USER_LEVEL_PUOFFICER){
        echo "</body></html>";
        exit();
    }*/
?>

        <link href="ext/style.css" rel="stylesheet">

 
        <script type="text/javascript" src="ext/jquery-1.11.0.js"></script>
        <script type="text/javascript" src="ext/gen.js"></script>
        <script type="text/javascript">

            var userlevel=<?php echo $userlevel ?>; 
            var page=1;
            var recCount=0;
            var searchType=0;
            var students=null;
            var schools=null;
            var payments=null;
            
            function next(){
                /*if(recCount==0){
                    return;
                }
                var nopages= (recCount/15);
                if(page>nopages){
                    return;
                }*/
                page=page+1;
                if(searchType==2){
                    getSchools();
                }else if(searchType==3){
                    getStudentsInPaymentRequest();
                }else if(searchType==4){
                    getSchoolSutdents(schoolId);
                }else{ 
                    getPaymentDetail();
                }
            }
            
            function prev(){
                if(page==1){
                    return;
                }
                page=page-1;
                if(searchType==2){
                    getSchools();
                }else if(searchType==3){
                    getStudentsInPaymentRequest();
                }else if(searchType==4){
                    getSchoolSutdents(schoolId);
                }else{ 
                    getPaymentDetail();
                }
            }
            
           function newSearch(searchType){
                

                page=1;
                recCount=0;
                if(searchType==2){
                    getSchools();
                }else if(searchType==3){
                    getStudentsInPaymentRequest();
                }else if(searchType==4){
                    getSchoolSutdents(schoolId);
                }
            }
            
            function newSearchgetSchoolSutdents(sid){
                page=1;
                recCount=0;
                getSchoolSutdents(sid);
            }
            // var students=null;
            // var schools=null;


            
        </script>
        <script src="ext/paymentlist.js"></script>
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
     
					Financial Year :
                                <?php 
                                include_once "ext/payments.php";
                                    $pay=new payments();
                                    $current_financial_year=$pay->get_current_finacial_year();
                                    $current_financial_year_id=$current_financial_year['financial_year_id'];
                                    if(!$pay->get_all_financial_year()){
                                        echo "<input id='financial_year_id' name='financial_year_id' value='$financial_year_id' title='enter 0 to select all'>";
                                    }
                                    else
                                    {              
                                 ?>
                                 <select id="fin_year" name="fin_year" onchange="getPayments();">
                                        <option value="0">--all--</option>
                                        <?php
                                         $row=$pay->fetch();
                                        while($row)
                                        {
                                            $selected="";
                                            if($row['financial_year_id']==$current_financial_year_id){
                                                $selected="selected";
                                            }
                                            
                                            echo "<option value=\"{$row['financial_year_id']}\" $selected>{$row['year_name']}</option>";
                                            $row=$pay->fetch();
                                        }
                                    }
                                    ?>
                                </select>
                                <div id="divNewPayment" style="display:inline;position: absolute" class='popup'>
                                    New Payment Code :<input type="text" value="" placeholder="Payment Code" name="requestName"  id="requestName">
                                    <span class="hotspot" onclick="createNewPaymentRequest()">add</span>
                                    
                                </div>            
                     
                    

                 
                    
                  
                    
           </div>
            <div id="divPaymentDetail">
                <table id="tablePaymentDetail">
  
                        <tr>
                            <td class="default_report_title">Payment Code:</td>
                            <td id="tdPaymentCode" class="default_report_line2">
                                <span class="default_status">select a payment request</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="default_report_title">Status :</td>
                            <td class="default_report_line2" id="tdPaymentStatus"></td>
                        </tr>
                        <tr><td class="default_report_title">Total Amount:</td> 
                            <td id="tdAmount" class="default_report_line2"></td></tr>
                    </table>
            </div>
            <div>
                <span class="hotspot" onclick="getPayments()">payments </span> |
                <span class="hotspot" onclick="newSearch(2)">schools in request</span> | 
                <span class="hotspot" onclick="newSearch(3)">students in request</span> |
                <span class="hotspot" onclick="exportSelected()">export</span>    
            </div>
            <table width="100%">
                <td style="vertical-align: top">
                    <table width="100%">
                        <tr><td><span class="hotspot" onclick="prev()">prev</span> </td><td width="80%"><td><span class="hotspot" onclick="next()">next</span></td></tr>
                     </table>
                    <table id="tableSchools" style="width:100%;display:none">
                        <tr class="default_report_title">
                            <td></td>
                            <td>School</td>
                            <td>Total Amount</td>
                            <td>Number Students</td>
                        </tr>
                    </table>   
                    <table id="tableStudents" style="width:100%;display:none">
                        <tr class="default_report_title">
                            <td></td>
                            <td>PU</td>
                            <td>Year</td>
                            <td>Community</td>
                            <td>Name</td>
                            <td>Gender</td>
                            <td>Telephone</td>
                            <td>School</td>
                            <td>Grant</td>
                            <td>Amount</td>
                            <td>Type</td>
                        </tr>
                    </table>
                  
                </td>
               
                    
            </table>
        </div>
        
        <div id="divPayments">
                <table id="tablePayments">
                        <tr class="default_report_title">
                            <td></td>
                            <td>Payment Request</td>
                            <td>Financial Year</td>
                            <td>Program Area</td>
                            <td>Amount</td>
                            <td>Status</td>
                            <td></td>
                        </tr>
                </table>
        </div>
        
        <script>getPayments();</script>
    </body>
    
</html>

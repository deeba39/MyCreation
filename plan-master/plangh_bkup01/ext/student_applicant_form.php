<?php
echo $student_applicant->student_resident_programarea_id->ViewValue;
$programarea_id=$_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"];
?>
<script>
    var page = "ext/ajaxaddschool.php";
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
    function addSchool(stype){
        
        var obj=document.getElementById("hiddenSchoolType");
        if(obj==null){
            return;
        }
        obj.value=stype;    
        obj=document.getElementById("divAddSchool");
        obj.style.top=event.y;
        obj.style.left=event.x;
        obj.style.visibility="visible";
        document.getElementById("txtSchoolName").focus();
    }
    function completeAddingPrimarySchool(){
        var objSelect=document.getElementById("x_app_primary_school_id");
        var objSchoolName=document.getElementById("txtSchoolName");
        var objSchoolPoint=document.getElementById("selectSchoolCategory");

        if( objSelect==null || objSchoolName==null ){
            return;
        }

        if(objSchoolName.length<=0 || objSchoolPoint.length<=0){
            return;
        }
        

        var u=page+"?cmd=1&school_name="+objSchoolName.value+"&school_category="+objSchoolPoint.value;
        
        var ru=sendGETRequest(u);

        if(ru.result==0){
            spanStatus.innerText="error:" + ru.message;
            return 0;
        }

        var o=document.createElement("OPTION");
        o.value=ru.school_id;
        o.text=objSchoolName.value;
        objSelect.add(o);
        objSelect.value=ru.school_id;
        objSelect.focus();
        hideAddSchool();
    }
    function completeAddingJSSSchool(){
        var objSelect=document.getElementById("x_app_junior_secondary_id");
        var objSchoolName=document.getElementById("txtSchoolName");
        var objSchoolPoint=document.getElementById("selectSchoolCategory");

        if( objSelect==null || objSchoolName==null ){
            return;
        }

        if(objSchoolName.length<=0 || objSchoolPoint.length<=0){
            return;
        }
        

        var u=page+"?cmd=2&school_name="+objSchoolName.value+"&school_category="+objSchoolPoint.value;
        
        var ru=sendGETRequest(u);

        if(ru.result==0){
            spanStatus.innerText="error:" + ru.message;
            return 0;
        }

        var o=document.createElement("OPTION");
        o.value=ru.school_id;
        o.text=objSchoolName.value;
        objSelect.add(o);
        objSelect.value=ru.school_id;
        objSelect.focus();
        hideAddSchool();
    }
    function hideAddSchool(){
        var obj=document.getElementById("divAddSchool");
        obj.style.visibility="hidden";
		obj=document.getElementById("txtSchoolName").value="";
    }
    function completeAddingSchool(){
        var obj=document.getElementById("hiddenSchoolType");
        if(obj==null){
            hideAddSchool();
            return;
        }

        var stype=obj.value;
        
        if(stype==1){
                completeAddingPrimarySchool();
        } else if(stype==2){
                completeAddingJSSSchool()
        } else{
                spanStatus.innerText="error adding, try again";
                hideAddSchool();
        }
         
        
    }
</script>
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
<?php
	include_once("ext/applicants.php");
	$app=new applicants();
	$app_year=$app->get_admission_year();
	if($app_year==false){
		echo "The application for the current academic year is not open. {$app->error}";
	}
	else{
?>
<?php

?>
<span id="spanStatus"></span>
<form name="fstudent_applicantadd" id="fstudent_applicantadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return student_applicant_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="student_applicant">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($student_applicant->app_submission_year->Visible) { // app_submission_year ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_submission_year->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->app_submission_year->CellAttributes() ?>><span id="el_app_submission_year">
<input type="text" name="x_app_submission_year" id="x_app_submission_year" title="<?php echo $student_applicant->app_submission_year->FldTitle() ?>" readonly size="30" value="<?php echo $app_year ?>"<?php echo $student_applicant->app_submission_year->EditAttributes() ?>>
</span><?php echo $student_applicant->app_submission_year->CustomMsg ?></td>
	
<?php } ?>
<?php if ($student_applicant->student_resident_programarea_id->Visible) { // student_resident_programarea_id ?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->student_resident_programarea_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->student_resident_programarea_id->CellAttributes() ?>><span id="el_student_resident_programarea_id">
<?php if ($student_applicant->student_resident_programarea_id->getSessionValue() <> "") { ?>
<div <?php echo $student_applicant->student_resident_programarea_id->ViewAttributes() ?>>
<?php echo $programarea_name ?></div>
	<input type="hidden" id="x_student_resident_programarea_id" name="x_student_resident_programarea_id" value="<?php echo ew_HtmlEncode($student_applicant->student_resident_programarea_id->CurrentValue) ?>">
<?php } else { 

?>
<select id="x_student_resident_programarea_id" name="x_student_resident_programarea_id" title="<?php echo $student_applicant->student_resident_programarea_id->FldTitle() ?>"<?php echo $student_applicant->student_resident_programarea_id->EditAttributes() ?>>
<?php
if (is_array($student_applicant->student_resident_programarea_id->EditValue)) {
	$arwrk = $student_applicant->student_resident_programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->student_resident_programarea_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
</span><?php echo $student_applicant->student_resident_programarea_id->CustomMsg ?></td>
<?php } ?>	

<?php if ($student_applicant->community_community_id->Visible) { // community_community_id ?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->community_community_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->community_community_id->CellAttributes() ?>><span id="el_community_community_id">
<select id="x_community_community_id" name="x_community_community_id" title="<?php echo $student_applicant->community_community_id->FldTitle() ?>"<?php echo $student_applicant->community_community_id->EditAttributes() ?>>
<?php
if (is_array($student_applicant->community_community_id->EditValue)) {
	$arwrk = $student_applicant->community_community_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->community_community_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $student_applicant->community_community_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->student_lastname->Visible) { // student_lastname ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_lastname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->student_lastname->CellAttributes() ?>><span id="el_student_lastname">
<input type="text" name="x_student_lastname" id="x_student_lastname" title="<?php echo $student_applicant->student_lastname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->student_lastname->EditValue ?>"<?php echo $student_applicant->student_lastname->EditAttributes() ?>>
</span><?php echo $student_applicant->student_lastname->CustomMsg ?></td>
	
<?php } ?>
<?php if ($student_applicant->student_firstname->Visible) { // student_firstname ?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->student_firstname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->student_firstname->CellAttributes() ?>><span id="el_student_firstname">
<input type="text" name="x_student_firstname" id="x_student_firstname" title="<?php echo $student_applicant->student_firstname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->student_firstname->EditValue ?>"<?php echo $student_applicant->student_firstname->EditAttributes() ?>>
</span><?php echo $student_applicant->student_firstname->CustomMsg ?></td>
	
<?php } ?>
<?php if ($student_applicant->student_middlename->Visible) { // student_middlename ?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->student_middlename->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_middlename->CellAttributes() ?>><span id="el_student_middlename">
<input type="text" name="x_student_middlename" id="x_student_middlename" title="<?php echo $student_applicant->student_middlename->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->student_middlename->EditValue ?>"<?php echo $student_applicant->student_middlename->EditAttributes() ?>>
</span><?php echo $student_applicant->student_middlename->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->student_gender->Visible) { // student_gender ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_gender->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->student_gender->CellAttributes() ?>><span id="el_student_gender">
<div id="tp_x_student_gender" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_student_gender" id="x_student_gender" title="<?php echo $student_applicant->student_gender->FldTitle() ?>" value="{value}"<?php echo $student_applicant->student_gender->EditAttributes() ?>></label></div>
<div id="dsl_x_student_gender" repeatcolumn="5">
<?php
$arwrk = $student_applicant->student_gender->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->student_gender->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_student_gender" id="x_student_gender" title="<?php echo $student_applicant->student_gender->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $student_applicant->student_gender->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $student_applicant->student_gender->CustomMsg ?></td>
	
<?php } ?>
<?php if ($student_applicant->student_dob->Visible) { // student_dob 
$y=date("Y")-12;
?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->student_dob->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->student_dob->CellAttributes() ?>><span id="el_student_dob">
<input type="text" name="x_student_dob" id="x_student_dob" title="<?php echo $student_applicant->student_dob->FldTitle() ?>" value="<?php echo "01/06/$y" ?>"<?php echo $student_applicant->student_dob->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_student_dob" name="cal_x_student_dob" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_student_dob", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_student_dob" // button id,

});
//var d=new Date();
//var year=d.getFullYear()-15;

//calendar.setDate(new Date(year,01,01));
</script>
</span><?php echo $student_applicant->student_dob->CustomMsg ?></td>
                <td><!--extra coloumn--></td>
                <td><!--extra coloumn--></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_mother_name->Visible) { // app_mother_name ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_mother_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->app_mother_name->CellAttributes() ?>><span id="el_app_mother_name">
<input type="text" name="x_app_mother_name" id="x_app_mother_name" title="<?php echo $student_applicant->app_mother_name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->app_mother_name->EditValue ?>"<?php echo $student_applicant->app_mother_name->EditAttributes() ?>>
</span><?php echo $student_applicant->app_mother_name->CustomMsg ?></td>
	
<?php } ?>
<?php if ($student_applicant->app_mother_isalive->Visible) { // app_mother_isalive ?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->app_mother_isalive->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->app_mother_isalive->CellAttributes() ?>><span id="el_app_mother_isalive">
<div id="tp_x_app_mother_isalive" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_app_mother_isalive" id="x_app_mother_isalive" title="<?php echo $student_applicant->app_mother_isalive->FldTitle() ?>" value="{value}"<?php echo $student_applicant->app_mother_isalive->EditAttributes() ?>></label></div>
<div id="dsl_x_app_mother_isalive" repeatcolumn="5">
<?php
$arwrk = $student_applicant->app_mother_isalive->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->app_mother_isalive->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_app_mother_isalive" id="x_app_mother_isalive" title="<?php echo $student_applicant->app_mother_isalive->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $student_applicant->app_mother_isalive->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $student_applicant->app_mother_isalive->CustomMsg ?></td>
	
<?php } ?>
<?php if ($student_applicant->app_mother_occupation->Visible) { // app_mother_occupation ?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->app_mother_occupation->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->app_mother_occupation->CellAttributes() ?>><span id="el_app_mother_occupation">
<select id="x_app_mother_occupation" name="x_app_mother_occupation" title="<?php echo $student_applicant->app_mother_occupation->FldTitle() ?>"<?php echo $student_applicant->app_mother_occupation->EditAttributes() ?>>
<?php
if (is_array($student_applicant->app_mother_occupation->EditValue)) {
	$arwrk = $student_applicant->app_mother_occupation->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->app_mother_occupation->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $student_applicant->app_mother_occupation->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_father_name->Visible) { // app_father_name ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_father_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->app_father_name->CellAttributes() ?>><span id="el_app_father_name">
<input type="text" name="x_app_father_name" id="x_app_father_name" title="<?php echo $student_applicant->app_father_name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->app_father_name->EditValue ?>"<?php echo $student_applicant->app_father_name->EditAttributes() ?>>
</span><?php echo $student_applicant->app_father_name->CustomMsg ?></td>
	
<?php } ?>
<?php if ($student_applicant->app_father_isalive->Visible) { // app_father_isalive ?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->app_father_isalive->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_father_isalive->CellAttributes() ?>><span id="el_app_father_isalive">
<div id="tp_x_app_father_isalive" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_app_father_isalive" id="x_app_father_isalive" title="<?php echo $student_applicant->app_father_isalive->FldTitle() ?>" value="{value}"<?php echo $student_applicant->app_father_isalive->EditAttributes() ?>></label></div>
<div id="dsl_x_app_father_isalive" repeatcolumn="5">
<?php
$arwrk = $student_applicant->app_father_isalive->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->app_father_isalive->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_app_father_isalive" id="x_app_father_isalive" title="<?php echo $student_applicant->app_father_isalive->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $student_applicant->app_father_isalive->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $student_applicant->app_father_isalive->CustomMsg ?></td>
	
<?php } ?>
<?php if ($student_applicant->app_father_occupation->Visible) { // app_father_occupation ?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->app_father_occupation->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->app_father_occupation->CellAttributes() ?>><span id="el_app_father_occupation">
<select id="x_app_father_occupation" name="x_app_father_occupation" title="<?php echo $student_applicant->app_father_occupation->FldTitle() ?>"<?php echo $student_applicant->app_father_occupation->EditAttributes() ?>>
<?php
if (is_array($student_applicant->app_father_occupation->EditValue)) {
	$arwrk = $student_applicant->app_father_occupation->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->app_father_occupation->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $student_applicant->app_father_occupation->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_guardian_name->Visible) { // app_guardian_name ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_guardian_name->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_guardian_name->CellAttributes() ?>><span id="el_app_guardian_name">
<input type="text" name="x_app_guardian_name" id="x_app_guardian_name" title="<?php echo $student_applicant->app_guardian_name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->app_guardian_name->EditValue ?>"<?php echo $student_applicant->app_guardian_name->EditAttributes() ?>>
</span><?php echo $student_applicant->app_guardian_name->CustomMsg ?></td>
	
<?php } ?>
<?php if ($student_applicant->app_guardian_relation->Visible) { // app_guardian_relation ?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->app_guardian_relation->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_guardian_relation->CellAttributes() ?>><span id="el_app_guardian_relation">
<select id="x_app_guardian_relation" name="x_app_guardian_relation" title="<?php echo $student_applicant->app_guardian_relation->FldTitle() ?>"<?php echo $student_applicant->app_guardian_relation->EditAttributes() ?>>
<?php
if (is_array($student_applicant->app_guardian_relation->EditValue)) {
	$arwrk = $student_applicant->app_guardian_relation->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->app_guardian_relation->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $student_applicant->app_guardian_relation->CustomMsg ?></td>
	
<?php } ?>
<?php if ($student_applicant->app_guardian_occupation->Visible) { // app_guardian_occupation ?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->app_guardian_occupation->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->app_guardian_occupation->CellAttributes() ?>><span id="el_app_guardian_occupation">
<select id="x_app_guardian_occupation" name="x_app_guardian_occupation" title="<?php echo $student_applicant->app_guardian_occupation->FldTitle() ?>"<?php echo $student_applicant->app_guardian_occupation->EditAttributes() ?>>
<?php
if (is_array($student_applicant->app_guardian_occupation->EditValue)) {
	$arwrk = $student_applicant->app_guardian_occupation->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->app_guardian_occupation->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $student_applicant->app_guardian_occupation->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->student_address->Visible) { // student_address ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_address->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->student_address->CellAttributes() ?>><span id="el_student_address">
<textarea name="x_student_address" id="x_student_address" title="<?php echo $student_applicant->student_address->FldTitle() ?>" cols="30" rows="2"<?php echo $student_applicant->student_address->EditAttributes() ?>><?php echo $student_applicant->student_address->EditValue ?></textarea>
</span><?php echo $student_applicant->student_address->CustomMsg ?></td>
	
<?php } ?>
<?php if ($student_applicant->student_telephone_1->Visible) { // student_telephone_1 ?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->student_telephone_1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->student_telephone_1->CellAttributes() ?>><span id="el_student_telephone_1">
<input type="text" name="x_student_telephone_1" id="x_student_telephone_1" title="<?php echo $student_applicant->student_telephone_1->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->student_telephone_1->EditValue ?>"<?php echo $student_applicant->student_telephone_1->EditAttributes() ?>>
</span><?php echo $student_applicant->student_telephone_1->CustomMsg ?></td>
	
<?php } ?>
<?php if ($student_applicant->student_telephone_2->Visible) { // student_telephone_2 ?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->student_telephone_2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->student_telephone_2->CellAttributes() ?>><span id="el_student_telephone_2">
<input type="text" name="x_student_telephone_2" id="x_student_telephone_2" title="<?php echo $student_applicant->student_telephone_2->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->student_telephone_2->EditValue ?>"<?php echo $student_applicant->student_telephone_2->EditAttributes() ?>>
</span><?php echo $student_applicant->student_telephone_2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_primary_school_id->Visible) { // app_primary_school_id ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_primary_school_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->app_primary_school_id->CellAttributes() ?>><span id="el_app_primary_school_id">
<select id="x_app_primary_school_id" name="x_app_primary_school_id" title="<?php echo $student_applicant->app_primary_school_id->FldTitle() ?>"<?php echo $student_applicant->app_primary_school_id->EditAttributes() ?>>
<?php
if (is_array($student_applicant->app_primary_school_id->EditValue)) {
	$arwrk = $student_applicant->app_primary_school_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->app_primary_school_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<span onclick="addSchool(1)" style="color:blue;cursor:pointer;text-decoration:underline">other</span>
</span><?php echo $student_applicant->app_primary_school_id->CustomMsg ?></td>
	
<?php } ?>
<?php if ($student_applicant->app_junior_secondary_id->Visible) { // app_junior_secondary_id ?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->app_junior_secondary_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->app_junior_secondary_id->CellAttributes() ?>><span id="el_app_junior_secondary_id">
<select id="x_app_junior_secondary_id" name="x_app_junior_secondary_id" title="<?php echo $student_applicant->app_junior_secondary_id->FldTitle() ?>"<?php echo $student_applicant->app_junior_secondary_id->EditAttributes() ?>>
<?php
if (is_array($student_applicant->app_junior_secondary_id->EditValue)) {
	$arwrk = $student_applicant->app_junior_secondary_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->app_junior_secondary_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<span onclick="addSchool(2)" style="color:blue;cursor:pointer;text-decoration:underline">other</span>
</span><?php echo $student_applicant->app_junior_secondary_id->CustomMsg ?></td>

<?php } ?>
<?php if ($student_applicant->student_grades->Visible) { // student_grades ?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->student_grades->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_applicant->student_grades->CellAttributes() ?>><span id="el_student_grades">
<input type="text" name="x_student_grades" id="x_student_grades" title="<?php echo $student_applicant->student_grades->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->student_grades->EditValue ?>"<?php echo $student_applicant->student_grades->EditAttributes() ?>>
</span><?php echo $student_applicant->student_grades->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($student_applicant->app_referees->Visible) { // app_referees ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->app_referees->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_referees->CellAttributes() ?>><span id="el_app_referees">
<input type="text" name="x_app_referees" id="x_app_referees" title="<?php echo $student_applicant->app_referees->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->app_referees->EditValue ?>"<?php echo $student_applicant->app_referees->EditAttributes() ?>>
</span><?php echo $student_applicant->app_referees->CustomMsg ?></td>
	
<?php } ?>
<?php if ($student_applicant->student_admitted_school_id->Visible) { // student_admitted_school_id ?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->student_admitted_school_id->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_admitted_school_id->CellAttributes() ?>><span id="el_student_admitted_school_id">
<select id="x_student_admitted_school_id" name="x_student_admitted_school_id" title="<?php echo $student_applicant->student_admitted_school_id->FldTitle() ?>"<?php echo $student_applicant->student_admitted_school_id->EditAttributes() ?>>
<?php
if (is_array($student_applicant->student_admitted_school_id->EditValue)) {
	$arwrk = $student_applicant->student_admitted_school_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_applicant->student_admitted_school_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $student_applicant->student_admitted_school_id->CustomMsg ?></td>

<?php } ?>
<?php if ($student_applicant->sponsored_child_no->Visible) { // sponsored_child_no ?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->sponsored_child_no->FldCaption() ?></td>
		<td<?php echo $student_applicant->sponsored_child_no->CellAttributes() ?>><span id="el_sponsored_child_no">
<input type="text" name="x_sponsored_child_no" id="x_sponsored_child_no" title="<?php echo $student_applicant->sponsored_child_no->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $student_applicant->sponsored_child_no->EditValue ?>"<?php echo $student_applicant->sponsored_child_no->EditAttributes() ?>>
</span><?php echo $student_applicant->sponsored_child_no->CustomMsg ?></td>
	
<?php } ?>
        </tr>
<?php if ($student_applicant->student_picture->Visible) { // student_picture ?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $student_applicant->student_picture->FldCaption() ?></td>
		<td<?php echo $student_applicant->student_picture->CellAttributes() ?>><span id="el_student_picture">
<input type="file" name="x_student_picture" id="x_student_picture" title="<?php echo $student_applicant->student_picture->FldTitle() ?>"<?php echo $student_applicant->student_picture->EditAttributes() ?>>
</div>
</span><?php echo $student_applicant->student_picture->CustomMsg ?></td>
	
<?php } ?>
<?php if ($student_applicant->app_scanneddocument->Visible) { // app_scanneddocument ?>
	
		<td class="ewTableHeader"><?php echo $student_applicant->app_scanneddocument->FldCaption() ?></td>
		<td<?php echo $student_applicant->app_scanneddocument->CellAttributes() ?>><span id="el_app_scanneddocument">
<input type="file" name="x_app_scanneddocument" id="x_app_scanneddocument" title="<?php echo $student_applicant->app_scanneddocument->FldTitle() ?>" size="30"<?php echo $student_applicant->app_scanneddocument->EditAttributes() ?>>
</div>
</span><?php echo $student_applicant->app_scanneddocument->CustomMsg ?></td>
                <td></td><td></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>

<?php
 }//end if else for if($app_year==false);
?>
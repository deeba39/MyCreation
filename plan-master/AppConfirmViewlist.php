<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "AppConfirmViewinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php
include_once("ext/applicants.php");
$app=new applicants();
$app_year=$app->get_admission_year();

// Create page object
$AppConfirmView_list = new cAppConfirmView_list();
$Page =& $AppConfirmView_list;

// Page init
$AppConfirmView_list->Page_Init();

// Page main
$AppConfirmView_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($AppConfirmView->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var AppConfirmView_list = new ew_Page("AppConfirmView_list");

// page properties
AppConfirmView_list.PageID = "list"; // page ID
AppConfirmView_list.FormID = "fAppConfirmViewlist"; // form ID
var EW_PAGE_ID = AppConfirmView_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
AppConfirmView_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
AppConfirmView_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
AppConfirmView_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($AppConfirmView->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$AppConfirmView_list->lTotalRecs = $AppConfirmView->SelectRecordCount();
	} else {
		if ($rs = $AppConfirmView_list->LoadRecordset())
			$AppConfirmView_list->lTotalRecs = $rs->RecordCount();
	}
	$AppConfirmView_list->lStartRec = 1;
	if ($AppConfirmView_list->lDisplayRecs <= 0 || ($AppConfirmView->Export <> "" && $AppConfirmView->ExportAll)) // Display all records
		$AppConfirmView_list->lDisplayRecs = $AppConfirmView_list->lTotalRecs;
	if (!($AppConfirmView->Export <> "" && $AppConfirmView->ExportAll))
		$AppConfirmView_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $AppConfirmView_list->LoadRecordset($AppConfirmView_list->lStartRec-1, $AppConfirmView_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $AppConfirmView->TableCaption() ?>
<?php if ($AppConfirmView->Export == "" && $AppConfirmView->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $AppConfirmView_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $AppConfirmView_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a name="emf_AppConfirmView" id="emf_AppConfirmView" href="javascript:void(0);" onclick="ew_EmailDialogShow({lnk:'emf_AppConfirmView',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fAppConfirmViewlist,sel:false});"><?php echo $Language->Phrase("ExportToEmail") ?></a>
<?php } ?>
</span></p>
<?php if ($AppConfirmView->Export == "" && $AppConfirmView->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(AppConfirmView_list);" style="text-decoration: none;"><img id="AppConfirmView_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="AppConfirmView_list_SearchPanel">
<form name="fAppConfirmViewlistsrch" id="fAppConfirmViewlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="AppConfirmView">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($AppConfirmView->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $AppConfirmView_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($AppConfirmView->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($AppConfirmView->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($AppConfirmView->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$AppConfirmView_list->ShowMessage();
?>
<?php
	
        if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]==0){
                $programarea_id=(int)get_data("programarea_id");
        }
        else{
                //use the session value for selection
                $programarea_id=$_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"];
        }
		
?>
<form action="AppConfirmViewlist.php" method="GET">
	<table>
		<tr>
                        <td>
                            <b>Application Year :</b> <?php echo $app_year ?>&nbsp&nbsp
			</td>
			<td>
		<?php
			include("ext/programarea.php");
			if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]==0){
				echo "<b>Program Area :</b><select name='programarea_id' >";
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

			</td>

			<td colspan="2" align="right">
				<input type="submit" value="get list to confirm">
			</td>
		</tr>
	</table>
	<input type="hidden" name="ck" value="1">

</form>
<br>
<table id="tableLayout2" cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">

<form name="fAppConfirmViewlist" id="fAppConfirmViewlist" class="ewForm" action="" method="post">
<div id="gmp_AppConfirmView" class="ewGridMiddlePanel">
<?php if ($AppConfirmView_list->lTotalRecs > 0) { ?>
<table id="tableLayout"><tr><td valign="top">
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $AppConfirmView->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$AppConfirmView_list->RenderListOptions();

// Render list options (header, left)
$AppConfirmView_list->ListOptions->Render("header", "left");
?>
<?php if ($AppConfirmView->programarea_name->Visible) { // programarea_name ?>
	<?php if ($AppConfirmView->SortUrl($AppConfirmView->programarea_name) == "") { ?>
		<td><?php echo $AppConfirmView->programarea_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $AppConfirmView->SortUrl($AppConfirmView->programarea_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $AppConfirmView->programarea_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($AppConfirmView->programarea_name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($AppConfirmView->programarea_name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($AppConfirmView->community->Visible) { // community ?>
	<?php if ($AppConfirmView->SortUrl($AppConfirmView->community) == "") { ?>
		<td><?php echo $AppConfirmView->community->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $AppConfirmView->SortUrl($AppConfirmView->community) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $AppConfirmView->community->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($AppConfirmView->community->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($AppConfirmView->community->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($AppConfirmView->student_lastname->Visible) { // student_lastname ?>
	<?php if ($AppConfirmView->SortUrl($AppConfirmView->student_lastname) == "") { ?>
		<td><?php echo $AppConfirmView->student_lastname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $AppConfirmView->SortUrl($AppConfirmView->student_lastname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $AppConfirmView->student_lastname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($AppConfirmView->student_lastname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($AppConfirmView->student_lastname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($AppConfirmView->student_firstname->Visible) { // student_firstname ?>
	<?php if ($AppConfirmView->SortUrl($AppConfirmView->student_firstname) == "") { ?>
		<td><?php echo $AppConfirmView->student_firstname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $AppConfirmView->SortUrl($AppConfirmView->student_firstname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $AppConfirmView->student_firstname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($AppConfirmView->student_firstname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($AppConfirmView->student_firstname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($AppConfirmView->student_middlename->Visible) { // student_middlename ?>
	<?php if ($AppConfirmView->SortUrl($AppConfirmView->student_middlename) == "") { ?>
		<td><?php echo $AppConfirmView->student_middlename->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $AppConfirmView->SortUrl($AppConfirmView->student_middlename) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $AppConfirmView->student_middlename->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($AppConfirmView->student_middlename->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($AppConfirmView->student_middlename->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($AppConfirmView->student_gender->Visible) { // student_gender ?>
	<?php if ($AppConfirmView->SortUrl($AppConfirmView->student_gender) == "") { ?>
		<td><?php echo $AppConfirmView->student_gender->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $AppConfirmView->SortUrl($AppConfirmView->student_gender) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $AppConfirmView->student_gender->FldCaption() ?></td><td style="width: 10px;"><?php if ($AppConfirmView->student_gender->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($AppConfirmView->student_gender->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($AppConfirmView->student_dob->Visible) { // student_dob ?>
	<?php if ($AppConfirmView->SortUrl($AppConfirmView->student_dob) == "") { ?>
		<td><?php echo $AppConfirmView->student_dob->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $AppConfirmView->SortUrl($AppConfirmView->student_dob) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $AppConfirmView->student_dob->FldCaption() ?></td><td style="width: 10px;"><?php if ($AppConfirmView->student_dob->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($AppConfirmView->student_dob->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($AppConfirmView->AGE->Visible) { // AGE ?>
	<?php if ($AppConfirmView->SortUrl($AppConfirmView->AGE) == "") { ?>
		<td><?php echo $AppConfirmView->AGE->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $AppConfirmView->SortUrl($AppConfirmView->AGE) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $AppConfirmView->AGE->FldCaption() ?></td><td style="width: 10px;"><?php if ($AppConfirmView->AGE->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($AppConfirmView->AGE->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($AppConfirmView->applicant_school_name->Visible) { // applicant_school_name ?>
	<?php if ($AppConfirmView->SortUrl($AppConfirmView->applicant_school_name) == "") { ?>
		<td><?php echo $AppConfirmView->applicant_school_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $AppConfirmView->SortUrl($AppConfirmView->applicant_school_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $AppConfirmView->applicant_school_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($AppConfirmView->applicant_school_name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($AppConfirmView->applicant_school_name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($AppConfirmView->app_grant_id->Visible) { // app_grant_id ?>
	<?php if ($AppConfirmView->SortUrl($AppConfirmView->app_grant_id) == "") { ?>
		<td><?php echo $AppConfirmView->app_grant_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $AppConfirmView->SortUrl($AppConfirmView->app_grant_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $AppConfirmView->app_grant_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($AppConfirmView->app_grant_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($AppConfirmView->app_grant_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$AppConfirmView_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($AppConfirmView->ExportAll && $AppConfirmView->Export <> "") {
	$AppConfirmView_list->lStopRec = $AppConfirmView_list->lTotalRecs;
} else {
	$AppConfirmView_list->lStopRec = $AppConfirmView_list->lStartRec + $AppConfirmView_list->lDisplayRecs - 1; // Set the last record to display
}
$AppConfirmView_list->lRecCount = $AppConfirmView_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $AppConfirmView_list->lStartRec > 1)
		$rs->Move($AppConfirmView_list->lStartRec - 1);
}

// Initialize aggregate
$AppConfirmView->RowType = EW_ROWTYPE_AGGREGATEINIT;
$AppConfirmView_list->RenderRow();
$AppConfirmView_list->lRowCnt = 0;
while (($AppConfirmView->CurrentAction == "gridadd" || !$rs->EOF) &&
	$AppConfirmView_list->lRecCount < $AppConfirmView_list->lStopRec) {
	$AppConfirmView_list->lRecCount++;
	if (intval($AppConfirmView_list->lRecCount) >= intval($AppConfirmView_list->lStartRec)) {
		$AppConfirmView_list->lRowCnt++;

	// Init row class and style
	$AppConfirmView->CssClass = "";
	$AppConfirmView->CssStyle = "";
	$AppConfirmView->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($AppConfirmView->CurrentAction == "gridadd") {
		$AppConfirmView_list->LoadDefaultValues(); // Load default values
	} else {
		$AppConfirmView_list->LoadRowValues($rs); // Load row values
	}
	$AppConfirmView->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$AppConfirmView_list->RenderRow();

	// Render list options
	$AppConfirmView_list->RenderListOptions();
?>
	<tr<?php echo $AppConfirmView->RowAttributes() ?>>
<?php

// Render list options (body, left)
$AppConfirmView_list->ListOptions->Render("body", "left");
?>
	<?php if ($AppConfirmView->programarea_name->Visible) { // programarea_name ?>
		<td<?php echo $AppConfirmView->programarea_name->CellAttributes() ?>>
<div<?php echo $AppConfirmView->programarea_name->ViewAttributes() ?>>
<?php if ($AppConfirmView->programarea_name->HrefValue <> "" || $AppConfirmView->programarea_name->TooltipValue <> "") { ?>
<a href="http://programareaview.php?pogramarea_id=<?php echo $AppConfirmView->programarea_name->HrefValue ?>"><?php echo $AppConfirmView->programarea_name->ListViewValue() ?></a>
<?php } else { ?>
<?php echo $AppConfirmView->programarea_name->ListViewValue() ?>
<?php } ?>
</div>
</td>
	<?php } ?>
	<?php if ($AppConfirmView->community->Visible) { // community ?>
		<td<?php echo $AppConfirmView->community->CellAttributes() ?>>
<div<?php echo $AppConfirmView->community->ViewAttributes() ?>><?php echo $AppConfirmView->community->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($AppConfirmView->student_lastname->Visible) { // student_lastname ?>
		<td<?php echo $AppConfirmView->student_lastname->CellAttributes() ?>>
<div<?php echo $AppConfirmView->student_lastname->ViewAttributes() ?>><?php echo $AppConfirmView->student_lastname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($AppConfirmView->student_firstname->Visible) { // student_firstname ?>
		<td<?php echo $AppConfirmView->student_firstname->CellAttributes() ?>>
<div<?php echo $AppConfirmView->student_firstname->ViewAttributes() ?>><?php echo $AppConfirmView->student_firstname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($AppConfirmView->student_middlename->Visible) { // student_middlename ?>
		<td<?php echo $AppConfirmView->student_middlename->CellAttributes() ?>>
<div<?php echo $AppConfirmView->student_middlename->ViewAttributes() ?>><?php echo $AppConfirmView->student_middlename->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($AppConfirmView->student_gender->Visible) { // student_gender ?>
		<td<?php echo $AppConfirmView->student_gender->CellAttributes() ?>>
<div<?php echo $AppConfirmView->student_gender->ViewAttributes() ?>><?php echo $AppConfirmView->student_gender->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($AppConfirmView->student_dob->Visible) { // student_dob ?>
		<td<?php echo $AppConfirmView->student_dob->CellAttributes() ?>>
<div<?php echo $AppConfirmView->student_dob->ViewAttributes() ?>><?php echo $AppConfirmView->student_dob->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($AppConfirmView->AGE->Visible) { // AGE ?>
		<td<?php echo $AppConfirmView->AGE->CellAttributes() ?>>
<div<?php echo $AppConfirmView->AGE->ViewAttributes() ?>><?php echo $AppConfirmView->AGE->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($AppConfirmView->applicant_school_name->Visible) { // applicant_school_name ?>
		<td<?php echo $AppConfirmView->applicant_school_name->CellAttributes() ?>>
<div<?php echo $AppConfirmView->applicant_school_name->ViewAttributes() ?>><?php echo $AppConfirmView->applicant_school_name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($AppConfirmView->app_grant_id->Visible) { // app_grant_id ?>
		<td<?php echo $AppConfirmView->app_grant_id->CellAttributes() ?>>
<div<?php echo $AppConfirmView->app_grant_id->ViewAttributes() ?>><?php echo $AppConfirmView->app_grant_id->ListViewValue() ?>
    <span onclick="startConfirm(this,<?php echo $AppConfirmView->student_applicant_id->CurrentValue ?>,<?php echo $AppConfirmView->student_admitted_school_id->CurrentValue ?>)"
          style="color:blue;text-decoration: underline;cursor: pointer">confirm</span>
</div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
//$AppConfirmView_list->ListOptions->Render("body", "right");
?>
	</tr>
        
<?php
	}
	if ($AppConfirmView->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
        
</tbody>
</table>
            </td><td>
     <?php include("ext/confirmscholarship2.php")?>
 </td></tr></table>
<?php } ?>
</div>
</form>
 
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($AppConfirmView->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($AppConfirmView->CurrentAction <> "gridadd" && $AppConfirmView->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($AppConfirmView_list->Pager)) $AppConfirmView_list->Pager = new cPrevNextPager($AppConfirmView_list->lStartRec, $AppConfirmView_list->lDisplayRecs, $AppConfirmView_list->lTotalRecs) ?>
<?php if ($AppConfirmView_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($AppConfirmView_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $AppConfirmView_list->PageUrl() ?>start=<?php echo $AppConfirmView_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($AppConfirmView_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $AppConfirmView_list->PageUrl() ?>start=<?php echo $AppConfirmView_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $AppConfirmView_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($AppConfirmView_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $AppConfirmView_list->PageUrl() ?>start=<?php echo $AppConfirmView_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($AppConfirmView_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $AppConfirmView_list->PageUrl() ?>start=<?php echo $AppConfirmView_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $AppConfirmView_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $AppConfirmView_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $AppConfirmView_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $AppConfirmView_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($AppConfirmView_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($AppConfirmView_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($AppConfirmView->Export == "" && $AppConfirmView->CurrentAction == "") { ?>
<?php } ?>
<?php if ($AppConfirmView->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$AppConfirmView_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cAppConfirmView_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'AppConfirmView';

	// Page object name
	var $PageObjName = 'AppConfirmView_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $AppConfirmView;
		if ($AppConfirmView->UseTokenInUrl) $PageUrl .= "t=" . $AppConfirmView->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $AppConfirmView;
		if ($AppConfirmView->UseTokenInUrl) {
			if ($objForm)
				return ($AppConfirmView->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($AppConfirmView->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cAppConfirmView_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (AppConfirmView)
		$GLOBALS["AppConfirmView"] = new cAppConfirmView();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["AppConfirmView"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "appconfirmviewdelete.php";
		$this->MultiUpdateUrl = "appconfirmviewupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'AppConfirmView', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $AppConfirmView;

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$AppConfirmView->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$AppConfirmView->Export = $_POST["exporttype"];
		} else {
			$AppConfirmView->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $AppConfirmView->Export; // Get export parameter, used in header
		$gsExportFile = $AppConfirmView->TableVar; // Get export file, used in header
		if ($AppConfirmView->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $lDisplayRecs = 20;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $sSrchWhere = ""; // Search WHERE clause
	var $lRecCnt = 0; // Record count
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex; // Row index
	var $lRecPerRow = 0;
	var $lColCnt = 0;
	var $sDbMasterFilter = ""; // Master filter
	var $sDbDetailFilter = ""; // Detail filter
	var $bMasterRecordExists;	
	var $sMultiSelectKey;
	var $RestoreSearch;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $AppConfirmView;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up list options
			$this->SetupListOptions();

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$AppConfirmView->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($AppConfirmView->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $AppConfirmView->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$AppConfirmView->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$AppConfirmView->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$AppConfirmView->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $AppConfirmView->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$AppConfirmView->setSessionWhere($sFilter);
		$AppConfirmView->CurrentFilter = "";

		// Export data only
		if (in_array($AppConfirmView->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($AppConfirmView->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $AppConfirmView;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $AppConfirmView->programarea_name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $AppConfirmView->community, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $AppConfirmView->student_lastname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $AppConfirmView->student_firstname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $AppConfirmView->student_middlename, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $AppConfirmView->student_gender, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $AppConfirmView->applicant_school_name, $Keyword);
		if (is_numeric($Keyword)) $this->BuildBasicSearchSQL($sWhere, $AppConfirmView->app_grant_id, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . " LIKE " . ew_QuotedValue("%" . $Keyword . "%", $lFldDataType);
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $AppConfirmView;
		$sSearchStr = "";
		$sSearchKeyword = $AppConfirmView->BasicSearchKeyword;
		$sSearchType = $AppConfirmView->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$AppConfirmView->setSessionBasicSearchKeyword($sSearchKeyword);
			$AppConfirmView->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $AppConfirmView;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$AppConfirmView->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $AppConfirmView;
		$AppConfirmView->setSessionBasicSearchKeyword("");
		$AppConfirmView->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $AppConfirmView;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$AppConfirmView->BasicSearchKeyword = $AppConfirmView->getSessionBasicSearchKeyword();
			$AppConfirmView->BasicSearchType = $AppConfirmView->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $AppConfirmView;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$AppConfirmView->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$AppConfirmView->CurrentOrderType = @$_GET["ordertype"];
			$AppConfirmView->UpdateSort($AppConfirmView->programarea_name); // programarea_name
			$AppConfirmView->UpdateSort($AppConfirmView->community); // community
			$AppConfirmView->UpdateSort($AppConfirmView->student_lastname); // student_lastname
			$AppConfirmView->UpdateSort($AppConfirmView->student_firstname); // student_firstname
			$AppConfirmView->UpdateSort($AppConfirmView->student_middlename); // student_middlename
			$AppConfirmView->UpdateSort($AppConfirmView->student_gender); // student_gender
			$AppConfirmView->UpdateSort($AppConfirmView->student_dob); // student_dob
			$AppConfirmView->UpdateSort($AppConfirmView->AGE); // AGE
			$AppConfirmView->UpdateSort($AppConfirmView->applicant_school_name); // applicant_school_name
			$AppConfirmView->UpdateSort($AppConfirmView->app_grant_id); // app_grant_id
			$AppConfirmView->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $AppConfirmView;
		$sOrderBy = $AppConfirmView->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($AppConfirmView->SqlOrderBy() <> "") {
				$sOrderBy = $AppConfirmView->SqlOrderBy();
				$AppConfirmView->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $AppConfirmView;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$AppConfirmView->setSessionOrderBy($sOrderBy);
				$AppConfirmView->programarea_name->setSort("");
				$AppConfirmView->community->setSort("");
				$AppConfirmView->student_lastname->setSort("");
				$AppConfirmView->student_firstname->setSort("");
				$AppConfirmView->student_middlename->setSort("");
				$AppConfirmView->student_gender->setSort("");
				$AppConfirmView->student_dob->setSort("");
				$AppConfirmView->AGE->setSort("");
				$AppConfirmView->applicant_school_name->setSort("");
				$AppConfirmView->app_grant_id->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$AppConfirmView->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $AppConfirmView;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($AppConfirmView->Export <> "" ||
			$AppConfirmView->CurrentAction == "gridadd" ||
			$AppConfirmView->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $AppConfirmView;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $AppConfirmView;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $AppConfirmView;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$AppConfirmView->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$AppConfirmView->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $AppConfirmView->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$AppConfirmView->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$AppConfirmView->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$AppConfirmView->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $AppConfirmView;
		$AppConfirmView->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$AppConfirmView->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $AppConfirmView;

		// Call Recordset Selecting event
		$AppConfirmView->Recordset_Selecting($AppConfirmView->CurrentFilter);

		// Load List page SQL
		$sSql = $AppConfirmView->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$AppConfirmView->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $AppConfirmView;
		$sFilter = $AppConfirmView->KeyFilter();

		// Call Row Selecting event
		$AppConfirmView->Row_Selecting($sFilter);

		// Load SQL based on filter
		$AppConfirmView->CurrentFilter = $sFilter;
		$sSql = $AppConfirmView->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$AppConfirmView->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $AppConfirmView;
		$AppConfirmView->student_applicant_id->setDbValue($rs->fields('student_applicant_id'));
		$AppConfirmView->programarea_name->setDbValue($rs->fields('programarea_name'));
		$AppConfirmView->community->setDbValue($rs->fields('community'));
		$AppConfirmView->student_lastname->setDbValue($rs->fields('student_lastname'));
		$AppConfirmView->student_firstname->setDbValue($rs->fields('student_firstname'));
		$AppConfirmView->student_middlename->setDbValue($rs->fields('student_middlename'));
		$AppConfirmView->student_gender->setDbValue($rs->fields('student_gender'));
		$AppConfirmView->student_dob->setDbValue($rs->fields('student_dob'));
		$AppConfirmView->AGE->setDbValue($rs->fields('AGE'));
		$AppConfirmView->applicant_school_name->setDbValue($rs->fields('applicant_school_name'));
		$AppConfirmView->app_grant_id->setDbValue($rs->fields('app_grant_id'));
		$AppConfirmView->app_amount->setDbValue($rs->fields('app_amount'));
		$AppConfirmView->student_admitted_school_id->setDbValue($rs->fields('student_admitted_school_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $AppConfirmView;

		// Initialize URLs
		$this->ViewUrl = $AppConfirmView->ViewUrl();
		$this->EditUrl = $AppConfirmView->EditUrl();
		$this->InlineEditUrl = $AppConfirmView->InlineEditUrl();
		$this->CopyUrl = $AppConfirmView->CopyUrl();
		$this->InlineCopyUrl = $AppConfirmView->InlineCopyUrl();
		$this->DeleteUrl = $AppConfirmView->DeleteUrl();

		// Call Row_Rendering event
		$AppConfirmView->Row_Rendering();

		// Common render codes for all row types
		// programarea_name

		$AppConfirmView->programarea_name->CellCssStyle = ""; $AppConfirmView->programarea_name->CellCssClass = "";
		$AppConfirmView->programarea_name->CellAttrs = array(); $AppConfirmView->programarea_name->ViewAttrs = array(); $AppConfirmView->programarea_name->EditAttrs = array();

		// community
		$AppConfirmView->community->CellCssStyle = ""; $AppConfirmView->community->CellCssClass = "";
		$AppConfirmView->community->CellAttrs = array(); $AppConfirmView->community->ViewAttrs = array(); $AppConfirmView->community->EditAttrs = array();

		// student_lastname
		$AppConfirmView->student_lastname->CellCssStyle = ""; $AppConfirmView->student_lastname->CellCssClass = "";
		$AppConfirmView->student_lastname->CellAttrs = array(); $AppConfirmView->student_lastname->ViewAttrs = array(); $AppConfirmView->student_lastname->EditAttrs = array();

		// student_firstname
		$AppConfirmView->student_firstname->CellCssStyle = ""; $AppConfirmView->student_firstname->CellCssClass = "";
		$AppConfirmView->student_firstname->CellAttrs = array(); $AppConfirmView->student_firstname->ViewAttrs = array(); $AppConfirmView->student_firstname->EditAttrs = array();

		// student_middlename
		$AppConfirmView->student_middlename->CellCssStyle = ""; $AppConfirmView->student_middlename->CellCssClass = "";
		$AppConfirmView->student_middlename->CellAttrs = array(); $AppConfirmView->student_middlename->ViewAttrs = array(); $AppConfirmView->student_middlename->EditAttrs = array();

		// student_gender
		$AppConfirmView->student_gender->CellCssStyle = ""; $AppConfirmView->student_gender->CellCssClass = "";
		$AppConfirmView->student_gender->CellAttrs = array(); $AppConfirmView->student_gender->ViewAttrs = array(); $AppConfirmView->student_gender->EditAttrs = array();

		// student_dob
		$AppConfirmView->student_dob->CellCssStyle = ""; $AppConfirmView->student_dob->CellCssClass = "";
		$AppConfirmView->student_dob->CellAttrs = array(); $AppConfirmView->student_dob->ViewAttrs = array(); $AppConfirmView->student_dob->EditAttrs = array();

		// AGE
		$AppConfirmView->AGE->CellCssStyle = ""; $AppConfirmView->AGE->CellCssClass = "";
		$AppConfirmView->AGE->CellAttrs = array(); $AppConfirmView->AGE->ViewAttrs = array(); $AppConfirmView->AGE->EditAttrs = array();

		// applicant_school_name
		$AppConfirmView->applicant_school_name->CellCssStyle = ""; $AppConfirmView->applicant_school_name->CellCssClass = "";
		$AppConfirmView->applicant_school_name->CellAttrs = array(); $AppConfirmView->applicant_school_name->ViewAttrs = array(); $AppConfirmView->applicant_school_name->EditAttrs = array();

		// app_grant_id
		$AppConfirmView->app_grant_id->CellCssStyle = ""; $AppConfirmView->app_grant_id->CellCssClass = "";
		$AppConfirmView->app_grant_id->CellAttrs = array(); $AppConfirmView->app_grant_id->ViewAttrs = array(); $AppConfirmView->app_grant_id->EditAttrs = array();
		if ($AppConfirmView->RowType == EW_ROWTYPE_VIEW) { // View row

			// student_applicant_id
			$AppConfirmView->student_applicant_id->ViewValue = $AppConfirmView->student_applicant_id->CurrentValue;
			$AppConfirmView->student_applicant_id->CssStyle = "";
			$AppConfirmView->student_applicant_id->CssClass = "";
			$AppConfirmView->student_applicant_id->ViewCustomAttributes = "";

			// programarea_name
			$AppConfirmView->programarea_name->ViewValue = $AppConfirmView->programarea_name->CurrentValue;
			$AppConfirmView->programarea_name->CssStyle = "";
			$AppConfirmView->programarea_name->CssClass = "";
			$AppConfirmView->programarea_name->ViewCustomAttributes = "";

			// community
			$AppConfirmView->community->ViewValue = $AppConfirmView->community->CurrentValue;
			$AppConfirmView->community->CssStyle = "";
			$AppConfirmView->community->CssClass = "";
			$AppConfirmView->community->ViewCustomAttributes = "";

			// student_lastname
			$AppConfirmView->student_lastname->ViewValue = $AppConfirmView->student_lastname->CurrentValue;
			$AppConfirmView->student_lastname->CssStyle = "font-weight:bold;";
			$AppConfirmView->student_lastname->CssClass = "";
			$AppConfirmView->student_lastname->ViewCustomAttributes = "";

			// student_firstname
			$AppConfirmView->student_firstname->ViewValue = $AppConfirmView->student_firstname->CurrentValue;
			$AppConfirmView->student_firstname->CssStyle = "";
			$AppConfirmView->student_firstname->CssClass = "";
			$AppConfirmView->student_firstname->ViewCustomAttributes = "";

			// student_middlename
			$AppConfirmView->student_middlename->ViewValue = $AppConfirmView->student_middlename->CurrentValue;
			$AppConfirmView->student_middlename->CssStyle = "";
			$AppConfirmView->student_middlename->CssClass = "";
			$AppConfirmView->student_middlename->ViewCustomAttributes = "";

			// student_gender
			if (strval($AppConfirmView->student_gender->CurrentValue) <> "") {
				switch ($AppConfirmView->student_gender->CurrentValue) {
					case "m":
						$AppConfirmView->student_gender->ViewValue = "male";
						break;
					case "f":
						$AppConfirmView->student_gender->ViewValue = "female";
						break;
					default:
						$AppConfirmView->student_gender->ViewValue = $AppConfirmView->student_gender->CurrentValue;
				}
			} else {
				$AppConfirmView->student_gender->ViewValue = NULL;
			}
			$AppConfirmView->student_gender->CssStyle = "";
			$AppConfirmView->student_gender->CssClass = "";
			$AppConfirmView->student_gender->ViewCustomAttributes = "";

			// student_dob
			$AppConfirmView->student_dob->ViewValue = $AppConfirmView->student_dob->CurrentValue;
			$AppConfirmView->student_dob->ViewValue = ew_FormatDateTime($AppConfirmView->student_dob->ViewValue, 7);
			$AppConfirmView->student_dob->CssStyle = "";
			$AppConfirmView->student_dob->CssClass = "";
			$AppConfirmView->student_dob->ViewCustomAttributes = "";

			// AGE
			$AppConfirmView->AGE->ViewValue = $AppConfirmView->AGE->CurrentValue;
			$AppConfirmView->AGE->CssStyle = "";
			$AppConfirmView->AGE->CssClass = "";
			$AppConfirmView->AGE->ViewCustomAttributes = "";

			// applicant_school_name
			$AppConfirmView->applicant_school_name->ViewValue = $AppConfirmView->applicant_school_name->CurrentValue;
			$AppConfirmView->applicant_school_name->CssStyle = "";
			$AppConfirmView->applicant_school_name->CssClass = "";
			$AppConfirmView->applicant_school_name->ViewCustomAttributes = "";

			// app_grant_id
			if (strval($AppConfirmView->app_grant_id->CurrentValue) <> "") {
				$sFilterWrk = "`grant_package_id` = " . ew_AdjustSql($AppConfirmView->app_grant_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `grant_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$AppConfirmView->app_grant_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$AppConfirmView->app_grant_id->ViewValue = $AppConfirmView->app_grant_id->CurrentValue;
				}
			} else {
				$AppConfirmView->app_grant_id->ViewValue = NULL;
			}
			$AppConfirmView->app_grant_id->CssStyle = "";
			$AppConfirmView->app_grant_id->CssClass = "";
			$AppConfirmView->app_grant_id->ViewCustomAttributes = "";

			// app_amount
			$AppConfirmView->app_amount->ViewValue = $AppConfirmView->app_amount->CurrentValue;
			$AppConfirmView->app_amount->CssStyle = "";
			$AppConfirmView->app_amount->CssClass = "";
			$AppConfirmView->app_amount->ViewCustomAttributes = "";

			// programarea_name
			if (!ew_Empty($AppConfirmView->programarea_name->CurrentValue)) {
				$AppConfirmView->programarea_name->HrefValue = $AppConfirmView->programarea_name->CurrentValue;
				if ($AppConfirmView->Export <> "") $AppConfirmView->programarea_name->HrefValue = ew_ConvertFullUrl($AppConfirmView->programarea_name->HrefValue);
			} else {
				$AppConfirmView->programarea_name->HrefValue = "";
			}
			$AppConfirmView->programarea_name->TooltipValue = "";

			// community
			$AppConfirmView->community->HrefValue = "";
			$AppConfirmView->community->TooltipValue = "";

			// student_lastname
			$AppConfirmView->student_lastname->HrefValue = "";
			$AppConfirmView->student_lastname->TooltipValue = "";

			// student_firstname
			$AppConfirmView->student_firstname->HrefValue = "";
			$AppConfirmView->student_firstname->TooltipValue = "";

			// student_middlename
			$AppConfirmView->student_middlename->HrefValue = "";
			$AppConfirmView->student_middlename->TooltipValue = "";

			// student_gender
			$AppConfirmView->student_gender->HrefValue = "";
			$AppConfirmView->student_gender->TooltipValue = "";

			// student_dob
			$AppConfirmView->student_dob->HrefValue = "";
			$AppConfirmView->student_dob->TooltipValue = "";

			// AGE
			$AppConfirmView->AGE->HrefValue = "";
			$AppConfirmView->AGE->TooltipValue = "";

			// applicant_school_name
			$AppConfirmView->applicant_school_name->HrefValue = "";
			$AppConfirmView->applicant_school_name->TooltipValue = "";

			// app_grant_id
			$AppConfirmView->app_grant_id->HrefValue = "";
			$AppConfirmView->app_grant_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($AppConfirmView->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$AppConfirmView->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $AppConfirmView;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $AppConfirmView->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($AppConfirmView->ExportAll) {
			$this->lDisplayRecs = $this->lTotalRecs;
			$this->lStopRec = $this->lTotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->lDisplayRecs < 0) {
				$this->lStopRec = $this->lTotalRecs;
			} else {
				$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->lStartRec-1, $this->lDisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($AppConfirmView->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($AppConfirmView, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($AppConfirmView->student_applicant_id);
				$ExportDoc->ExportCaption($AppConfirmView->programarea_name);
				$ExportDoc->ExportCaption($AppConfirmView->community);
				$ExportDoc->ExportCaption($AppConfirmView->student_lastname);
				$ExportDoc->ExportCaption($AppConfirmView->student_firstname);
				$ExportDoc->ExportCaption($AppConfirmView->student_middlename);
				$ExportDoc->ExportCaption($AppConfirmView->student_gender);
				$ExportDoc->ExportCaption($AppConfirmView->student_dob);
				$ExportDoc->ExportCaption($AppConfirmView->AGE);
				$ExportDoc->ExportCaption($AppConfirmView->applicant_school_name);
				$ExportDoc->ExportCaption($AppConfirmView->app_grant_id);
				$ExportDoc->ExportCaption($AppConfirmView->app_amount);
				$ExportDoc->EndExportRow();
			}
		}

		// Move to first record
		$this->lRecCnt = $this->lStartRec - 1;
		if (!$rs->EOF) {
			$rs->MoveFirst();
			if (!$bSelectLimit && $this->lStartRec > 1)
				$rs->Move($this->lStartRec - 1);
		}
		while (!$rs->EOF && $this->lRecCnt < $this->lStopRec) {
			$this->lRecCnt++;
			if (intval($this->lRecCnt) >= intval($this->lStartRec)) {
				$this->LoadRowValues($rs);

				// Render row
				$AppConfirmView->CssClass = "";
				$AppConfirmView->CssStyle = "";
				$AppConfirmView->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($AppConfirmView->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('student_applicant_id', $AppConfirmView->student_applicant_id->ExportValue($AppConfirmView->Export, $AppConfirmView->ExportOriginalValue));
					$XmlDoc->AddField('programarea_name', $AppConfirmView->programarea_name->ExportValue($AppConfirmView->Export, $AppConfirmView->ExportOriginalValue));
					$XmlDoc->AddField('community', $AppConfirmView->community->ExportValue($AppConfirmView->Export, $AppConfirmView->ExportOriginalValue));
					$XmlDoc->AddField('student_lastname', $AppConfirmView->student_lastname->ExportValue($AppConfirmView->Export, $AppConfirmView->ExportOriginalValue));
					$XmlDoc->AddField('student_firstname', $AppConfirmView->student_firstname->ExportValue($AppConfirmView->Export, $AppConfirmView->ExportOriginalValue));
					$XmlDoc->AddField('student_middlename', $AppConfirmView->student_middlename->ExportValue($AppConfirmView->Export, $AppConfirmView->ExportOriginalValue));
					$XmlDoc->AddField('student_gender', $AppConfirmView->student_gender->ExportValue($AppConfirmView->Export, $AppConfirmView->ExportOriginalValue));
					$XmlDoc->AddField('student_dob', $AppConfirmView->student_dob->ExportValue($AppConfirmView->Export, $AppConfirmView->ExportOriginalValue));
					$XmlDoc->AddField('AGE', $AppConfirmView->AGE->ExportValue($AppConfirmView->Export, $AppConfirmView->ExportOriginalValue));
					$XmlDoc->AddField('applicant_school_name', $AppConfirmView->applicant_school_name->ExportValue($AppConfirmView->Export, $AppConfirmView->ExportOriginalValue));
					$XmlDoc->AddField('app_grant_id', $AppConfirmView->app_grant_id->ExportValue($AppConfirmView->Export, $AppConfirmView->ExportOriginalValue));
					$XmlDoc->AddField('app_amount', $AppConfirmView->app_amount->ExportValue($AppConfirmView->Export, $AppConfirmView->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($AppConfirmView->student_applicant_id);
					$ExportDoc->ExportField($AppConfirmView->programarea_name);
					$ExportDoc->ExportField($AppConfirmView->community);
					$ExportDoc->ExportField($AppConfirmView->student_lastname);
					$ExportDoc->ExportField($AppConfirmView->student_firstname);
					$ExportDoc->ExportField($AppConfirmView->student_middlename);
					$ExportDoc->ExportField($AppConfirmView->student_gender);
					$ExportDoc->ExportField($AppConfirmView->student_dob);
					$ExportDoc->ExportField($AppConfirmView->AGE);
					$ExportDoc->ExportField($AppConfirmView->applicant_school_name);
					$ExportDoc->ExportField($AppConfirmView->app_grant_id);
					$ExportDoc->ExportField($AppConfirmView->app_amount);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($AppConfirmView->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($AppConfirmView->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($AppConfirmView->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($AppConfirmView->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($AppConfirmView->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Export email
	function ExportEmail($EmailContent) {
		global $Language, $AppConfirmView;
		$sSender = @$_GET["sender"];
		$sRecipient = @$_GET["recipient"];
		$sCc = @$_GET["cc"];
		$sBcc = @$_GET["bcc"];
		$sContentType = @$_GET["contenttype"];

		// Subject
		$sSubject = ew_StripSlashes(@$_GET["subject"]);
		$sEmailSubject = $sSubject;

		// Message
		$sContent = ew_StripSlashes(@$_GET["message"]);
		$sEmailMessage = $sContent;

		// Check sender
		if ($sSender == "") {
			$this->setMessage($Language->Phrase("EnterSenderEmail"));
			return;
		}
		if (!ew_CheckEmail($sSender)) {
			$this->setMessage($Language->Phrase("EnterProperSenderEmail"));
			return;
		}

		// Check recipient
		if (!ew_CheckEmailList($sRecipient, EW_MAX_EMAIL_RECIPIENT)) {
			$this->setMessage($Language->Phrase("EnterProperRecipientEmail"));
			return;
		}

		// Check cc
		if (!ew_CheckEmailList($sCc, EW_MAX_EMAIL_RECIPIENT)) {
			$this->setMessage($Language->Phrase("EnterProperCcEmail"));
			return;
		}

		// Check bcc
		if (!ew_CheckEmailList($sBcc, EW_MAX_EMAIL_RECIPIENT)) {
			$this->setMessage($Language->Phrase("EnterProperBccEmail"));
			return;
		}

		// Check email sent count
		if (!isset($_SESSION[EW_EXPORT_EMAIL_COUNTER]))
			$_SESSION[EW_EXPORT_EMAIL_COUNTER] = 0;
		if (intval($_SESSION[EW_EXPORT_EMAIL_COUNTER]) > EW_MAX_EMAIL_SENT_COUNT) {
			$this->setMessage($Language->Phrase("ExceedMaxEmailExport"));
			return;
		}
		if ($sEmailMessage <> "") {
			$sEmailMessage = ew_RemoveXSS($sEmailMessage);
			$sEmailMessage .= ($sContentType == "url") ? "\r\n\r\n" : "<br><br>";
		}
		if ($sContentType == "url") {
			$sUrl = ew_ConvertFullUrl(ew_CurrentPage() . "?" . $this->ExportQueryString());
			$sEmailMessage .= $sUrl; // send URL only
		} else {
			$sEmailMessage .= $EmailContent; // send HTML
		}

		// Send email
		$Email = new cEmail();
		$Email->Sender = $sSender; // Sender
		$Email->Recipient = $sRecipient; // Recipient
		$Email->Cc = $sCc; // Cc
		$Email->Bcc = $sBcc; // Bcc
		$Email->Subject = $sEmailSubject; // Subject
		$Email->Content = $sEmailMessage; // Content
		$Email->Format = ($sContentType == "url") ? "text" : "html";
		$Email->Charset = EW_EMAIL_CHARSET;
		$EventArgs = array();
		$bEmailSent = FALSE;
		if ($AppConfirmView->Email_Sending($Email, $EventArgs))
			$bEmailSent = $Email->Send();

		// Check email sent status
		if ($bEmailSent) {

			// Update email sent count
			$_SESSION[EW_EXPORT_EMAIL_COUNTER]++;

			// Sent email success
			$this->setMessage($Language->Phrase("SendEmailSuccess"));
		} else {

			// Sent email failure
			$this->setMessage($Email->SendErrDescription);
		}
	}

	// Export QueryString
	function ExportQueryString() {
		global $AppConfirmView;

		// Initialize
		$sQry = "export=html";

		// Build QueryString for search
		if ($AppConfirmView->getSessionBasicSearchKeyword() <> "") {
			$sQry .= "&" . EW_TABLE_BASIC_SEARCH . "=" . $AppConfirmView->getSessionBasicSearchKeyword() . "&" . EW_TABLE_BASIC_SEARCH_TYPE . "=" . $AppConfirmView->getSessionBasicSearchType();
		}

		// Build QueryString for pager
		$sQry .= "&" . EW_TABLE_REC_PER_PAGE . "=" . $AppConfirmView->getRecordsPerPage() . "&" . EW_TABLE_START_REC . "=" . $AppConfirmView->getStartRecordNumber();
		return $sQry;
	}

	// Add search QueryString
	function AddSearchQueryString(&$Qry, &$Fld) {
		global $AppConfirmView;
		$FldParm = substr($Fld->FldVar, 2);
		$FldSearchValue = $AppConfirmView->GetAdvancedSearch("x_" . $FldParm);
		if (strval($FldSearchValue) <> "") {
			$Qry .= "&x_" . $FldParm . "=" . FldSearchValue .
				"&z_" . $FldParm . "=" . $AppConfirmView->GetAdvancedSearch("z_" . $FldParm);
		}
		$FldSearchValue2 = $AppConfirmView->GetAdvancedSearch("y_" . $FldParm);
		if (strval($FldSearchValue2) <> "") {
			$Qry .= "&v_" . $FldParm . "=" . $AppConfirmView->GetAdvancedSearch("v_" . $FldParm) .
				"&y_" . $FldParm . "=" . $FldSearchValue2 .
				"&w_" . $FldParm . "=" . $AppConfirmView->GetAdvancedSearch("w_" . $FldParm);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example: 
		//$this->ListOptions->Add("new");
		//$this->ListOptions->Items["new"]->OnLeft = TRUE; // Link on left
		//$this->ListOptions->MoveItem("new", 0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>

<?php
session_start();
ob_start();
?>
<?php include "phprptinc/ewrcfg4.php"; ?>
<?php include "phprptinc/ewmysql.php"; ?>
<?php include "phprptinc/ewrfn4.php"; ?>
<?php include "phprptinc/ewrusrfn.php"; ?>
<?php

// Global variable for table object
$Report_sponsored_students_programme_unit = NULL;

//
// Table class for Report_sponsored_students_programme_unit
//
class crReport_sponsored_students_programme_unit {
	var $TableVar = 'Report_sponsored_students_programme_unit';
	var $TableName = 'Report_sponsored_students_programme_unit';
	var $TableType = 'REPORT';
	var $ShowCurrentFilter = EWRPT_SHOW_CURRENT_FILTER;
	var $FilterPanelOption = EWRPT_FILTER_PANEL_OPTION;
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type

	// Table caption
	function TableCaption() {
		global $ReportLanguage;
		return $ReportLanguage->TablePhrase($this->TableVar, "TblCaption");
	}

	// Session Group Per Page
	function getGroupPerPage() {
		return @$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_grpperpage"];
	}

	function setGroupPerPage($v) {
		@$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_grpperpage"] = $v;
	}

	// Session Start Group
	function getStartGroup() {
		return @$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_start"];
	}

	function setStartGroup($v) {
		@$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_start"] = $v;
	}

	// Session Order By
	function getOrderBy() {
		return @$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_orderby"];
	}

	function setOrderBy($v) {
		@$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_orderby"] = $v;
	}

//	var $SelectLimit = TRUE;
	var $sponsored_student_id;
	var $app_submission_year;
	var $student_lastname;
	var $student_firstname;
	var $student_middlename;
	var $student_telephone_2;
	var $student_telephone_1;
	var $age;
	var $student_dob;
	var $student_gender;
	var $student_address;
	var $community;
	var $community_community_id;
	var $programarea_name;
	var $student_resident_programarea_id;
	var $District;
	var $community_districts_DistrictID;
	var $fields = array();
	var $Export; // Export
	var $ExportAll = FALSE;
	var $UseTokenInUrl = EWRPT_USE_TOKEN_IN_URL;
	var $RowType; // Row type
	var $RowTotalType; // Row total type
	var $RowTotalSubType; // Row total subtype
	var $RowGroupLevel; // Row group level
	var $RowAttrs = array(); // Row attributes

	// Reset CSS styles for table object
	function ResetCSS() {
    	$this->RowAttrs["style"] = "";
		$this->RowAttrs["class"] = "";
		foreach ($this->fields as $fld) {
			$fld->ResetCSS();
		}
	}

	//
	// Table class constructor
	//
	function crReport_sponsored_students_programme_unit() {
		global $ReportLanguage;

		// sponsored_student_id
		$this->sponsored_student_id = new crField('Report_sponsored_students_programme_unit', 'Report_sponsored_students_programme_unit', 'x_sponsored_student_id', 'sponsored_student_id', 'sponsored_student.sponsored_student_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->sponsored_student_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['sponsored_student_id'] =& $this->sponsored_student_id;
		$this->sponsored_student_id->DateFilter = "";
		$this->sponsored_student_id->SqlSelect = "";
		$this->sponsored_student_id->SqlOrderBy = "";

		// app_submission_year
		$this->app_submission_year = new crField('Report_sponsored_students_programme_unit', 'Report_sponsored_students_programme_unit', 'x_app_submission_year', 'app_submission_year', 'student_applicant.app_submission_year', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->app_submission_year->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['app_submission_year'] =& $this->app_submission_year;
		$this->app_submission_year->DateFilter = "";
		$this->app_submission_year->SqlSelect = "";
		$this->app_submission_year->SqlOrderBy = "";

		// student_lastname
		$this->student_lastname = new crField('Report_sponsored_students_programme_unit', 'Report_sponsored_students_programme_unit', 'x_student_lastname', 'student_lastname', 'sponsored_student.student_lastname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_lastname'] =& $this->student_lastname;
		$this->student_lastname->DateFilter = "";
		$this->student_lastname->SqlSelect = "";
		$this->student_lastname->SqlOrderBy = "";

		// student_firstname
		$this->student_firstname = new crField('Report_sponsored_students_programme_unit', 'Report_sponsored_students_programme_unit', 'x_student_firstname', 'student_firstname', 'sponsored_student.student_firstname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_firstname'] =& $this->student_firstname;
		$this->student_firstname->DateFilter = "";
		$this->student_firstname->SqlSelect = "";
		$this->student_firstname->SqlOrderBy = "";

		// student_middlename
		$this->student_middlename = new crField('Report_sponsored_students_programme_unit', 'Report_sponsored_students_programme_unit', 'x_student_middlename', 'student_middlename', 'sponsored_student.student_middlename', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_middlename'] =& $this->student_middlename;
		$this->student_middlename->DateFilter = "";
		$this->student_middlename->SqlSelect = "";
		$this->student_middlename->SqlOrderBy = "";

		// student_telephone_2
		$this->student_telephone_2 = new crField('Report_sponsored_students_programme_unit', 'Report_sponsored_students_programme_unit', 'x_student_telephone_2', 'student_telephone_2', 'student_applicant.student_telephone_2', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_telephone_2'] =& $this->student_telephone_2;
		$this->student_telephone_2->DateFilter = "";
		$this->student_telephone_2->SqlSelect = "";
		$this->student_telephone_2->SqlOrderBy = "";

		// student_telephone_1
		$this->student_telephone_1 = new crField('Report_sponsored_students_programme_unit', 'Report_sponsored_students_programme_unit', 'x_student_telephone_1', 'student_telephone_1', 'student_applicant.student_telephone_1', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_telephone_1'] =& $this->student_telephone_1;
		$this->student_telephone_1->DateFilter = "";
		$this->student_telephone_1->SqlSelect = "";
		$this->student_telephone_1->SqlOrderBy = "";

		// age
		$this->age = new crField('Report_sponsored_students_programme_unit', 'Report_sponsored_students_programme_unit', 'x_age', 'age', '(Year(CurDate()) - Year(student_applicant.student_dob))', 20, EWRPT_DATATYPE_NUMBER, -1);
		$this->age->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['age'] =& $this->age;
		$this->age->DateFilter = "";
		$this->age->SqlSelect = "";
		$this->age->SqlOrderBy = "";

		// student_dob
		$this->student_dob = new crField('Report_sponsored_students_programme_unit', 'Report_sponsored_students_programme_unit', 'x_student_dob', 'student_dob', 'student_applicant.student_dob', 135, EWRPT_DATATYPE_DATE, 5);
		$this->student_dob->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['student_dob'] =& $this->student_dob;
		$this->student_dob->DateFilter = "";
		$this->student_dob->SqlSelect = "";
		$this->student_dob->SqlOrderBy = "";

		// student_gender
		$this->student_gender = new crField('Report_sponsored_students_programme_unit', 'Report_sponsored_students_programme_unit', 'x_student_gender', 'student_gender', 'student_applicant.student_gender', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_gender'] =& $this->student_gender;
		$this->student_gender->DateFilter = "";
		$this->student_gender->SqlSelect = "";
		$this->student_gender->SqlOrderBy = "";

		// student_address
		$this->student_address = new crField('Report_sponsored_students_programme_unit', 'Report_sponsored_students_programme_unit', 'x_student_address', 'student_address', 'student_applicant.student_address', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_address'] =& $this->student_address;
		$this->student_address->DateFilter = "";
		$this->student_address->SqlSelect = "";
		$this->student_address->SqlOrderBy = "";

		// community
		$this->community = new crField('Report_sponsored_students_programme_unit', 'Report_sponsored_students_programme_unit', 'x_community', 'community', 'community.community', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['community'] =& $this->community;
		$this->community->DateFilter = "";
		$this->community->SqlSelect = "";
		$this->community->SqlOrderBy = "";

		// community_community_id
		$this->community_community_id = new crField('Report_sponsored_students_programme_unit', 'Report_sponsored_students_programme_unit', 'x_community_community_id', 'community_community_id', 'sponsored_student.community_community_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->community_community_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['community_community_id'] =& $this->community_community_id;
		$this->community_community_id->DateFilter = "";
		$this->community_community_id->SqlSelect = "";
		$this->community_community_id->SqlOrderBy = "";

		// programarea_name
		$this->programarea_name = new crField('Report_sponsored_students_programme_unit', 'Report_sponsored_students_programme_unit', 'x_programarea_name', 'programarea_name', 'programarea.programarea_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->programarea_name->GroupingFieldId = 1;
		$this->fields['programarea_name'] =& $this->programarea_name;
		$this->programarea_name->DateFilter = "";
		$this->programarea_name->SqlSelect = "";
		$this->programarea_name->SqlOrderBy = "";
		$this->programarea_name->FldGroupByType = "";
		$this->programarea_name->FldGroupInt = "0";
		$this->programarea_name->FldGroupSql = "";

		// student_resident_programarea_id
		$this->student_resident_programarea_id = new crField('Report_sponsored_students_programme_unit', 'Report_sponsored_students_programme_unit', 'x_student_resident_programarea_id', 'student_resident_programarea_id', 'sponsored_student.student_resident_programarea_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->student_resident_programarea_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['student_resident_programarea_id'] =& $this->student_resident_programarea_id;
		$this->student_resident_programarea_id->DateFilter = "";
		$this->student_resident_programarea_id->SqlSelect = "";
		$this->student_resident_programarea_id->SqlOrderBy = "";

		// District
		$this->District = new crField('Report_sponsored_students_programme_unit', 'Report_sponsored_students_programme_unit', 'x_District', 'District', 'districts.District', 200, EWRPT_DATATYPE_STRING, -1);
		$this->District->GroupingFieldId = 2;
		$this->fields['District'] =& $this->District;
		$this->District->DateFilter = "";
		$this->District->SqlSelect = "";
		$this->District->SqlOrderBy = "";
		$this->District->FldGroupByType = "";
		$this->District->FldGroupInt = "0";
		$this->District->FldGroupSql = "";

		// community_districts_DistrictID
		$this->community_districts_DistrictID = new crField('Report_sponsored_students_programme_unit', 'Report_sponsored_students_programme_unit', 'x_community_districts_DistrictID', 'community_districts_DistrictID', 'community.community_districts_DistrictID', 19, EWRPT_DATATYPE_NUMBER, -1);
		$this->community_districts_DistrictID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['community_districts_DistrictID'] =& $this->community_districts_DistrictID;
		$this->community_districts_DistrictID->DateFilter = "";
		$this->community_districts_DistrictID->SqlSelect = "";
		$this->community_districts_DistrictID->SqlOrderBy = "";
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
		} else {
			if ($ofld->GroupingFieldId == 0) $ofld->setSort("");
		}
	}

	// Get Sort SQL
	function SortSql() {
		$sDtlSortSql = "";
		$argrps = array();
		foreach ($this->fields as $fld) {
			if ($fld->getSort() <> "") {
				if ($fld->GroupingFieldId > 0) {
					if ($fld->FldGroupSql <> "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fld->FldExpression, $fld->FldGroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fld->FldExpression . " " . $fld->getSort();
				} else {
					if ($sDtlSortSql <> "") $sDtlSortSql .= ", ";
					$sDtlSortSql .= $fld->FldExpression . " " . $fld->getSort();
				}
			}
		}
		$sSortSql = "";
		foreach ($argrps as $grp) {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $grp;
		}
		if ($sDtlSortSql <> "") {
			if ($sSortSql <> "") $sSortSql .= ",";
			$sSortSql .= $sDtlSortSql;
		}
		return $sSortSql;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "sponsored_student Left Join student_applicant On sponsored_student.student_applicant_student_applicant_id = student_applicant.student_applicant_id Left Join community On sponsored_student.community_community_id = community.community_id Left Join programarea On sponsored_student.student_resident_programarea_id = programarea.programarea_id Left Join districts On community.community_districts_DistrictID = districts.DistrictID";
	}

	function SqlSelect() { // Select
		return "SELECT sponsored_student.student_firstname, sponsored_student.student_middlename, sponsored_student.student_lastname, sponsored_student.student_resident_programarea_id, student_applicant.student_telephone_1, student_applicant.student_telephone_2, (Year(CurDate()) - Year(student_applicant.student_dob)) As age, student_applicant.student_dob, student_applicant.app_submission_year, student_applicant.student_gender, student_applicant.student_address, sponsored_student.sponsored_student_id, community.community, sponsored_student.community_community_id, programarea.programarea_name, districts.District, community.community_districts_DistrictID FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		return "";
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "programarea.programarea_name ASC, districts.District ASC";
	}

	// Table Level Group SQL
	function SqlFirstGroupField() {
		return "programarea.programarea_name";
	}

	function SqlSelectGroup() {
		return "SELECT DISTINCT " . $this->SqlFirstGroupField() . " FROM " . $this->SqlFrom();
	}

	function SqlOrderByGroup() {
		return "programarea.programarea_name ASC";
	}

	function SqlSelectAgg() {
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlAggPfx() {
		return "";
	}

	function SqlAggSfx() {
		return "";
	}

	function SqlSelectCount() {
		return "SELECT COUNT(*) FROM " . $this->SqlFrom();
	}

	// Sort URL
	function SortUrl(&$fld) {
		return "";
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = "";
		foreach ($this->RowAttrs as $k => $v) {
			if (trim($v) <> "")
				$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
		}
		return $sAtt;
	}

	// Field object by fldvar
	function &fields($fldvar) {
		return $this->fields[$fldvar];
	}

	// Table level events
	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Load Custom Filters event
	function CustomFilters_Load() {

		// Enter your code here	
		// ewrpt_RegisterCustomFilter($this-><Field>, 'LastMonth', 'Last Month', 'GetLastMonthFilter'); // Date example
		// ewrpt_RegisterCustomFilter($this-><Field>, 'StartsWithA', 'Starts With A', 'GetStartsWithAFilter'); // String example

	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//global $MyTable;
		//$MyTable->MyField1->SearchValue = "your search criteria"; // Search value

	}

	// Chart Rendering event
	function Chart_Rendering(&$chart) {

		// var_dump($chart);
	}

	// Chart Rendered event
	function Chart_Rendered($chart, &$chartxml) {

		//var_dump($chart);
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$Report_sponsored_students_programme_unit_summary = new crReport_sponsored_students_programme_unit_summary();
$Page =& $Report_sponsored_students_programme_unit_summary;

// Page init
$Report_sponsored_students_programme_unit_summary->Page_Init();

// Page main
$Report_sponsored_students_programme_unit_summary->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<script type="text/javascript">

// Create page object
var Report_sponsored_students_programme_unit_summary = new ewrpt_Page("Report_sponsored_students_programme_unit_summary");

// page properties
Report_sponsored_students_programme_unit_summary.PageID = "summary"; // page ID
Report_sponsored_students_programme_unit_summary.FormID = "fReport_sponsored_students_programme_unitsummaryfilter"; // form ID
var EWRPT_PAGE_ID = Report_sponsored_students_programme_unit_summary.PageID;

// extend page with ValidateForm function
Report_sponsored_students_programme_unit_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
Report_sponsored_students_programme_unit_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
Report_sponsored_students_programme_unit_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Report_sponsored_students_programme_unit_summary.ValidateRequired = false; // no JavaScript validation
<?php } ?>
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php $Report_sponsored_students_programme_unit_summary->ShowPageHeader(); ?>
<?php $Report_sponsored_students_programme_unit_summary->ShowMessage(); ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php echo $Report_sponsored_students_programme_unit->TableCaption() ?>
<?php if ($Report_sponsored_students_programme_unit_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="Report_sponsored_students_programme_unitsmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>
<br /><br />
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<!-- summary report starts -->
<div id="report_summary">
<?php
if ($Report_sponsored_students_programme_unit->FilterPanelOption == 2 || ($Report_sponsored_students_programme_unit->FilterPanelOption == 3 && $Report_sponsored_students_programme_unit_summary->FilterApplied) || $Report_sponsored_students_programme_unit_summary->Filter == "0=101") {
	$sButtonImage = "phprptimages/collapse.gif";
	$sDivDisplay = "";
} else {
	$sButtonImage = "phprptimages/expand.gif";
	$sDivDisplay = " style=\"display: none;\"";
}
?>
<a href="javascript:ewrpt_ToggleFilterPanel();" style="text-decoration: none;"><img id="ewrptToggleFilterImg" src="<?php echo $sButtonImage ?>" alt="" width="9" height="9" border="0"></a><span class="phpreportmaker">&nbsp;<?php echo $ReportLanguage->Phrase("Filters") ?></span><br /><br />
<div id="ewrptExtFilterPanel"<?php echo $sDivDisplay ?>>
<!-- Search form (begin) -->
<form name="fReport_sponsored_students_programme_unitsummaryfilter" id="fReport_sponsored_students_programme_unitsummaryfilter" action="Report_sponsored_students_programme_unitsmry.php" class="ewForm" onsubmit="return Report_sponsored_students_programme_unit_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $Report_sponsored_students_programme_unit->app_submission_year->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_app_submission_year" id="sv_app_submission_year"<?php echo ($Report_sponsored_students_programme_unit_summary->ClearExtFilter == 'Report_sponsored_students_programme_unit_app_submission_year') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Report_sponsored_students_programme_unit->app_submission_year->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("PleaseSelect"); ?></option>
<?php

// Popup filter
$cntf = is_array($Report_sponsored_students_programme_unit->app_submission_year->CustomFilters) ? count($Report_sponsored_students_programme_unit->app_submission_year->CustomFilters) : 0;
$cntd = is_array($Report_sponsored_students_programme_unit->app_submission_year->DropDownList) ? count($Report_sponsored_students_programme_unit->app_submission_year->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Report_sponsored_students_programme_unit->app_submission_year->CustomFilters[$i]->FldName == 'app_submission_year') {
?>
		<option value="<?php echo "@@" . $Report_sponsored_students_programme_unit->app_submission_year->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Report_sponsored_students_programme_unit->app_submission_year->DropDownValue, "@@" . $Report_sponsored_students_programme_unit->app_submission_year->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Report_sponsored_students_programme_unit->app_submission_year->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Report_sponsored_students_programme_unit->app_submission_year->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Report_sponsored_students_programme_unit->app_submission_year->DropDownValue, $Report_sponsored_students_programme_unit->app_submission_year->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Report_sponsored_students_programme_unit->app_submission_year->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Report_sponsored_students_programme_unit->student_gender->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_student_gender" id="sv_student_gender"<?php echo ($Report_sponsored_students_programme_unit_summary->ClearExtFilter == 'Report_sponsored_students_programme_unit_student_gender') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Report_sponsored_students_programme_unit->student_gender->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("PleaseSelect"); ?></option>
<?php

// Popup filter
$cntf = is_array($Report_sponsored_students_programme_unit->student_gender->CustomFilters) ? count($Report_sponsored_students_programme_unit->student_gender->CustomFilters) : 0;
$cntd = is_array($Report_sponsored_students_programme_unit->student_gender->DropDownList) ? count($Report_sponsored_students_programme_unit->student_gender->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Report_sponsored_students_programme_unit->student_gender->CustomFilters[$i]->FldName == 'student_gender') {
?>
		<option value="<?php echo "@@" . $Report_sponsored_students_programme_unit->student_gender->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Report_sponsored_students_programme_unit->student_gender->DropDownValue, "@@" . $Report_sponsored_students_programme_unit->student_gender->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Report_sponsored_students_programme_unit->student_gender->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Report_sponsored_students_programme_unit->student_gender->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Report_sponsored_students_programme_unit->student_gender->DropDownValue, $Report_sponsored_students_programme_unit->student_gender->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Report_sponsored_students_programme_unit->student_gender->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Report_sponsored_students_programme_unit->programarea_name->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_programarea_name" id="sv_programarea_name"<?php echo ($Report_sponsored_students_programme_unit_summary->ClearExtFilter == 'Report_sponsored_students_programme_unit_programarea_name') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Report_sponsored_students_programme_unit->programarea_name->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("PleaseSelect"); ?></option>
<?php

// Popup filter
$cntf = is_array($Report_sponsored_students_programme_unit->programarea_name->CustomFilters) ? count($Report_sponsored_students_programme_unit->programarea_name->CustomFilters) : 0;
$cntd = is_array($Report_sponsored_students_programme_unit->programarea_name->DropDownList) ? count($Report_sponsored_students_programme_unit->programarea_name->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Report_sponsored_students_programme_unit->programarea_name->CustomFilters[$i]->FldName == 'programarea_name') {
?>
		<option value="<?php echo "@@" . $Report_sponsored_students_programme_unit->programarea_name->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Report_sponsored_students_programme_unit->programarea_name->DropDownValue, "@@" . $Report_sponsored_students_programme_unit->programarea_name->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Report_sponsored_students_programme_unit->programarea_name->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Report_sponsored_students_programme_unit->programarea_name->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Report_sponsored_students_programme_unit->programarea_name->DropDownValue, $Report_sponsored_students_programme_unit->programarea_name->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Report_sponsored_students_programme_unit->programarea_name->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
</table>
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo $ReportLanguage->Phrase("Search") ?>">&nbsp;
			<input type="Reset" name="Reset" id="Reset" value="<?php echo $ReportLanguage->Phrase("Reset") ?>">&nbsp;
		</span></td>
	</tr>
</table>
</form>
<!-- Search form (end) -->
</div>
<br />
<?php if ($Report_sponsored_students_programme_unit->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $Report_sponsored_students_programme_unit_summary->ShowFilterList() ?>
</div>
<br />
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<!-- Report Grid (Begin) -->
<div class="ewGridMiddlePanel">
<table class="ewTable ewTableSeparate" cellspacing="0">
<?php

// Set the last group to display if not export all
if ($Report_sponsored_students_programme_unit->ExportAll && $Report_sponsored_students_programme_unit->Export <> "") {
	$Report_sponsored_students_programme_unit_summary->StopGrp = $Report_sponsored_students_programme_unit_summary->TotalGrps;
} else {
	$Report_sponsored_students_programme_unit_summary->StopGrp = $Report_sponsored_students_programme_unit_summary->StartGrp + $Report_sponsored_students_programme_unit_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Report_sponsored_students_programme_unit_summary->StopGrp) > intval($Report_sponsored_students_programme_unit_summary->TotalGrps))
	$Report_sponsored_students_programme_unit_summary->StopGrp = $Report_sponsored_students_programme_unit_summary->TotalGrps;
$Report_sponsored_students_programme_unit_summary->RecCount = 0;

// Get first row
if ($Report_sponsored_students_programme_unit_summary->TotalGrps > 0) {
	$Report_sponsored_students_programme_unit_summary->GetGrpRow(1);
	$Report_sponsored_students_programme_unit_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $Report_sponsored_students_programme_unit_summary->GrpCount <= $Report_sponsored_students_programme_unit_summary->DisplayGrps) || $Report_sponsored_students_programme_unit_summary->ShowFirstHeader) {

	// Show header
	if ($Report_sponsored_students_programme_unit_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
<?php if ($Report_sponsored_students_programme_unit->Export <> "") { ?>
<?php echo $Report_sponsored_students_programme_unit->programarea_name->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->programarea_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report_sponsored_students_programme_unit->programarea_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->programarea_name) ?>',0);"><?php echo $Report_sponsored_students_programme_unit->programarea_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report_sponsored_students_programme_unit->programarea_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report_sponsored_students_programme_unit->programarea_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Report_sponsored_students_programme_unit->Export <> "") { ?>
<?php echo $Report_sponsored_students_programme_unit->District->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->District) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report_sponsored_students_programme_unit->District->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->District) ?>',0);"><?php echo $Report_sponsored_students_programme_unit->District->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report_sponsored_students_programme_unit->District->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report_sponsored_students_programme_unit->District->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Report_sponsored_students_programme_unit->Export <> "") { ?>
<?php echo $Report_sponsored_students_programme_unit->sponsored_student_id->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->sponsored_student_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report_sponsored_students_programme_unit->sponsored_student_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->sponsored_student_id) ?>',0);"><?php echo $Report_sponsored_students_programme_unit->sponsored_student_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report_sponsored_students_programme_unit->sponsored_student_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report_sponsored_students_programme_unit->sponsored_student_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Report_sponsored_students_programme_unit->Export <> "") { ?>
<?php echo $Report_sponsored_students_programme_unit->app_submission_year->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->app_submission_year) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report_sponsored_students_programme_unit->app_submission_year->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->app_submission_year) ?>',0);"><?php echo $Report_sponsored_students_programme_unit->app_submission_year->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report_sponsored_students_programme_unit->app_submission_year->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report_sponsored_students_programme_unit->app_submission_year->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Report_sponsored_students_programme_unit->Export <> "") { ?>
<?php echo $Report_sponsored_students_programme_unit->student_lastname->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_lastname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report_sponsored_students_programme_unit->student_lastname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_lastname) ?>',0);"><?php echo $Report_sponsored_students_programme_unit->student_lastname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report_sponsored_students_programme_unit->student_lastname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report_sponsored_students_programme_unit->student_lastname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Report_sponsored_students_programme_unit->Export <> "") { ?>
<?php echo $Report_sponsored_students_programme_unit->student_firstname->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_firstname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report_sponsored_students_programme_unit->student_firstname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_firstname) ?>',0);"><?php echo $Report_sponsored_students_programme_unit->student_firstname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report_sponsored_students_programme_unit->student_firstname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report_sponsored_students_programme_unit->student_firstname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Report_sponsored_students_programme_unit->Export <> "") { ?>
<?php echo $Report_sponsored_students_programme_unit->student_middlename->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_middlename) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report_sponsored_students_programme_unit->student_middlename->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_middlename) ?>',0);"><?php echo $Report_sponsored_students_programme_unit->student_middlename->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report_sponsored_students_programme_unit->student_middlename->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report_sponsored_students_programme_unit->student_middlename->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Report_sponsored_students_programme_unit->Export <> "") { ?>
<?php echo $Report_sponsored_students_programme_unit->student_telephone_2->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_telephone_2) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report_sponsored_students_programme_unit->student_telephone_2->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_telephone_2) ?>',0);"><?php echo $Report_sponsored_students_programme_unit->student_telephone_2->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report_sponsored_students_programme_unit->student_telephone_2->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report_sponsored_students_programme_unit->student_telephone_2->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Report_sponsored_students_programme_unit->Export <> "") { ?>
<?php echo $Report_sponsored_students_programme_unit->student_telephone_1->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_telephone_1) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report_sponsored_students_programme_unit->student_telephone_1->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_telephone_1) ?>',0);"><?php echo $Report_sponsored_students_programme_unit->student_telephone_1->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report_sponsored_students_programme_unit->student_telephone_1->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report_sponsored_students_programme_unit->student_telephone_1->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Report_sponsored_students_programme_unit->Export <> "") { ?>
<?php echo $Report_sponsored_students_programme_unit->age->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->age) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report_sponsored_students_programme_unit->age->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->age) ?>',0);"><?php echo $Report_sponsored_students_programme_unit->age->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report_sponsored_students_programme_unit->age->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report_sponsored_students_programme_unit->age->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Report_sponsored_students_programme_unit->Export <> "") { ?>
<?php echo $Report_sponsored_students_programme_unit->student_dob->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_dob) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report_sponsored_students_programme_unit->student_dob->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_dob) ?>',0);"><?php echo $Report_sponsored_students_programme_unit->student_dob->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report_sponsored_students_programme_unit->student_dob->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report_sponsored_students_programme_unit->student_dob->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Report_sponsored_students_programme_unit->Export <> "") { ?>
<?php echo $Report_sponsored_students_programme_unit->student_gender->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_gender) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report_sponsored_students_programme_unit->student_gender->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_gender) ?>',0);"><?php echo $Report_sponsored_students_programme_unit->student_gender->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report_sponsored_students_programme_unit->student_gender->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report_sponsored_students_programme_unit->student_gender->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Report_sponsored_students_programme_unit->Export <> "") { ?>
<?php echo $Report_sponsored_students_programme_unit->student_address->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_address) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report_sponsored_students_programme_unit->student_address->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_address) ?>',0);"><?php echo $Report_sponsored_students_programme_unit->student_address->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report_sponsored_students_programme_unit->student_address->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report_sponsored_students_programme_unit->student_address->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Report_sponsored_students_programme_unit->Export <> "") { ?>
<?php echo $Report_sponsored_students_programme_unit->community->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->community) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report_sponsored_students_programme_unit->community->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->community) ?>',0);"><?php echo $Report_sponsored_students_programme_unit->community->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report_sponsored_students_programme_unit->community->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report_sponsored_students_programme_unit->community->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Report_sponsored_students_programme_unit->Export <> "") { ?>
<?php echo $Report_sponsored_students_programme_unit->student_resident_programarea_id->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_resident_programarea_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report_sponsored_students_programme_unit->student_resident_programarea_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report_sponsored_students_programme_unit->SortUrl($Report_sponsored_students_programme_unit->student_resident_programarea_id) ?>',0);"><?php echo $Report_sponsored_students_programme_unit->student_resident_programarea_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report_sponsored_students_programme_unit->student_resident_programarea_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report_sponsored_students_programme_unit->student_resident_programarea_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$Report_sponsored_students_programme_unit_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($Report_sponsored_students_programme_unit->programarea_name, $Report_sponsored_students_programme_unit->SqlFirstGroupField(), $Report_sponsored_students_programme_unit->programarea_name->GroupValue());
	if ($Report_sponsored_students_programme_unit_summary->Filter != "")
		$sWhere = "($Report_sponsored_students_programme_unit_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($Report_sponsored_students_programme_unit->SqlSelect(), $Report_sponsored_students_programme_unit->SqlWhere(), $Report_sponsored_students_programme_unit->SqlGroupBy(), $Report_sponsored_students_programme_unit->SqlHaving(), $Report_sponsored_students_programme_unit->SqlOrderBy(), $sWhere, $Report_sponsored_students_programme_unit_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$Report_sponsored_students_programme_unit_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Report_sponsored_students_programme_unit_summary->RecCount++;

		// Render detail row
		$Report_sponsored_students_programme_unit->ResetCSS();
		$Report_sponsored_students_programme_unit->RowType = EWRPT_ROWTYPE_DETAIL;
		$Report_sponsored_students_programme_unit_summary->RenderRow();
?>
	<tr<?php echo $Report_sponsored_students_programme_unit->RowAttributes(); ?>>
		<td<?php echo $Report_sponsored_students_programme_unit->programarea_name->CellAttributes(); ?>><div<?php echo $Report_sponsored_students_programme_unit->programarea_name->ViewAttributes(); ?>><?php echo $Report_sponsored_students_programme_unit->programarea_name->GroupViewValue; ?></div></td>
		<td<?php echo $Report_sponsored_students_programme_unit->District->CellAttributes(); ?>><div<?php echo $Report_sponsored_students_programme_unit->District->ViewAttributes(); ?>><?php echo $Report_sponsored_students_programme_unit->District->GroupViewValue; ?></div></td>
		<td<?php echo $Report_sponsored_students_programme_unit->sponsored_student_id->CellAttributes() ?>>
<div<?php echo $Report_sponsored_students_programme_unit->sponsored_student_id->ViewAttributes(); ?>><?php echo $Report_sponsored_students_programme_unit->sponsored_student_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report_sponsored_students_programme_unit->app_submission_year->CellAttributes() ?>>
<div<?php echo $Report_sponsored_students_programme_unit->app_submission_year->ViewAttributes(); ?>><?php echo $Report_sponsored_students_programme_unit->app_submission_year->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report_sponsored_students_programme_unit->student_lastname->CellAttributes() ?>>
<div<?php echo $Report_sponsored_students_programme_unit->student_lastname->ViewAttributes(); ?>><?php echo $Report_sponsored_students_programme_unit->student_lastname->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report_sponsored_students_programme_unit->student_firstname->CellAttributes() ?>>
<div<?php echo $Report_sponsored_students_programme_unit->student_firstname->ViewAttributes(); ?>><?php echo $Report_sponsored_students_programme_unit->student_firstname->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report_sponsored_students_programme_unit->student_middlename->CellAttributes() ?>>
<div<?php echo $Report_sponsored_students_programme_unit->student_middlename->ViewAttributes(); ?>><?php echo $Report_sponsored_students_programme_unit->student_middlename->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report_sponsored_students_programme_unit->student_telephone_2->CellAttributes() ?>>
<div<?php echo $Report_sponsored_students_programme_unit->student_telephone_2->ViewAttributes(); ?>><?php echo $Report_sponsored_students_programme_unit->student_telephone_2->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report_sponsored_students_programme_unit->student_telephone_1->CellAttributes() ?>>
<div<?php echo $Report_sponsored_students_programme_unit->student_telephone_1->ViewAttributes(); ?>><?php echo $Report_sponsored_students_programme_unit->student_telephone_1->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report_sponsored_students_programme_unit->age->CellAttributes() ?>>
<div<?php echo $Report_sponsored_students_programme_unit->age->ViewAttributes(); ?>><?php echo $Report_sponsored_students_programme_unit->age->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report_sponsored_students_programme_unit->student_dob->CellAttributes() ?>>
<div<?php echo $Report_sponsored_students_programme_unit->student_dob->ViewAttributes(); ?>><?php echo $Report_sponsored_students_programme_unit->student_dob->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report_sponsored_students_programme_unit->student_gender->CellAttributes() ?>>
<div<?php echo $Report_sponsored_students_programme_unit->student_gender->ViewAttributes(); ?>><?php echo $Report_sponsored_students_programme_unit->student_gender->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report_sponsored_students_programme_unit->student_address->CellAttributes() ?>>
<div<?php echo $Report_sponsored_students_programme_unit->student_address->ViewAttributes(); ?>><?php echo $Report_sponsored_students_programme_unit->student_address->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report_sponsored_students_programme_unit->community->CellAttributes() ?>>
<div<?php echo $Report_sponsored_students_programme_unit->community->ViewAttributes(); ?>><?php echo $Report_sponsored_students_programme_unit->community->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report_sponsored_students_programme_unit->student_resident_programarea_id->CellAttributes() ?>>
<div<?php echo $Report_sponsored_students_programme_unit->student_resident_programarea_id->ViewAttributes(); ?>><?php echo $Report_sponsored_students_programme_unit->student_resident_programarea_id->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$Report_sponsored_students_programme_unit_summary->AccumulateSummary();

		// Get next record
		$Report_sponsored_students_programme_unit_summary->GetRow(2);

		// Show Footers
?>
<?php
	} // End detail records loop
?>
<?php

	// Next group
	$Report_sponsored_students_programme_unit_summary->GetGrpRow(2);
	$Report_sponsored_students_programme_unit_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php if (intval(@$Report_sponsored_students_programme_unit_summary->Cnt[0][13]) > 0) { ?>
<?php
	$Report_sponsored_students_programme_unit->ResetCSS();
	$Report_sponsored_students_programme_unit->RowType = EWRPT_ROWTYPE_TOTAL;
	$Report_sponsored_students_programme_unit->RowTotalType = EWRPT_ROWTOTAL_PAGE;
	$Report_sponsored_students_programme_unit->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Report_sponsored_students_programme_unit->RowAttrs["class"] = "ewRptPageSummary";
	$Report_sponsored_students_programme_unit_summary->RenderRow();
?>
	<tr<?php echo $Report_sponsored_students_programme_unit->RowAttributes(); ?>><td colspan="15"><?php echo $ReportLanguage->Phrase("RptPageTotal") ?> (<?php echo ewrpt_FormatNumber($Report_sponsored_students_programme_unit_summary->Cnt[0][13],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
	<!-- tr class="ewRptPageSummary"><td colspan="15"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
<?php } ?>
<?php
if ($Report_sponsored_students_programme_unit_summary->TotalGrps > 0) {
	$Report_sponsored_students_programme_unit->ResetCSS();
	$Report_sponsored_students_programme_unit->RowType = EWRPT_ROWTYPE_TOTAL;
	$Report_sponsored_students_programme_unit->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$Report_sponsored_students_programme_unit->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Report_sponsored_students_programme_unit->RowAttrs["class"] = "ewRptGrandSummary";
	$Report_sponsored_students_programme_unit_summary->RenderRow();
?>
	<!-- tr><td colspan="15"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $Report_sponsored_students_programme_unit->RowAttributes(); ?>><td colspan="15"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($Report_sponsored_students_programme_unit_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
	</tfoot>
</table>
</div>
<div class="ewGridLowerPanel">
<form action="Report_sponsored_students_programme_unitsmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Report_sponsored_students_programme_unit_summary->StartGrp, $Report_sponsored_students_programme_unit_summary->DisplayGrps, $Report_sponsored_students_programme_unit_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Report_sponsored_students_programme_unitsmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Report_sponsored_students_programme_unitsmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Report_sponsored_students_programme_unitsmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Report_sponsored_students_programme_unitsmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/lastdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpreportmaker">&nbsp;<?php echo $ReportLanguage->Phrase("of") ?> <?php echo $Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Record") ?> <?php echo $Pager->FromIndex ?> <?php echo $ReportLanguage->Phrase("To") ?> <?php echo $Pager->ToIndex ?> <?php echo $ReportLanguage->Phrase("Of") ?> <?php echo $Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Report_sponsored_students_programme_unit_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Report_sponsored_students_programme_unit_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Report_sponsored_students_programme_unit_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Report_sponsored_students_programme_unit_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Report_sponsored_students_programme_unit_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Report_sponsored_students_programme_unit_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Report_sponsored_students_programme_unit_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Report_sponsored_students_programme_unit_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Report_sponsored_students_programme_unit_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Report_sponsored_students_programme_unit_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Report_sponsored_students_programme_unit->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
</select>
		</span></td>
<?php } ?>
	</tr>
</table>
</form>
</div>
</td></tr></table>
</div>
<!-- Summary Report Ends -->
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php $Report_sponsored_students_programme_unit_summary->ShowPageFooter(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "phprptinc/footer.php"; ?>
<?php
$Report_sponsored_students_programme_unit_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crReport_sponsored_students_programme_unit_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'Report_sponsored_students_programme_unit';

	// Page object name
	var $PageObjName = 'Report_sponsored_students_programme_unit_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $Report_sponsored_students_programme_unit;
		if ($Report_sponsored_students_programme_unit->UseTokenInUrl) $PageUrl .= "t=" . $Report_sponsored_students_programme_unit->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Export URLs
	var $ExportPrintUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EWRPT_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EWRPT_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EWRPT_SESSION_MESSAGE] .= "<br />" . $v;
		} else {
			$_SESSION[EWRPT_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EWRPT_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p><span class=\"phpreportmaker\">" . $sHeader . "</span></p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p><span class=\"phpreportmaker\">" . $sFooter . "</span></p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $Report_sponsored_students_programme_unit;
		if ($Report_sponsored_students_programme_unit->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($Report_sponsored_students_programme_unit->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($Report_sponsored_students_programme_unit->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crReport_sponsored_students_programme_unit_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (Report_sponsored_students_programme_unit)
		$GLOBALS["Report_sponsored_students_programme_unit"] = new crReport_sponsored_students_programme_unit();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'Report_sponsored_students_programme_unit', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new crTimer();

		// Open connection
		$conn = ewrpt_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $ReportLanguage, $Security;
		global $Report_sponsored_students_programme_unit;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$Report_sponsored_students_programme_unit->Export = $_GET["export"];
	}
	$gsExport = $Report_sponsored_students_programme_unit->Export; // Get export parameter, used in header
	$gsExportFile = $Report_sponsored_students_programme_unit->TableVar; // Get export file, used in header

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
		global $ReportLanguage;
		global $Report_sponsored_students_programme_unit;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($Report_sponsored_students_programme_unit->Export == "email") {
			$sContent = ob_get_contents();
			$this->ExportEmail($sContent);
			ob_end_clean();

			 // Close connection
			$conn->Close();
			header("Location: " . ewrpt_CurrentPage());
			exit();
		}

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EWRPT_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Initialize common variables
	// Paging variables

	var $RecCount = 0; // Record count
	var $StartGrp = 0; // Start group
	var $StopGrp = 0; // Stop group
	var $TotalGrps = 0; // Total groups
	var $GrpCount = 0; // Group count
	var $DisplayGrps = 3; // Groups per page
	var $GrpRange = 10;
	var $Sort = "";
	var $Filter = "";
	var $UserIDFilter = "";

	// Clear field for ext filter
	var $ClearExtFilter = "";
	var $FilterApplied;
	var $ShowFirstHeader;
	var $Cnt, $Col, $Val, $Smry, $Mn, $Mx, $GrandSmry, $GrandMn, $GrandMx;
	var $TotCount;

	//
	// Page main
	//
	function Page_Main() {
		global $Report_sponsored_students_programme_unit;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 14;
		$nGrps = 3;
		$this->Val = ewrpt_InitArray($nDtls, 0);
		$this->Cnt = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Smry = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Mn = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->Mx = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->GrandSmry = ewrpt_InitArray($nDtls, 0);
		$this->GrandMn = ewrpt_InitArray($nDtls, NULL);
		$this->GrandMx = ewrpt_InitArray($nDtls, NULL);

		// Set up if accumulation required
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$Report_sponsored_students_programme_unit->CustomFilters_Load();

		// Build extended filter
		$sExtendedFilter = $this->GetExtendedFilter();
		if ($sExtendedFilter <> "") {
			if ($this->Filter <> "")
  				$this->Filter = "($this->Filter) AND ($sExtendedFilter)";
			else
				$this->Filter = $sExtendedFilter;
		}

		// Build popup filter
		$sPopupFilter = $this->GetPopupFilter();

		//ewrpt_SetDebugMsg("popup filter: " . $sPopupFilter);
		if ($sPopupFilter <> "") {
			if ($this->Filter <> "")
				$this->Filter = "($this->Filter) AND ($sPopupFilter)";
			else
				$this->Filter = $sPopupFilter;
		}

		// Check if filter applied
		$this->FilterApplied = $this->CheckFilter();

		// Get sort
		$this->Sort = $this->GetSort();

		// Get total group count
		$sGrpSort = ewrpt_UpdateSortFields($Report_sponsored_students_programme_unit->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($Report_sponsored_students_programme_unit->SqlSelectGroup(), $Report_sponsored_students_programme_unit->SqlWhere(), $Report_sponsored_students_programme_unit->SqlGroupBy(), $Report_sponsored_students_programme_unit->SqlHaving(), $Report_sponsored_students_programme_unit->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($Report_sponsored_students_programme_unit->ExportAll && $Report_sponsored_students_programme_unit->Export <> "")
		    $this->DisplayGrps = $this->TotalGrps;
		else
			$this->SetUpStartGroup(); 

		// Get current page groups
		$rsgrp = $this->GetGrpRs($sSql, $this->StartGrp, $this->DisplayGrps);

		// Init detail recordset
		$rs = NULL;
	}

	// Check level break
	function ChkLvlBreak($lvl) {
		global $Report_sponsored_students_programme_unit;
		switch ($lvl) {
			case 1:
				return (is_null($Report_sponsored_students_programme_unit->programarea_name->CurrentValue) && !is_null($Report_sponsored_students_programme_unit->programarea_name->OldValue)) ||
					(!is_null($Report_sponsored_students_programme_unit->programarea_name->CurrentValue) && is_null($Report_sponsored_students_programme_unit->programarea_name->OldValue)) ||
					($Report_sponsored_students_programme_unit->programarea_name->GroupValue() <> $Report_sponsored_students_programme_unit->programarea_name->GroupOldValue());
			case 2:
				return (is_null($Report_sponsored_students_programme_unit->District->CurrentValue) && !is_null($Report_sponsored_students_programme_unit->District->OldValue)) ||
					(!is_null($Report_sponsored_students_programme_unit->District->CurrentValue) && is_null($Report_sponsored_students_programme_unit->District->OldValue)) ||
					($Report_sponsored_students_programme_unit->District->GroupValue() <> $Report_sponsored_students_programme_unit->District->GroupOldValue()) || $this->ChkLvlBreak(1); // Recurse upper level
		}
	}

	// Accummulate summary
	function AccumulateSummary() {
		$cntx = count($this->Smry);
		for ($ix = 0; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				$this->Cnt[$ix][$iy]++;
				if ($this->Col[$iy]) {
					$valwrk = $this->Val[$iy];
					if (is_null($valwrk) || !is_numeric($valwrk)) {

						// skip
					} else {
						$this->Smry[$ix][$iy] += $valwrk;
						if (is_null($this->Mn[$ix][$iy])) {
							$this->Mn[$ix][$iy] = $valwrk;
							$this->Mx[$ix][$iy] = $valwrk;
						} else {
							if ($this->Mn[$ix][$iy] > $valwrk) $this->Mn[$ix][$iy] = $valwrk;
							if ($this->Mx[$ix][$iy] < $valwrk) $this->Mx[$ix][$iy] = $valwrk;
						}
					}
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = 1; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0]++;
		}
	}

	// Reset level summary
	function ResetLevelSummary($lvl) {

		// Clear summary values
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				$this->Cnt[$ix][$iy] = 0;
				if ($this->Col[$iy]) {
					$this->Smry[$ix][$iy] = 0;
					$this->Mn[$ix][$iy] = NULL;
					$this->Mx[$ix][$iy] = NULL;
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0] = 0;
		}

		// Reset record count
		$this->RecCount = 0;
	}

	// Accummulate grand summary
	function AccumulateGrandSummary() {
		$this->Cnt[0][0]++;
		$cntgs = count($this->GrandSmry);
		for ($iy = 1; $iy < $cntgs; $iy++) {
			if ($this->Col[$iy]) {
				$valwrk = $this->Val[$iy];
				if (is_null($valwrk) || !is_numeric($valwrk)) {

					// skip
				} else {
					$this->GrandSmry[$iy] += $valwrk;
					if (is_null($this->GrandMn[$iy])) {
						$this->GrandMn[$iy] = $valwrk;
						$this->GrandMx[$iy] = $valwrk;
					} else {
						if ($this->GrandMn[$iy] > $valwrk) $this->GrandMn[$iy] = $valwrk;
						if ($this->GrandMx[$iy] < $valwrk) $this->GrandMx[$iy] = $valwrk;
					}
				}
			}
		}
	}

	// Get group count
	function GetGrpCnt($sql) {
		global $conn;
		global $Report_sponsored_students_programme_unit;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $Report_sponsored_students_programme_unit;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $Report_sponsored_students_programme_unit;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$Report_sponsored_students_programme_unit->programarea_name->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$Report_sponsored_students_programme_unit->programarea_name->setDbValue($rsgrp->fields[0]);
		if ($rsgrp->EOF) {
			$Report_sponsored_students_programme_unit->programarea_name->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $Report_sponsored_students_programme_unit;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$Report_sponsored_students_programme_unit->sponsored_student_id->setDbValue($rs->fields('sponsored_student_id'));
			$Report_sponsored_students_programme_unit->app_submission_year->setDbValue($rs->fields('app_submission_year'));
			$Report_sponsored_students_programme_unit->student_lastname->setDbValue($rs->fields('student_lastname'));
			$Report_sponsored_students_programme_unit->student_firstname->setDbValue($rs->fields('student_firstname'));
			$Report_sponsored_students_programme_unit->student_middlename->setDbValue($rs->fields('student_middlename'));
			$Report_sponsored_students_programme_unit->student_telephone_2->setDbValue($rs->fields('student_telephone_2'));
			$Report_sponsored_students_programme_unit->student_telephone_1->setDbValue($rs->fields('student_telephone_1'));
			$Report_sponsored_students_programme_unit->age->setDbValue($rs->fields('age'));
			$Report_sponsored_students_programme_unit->student_dob->setDbValue($rs->fields('student_dob'));
			$Report_sponsored_students_programme_unit->student_gender->setDbValue($rs->fields('student_gender'));
			$Report_sponsored_students_programme_unit->student_address->setDbValue($rs->fields('student_address'));
			$Report_sponsored_students_programme_unit->community->setDbValue($rs->fields('community'));
			$Report_sponsored_students_programme_unit->community_community_id->setDbValue($rs->fields('community_community_id'));
			if ($opt <> 1) {
				if (is_array($Report_sponsored_students_programme_unit->programarea_name->GroupDbValues))
					$Report_sponsored_students_programme_unit->programarea_name->setDbValue(@$Report_sponsored_students_programme_unit->programarea_name->GroupDbValues[$rs->fields('programarea_name')]);
				else
					$Report_sponsored_students_programme_unit->programarea_name->setDbValue(ewrpt_GroupValue($Report_sponsored_students_programme_unit->programarea_name, $rs->fields('programarea_name')));
			}
			$Report_sponsored_students_programme_unit->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
			$Report_sponsored_students_programme_unit->District->setDbValue($rs->fields('District'));
			$Report_sponsored_students_programme_unit->community_districts_DistrictID->setDbValue($rs->fields('community_districts_DistrictID'));
			$this->Val[1] = $Report_sponsored_students_programme_unit->sponsored_student_id->CurrentValue;
			$this->Val[2] = $Report_sponsored_students_programme_unit->app_submission_year->CurrentValue;
			$this->Val[3] = $Report_sponsored_students_programme_unit->student_lastname->CurrentValue;
			$this->Val[4] = $Report_sponsored_students_programme_unit->student_firstname->CurrentValue;
			$this->Val[5] = $Report_sponsored_students_programme_unit->student_middlename->CurrentValue;
			$this->Val[6] = $Report_sponsored_students_programme_unit->student_telephone_2->CurrentValue;
			$this->Val[7] = $Report_sponsored_students_programme_unit->student_telephone_1->CurrentValue;
			$this->Val[8] = $Report_sponsored_students_programme_unit->age->CurrentValue;
			$this->Val[9] = $Report_sponsored_students_programme_unit->student_dob->CurrentValue;
			$this->Val[10] = $Report_sponsored_students_programme_unit->student_gender->CurrentValue;
			$this->Val[11] = $Report_sponsored_students_programme_unit->student_address->CurrentValue;
			$this->Val[12] = $Report_sponsored_students_programme_unit->community->CurrentValue;
			$this->Val[13] = $Report_sponsored_students_programme_unit->student_resident_programarea_id->CurrentValue;
		} else {
			$Report_sponsored_students_programme_unit->sponsored_student_id->setDbValue("");
			$Report_sponsored_students_programme_unit->app_submission_year->setDbValue("");
			$Report_sponsored_students_programme_unit->student_lastname->setDbValue("");
			$Report_sponsored_students_programme_unit->student_firstname->setDbValue("");
			$Report_sponsored_students_programme_unit->student_middlename->setDbValue("");
			$Report_sponsored_students_programme_unit->student_telephone_2->setDbValue("");
			$Report_sponsored_students_programme_unit->student_telephone_1->setDbValue("");
			$Report_sponsored_students_programme_unit->age->setDbValue("");
			$Report_sponsored_students_programme_unit->student_dob->setDbValue("");
			$Report_sponsored_students_programme_unit->student_gender->setDbValue("");
			$Report_sponsored_students_programme_unit->student_address->setDbValue("");
			$Report_sponsored_students_programme_unit->community->setDbValue("");
			$Report_sponsored_students_programme_unit->community_community_id->setDbValue("");
			$Report_sponsored_students_programme_unit->programarea_name->setDbValue("");
			$Report_sponsored_students_programme_unit->student_resident_programarea_id->setDbValue("");
			$Report_sponsored_students_programme_unit->District->setDbValue("");
			$Report_sponsored_students_programme_unit->community_districts_DistrictID->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $Report_sponsored_students_programme_unit;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$Report_sponsored_students_programme_unit->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$Report_sponsored_students_programme_unit->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $Report_sponsored_students_programme_unit->getStartGroup();
			}
		} else {
			$this->StartGrp = $Report_sponsored_students_programme_unit->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$Report_sponsored_students_programme_unit->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$Report_sponsored_students_programme_unit->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$Report_sponsored_students_programme_unit->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $Report_sponsored_students_programme_unit;

		// Initialize popup
		// Process post back form

		if (ewrpt_IsHttpPost()) {
			$sName = @$_POST["popup"]; // Get popup form name
			if ($sName <> "") {
				$cntValues = (is_array(@$_POST["sel_$sName"])) ? count($_POST["sel_$sName"]) : 0;
				if ($cntValues > 0) {
					$arValues = ewrpt_StripSlashes($_POST["sel_$sName"]);
					if (trim($arValues[0]) == "") // Select all
						$arValues = EWRPT_INIT_VALUE;
					if (!ewrpt_MatchedArray($arValues, $_SESSION["sel_$sName"])) {
						if ($this->HasSessionFilterValues($sName))
							$this->ClearExtFilter = $sName; // Clear extended filter for this field
					}
					$_SESSION["sel_$sName"] = $arValues;
					$_SESSION["rf_$sName"] = ewrpt_StripSlashes(@$_POST["rf_$sName"]);
					$_SESSION["rt_$sName"] = ewrpt_StripSlashes(@$_POST["rt_$sName"]);
					$this->ResetPager();
				}
			}

		// Get 'reset' command
		} elseif (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];
			if (strtolower($sCmd) == "reset") {
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $Report_sponsored_students_programme_unit;
		$this->StartGrp = 1;
		$Report_sponsored_students_programme_unit->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $Report_sponsored_students_programme_unit;
		$sWrk = @$_GET[EWRPT_TABLE_GROUP_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayGrps = intval($sWrk);
			} else {
				if (strtoupper($sWrk) == "ALL") { // display all groups
					$this->DisplayGrps = -1;
				} else {
					$this->DisplayGrps = 3; // Non-numeric, load default
				}
			}
			$Report_sponsored_students_programme_unit->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$Report_sponsored_students_programme_unit->setStartGroup($this->StartGrp);
		} else {
			if ($Report_sponsored_students_programme_unit->getGroupPerPage() <> "") {
				$this->DisplayGrps = $Report_sponsored_students_programme_unit->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $rs, $Security;
		global $Report_sponsored_students_programme_unit;
		if ($Report_sponsored_students_programme_unit->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($Report_sponsored_students_programme_unit->SqlSelectCount(), $Report_sponsored_students_programme_unit->SqlWhere(), $Report_sponsored_students_programme_unit->SqlGroupBy(), $Report_sponsored_students_programme_unit->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$Report_sponsored_students_programme_unit->Row_Rendering();

		//
		// Render view codes
		//

		if ($Report_sponsored_students_programme_unit->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// programarea_name
			$Report_sponsored_students_programme_unit->programarea_name->GroupViewValue = $Report_sponsored_students_programme_unit->programarea_name->GroupOldValue();
			$Report_sponsored_students_programme_unit->programarea_name->CellAttrs["class"] = ($Report_sponsored_students_programme_unit->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$Report_sponsored_students_programme_unit->programarea_name->GroupViewValue = ewrpt_DisplayGroupValue($Report_sponsored_students_programme_unit->programarea_name, $Report_sponsored_students_programme_unit->programarea_name->GroupViewValue);

			// District
			$Report_sponsored_students_programme_unit->District->GroupViewValue = $Report_sponsored_students_programme_unit->District->GroupOldValue();
			$Report_sponsored_students_programme_unit->District->CellAttrs["class"] = ($Report_sponsored_students_programme_unit->RowGroupLevel == 2) ? "ewRptGrpSummary2" : "ewRptGrpField2";
			$Report_sponsored_students_programme_unit->District->GroupViewValue = ewrpt_DisplayGroupValue($Report_sponsored_students_programme_unit->District, $Report_sponsored_students_programme_unit->District->GroupViewValue);

			// sponsored_student_id
			$Report_sponsored_students_programme_unit->sponsored_student_id->ViewValue = $Report_sponsored_students_programme_unit->sponsored_student_id->Summary;

			// app_submission_year
			$Report_sponsored_students_programme_unit->app_submission_year->ViewValue = $Report_sponsored_students_programme_unit->app_submission_year->Summary;

			// student_lastname
			$Report_sponsored_students_programme_unit->student_lastname->ViewValue = $Report_sponsored_students_programme_unit->student_lastname->Summary;

			// student_firstname
			$Report_sponsored_students_programme_unit->student_firstname->ViewValue = $Report_sponsored_students_programme_unit->student_firstname->Summary;

			// student_middlename
			$Report_sponsored_students_programme_unit->student_middlename->ViewValue = $Report_sponsored_students_programme_unit->student_middlename->Summary;

			// student_telephone_2
			$Report_sponsored_students_programme_unit->student_telephone_2->ViewValue = $Report_sponsored_students_programme_unit->student_telephone_2->Summary;

			// student_telephone_1
			$Report_sponsored_students_programme_unit->student_telephone_1->ViewValue = $Report_sponsored_students_programme_unit->student_telephone_1->Summary;

			// age
			$Report_sponsored_students_programme_unit->age->ViewValue = $Report_sponsored_students_programme_unit->age->Summary;

			// student_dob
			$Report_sponsored_students_programme_unit->student_dob->ViewValue = $Report_sponsored_students_programme_unit->student_dob->Summary;
			$Report_sponsored_students_programme_unit->student_dob->ViewValue = ewrpt_FormatDateTime($Report_sponsored_students_programme_unit->student_dob->ViewValue, 5);

			// student_gender
			$Report_sponsored_students_programme_unit->student_gender->ViewValue = $Report_sponsored_students_programme_unit->student_gender->Summary;

			// student_address
			$Report_sponsored_students_programme_unit->student_address->ViewValue = $Report_sponsored_students_programme_unit->student_address->Summary;

			// community
			$Report_sponsored_students_programme_unit->community->ViewValue = $Report_sponsored_students_programme_unit->community->Summary;

			// student_resident_programarea_id
			$Report_sponsored_students_programme_unit->student_resident_programarea_id->ViewValue = $Report_sponsored_students_programme_unit->student_resident_programarea_id->Summary;
		} else {

			// programarea_name
			$Report_sponsored_students_programme_unit->programarea_name->GroupViewValue = $Report_sponsored_students_programme_unit->programarea_name->GroupValue();
			$Report_sponsored_students_programme_unit->programarea_name->CellAttrs["class"] = "ewRptGrpField1";
			$Report_sponsored_students_programme_unit->programarea_name->GroupViewValue = ewrpt_DisplayGroupValue($Report_sponsored_students_programme_unit->programarea_name, $Report_sponsored_students_programme_unit->programarea_name->GroupViewValue);
			if ($Report_sponsored_students_programme_unit->programarea_name->GroupValue() == $Report_sponsored_students_programme_unit->programarea_name->GroupOldValue() && !$this->ChkLvlBreak(1))
				$Report_sponsored_students_programme_unit->programarea_name->GroupViewValue = "&nbsp;";

			// District
			$Report_sponsored_students_programme_unit->District->GroupViewValue = $Report_sponsored_students_programme_unit->District->GroupValue();
			$Report_sponsored_students_programme_unit->District->CellAttrs["class"] = "ewRptGrpField2";
			$Report_sponsored_students_programme_unit->District->GroupViewValue = ewrpt_DisplayGroupValue($Report_sponsored_students_programme_unit->District, $Report_sponsored_students_programme_unit->District->GroupViewValue);
			if ($Report_sponsored_students_programme_unit->District->GroupValue() == $Report_sponsored_students_programme_unit->District->GroupOldValue() && !$this->ChkLvlBreak(2))
				$Report_sponsored_students_programme_unit->District->GroupViewValue = "&nbsp;";

			// sponsored_student_id
			$Report_sponsored_students_programme_unit->sponsored_student_id->ViewValue = $Report_sponsored_students_programme_unit->sponsored_student_id->CurrentValue;
			$Report_sponsored_students_programme_unit->sponsored_student_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// app_submission_year
			$Report_sponsored_students_programme_unit->app_submission_year->ViewValue = $Report_sponsored_students_programme_unit->app_submission_year->CurrentValue;
			$Report_sponsored_students_programme_unit->app_submission_year->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// student_lastname
			$Report_sponsored_students_programme_unit->student_lastname->ViewValue = $Report_sponsored_students_programme_unit->student_lastname->CurrentValue;
			$Report_sponsored_students_programme_unit->student_lastname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// student_firstname
			$Report_sponsored_students_programme_unit->student_firstname->ViewValue = $Report_sponsored_students_programme_unit->student_firstname->CurrentValue;
			$Report_sponsored_students_programme_unit->student_firstname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// student_middlename
			$Report_sponsored_students_programme_unit->student_middlename->ViewValue = $Report_sponsored_students_programme_unit->student_middlename->CurrentValue;
			$Report_sponsored_students_programme_unit->student_middlename->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// student_telephone_2
			$Report_sponsored_students_programme_unit->student_telephone_2->ViewValue = $Report_sponsored_students_programme_unit->student_telephone_2->CurrentValue;
			$Report_sponsored_students_programme_unit->student_telephone_2->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// student_telephone_1
			$Report_sponsored_students_programme_unit->student_telephone_1->ViewValue = $Report_sponsored_students_programme_unit->student_telephone_1->CurrentValue;
			$Report_sponsored_students_programme_unit->student_telephone_1->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// age
			$Report_sponsored_students_programme_unit->age->ViewValue = $Report_sponsored_students_programme_unit->age->CurrentValue;
			$Report_sponsored_students_programme_unit->age->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// student_dob
			$Report_sponsored_students_programme_unit->student_dob->ViewValue = $Report_sponsored_students_programme_unit->student_dob->CurrentValue;
			$Report_sponsored_students_programme_unit->student_dob->ViewValue = ewrpt_FormatDateTime($Report_sponsored_students_programme_unit->student_dob->ViewValue, 5);
			$Report_sponsored_students_programme_unit->student_dob->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// student_gender
			$Report_sponsored_students_programme_unit->student_gender->ViewValue = $Report_sponsored_students_programme_unit->student_gender->CurrentValue;
			$Report_sponsored_students_programme_unit->student_gender->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// student_address
			$Report_sponsored_students_programme_unit->student_address->ViewValue = $Report_sponsored_students_programme_unit->student_address->CurrentValue;
			$Report_sponsored_students_programme_unit->student_address->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// community
			$Report_sponsored_students_programme_unit->community->ViewValue = $Report_sponsored_students_programme_unit->community->CurrentValue;
			$Report_sponsored_students_programme_unit->community->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// student_resident_programarea_id
			$Report_sponsored_students_programme_unit->student_resident_programarea_id->ViewValue = $Report_sponsored_students_programme_unit->student_resident_programarea_id->CurrentValue;
			$Report_sponsored_students_programme_unit->student_resident_programarea_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// programarea_name
		$Report_sponsored_students_programme_unit->programarea_name->HrefValue = "";

		// District
		$Report_sponsored_students_programme_unit->District->HrefValue = "";

		// sponsored_student_id
		$Report_sponsored_students_programme_unit->sponsored_student_id->HrefValue = "";

		// app_submission_year
		$Report_sponsored_students_programme_unit->app_submission_year->HrefValue = "";

		// student_lastname
		$Report_sponsored_students_programme_unit->student_lastname->HrefValue = "";

		// student_firstname
		$Report_sponsored_students_programme_unit->student_firstname->HrefValue = "";

		// student_middlename
		$Report_sponsored_students_programme_unit->student_middlename->HrefValue = "";

		// student_telephone_2
		$Report_sponsored_students_programme_unit->student_telephone_2->HrefValue = "";

		// student_telephone_1
		$Report_sponsored_students_programme_unit->student_telephone_1->HrefValue = "";

		// age
		$Report_sponsored_students_programme_unit->age->HrefValue = "";

		// student_dob
		$Report_sponsored_students_programme_unit->student_dob->HrefValue = "";

		// student_gender
		$Report_sponsored_students_programme_unit->student_gender->HrefValue = "";

		// student_address
		$Report_sponsored_students_programme_unit->student_address->HrefValue = "";

		// community
		$Report_sponsored_students_programme_unit->community->HrefValue = "";

		// student_resident_programarea_id
		$Report_sponsored_students_programme_unit->student_resident_programarea_id->HrefValue = "";

		// Call Row_Rendered event
		$Report_sponsored_students_programme_unit->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $Report_sponsored_students_programme_unit;

		// Field app_submission_year
		$sSelect = "SELECT DISTINCT student_applicant.app_submission_year FROM " . $Report_sponsored_students_programme_unit->SqlFrom();
		$sOrderBy = "student_applicant.app_submission_year ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Report_sponsored_students_programme_unit->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Report_sponsored_students_programme_unit->app_submission_year->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);

		// Field student_gender
		$sSelect = "SELECT DISTINCT student_applicant.student_gender FROM " . $Report_sponsored_students_programme_unit->SqlFrom();
		$sOrderBy = "student_applicant.student_gender ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Report_sponsored_students_programme_unit->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Report_sponsored_students_programme_unit->student_gender->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);

		// Field programarea_name
		$sSelect = "SELECT DISTINCT programarea.programarea_name FROM " . $Report_sponsored_students_programme_unit->SqlFrom();
		$sOrderBy = "programarea.programarea_name ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Report_sponsored_students_programme_unit->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Report_sponsored_students_programme_unit->programarea_name->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $Report_sponsored_students_programme_unit;
		global $gsFormError;
		$sFilter = "";
		$bPostBack = ewrpt_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			// Field app_submission_year

			$this->SetSessionDropDownValue($Report_sponsored_students_programme_unit->app_submission_year->DropDownValue, 'app_submission_year');

			// Field student_gender
			$this->SetSessionDropDownValue($Report_sponsored_students_programme_unit->student_gender->DropDownValue, 'student_gender');

			// Field programarea_name
			$this->SetSessionDropDownValue($Report_sponsored_students_programme_unit->programarea_name->DropDownValue, 'programarea_name');
			$bSetupFilter = TRUE;
		} else {

			// Field app_submission_year
			if ($this->GetDropDownValue($Report_sponsored_students_programme_unit->app_submission_year->DropDownValue, 'app_submission_year')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Report_sponsored_students_programme_unit->app_submission_year->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Report_sponsored_students_programme_unit->app_submission_year'])) {
				$bSetupFilter = TRUE;
			}

			// Field student_gender
			if ($this->GetDropDownValue($Report_sponsored_students_programme_unit->student_gender->DropDownValue, 'student_gender')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Report_sponsored_students_programme_unit->student_gender->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Report_sponsored_students_programme_unit->student_gender'])) {
				$bSetupFilter = TRUE;
			}

			// Field programarea_name
			if ($this->GetDropDownValue($Report_sponsored_students_programme_unit->programarea_name->DropDownValue, 'programarea_name')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Report_sponsored_students_programme_unit->programarea_name->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Report_sponsored_students_programme_unit->programarea_name'])) {
				$bSetupFilter = TRUE;
			}
			if (!$this->ValidateForm()) {
				$this->setMessage($gsFormError);
				return $sFilter;
			}
		}

		// Restore session
		if ($bRestoreSession) {

			// Field app_submission_year
			$this->GetSessionDropDownValue($Report_sponsored_students_programme_unit->app_submission_year);

			// Field student_gender
			$this->GetSessionDropDownValue($Report_sponsored_students_programme_unit->student_gender);

			// Field programarea_name
			$this->GetSessionDropDownValue($Report_sponsored_students_programme_unit->programarea_name);
		}

		// Call page filter validated event
		$Report_sponsored_students_programme_unit->Page_FilterValidated();

		// Build SQL
		// Field app_submission_year

		$this->BuildDropDownFilter($Report_sponsored_students_programme_unit->app_submission_year, $sFilter, "");

		// Field student_gender
		$this->BuildDropDownFilter($Report_sponsored_students_programme_unit->student_gender, $sFilter, "");

		// Field programarea_name
		$this->BuildDropDownFilter($Report_sponsored_students_programme_unit->programarea_name, $sFilter, "");

		// Save parms to session
		// Field app_submission_year

		$this->SetSessionDropDownValue($Report_sponsored_students_programme_unit->app_submission_year->DropDownValue, 'app_submission_year');

		// Field student_gender
		$this->SetSessionDropDownValue($Report_sponsored_students_programme_unit->student_gender->DropDownValue, 'student_gender');

		// Field programarea_name
		$this->SetSessionDropDownValue($Report_sponsored_students_programme_unit->programarea_name->DropDownValue, 'programarea_name');

		// Setup filter
		if ($bSetupFilter) {
		}
		return $sFilter;
	}

	// Get drop down value from querystring
	function GetDropDownValue(&$sv, $parm) {
		if (ewrpt_IsHttpPost())
			return FALSE; // Skip post back
		if (isset($_GET["sv_$parm"])) {
			$sv = ewrpt_StripSlashes($_GET["sv_$parm"]);
			return TRUE;
		}
		return FALSE;
	}

	// Get filter values from querystring
	function GetFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		if (ewrpt_IsHttpPost())
			return; // Skip post back
		$got = FALSE;
		if (isset($_GET["sv1_$parm"])) {
			$fld->SearchValue = ewrpt_StripSlashes($_GET["sv1_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["so1_$parm"])) {
			$fld->SearchOperator = ewrpt_StripSlashes($_GET["so1_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["sc_$parm"])) {
			$fld->SearchCondition = ewrpt_StripSlashes($_GET["sc_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["sv2_$parm"])) {
			$fld->SearchValue2 = ewrpt_StripSlashes($_GET["sv2_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["so2_$parm"])) {
			$fld->SearchOperator2 = ewrpt_StripSlashes($_GET["so2_$parm"]);
			$got = TRUE;
		}
		return $got;
	}

	// Set default ext filter
	function SetDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2) {
		$fld->DefaultSearchValue = $sv1; // Default ext filter value 1
		$fld->DefaultSearchValue2 = $sv2; // Default ext filter value 2 (if operator 2 is enabled)
		$fld->DefaultSearchOperator = $so1; // Default search operator 1
		$fld->DefaultSearchOperator2 = $so2; // Default search operator 2 (if operator 2 is enabled)
		$fld->DefaultSearchCondition = $sc; // Default search condition (if operator 2 is enabled)
	}

	// Apply default ext filter
	function ApplyDefaultExtFilter(&$fld) {
		$fld->SearchValue = $fld->DefaultSearchValue;
		$fld->SearchValue2 = $fld->DefaultSearchValue2;
		$fld->SearchOperator = $fld->DefaultSearchOperator;
		$fld->SearchOperator2 = $fld->DefaultSearchOperator2;
		$fld->SearchCondition = $fld->DefaultSearchCondition;
	}

	// Check if Text Filter applied
	function TextFilterApplied(&$fld) {
		return (strval($fld->SearchValue) <> strval($fld->DefaultSearchValue) ||
			strval($fld->SearchValue2) <> strval($fld->DefaultSearchValue2) ||
			(strval($fld->SearchValue) <> "" &&
				strval($fld->SearchOperator) <> strval($fld->DefaultSearchOperator)) ||
			(strval($fld->SearchValue2) <> "" &&
				strval($fld->SearchOperator2) <> strval($fld->DefaultSearchOperator2)) ||
			strval($fld->SearchCondition) <> strval($fld->DefaultSearchCondition));
	}

	// Check if Non-Text Filter applied
	function NonTextFilterApplied(&$fld) {
		if (is_array($fld->DefaultDropDownValue) && is_array($fld->DropDownValue)) {
			if (count($fld->DefaultDropDownValue) <> count($fld->DropDownValue))
				return TRUE;
			else
				return (count(array_diff($fld->DefaultDropDownValue, $fld->DropDownValue)) <> 0);
		}
		else {
			$v1 = strval($fld->DefaultDropDownValue);
			if ($v1 == EWRPT_INIT_VALUE)
				$v1 = "";
			$v2 = strval($fld->DropDownValue);
			if ($v2 == EWRPT_INIT_VALUE || $v2 == EWRPT_ALL_VALUE)
				$v2 = "";
			return ($v1 <> $v2);
		}
	}

	// Load selection from a filter clause
	function LoadSelectionFromFilter(&$fld, $filter, &$sel) {
		$sel = "";
		if ($filter <> "") {
			$sSql = ewrpt_BuildReportSql($fld->SqlSelect, "", "", "", $fld->SqlOrderBy, $filter, "");
			ewrpt_LoadArrayFromSql($sSql, $sel);
		}
	}

	// Get dropdown value from session
	function GetSessionDropDownValue(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->DropDownValue, 'sv_Report_sponsored_students_programme_unit_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_Report_sponsored_students_programme_unit_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_Report_sponsored_students_programme_unit_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_Report_sponsored_students_programme_unit_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_Report_sponsored_students_programme_unit_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_Report_sponsored_students_programme_unit_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_Report_sponsored_students_programme_unit_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_Report_sponsored_students_programme_unit_' . $parm] = $sv1;
		$_SESSION['so1_Report_sponsored_students_programme_unit_' . $parm] = $so1;
		$_SESSION['sc_Report_sponsored_students_programme_unit_' . $parm] = $sc;
		$_SESSION['sv2_Report_sponsored_students_programme_unit_' . $parm] = $sv2;
		$_SESSION['so2_Report_sponsored_students_programme_unit_' . $parm] = $so2;
	}

	// Check if has Session filter values
	function HasSessionFilterValues($parm) {
		return ((@$_SESSION['sv_' . $parm] <> "" && @$_SESSION['sv_' . $parm] <> EWRPT_INIT_VALUE) ||
			(@$_SESSION['sv1_' . $parm] <> "" && @$_SESSION['sv1_' . $parm] <> EWRPT_INIT_VALUE) ||
			(@$_SESSION['sv2_' . $parm] <> "" && @$_SESSION['sv2_' . $parm] <> EWRPT_INIT_VALUE));
	}

	// Dropdown filter exist
	function DropDownFilterExist(&$fld, $FldOpr) {
		$sWrk = "";
		$this->BuildDropDownFilter($fld, $sWrk, $FldOpr);
		return ($sWrk <> "");
	}

	// Build dropdown filter
	function BuildDropDownFilter(&$fld, &$FilterClause, $FldOpr) {
		$FldVal = $fld->DropDownValue;
		$sSql = "";
		if (is_array($FldVal)) {
			foreach ($FldVal as $val) {
				$sWrk = $this->GetDropDownfilter($fld, $val, $FldOpr);
				if ($sWrk <> "") {
					if ($sSql <> "")
						$sSql .= " OR " . $sWrk;
					else
						$sSql = $sWrk;
				}
			}
		} else {
			$sSql = $this->GetDropDownfilter($fld, $FldVal, $FldOpr);
		}
		if ($sSql <> "") {
			if ($FilterClause <> "") $FilterClause = "(" . $FilterClause . ") AND ";
			$FilterClause .= "(" . $sSql . ")";
		}
	}

	function GetDropDownfilter(&$fld, $FldVal, $FldOpr) {
		$FldName = $fld->FldName;
		$FldExpression = $fld->FldExpression;
		$FldDataType = $fld->FldDataType;
		$sWrk = "";
		if ($FldVal == EWRPT_NULL_VALUE) {
			$sWrk = $FldExpression . " IS NULL";
		} elseif ($FldVal == EWRPT_EMPTY_VALUE) {
			$sWrk = $FldExpression . " = ''";
		} else {
			if (substr($FldVal, 0, 2) == "@@") {
				$sWrk = ewrpt_getCustomFilter($fld, $FldVal);
			} else {
				if ($FldVal <> "" && $FldVal <> EWRPT_INIT_VALUE && $FldVal <> EWRPT_ALL_VALUE) {
					if ($FldDataType == EWRPT_DATATYPE_DATE && $FldOpr <> "") {
						$sWrk = $this->DateFilterString($FldOpr, $FldVal, $FldDataType);
					} else {
						$sWrk = $this->FilterString("=", $FldVal, $FldDataType);
					}
				}
				if ($sWrk <> "") $sWrk = $FldExpression . $sWrk;
			}
		}
		return $sWrk;
	}

	// Extended filter exist
	function ExtendedFilterExist(&$fld) {
		$sExtWrk = "";
		$this->BuildExtendedFilter($fld, $sExtWrk);
		return ($sExtWrk <> "");
	}

	// Build extended filter
	function BuildExtendedFilter(&$fld, &$FilterClause) {
		$FldName = $fld->FldName;
		$FldExpression = $fld->FldExpression;
		$FldDataType = $fld->FldDataType;
		$FldDateTimeFormat = $fld->FldDateTimeFormat;
		$FldVal1 = $fld->SearchValue;
		$FldOpr1 = $fld->SearchOperator;
		$FldCond = $fld->SearchCondition;
		$FldVal2 = $fld->SearchValue2;
		$FldOpr2 = $fld->SearchOperator2;
		$sWrk = "";
		$FldOpr1 = strtoupper(trim($FldOpr1));
		if ($FldOpr1 == "") $FldOpr1 = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		$wrkFldVal1 = $FldVal1;
		$wrkFldVal2 = $FldVal2;
		if ($FldDataType == EWRPT_DATATYPE_BOOLEAN) {
			if (EWRPT_IS_MSACCESS) {
				if ($wrkFldVal1 <> "") $wrkFldVal1 = ($wrkFldVal1 == "1") ? "True" : "False";
				if ($wrkFldVal2 <> "") $wrkFldVal2 = ($wrkFldVal2 == "1") ? "True" : "False";
			} else {

				//if ($wrkFldVal1 <> "") $wrkFldVal1 = ($wrkFldVal1 == "1") ? EWRPT_TRUE_STRING : EWRPT_FALSE_STRING;
				//if ($wrkFldVal2 <> "") $wrkFldVal2 = ($wrkFldVal2 == "1") ? EWRPT_TRUE_STRING : EWRPT_FALSE_STRING;

				if ($wrkFldVal1 <> "") $wrkFldVal1 = ($wrkFldVal1 == "1") ? "1" : "0";
				if ($wrkFldVal2 <> "") $wrkFldVal2 = ($wrkFldVal2 == "1") ? "1" : "0";
			}
		} elseif ($FldDataType == EWRPT_DATATYPE_DATE) {
			if ($wrkFldVal1 <> "") $wrkFldVal1 = ewrpt_UnFormatDateTime($wrkFldVal1, $FldDateTimeFormat);
			if ($wrkFldVal2 <> "") $wrkFldVal2 = ewrpt_UnFormatDateTime($wrkFldVal2, $FldDateTimeFormat);
		}
		if ($FldOpr1 == "BETWEEN") {
			$IsValidValue = ($FldDataType <> EWRPT_DATATYPE_NUMBER ||
				($FldDataType == EWRPT_DATATYPE_NUMBER && is_numeric($wrkFldVal1) && is_numeric($wrkFldVal2)));
			if ($wrkFldVal1 <> "" && $wrkFldVal2 <> "" && $IsValidValue)
				$sWrk = $FldExpression . " BETWEEN " . ewrpt_QuotedValue($wrkFldVal1, $FldDataType) .
					" AND " . ewrpt_QuotedValue($wrkFldVal2, $FldDataType);
		} elseif ($FldOpr1 == "IS NULL" || $FldOpr1 == "IS NOT NULL") {
			$sWrk = $FldExpression . " " . $wrkFldVal1;
		} else {
			$IsValidValue = ($FldDataType <> EWRPT_DATATYPE_NUMBER ||
				($FldDataType == EWRPT_DATATYPE_NUMBER && is_numeric($wrkFldVal1)));
			if ($wrkFldVal1 <> "" && $IsValidValue && ewrpt_IsValidOpr($FldOpr1, $FldDataType))
				$sWrk = $FldExpression . $this->FilterString($FldOpr1, $wrkFldVal1, $FldDataType);
			$IsValidValue = ($FldDataType <> EWRPT_DATATYPE_NUMBER ||
				($FldDataType == EWRPT_DATATYPE_NUMBER && is_numeric($wrkFldVal2)));
			if ($wrkFldVal2 <> "" && $IsValidValue && ewrpt_IsValidOpr($FldOpr2, $FldDataType)) {
				if ($sWrk <> "")
					$sWrk .= " " . (($FldCond == "OR") ? "OR" : "AND") . " ";
				$sWrk .= $FldExpression . $this->FilterString($FldOpr2, $wrkFldVal2, $FldDataType);
			}
		}
		if ($sWrk <> "") {
			if ($FilterClause <> "") $FilterClause .= " AND ";
			$FilterClause .= "(" . $sWrk . ")";
		}
	}

	// Validate form
	function ValidateForm() {
		global $ReportLanguage, $gsFormError, $Report_sponsored_students_programme_unit;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br />" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Return filter string
	function FilterString($FldOpr, $FldVal, $FldType) {
		if ($FldOpr == "LIKE" || $FldOpr == "NOT LIKE") {
			return " " . $FldOpr . " " . ewrpt_QuotedValue("%$FldVal%", $FldType);
		} elseif ($FldOpr == "STARTS WITH") {
			return " LIKE " . ewrpt_QuotedValue("$FldVal%", $FldType);
		} else {
			return " $FldOpr " . ewrpt_QuotedValue($FldVal, $FldType);
		}
	}

	// Return date search string
	function DateFilterString($FldOpr, $FldVal, $FldType) {
		$wrkVal1 = ewrpt_DateVal($FldOpr, $FldVal, 1);
		$wrkVal2 = ewrpt_DateVal($FldOpr, $FldVal, 2);
		if ($wrkVal1 <> "" && $wrkVal2 <> "") {
			return " BETWEEN " . ewrpt_QuotedValue($wrkVal1, $FldType) . " AND " . ewrpt_QuotedValue($wrkVal2, $FldType);
		} else {
			return "";
		}
	}

	// Clear selection stored in session
	function ClearSessionSelection($parm) {
		$_SESSION["sel_Report_sponsored_students_programme_unit_$parm"] = "";
		$_SESSION["rf_Report_sponsored_students_programme_unit_$parm"] = "";
		$_SESSION["rt_Report_sponsored_students_programme_unit_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $Report_sponsored_students_programme_unit;
		$fld =& $Report_sponsored_students_programme_unit->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_Report_sponsored_students_programme_unit_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_Report_sponsored_students_programme_unit_$parm"];
		$fld->RangeTo = @$_SESSION["rt_Report_sponsored_students_programme_unit_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $Report_sponsored_students_programme_unit;

		/**
		* Set up default values for non Text filters
		*/

		// Field app_submission_year
		$Report_sponsored_students_programme_unit->app_submission_year->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Report_sponsored_students_programme_unit->app_submission_year->DropDownValue = $Report_sponsored_students_programme_unit->app_submission_year->DefaultDropDownValue;

		// Field student_gender
		$Report_sponsored_students_programme_unit->student_gender->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Report_sponsored_students_programme_unit->student_gender->DropDownValue = $Report_sponsored_students_programme_unit->student_gender->DefaultDropDownValue;

		// Field programarea_name
		$Report_sponsored_students_programme_unit->programarea_name->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Report_sponsored_students_programme_unit->programarea_name->DropDownValue = $Report_sponsored_students_programme_unit->programarea_name->DefaultDropDownValue;

		/**
		* Set up default values for extended filters
		* function SetDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2)
		* Parameters:
		* $fld - Field object
		* $so1 - Default search operator 1
		* $sv1 - Default ext filter value 1
		* $sc - Default search condition (if operator 2 is enabled)
		* $so2 - Default search operator 2 (if operator 2 is enabled)
		* $sv2 - Default ext filter value 2 (if operator 2 is enabled)
		*/

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/
	}

	// Check if filter applied
	function CheckFilter() {
		global $Report_sponsored_students_programme_unit;

		// Check app_submission_year extended filter
		if ($this->NonTextFilterApplied($Report_sponsored_students_programme_unit->app_submission_year))
			return TRUE;

		// Check student_gender extended filter
		if ($this->NonTextFilterApplied($Report_sponsored_students_programme_unit->student_gender))
			return TRUE;

		// Check programarea_name extended filter
		if ($this->NonTextFilterApplied($Report_sponsored_students_programme_unit->programarea_name))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $Report_sponsored_students_programme_unit;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field app_submission_year
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Report_sponsored_students_programme_unit->app_submission_year, $sExtWrk, "");
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Report_sponsored_students_programme_unit->app_submission_year->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field student_gender
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Report_sponsored_students_programme_unit->student_gender, $sExtWrk, "");
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Report_sponsored_students_programme_unit->student_gender->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field programarea_name
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Report_sponsored_students_programme_unit->programarea_name, $sExtWrk, "");
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Report_sponsored_students_programme_unit->programarea_name->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Show Filters
		if ($sFilterList <> "")
			echo $ReportLanguage->Phrase("CurrentFilters") . "<br />$sFilterList";
	}

	// Return poup filter
	function GetPopupFilter() {
		global $Report_sponsored_students_programme_unit;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $Report_sponsored_students_programme_unit;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$Report_sponsored_students_programme_unit->setOrderBy("");
				$Report_sponsored_students_programme_unit->setStartGroup(1);
				$Report_sponsored_students_programme_unit->programarea_name->setSort("");
				$Report_sponsored_students_programme_unit->District->setSort("");
				$Report_sponsored_students_programme_unit->sponsored_student_id->setSort("");
				$Report_sponsored_students_programme_unit->app_submission_year->setSort("");
				$Report_sponsored_students_programme_unit->student_lastname->setSort("");
				$Report_sponsored_students_programme_unit->student_firstname->setSort("");
				$Report_sponsored_students_programme_unit->student_middlename->setSort("");
				$Report_sponsored_students_programme_unit->student_telephone_2->setSort("");
				$Report_sponsored_students_programme_unit->student_telephone_1->setSort("");
				$Report_sponsored_students_programme_unit->age->setSort("");
				$Report_sponsored_students_programme_unit->student_dob->setSort("");
				$Report_sponsored_students_programme_unit->student_gender->setSort("");
				$Report_sponsored_students_programme_unit->student_address->setSort("");
				$Report_sponsored_students_programme_unit->community->setSort("");
				$Report_sponsored_students_programme_unit->student_resident_programarea_id->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$Report_sponsored_students_programme_unit->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$Report_sponsored_students_programme_unit->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $Report_sponsored_students_programme_unit->SortSql();
			$Report_sponsored_students_programme_unit->setOrderBy($sSortSql);
			$Report_sponsored_students_programme_unit->setStartGroup(1);
		}

		// Set up default sort
		if ($Report_sponsored_students_programme_unit->getOrderBy() == "") {
			$Report_sponsored_students_programme_unit->setOrderBy("sponsored_student.student_lastname ASC");
			$Report_sponsored_students_programme_unit->student_lastname->setSort("ASC");
		}
		return $Report_sponsored_students_programme_unit->getOrderBy();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>

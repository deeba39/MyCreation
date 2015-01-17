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
$Refund_Report_detailed = NULL;

//
// Table class for Refund_Report_detailed
//
class crRefund_Report_detailed {
	var $TableVar = 'Refund_Report_detailed';
	var $TableName = 'Refund_Report_detailed';
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
	var $date;
	var $status;
	var $refund_amount;
	var $amount;
	var $outstanding_amount;
	var $year;
	var $bankname;
	var $account_no;
	var $annual_amount;
	var $student_firstname;
	var $student_lastname;
	var $student_middlename;
	var $school_name;
	var $paying_programarea;
	var $residence_programarea;
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
	function crRefund_Report_detailed() {
		global $ReportLanguage;

		// date
		$this->date = new crField('Refund_Report_detailed', 'Refund_Report_detailed', 'x_date', 'date', 'scholarship_payment.date', 135, EWRPT_DATATYPE_DATE, 5);
		$this->date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['date'] =& $this->date;
		$this->date->DateFilter = "";
		$this->date->SqlSelect = "";
		$this->date->SqlOrderBy = "";

		// status
		$this->status = new crField('Refund_Report_detailed', 'Refund_Report_detailed', 'x_status', 'status', 'scholarship_payment.status', 202, EWRPT_DATATYPE_STRING, -1);
		$this->fields['status'] =& $this->status;
		$this->status->DateFilter = "";
		$this->status->SqlSelect = "";
		$this->status->SqlOrderBy = "";

		// refund_amount
		$this->refund_amount = new crField('Refund_Report_detailed', 'Refund_Report_detailed', 'x_refund_amount', 'refund_amount', 'scholarship_payment.refund_amount', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->refund_amount->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['refund_amount'] =& $this->refund_amount;
		$this->refund_amount->DateFilter = "";
		$this->refund_amount->SqlSelect = "";
		$this->refund_amount->SqlOrderBy = "";

		// amount
		$this->amount = new crField('Refund_Report_detailed', 'Refund_Report_detailed', 'x_amount', 'amount', 'scholarship_payment.amount', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->amount->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['amount'] =& $this->amount;
		$this->amount->DateFilter = "";
		$this->amount->SqlSelect = "";
		$this->amount->SqlOrderBy = "";

		// outstanding_amount
		$this->outstanding_amount = new crField('Refund_Report_detailed', 'Refund_Report_detailed', 'x_outstanding_amount', 'outstanding_amount', 'scholarship_payment.amount - scholarship_payment.refund_amount', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->outstanding_amount->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['outstanding_amount'] =& $this->outstanding_amount;
		$this->outstanding_amount->DateFilter = "";
		$this->outstanding_amount->SqlSelect = "";
		$this->outstanding_amount->SqlOrderBy = "";

		// year
		$this->year = new crField('Refund_Report_detailed', 'Refund_Report_detailed', 'x_year', 'year', 'scholarship_payment.year', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->year->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['year'] =& $this->year;
		$this->year->DateFilter = "";
		$this->year->SqlSelect = "";
		$this->year->SqlOrderBy = "";

		// bankname
		$this->bankname = new crField('Refund_Report_detailed', 'Refund_Report_detailed', 'x_bankname', 'bankname', 'scholarship_payment.bankname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bankname'] =& $this->bankname;
		$this->bankname->DateFilter = "";
		$this->bankname->SqlSelect = "";
		$this->bankname->SqlOrderBy = "";

		// account_no
		$this->account_no = new crField('Refund_Report_detailed', 'Refund_Report_detailed', 'x_account_no', 'account_no', 'scholarship_payment.account_no', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['account_no'] =& $this->account_no;
		$this->account_no->DateFilter = "";
		$this->account_no->SqlSelect = "";
		$this->account_no->SqlOrderBy = "";

		// annual_amount
		$this->annual_amount = new crField('Refund_Report_detailed', 'Refund_Report_detailed', 'x_annual_amount', 'annual_amount', 'scholarship_package.annual_amount', 131, EWRPT_DATATYPE_NUMBER, -1);
		$this->annual_amount->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['annual_amount'] =& $this->annual_amount;
		$this->annual_amount->DateFilter = "";
		$this->annual_amount->SqlSelect = "";
		$this->annual_amount->SqlOrderBy = "";

		// student_firstname
		$this->student_firstname = new crField('Refund_Report_detailed', 'Refund_Report_detailed', 'x_student_firstname', 'student_firstname', 'sponsored_student.student_firstname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_firstname'] =& $this->student_firstname;
		$this->student_firstname->DateFilter = "";
		$this->student_firstname->SqlSelect = "";
		$this->student_firstname->SqlOrderBy = "";

		// student_lastname
		$this->student_lastname = new crField('Refund_Report_detailed', 'Refund_Report_detailed', 'x_student_lastname', 'student_lastname', 'sponsored_student.student_lastname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_lastname'] =& $this->student_lastname;
		$this->student_lastname->DateFilter = "";
		$this->student_lastname->SqlSelect = "";
		$this->student_lastname->SqlOrderBy = "";

		// student_middlename
		$this->student_middlename = new crField('Refund_Report_detailed', 'Refund_Report_detailed', 'x_student_middlename', 'student_middlename', 'sponsored_student.student_middlename', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['student_middlename'] =& $this->student_middlename;
		$this->student_middlename->DateFilter = "";
		$this->student_middlename->SqlSelect = "";
		$this->student_middlename->SqlOrderBy = "";

		// school_name
		$this->school_name = new crField('Refund_Report_detailed', 'Refund_Report_detailed', 'x_school_name', 'school_name', 'schools.school_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->school_name->GroupingFieldId = 2;
		$this->fields['school_name'] =& $this->school_name;
		$this->school_name->DateFilter = "";
		$this->school_name->SqlSelect = "SELECT DISTINCT schools.school_name FROM " . $this->SqlFrom();
		$this->school_name->SqlOrderBy = "schools.school_name";
		$this->school_name->FldGroupByType = "";
		$this->school_name->FldGroupInt = "0";
		$this->school_name->FldGroupSql = "";

		// paying_programarea
		$this->paying_programarea = new crField('Refund_Report_detailed', 'Refund_Report_detailed', 'x_paying_programarea', 'paying_programarea', 'programarea.programarea_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->paying_programarea->GroupingFieldId = 1;
		$this->fields['paying_programarea'] =& $this->paying_programarea;
		$this->paying_programarea->DateFilter = "";
		$this->paying_programarea->SqlSelect = "SELECT DISTINCT programarea.programarea_name FROM " . $this->SqlFrom();
		$this->paying_programarea->SqlOrderBy = "programarea.programarea_name";
		$this->paying_programarea->FldGroupByType = "";
		$this->paying_programarea->FldGroupInt = "0";
		$this->paying_programarea->FldGroupSql = "";

		// residence_programarea
		$this->residence_programarea = new crField('Refund_Report_detailed', 'Refund_Report_detailed', 'x_residence_programarea', 'residence_programarea', 'programarea1.programarea_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['residence_programarea'] =& $this->residence_programarea;
		$this->residence_programarea->DateFilter = "";
		$this->residence_programarea->SqlSelect = "";
		$this->residence_programarea->SqlOrderBy = "";
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
		return "scholarship_payment Inner Join scholarship_package On scholarship_payment.scholarship_package_scholarship_package_id = scholarship_package.scholarship_package_id Inner Join sponsored_student On sponsored_student.sponsored_student_id = scholarship_package.sponsored_student_sponsored_student_id Inner Join schools On schools.school_id = scholarship_payment.schools_school_id Inner Join programarea On scholarship_payment.programarea_payingarea_id = programarea.programarea_id Inner Join programarea programarea1 On scholarship_payment.programarea_residentarea_id = programarea1.programarea_id";
	}

	function SqlSelect() { // Select
		return "SELECT scholarship_payment.date, scholarship_payment.status, scholarship_payment.refund_amount, scholarship_payment.amount, scholarship_payment.amount - scholarship_payment.refund_amount As outstanding_amount, scholarship_payment.year, scholarship_payment.bankname, scholarship_payment.account_no, scholarship_package.annual_amount, sponsored_student.student_firstname, sponsored_student.student_lastname, sponsored_student.student_middlename, schools.school_name, programarea.programarea_name As paying_programarea, programarea1.programarea_name As residence_programarea FROM " . $this->SqlFrom();
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
		return "programarea.programarea_name ASC, schools.school_name ASC";
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
		return "SELECT SUM(scholarship_payment.refund_amount) AS sum_refund_amount, SUM(scholarship_payment.amount) AS sum_amount, SUM(scholarship_payment.amount - scholarship_payment.refund_amount) AS sum_outstanding_amount, SUM(scholarship_package.annual_amount) AS sum_annual_amount FROM " . $this->SqlFrom();
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
$Refund_Report_detailed_summary = new crRefund_Report_detailed_summary();
$Page =& $Refund_Report_detailed_summary;

// Page init
$Refund_Report_detailed_summary->Page_Init();

// Page main
$Refund_Report_detailed_summary->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<script type="text/javascript">

// Create page object
var Refund_Report_detailed_summary = new ewrpt_Page("Refund_Report_detailed_summary");

// page properties
Refund_Report_detailed_summary.PageID = "summary"; // page ID
Refund_Report_detailed_summary.FormID = "fRefund_Report_detailedsummaryfilter"; // form ID
var EWRPT_PAGE_ID = Refund_Report_detailed_summary.PageID;

// extend page with ValidateForm function
Refund_Report_detailed_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var elm = fobj.sv1_date;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Refund_Report_detailed->date->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv2_date;
	if (elm && !ewrpt_CheckDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($Refund_Report_detailed->date->FldErrMsg()) ?>"))
			return false;
	}

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
Refund_Report_detailed_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
Refund_Report_detailed_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Refund_Report_detailed_summary.ValidateRequired = false; // no JavaScript validation
<?php } ?>
</script>
<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-1.css" title="win2k-1" />
<script type="text/javascript" src="jscalendar/calendar.js"></script>
<script type="text/javascript" src="jscalendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php $Refund_Report_detailed_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $Refund_Report_detailed_summary->ShowMessage(); ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($Refund_Report_detailed->paying_programarea, $Refund_Report_detailed->paying_programarea->FldType); ?>
ewrpt_CreatePopup("Refund_Report_detailed_paying_programarea", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Refund_Report_detailed->school_name, $Refund_Report_detailed->school_name->FldType); ?>
ewrpt_CreatePopup("Refund_Report_detailed_school_name", [<?php echo $jsdata ?>]);
</script>
<div id="Refund_Report_detailed_paying_programarea_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Refund_Report_detailed_school_name_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php echo $Refund_Report_detailed->TableCaption() ?>
<?php if ($Refund_Report_detailed_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="Refund_Report_detailedsmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
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
if ($Refund_Report_detailed->FilterPanelOption == 2 || ($Refund_Report_detailed->FilterPanelOption == 3 && $Refund_Report_detailed_summary->FilterApplied) || $Refund_Report_detailed_summary->Filter == "0=101") {
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
<form name="fRefund_Report_detailedsummaryfilter" id="fRefund_Report_detailedsummaryfilter" action="Refund_Report_detailedsmry.php" class="ewForm" onsubmit="return Refund_Report_detailed_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $Refund_Report_detailed->date->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("BETWEEN"); ?><input type="hidden" name="so1_date" id="so1_date" value="BETWEEN"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_date" id="sv1_date" value="<?php echo ewrpt_HtmlEncode($Refund_Report_detailed->date->SearchValue) ?>"<?php echo ($Refund_Report_detailed_summary->ClearExtFilter == 'Refund_Report_detailed_date') ? " class=\"ewInputCleared\"" : "" ?>>
<img src="phprptimages/calendar.png" id="csv1_date" alt="<?php echo $ReportLanguage->Phrase("PickDate"); ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "sv1_date", // ID of the input field
	ifFormat : "%Y/%m/%d", // the date format
	button : "csv1_date" // ID of the button
})
</script>
</span></td>
				<td><span class="ewRptSearchOpr" id="btw1_date" name="btw1_date">&nbsp;<?php echo $ReportLanguage->Phrase("AND") ?>&nbsp;</span></td>
				<td><span class="phpreportmaker" id="btw1_date" name="btw1_date">
<input type="text" name="sv2_date" id="sv2_date" value="<?php echo ewrpt_HtmlEncode($Refund_Report_detailed->date->SearchValue2) ?>"<?php echo ($Refund_Report_detailed_summary->ClearExtFilter == 'Refund_Report_detailed_date') ? " class=\"ewInputCleared\"" : "" ?>>
<img src="phprptimages/calendar.png" id="csv2_date" alt="<?php echo $ReportLanguage->Phrase("PickDate"); ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "sv2_date", // ID of the input field
	ifFormat : "%Y/%m/%d", // the date format
	button : "csv2_date" // ID of the button
})
</script>
</span></td>
			</tr></table>			
		</td>
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
<?php if ($Refund_Report_detailed->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $Refund_Report_detailed_summary->ShowFilterList() ?>
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
if ($Refund_Report_detailed->ExportAll && $Refund_Report_detailed->Export <> "") {
	$Refund_Report_detailed_summary->StopGrp = $Refund_Report_detailed_summary->TotalGrps;
} else {
	$Refund_Report_detailed_summary->StopGrp = $Refund_Report_detailed_summary->StartGrp + $Refund_Report_detailed_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Refund_Report_detailed_summary->StopGrp) > intval($Refund_Report_detailed_summary->TotalGrps))
	$Refund_Report_detailed_summary->StopGrp = $Refund_Report_detailed_summary->TotalGrps;
$Refund_Report_detailed_summary->RecCount = 0;

// Get first row
if ($Refund_Report_detailed_summary->TotalGrps > 0) {
	$Refund_Report_detailed_summary->GetGrpRow(1);
	$Refund_Report_detailed_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $Refund_Report_detailed_summary->GrpCount <= $Refund_Report_detailed_summary->DisplayGrps) || $Refund_Report_detailed_summary->ShowFirstHeader) {

	// Show header
	if ($Refund_Report_detailed_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
<?php if ($Refund_Report_detailed->Export <> "") { ?>
<?php echo $Refund_Report_detailed->paying_programarea->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Refund_Report_detailed->SortUrl($Refund_Report_detailed->paying_programarea) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Refund_Report_detailed->paying_programarea->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Refund_Report_detailed->SortUrl($Refund_Report_detailed->paying_programarea) ?>',0);"><?php echo $Refund_Report_detailed->paying_programarea->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Refund_Report_detailed->paying_programarea->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Refund_Report_detailed->paying_programarea->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Refund_Report_detailed_paying_programarea', false, '<?php echo $Refund_Report_detailed->paying_programarea->RangeFrom; ?>', '<?php echo $Refund_Report_detailed->paying_programarea->RangeTo; ?>');return false;" name="x_paying_programarea<?php echo $Refund_Report_detailed_summary->Cnt[0][0]; ?>" id="x_paying_programarea<?php echo $Refund_Report_detailed_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Refund_Report_detailed->Export <> "") { ?>
<?php echo $Refund_Report_detailed->school_name->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Refund_Report_detailed->SortUrl($Refund_Report_detailed->school_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Refund_Report_detailed->school_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Refund_Report_detailed->SortUrl($Refund_Report_detailed->school_name) ?>',0);"><?php echo $Refund_Report_detailed->school_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Refund_Report_detailed->school_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Refund_Report_detailed->school_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Refund_Report_detailed_school_name', false, '<?php echo $Refund_Report_detailed->school_name->RangeFrom; ?>', '<?php echo $Refund_Report_detailed->school_name->RangeTo; ?>');return false;" name="x_school_name<?php echo $Refund_Report_detailed_summary->Cnt[0][0]; ?>" id="x_school_name<?php echo $Refund_Report_detailed_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Refund_Report_detailed->Export <> "") { ?>
<?php echo $Refund_Report_detailed->date->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Refund_Report_detailed->SortUrl($Refund_Report_detailed->date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Refund_Report_detailed->date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Refund_Report_detailed->SortUrl($Refund_Report_detailed->date) ?>',0);"><?php echo $Refund_Report_detailed->date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Refund_Report_detailed->date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Refund_Report_detailed->date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Refund_Report_detailed->Export <> "") { ?>
<?php echo $Refund_Report_detailed->refund_amount->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Refund_Report_detailed->SortUrl($Refund_Report_detailed->refund_amount) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Refund_Report_detailed->refund_amount->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Refund_Report_detailed->SortUrl($Refund_Report_detailed->refund_amount) ?>',0);"><?php echo $Refund_Report_detailed->refund_amount->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Refund_Report_detailed->refund_amount->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Refund_Report_detailed->refund_amount->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Refund_Report_detailed->Export <> "") { ?>
<?php echo $Refund_Report_detailed->amount->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Refund_Report_detailed->SortUrl($Refund_Report_detailed->amount) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Refund_Report_detailed->amount->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Refund_Report_detailed->SortUrl($Refund_Report_detailed->amount) ?>',0);"><?php echo $Refund_Report_detailed->amount->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Refund_Report_detailed->amount->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Refund_Report_detailed->amount->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Refund_Report_detailed->Export <> "") { ?>
<?php echo $Refund_Report_detailed->outstanding_amount->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Refund_Report_detailed->SortUrl($Refund_Report_detailed->outstanding_amount) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Refund_Report_detailed->outstanding_amount->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Refund_Report_detailed->SortUrl($Refund_Report_detailed->outstanding_amount) ?>',0);"><?php echo $Refund_Report_detailed->outstanding_amount->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Refund_Report_detailed->outstanding_amount->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Refund_Report_detailed->outstanding_amount->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Refund_Report_detailed->Export <> "") { ?>
<?php echo $Refund_Report_detailed->year->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Refund_Report_detailed->SortUrl($Refund_Report_detailed->year) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Refund_Report_detailed->year->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Refund_Report_detailed->SortUrl($Refund_Report_detailed->year) ?>',0);"><?php echo $Refund_Report_detailed->year->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Refund_Report_detailed->year->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Refund_Report_detailed->year->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Refund_Report_detailed->Export <> "") { ?>
<?php echo $Refund_Report_detailed->annual_amount->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Refund_Report_detailed->SortUrl($Refund_Report_detailed->annual_amount) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Refund_Report_detailed->annual_amount->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Refund_Report_detailed->SortUrl($Refund_Report_detailed->annual_amount) ?>',0);"><?php echo $Refund_Report_detailed->annual_amount->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Refund_Report_detailed->annual_amount->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Refund_Report_detailed->annual_amount->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Refund_Report_detailed->Export <> "") { ?>
<?php echo $Refund_Report_detailed->student_firstname->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Refund_Report_detailed->SortUrl($Refund_Report_detailed->student_firstname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Refund_Report_detailed->student_firstname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Refund_Report_detailed->SortUrl($Refund_Report_detailed->student_firstname) ?>',0);"><?php echo $Refund_Report_detailed->student_firstname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Refund_Report_detailed->student_firstname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Refund_Report_detailed->student_firstname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Refund_Report_detailed->Export <> "") { ?>
<?php echo $Refund_Report_detailed->student_lastname->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Refund_Report_detailed->SortUrl($Refund_Report_detailed->student_lastname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Refund_Report_detailed->student_lastname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Refund_Report_detailed->SortUrl($Refund_Report_detailed->student_lastname) ?>',0);"><?php echo $Refund_Report_detailed->student_lastname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Refund_Report_detailed->student_lastname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Refund_Report_detailed->student_lastname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($Refund_Report_detailed->Export <> "") { ?>
<?php echo $Refund_Report_detailed->student_middlename->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Refund_Report_detailed->SortUrl($Refund_Report_detailed->student_middlename) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Refund_Report_detailed->student_middlename->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Refund_Report_detailed->SortUrl($Refund_Report_detailed->student_middlename) ?>',0);"><?php echo $Refund_Report_detailed->student_middlename->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Refund_Report_detailed->student_middlename->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Refund_Report_detailed->student_middlename->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$Refund_Report_detailed_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($Refund_Report_detailed->paying_programarea, $Refund_Report_detailed->SqlFirstGroupField(), $Refund_Report_detailed->paying_programarea->GroupValue());
	if ($Refund_Report_detailed_summary->Filter != "")
		$sWhere = "($Refund_Report_detailed_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($Refund_Report_detailed->SqlSelect(), $Refund_Report_detailed->SqlWhere(), $Refund_Report_detailed->SqlGroupBy(), $Refund_Report_detailed->SqlHaving(), $Refund_Report_detailed->SqlOrderBy(), $sWhere, $Refund_Report_detailed_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$Refund_Report_detailed_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Refund_Report_detailed_summary->RecCount++;

		// Render detail row
		$Refund_Report_detailed->ResetCSS();
		$Refund_Report_detailed->RowType = EWRPT_ROWTYPE_DETAIL;
		$Refund_Report_detailed_summary->RenderRow();
?>
	<tr<?php echo $Refund_Report_detailed->RowAttributes(); ?>>
		<td<?php echo $Refund_Report_detailed->paying_programarea->CellAttributes(); ?>><div<?php echo $Refund_Report_detailed->paying_programarea->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->paying_programarea->GroupViewValue; ?></div></td>
		<td<?php echo $Refund_Report_detailed->school_name->CellAttributes(); ?>><div<?php echo $Refund_Report_detailed->school_name->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->school_name->GroupViewValue; ?></div></td>
		<td<?php echo $Refund_Report_detailed->date->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->date->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->date->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->refund_amount->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->refund_amount->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->refund_amount->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->amount->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->amount->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->amount->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->outstanding_amount->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->outstanding_amount->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->outstanding_amount->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->year->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->year->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->year->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->annual_amount->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->annual_amount->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->annual_amount->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->student_firstname->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->student_firstname->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->student_firstname->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->student_lastname->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->student_lastname->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->student_lastname->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->student_middlename->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->student_middlename->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->student_middlename->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$Refund_Report_detailed_summary->AccumulateSummary();

		// Get next record
		$Refund_Report_detailed_summary->GetRow(2);

		// Show Footers
?>
<?php
		if ($Refund_Report_detailed_summary->ChkLvlBreak(2)) {
			$Refund_Report_detailed->ResetCSS();
			$Refund_Report_detailed->RowType = EWRPT_ROWTYPE_TOTAL;
			$Refund_Report_detailed->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$Refund_Report_detailed->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$Refund_Report_detailed->RowGroupLevel = 2;
			$Refund_Report_detailed_summary->RenderRow();
?>
	<tr<?php echo $Refund_Report_detailed->RowAttributes(); ?>>
		<td<?php echo $Refund_Report_detailed->paying_programarea->CellAttributes() ?>>&nbsp;</td>
		<td colspan="10"<?php echo $Refund_Report_detailed->school_name->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $Refund_Report_detailed->school_name->FldCaption() ?>: <?php echo $Refund_Report_detailed->school_name->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($Refund_Report_detailed_summary->Cnt[2][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
			$Refund_Report_detailed->ResetCSS();
			$Refund_Report_detailed->refund_amount->Count = $Refund_Report_detailed_summary->Cnt[2][2];
			$Refund_Report_detailed->refund_amount->Summary = $Refund_Report_detailed_summary->Smry[2][2]; // Load SUM
			$Refund_Report_detailed->amount->Count = $Refund_Report_detailed_summary->Cnt[2][3];
			$Refund_Report_detailed->amount->Summary = $Refund_Report_detailed_summary->Smry[2][3]; // Load SUM
			$Refund_Report_detailed->outstanding_amount->Count = $Refund_Report_detailed_summary->Cnt[2][4];
			$Refund_Report_detailed->outstanding_amount->Summary = $Refund_Report_detailed_summary->Smry[2][4]; // Load SUM
			$Refund_Report_detailed->annual_amount->Count = $Refund_Report_detailed_summary->Cnt[2][6];
			$Refund_Report_detailed->annual_amount->Summary = $Refund_Report_detailed_summary->Smry[2][6]; // Load SUM
			$Refund_Report_detailed->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
			$Refund_Report_detailed_summary->RenderRow();
?>
	<tr<?php echo $Refund_Report_detailed->RowAttributes(); ?>>
		<td<?php echo $Refund_Report_detailed->paying_programarea->CellAttributes() ?>>&nbsp;</td>
		<td colspan="1"<?php echo $Refund_Report_detailed->school_name->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $Refund_Report_detailed->school_name->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Refund_Report_detailed->school_name->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->refund_amount->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->refund_amount->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->school_name->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->amount->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->amount->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->school_name->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->outstanding_amount->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->outstanding_amount->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->school_name->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Refund_Report_detailed->school_name->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->annual_amount->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->annual_amount->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->school_name->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Refund_Report_detailed->school_name->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Refund_Report_detailed->school_name->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php

			// Reset level 2 summary
			$Refund_Report_detailed_summary->ResetLevelSummary(2);
		} // End check level check
?>
<?php
	} // End detail records loop
?>
<?php
			$Refund_Report_detailed->ResetCSS();
			$Refund_Report_detailed->RowType = EWRPT_ROWTYPE_TOTAL;
			$Refund_Report_detailed->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$Refund_Report_detailed->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$Refund_Report_detailed->RowGroupLevel = 1;
			$Refund_Report_detailed_summary->RenderRow();
?>
	<tr<?php echo $Refund_Report_detailed->RowAttributes(); ?>>
		<td colspan="11"<?php echo $Refund_Report_detailed->paying_programarea->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $Refund_Report_detailed->paying_programarea->FldCaption() ?>: <?php echo $Refund_Report_detailed->paying_programarea->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($Refund_Report_detailed_summary->Cnt[1][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
			$Refund_Report_detailed->ResetCSS();
			$Refund_Report_detailed->refund_amount->Count = $Refund_Report_detailed_summary->Cnt[1][2];
			$Refund_Report_detailed->refund_amount->Summary = $Refund_Report_detailed_summary->Smry[1][2]; // Load SUM
			$Refund_Report_detailed->amount->Count = $Refund_Report_detailed_summary->Cnt[1][3];
			$Refund_Report_detailed->amount->Summary = $Refund_Report_detailed_summary->Smry[1][3]; // Load SUM
			$Refund_Report_detailed->outstanding_amount->Count = $Refund_Report_detailed_summary->Cnt[1][4];
			$Refund_Report_detailed->outstanding_amount->Summary = $Refund_Report_detailed_summary->Smry[1][4]; // Load SUM
			$Refund_Report_detailed->annual_amount->Count = $Refund_Report_detailed_summary->Cnt[1][6];
			$Refund_Report_detailed->annual_amount->Summary = $Refund_Report_detailed_summary->Smry[1][6]; // Load SUM
			$Refund_Report_detailed->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
			$Refund_Report_detailed_summary->RenderRow();
?>
	<tr<?php echo $Refund_Report_detailed->RowAttributes(); ?>>
		<td colspan="2"<?php echo $Refund_Report_detailed->paying_programarea->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $Refund_Report_detailed->paying_programarea->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Refund_Report_detailed->paying_programarea->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->refund_amount->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->refund_amount->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->paying_programarea->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->amount->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->amount->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->paying_programarea->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->outstanding_amount->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->outstanding_amount->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->paying_programarea->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Refund_Report_detailed->paying_programarea->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->annual_amount->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->annual_amount->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->paying_programarea->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Refund_Report_detailed->paying_programarea->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Refund_Report_detailed->paying_programarea->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php

			// Reset level 1 summary
			$Refund_Report_detailed_summary->ResetLevelSummary(1);
?>
<?php

	// Next group
	$Refund_Report_detailed_summary->GetGrpRow(2);
	$Refund_Report_detailed_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php
if ($Refund_Report_detailed_summary->TotalGrps > 0) {
	$Refund_Report_detailed->ResetCSS();
	$Refund_Report_detailed->RowType = EWRPT_ROWTYPE_TOTAL;
	$Refund_Report_detailed->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$Refund_Report_detailed->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Refund_Report_detailed->RowAttrs["class"] = "ewRptGrandSummary";
	$Refund_Report_detailed_summary->RenderRow();
?>
	<!-- tr><td colspan="11"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $Refund_Report_detailed->RowAttributes(); ?>><td colspan="11"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($Refund_Report_detailed_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
	$Refund_Report_detailed->ResetCSS();
	$Refund_Report_detailed->refund_amount->Count = $Refund_Report_detailed_summary->TotCount;
	$Refund_Report_detailed->refund_amount->Summary = $Refund_Report_detailed_summary->GrandSmry[2]; // Load SUM
	$Refund_Report_detailed->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$Refund_Report_detailed->amount->Count = $Refund_Report_detailed_summary->TotCount;
	$Refund_Report_detailed->amount->Summary = $Refund_Report_detailed_summary->GrandSmry[3]; // Load SUM
	$Refund_Report_detailed->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$Refund_Report_detailed->outstanding_amount->Count = $Refund_Report_detailed_summary->TotCount;
	$Refund_Report_detailed->outstanding_amount->Summary = $Refund_Report_detailed_summary->GrandSmry[4]; // Load SUM
	$Refund_Report_detailed->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$Refund_Report_detailed->annual_amount->Count = $Refund_Report_detailed_summary->TotCount;
	$Refund_Report_detailed->annual_amount->Summary = $Refund_Report_detailed_summary->GrandSmry[6]; // Load SUM
	$Refund_Report_detailed->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$Refund_Report_detailed->annual_amount->CurrentValue = $Refund_Report_detailed->annual_amount->Summary;
	$Refund_Report_detailed->RowAttrs["class"] = "ewRptGrandSummary";
	$Refund_Report_detailed_summary->RenderRow();
?>
	<tr<?php echo $Refund_Report_detailed->RowAttributes(); ?>>
		<td colspan="2" class="ewRptGrpAggregate"><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $Refund_Report_detailed->date->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Refund_Report_detailed->refund_amount->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->refund_amount->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->refund_amount->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->amount->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->amount->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->amount->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->outstanding_amount->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->outstanding_amount->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->outstanding_amount->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->year->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Refund_Report_detailed->annual_amount->CellAttributes() ?>>
<div<?php echo $Refund_Report_detailed->annual_amount->ViewAttributes(); ?>><?php echo $Refund_Report_detailed->annual_amount->ListViewValue(); ?></div>
</td>
		<td<?php echo $Refund_Report_detailed->student_firstname->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Refund_Report_detailed->student_lastname->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Refund_Report_detailed->student_middlename->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php } ?>
	</tfoot>
</table>
</div>
<div class="ewGridLowerPanel">
<form action="Refund_Report_detailedsmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Refund_Report_detailed_summary->StartGrp, $Refund_Report_detailed_summary->DisplayGrps, $Refund_Report_detailed_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Refund_Report_detailedsmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Refund_Report_detailedsmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Refund_Report_detailedsmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Refund_Report_detailedsmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Refund_Report_detailed_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Refund_Report_detailed_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Refund_Report_detailed_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Refund_Report_detailed_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Refund_Report_detailed_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Refund_Report_detailed_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Refund_Report_detailed_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Refund_Report_detailed_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Refund_Report_detailed_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Refund_Report_detailed_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Refund_Report_detailed->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php $Refund_Report_detailed_summary->ShowPageFooter(); ?>
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
$Refund_Report_detailed_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crRefund_Report_detailed_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'Refund_Report_detailed';

	// Page object name
	var $PageObjName = 'Refund_Report_detailed_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $Refund_Report_detailed;
		if ($Refund_Report_detailed->UseTokenInUrl) $PageUrl .= "t=" . $Refund_Report_detailed->TableVar . "&"; // Add page token
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
		global $Refund_Report_detailed;
		if ($Refund_Report_detailed->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($Refund_Report_detailed->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($Refund_Report_detailed->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crRefund_Report_detailed_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (Refund_Report_detailed)
		$GLOBALS["Refund_Report_detailed"] = new crRefund_Report_detailed();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'Refund_Report_detailed', TRUE);

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
		global $Refund_Report_detailed;

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$Refund_Report_detailed->Export = $_GET["export"];
	}
	$gsExport = $Refund_Report_detailed->Export; // Get export parameter, used in header
	$gsExportFile = $Refund_Report_detailed->TableVar; // Get export file, used in header

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
		global $Refund_Report_detailed;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($Refund_Report_detailed->Export == "email") {
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
		global $Refund_Report_detailed;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 10;
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
		$this->Col = array(FALSE, FALSE, TRUE, TRUE, TRUE, FALSE, TRUE, FALSE, FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$Refund_Report_detailed->paying_programarea->SelectionList = "";
		$Refund_Report_detailed->paying_programarea->DefaultSelectionList = "";
		$Refund_Report_detailed->paying_programarea->ValueList = "";
		$Refund_Report_detailed->school_name->SelectionList = "";
		$Refund_Report_detailed->school_name->DefaultSelectionList = "";
		$Refund_Report_detailed->school_name->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$Refund_Report_detailed->CustomFilters_Load();

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
		$sGrpSort = ewrpt_UpdateSortFields($Refund_Report_detailed->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($Refund_Report_detailed->SqlSelectGroup(), $Refund_Report_detailed->SqlWhere(), $Refund_Report_detailed->SqlGroupBy(), $Refund_Report_detailed->SqlHaving(), $Refund_Report_detailed->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($Refund_Report_detailed->ExportAll && $Refund_Report_detailed->Export <> "")
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
		global $Refund_Report_detailed;
		switch ($lvl) {
			case 1:
				return (is_null($Refund_Report_detailed->paying_programarea->CurrentValue) && !is_null($Refund_Report_detailed->paying_programarea->OldValue)) ||
					(!is_null($Refund_Report_detailed->paying_programarea->CurrentValue) && is_null($Refund_Report_detailed->paying_programarea->OldValue)) ||
					($Refund_Report_detailed->paying_programarea->GroupValue() <> $Refund_Report_detailed->paying_programarea->GroupOldValue());
			case 2:
				return (is_null($Refund_Report_detailed->school_name->CurrentValue) && !is_null($Refund_Report_detailed->school_name->OldValue)) ||
					(!is_null($Refund_Report_detailed->school_name->CurrentValue) && is_null($Refund_Report_detailed->school_name->OldValue)) ||
					($Refund_Report_detailed->school_name->GroupValue() <> $Refund_Report_detailed->school_name->GroupOldValue()) || $this->ChkLvlBreak(1); // Recurse upper level
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
		global $Refund_Report_detailed;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $Refund_Report_detailed;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $Refund_Report_detailed;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$Refund_Report_detailed->paying_programarea->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$Refund_Report_detailed->paying_programarea->setDbValue($rsgrp->fields[0]);
		if ($rsgrp->EOF) {
			$Refund_Report_detailed->paying_programarea->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $Refund_Report_detailed;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$Refund_Report_detailed->date->setDbValue($rs->fields('date'));
			$Refund_Report_detailed->status->setDbValue($rs->fields('status'));
			$Refund_Report_detailed->refund_amount->setDbValue($rs->fields('refund_amount'));
			$Refund_Report_detailed->amount->setDbValue($rs->fields('amount'));
			$Refund_Report_detailed->outstanding_amount->setDbValue($rs->fields('outstanding_amount'));
			$Refund_Report_detailed->year->setDbValue($rs->fields('year'));
			$Refund_Report_detailed->bankname->setDbValue($rs->fields('bankname'));
			$Refund_Report_detailed->account_no->setDbValue($rs->fields('account_no'));
			$Refund_Report_detailed->annual_amount->setDbValue($rs->fields('annual_amount'));
			$Refund_Report_detailed->student_firstname->setDbValue($rs->fields('student_firstname'));
			$Refund_Report_detailed->student_lastname->setDbValue($rs->fields('student_lastname'));
			$Refund_Report_detailed->student_middlename->setDbValue($rs->fields('student_middlename'));
			$Refund_Report_detailed->school_name->setDbValue($rs->fields('school_name'));
			if ($opt <> 1) {
				if (is_array($Refund_Report_detailed->paying_programarea->GroupDbValues))
					$Refund_Report_detailed->paying_programarea->setDbValue(@$Refund_Report_detailed->paying_programarea->GroupDbValues[$rs->fields('paying_programarea')]);
				else
					$Refund_Report_detailed->paying_programarea->setDbValue(ewrpt_GroupValue($Refund_Report_detailed->paying_programarea, $rs->fields('paying_programarea')));
			}
			$Refund_Report_detailed->residence_programarea->setDbValue($rs->fields('residence_programarea'));
			$this->Val[1] = $Refund_Report_detailed->date->CurrentValue;
			$this->Val[2] = $Refund_Report_detailed->refund_amount->CurrentValue;
			$this->Val[3] = $Refund_Report_detailed->amount->CurrentValue;
			$this->Val[4] = $Refund_Report_detailed->outstanding_amount->CurrentValue;
			$this->Val[5] = $Refund_Report_detailed->year->CurrentValue;
			$this->Val[6] = $Refund_Report_detailed->annual_amount->CurrentValue;
			$this->Val[7] = $Refund_Report_detailed->student_firstname->CurrentValue;
			$this->Val[8] = $Refund_Report_detailed->student_lastname->CurrentValue;
			$this->Val[9] = $Refund_Report_detailed->student_middlename->CurrentValue;
		} else {
			$Refund_Report_detailed->date->setDbValue("");
			$Refund_Report_detailed->status->setDbValue("");
			$Refund_Report_detailed->refund_amount->setDbValue("");
			$Refund_Report_detailed->amount->setDbValue("");
			$Refund_Report_detailed->outstanding_amount->setDbValue("");
			$Refund_Report_detailed->year->setDbValue("");
			$Refund_Report_detailed->bankname->setDbValue("");
			$Refund_Report_detailed->account_no->setDbValue("");
			$Refund_Report_detailed->annual_amount->setDbValue("");
			$Refund_Report_detailed->student_firstname->setDbValue("");
			$Refund_Report_detailed->student_lastname->setDbValue("");
			$Refund_Report_detailed->student_middlename->setDbValue("");
			$Refund_Report_detailed->school_name->setDbValue("");
			$Refund_Report_detailed->paying_programarea->setDbValue("");
			$Refund_Report_detailed->residence_programarea->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $Refund_Report_detailed;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$Refund_Report_detailed->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$Refund_Report_detailed->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $Refund_Report_detailed->getStartGroup();
			}
		} else {
			$this->StartGrp = $Refund_Report_detailed->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$Refund_Report_detailed->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$Refund_Report_detailed->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$Refund_Report_detailed->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $Refund_Report_detailed;

		// Initialize popup
		// Build distinct values for paying_programarea

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Refund_Report_detailed->paying_programarea->SqlSelect, $Refund_Report_detailed->SqlWhere(), $Refund_Report_detailed->SqlGroupBy(), $Refund_Report_detailed->SqlHaving(), $Refund_Report_detailed->paying_programarea->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Refund_Report_detailed->paying_programarea->setDbValue($rswrk->fields[0]);
			if (is_null($Refund_Report_detailed->paying_programarea->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Refund_Report_detailed->paying_programarea->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Refund_Report_detailed->paying_programarea->GroupViewValue = ewrpt_DisplayGroupValue($Refund_Report_detailed->paying_programarea,$Refund_Report_detailed->paying_programarea->GroupValue());
				ewrpt_SetupDistinctValues($Refund_Report_detailed->paying_programarea->ValueList, $Refund_Report_detailed->paying_programarea->GroupValue(), $Refund_Report_detailed->paying_programarea->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Refund_Report_detailed->paying_programarea->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Refund_Report_detailed->paying_programarea->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for school_name
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Refund_Report_detailed->school_name->SqlSelect, $Refund_Report_detailed->SqlWhere(), $Refund_Report_detailed->SqlGroupBy(), $Refund_Report_detailed->SqlHaving(), $Refund_Report_detailed->school_name->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Refund_Report_detailed->school_name->setDbValue($rswrk->fields[0]);
			if (is_null($Refund_Report_detailed->school_name->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Refund_Report_detailed->school_name->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Refund_Report_detailed->school_name->GroupViewValue = ewrpt_DisplayGroupValue($Refund_Report_detailed->school_name,$Refund_Report_detailed->school_name->GroupValue());
				ewrpt_SetupDistinctValues($Refund_Report_detailed->school_name->ValueList, $Refund_Report_detailed->school_name->GroupValue(), $Refund_Report_detailed->school_name->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Refund_Report_detailed->school_name->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Refund_Report_detailed->school_name->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

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
				$this->ClearSessionSelection('paying_programarea');
				$this->ClearSessionSelection('school_name');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get programarea name selected values

		if (is_array(@$_SESSION["sel_Refund_Report_detailed_paying_programarea"])) {
			$this->LoadSelectionFromSession('paying_programarea');
		} elseif (@$_SESSION["sel_Refund_Report_detailed_paying_programarea"] == EWRPT_INIT_VALUE) { // Select all
			$Refund_Report_detailed->paying_programarea->SelectionList = "";
		}

		// Get school name selected values
		if (is_array(@$_SESSION["sel_Refund_Report_detailed_school_name"])) {
			$this->LoadSelectionFromSession('school_name');
		} elseif (@$_SESSION["sel_Refund_Report_detailed_school_name"] == EWRPT_INIT_VALUE) { // Select all
			$Refund_Report_detailed->school_name->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $Refund_Report_detailed;
		$this->StartGrp = 1;
		$Refund_Report_detailed->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $Refund_Report_detailed;
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
			$Refund_Report_detailed->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$Refund_Report_detailed->setStartGroup($this->StartGrp);
		} else {
			if ($Refund_Report_detailed->getGroupPerPage() <> "") {
				$this->DisplayGrps = $Refund_Report_detailed->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $Refund_Report_detailed;
		if ($Refund_Report_detailed->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($Refund_Report_detailed->SqlSelectCount(), $Refund_Report_detailed->SqlWhere(), $Refund_Report_detailed->SqlGroupBy(), $Refund_Report_detailed->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}

			// Get total from sql directly
			$sSql = ewrpt_BuildReportSql($Refund_Report_detailed->SqlSelectAgg(), $Refund_Report_detailed->SqlWhere(), $Refund_Report_detailed->SqlGroupBy(), $Refund_Report_detailed->SqlHaving(), "", $this->Filter, "");
			$sSql = $Refund_Report_detailed->SqlAggPfx() . $sSql . $Refund_Report_detailed->SqlAggSfx();
			$rsagg = $conn->Execute($sSql);
			if ($rsagg) {
				$this->GrandSmry[2] = $rsagg->fields("sum_refund_amount");
				$this->GrandSmry[3] = $rsagg->fields("sum_amount");
				$this->GrandSmry[4] = $rsagg->fields("sum_outstanding_amount");
				$this->GrandSmry[6] = $rsagg->fields("sum_annual_amount");
				$rsagg->Close();
			} else {

				// Accumulate grand summary from detail records
				$sSql = ewrpt_BuildReportSql($Refund_Report_detailed->SqlSelect(), $Refund_Report_detailed->SqlWhere(), $Refund_Report_detailed->SqlGroupBy(), $Refund_Report_detailed->SqlHaving(), "", $this->Filter, "");
				$rs = $conn->Execute($sSql);
				if ($rs) {
					$this->GetRow(1);
					while (!$rs->EOF) {
						$this->AccumulateGrandSummary();
						$this->GetRow(2);
					}
					$rs->Close();
				}
			}
		}

		// Call Row_Rendering event
		$Refund_Report_detailed->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($Refund_Report_detailed->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// paying_programarea
			$Refund_Report_detailed->paying_programarea->GroupViewValue = $Refund_Report_detailed->paying_programarea->GroupOldValue();
			$Refund_Report_detailed->paying_programarea->CellAttrs["class"] = ($Refund_Report_detailed->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$Refund_Report_detailed->paying_programarea->GroupViewValue = ewrpt_DisplayGroupValue($Refund_Report_detailed->paying_programarea, $Refund_Report_detailed->paying_programarea->GroupViewValue);

			// school_name
			$Refund_Report_detailed->school_name->GroupViewValue = $Refund_Report_detailed->school_name->GroupOldValue();
			$Refund_Report_detailed->school_name->CellAttrs["class"] = ($Refund_Report_detailed->RowGroupLevel == 2) ? "ewRptGrpSummary2" : "ewRptGrpField2";
			$Refund_Report_detailed->school_name->GroupViewValue = ewrpt_DisplayGroupValue($Refund_Report_detailed->school_name, $Refund_Report_detailed->school_name->GroupViewValue);

			// date
			$Refund_Report_detailed->date->ViewValue = $Refund_Report_detailed->date->Summary;
			$Refund_Report_detailed->date->ViewValue = ewrpt_FormatDateTime($Refund_Report_detailed->date->ViewValue, 5);

			// refund_amount
			$Refund_Report_detailed->refund_amount->ViewValue = $Refund_Report_detailed->refund_amount->Summary;

			// amount
			$Refund_Report_detailed->amount->ViewValue = $Refund_Report_detailed->amount->Summary;

			// outstanding_amount
			$Refund_Report_detailed->outstanding_amount->ViewValue = $Refund_Report_detailed->outstanding_amount->Summary;

			// year
			$Refund_Report_detailed->year->ViewValue = $Refund_Report_detailed->year->Summary;

			// annual_amount
			$Refund_Report_detailed->annual_amount->ViewValue = $Refund_Report_detailed->annual_amount->Summary;

			// student_firstname
			$Refund_Report_detailed->student_firstname->ViewValue = $Refund_Report_detailed->student_firstname->Summary;

			// student_lastname
			$Refund_Report_detailed->student_lastname->ViewValue = $Refund_Report_detailed->student_lastname->Summary;

			// student_middlename
			$Refund_Report_detailed->student_middlename->ViewValue = $Refund_Report_detailed->student_middlename->Summary;
		} else {

			// paying_programarea
			$Refund_Report_detailed->paying_programarea->GroupViewValue = $Refund_Report_detailed->paying_programarea->GroupValue();
			$Refund_Report_detailed->paying_programarea->CellAttrs["class"] = "ewRptGrpField1";
			$Refund_Report_detailed->paying_programarea->GroupViewValue = ewrpt_DisplayGroupValue($Refund_Report_detailed->paying_programarea, $Refund_Report_detailed->paying_programarea->GroupViewValue);
			if ($Refund_Report_detailed->paying_programarea->GroupValue() == $Refund_Report_detailed->paying_programarea->GroupOldValue() && !$this->ChkLvlBreak(1))
				$Refund_Report_detailed->paying_programarea->GroupViewValue = "&nbsp;";

			// school_name
			$Refund_Report_detailed->school_name->GroupViewValue = $Refund_Report_detailed->school_name->GroupValue();
			$Refund_Report_detailed->school_name->CellAttrs["class"] = "ewRptGrpField2";
			$Refund_Report_detailed->school_name->GroupViewValue = ewrpt_DisplayGroupValue($Refund_Report_detailed->school_name, $Refund_Report_detailed->school_name->GroupViewValue);
			if ($Refund_Report_detailed->school_name->GroupValue() == $Refund_Report_detailed->school_name->GroupOldValue() && !$this->ChkLvlBreak(2))
				$Refund_Report_detailed->school_name->GroupViewValue = "&nbsp;";

			// date
			$Refund_Report_detailed->date->ViewValue = $Refund_Report_detailed->date->CurrentValue;
			$Refund_Report_detailed->date->ViewValue = ewrpt_FormatDateTime($Refund_Report_detailed->date->ViewValue, 5);
			$Refund_Report_detailed->date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// refund_amount
			$Refund_Report_detailed->refund_amount->ViewValue = $Refund_Report_detailed->refund_amount->CurrentValue;
			$Refund_Report_detailed->refund_amount->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// amount
			$Refund_Report_detailed->amount->ViewValue = $Refund_Report_detailed->amount->CurrentValue;
			$Refund_Report_detailed->amount->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// outstanding_amount
			$Refund_Report_detailed->outstanding_amount->ViewValue = $Refund_Report_detailed->outstanding_amount->CurrentValue;
			$Refund_Report_detailed->outstanding_amount->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// year
			$Refund_Report_detailed->year->ViewValue = $Refund_Report_detailed->year->CurrentValue;
			$Refund_Report_detailed->year->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// annual_amount
			$Refund_Report_detailed->annual_amount->ViewValue = $Refund_Report_detailed->annual_amount->CurrentValue;
			$Refund_Report_detailed->annual_amount->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// student_firstname
			$Refund_Report_detailed->student_firstname->ViewValue = $Refund_Report_detailed->student_firstname->CurrentValue;
			$Refund_Report_detailed->student_firstname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// student_lastname
			$Refund_Report_detailed->student_lastname->ViewValue = $Refund_Report_detailed->student_lastname->CurrentValue;
			$Refund_Report_detailed->student_lastname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// student_middlename
			$Refund_Report_detailed->student_middlename->ViewValue = $Refund_Report_detailed->student_middlename->CurrentValue;
			$Refund_Report_detailed->student_middlename->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// paying_programarea
		$Refund_Report_detailed->paying_programarea->HrefValue = "";

		// school_name
		$Refund_Report_detailed->school_name->HrefValue = "";

		// date
		$Refund_Report_detailed->date->HrefValue = "";

		// refund_amount
		$Refund_Report_detailed->refund_amount->HrefValue = "";

		// amount
		$Refund_Report_detailed->amount->HrefValue = "";

		// outstanding_amount
		$Refund_Report_detailed->outstanding_amount->HrefValue = "";

		// year
		$Refund_Report_detailed->year->HrefValue = "";

		// annual_amount
		$Refund_Report_detailed->annual_amount->HrefValue = "";

		// student_firstname
		$Refund_Report_detailed->student_firstname->HrefValue = "";

		// student_lastname
		$Refund_Report_detailed->student_lastname->HrefValue = "";

		// student_middlename
		$Refund_Report_detailed->student_middlename->HrefValue = "";

		// Call Row_Rendered event
		$Refund_Report_detailed->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $Refund_Report_detailed;
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $Refund_Report_detailed;
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
			// Field date

			$this->SetSessionFilterValues($Refund_Report_detailed->date->SearchValue, $Refund_Report_detailed->date->SearchOperator, $Refund_Report_detailed->date->SearchCondition, $Refund_Report_detailed->date->SearchValue2, $Refund_Report_detailed->date->SearchOperator2, 'date');
			$bSetupFilter = TRUE;
		} else {

			// Field date
			if ($this->GetFilterValues($Refund_Report_detailed->date)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}
			if (!$this->ValidateForm()) {
				$this->setMessage($gsFormError);
				return $sFilter;
			}
		}

		// Restore session
		if ($bRestoreSession) {

			// Field date
			$this->GetSessionFilterValues($Refund_Report_detailed->date);
		}

		// Call page filter validated event
		$Refund_Report_detailed->Page_FilterValidated();

		// Build SQL
		// Field date

		$this->BuildExtendedFilter($Refund_Report_detailed->date, $sFilter);

		// Save parms to session
		// Field date

		$this->SetSessionFilterValues($Refund_Report_detailed->date->SearchValue, $Refund_Report_detailed->date->SearchOperator, $Refund_Report_detailed->date->SearchCondition, $Refund_Report_detailed->date->SearchValue2, $Refund_Report_detailed->date->SearchOperator2, 'date');

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
		$this->GetSessionValue($fld->DropDownValue, 'sv_Refund_Report_detailed_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_Refund_Report_detailed_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_Refund_Report_detailed_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_Refund_Report_detailed_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_Refund_Report_detailed_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_Refund_Report_detailed_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_Refund_Report_detailed_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_Refund_Report_detailed_' . $parm] = $sv1;
		$_SESSION['so1_Refund_Report_detailed_' . $parm] = $so1;
		$_SESSION['sc_Refund_Report_detailed_' . $parm] = $sc;
		$_SESSION['sv2_Refund_Report_detailed_' . $parm] = $sv2;
		$_SESSION['so2_Refund_Report_detailed_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $Refund_Report_detailed;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ewrpt_CheckDate($Refund_Report_detailed->date->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Refund_Report_detailed->date->FldErrMsg();
		}
		if (!ewrpt_CheckDate($Refund_Report_detailed->date->SearchValue2)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $Refund_Report_detailed->date->FldErrMsg();
		}

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
		$_SESSION["sel_Refund_Report_detailed_$parm"] = "";
		$_SESSION["rf_Refund_Report_detailed_$parm"] = "";
		$_SESSION["rt_Refund_Report_detailed_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $Refund_Report_detailed;
		$fld =& $Refund_Report_detailed->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_Refund_Report_detailed_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_Refund_Report_detailed_$parm"];
		$fld->RangeTo = @$_SESSION["rt_Refund_Report_detailed_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $Refund_Report_detailed;

		/**
		* Set up default values for non Text filters
		*/

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

		// Field date
		$this->SetDefaultExtFilter($Refund_Report_detailed->date, "BETWEEN", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($Refund_Report_detailed->date);

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/

		// Field school_name
		// Setup your default values for the popup filter below, e.g.
		// $Refund_Report_detailed->school_name->DefaultSelectionList = array("val1", "val2");

		$Refund_Report_detailed->school_name->DefaultSelectionList = "";
		$Refund_Report_detailed->school_name->SelectionList = $Refund_Report_detailed->school_name->DefaultSelectionList;

		// Field paying_programarea
		// Setup your default values for the popup filter below, e.g.
		// $Refund_Report_detailed->paying_programarea->DefaultSelectionList = array("val1", "val2");

		$Refund_Report_detailed->paying_programarea->DefaultSelectionList = "";
		$Refund_Report_detailed->paying_programarea->SelectionList = $Refund_Report_detailed->paying_programarea->DefaultSelectionList;
	}

	// Check if filter applied
	function CheckFilter() {
		global $Refund_Report_detailed;

		// Check date text filter
		if ($this->TextFilterApplied($Refund_Report_detailed->date))
			return TRUE;

		// Check school_name popup filter
		if (!ewrpt_MatchedArray($Refund_Report_detailed->school_name->DefaultSelectionList, $Refund_Report_detailed->school_name->SelectionList))
			return TRUE;

		// Check paying_programarea popup filter
		if (!ewrpt_MatchedArray($Refund_Report_detailed->paying_programarea->DefaultSelectionList, $Refund_Report_detailed->paying_programarea->SelectionList))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $Refund_Report_detailed;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field date
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($Refund_Report_detailed->date, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Refund_Report_detailed->date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field school_name
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($Refund_Report_detailed->school_name->SelectionList))
			$sWrk = ewrpt_JoinArray($Refund_Report_detailed->school_name->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Refund_Report_detailed->school_name->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field paying_programarea
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($Refund_Report_detailed->paying_programarea->SelectionList))
			$sWrk = ewrpt_JoinArray($Refund_Report_detailed->paying_programarea->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Refund_Report_detailed->paying_programarea->FldCaption() . "<br />";
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
		global $Refund_Report_detailed;
		$sWrk = "";
			if (is_array($Refund_Report_detailed->school_name->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Refund_Report_detailed->school_name, "schools.school_name", EWRPT_DATATYPE_STRING);
			}
			if (is_array($Refund_Report_detailed->paying_programarea->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Refund_Report_detailed->paying_programarea, "programarea.programarea_name", EWRPT_DATATYPE_STRING);
			}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $Refund_Report_detailed;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$Refund_Report_detailed->setOrderBy("");
				$Refund_Report_detailed->setStartGroup(1);
				$Refund_Report_detailed->paying_programarea->setSort("");
				$Refund_Report_detailed->school_name->setSort("");
				$Refund_Report_detailed->date->setSort("");
				$Refund_Report_detailed->refund_amount->setSort("");
				$Refund_Report_detailed->amount->setSort("");
				$Refund_Report_detailed->outstanding_amount->setSort("");
				$Refund_Report_detailed->year->setSort("");
				$Refund_Report_detailed->annual_amount->setSort("");
				$Refund_Report_detailed->student_firstname->setSort("");
				$Refund_Report_detailed->student_lastname->setSort("");
				$Refund_Report_detailed->student_middlename->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$Refund_Report_detailed->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$Refund_Report_detailed->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $Refund_Report_detailed->SortSql();
			$Refund_Report_detailed->setOrderBy($sSortSql);
			$Refund_Report_detailed->setStartGroup(1);
		}

		// Set up default sort
		if ($Refund_Report_detailed->getOrderBy() == "") {
			$Refund_Report_detailed->setOrderBy("sponsored_student.student_lastname ASC, sponsored_student.student_firstname ASC");
			$Refund_Report_detailed->student_lastname->setSort("ASC");
			$Refund_Report_detailed->student_firstname->setSort("ASC");
		}
		return $Refund_Report_detailed->getOrderBy();
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

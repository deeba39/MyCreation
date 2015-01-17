<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php

// Global variable for table object
$Refunds_To_Students = NULL;

//
// Table class for Refunds To Students
//
class cRefunds_To_Students {
	var $TableVar = 'Refunds_To_Students';
	var $TableName = 'Refunds To Students';
	var $TableType = 'REPORT';
	var $student_lastname;
	var $student_firstname;
	var $student_middlename;
	var $status;
	var $amount;
	var $refund_amount;
	var $scholarship_type;
	var $RefundAmount;
	var $year;
	var $programarea_name;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = TRUE;
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes
	var $TableFilter = "";

	//
	// Table class constructor
	//
	function cRefunds_To_Students() {
		global $Language;

		// student_lastname
		$this->student_lastname = new cField('Refunds_To_Students', 'Refunds To Students', 'x_student_lastname', 'student_lastname', 'sponsored_student.student_lastname', 200, -1, FALSE, 'sponsored_student.student_lastname', FALSE);
		$this->fields['student_lastname'] =& $this->student_lastname;

		// student_firstname
		$this->student_firstname = new cField('Refunds_To_Students', 'Refunds To Students', 'x_student_firstname', 'student_firstname', 'sponsored_student.student_firstname', 200, -1, FALSE, 'sponsored_student.student_firstname', FALSE);
		$this->fields['student_firstname'] =& $this->student_firstname;

		// student_middlename
		$this->student_middlename = new cField('Refunds_To_Students', 'Refunds To Students', 'x_student_middlename', 'student_middlename', 'sponsored_student.student_middlename', 200, -1, FALSE, 'sponsored_student.student_middlename', FALSE);
		$this->fields['student_middlename'] =& $this->student_middlename;

		// status
		$this->status = new cField('Refunds_To_Students', 'Refunds To Students', 'x_status', 'status', 'scholarship_payment.status', 202, -1, FALSE, 'scholarship_payment.status', FALSE);
		$this->status->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['status'] =& $this->status;

		// amount
		$this->amount = new cField('Refunds_To_Students', 'Refunds To Students', 'x_amount', 'amount', 'scholarship_payment.amount', 131, -1, FALSE, 'scholarship_payment.amount', FALSE);
		$this->amount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['amount'] =& $this->amount;

		// refund_amount
		$this->refund_amount = new cField('Refunds_To_Students', 'Refunds To Students', 'x_refund_amount', 'refund_amount', 'scholarship_payment.refund_amount', 131, -1, FALSE, 'scholarship_payment.refund_amount', FALSE);
		$this->refund_amount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['refund_amount'] =& $this->refund_amount;

		// scholarship_type
		$this->scholarship_type = new cField('Refunds_To_Students', 'Refunds To Students', 'x_scholarship_type', 'scholarship_type', 'scholarship_package.scholarship_type', 3, -1, FALSE, 'scholarship_package.scholarship_type', FALSE);
		$this->scholarship_type->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['scholarship_type'] =& $this->scholarship_type;

		// RefundAmount
		$this->RefundAmount = new cField('Refunds_To_Students', 'Refunds To Students', 'x_RefundAmount', 'RefundAmount', 'scholarship_payment.amount - scholarship_payment.refund_amount', 131, -1, FALSE, 'scholarship_payment.amount - scholarship_payment.refund_amount', FALSE);
		$this->RefundAmount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['RefundAmount'] =& $this->RefundAmount;

		// year
		$this->year = new cField('Refunds_To_Students', 'Refunds To Students', 'x_year', 'year', 'scholarship_payment.year', 3, -1, FALSE, 'scholarship_payment.year', FALSE);
		$this->year->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['year'] =& $this->year;

		// programarea_name
		$this->programarea_name = new cField('Refunds_To_Students', 'Refunds To Students', 'x_programarea_name', 'programarea_name', 'programarea.programarea_name', 200, -1, FALSE, 'programarea.programarea_name', FALSE);
		$this->fields['programarea_name'] =& $this->programarea_name;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Report group level SQL
	function SqlGroupSelect() { // Select
		return "SELECT DISTINCT programarea.programarea_name,scholarship_payment.year,scholarship_package.scholarship_type FROM scholarship_package Inner Join sponsored_student On sponsored_student.sponsored_student_id = scholarship_package.sponsored_student_sponsored_student_id Inner Join scholarship_payment On scholarship_payment.scholarship_package_scholarship_package_id = scholarship_package.scholarship_package_id Inner Join programarea On scholarship_payment.programarea_payingarea_id = programarea.programarea_id";
	}

	function SqlGroupWhere() { // Where
		return "";
	}

	function SqlGroupGroupBy() { // Group By
		return "";
	}

	function SqlGroupHaving() { // Having
		return "";
	}

	function SqlGroupOrderBy() { // Order By
		return "programarea.programarea_name ASC,scholarship_payment.year ASC,scholarship_package.scholarship_type ASC";
	}

	// Report detail level SQL
	function SqlDetailSelect() { // Select
		return "SELECT sponsored_student.student_lastname, sponsored_student.student_firstname, sponsored_student.student_middlename, scholarship_payment.status, scholarship_payment.amount, scholarship_payment.refund_amount, scholarship_package.scholarship_type, scholarship_payment.amount - scholarship_payment.refund_amount As RefundAmount, scholarship_payment.year, programarea.programarea_name FROM scholarship_package Inner Join sponsored_student On sponsored_student.sponsored_student_id = scholarship_package.sponsored_student_sponsored_student_id Inner Join scholarship_payment On scholarship_payment.scholarship_package_scholarship_package_id = scholarship_package.scholarship_package_id Inner Join programarea On scholarship_payment.programarea_payingarea_id = programarea.programarea_id";
	}

	function SqlDetailWhere() { // Where
		return "";
	}

	function SqlDetailGroupBy() { // Group By
		return "";
	}

	function SqlDetailHaving() { // Having
		return "";
	}

	function SqlDetailOrderBy() { // Order By
		return "sponsored_student.student_lastname ASC,sponsored_student.student_firstname ASC,scholarship_payment.amount - scholarship_payment.refund_amount ASC";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Report group SQL
	function GroupSQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = "";
		return ew_BuildSelectSql($this->SqlGroupSelect(), $this->SqlGroupWhere(),
			 $this->SqlGroupGroupBy(), $this->SqlGroupHaving(),
			 $this->SqlGroupOrderBy(), $sFilter, $sSort);
	}

	// Report detail SQL
	function DetailSQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = "";
		return ew_BuildSelectSql($this->SqlDetailSelect(), $this->SqlDetailWhere(),
			$this->SqlDetailGroupBy(), $this->SqlDetailHaving(),
			$this->SqlDetailOrderBy(), $sFilter, $sSort);
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "Refunds_To_Studentsreport.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "Refunds_To_Studentsreport.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=Refunds_To_Students" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->student_lastname->setDbValue($rs->fields('student_lastname'));
		$this->student_firstname->setDbValue($rs->fields('student_firstname'));
		$this->student_middlename->setDbValue($rs->fields('student_middlename'));
		$this->status->setDbValue($rs->fields('status'));
		$this->amount->setDbValue($rs->fields('amount'));
		$this->refund_amount->setDbValue($rs->fields('refund_amount'));
		$this->scholarship_type->setDbValue($rs->fields('scholarship_type'));
		$this->RefundAmount->setDbValue($rs->fields('RefundAmount'));
		$this->year->setDbValue($rs->fields('year'));
		$this->programarea_name->setDbValue($rs->fields('programarea_name'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

   // Common render codes
		// student_lastname

		$Refunds_To_Students->student_lastname->CellCssStyle = ""; $Refunds_To_Students->student_lastname->CellCssClass = "";
		$Refunds_To_Students->student_lastname->CellAttrs = array(); $Refunds_To_Students->student_lastname->ViewAttrs = array(); $Refunds_To_Students->student_lastname->EditAttrs = array();

		// student_firstname
		$Refunds_To_Students->student_firstname->CellCssStyle = ""; $Refunds_To_Students->student_firstname->CellCssClass = "";
		$Refunds_To_Students->student_firstname->CellAttrs = array(); $Refunds_To_Students->student_firstname->ViewAttrs = array(); $Refunds_To_Students->student_firstname->EditAttrs = array();

		// student_middlename
		$Refunds_To_Students->student_middlename->CellCssStyle = ""; $Refunds_To_Students->student_middlename->CellCssClass = "";
		$Refunds_To_Students->student_middlename->CellAttrs = array(); $Refunds_To_Students->student_middlename->ViewAttrs = array(); $Refunds_To_Students->student_middlename->EditAttrs = array();

		// status
		$Refunds_To_Students->status->CellCssStyle = ""; $Refunds_To_Students->status->CellCssClass = "";
		$Refunds_To_Students->status->CellAttrs = array(); $Refunds_To_Students->status->ViewAttrs = array(); $Refunds_To_Students->status->EditAttrs = array();

		// amount
		$Refunds_To_Students->amount->CellCssStyle = ""; $Refunds_To_Students->amount->CellCssClass = "";
		$Refunds_To_Students->amount->CellAttrs = array(); $Refunds_To_Students->amount->ViewAttrs = array(); $Refunds_To_Students->amount->EditAttrs = array();

		// refund_amount
		$Refunds_To_Students->refund_amount->CellCssStyle = ""; $Refunds_To_Students->refund_amount->CellCssClass = "";
		$Refunds_To_Students->refund_amount->CellAttrs = array(); $Refunds_To_Students->refund_amount->ViewAttrs = array(); $Refunds_To_Students->refund_amount->EditAttrs = array();

		// scholarship_type
		$Refunds_To_Students->scholarship_type->CellCssStyle = ""; $Refunds_To_Students->scholarship_type->CellCssClass = "";
		$Refunds_To_Students->scholarship_type->CellAttrs = array(); $Refunds_To_Students->scholarship_type->ViewAttrs = array(); $Refunds_To_Students->scholarship_type->EditAttrs = array();

		// RefundAmount
		$Refunds_To_Students->RefundAmount->CellCssStyle = ""; $Refunds_To_Students->RefundAmount->CellCssClass = "";
		$Refunds_To_Students->RefundAmount->CellAttrs = array(); $Refunds_To_Students->RefundAmount->ViewAttrs = array(); $Refunds_To_Students->RefundAmount->EditAttrs = array();

		// year
		$Refunds_To_Students->year->CellCssStyle = ""; $Refunds_To_Students->year->CellCssClass = "";
		$Refunds_To_Students->year->CellAttrs = array(); $Refunds_To_Students->year->ViewAttrs = array(); $Refunds_To_Students->year->EditAttrs = array();

		// programarea_name
		$Refunds_To_Students->programarea_name->CellCssStyle = ""; $Refunds_To_Students->programarea_name->CellCssClass = "";
		$Refunds_To_Students->programarea_name->CellAttrs = array(); $Refunds_To_Students->programarea_name->ViewAttrs = array(); $Refunds_To_Students->programarea_name->EditAttrs = array();

		// student_lastname
		$Refunds_To_Students->student_lastname->ViewValue = $Refunds_To_Students->student_lastname->CurrentValue;
		$Refunds_To_Students->student_lastname->CssStyle = "";
		$Refunds_To_Students->student_lastname->CssClass = "";
		$Refunds_To_Students->student_lastname->ViewCustomAttributes = "";

		// student_firstname
		$Refunds_To_Students->student_firstname->ViewValue = $Refunds_To_Students->student_firstname->CurrentValue;
		$Refunds_To_Students->student_firstname->CssStyle = "";
		$Refunds_To_Students->student_firstname->CssClass = "";
		$Refunds_To_Students->student_firstname->ViewCustomAttributes = "";

		// student_middlename
		$Refunds_To_Students->student_middlename->ViewValue = $Refunds_To_Students->student_middlename->CurrentValue;
		$Refunds_To_Students->student_middlename->CssStyle = "";
		$Refunds_To_Students->student_middlename->CssClass = "";
		$Refunds_To_Students->student_middlename->ViewCustomAttributes = "";

		// status
		if (strval($Refunds_To_Students->status->CurrentValue) <> "") {
			switch ($Refunds_To_Students->status->CurrentValue) {
				case "PENDING":
					$Refunds_To_Students->status->ViewValue = "PENDING";
					break;
				case "PAID":
					$Refunds_To_Students->status->ViewValue = "PAID";
					break;
				default:
					$Refunds_To_Students->status->ViewValue = $Refunds_To_Students->status->CurrentValue;
			}
		} else {
			$Refunds_To_Students->status->ViewValue = NULL;
		}
		$Refunds_To_Students->status->CssStyle = "";
		$Refunds_To_Students->status->CssClass = "";
		$Refunds_To_Students->status->ViewCustomAttributes = "";

		// amount
		$Refunds_To_Students->amount->ViewValue = $Refunds_To_Students->amount->CurrentValue;
		$Refunds_To_Students->amount->CssStyle = "";
		$Refunds_To_Students->amount->CssClass = "";
		$Refunds_To_Students->amount->ViewCustomAttributes = "";

		// refund_amount
		$Refunds_To_Students->refund_amount->ViewValue = $Refunds_To_Students->refund_amount->CurrentValue;
		$Refunds_To_Students->refund_amount->CssStyle = "";
		$Refunds_To_Students->refund_amount->CssClass = "";
		$Refunds_To_Students->refund_amount->ViewCustomAttributes = "";

		// scholarship_type
		$Refunds_To_Students->scholarship_type->ViewValue = $Refunds_To_Students->scholarship_type->CurrentValue;
		$Refunds_To_Students->scholarship_type->CssStyle = "";
		$Refunds_To_Students->scholarship_type->CssClass = "";
		$Refunds_To_Students->scholarship_type->ViewCustomAttributes = "";

		// RefundAmount
		$Refunds_To_Students->RefundAmount->ViewValue = $Refunds_To_Students->RefundAmount->CurrentValue;
		$Refunds_To_Students->RefundAmount->CssStyle = "";
		$Refunds_To_Students->RefundAmount->CssClass = "";
		$Refunds_To_Students->RefundAmount->ViewCustomAttributes = "";

		// year
		$Refunds_To_Students->year->ViewValue = $Refunds_To_Students->year->CurrentValue;
		$Refunds_To_Students->year->CssStyle = "";
		$Refunds_To_Students->year->CssClass = "";
		$Refunds_To_Students->year->ViewCustomAttributes = "";

		// programarea_name
		$Refunds_To_Students->programarea_name->ViewValue = $Refunds_To_Students->programarea_name->CurrentValue;
		$Refunds_To_Students->programarea_name->CssStyle = "";
		$Refunds_To_Students->programarea_name->CssClass = "";
		$Refunds_To_Students->programarea_name->ViewCustomAttributes = "";

		// student_lastname
		$Refunds_To_Students->student_lastname->HrefValue = "";
		$Refunds_To_Students->student_lastname->TooltipValue = "";

		// student_firstname
		$Refunds_To_Students->student_firstname->HrefValue = "";
		$Refunds_To_Students->student_firstname->TooltipValue = "";

		// student_middlename
		$Refunds_To_Students->student_middlename->HrefValue = "";
		$Refunds_To_Students->student_middlename->TooltipValue = "";

		// status
		$Refunds_To_Students->status->HrefValue = "";
		$Refunds_To_Students->status->TooltipValue = "";

		// amount
		$Refunds_To_Students->amount->HrefValue = "";
		$Refunds_To_Students->amount->TooltipValue = "";

		// refund_amount
		$Refunds_To_Students->refund_amount->HrefValue = "";
		$Refunds_To_Students->refund_amount->TooltipValue = "";

		// scholarship_type
		$Refunds_To_Students->scholarship_type->HrefValue = "";
		$Refunds_To_Students->scholarship_type->TooltipValue = "";

		// RefundAmount
		$Refunds_To_Students->RefundAmount->HrefValue = "";
		$Refunds_To_Students->RefundAmount->TooltipValue = "";

		// year
		$Refunds_To_Students->year->HrefValue = "";
		$Refunds_To_Students->year->TooltipValue = "";

		// programarea_name
		$Refunds_To_Students->programarea_name->HrefValue = "";
		$Refunds_To_Students->programarea_name->TooltipValue = "";
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}
}
?>
<?php include "usersinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$Refunds_To_Students_report = new cRefunds_To_Students_report();
$Page =& $Refunds_To_Students_report;

// Page init
$Refunds_To_Students_report->Page_Init();

// Page main
$Refunds_To_Students_report->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($Refunds_To_Students->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($Refunds_To_Students->Export == "") { ?>
<?php } ?>
<p><span class="phpmaker"><?php echo $Language->Phrase("TblTypeReport") ?><?php echo $Refunds_To_Students->TableCaption() ?>
<?php if ($Refunds_To_Students->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Refunds_To_Students_report->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Refunds_To_Students_report->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<form method="post">
<table class="ewReportTable" cellspacing="-1">
<?php
$Refunds_To_Students_report->sTblDefaultFilter = "";
$Refunds_To_Students_report->sFilter = $Refunds_To_Students_report->sTblDefaultFilter;
if (!$Security->CanReport()) {
	if ($Refunds_To_Students_report->sFilter <> "") $Refunds_To_Students_report->sFilter .= " AND ";
	$Refunds_To_Students_report->sFilter .= "(0=1)";
}
if ($Refunds_To_Students_report->sDbDetailFilter <> "") {
	if ($Refunds_To_Students_report->sFilter <> "") $Refunds_To_Students_report->sFilter .= " AND ";
	$Refunds_To_Students_report->sFilter .= "(" . $Refunds_To_Students_report->sDbDetailFilter . ")";
}

// Set up filter and load Group level sql
$Refunds_To_Students->CurrentFilter = $Refunds_To_Students_report->sFilter;
$Refunds_To_Students_report->sSql = $Refunds_To_Students->GroupSQL();

// Load recordset
$rs = $conn->Execute($Refunds_To_Students_report->sSql);

// Get First Row
if (!$rs->EOF) {
	$Refunds_To_Students->programarea_name->setDbValue($rs->fields('programarea_name'));
	$Refunds_To_Students_report->vGrps[0] = $Refunds_To_Students->programarea_name->DbValue;
	$Refunds_To_Students->year->setDbValue($rs->fields('year'));
	$Refunds_To_Students_report->vGrps[1] = $Refunds_To_Students->year->DbValue;
	$Refunds_To_Students->scholarship_type->setDbValue($rs->fields('scholarship_type'));
	$Refunds_To_Students_report->vGrps[2] = $Refunds_To_Students->scholarship_type->DbValue;
}
$Refunds_To_Students_report->lRecCnt = 0;
$Refunds_To_Students_report->nCntRecs[0] = 0;
$Refunds_To_Students_report->ChkLvlBreak();
while (!$rs->EOF) {

	// Render for view
	$Refunds_To_Students->RowType = EW_ROWTYPE_VIEW;
	$Refunds_To_Students_report->RenderRow();

	// Show group headers
	if ($Refunds_To_Students_report->bLvlBreak[1]) { // Reset counter and aggregation
?>
	<tr><td class="ewGroupField"><span class="phpmaker"><?php echo $Refunds_To_Students->programarea_name->FldCaption() ?></span></td>
	<td colspan=6 class="ewGroupName"><span class="phpmaker">
<div<?php echo $Refunds_To_Students->programarea_name->ViewAttributes() ?>><?php echo $Refunds_To_Students->programarea_name->ViewValue ?></div></span></td></tr>
<?php
	}
	if ($Refunds_To_Students_report->bLvlBreak[2]) { // Reset counter and aggregation
?>
	<tr><td class="ewGroupField"><span class="phpmaker"><?php echo $Refunds_To_Students->year->FldCaption() ?></span></td>
	<td colspan=6 class="ewGroupName"><span class="phpmaker">
<div<?php echo $Refunds_To_Students->year->ViewAttributes() ?>><?php echo $Refunds_To_Students->year->ViewValue ?></div></span></td></tr>
<?php
	}
	if ($Refunds_To_Students_report->bLvlBreak[3]) { // Reset counter and aggregation
?>
	<tr><td class="ewGroupField"><span class="phpmaker"><?php echo $Refunds_To_Students->scholarship_type->FldCaption() ?></span></td>
	<td colspan=6 class="ewGroupName"><span class="phpmaker">
<div<?php echo $Refunds_To_Students->scholarship_type->ViewAttributes() ?>><?php echo $Refunds_To_Students->scholarship_type->ViewValue ?></div></span></td></tr>
<?php
	}

	// Get detail records
	$Refunds_To_Students_report->sFilter = $Refunds_To_Students_report->sTblDefaultFilter;
	if ($Refunds_To_Students_report->sFilter <> "") $Refunds_To_Students_report->sFilter .= " AND ";
	if (is_null($Refunds_To_Students->programarea_name->CurrentValue)) {
		$Refunds_To_Students_report->sFilter .= "(programarea.programarea_name IS NULL)";
	} else {
		$Refunds_To_Students_report->sFilter .= "(programarea.programarea_name = '" . ew_AdjustSql($Refunds_To_Students->programarea_name->CurrentValue) . "')";
	}
	if ($Refunds_To_Students_report->sFilter <> "") $Refunds_To_Students_report->sFilter .= " AND ";
	if (is_null($Refunds_To_Students->year->CurrentValue)) {
		$Refunds_To_Students_report->sFilter .= "(scholarship_payment.year IS NULL)";
	} else {
		$Refunds_To_Students_report->sFilter .= "(scholarship_payment.year = " . ew_AdjustSql($Refunds_To_Students->year->CurrentValue) . ")";
	}
	if ($Refunds_To_Students_report->sFilter <> "") $Refunds_To_Students_report->sFilter .= " AND ";
	if (is_null($Refunds_To_Students->scholarship_type->CurrentValue)) {
		$Refunds_To_Students_report->sFilter .= "(scholarship_package.scholarship_type IS NULL)";
	} else {
		$Refunds_To_Students_report->sFilter .= "(scholarship_package.scholarship_type = " . ew_AdjustSql($Refunds_To_Students->scholarship_type->CurrentValue) . ")";
	}
	if ($Refunds_To_Students_report->sDbDetailFilter <> "") {
		if ($Refunds_To_Students_report->sFilter <> "")
			$Refunds_To_Students_report->sFilter .= " AND ";
		$Refunds_To_Students_report->sFilter .= "(" . $Refunds_To_Students_report->sDbDetailFilter . ")";
	}
	if (!$Security->CanReport()) {
		if ($sFilter <> "") $sFilter .= " AND ";
		$sFilter .= "(0=1)";
	}

	// Set up detail SQL
	$Refunds_To_Students->CurrentFilter = $Refunds_To_Students_report->sFilter;
	$Refunds_To_Students_report->sSql = $Refunds_To_Students->DetailSQL();

	// Load detail records
	$rsdtl = $conn->Execute($Refunds_To_Students_report->sSql);
	$Refunds_To_Students_report->nDtlRecs = $rsdtl->RecordCount();

	// Initialize aggregates
	if (!$rsdtl->EOF) {
		$Refunds_To_Students_report->lRecCnt++;
	}
	if ($Refunds_To_Students_report->lRecCnt == 1) {
		$Refunds_To_Students_report->nCntRecs[0] = 0;
	}
	for ($i = 1; $i <= 3; $i++) {
		if ($Refunds_To_Students_report->bLvlBreak[$i]) { // Reset counter and aggregation
			$Refunds_To_Students_report->nCntRecs[$i] = 0;
		}
	}
	$Refunds_To_Students_report->nCntRecs[0] += $Refunds_To_Students_report->nDtlRecs;
	$Refunds_To_Students_report->nCntRecs[1] += $Refunds_To_Students_report->nDtlRecs;
	$Refunds_To_Students_report->nCntRecs[2] += $Refunds_To_Students_report->nDtlRecs;
	$Refunds_To_Students_report->nCntRecs[3] += $Refunds_To_Students_report->nDtlRecs;
?>
	<tr>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refunds_To_Students->student_lastname->FldCaption() ?></span></td>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refunds_To_Students->student_firstname->FldCaption() ?></span></td>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refunds_To_Students->student_middlename->FldCaption() ?></span></td>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refunds_To_Students->status->FldCaption() ?></span></td>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refunds_To_Students->amount->FldCaption() ?></span></td>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refunds_To_Students->refund_amount->FldCaption() ?></span></td>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refunds_To_Students->RefundAmount->FldCaption() ?></span></td>
	</tr>
<?php
	while (!$rsdtl->EOF) {
		$Refunds_To_Students->student_lastname->setDbValue($rsdtl->fields('student_lastname'));
		$Refunds_To_Students->student_firstname->setDbValue($rsdtl->fields('student_firstname'));
		$Refunds_To_Students->student_middlename->setDbValue($rsdtl->fields('student_middlename'));
		$Refunds_To_Students->status->setDbValue($rsdtl->fields('status'));
		$Refunds_To_Students->amount->setDbValue($rsdtl->fields('amount'));
		$Refunds_To_Students->refund_amount->setDbValue($rsdtl->fields('refund_amount'));
		$Refunds_To_Students->RefundAmount->setDbValue($rsdtl->fields('RefundAmount'));

		// Render for view
		$Refunds_To_Students->RowType = EW_ROWTYPE_VIEW;
		$Refunds_To_Students_report->RenderRow();
?>
	<tr>
		<td><span class="phpmaker">
<div<?php echo $Refunds_To_Students->student_lastname->ViewAttributes() ?>><?php echo $Refunds_To_Students->student_lastname->ViewValue ?></div></span></td>
		<td><span class="phpmaker">
<div<?php echo $Refunds_To_Students->student_firstname->ViewAttributes() ?>><?php echo $Refunds_To_Students->student_firstname->ViewValue ?></div></span></td>
		<td><span class="phpmaker">
<div<?php echo $Refunds_To_Students->student_middlename->ViewAttributes() ?>><?php echo $Refunds_To_Students->student_middlename->ViewValue ?></div></span></td>
		<td><span class="phpmaker">
<div<?php echo $Refunds_To_Students->status->ViewAttributes() ?>><?php echo $Refunds_To_Students->status->ViewValue ?></div></span></td>
		<td><span class="phpmaker">
<div<?php echo $Refunds_To_Students->amount->ViewAttributes() ?>><?php echo $Refunds_To_Students->amount->ViewValue ?></div></span></td>
		<td><span class="phpmaker">
<div<?php echo $Refunds_To_Students->refund_amount->ViewAttributes() ?>><?php echo $Refunds_To_Students->refund_amount->ViewValue ?></div></span></td>
		<td><span class="phpmaker">
<div<?php echo $Refunds_To_Students->RefundAmount->ViewAttributes() ?>><?php echo $Refunds_To_Students->RefundAmount->ViewValue ?></div></span></td>
	</tr>
<?php
		$rsdtl->MoveNext();
	}
	$rsdtl->Close();

	// Save old group data
	$Refunds_To_Students_report->vGrps[0] = $Refunds_To_Students->programarea_name->CurrentValue;
	$Refunds_To_Students_report->vGrps[1] = $Refunds_To_Students->year->CurrentValue;
	$Refunds_To_Students_report->vGrps[2] = $Refunds_To_Students->scholarship_type->CurrentValue;

	// Get next record
	$rs->MoveNext();
	if ($rs->EOF) {
		$Refunds_To_Students_report->lRecCnt = 0; // EOF, force all level breaks
	} else {
		$Refunds_To_Students->programarea_name->setDbValue($rs->fields('programarea_name'));
		$Refunds_To_Students->year->setDbValue($rs->fields('year'));
		$Refunds_To_Students->scholarship_type->setDbValue($rs->fields('scholarship_type'));
	}
	$Refunds_To_Students_report->ChkLvlBreak();

	// Show footers
	if ($Refunds_To_Students_report->bLvlBreak[3]) {
		$Refunds_To_Students->scholarship_type->CurrentValue = $Refunds_To_Students_report->vGrps[2];

		// Render row for view
		$Refunds_To_Students->RowType = EW_ROWTYPE_VIEW;
		$Refunds_To_Students_report->RenderRow();
		$Refunds_To_Students->scholarship_type->CurrentValue = $Refunds_To_Students->scholarship_type->DbValue;
?>
<?php
}
	if ($Refunds_To_Students_report->bLvlBreak[2]) {
		$Refunds_To_Students->year->CurrentValue = $Refunds_To_Students_report->vGrps[1];

		// Render row for view
		$Refunds_To_Students->RowType = EW_ROWTYPE_VIEW;
		$Refunds_To_Students_report->RenderRow();
		$Refunds_To_Students->year->CurrentValue = $Refunds_To_Students->year->DbValue;
?>
<?php
}
	if ($Refunds_To_Students_report->bLvlBreak[1]) {
		$Refunds_To_Students->programarea_name->CurrentValue = $Refunds_To_Students_report->vGrps[0];

		// Render row for view
		$Refunds_To_Students->RowType = EW_ROWTYPE_VIEW;
		$Refunds_To_Students_report->RenderRow();
		$Refunds_To_Students->programarea_name->CurrentValue = $Refunds_To_Students->programarea_name->DbValue;
?>
<?php
}
}

// Close recordset
$rs->Close();
?>
	<tr><td colspan=7><span class="phpmaker">&nbsp;<br></span></td></tr>
	<tr><td colspan=7 class="ewGrandSummary"><span class="phpmaker"><?php echo $Language->Phrase("RptGrandTotal") ?>&nbsp;(<?php echo ew_FormatNumber($Refunds_To_Students_report->nCntRecs[0], 0) ?>&nbsp;<?php echo $Language->Phrase("RptDtlRec") ?>)</span></td></tr>
	<tr><td colspan=7><span class="phpmaker">&nbsp;<br></span></td></tr>
</table>
</form>
<?php if ($Refunds_To_Students->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$Refunds_To_Students_report->Page_Terminate();
?>
<?php

//
// Page class
//
class cRefunds_To_Students_report {

	// Page ID
	var $PageID = 'report';

	// Table name
	var $TableName = 'Refunds To Students';

	// Page object name
	var $PageObjName = 'Refunds_To_Students_report';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
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
		return TRUE;
	}

	//
	// Page class constructor
	//
	function cRefunds_To_Students_report() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (Refunds_To_Students)
		$GLOBALS["Refunds_To_Students"] = new cRefunds_To_Students();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'report', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'Refunds To Students', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $Refunds_To_Students;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanReport()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$Refunds_To_Students->Export = $_GET["export"];
		}
		$gsExport = $Refunds_To_Students->Export; // Get export parameter, used in header
		$gsExportFile = $Refunds_To_Students->TableVar; // Get export file, used in header
		if ($Refunds_To_Students->Export == "excel") {
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
	var $lRecCnt = 0;
	var $sSql = "";
	var $sFilter = "";
	var $sTblDefaultFilter = "";
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $bMasterRecordExists;
	var $sCmd = "";
	var $lDtlRecs;
	var $vGrps;
	var $nCntRecs;
	var $bLvlBreak;
	var $nTotals;
	var $nMaxs;
	var $nMins;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $Refunds_To_Students;
		$this->vGrps =& ew_InitArray(4, NULL);
		$this->nCntRecs =& ew_InitArray(4, 0);
		$this->bLvlBreak =& ew_InitArray(4, FALSE);
		$this->nTotals =& ew_Init2DArray(4, 8, 0);
		$this->nMaxs =& ew_Init2DArray(4, 8, 0);
		$this->nMins =& ew_Init2DArray(4, 8, 0);
	}

	// Check level break
	function ChkLvlBreak() {
		global $Refunds_To_Students;
		$this->bLvlBreak[1] = FALSE;
		$this->bLvlBreak[2] = FALSE;
		$this->bLvlBreak[3] = FALSE;
		if ($this->lRecCnt == 0) { // Start Or End of Recordset
			$this->bLvlBreak[1] = TRUE;
			$this->bLvlBreak[2] = TRUE;
			$this->bLvlBreak[3] = TRUE;
		} else {
			if (!ew_CompareValue($Refunds_To_Students->programarea_name->CurrentValue, $this->vGrps[0])) {
				$this->bLvlBreak[1] = TRUE;
				$this->bLvlBreak[2] = TRUE;
				$this->bLvlBreak[3] = TRUE;
			}
			if (!ew_CompareValue($Refunds_To_Students->year->CurrentValue, $this->vGrps[1])) {
				$this->bLvlBreak[2] = TRUE;
				$this->bLvlBreak[3] = TRUE;
			}
			if (!ew_CompareValue($Refunds_To_Students->scholarship_type->CurrentValue, $this->vGrps[2])) {
				$this->bLvlBreak[3] = TRUE;
			}
		}
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $Refunds_To_Students;

		// Initialize URLs
		// Common render codes for all row types
		// student_lastname

		$Refunds_To_Students->student_lastname->CellCssStyle = ""; $Refunds_To_Students->student_lastname->CellCssClass = "";
		$Refunds_To_Students->student_lastname->CellAttrs = array(); $Refunds_To_Students->student_lastname->ViewAttrs = array(); $Refunds_To_Students->student_lastname->EditAttrs = array();

		// student_firstname
		$Refunds_To_Students->student_firstname->CellCssStyle = ""; $Refunds_To_Students->student_firstname->CellCssClass = "";
		$Refunds_To_Students->student_firstname->CellAttrs = array(); $Refunds_To_Students->student_firstname->ViewAttrs = array(); $Refunds_To_Students->student_firstname->EditAttrs = array();

		// student_middlename
		$Refunds_To_Students->student_middlename->CellCssStyle = ""; $Refunds_To_Students->student_middlename->CellCssClass = "";
		$Refunds_To_Students->student_middlename->CellAttrs = array(); $Refunds_To_Students->student_middlename->ViewAttrs = array(); $Refunds_To_Students->student_middlename->EditAttrs = array();

		// status
		$Refunds_To_Students->status->CellCssStyle = ""; $Refunds_To_Students->status->CellCssClass = "";
		$Refunds_To_Students->status->CellAttrs = array(); $Refunds_To_Students->status->ViewAttrs = array(); $Refunds_To_Students->status->EditAttrs = array();

		// amount
		$Refunds_To_Students->amount->CellCssStyle = ""; $Refunds_To_Students->amount->CellCssClass = "";
		$Refunds_To_Students->amount->CellAttrs = array(); $Refunds_To_Students->amount->ViewAttrs = array(); $Refunds_To_Students->amount->EditAttrs = array();

		// refund_amount
		$Refunds_To_Students->refund_amount->CellCssStyle = ""; $Refunds_To_Students->refund_amount->CellCssClass = "";
		$Refunds_To_Students->refund_amount->CellAttrs = array(); $Refunds_To_Students->refund_amount->ViewAttrs = array(); $Refunds_To_Students->refund_amount->EditAttrs = array();

		// scholarship_type
		$Refunds_To_Students->scholarship_type->CellCssStyle = ""; $Refunds_To_Students->scholarship_type->CellCssClass = "";
		$Refunds_To_Students->scholarship_type->CellAttrs = array(); $Refunds_To_Students->scholarship_type->ViewAttrs = array(); $Refunds_To_Students->scholarship_type->EditAttrs = array();

		// RefundAmount
		$Refunds_To_Students->RefundAmount->CellCssStyle = ""; $Refunds_To_Students->RefundAmount->CellCssClass = "";
		$Refunds_To_Students->RefundAmount->CellAttrs = array(); $Refunds_To_Students->RefundAmount->ViewAttrs = array(); $Refunds_To_Students->RefundAmount->EditAttrs = array();

		// year
		$Refunds_To_Students->year->CellCssStyle = ""; $Refunds_To_Students->year->CellCssClass = "";
		$Refunds_To_Students->year->CellAttrs = array(); $Refunds_To_Students->year->ViewAttrs = array(); $Refunds_To_Students->year->EditAttrs = array();

		// programarea_name
		$Refunds_To_Students->programarea_name->CellCssStyle = ""; $Refunds_To_Students->programarea_name->CellCssClass = "";
		$Refunds_To_Students->programarea_name->CellAttrs = array(); $Refunds_To_Students->programarea_name->ViewAttrs = array(); $Refunds_To_Students->programarea_name->EditAttrs = array();
		if ($Refunds_To_Students->RowType == EW_ROWTYPE_VIEW) { // View row

			// student_lastname
			$Refunds_To_Students->student_lastname->ViewValue = $Refunds_To_Students->student_lastname->CurrentValue;
			$Refunds_To_Students->student_lastname->CssStyle = "";
			$Refunds_To_Students->student_lastname->CssClass = "";
			$Refunds_To_Students->student_lastname->ViewCustomAttributes = "";

			// student_firstname
			$Refunds_To_Students->student_firstname->ViewValue = $Refunds_To_Students->student_firstname->CurrentValue;
			$Refunds_To_Students->student_firstname->CssStyle = "";
			$Refunds_To_Students->student_firstname->CssClass = "";
			$Refunds_To_Students->student_firstname->ViewCustomAttributes = "";

			// student_middlename
			$Refunds_To_Students->student_middlename->ViewValue = $Refunds_To_Students->student_middlename->CurrentValue;
			$Refunds_To_Students->student_middlename->CssStyle = "";
			$Refunds_To_Students->student_middlename->CssClass = "";
			$Refunds_To_Students->student_middlename->ViewCustomAttributes = "";

			// status
			if (strval($Refunds_To_Students->status->CurrentValue) <> "") {
				switch ($Refunds_To_Students->status->CurrentValue) {
					case "PENDING":
						$Refunds_To_Students->status->ViewValue = "PENDING";
						break;
					case "PAID":
						$Refunds_To_Students->status->ViewValue = "PAID";
						break;
					default:
						$Refunds_To_Students->status->ViewValue = $Refunds_To_Students->status->CurrentValue;
				}
			} else {
				$Refunds_To_Students->status->ViewValue = NULL;
			}
			$Refunds_To_Students->status->CssStyle = "";
			$Refunds_To_Students->status->CssClass = "";
			$Refunds_To_Students->status->ViewCustomAttributes = "";

			// amount
			$Refunds_To_Students->amount->ViewValue = $Refunds_To_Students->amount->CurrentValue;
			$Refunds_To_Students->amount->CssStyle = "";
			$Refunds_To_Students->amount->CssClass = "";
			$Refunds_To_Students->amount->ViewCustomAttributes = "";

			// refund_amount
			$Refunds_To_Students->refund_amount->ViewValue = $Refunds_To_Students->refund_amount->CurrentValue;
			$Refunds_To_Students->refund_amount->CssStyle = "";
			$Refunds_To_Students->refund_amount->CssClass = "";
			$Refunds_To_Students->refund_amount->ViewCustomAttributes = "";

			// scholarship_type
			$Refunds_To_Students->scholarship_type->ViewValue = $Refunds_To_Students->scholarship_type->CurrentValue;
			$Refunds_To_Students->scholarship_type->CssStyle = "";
			$Refunds_To_Students->scholarship_type->CssClass = "";
			$Refunds_To_Students->scholarship_type->ViewCustomAttributes = "";

			// RefundAmount
			$Refunds_To_Students->RefundAmount->ViewValue = $Refunds_To_Students->RefundAmount->CurrentValue;
			$Refunds_To_Students->RefundAmount->CssStyle = "";
			$Refunds_To_Students->RefundAmount->CssClass = "";
			$Refunds_To_Students->RefundAmount->ViewCustomAttributes = "";

			// year
			$Refunds_To_Students->year->ViewValue = $Refunds_To_Students->year->CurrentValue;
			$Refunds_To_Students->year->CssStyle = "";
			$Refunds_To_Students->year->CssClass = "";
			$Refunds_To_Students->year->ViewCustomAttributes = "";

			// programarea_name
			$Refunds_To_Students->programarea_name->ViewValue = $Refunds_To_Students->programarea_name->CurrentValue;
			$Refunds_To_Students->programarea_name->CssStyle = "";
			$Refunds_To_Students->programarea_name->CssClass = "";
			$Refunds_To_Students->programarea_name->ViewCustomAttributes = "";

			// student_lastname
			$Refunds_To_Students->student_lastname->HrefValue = "";
			$Refunds_To_Students->student_lastname->TooltipValue = "";

			// student_firstname
			$Refunds_To_Students->student_firstname->HrefValue = "";
			$Refunds_To_Students->student_firstname->TooltipValue = "";

			// student_middlename
			$Refunds_To_Students->student_middlename->HrefValue = "";
			$Refunds_To_Students->student_middlename->TooltipValue = "";

			// status
			$Refunds_To_Students->status->HrefValue = "";
			$Refunds_To_Students->status->TooltipValue = "";

			// amount
			$Refunds_To_Students->amount->HrefValue = "";
			$Refunds_To_Students->amount->TooltipValue = "";

			// refund_amount
			$Refunds_To_Students->refund_amount->HrefValue = "";
			$Refunds_To_Students->refund_amount->TooltipValue = "";

			// scholarship_type
			$Refunds_To_Students->scholarship_type->HrefValue = "";
			$Refunds_To_Students->scholarship_type->TooltipValue = "";

			// RefundAmount
			$Refunds_To_Students->RefundAmount->HrefValue = "";
			$Refunds_To_Students->RefundAmount->TooltipValue = "";

			// year
			$Refunds_To_Students->year->HrefValue = "";
			$Refunds_To_Students->year->TooltipValue = "";

			// programarea_name
			$Refunds_To_Students->programarea_name->HrefValue = "";
			$Refunds_To_Students->programarea_name->TooltipValue = "";
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
}
?>

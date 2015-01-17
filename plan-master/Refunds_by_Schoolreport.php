<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php

// Global variable for table object
$Refunds_by_School = NULL;

//
// Table class for Refunds by School
//
class cRefunds_by_School {
	var $TableVar = 'Refunds_by_School';
	var $TableName = 'Refunds by School';
	var $TableType = 'REPORT';
	var $school_name;
	var $school_type;
	var $community;
	var $programarea_name;
	var $amount;
	var $status;
	var $refund_amount;
	var $year;
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
	function cRefunds_by_School() {
		global $Language;

		// school_name
		$this->school_name = new cField('Refunds_by_School', 'Refunds by School', 'x_school_name', 'school_name', 'schools.school_name', 200, -1, FALSE, 'schools.school_name', FALSE);
		$this->fields['school_name'] =& $this->school_name;

		// school_type
		$this->school_type = new cField('Refunds_by_School', 'Refunds by School', 'x_school_type', 'school_type', 'schools.school_type', 200, -1, FALSE, 'schools.school_type', FALSE);
		$this->fields['school_type'] =& $this->school_type;

		// community
		$this->community = new cField('Refunds_by_School', 'Refunds by School', 'x_community', 'community', 'community.community', 200, -1, FALSE, 'community.community', FALSE);
		$this->fields['community'] =& $this->community;

		// programarea_name
		$this->programarea_name = new cField('Refunds_by_School', 'Refunds by School', 'x_programarea_name', 'programarea_name', 'programarea.programarea_name', 200, -1, FALSE, 'programarea.programarea_name', FALSE);
		$this->fields['programarea_name'] =& $this->programarea_name;

		// amount
		$this->amount = new cField('Refunds_by_School', 'Refunds by School', 'x_amount', 'amount', 'scholarship_payment.amount', 131, -1, FALSE, 'scholarship_payment.amount', FALSE);
		$this->amount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['amount'] =& $this->amount;

		// status
		$this->status = new cField('Refunds_by_School', 'Refunds by School', 'x_status', 'status', 'scholarship_payment.status', 202, -1, FALSE, 'scholarship_payment.status', FALSE);
		$this->status->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['status'] =& $this->status;

		// refund_amount
		$this->refund_amount = new cField('Refunds_by_School', 'Refunds by School', 'x_refund_amount', 'refund_amount', 'scholarship_payment.refund_amount', 131, -1, FALSE, 'scholarship_payment.refund_amount', FALSE);
		$this->refund_amount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['refund_amount'] =& $this->refund_amount;

		// year
		$this->year = new cField('Refunds_by_School', 'Refunds by School', 'x_year', 'year', 'scholarship_payment.year', 3, -1, FALSE, 'scholarship_payment.year', FALSE);
		$this->year->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['year'] =& $this->year;
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
		return "SELECT DISTINCT programarea.programarea_name,community.community,scholarship_payment.year,schools.school_type,schools.school_name FROM programarea Inner Join community On programarea.programarea_id = community.programarea_programarea_id Inner Join schools On community.community_id = schools.community_community_id Inner Join scholarship_payment On programarea.programarea_id = scholarship_payment.programarea_payingarea_id";
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
		return "programarea.programarea_name ASC,community.community ASC,scholarship_payment.year ASC,schools.school_type ASC,schools.school_name ASC";
	}

	// Report detail level SQL
	function SqlDetailSelect() { // Select
		return "SELECT schools.school_name, schools.school_type, community.community, programarea.programarea_name, scholarship_payment.amount, scholarship_payment.status, scholarship_payment.refund_amount, scholarship_payment.year FROM programarea Inner Join community On programarea.programarea_id = community.programarea_programarea_id Inner Join schools On community.community_id = schools.community_community_id Inner Join scholarship_payment On programarea.programarea_id = scholarship_payment.programarea_payingarea_id";
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
		return "scholarship_payment.status ASC";
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
			return "Refunds_by_Schoolreport.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "Refunds_by_Schoolreport.php";
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=Refunds_by_School" : "";
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
		$this->school_name->setDbValue($rs->fields('school_name'));
		$this->school_type->setDbValue($rs->fields('school_type'));
		$this->community->setDbValue($rs->fields('community'));
		$this->programarea_name->setDbValue($rs->fields('programarea_name'));
		$this->amount->setDbValue($rs->fields('amount'));
		$this->status->setDbValue($rs->fields('status'));
		$this->refund_amount->setDbValue($rs->fields('refund_amount'));
		$this->year->setDbValue($rs->fields('year'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

   // Common render codes
		// school_name

		$Refunds_by_School->school_name->CellCssStyle = ""; $Refunds_by_School->school_name->CellCssClass = "";
		$Refunds_by_School->school_name->CellAttrs = array(); $Refunds_by_School->school_name->ViewAttrs = array(); $Refunds_by_School->school_name->EditAttrs = array();

		// school_type
		$Refunds_by_School->school_type->CellCssStyle = ""; $Refunds_by_School->school_type->CellCssClass = "";
		$Refunds_by_School->school_type->CellAttrs = array(); $Refunds_by_School->school_type->ViewAttrs = array(); $Refunds_by_School->school_type->EditAttrs = array();

		// community
		$Refunds_by_School->community->CellCssStyle = ""; $Refunds_by_School->community->CellCssClass = "";
		$Refunds_by_School->community->CellAttrs = array(); $Refunds_by_School->community->ViewAttrs = array(); $Refunds_by_School->community->EditAttrs = array();

		// programarea_name
		$Refunds_by_School->programarea_name->CellCssStyle = ""; $Refunds_by_School->programarea_name->CellCssClass = "";
		$Refunds_by_School->programarea_name->CellAttrs = array(); $Refunds_by_School->programarea_name->ViewAttrs = array(); $Refunds_by_School->programarea_name->EditAttrs = array();

		// amount
		$Refunds_by_School->amount->CellCssStyle = ""; $Refunds_by_School->amount->CellCssClass = "";
		$Refunds_by_School->amount->CellAttrs = array(); $Refunds_by_School->amount->ViewAttrs = array(); $Refunds_by_School->amount->EditAttrs = array();

		// status
		$Refunds_by_School->status->CellCssStyle = ""; $Refunds_by_School->status->CellCssClass = "";
		$Refunds_by_School->status->CellAttrs = array(); $Refunds_by_School->status->ViewAttrs = array(); $Refunds_by_School->status->EditAttrs = array();

		// refund_amount
		$Refunds_by_School->refund_amount->CellCssStyle = ""; $Refunds_by_School->refund_amount->CellCssClass = "";
		$Refunds_by_School->refund_amount->CellAttrs = array(); $Refunds_by_School->refund_amount->ViewAttrs = array(); $Refunds_by_School->refund_amount->EditAttrs = array();

		// year
		$Refunds_by_School->year->CellCssStyle = ""; $Refunds_by_School->year->CellCssClass = "";
		$Refunds_by_School->year->CellAttrs = array(); $Refunds_by_School->year->ViewAttrs = array(); $Refunds_by_School->year->EditAttrs = array();

		// school_name
		$Refunds_by_School->school_name->ViewValue = $Refunds_by_School->school_name->CurrentValue;
		$Refunds_by_School->school_name->CssStyle = "";
		$Refunds_by_School->school_name->CssClass = "";
		$Refunds_by_School->school_name->ViewCustomAttributes = "";

		// school_type
		if (strval($Refunds_by_School->school_type->CurrentValue) <> "") {
			$sFilterWrk = "`school_type` = '" . ew_AdjustSql($Refunds_by_School->school_type->CurrentValue) . "'";
		$sSqlWrk = "SELECT `school_type` FROM `school_type`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$Refunds_by_School->school_type->ViewValue = $rswrk->fields('school_type');
				$rswrk->Close();
			} else {
				$Refunds_by_School->school_type->ViewValue = $Refunds_by_School->school_type->CurrentValue;
			}
		} else {
			$Refunds_by_School->school_type->ViewValue = NULL;
		}
		$Refunds_by_School->school_type->CssStyle = "";
		$Refunds_by_School->school_type->CssClass = "";
		$Refunds_by_School->school_type->ViewCustomAttributes = "";

		// community
		$Refunds_by_School->community->ViewValue = $Refunds_by_School->community->CurrentValue;
		$Refunds_by_School->community->CssStyle = "";
		$Refunds_by_School->community->CssClass = "";
		$Refunds_by_School->community->ViewCustomAttributes = "";

		// programarea_name
		$Refunds_by_School->programarea_name->ViewValue = $Refunds_by_School->programarea_name->CurrentValue;
		$Refunds_by_School->programarea_name->CssStyle = "";
		$Refunds_by_School->programarea_name->CssClass = "";
		$Refunds_by_School->programarea_name->ViewCustomAttributes = "";

		// amount
		$Refunds_by_School->amount->ViewValue = $Refunds_by_School->amount->CurrentValue;
		$Refunds_by_School->amount->CssStyle = "";
		$Refunds_by_School->amount->CssClass = "";
		$Refunds_by_School->amount->ViewCustomAttributes = "";

		// status
		if (strval($Refunds_by_School->status->CurrentValue) <> "") {
			switch ($Refunds_by_School->status->CurrentValue) {
				case "PENDING":
					$Refunds_by_School->status->ViewValue = "PENDING";
					break;
				case "PAID":
					$Refunds_by_School->status->ViewValue = "PAID";
					break;
				default:
					$Refunds_by_School->status->ViewValue = $Refunds_by_School->status->CurrentValue;
			}
		} else {
			$Refunds_by_School->status->ViewValue = NULL;
		}
		$Refunds_by_School->status->CssStyle = "";
		$Refunds_by_School->status->CssClass = "";
		$Refunds_by_School->status->ViewCustomAttributes = "";

		// refund_amount
		$Refunds_by_School->refund_amount->ViewValue = $Refunds_by_School->refund_amount->CurrentValue;
		$Refunds_by_School->refund_amount->CssStyle = "";
		$Refunds_by_School->refund_amount->CssClass = "";
		$Refunds_by_School->refund_amount->ViewCustomAttributes = "";

		// year
		$Refunds_by_School->year->ViewValue = $Refunds_by_School->year->CurrentValue;
		$Refunds_by_School->year->CssStyle = "";
		$Refunds_by_School->year->CssClass = "";
		$Refunds_by_School->year->ViewCustomAttributes = "";

		// school_name
		$Refunds_by_School->school_name->HrefValue = "";
		$Refunds_by_School->school_name->TooltipValue = "";

		// school_type
		$Refunds_by_School->school_type->HrefValue = "";
		$Refunds_by_School->school_type->TooltipValue = "";

		// community
		$Refunds_by_School->community->HrefValue = "";
		$Refunds_by_School->community->TooltipValue = "";

		// programarea_name
		$Refunds_by_School->programarea_name->HrefValue = "";
		$Refunds_by_School->programarea_name->TooltipValue = "";

		// amount
		$Refunds_by_School->amount->HrefValue = "";
		$Refunds_by_School->amount->TooltipValue = "";

		// status
		$Refunds_by_School->status->HrefValue = "";
		$Refunds_by_School->status->TooltipValue = "";

		// refund_amount
		$Refunds_by_School->refund_amount->HrefValue = "";
		$Refunds_by_School->refund_amount->TooltipValue = "";

		// year
		$Refunds_by_School->year->HrefValue = "";
		$Refunds_by_School->year->TooltipValue = "";
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
$Refunds_by_School_report = new cRefunds_by_School_report();
$Page =& $Refunds_by_School_report;

// Page init
$Refunds_by_School_report->Page_Init();

// Page main
$Refunds_by_School_report->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($Refunds_by_School->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($Refunds_by_School->Export == "") { ?>
<?php } ?>
<p><span class="phpmaker"><?php echo $Language->Phrase("TblTypeReport") ?><?php echo $Refunds_by_School->TableCaption() ?>
<?php if ($Refunds_by_School->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Refunds_by_School_report->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Refunds_by_School_report->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<form method="post">
<table class="ewReportTable" cellspacing="-1">
<?php
$Refunds_by_School_report->sTblDefaultFilter = "";
$Refunds_by_School_report->sFilter = $Refunds_by_School_report->sTblDefaultFilter;
if (!$Security->CanReport()) {
	if ($Refunds_by_School_report->sFilter <> "") $Refunds_by_School_report->sFilter .= " AND ";
	$Refunds_by_School_report->sFilter .= "(0=1)";
}
if ($Refunds_by_School_report->sDbDetailFilter <> "") {
	if ($Refunds_by_School_report->sFilter <> "") $Refunds_by_School_report->sFilter .= " AND ";
	$Refunds_by_School_report->sFilter .= "(" . $Refunds_by_School_report->sDbDetailFilter . ")";
}

// Set up filter and load Group level sql
$Refunds_by_School->CurrentFilter = $Refunds_by_School_report->sFilter;
$Refunds_by_School_report->sSql = $Refunds_by_School->GroupSQL();

// Load recordset
$rs = $conn->Execute($Refunds_by_School_report->sSql);

// Get First Row
if (!$rs->EOF) {
	$Refunds_by_School->programarea_name->setDbValue($rs->fields('programarea_name'));
	$Refunds_by_School_report->vGrps[0] = $Refunds_by_School->programarea_name->DbValue;
	$Refunds_by_School->community->setDbValue($rs->fields('community'));
	$Refunds_by_School_report->vGrps[1] = $Refunds_by_School->community->DbValue;
	$Refunds_by_School->year->setDbValue($rs->fields('year'));
	$Refunds_by_School_report->vGrps[2] = $Refunds_by_School->year->DbValue;
	$Refunds_by_School->school_type->setDbValue($rs->fields('school_type'));
	$Refunds_by_School_report->vGrps[3] = $Refunds_by_School->school_type->DbValue;
	$Refunds_by_School->school_name->setDbValue($rs->fields('school_name'));
	$Refunds_by_School_report->vGrps[4] = $Refunds_by_School->school_name->DbValue;
}
$Refunds_by_School_report->lRecCnt = 0;
$Refunds_by_School_report->nCntRecs[0] = 0;
$Refunds_by_School_report->ChkLvlBreak();
while (!$rs->EOF) {

	// Render for view
	$Refunds_by_School->RowType = EW_ROWTYPE_VIEW;
	$Refunds_by_School_report->RenderRow();

	// Show group headers
	if ($Refunds_by_School_report->bLvlBreak[1]) { // Reset counter and aggregation
?>
	<tr><td class="ewGroupField"><span class="phpmaker"><?php echo $Refunds_by_School->programarea_name->FldCaption() ?></span></td>
	<td colspan=2 class="ewGroupName"><span class="phpmaker">
<div<?php echo $Refunds_by_School->programarea_name->ViewAttributes() ?>><?php echo $Refunds_by_School->programarea_name->ViewValue ?></div></span></td></tr>
<?php
	}
	if ($Refunds_by_School_report->bLvlBreak[2]) { // Reset counter and aggregation
?>
	<tr><td class="ewGroupField"><span class="phpmaker"><?php echo $Refunds_by_School->community->FldCaption() ?></span></td>
	<td colspan=2 class="ewGroupName"><span class="phpmaker">
<div<?php echo $Refunds_by_School->community->ViewAttributes() ?>><?php echo $Refunds_by_School->community->ViewValue ?></div></span></td></tr>
<?php
	}
	if ($Refunds_by_School_report->bLvlBreak[3]) { // Reset counter and aggregation
?>
	<tr><td class="ewGroupField"><span class="phpmaker"><?php echo $Refunds_by_School->year->FldCaption() ?></span></td>
	<td colspan=2 class="ewGroupName"><span class="phpmaker">
<div<?php echo $Refunds_by_School->year->ViewAttributes() ?>><?php echo $Refunds_by_School->year->ViewValue ?></div></span></td></tr>
<?php
	}
	if ($Refunds_by_School_report->bLvlBreak[4]) { // Reset counter and aggregation
?>
	<tr><td class="ewGroupField"><span class="phpmaker"><?php echo $Refunds_by_School->school_type->FldCaption() ?></span></td>
	<td colspan=2 class="ewGroupName"><span class="phpmaker">
<div<?php echo $Refunds_by_School->school_type->ViewAttributes() ?>><?php echo $Refunds_by_School->school_type->ViewValue ?></div></span></td></tr>
<?php
	}
	if ($Refunds_by_School_report->bLvlBreak[5]) { // Reset counter and aggregation
?>
	<tr><td class="ewGroupField"><span class="phpmaker"><?php echo $Refunds_by_School->school_name->FldCaption() ?></span></td>
	<td colspan=2 class="ewGroupName"><span class="phpmaker">
<div<?php echo $Refunds_by_School->school_name->ViewAttributes() ?>><?php echo $Refunds_by_School->school_name->ViewValue ?></div></span></td></tr>
<?php
	}

	// Get detail records
	$Refunds_by_School_report->sFilter = $Refunds_by_School_report->sTblDefaultFilter;
	if ($Refunds_by_School_report->sFilter <> "") $Refunds_by_School_report->sFilter .= " AND ";
	if (is_null($Refunds_by_School->programarea_name->CurrentValue)) {
		$Refunds_by_School_report->sFilter .= "(programarea.programarea_name IS NULL)";
	} else {
		$Refunds_by_School_report->sFilter .= "(programarea.programarea_name = '" . ew_AdjustSql($Refunds_by_School->programarea_name->CurrentValue) . "')";
	}
	if ($Refunds_by_School_report->sFilter <> "") $Refunds_by_School_report->sFilter .= " AND ";
	if (is_null($Refunds_by_School->community->CurrentValue)) {
		$Refunds_by_School_report->sFilter .= "(community.community IS NULL)";
	} else {
		$Refunds_by_School_report->sFilter .= "(community.community = '" . ew_AdjustSql($Refunds_by_School->community->CurrentValue) . "')";
	}
	if ($Refunds_by_School_report->sFilter <> "") $Refunds_by_School_report->sFilter .= " AND ";
	if (is_null($Refunds_by_School->year->CurrentValue)) {
		$Refunds_by_School_report->sFilter .= "(scholarship_payment.year IS NULL)";
	} else {
		$Refunds_by_School_report->sFilter .= "(scholarship_payment.year = " . ew_AdjustSql($Refunds_by_School->year->CurrentValue) . ")";
	}
	if ($Refunds_by_School_report->sFilter <> "") $Refunds_by_School_report->sFilter .= " AND ";
	if (is_null($Refunds_by_School->school_type->CurrentValue)) {
		$Refunds_by_School_report->sFilter .= "(schools.school_type IS NULL)";
	} else {
		$Refunds_by_School_report->sFilter .= "(schools.school_type = '" . ew_AdjustSql($Refunds_by_School->school_type->CurrentValue) . "')";
	}
	if ($Refunds_by_School_report->sFilter <> "") $Refunds_by_School_report->sFilter .= " AND ";
	if (is_null($Refunds_by_School->school_name->CurrentValue)) {
		$Refunds_by_School_report->sFilter .= "(schools.school_name IS NULL)";
	} else {
		$Refunds_by_School_report->sFilter .= "(schools.school_name = '" . ew_AdjustSql($Refunds_by_School->school_name->CurrentValue) . "')";
	}
	if ($Refunds_by_School_report->sDbDetailFilter <> "") {
		if ($Refunds_by_School_report->sFilter <> "")
			$Refunds_by_School_report->sFilter .= " AND ";
		$Refunds_by_School_report->sFilter .= "(" . $Refunds_by_School_report->sDbDetailFilter . ")";
	}
	if (!$Security->CanReport()) {
		if ($sFilter <> "") $sFilter .= " AND ";
		$sFilter .= "(0=1)";
	}

	// Set up detail SQL
	$Refunds_by_School->CurrentFilter = $Refunds_by_School_report->sFilter;
	$Refunds_by_School_report->sSql = $Refunds_by_School->DetailSQL();

	// Load detail records
	$rsdtl = $conn->Execute($Refunds_by_School_report->sSql);
	$Refunds_by_School_report->nDtlRecs = $rsdtl->RecordCount();

	// Initialize aggregates
	if (!$rsdtl->EOF) {
		$Refunds_by_School_report->lRecCnt++;
	}
	if ($Refunds_by_School_report->lRecCnt == 1) {
		$Refunds_by_School_report->nCntRecs[0] = 0;
	}
	for ($i = 1; $i <= 5; $i++) {
		if ($Refunds_by_School_report->bLvlBreak[$i]) { // Reset counter and aggregation
			$Refunds_by_School_report->nCntRecs[$i] = 0;
		}
	}
	$Refunds_by_School_report->nCntRecs[0] += $Refunds_by_School_report->nDtlRecs;
	$Refunds_by_School_report->nCntRecs[1] += $Refunds_by_School_report->nDtlRecs;
	$Refunds_by_School_report->nCntRecs[2] += $Refunds_by_School_report->nDtlRecs;
	$Refunds_by_School_report->nCntRecs[3] += $Refunds_by_School_report->nDtlRecs;
	$Refunds_by_School_report->nCntRecs[4] += $Refunds_by_School_report->nDtlRecs;
	$Refunds_by_School_report->nCntRecs[5] += $Refunds_by_School_report->nDtlRecs;
?>
	<tr>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refunds_by_School->amount->FldCaption() ?></span></td>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refunds_by_School->status->FldCaption() ?></span></td>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refunds_by_School->refund_amount->FldCaption() ?></span></td>
	</tr>
<?php
	while (!$rsdtl->EOF) {
		$Refunds_by_School->amount->setDbValue($rsdtl->fields('amount'));
		$Refunds_by_School->status->setDbValue($rsdtl->fields('status'));
		$Refunds_by_School->refund_amount->setDbValue($rsdtl->fields('refund_amount'));

		// Render for view
		$Refunds_by_School->RowType = EW_ROWTYPE_VIEW;
		$Refunds_by_School_report->RenderRow();
?>
	<tr>
		<td><span class="phpmaker">
<div<?php echo $Refunds_by_School->amount->ViewAttributes() ?>><?php echo $Refunds_by_School->amount->ViewValue ?></div></span></td>
		<td><span class="phpmaker">
<div<?php echo $Refunds_by_School->status->ViewAttributes() ?>><?php echo $Refunds_by_School->status->ViewValue ?></div></span></td>
		<td><span class="phpmaker">
<div<?php echo $Refunds_by_School->refund_amount->ViewAttributes() ?>><?php echo $Refunds_by_School->refund_amount->ViewValue ?></div></span></td>
	</tr>
<?php
		$rsdtl->MoveNext();
	}
	$rsdtl->Close();

	// Save old group data
	$Refunds_by_School_report->vGrps[0] = $Refunds_by_School->programarea_name->CurrentValue;
	$Refunds_by_School_report->vGrps[1] = $Refunds_by_School->community->CurrentValue;
	$Refunds_by_School_report->vGrps[2] = $Refunds_by_School->year->CurrentValue;
	$Refunds_by_School_report->vGrps[3] = $Refunds_by_School->school_type->CurrentValue;
	$Refunds_by_School_report->vGrps[4] = $Refunds_by_School->school_name->CurrentValue;

	// Get next record
	$rs->MoveNext();
	if ($rs->EOF) {
		$Refunds_by_School_report->lRecCnt = 0; // EOF, force all level breaks
	} else {
		$Refunds_by_School->programarea_name->setDbValue($rs->fields('programarea_name'));
		$Refunds_by_School->community->setDbValue($rs->fields('community'));
		$Refunds_by_School->year->setDbValue($rs->fields('year'));
		$Refunds_by_School->school_type->setDbValue($rs->fields('school_type'));
		$Refunds_by_School->school_name->setDbValue($rs->fields('school_name'));
	}
	$Refunds_by_School_report->ChkLvlBreak();

	// Show footers
	if ($Refunds_by_School_report->bLvlBreak[5]) {
		$Refunds_by_School->school_name->CurrentValue = $Refunds_by_School_report->vGrps[4];

		// Render row for view
		$Refunds_by_School->RowType = EW_ROWTYPE_VIEW;
		$Refunds_by_School_report->RenderRow();
		$Refunds_by_School->school_name->CurrentValue = $Refunds_by_School->school_name->DbValue;
?>
<?php
}
	if ($Refunds_by_School_report->bLvlBreak[4]) {
		$Refunds_by_School->school_type->CurrentValue = $Refunds_by_School_report->vGrps[3];

		// Render row for view
		$Refunds_by_School->RowType = EW_ROWTYPE_VIEW;
		$Refunds_by_School_report->RenderRow();
		$Refunds_by_School->school_type->CurrentValue = $Refunds_by_School->school_type->DbValue;
?>
<?php
}
	if ($Refunds_by_School_report->bLvlBreak[3]) {
		$Refunds_by_School->year->CurrentValue = $Refunds_by_School_report->vGrps[2];

		// Render row for view
		$Refunds_by_School->RowType = EW_ROWTYPE_VIEW;
		$Refunds_by_School_report->RenderRow();
		$Refunds_by_School->year->CurrentValue = $Refunds_by_School->year->DbValue;
?>
<?php
}
	if ($Refunds_by_School_report->bLvlBreak[2]) {
		$Refunds_by_School->community->CurrentValue = $Refunds_by_School_report->vGrps[1];

		// Render row for view
		$Refunds_by_School->RowType = EW_ROWTYPE_VIEW;
		$Refunds_by_School_report->RenderRow();
		$Refunds_by_School->community->CurrentValue = $Refunds_by_School->community->DbValue;
?>
<?php
}
	if ($Refunds_by_School_report->bLvlBreak[1]) {
		$Refunds_by_School->programarea_name->CurrentValue = $Refunds_by_School_report->vGrps[0];

		// Render row for view
		$Refunds_by_School->RowType = EW_ROWTYPE_VIEW;
		$Refunds_by_School_report->RenderRow();
		$Refunds_by_School->programarea_name->CurrentValue = $Refunds_by_School->programarea_name->DbValue;
?>
<?php
}
}

// Close recordset
$rs->Close();
?>
	<tr><td colspan=3><span class="phpmaker">&nbsp;<br></span></td></tr>
	<tr><td colspan=3 class="ewGrandSummary"><span class="phpmaker"><?php echo $Language->Phrase("RptGrandTotal") ?>&nbsp;(<?php echo ew_FormatNumber($Refunds_by_School_report->nCntRecs[0], 0) ?>&nbsp;<?php echo $Language->Phrase("RptDtlRec") ?>)</span></td></tr>
	<tr><td colspan=3><span class="phpmaker">&nbsp;<br></span></td></tr>
</table>
</form>
<?php if ($Refunds_by_School->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$Refunds_by_School_report->Page_Terminate();
?>
<?php

//
// Page class
//
class cRefunds_by_School_report {

	// Page ID
	var $PageID = 'report';

	// Table name
	var $TableName = 'Refunds by School';

	// Page object name
	var $PageObjName = 'Refunds_by_School_report';

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
	function cRefunds_by_School_report() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (Refunds_by_School)
		$GLOBALS["Refunds_by_School"] = new cRefunds_by_School();

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
			define("EW_TABLE_NAME", 'Refunds by School', TRUE);

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
		global $Refunds_by_School;

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
			$Refunds_by_School->Export = $_GET["export"];
		}
		$gsExport = $Refunds_by_School->Export; // Get export parameter, used in header
		$gsExportFile = $Refunds_by_School->TableVar; // Get export file, used in header
		if ($Refunds_by_School->Export == "excel") {
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
		global $Language, $Refunds_by_School;
		$this->vGrps =& ew_InitArray(6, NULL);
		$this->nCntRecs =& ew_InitArray(6, 0);
		$this->bLvlBreak =& ew_InitArray(6, FALSE);
		$this->nTotals =& ew_Init2DArray(6, 4, 0);
		$this->nMaxs =& ew_Init2DArray(6, 4, 0);
		$this->nMins =& ew_Init2DArray(6, 4, 0);
	}

	// Check level break
	function ChkLvlBreak() {
		global $Refunds_by_School;
		$this->bLvlBreak[1] = FALSE;
		$this->bLvlBreak[2] = FALSE;
		$this->bLvlBreak[3] = FALSE;
		$this->bLvlBreak[4] = FALSE;
		$this->bLvlBreak[5] = FALSE;
		if ($this->lRecCnt == 0) { // Start Or End of Recordset
			$this->bLvlBreak[1] = TRUE;
			$this->bLvlBreak[2] = TRUE;
			$this->bLvlBreak[3] = TRUE;
			$this->bLvlBreak[4] = TRUE;
			$this->bLvlBreak[5] = TRUE;
		} else {
			if (!ew_CompareValue($Refunds_by_School->programarea_name->CurrentValue, $this->vGrps[0])) {
				$this->bLvlBreak[1] = TRUE;
				$this->bLvlBreak[2] = TRUE;
				$this->bLvlBreak[3] = TRUE;
				$this->bLvlBreak[4] = TRUE;
				$this->bLvlBreak[5] = TRUE;
			}
			if (!ew_CompareValue($Refunds_by_School->community->CurrentValue, $this->vGrps[1])) {
				$this->bLvlBreak[2] = TRUE;
				$this->bLvlBreak[3] = TRUE;
				$this->bLvlBreak[4] = TRUE;
				$this->bLvlBreak[5] = TRUE;
			}
			if (!ew_CompareValue($Refunds_by_School->year->CurrentValue, $this->vGrps[2])) {
				$this->bLvlBreak[3] = TRUE;
				$this->bLvlBreak[4] = TRUE;
				$this->bLvlBreak[5] = TRUE;
			}
			if (!ew_CompareValue($Refunds_by_School->school_type->CurrentValue, $this->vGrps[3])) {
				$this->bLvlBreak[4] = TRUE;
				$this->bLvlBreak[5] = TRUE;
			}
			if (!ew_CompareValue($Refunds_by_School->school_name->CurrentValue, $this->vGrps[4])) {
				$this->bLvlBreak[5] = TRUE;
			}
		}
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $Refunds_by_School;

		// Initialize URLs
		// Common render codes for all row types
		// school_name

		$Refunds_by_School->school_name->CellCssStyle = ""; $Refunds_by_School->school_name->CellCssClass = "";
		$Refunds_by_School->school_name->CellAttrs = array(); $Refunds_by_School->school_name->ViewAttrs = array(); $Refunds_by_School->school_name->EditAttrs = array();

		// school_type
		$Refunds_by_School->school_type->CellCssStyle = ""; $Refunds_by_School->school_type->CellCssClass = "";
		$Refunds_by_School->school_type->CellAttrs = array(); $Refunds_by_School->school_type->ViewAttrs = array(); $Refunds_by_School->school_type->EditAttrs = array();

		// community
		$Refunds_by_School->community->CellCssStyle = ""; $Refunds_by_School->community->CellCssClass = "";
		$Refunds_by_School->community->CellAttrs = array(); $Refunds_by_School->community->ViewAttrs = array(); $Refunds_by_School->community->EditAttrs = array();

		// programarea_name
		$Refunds_by_School->programarea_name->CellCssStyle = ""; $Refunds_by_School->programarea_name->CellCssClass = "";
		$Refunds_by_School->programarea_name->CellAttrs = array(); $Refunds_by_School->programarea_name->ViewAttrs = array(); $Refunds_by_School->programarea_name->EditAttrs = array();

		// amount
		$Refunds_by_School->amount->CellCssStyle = ""; $Refunds_by_School->amount->CellCssClass = "";
		$Refunds_by_School->amount->CellAttrs = array(); $Refunds_by_School->amount->ViewAttrs = array(); $Refunds_by_School->amount->EditAttrs = array();

		// status
		$Refunds_by_School->status->CellCssStyle = ""; $Refunds_by_School->status->CellCssClass = "";
		$Refunds_by_School->status->CellAttrs = array(); $Refunds_by_School->status->ViewAttrs = array(); $Refunds_by_School->status->EditAttrs = array();

		// refund_amount
		$Refunds_by_School->refund_amount->CellCssStyle = ""; $Refunds_by_School->refund_amount->CellCssClass = "";
		$Refunds_by_School->refund_amount->CellAttrs = array(); $Refunds_by_School->refund_amount->ViewAttrs = array(); $Refunds_by_School->refund_amount->EditAttrs = array();

		// year
		$Refunds_by_School->year->CellCssStyle = ""; $Refunds_by_School->year->CellCssClass = "";
		$Refunds_by_School->year->CellAttrs = array(); $Refunds_by_School->year->ViewAttrs = array(); $Refunds_by_School->year->EditAttrs = array();
		if ($Refunds_by_School->RowType == EW_ROWTYPE_VIEW) { // View row

			// school_name
			$Refunds_by_School->school_name->ViewValue = $Refunds_by_School->school_name->CurrentValue;
			$Refunds_by_School->school_name->CssStyle = "";
			$Refunds_by_School->school_name->CssClass = "";
			$Refunds_by_School->school_name->ViewCustomAttributes = "";

			// school_type
			if (strval($Refunds_by_School->school_type->CurrentValue) <> "") {
				$sFilterWrk = "`school_type` = '" . ew_AdjustSql($Refunds_by_School->school_type->CurrentValue) . "'";
			$sSqlWrk = "SELECT `school_type` FROM `school_type`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Refunds_by_School->school_type->ViewValue = $rswrk->fields('school_type');
					$rswrk->Close();
				} else {
					$Refunds_by_School->school_type->ViewValue = $Refunds_by_School->school_type->CurrentValue;
				}
			} else {
				$Refunds_by_School->school_type->ViewValue = NULL;
			}
			$Refunds_by_School->school_type->CssStyle = "";
			$Refunds_by_School->school_type->CssClass = "";
			$Refunds_by_School->school_type->ViewCustomAttributes = "";

			// community
			$Refunds_by_School->community->ViewValue = $Refunds_by_School->community->CurrentValue;
			$Refunds_by_School->community->CssStyle = "";
			$Refunds_by_School->community->CssClass = "";
			$Refunds_by_School->community->ViewCustomAttributes = "";

			// programarea_name
			$Refunds_by_School->programarea_name->ViewValue = $Refunds_by_School->programarea_name->CurrentValue;
			$Refunds_by_School->programarea_name->CssStyle = "";
			$Refunds_by_School->programarea_name->CssClass = "";
			$Refunds_by_School->programarea_name->ViewCustomAttributes = "";

			// amount
			$Refunds_by_School->amount->ViewValue = $Refunds_by_School->amount->CurrentValue;
			$Refunds_by_School->amount->CssStyle = "";
			$Refunds_by_School->amount->CssClass = "";
			$Refunds_by_School->amount->ViewCustomAttributes = "";

			// status
			if (strval($Refunds_by_School->status->CurrentValue) <> "") {
				switch ($Refunds_by_School->status->CurrentValue) {
					case "PENDING":
						$Refunds_by_School->status->ViewValue = "PENDING";
						break;
					case "PAID":
						$Refunds_by_School->status->ViewValue = "PAID";
						break;
					default:
						$Refunds_by_School->status->ViewValue = $Refunds_by_School->status->CurrentValue;
				}
			} else {
				$Refunds_by_School->status->ViewValue = NULL;
			}
			$Refunds_by_School->status->CssStyle = "";
			$Refunds_by_School->status->CssClass = "";
			$Refunds_by_School->status->ViewCustomAttributes = "";

			// refund_amount
			$Refunds_by_School->refund_amount->ViewValue = $Refunds_by_School->refund_amount->CurrentValue;
			$Refunds_by_School->refund_amount->CssStyle = "";
			$Refunds_by_School->refund_amount->CssClass = "";
			$Refunds_by_School->refund_amount->ViewCustomAttributes = "";

			// year
			$Refunds_by_School->year->ViewValue = $Refunds_by_School->year->CurrentValue;
			$Refunds_by_School->year->CssStyle = "";
			$Refunds_by_School->year->CssClass = "";
			$Refunds_by_School->year->ViewCustomAttributes = "";

			// school_name
			$Refunds_by_School->school_name->HrefValue = "";
			$Refunds_by_School->school_name->TooltipValue = "";

			// school_type
			$Refunds_by_School->school_type->HrefValue = "";
			$Refunds_by_School->school_type->TooltipValue = "";

			// community
			$Refunds_by_School->community->HrefValue = "";
			$Refunds_by_School->community->TooltipValue = "";

			// programarea_name
			$Refunds_by_School->programarea_name->HrefValue = "";
			$Refunds_by_School->programarea_name->TooltipValue = "";

			// amount
			$Refunds_by_School->amount->HrefValue = "";
			$Refunds_by_School->amount->TooltipValue = "";

			// status
			$Refunds_by_School->status->HrefValue = "";
			$Refunds_by_School->status->TooltipValue = "";

			// refund_amount
			$Refunds_by_School->refund_amount->HrefValue = "";
			$Refunds_by_School->refund_amount->TooltipValue = "";

			// year
			$Refunds_by_School->year->HrefValue = "";
			$Refunds_by_School->year->TooltipValue = "";
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

<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php

// Global variable for table object
$Refund_Amounts = NULL;

//
// Table class for Refund Amounts
//
class cRefund_Amounts {
	var $TableVar = 'Refund_Amounts';
	var $TableName = 'Refund Amounts';
	var $TableType = 'REPORT';
	var $date;
	var $amount;
	var $year;
	var $scholarship_package_scholarship_package_id;
	var $programarea_residentarea_id;
	var $programarea_payingarea_id;
	var $refund_amount;
	var $netPayment;
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
	function cRefund_Amounts() {
		global $Language;

		// date
		$this->date = new cField('Refund_Amounts', 'Refund Amounts', 'x_date', 'date', 'scholarship_payment.date', 135, 7, FALSE, 'scholarship_payment.date', FALSE);
		$this->date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['date'] =& $this->date;

		// amount
		$this->amount = new cField('Refund_Amounts', 'Refund Amounts', 'x_amount', 'amount', 'scholarship_payment.amount', 131, -1, FALSE, 'scholarship_payment.amount', FALSE);
		$this->amount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['amount'] =& $this->amount;

		// year
		$this->year = new cField('Refund_Amounts', 'Refund Amounts', 'x_year', 'year', 'scholarship_payment.year', 3, -1, FALSE, 'scholarship_payment.year', FALSE);
		$this->year->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['year'] =& $this->year;

		// scholarship_package_scholarship_package_id
		$this->scholarship_package_scholarship_package_id = new cField('Refund_Amounts', 'Refund Amounts', 'x_scholarship_package_scholarship_package_id', 'scholarship_package_scholarship_package_id', 'scholarship_payment.scholarship_package_scholarship_package_id', 3, -1, FALSE, 'scholarship_payment.scholarship_package_scholarship_package_id', FALSE);
		$this->scholarship_package_scholarship_package_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['scholarship_package_scholarship_package_id'] =& $this->scholarship_package_scholarship_package_id;

		// programarea_residentarea_id
		$this->programarea_residentarea_id = new cField('Refund_Amounts', 'Refund Amounts', 'x_programarea_residentarea_id', 'programarea_residentarea_id', 'scholarship_payment.programarea_residentarea_id', 3, -1, FALSE, 'scholarship_payment.programarea_residentarea_id', FALSE);
		$this->programarea_residentarea_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['programarea_residentarea_id'] =& $this->programarea_residentarea_id;

		// programarea_payingarea_id
		$this->programarea_payingarea_id = new cField('Refund_Amounts', 'Refund Amounts', 'x_programarea_payingarea_id', 'programarea_payingarea_id', 'scholarship_payment.programarea_payingarea_id', 3, -1, FALSE, 'scholarship_payment.programarea_payingarea_id', FALSE);
		$this->programarea_payingarea_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['programarea_payingarea_id'] =& $this->programarea_payingarea_id;

		// refund_amount
		$this->refund_amount = new cField('Refund_Amounts', 'Refund Amounts', 'x_refund_amount', 'refund_amount', 'scholarship_payment.refund_amount', 131, -1, FALSE, 'scholarship_payment.refund_amount', FALSE);
		$this->refund_amount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['refund_amount'] =& $this->refund_amount;

		// netPayment
		$this->netPayment = new cField('Refund_Amounts', 'Refund Amounts', 'x_netPayment', 'netPayment', 'scholarship_payment.amount - scholarship_payment.refund_amount', 131, -1, FALSE, 'scholarship_payment.amount - scholarship_payment.refund_amount', FALSE);
		$this->netPayment->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['netPayment'] =& $this->netPayment;
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

	// Report detail level SQL
	function SqlDetailSelect() { // Select
		return "SELECT scholarship_payment.date, scholarship_payment.amount, scholarship_payment.year, scholarship_payment.scholarship_package_scholarship_package_id, scholarship_payment.programarea_residentarea_id, scholarship_payment.programarea_payingarea_id, scholarship_payment.refund_amount, scholarship_payment.amount - scholarship_payment.refund_amount As netPayment FROM scholarship_payment";
	}

	function SqlDetailWhere() { // Where
		return "scholarship_payment.amount - scholarship_payment.refund_amount <> 0";
	}

	function SqlDetailGroupBy() { // Group By
		return "";
	}

	function SqlDetailHaving() { // Having
		return "";
	}

	function SqlDetailOrderBy() { // Order By
		return "";
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
			return "Refund_Amountsreport.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "Refund_Amountsreport.php";
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=Refund_Amounts" : "";
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
		$this->date->setDbValue($rs->fields('date'));
		$this->amount->setDbValue($rs->fields('amount'));
		$this->year->setDbValue($rs->fields('year'));
		$this->scholarship_package_scholarship_package_id->setDbValue($rs->fields('scholarship_package_scholarship_package_id'));
		$this->programarea_residentarea_id->setDbValue($rs->fields('programarea_residentarea_id'));
		$this->programarea_payingarea_id->setDbValue($rs->fields('programarea_payingarea_id'));
		$this->refund_amount->setDbValue($rs->fields('refund_amount'));
		$this->netPayment->setDbValue($rs->fields('netPayment'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

   // Common render codes
		// date

		$Refund_Amounts->date->CellCssStyle = ""; $Refund_Amounts->date->CellCssClass = "";
		$Refund_Amounts->date->CellAttrs = array(); $Refund_Amounts->date->ViewAttrs = array(); $Refund_Amounts->date->EditAttrs = array();

		// amount
		$Refund_Amounts->amount->CellCssStyle = ""; $Refund_Amounts->amount->CellCssClass = "";
		$Refund_Amounts->amount->CellAttrs = array(); $Refund_Amounts->amount->ViewAttrs = array(); $Refund_Amounts->amount->EditAttrs = array();

		// year
		$Refund_Amounts->year->CellCssStyle = ""; $Refund_Amounts->year->CellCssClass = "";
		$Refund_Amounts->year->CellAttrs = array(); $Refund_Amounts->year->ViewAttrs = array(); $Refund_Amounts->year->EditAttrs = array();

		// scholarship_package_scholarship_package_id
		$Refund_Amounts->scholarship_package_scholarship_package_id->CellCssStyle = ""; $Refund_Amounts->scholarship_package_scholarship_package_id->CellCssClass = "";
		$Refund_Amounts->scholarship_package_scholarship_package_id->CellAttrs = array(); $Refund_Amounts->scholarship_package_scholarship_package_id->ViewAttrs = array(); $Refund_Amounts->scholarship_package_scholarship_package_id->EditAttrs = array();

		// programarea_residentarea_id
		$Refund_Amounts->programarea_residentarea_id->CellCssStyle = ""; $Refund_Amounts->programarea_residentarea_id->CellCssClass = "";
		$Refund_Amounts->programarea_residentarea_id->CellAttrs = array(); $Refund_Amounts->programarea_residentarea_id->ViewAttrs = array(); $Refund_Amounts->programarea_residentarea_id->EditAttrs = array();

		// programarea_payingarea_id
		$Refund_Amounts->programarea_payingarea_id->CellCssStyle = ""; $Refund_Amounts->programarea_payingarea_id->CellCssClass = "";
		$Refund_Amounts->programarea_payingarea_id->CellAttrs = array(); $Refund_Amounts->programarea_payingarea_id->ViewAttrs = array(); $Refund_Amounts->programarea_payingarea_id->EditAttrs = array();

		// refund_amount
		$Refund_Amounts->refund_amount->CellCssStyle = ""; $Refund_Amounts->refund_amount->CellCssClass = "";
		$Refund_Amounts->refund_amount->CellAttrs = array(); $Refund_Amounts->refund_amount->ViewAttrs = array(); $Refund_Amounts->refund_amount->EditAttrs = array();

		// netPayment
		$Refund_Amounts->netPayment->CellCssStyle = ""; $Refund_Amounts->netPayment->CellCssClass = "";
		$Refund_Amounts->netPayment->CellAttrs = array(); $Refund_Amounts->netPayment->ViewAttrs = array(); $Refund_Amounts->netPayment->EditAttrs = array();

		// date
		$Refund_Amounts->date->ViewValue = $Refund_Amounts->date->CurrentValue;
		$Refund_Amounts->date->ViewValue = ew_FormatDateTime($Refund_Amounts->date->ViewValue, 7);
		$Refund_Amounts->date->CssStyle = "";
		$Refund_Amounts->date->CssClass = "";
		$Refund_Amounts->date->ViewCustomAttributes = "";

		// amount
		$Refund_Amounts->amount->ViewValue = $Refund_Amounts->amount->CurrentValue;
		$Refund_Amounts->amount->CssStyle = "";
		$Refund_Amounts->amount->CssClass = "";
		$Refund_Amounts->amount->ViewCustomAttributes = "";

		// year
		$Refund_Amounts->year->ViewValue = $Refund_Amounts->year->CurrentValue;
		$Refund_Amounts->year->CssStyle = "";
		$Refund_Amounts->year->CssClass = "";
		$Refund_Amounts->year->ViewCustomAttributes = "";

		// scholarship_package_scholarship_package_id
		if (strval($Refund_Amounts->scholarship_package_scholarship_package_id->CurrentValue) <> "") {
			$sFilterWrk = "`scholarship_package_id` = " . ew_AdjustSql($Refund_Amounts->scholarship_package_scholarship_package_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `annual_amount` FROM `scholarship_package`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$Refund_Amounts->scholarship_package_scholarship_package_id->ViewValue = $rswrk->fields('annual_amount');
				$rswrk->Close();
			} else {
				$Refund_Amounts->scholarship_package_scholarship_package_id->ViewValue = $Refund_Amounts->scholarship_package_scholarship_package_id->CurrentValue;
			}
		} else {
			$Refund_Amounts->scholarship_package_scholarship_package_id->ViewValue = NULL;
		}
		$Refund_Amounts->scholarship_package_scholarship_package_id->CssStyle = "";
		$Refund_Amounts->scholarship_package_scholarship_package_id->CssClass = "";
		$Refund_Amounts->scholarship_package_scholarship_package_id->ViewCustomAttributes = "";

		// programarea_residentarea_id
		if (strval($Refund_Amounts->programarea_residentarea_id->CurrentValue) <> "") {
			$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Refund_Amounts->programarea_residentarea_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$Refund_Amounts->programarea_residentarea_id->ViewValue = $rswrk->fields('programarea_name');
				$rswrk->Close();
			} else {
				$Refund_Amounts->programarea_residentarea_id->ViewValue = $Refund_Amounts->programarea_residentarea_id->CurrentValue;
			}
		} else {
			$Refund_Amounts->programarea_residentarea_id->ViewValue = NULL;
		}
		$Refund_Amounts->programarea_residentarea_id->CssStyle = "";
		$Refund_Amounts->programarea_residentarea_id->CssClass = "";
		$Refund_Amounts->programarea_residentarea_id->ViewCustomAttributes = "";

		// programarea_payingarea_id
		if (strval($Refund_Amounts->programarea_payingarea_id->CurrentValue) <> "") {
			$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Refund_Amounts->programarea_payingarea_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$Refund_Amounts->programarea_payingarea_id->ViewValue = $rswrk->fields('programarea_name');
				$rswrk->Close();
			} else {
				$Refund_Amounts->programarea_payingarea_id->ViewValue = $Refund_Amounts->programarea_payingarea_id->CurrentValue;
			}
		} else {
			$Refund_Amounts->programarea_payingarea_id->ViewValue = NULL;
		}
		$Refund_Amounts->programarea_payingarea_id->CssStyle = "";
		$Refund_Amounts->programarea_payingarea_id->CssClass = "";
		$Refund_Amounts->programarea_payingarea_id->ViewCustomAttributes = "";

		// refund_amount
		$Refund_Amounts->refund_amount->ViewValue = $Refund_Amounts->refund_amount->CurrentValue;
		$Refund_Amounts->refund_amount->CssStyle = "";
		$Refund_Amounts->refund_amount->CssClass = "";
		$Refund_Amounts->refund_amount->ViewCustomAttributes = "";

		// netPayment
		$Refund_Amounts->netPayment->ViewValue = $Refund_Amounts->netPayment->CurrentValue;
		$Refund_Amounts->netPayment->CssStyle = "";
		$Refund_Amounts->netPayment->CssClass = "";
		$Refund_Amounts->netPayment->ViewCustomAttributes = "";

		// date
		$Refund_Amounts->date->HrefValue = "";
		$Refund_Amounts->date->TooltipValue = "";

		// amount
		$Refund_Amounts->amount->HrefValue = "";
		$Refund_Amounts->amount->TooltipValue = "";

		// year
		$Refund_Amounts->year->HrefValue = "";
		$Refund_Amounts->year->TooltipValue = "";

		// scholarship_package_scholarship_package_id
		$Refund_Amounts->scholarship_package_scholarship_package_id->HrefValue = "";
		$Refund_Amounts->scholarship_package_scholarship_package_id->TooltipValue = "";

		// programarea_residentarea_id
		$Refund_Amounts->programarea_residentarea_id->HrefValue = "";
		$Refund_Amounts->programarea_residentarea_id->TooltipValue = "";

		// programarea_payingarea_id
		$Refund_Amounts->programarea_payingarea_id->HrefValue = "";
		$Refund_Amounts->programarea_payingarea_id->TooltipValue = "";

		// refund_amount
		$Refund_Amounts->refund_amount->HrefValue = "";
		$Refund_Amounts->refund_amount->TooltipValue = "";

		// netPayment
		$Refund_Amounts->netPayment->HrefValue = "";
		$Refund_Amounts->netPayment->TooltipValue = "";
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
<?php include "scholarship_packageinfo.php" ?>
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
$Refund_Amounts_report = new cRefund_Amounts_report();
$Page =& $Refund_Amounts_report;

// Page init
$Refund_Amounts_report->Page_Init();

// Page main
$Refund_Amounts_report->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($Refund_Amounts->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($Refund_Amounts->Export == "") { ?>
<?php } ?>
<p><span class="phpmaker"><?php echo $Language->Phrase("TblTypeReport") ?><?php echo $Refund_Amounts->TableCaption() ?>
<?php if ($Refund_Amounts->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Refund_Amounts_report->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $Refund_Amounts_report->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<form method="post">
<table class="ewReportTable" cellspacing="-1">
<?php
$Refund_Amounts_report->lRecCnt = 1; // No grouping
if ($Refund_Amounts_report->sDbDetailFilter <> "") {
	if ($Refund_Amounts_report->sFilter <> "") $Refund_Amounts_report->sFilter .= " AND ";
	$Refund_Amounts_report->sFilter .= "(" . $Refund_Amounts_report->sDbDetailFilter . ")";
}

	// Get detail records
	$Refund_Amounts_report->sFilter = $Refund_Amounts_report->sTblDefaultFilter;
	if ($Refund_Amounts_report->sDbDetailFilter <> "") {
		if ($Refund_Amounts_report->sFilter <> "")
			$Refund_Amounts_report->sFilter .= " AND ";
		$Refund_Amounts_report->sFilter .= "(" . $Refund_Amounts_report->sDbDetailFilter . ")";
	}
	if (!$Security->CanReport()) {
		if ($sFilter <> "") $sFilter .= " AND ";
		$sFilter .= "(0=1)";
	}

	// Set up detail SQL
	$Refund_Amounts->CurrentFilter = $Refund_Amounts_report->sFilter;
	$Refund_Amounts_report->sSql = $Refund_Amounts->DetailSQL();

	// Load detail records
	$rsdtl = $conn->Execute($Refund_Amounts_report->sSql);
	$Refund_Amounts_report->nDtlRecs = $rsdtl->RecordCount();

	// Initialize aggregates
	if (!$rsdtl->EOF) {
		$Refund_Amounts_report->lRecCnt++;
	}
	if ($Refund_Amounts_report->lRecCnt == 1) {
		$Refund_Amounts_report->nCntRecs[0] = 0;
	}
	$Refund_Amounts_report->nCntRecs[0] += $Refund_Amounts_report->nDtlRecs;
?>
	<tr>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refund_Amounts->date->FldCaption() ?></span></td>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refund_Amounts->amount->FldCaption() ?></span></td>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refund_Amounts->year->FldCaption() ?></span></td>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refund_Amounts->scholarship_package_scholarship_package_id->FldCaption() ?></span></td>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refund_Amounts->programarea_residentarea_id->FldCaption() ?></span></td>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refund_Amounts->programarea_payingarea_id->FldCaption() ?></span></td>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refund_Amounts->refund_amount->FldCaption() ?></span></td>
		<td valign="top" class="ewGroupHeader"><span class="phpmaker"><?php echo $Refund_Amounts->netPayment->FldCaption() ?></span></td>
	</tr>
<?php
	while (!$rsdtl->EOF) {
		$Refund_Amounts->date->setDbValue($rsdtl->fields('date'));
		$Refund_Amounts->amount->setDbValue($rsdtl->fields('amount'));
		$Refund_Amounts->year->setDbValue($rsdtl->fields('year'));
		$Refund_Amounts->scholarship_package_scholarship_package_id->setDbValue($rsdtl->fields('scholarship_package_scholarship_package_id'));
		$Refund_Amounts->programarea_residentarea_id->setDbValue($rsdtl->fields('programarea_residentarea_id'));
		$Refund_Amounts->programarea_payingarea_id->setDbValue($rsdtl->fields('programarea_payingarea_id'));
		$Refund_Amounts->refund_amount->setDbValue($rsdtl->fields('refund_amount'));
		$Refund_Amounts->netPayment->setDbValue($rsdtl->fields('netPayment'));

		// Render for view
		$Refund_Amounts->RowType = EW_ROWTYPE_VIEW;
		$Refund_Amounts_report->RenderRow();
?>
	<tr>
		<td><span class="phpmaker">
<div<?php echo $Refund_Amounts->date->ViewAttributes() ?>><?php echo $Refund_Amounts->date->ViewValue ?></div></span></td>
		<td><span class="phpmaker">
<div<?php echo $Refund_Amounts->amount->ViewAttributes() ?>><?php echo $Refund_Amounts->amount->ViewValue ?></div></span></td>
		<td><span class="phpmaker">
<div<?php echo $Refund_Amounts->year->ViewAttributes() ?>><?php echo $Refund_Amounts->year->ViewValue ?></div></span></td>
		<td><span class="phpmaker">
<div<?php echo $Refund_Amounts->scholarship_package_scholarship_package_id->ViewAttributes() ?>><?php echo $Refund_Amounts->scholarship_package_scholarship_package_id->ViewValue ?></div></span></td>
		<td><span class="phpmaker">
<div<?php echo $Refund_Amounts->programarea_residentarea_id->ViewAttributes() ?>><?php echo $Refund_Amounts->programarea_residentarea_id->ViewValue ?></div></span></td>
		<td><span class="phpmaker">
<div<?php echo $Refund_Amounts->programarea_payingarea_id->ViewAttributes() ?>><?php echo $Refund_Amounts->programarea_payingarea_id->ViewValue ?></div></span></td>
		<td><span class="phpmaker">
<div<?php echo $Refund_Amounts->refund_amount->ViewAttributes() ?>><?php echo $Refund_Amounts->refund_amount->ViewValue ?></div></span></td>
		<td><span class="phpmaker">
<div<?php echo $Refund_Amounts->netPayment->ViewAttributes() ?>><?php echo $Refund_Amounts->netPayment->ViewValue ?></div></span></td>
	</tr>
<?php
		$rsdtl->MoveNext();
	}
	$rsdtl->Close();
?>
	<tr><td colspan=8><span class="phpmaker">&nbsp;<br></span></td></tr>
	<tr><td colspan=8 class="ewGrandSummary"><span class="phpmaker"><?php echo $Language->Phrase("RptGrandTotal") ?>&nbsp;(<?php echo ew_FormatNumber($Refund_Amounts_report->nCntRecs[0], 0) ?>&nbsp;<?php echo $Language->Phrase("RptDtlRec") ?>)</span></td></tr>
	<tr><td colspan=8><span class="phpmaker">&nbsp;<br></span></td></tr>
</table>
</form>
<?php if ($Refund_Amounts->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$Refund_Amounts_report->Page_Terminate();
?>
<?php

//
// Page class
//
class cRefund_Amounts_report {

	// Page ID
	var $PageID = 'report';

	// Table name
	var $TableName = 'Refund Amounts';

	// Page object name
	var $PageObjName = 'Refund_Amounts_report';

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
	function cRefund_Amounts_report() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (Refund_Amounts)
		$GLOBALS["Refund_Amounts"] = new cRefund_Amounts();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Table object (scholarship_package)
		$GLOBALS['scholarship_package'] = new cscholarship_package();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'report', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'Refund Amounts', TRUE);

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
		global $Refund_Amounts;

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
			$Refund_Amounts->Export = $_GET["export"];
		}
		$gsExport = $Refund_Amounts->Export; // Get export parameter, used in header
		$gsExportFile = $Refund_Amounts->TableVar; // Get export file, used in header
		if ($Refund_Amounts->Export == "excel") {
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
		global $Language, $Refund_Amounts;
		$this->vGrps =& ew_InitArray(1, NULL);
		$this->nCntRecs =& ew_InitArray(1, 0);
		$this->bLvlBreak =& ew_InitArray(1, FALSE);
		$this->nTotals =& ew_Init2DArray(1, 9, 0);
		$this->nMaxs =& ew_Init2DArray(1, 9, 0);
		$this->nMins =& ew_Init2DArray(1, 9, 0);
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $Refund_Amounts;

		// Initialize URLs
		// Common render codes for all row types
		// date

		$Refund_Amounts->date->CellCssStyle = ""; $Refund_Amounts->date->CellCssClass = "";
		$Refund_Amounts->date->CellAttrs = array(); $Refund_Amounts->date->ViewAttrs = array(); $Refund_Amounts->date->EditAttrs = array();

		// amount
		$Refund_Amounts->amount->CellCssStyle = ""; $Refund_Amounts->amount->CellCssClass = "";
		$Refund_Amounts->amount->CellAttrs = array(); $Refund_Amounts->amount->ViewAttrs = array(); $Refund_Amounts->amount->EditAttrs = array();

		// year
		$Refund_Amounts->year->CellCssStyle = ""; $Refund_Amounts->year->CellCssClass = "";
		$Refund_Amounts->year->CellAttrs = array(); $Refund_Amounts->year->ViewAttrs = array(); $Refund_Amounts->year->EditAttrs = array();

		// scholarship_package_scholarship_package_id
		$Refund_Amounts->scholarship_package_scholarship_package_id->CellCssStyle = ""; $Refund_Amounts->scholarship_package_scholarship_package_id->CellCssClass = "";
		$Refund_Amounts->scholarship_package_scholarship_package_id->CellAttrs = array(); $Refund_Amounts->scholarship_package_scholarship_package_id->ViewAttrs = array(); $Refund_Amounts->scholarship_package_scholarship_package_id->EditAttrs = array();

		// programarea_residentarea_id
		$Refund_Amounts->programarea_residentarea_id->CellCssStyle = ""; $Refund_Amounts->programarea_residentarea_id->CellCssClass = "";
		$Refund_Amounts->programarea_residentarea_id->CellAttrs = array(); $Refund_Amounts->programarea_residentarea_id->ViewAttrs = array(); $Refund_Amounts->programarea_residentarea_id->EditAttrs = array();

		// programarea_payingarea_id
		$Refund_Amounts->programarea_payingarea_id->CellCssStyle = ""; $Refund_Amounts->programarea_payingarea_id->CellCssClass = "";
		$Refund_Amounts->programarea_payingarea_id->CellAttrs = array(); $Refund_Amounts->programarea_payingarea_id->ViewAttrs = array(); $Refund_Amounts->programarea_payingarea_id->EditAttrs = array();

		// refund_amount
		$Refund_Amounts->refund_amount->CellCssStyle = ""; $Refund_Amounts->refund_amount->CellCssClass = "";
		$Refund_Amounts->refund_amount->CellAttrs = array(); $Refund_Amounts->refund_amount->ViewAttrs = array(); $Refund_Amounts->refund_amount->EditAttrs = array();

		// netPayment
		$Refund_Amounts->netPayment->CellCssStyle = ""; $Refund_Amounts->netPayment->CellCssClass = "";
		$Refund_Amounts->netPayment->CellAttrs = array(); $Refund_Amounts->netPayment->ViewAttrs = array(); $Refund_Amounts->netPayment->EditAttrs = array();
		if ($Refund_Amounts->RowType == EW_ROWTYPE_VIEW) { // View row

			// date
			$Refund_Amounts->date->ViewValue = $Refund_Amounts->date->CurrentValue;
			$Refund_Amounts->date->ViewValue = ew_FormatDateTime($Refund_Amounts->date->ViewValue, 7);
			$Refund_Amounts->date->CssStyle = "";
			$Refund_Amounts->date->CssClass = "";
			$Refund_Amounts->date->ViewCustomAttributes = "";

			// amount
			$Refund_Amounts->amount->ViewValue = $Refund_Amounts->amount->CurrentValue;
			$Refund_Amounts->amount->CssStyle = "";
			$Refund_Amounts->amount->CssClass = "";
			$Refund_Amounts->amount->ViewCustomAttributes = "";

			// year
			$Refund_Amounts->year->ViewValue = $Refund_Amounts->year->CurrentValue;
			$Refund_Amounts->year->CssStyle = "";
			$Refund_Amounts->year->CssClass = "";
			$Refund_Amounts->year->ViewCustomAttributes = "";

			// scholarship_package_scholarship_package_id
			if (strval($Refund_Amounts->scholarship_package_scholarship_package_id->CurrentValue) <> "") {
				$sFilterWrk = "`scholarship_package_id` = " . ew_AdjustSql($Refund_Amounts->scholarship_package_scholarship_package_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `annual_amount` FROM `scholarship_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Refund_Amounts->scholarship_package_scholarship_package_id->ViewValue = $rswrk->fields('annual_amount');
					$rswrk->Close();
				} else {
					$Refund_Amounts->scholarship_package_scholarship_package_id->ViewValue = $Refund_Amounts->scholarship_package_scholarship_package_id->CurrentValue;
				}
			} else {
				$Refund_Amounts->scholarship_package_scholarship_package_id->ViewValue = NULL;
			}
			$Refund_Amounts->scholarship_package_scholarship_package_id->CssStyle = "";
			$Refund_Amounts->scholarship_package_scholarship_package_id->CssClass = "";
			$Refund_Amounts->scholarship_package_scholarship_package_id->ViewCustomAttributes = "";

			// programarea_residentarea_id
			if (strval($Refund_Amounts->programarea_residentarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Refund_Amounts->programarea_residentarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Refund_Amounts->programarea_residentarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Refund_Amounts->programarea_residentarea_id->ViewValue = $Refund_Amounts->programarea_residentarea_id->CurrentValue;
				}
			} else {
				$Refund_Amounts->programarea_residentarea_id->ViewValue = NULL;
			}
			$Refund_Amounts->programarea_residentarea_id->CssStyle = "";
			$Refund_Amounts->programarea_residentarea_id->CssClass = "";
			$Refund_Amounts->programarea_residentarea_id->ViewCustomAttributes = "";

			// programarea_payingarea_id
			if (strval($Refund_Amounts->programarea_payingarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Refund_Amounts->programarea_payingarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Refund_Amounts->programarea_payingarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Refund_Amounts->programarea_payingarea_id->ViewValue = $Refund_Amounts->programarea_payingarea_id->CurrentValue;
				}
			} else {
				$Refund_Amounts->programarea_payingarea_id->ViewValue = NULL;
			}
			$Refund_Amounts->programarea_payingarea_id->CssStyle = "";
			$Refund_Amounts->programarea_payingarea_id->CssClass = "";
			$Refund_Amounts->programarea_payingarea_id->ViewCustomAttributes = "";

			// refund_amount
			$Refund_Amounts->refund_amount->ViewValue = $Refund_Amounts->refund_amount->CurrentValue;
			$Refund_Amounts->refund_amount->CssStyle = "";
			$Refund_Amounts->refund_amount->CssClass = "";
			$Refund_Amounts->refund_amount->ViewCustomAttributes = "";

			// netPayment
			$Refund_Amounts->netPayment->ViewValue = $Refund_Amounts->netPayment->CurrentValue;
			$Refund_Amounts->netPayment->CssStyle = "";
			$Refund_Amounts->netPayment->CssClass = "";
			$Refund_Amounts->netPayment->ViewCustomAttributes = "";

			// date
			$Refund_Amounts->date->HrefValue = "";
			$Refund_Amounts->date->TooltipValue = "";

			// amount
			$Refund_Amounts->amount->HrefValue = "";
			$Refund_Amounts->amount->TooltipValue = "";

			// year
			$Refund_Amounts->year->HrefValue = "";
			$Refund_Amounts->year->TooltipValue = "";

			// scholarship_package_scholarship_package_id
			$Refund_Amounts->scholarship_package_scholarship_package_id->HrefValue = "";
			$Refund_Amounts->scholarship_package_scholarship_package_id->TooltipValue = "";

			// programarea_residentarea_id
			$Refund_Amounts->programarea_residentarea_id->HrefValue = "";
			$Refund_Amounts->programarea_residentarea_id->TooltipValue = "";

			// programarea_payingarea_id
			$Refund_Amounts->programarea_payingarea_id->HrefValue = "";
			$Refund_Amounts->programarea_payingarea_id->TooltipValue = "";

			// refund_amount
			$Refund_Amounts->refund_amount->HrefValue = "";
			$Refund_Amounts->refund_amount->TooltipValue = "";

			// netPayment
			$Refund_Amounts->netPayment->HrefValue = "";
			$Refund_Amounts->netPayment->TooltipValue = "";
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

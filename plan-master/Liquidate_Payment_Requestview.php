<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "Liquidate_Payment_Requestinfo.php" ?>
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
$Liquidate_Payment_Request_view = new cLiquidate_Payment_Request_view();
$Page =& $Liquidate_Payment_Request_view;

// Page init
$Liquidate_Payment_Request_view->Page_Init();

// Page main
$Liquidate_Payment_Request_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($Liquidate_Payment_Request->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var Liquidate_Payment_Request_view = new ew_Page("Liquidate_Payment_Request_view");

// page properties
Liquidate_Payment_Request_view.PageID = "view"; // page ID
Liquidate_Payment_Request_view.FormID = "fLiquidate_Payment_Requestview"; // form ID
var EW_PAGE_ID = Liquidate_Payment_Request_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
Liquidate_Payment_Request_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
Liquidate_Payment_Request_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Liquidate_Payment_Request_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $Liquidate_Payment_Request->TableCaption() ?>
<br><br>
<?php if ($Liquidate_Payment_Request->Export == "") { ?>
<a href="<?php echo $Liquidate_Payment_Request_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanEdit()) { ?>
<?php if ($Liquidate_Payment_Request_view->ShowOptionLink()) { ?>
<a href="<?php echo $Liquidate_Payment_Request_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$Liquidate_Payment_Request_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($Liquidate_Payment_Request->payment_request_id->Visible) { // payment_request_id ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->payment_request_id->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->payment_request_id->CellAttributes() ?>>
<div<?php echo $Liquidate_Payment_Request->payment_request_id->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->payment_request_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Liquidate_Payment_Request->year->Visible) { // year ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->year->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->year->CellAttributes() ?>>
<div<?php echo $Liquidate_Payment_Request->year->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->year->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Liquidate_Payment_Request->request_date->Visible) { // request_date ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->request_date->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->request_date->CellAttributes() ?>>
<div<?php echo $Liquidate_Payment_Request->request_date->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->request_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Liquidate_Payment_Request->programarea_id->Visible) { // programarea_id ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->programarea_id->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->programarea_id->CellAttributes() ?>>
<div<?php echo $Liquidate_Payment_Request->programarea_id->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->programarea_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Liquidate_Payment_Request->request_status->Visible) { // request_status ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->request_status->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->request_status->CellAttributes() ?>>
<div<?php echo $Liquidate_Payment_Request->request_status->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->request_status->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Liquidate_Payment_Request->code->Visible) { // code ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->code->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->code->CellAttributes() ?>>
<div<?php echo $Liquidate_Payment_Request->code->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->code->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Liquidate_Payment_Request->financial_year_financial_year_id->Visible) { // financial_year_financial_year_id ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->CellAttributes() ?>>
<div<?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Liquidate_Payment_Request->amount->Visible) { // amount ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->amount->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->amount->CellAttributes() ?>>
<div<?php echo $Liquidate_Payment_Request->amount->ViewAttributes() ?>><?php echo $Liquidate_Payment_Request->amount->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($Liquidate_Payment_Request->liquidationdoc->Visible) { // liquidationdoc ?>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->liquidationdoc->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->liquidationdoc->CellAttributes() ?>>
<?php if ($Liquidate_Payment_Request->liquidationdoc->HrefValue <> "" || $Liquidate_Payment_Request->liquidationdoc->TooltipValue <> "") { ?>
<?php if (!empty($Liquidate_Payment_Request->liquidationdoc->Upload->DbValue)) { ?>
<a href="<?php echo $Liquidate_Payment_Request->liquidationdoc->HrefValue ?>"><?php echo $Liquidate_Payment_Request->liquidationdoc->ViewValue ?></a>
<?php } elseif (!in_array($Liquidate_Payment_Request->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($Liquidate_Payment_Request->liquidationdoc->Upload->DbValue)) { ?>
<?php echo $Liquidate_Payment_Request->liquidationdoc->ViewValue ?>
<?php } elseif (!in_array($Liquidate_Payment_Request->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($Liquidate_Payment_Request->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$Liquidate_Payment_Request_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cLiquidate_Payment_Request_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'Liquidate Payment Request';

	// Page object name
	var $PageObjName = 'Liquidate_Payment_Request_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $Liquidate_Payment_Request;
		if ($Liquidate_Payment_Request->UseTokenInUrl) $PageUrl .= "t=" . $Liquidate_Payment_Request->TableVar . "&"; // Add page token
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
		global $objForm, $Liquidate_Payment_Request;
		if ($Liquidate_Payment_Request->UseTokenInUrl) {
			if ($objForm)
				return ($Liquidate_Payment_Request->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($Liquidate_Payment_Request->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cLiquidate_Payment_Request_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (Liquidate_Payment_Request)
		$GLOBALS["Liquidate_Payment_Request"] = new cLiquidate_Payment_Request();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'Liquidate Payment Request', TRUE);

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
		global $Liquidate_Payment_Request;

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
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("Liquidate_Payment_Requestlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("Liquidate_Payment_Requestlist.php");
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
	var $lDisplayRecs = 1;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $lRecCnt;
	var $arRecKey = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $Liquidate_Payment_Request;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["payment_request_id"] <> "") {
				$Liquidate_Payment_Request->payment_request_id->setQueryStringValue($_GET["payment_request_id"]);
				$this->arRecKey["payment_request_id"] = $Liquidate_Payment_Request->payment_request_id->QueryStringValue;
			} else {
				$sReturnUrl = "Liquidate_Payment_Requestlist.php"; // Return to list
			}

			// Get action
			$Liquidate_Payment_Request->CurrentAction = "I"; // Display form
			switch ($Liquidate_Payment_Request->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "Liquidate_Payment_Requestlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "Liquidate_Payment_Requestlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$Liquidate_Payment_Request->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $Liquidate_Payment_Request;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$Liquidate_Payment_Request->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$Liquidate_Payment_Request->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $Liquidate_Payment_Request->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$Liquidate_Payment_Request->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$Liquidate_Payment_Request->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$Liquidate_Payment_Request->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $Liquidate_Payment_Request;
		$sFilter = $Liquidate_Payment_Request->KeyFilter();

		// Call Row Selecting event
		$Liquidate_Payment_Request->Row_Selecting($sFilter);

		// Load SQL based on filter
		$Liquidate_Payment_Request->CurrentFilter = $sFilter;
		$sSql = $Liquidate_Payment_Request->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$Liquidate_Payment_Request->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $Liquidate_Payment_Request;
		$Liquidate_Payment_Request->payment_request_id->setDbValue($rs->fields('payment_request_id'));
		$Liquidate_Payment_Request->year->setDbValue($rs->fields('year'));
		$Liquidate_Payment_Request->request_date->setDbValue($rs->fields('request_date'));
		$Liquidate_Payment_Request->programarea_id->setDbValue($rs->fields('programarea_id'));
		$Liquidate_Payment_Request->request_status->setDbValue($rs->fields('request_status'));
		$Liquidate_Payment_Request->code->setDbValue($rs->fields('code'));
		$Liquidate_Payment_Request->financial_year_financial_year_id->setDbValue($rs->fields('financial_year_financial_year_id'));
		$Liquidate_Payment_Request->amount->setDbValue($rs->fields('amount'));
		$Liquidate_Payment_Request->group_id->setDbValue($rs->fields('group_id'));
		$Liquidate_Payment_Request->liquidationdoc->Upload->DbValue = $rs->fields('liquidationdoc');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $Liquidate_Payment_Request;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "payment_request_id=" . urlencode($Liquidate_Payment_Request->payment_request_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "payment_request_id=" . urlencode($Liquidate_Payment_Request->payment_request_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "payment_request_id=" . urlencode($Liquidate_Payment_Request->payment_request_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "payment_request_id=" . urlencode($Liquidate_Payment_Request->payment_request_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "payment_request_id=" . urlencode($Liquidate_Payment_Request->payment_request_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "payment_request_id=" . urlencode($Liquidate_Payment_Request->payment_request_id->CurrentValue);
		$this->AddUrl = $Liquidate_Payment_Request->AddUrl();
		$this->EditUrl = $Liquidate_Payment_Request->EditUrl();
		$this->CopyUrl = $Liquidate_Payment_Request->CopyUrl();
		$this->DeleteUrl = $Liquidate_Payment_Request->DeleteUrl();
		$this->ListUrl = $Liquidate_Payment_Request->ListUrl();

		// Call Row_Rendering event
		$Liquidate_Payment_Request->Row_Rendering();

		// Common render codes for all row types
		// payment_request_id

		$Liquidate_Payment_Request->payment_request_id->CellCssStyle = ""; $Liquidate_Payment_Request->payment_request_id->CellCssClass = "";
		$Liquidate_Payment_Request->payment_request_id->CellAttrs = array(); $Liquidate_Payment_Request->payment_request_id->ViewAttrs = array(); $Liquidate_Payment_Request->payment_request_id->EditAttrs = array();

		// year
		$Liquidate_Payment_Request->year->CellCssStyle = ""; $Liquidate_Payment_Request->year->CellCssClass = "";
		$Liquidate_Payment_Request->year->CellAttrs = array(); $Liquidate_Payment_Request->year->ViewAttrs = array(); $Liquidate_Payment_Request->year->EditAttrs = array();

		// request_date
		$Liquidate_Payment_Request->request_date->CellCssStyle = ""; $Liquidate_Payment_Request->request_date->CellCssClass = "";
		$Liquidate_Payment_Request->request_date->CellAttrs = array(); $Liquidate_Payment_Request->request_date->ViewAttrs = array(); $Liquidate_Payment_Request->request_date->EditAttrs = array();

		// programarea_id
		$Liquidate_Payment_Request->programarea_id->CellCssStyle = ""; $Liquidate_Payment_Request->programarea_id->CellCssClass = "";
		$Liquidate_Payment_Request->programarea_id->CellAttrs = array(); $Liquidate_Payment_Request->programarea_id->ViewAttrs = array(); $Liquidate_Payment_Request->programarea_id->EditAttrs = array();

		// request_status
		$Liquidate_Payment_Request->request_status->CellCssStyle = ""; $Liquidate_Payment_Request->request_status->CellCssClass = "";
		$Liquidate_Payment_Request->request_status->CellAttrs = array(); $Liquidate_Payment_Request->request_status->ViewAttrs = array(); $Liquidate_Payment_Request->request_status->EditAttrs = array();

		// code
		$Liquidate_Payment_Request->code->CellCssStyle = ""; $Liquidate_Payment_Request->code->CellCssClass = "";
		$Liquidate_Payment_Request->code->CellAttrs = array(); $Liquidate_Payment_Request->code->ViewAttrs = array(); $Liquidate_Payment_Request->code->EditAttrs = array();

		// financial_year_financial_year_id
		$Liquidate_Payment_Request->financial_year_financial_year_id->CellCssStyle = ""; $Liquidate_Payment_Request->financial_year_financial_year_id->CellCssClass = "";
		$Liquidate_Payment_Request->financial_year_financial_year_id->CellAttrs = array(); $Liquidate_Payment_Request->financial_year_financial_year_id->ViewAttrs = array(); $Liquidate_Payment_Request->financial_year_financial_year_id->EditAttrs = array();

		// amount
		$Liquidate_Payment_Request->amount->CellCssStyle = ""; $Liquidate_Payment_Request->amount->CellCssClass = "";
		$Liquidate_Payment_Request->amount->CellAttrs = array(); $Liquidate_Payment_Request->amount->ViewAttrs = array(); $Liquidate_Payment_Request->amount->EditAttrs = array();

		// liquidationdoc
		$Liquidate_Payment_Request->liquidationdoc->CellCssStyle = ""; $Liquidate_Payment_Request->liquidationdoc->CellCssClass = "";
		$Liquidate_Payment_Request->liquidationdoc->CellAttrs = array(); $Liquidate_Payment_Request->liquidationdoc->ViewAttrs = array(); $Liquidate_Payment_Request->liquidationdoc->EditAttrs = array();
		if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_request_id
			$Liquidate_Payment_Request->payment_request_id->ViewValue = $Liquidate_Payment_Request->payment_request_id->CurrentValue;
			$Liquidate_Payment_Request->payment_request_id->CssStyle = "";
			$Liquidate_Payment_Request->payment_request_id->CssClass = "";
			$Liquidate_Payment_Request->payment_request_id->ViewCustomAttributes = "";

			// year
			$Liquidate_Payment_Request->year->ViewValue = $Liquidate_Payment_Request->year->CurrentValue;
			$Liquidate_Payment_Request->year->CssStyle = "";
			$Liquidate_Payment_Request->year->CssClass = "";
			$Liquidate_Payment_Request->year->ViewCustomAttributes = "";

			// request_date
			$Liquidate_Payment_Request->request_date->ViewValue = $Liquidate_Payment_Request->request_date->CurrentValue;
			$Liquidate_Payment_Request->request_date->ViewValue = ew_FormatDateTime($Liquidate_Payment_Request->request_date->ViewValue, 7);
			$Liquidate_Payment_Request->request_date->CssStyle = "";
			$Liquidate_Payment_Request->request_date->CssClass = "";
			$Liquidate_Payment_Request->request_date->ViewCustomAttributes = "";

			// programarea_id
			if (strval($Liquidate_Payment_Request->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Liquidate_Payment_Request->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Liquidate_Payment_Request->programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Liquidate_Payment_Request->programarea_id->ViewValue = $Liquidate_Payment_Request->programarea_id->CurrentValue;
				}
			} else {
				$Liquidate_Payment_Request->programarea_id->ViewValue = NULL;
			}
			$Liquidate_Payment_Request->programarea_id->CssStyle = "";
			$Liquidate_Payment_Request->programarea_id->CssClass = "";
			$Liquidate_Payment_Request->programarea_id->ViewCustomAttributes = "";

			// request_status
			if (strval($Liquidate_Payment_Request->request_status->CurrentValue) <> "") {
				switch ($Liquidate_Payment_Request->request_status->CurrentValue) {
					case "DISBURSED":
						$Liquidate_Payment_Request->request_status->ViewValue = "DISBURSED";
						break;
					case "LIQUIDATED":
						$Liquidate_Payment_Request->request_status->ViewValue = "LIQUIDATED";
						break;
					default:
						$Liquidate_Payment_Request->request_status->ViewValue = $Liquidate_Payment_Request->request_status->CurrentValue;
				}
			} else {
				$Liquidate_Payment_Request->request_status->ViewValue = NULL;
			}
			$Liquidate_Payment_Request->request_status->CssStyle = "";
			$Liquidate_Payment_Request->request_status->CssClass = "";
			$Liquidate_Payment_Request->request_status->ViewCustomAttributes = "";

			// code
			$Liquidate_Payment_Request->code->ViewValue = $Liquidate_Payment_Request->code->CurrentValue;
			$Liquidate_Payment_Request->code->CssStyle = "";
			$Liquidate_Payment_Request->code->CssClass = "";
			$Liquidate_Payment_Request->code->ViewCustomAttributes = "";

			// financial_year_financial_year_id
			if (strval($Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`financial_year_id` = " . ew_AdjustSql($Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year_name` FROM `financial_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Liquidate_Payment_Request->financial_year_financial_year_id->ViewValue = $rswrk->fields('year_name');
					$rswrk->Close();
				} else {
					$Liquidate_Payment_Request->financial_year_financial_year_id->ViewValue = $Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue;
				}
			} else {
				$Liquidate_Payment_Request->financial_year_financial_year_id->ViewValue = NULL;
			}
			$Liquidate_Payment_Request->financial_year_financial_year_id->CssStyle = "";
			$Liquidate_Payment_Request->financial_year_financial_year_id->CssClass = "";
			$Liquidate_Payment_Request->financial_year_financial_year_id->ViewCustomAttributes = "";

			// amount
			$Liquidate_Payment_Request->amount->ViewValue = $Liquidate_Payment_Request->amount->CurrentValue;
			$Liquidate_Payment_Request->amount->CssStyle = "";
			$Liquidate_Payment_Request->amount->CssClass = "";
			$Liquidate_Payment_Request->amount->ViewCustomAttributes = "";

			// group_id
			$Liquidate_Payment_Request->group_id->ViewValue = $Liquidate_Payment_Request->group_id->CurrentValue;
			$Liquidate_Payment_Request->group_id->CssStyle = "";
			$Liquidate_Payment_Request->group_id->CssClass = "";
			$Liquidate_Payment_Request->group_id->ViewCustomAttributes = "";

			// liquidationdoc
			if (!ew_Empty($Liquidate_Payment_Request->liquidationdoc->Upload->DbValue)) {
				$Liquidate_Payment_Request->liquidationdoc->ViewValue = $Liquidate_Payment_Request->liquidationdoc->Upload->DbValue;
			} else {
				$Liquidate_Payment_Request->liquidationdoc->ViewValue = "";
			}
			$Liquidate_Payment_Request->liquidationdoc->CssStyle = "";
			$Liquidate_Payment_Request->liquidationdoc->CssClass = "";
			$Liquidate_Payment_Request->liquidationdoc->ViewCustomAttributes = "";

			// payment_request_id
			$Liquidate_Payment_Request->payment_request_id->HrefValue = "";
			$Liquidate_Payment_Request->payment_request_id->TooltipValue = "";

			// year
			$Liquidate_Payment_Request->year->HrefValue = "";
			$Liquidate_Payment_Request->year->TooltipValue = "";

			// request_date
			$Liquidate_Payment_Request->request_date->HrefValue = "";
			$Liquidate_Payment_Request->request_date->TooltipValue = "";

			// programarea_id
			$Liquidate_Payment_Request->programarea_id->HrefValue = "";
			$Liquidate_Payment_Request->programarea_id->TooltipValue = "";

			// request_status
			$Liquidate_Payment_Request->request_status->HrefValue = "";
			$Liquidate_Payment_Request->request_status->TooltipValue = "";

			// code
			$Liquidate_Payment_Request->code->HrefValue = "";
			$Liquidate_Payment_Request->code->TooltipValue = "";

			// financial_year_financial_year_id
			$Liquidate_Payment_Request->financial_year_financial_year_id->HrefValue = "";
			$Liquidate_Payment_Request->financial_year_financial_year_id->TooltipValue = "";

			// amount
			$Liquidate_Payment_Request->amount->HrefValue = "";
			$Liquidate_Payment_Request->amount->TooltipValue = "";

			// liquidationdoc
			if (!ew_Empty($Liquidate_Payment_Request->liquidationdoc->Upload->DbValue)) {
				$Liquidate_Payment_Request->liquidationdoc->HrefValue = ew_UploadPathEx(FALSE, $Liquidate_Payment_Request->liquidationdoc->UploadPath) . ((!empty($Liquidate_Payment_Request->liquidationdoc->ViewValue)) ? $Liquidate_Payment_Request->liquidationdoc->ViewValue : $Liquidate_Payment_Request->liquidationdoc->CurrentValue);
				if ($Liquidate_Payment_Request->Export <> "") $Liquidate_Payment_Request->liquidationdoc->HrefValue = ew_ConvertFullUrl($Liquidate_Payment_Request->liquidationdoc->HrefValue);
			} else {
				$Liquidate_Payment_Request->liquidationdoc->HrefValue = "";
			}
			$Liquidate_Payment_Request->liquidationdoc->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($Liquidate_Payment_Request->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$Liquidate_Payment_Request->Row_Rendered();
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $Liquidate_Payment_Request;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($Liquidate_Payment_Request->group_id->CurrentValue);
			}
		}
		return TRUE;
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

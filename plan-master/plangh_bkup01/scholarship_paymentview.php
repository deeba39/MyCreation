<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "scholarship_paymentinfo.php" ?>
<?php include "sponsored_studentinfo.php" ?>
<?php include "scholarship_packageinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "payment_requestinfo.php" ?>
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
$scholarship_payment_view = new cscholarship_payment_view();
$Page =& $scholarship_payment_view;

// Page init
$scholarship_payment_view->Page_Init();

// Page main
$scholarship_payment_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($scholarship_payment->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var scholarship_payment_view = new ew_Page("scholarship_payment_view");

// page properties
scholarship_payment_view.PageID = "view"; // page ID
scholarship_payment_view.FormID = "fscholarship_paymentview"; // form ID
var EW_PAGE_ID = scholarship_payment_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
scholarship_payment_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
scholarship_payment_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
scholarship_payment_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $scholarship_payment->TableCaption() ?>
<br><br>
<?php if ($scholarship_payment->Export == "") { ?>
<a href="<?php echo $scholarship_payment_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<?php if ($scholarship_payment_view->ShowOptionLink()) { ?>
<a href="<?php echo $scholarship_payment_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<?php if ($scholarship_payment_view->ShowOptionLink()) { ?>
<a href="<?php echo $scholarship_payment_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<?php if ($scholarship_payment_view->ShowOptionLink()) { ?>
<a href="<?php echo $scholarship_payment_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$scholarship_payment_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($scholarship_payment->scholarship_payment_id->Visible) { // scholarship_payment_id ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->scholarship_payment_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->scholarship_payment_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->scholarship_payment_id->ViewAttributes() ?>><?php echo $scholarship_payment->scholarship_payment_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->date->Visible) { // date ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->date->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->date->CellAttributes() ?>>
<div<?php echo $scholarship_payment->date->ViewAttributes() ?>><?php echo $scholarship_payment->date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->status->Visible) { // status ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->status->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->status->CellAttributes() ?>>
<div<?php echo $scholarship_payment->status->ViewAttributes() ?>><?php echo $scholarship_payment->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->amount->Visible) { // amount ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->amount->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->amount->CellAttributes() ?>>
<div<?php echo $scholarship_payment->amount->ViewAttributes() ?>><?php echo $scholarship_payment->amount->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->memo->Visible) { // memo ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->memo->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->memo->CellAttributes() ?>>
<div<?php echo $scholarship_payment->memo->ViewAttributes() ?>><?php echo $scholarship_payment->memo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->year->Visible) { // year ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->year->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->year->CellAttributes() ?>>
<div<?php echo $scholarship_payment->year->ViewAttributes() ?>><?php echo $scholarship_payment->year->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->scholarship_package_scholarship_package_id->Visible) { // scholarship_package_scholarship_package_id ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->scholarship_package_scholarship_package_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->scholarship_package_scholarship_package_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->scholarship_package_scholarship_package_id->ViewAttributes() ?>><?php echo $scholarship_payment->scholarship_package_scholarship_package_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->programarea_residentarea_id->Visible) { // programarea_residentarea_id ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->programarea_residentarea_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->programarea_residentarea_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->programarea_residentarea_id->ViewAttributes() ?>><?php echo $scholarship_payment->programarea_residentarea_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->programarea_payingarea_id->Visible) { // programarea_payingarea_id ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->programarea_payingarea_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->programarea_payingarea_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->programarea_payingarea_id->ViewAttributes() ?>><?php echo $scholarship_payment->programarea_payingarea_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->refund_amount->Visible) { // refund_amount ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->refund_amount->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->refund_amount->CellAttributes() ?>>
<div<?php echo $scholarship_payment->refund_amount->ViewAttributes() ?>><?php echo $scholarship_payment->refund_amount->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->payment_request_payment_request_id->Visible) { // payment_request_payment_request_id ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->payment_request_payment_request_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->payment_request_payment_request_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->payment_request_payment_request_id->ViewAttributes() ?>><?php echo $scholarship_payment->payment_request_payment_request_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->bankname->Visible) { // bankname ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->bankname->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->bankname->CellAttributes() ?>>
<div<?php echo $scholarship_payment->bankname->ViewAttributes() ?>><?php echo $scholarship_payment->bankname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->account_no->Visible) { // account_no ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->account_no->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->account_no->CellAttributes() ?>>
<div<?php echo $scholarship_payment->account_no->ViewAttributes() ?>><?php echo $scholarship_payment->account_no->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->schools_school_id->Visible) { // schools_school_id ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->schools_school_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->schools_school_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->schools_school_id->ViewAttributes() ?>><?php echo $scholarship_payment->schools_school_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->group_id->Visible) { // group_id ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->group_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->group_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->group_id->ViewAttributes() ?>><?php echo $scholarship_payment->group_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($scholarship_payment->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$scholarship_payment_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cscholarship_payment_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'scholarship_payment';

	// Page object name
	var $PageObjName = 'scholarship_payment_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $scholarship_payment;
		if ($scholarship_payment->UseTokenInUrl) $PageUrl .= "t=" . $scholarship_payment->TableVar . "&"; // Add page token
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
		global $objForm, $scholarship_payment;
		if ($scholarship_payment->UseTokenInUrl) {
			if ($objForm)
				return ($scholarship_payment->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($scholarship_payment->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cscholarship_payment_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (scholarship_payment)
		$GLOBALS["scholarship_payment"] = new cscholarship_payment();

		// Table object (sponsored_student)
		$GLOBALS['sponsored_student'] = new csponsored_student();

		// Table object (scholarship_package)
		$GLOBALS['scholarship_package'] = new cscholarship_package();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (payment_request)
		$GLOBALS['payment_request'] = new cpayment_request();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'scholarship_payment', TRUE);

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
		global $scholarship_payment;

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
			$this->Page_Terminate("scholarship_paymentlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("scholarship_paymentlist.php");
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
		global $Language, $scholarship_payment;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["scholarship_payment_id"] <> "") {
				$scholarship_payment->scholarship_payment_id->setQueryStringValue($_GET["scholarship_payment_id"]);
				$this->arRecKey["scholarship_payment_id"] = $scholarship_payment->scholarship_payment_id->QueryStringValue;
			} else {
				$sReturnUrl = "scholarship_paymentlist.php"; // Return to list
			}

			// Get action
			$scholarship_payment->CurrentAction = "I"; // Display form
			switch ($scholarship_payment->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "scholarship_paymentlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "scholarship_paymentlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$scholarship_payment->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $scholarship_payment;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$scholarship_payment->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$scholarship_payment->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $scholarship_payment->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$scholarship_payment->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$scholarship_payment->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$scholarship_payment->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $scholarship_payment;
		$sFilter = $scholarship_payment->KeyFilter();

		// Call Row Selecting event
		$scholarship_payment->Row_Selecting($sFilter);

		// Load SQL based on filter
		$scholarship_payment->CurrentFilter = $sFilter;
		$sSql = $scholarship_payment->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$scholarship_payment->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $scholarship_payment;
		$scholarship_payment->scholarship_payment_id->setDbValue($rs->fields('scholarship_payment_id'));
		$scholarship_payment->date->setDbValue($rs->fields('date'));
		$scholarship_payment->status->setDbValue($rs->fields('status'));
		$scholarship_payment->amount->setDbValue($rs->fields('amount'));
		$scholarship_payment->memo->setDbValue($rs->fields('memo'));
		$scholarship_payment->year->setDbValue($rs->fields('year'));
		$scholarship_payment->scholarship_package_scholarship_package_id->setDbValue($rs->fields('scholarship_package_scholarship_package_id'));
		$scholarship_payment->programarea_residentarea_id->setDbValue($rs->fields('programarea_residentarea_id'));
		$scholarship_payment->programarea_payingarea_id->setDbValue($rs->fields('programarea_payingarea_id'));
		$scholarship_payment->refund_amount->setDbValue($rs->fields('refund_amount'));
		$scholarship_payment->payment_request_payment_request_id->setDbValue($rs->fields('payment_request_payment_request_id'));
		$scholarship_payment->bankname->setDbValue($rs->fields('bankname'));
		$scholarship_payment->account_no->setDbValue($rs->fields('account_no'));
		$scholarship_payment->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$scholarship_payment->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $scholarship_payment;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "scholarship_payment_id=" . urlencode($scholarship_payment->scholarship_payment_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "scholarship_payment_id=" . urlencode($scholarship_payment->scholarship_payment_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "scholarship_payment_id=" . urlencode($scholarship_payment->scholarship_payment_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "scholarship_payment_id=" . urlencode($scholarship_payment->scholarship_payment_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "scholarship_payment_id=" . urlencode($scholarship_payment->scholarship_payment_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "scholarship_payment_id=" . urlencode($scholarship_payment->scholarship_payment_id->CurrentValue);
		$this->AddUrl = $scholarship_payment->AddUrl();
		$this->EditUrl = $scholarship_payment->EditUrl();
		$this->CopyUrl = $scholarship_payment->CopyUrl();
		$this->DeleteUrl = $scholarship_payment->DeleteUrl();
		$this->ListUrl = $scholarship_payment->ListUrl();

		// Call Row_Rendering event
		$scholarship_payment->Row_Rendering();

		// Common render codes for all row types
		// scholarship_payment_id

		$scholarship_payment->scholarship_payment_id->CellCssStyle = ""; $scholarship_payment->scholarship_payment_id->CellCssClass = "";
		$scholarship_payment->scholarship_payment_id->CellAttrs = array(); $scholarship_payment->scholarship_payment_id->ViewAttrs = array(); $scholarship_payment->scholarship_payment_id->EditAttrs = array();

		// date
		$scholarship_payment->date->CellCssStyle = ""; $scholarship_payment->date->CellCssClass = "";
		$scholarship_payment->date->CellAttrs = array(); $scholarship_payment->date->ViewAttrs = array(); $scholarship_payment->date->EditAttrs = array();

		// status
		$scholarship_payment->status->CellCssStyle = ""; $scholarship_payment->status->CellCssClass = "";
		$scholarship_payment->status->CellAttrs = array(); $scholarship_payment->status->ViewAttrs = array(); $scholarship_payment->status->EditAttrs = array();

		// amount
		$scholarship_payment->amount->CellCssStyle = ""; $scholarship_payment->amount->CellCssClass = "";
		$scholarship_payment->amount->CellAttrs = array(); $scholarship_payment->amount->ViewAttrs = array(); $scholarship_payment->amount->EditAttrs = array();

		// memo
		$scholarship_payment->memo->CellCssStyle = ""; $scholarship_payment->memo->CellCssClass = "";
		$scholarship_payment->memo->CellAttrs = array(); $scholarship_payment->memo->ViewAttrs = array(); $scholarship_payment->memo->EditAttrs = array();

		// year
		$scholarship_payment->year->CellCssStyle = ""; $scholarship_payment->year->CellCssClass = "";
		$scholarship_payment->year->CellAttrs = array(); $scholarship_payment->year->ViewAttrs = array(); $scholarship_payment->year->EditAttrs = array();

		// scholarship_package_scholarship_package_id
		$scholarship_payment->scholarship_package_scholarship_package_id->CellCssStyle = ""; $scholarship_payment->scholarship_package_scholarship_package_id->CellCssClass = "";
		$scholarship_payment->scholarship_package_scholarship_package_id->CellAttrs = array(); $scholarship_payment->scholarship_package_scholarship_package_id->ViewAttrs = array(); $scholarship_payment->scholarship_package_scholarship_package_id->EditAttrs = array();

		// programarea_residentarea_id
		$scholarship_payment->programarea_residentarea_id->CellCssStyle = ""; $scholarship_payment->programarea_residentarea_id->CellCssClass = "";
		$scholarship_payment->programarea_residentarea_id->CellAttrs = array(); $scholarship_payment->programarea_residentarea_id->ViewAttrs = array(); $scholarship_payment->programarea_residentarea_id->EditAttrs = array();

		// programarea_payingarea_id
		$scholarship_payment->programarea_payingarea_id->CellCssStyle = ""; $scholarship_payment->programarea_payingarea_id->CellCssClass = "";
		$scholarship_payment->programarea_payingarea_id->CellAttrs = array(); $scholarship_payment->programarea_payingarea_id->ViewAttrs = array(); $scholarship_payment->programarea_payingarea_id->EditAttrs = array();

		// refund_amount
		$scholarship_payment->refund_amount->CellCssStyle = ""; $scholarship_payment->refund_amount->CellCssClass = "";
		$scholarship_payment->refund_amount->CellAttrs = array(); $scholarship_payment->refund_amount->ViewAttrs = array(); $scholarship_payment->refund_amount->EditAttrs = array();

		// payment_request_payment_request_id
		$scholarship_payment->payment_request_payment_request_id->CellCssStyle = ""; $scholarship_payment->payment_request_payment_request_id->CellCssClass = "";
		$scholarship_payment->payment_request_payment_request_id->CellAttrs = array(); $scholarship_payment->payment_request_payment_request_id->ViewAttrs = array(); $scholarship_payment->payment_request_payment_request_id->EditAttrs = array();

		// bankname
		$scholarship_payment->bankname->CellCssStyle = ""; $scholarship_payment->bankname->CellCssClass = "";
		$scholarship_payment->bankname->CellAttrs = array(); $scholarship_payment->bankname->ViewAttrs = array(); $scholarship_payment->bankname->EditAttrs = array();

		// account_no
		$scholarship_payment->account_no->CellCssStyle = ""; $scholarship_payment->account_no->CellCssClass = "";
		$scholarship_payment->account_no->CellAttrs = array(); $scholarship_payment->account_no->ViewAttrs = array(); $scholarship_payment->account_no->EditAttrs = array();

		// schools_school_id
		$scholarship_payment->schools_school_id->CellCssStyle = ""; $scholarship_payment->schools_school_id->CellCssClass = "";
		$scholarship_payment->schools_school_id->CellAttrs = array(); $scholarship_payment->schools_school_id->ViewAttrs = array(); $scholarship_payment->schools_school_id->EditAttrs = array();

		// group_id
		$scholarship_payment->group_id->CellCssStyle = ""; $scholarship_payment->group_id->CellCssClass = "";
		$scholarship_payment->group_id->CellAttrs = array(); $scholarship_payment->group_id->ViewAttrs = array(); $scholarship_payment->group_id->EditAttrs = array();
		if ($scholarship_payment->RowType == EW_ROWTYPE_VIEW) { // View row

			// scholarship_payment_id
			$scholarship_payment->scholarship_payment_id->ViewValue = $scholarship_payment->scholarship_payment_id->CurrentValue;
			$scholarship_payment->scholarship_payment_id->CssStyle = "";
			$scholarship_payment->scholarship_payment_id->CssClass = "";
			$scholarship_payment->scholarship_payment_id->ViewCustomAttributes = "";

			// date
			$scholarship_payment->date->ViewValue = $scholarship_payment->date->CurrentValue;
			$scholarship_payment->date->ViewValue = ew_FormatDateTime($scholarship_payment->date->ViewValue, 7);
			$scholarship_payment->date->CssStyle = "";
			$scholarship_payment->date->CssClass = "";
			$scholarship_payment->date->ViewCustomAttributes = "";

			// status
			if (strval($scholarship_payment->status->CurrentValue) <> "") {
				switch ($scholarship_payment->status->CurrentValue) {
					case "PENDING":
						$scholarship_payment->status->ViewValue = "PENDING";
						break;
					case "PAID":
						$scholarship_payment->status->ViewValue = "PAID";
						break;
					default:
						$scholarship_payment->status->ViewValue = $scholarship_payment->status->CurrentValue;
				}
			} else {
				$scholarship_payment->status->ViewValue = NULL;
			}
			$scholarship_payment->status->CssStyle = "";
			$scholarship_payment->status->CssClass = "";
			$scholarship_payment->status->ViewCustomAttributes = "";

			// amount
			$scholarship_payment->amount->ViewValue = $scholarship_payment->amount->CurrentValue;
			$scholarship_payment->amount->CssStyle = "";
			$scholarship_payment->amount->CssClass = "";
			$scholarship_payment->amount->ViewCustomAttributes = "";

			// memo
			$scholarship_payment->memo->ViewValue = $scholarship_payment->memo->CurrentValue;
			$scholarship_payment->memo->CssStyle = "";
			$scholarship_payment->memo->CssClass = "";
			$scholarship_payment->memo->ViewCustomAttributes = "";

			// year
			$scholarship_payment->year->ViewValue = $scholarship_payment->year->CurrentValue;
			$scholarship_payment->year->CssStyle = "";
			$scholarship_payment->year->CssClass = "";
			$scholarship_payment->year->ViewCustomAttributes = "";

			// scholarship_package_scholarship_package_id
			if (strval($scholarship_payment->scholarship_package_scholarship_package_id->CurrentValue) <> "") {
				$sFilterWrk = "`scholarship_package_id` = " . ew_AdjustSql($scholarship_payment->scholarship_package_scholarship_package_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `annual_amount` FROM `scholarship_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->scholarship_package_scholarship_package_id->ViewValue = $rswrk->fields('annual_amount');
					$rswrk->Close();
				} else {
					$scholarship_payment->scholarship_package_scholarship_package_id->ViewValue = $scholarship_payment->scholarship_package_scholarship_package_id->CurrentValue;
				}
			} else {
				$scholarship_payment->scholarship_package_scholarship_package_id->ViewValue = NULL;
			}
			$scholarship_payment->scholarship_package_scholarship_package_id->CssStyle = "";
			$scholarship_payment->scholarship_package_scholarship_package_id->CssClass = "";
			$scholarship_payment->scholarship_package_scholarship_package_id->ViewCustomAttributes = "";

			// programarea_residentarea_id
			if (strval($scholarship_payment->programarea_residentarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($scholarship_payment->programarea_residentarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->programarea_residentarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$scholarship_payment->programarea_residentarea_id->ViewValue = $scholarship_payment->programarea_residentarea_id->CurrentValue;
				}
			} else {
				$scholarship_payment->programarea_residentarea_id->ViewValue = NULL;
			}
			$scholarship_payment->programarea_residentarea_id->CssStyle = "";
			$scholarship_payment->programarea_residentarea_id->CssClass = "";
			$scholarship_payment->programarea_residentarea_id->ViewCustomAttributes = "";

			// programarea_payingarea_id
			if (strval($scholarship_payment->programarea_payingarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($scholarship_payment->programarea_payingarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->programarea_payingarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$scholarship_payment->programarea_payingarea_id->ViewValue = $scholarship_payment->programarea_payingarea_id->CurrentValue;
				}
			} else {
				$scholarship_payment->programarea_payingarea_id->ViewValue = NULL;
			}
			$scholarship_payment->programarea_payingarea_id->CssStyle = "";
			$scholarship_payment->programarea_payingarea_id->CssClass = "";
			$scholarship_payment->programarea_payingarea_id->ViewCustomAttributes = "";

			// refund_amount
			$scholarship_payment->refund_amount->ViewValue = $scholarship_payment->refund_amount->CurrentValue;
			$scholarship_payment->refund_amount->CssStyle = "";
			$scholarship_payment->refund_amount->CssClass = "";
			$scholarship_payment->refund_amount->ViewCustomAttributes = "";

			// payment_request_payment_request_id
			if (strval($scholarship_payment->payment_request_payment_request_id->CurrentValue) <> "") {
				$sFilterWrk = "`payment_request_id` = " . ew_AdjustSql($scholarship_payment->payment_request_payment_request_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `code` FROM `payment_request`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->payment_request_payment_request_id->ViewValue = $rswrk->fields('code');
					$rswrk->Close();
				} else {
					$scholarship_payment->payment_request_payment_request_id->ViewValue = $scholarship_payment->payment_request_payment_request_id->CurrentValue;
				}
			} else {
				$scholarship_payment->payment_request_payment_request_id->ViewValue = NULL;
			}
			$scholarship_payment->payment_request_payment_request_id->CssStyle = "";
			$scholarship_payment->payment_request_payment_request_id->CssClass = "";
			$scholarship_payment->payment_request_payment_request_id->ViewCustomAttributes = "";

			// bankname
			$scholarship_payment->bankname->ViewValue = $scholarship_payment->bankname->CurrentValue;
			$scholarship_payment->bankname->CssStyle = "";
			$scholarship_payment->bankname->CssClass = "";
			$scholarship_payment->bankname->ViewCustomAttributes = "";

			// account_no
			$scholarship_payment->account_no->ViewValue = $scholarship_payment->account_no->CurrentValue;
			$scholarship_payment->account_no->CssStyle = "";
			$scholarship_payment->account_no->CssClass = "";
			$scholarship_payment->account_no->ViewCustomAttributes = "";

			// schools_school_id
			$scholarship_payment->schools_school_id->ViewValue = $scholarship_payment->schools_school_id->CurrentValue;
			if (strval($scholarship_payment->schools_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($scholarship_payment->schools_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->schools_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$scholarship_payment->schools_school_id->ViewValue = $scholarship_payment->schools_school_id->CurrentValue;
				}
			} else {
				$scholarship_payment->schools_school_id->ViewValue = NULL;
			}
			$scholarship_payment->schools_school_id->CssStyle = "";
			$scholarship_payment->schools_school_id->CssClass = "";
			$scholarship_payment->schools_school_id->ViewCustomAttributes = "";

			// group_id
			$scholarship_payment->group_id->ViewValue = $scholarship_payment->group_id->CurrentValue;
			$scholarship_payment->group_id->CssStyle = "";
			$scholarship_payment->group_id->CssClass = "";
			$scholarship_payment->group_id->ViewCustomAttributes = "";

			// scholarship_payment_id
			$scholarship_payment->scholarship_payment_id->HrefValue = "";
			$scholarship_payment->scholarship_payment_id->TooltipValue = "";

			// date
			$scholarship_payment->date->HrefValue = "";
			$scholarship_payment->date->TooltipValue = "";

			// status
			$scholarship_payment->status->HrefValue = "";
			$scholarship_payment->status->TooltipValue = "";

			// amount
			$scholarship_payment->amount->HrefValue = "";
			$scholarship_payment->amount->TooltipValue = "";

			// memo
			$scholarship_payment->memo->HrefValue = "";
			$scholarship_payment->memo->TooltipValue = "";

			// year
			$scholarship_payment->year->HrefValue = "";
			$scholarship_payment->year->TooltipValue = "";

			// scholarship_package_scholarship_package_id
			$scholarship_payment->scholarship_package_scholarship_package_id->HrefValue = "";
			$scholarship_payment->scholarship_package_scholarship_package_id->TooltipValue = "";

			// programarea_residentarea_id
			$scholarship_payment->programarea_residentarea_id->HrefValue = "";
			$scholarship_payment->programarea_residentarea_id->TooltipValue = "";

			// programarea_payingarea_id
			$scholarship_payment->programarea_payingarea_id->HrefValue = "";
			$scholarship_payment->programarea_payingarea_id->TooltipValue = "";

			// refund_amount
			$scholarship_payment->refund_amount->HrefValue = "";
			$scholarship_payment->refund_amount->TooltipValue = "";

			// payment_request_payment_request_id
			$scholarship_payment->payment_request_payment_request_id->HrefValue = "";
			$scholarship_payment->payment_request_payment_request_id->TooltipValue = "";

			// bankname
			$scholarship_payment->bankname->HrefValue = "";
			$scholarship_payment->bankname->TooltipValue = "";

			// account_no
			$scholarship_payment->account_no->HrefValue = "";
			$scholarship_payment->account_no->TooltipValue = "";

			// schools_school_id
			$scholarship_payment->schools_school_id->HrefValue = "";
			$scholarship_payment->schools_school_id->TooltipValue = "";

			// group_id
			$scholarship_payment->group_id->HrefValue = "";
			$scholarship_payment->group_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($scholarship_payment->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$scholarship_payment->Row_Rendered();
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $scholarship_payment;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($scholarship_payment->group_id->CurrentValue);
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

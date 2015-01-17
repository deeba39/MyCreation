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
$scholarship_payment_delete = new cscholarship_payment_delete();
$Page =& $scholarship_payment_delete;

// Page init
$scholarship_payment_delete->Page_Init();

// Page main
$scholarship_payment_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var scholarship_payment_delete = new ew_Page("scholarship_payment_delete");

// page properties
scholarship_payment_delete.PageID = "delete"; // page ID
scholarship_payment_delete.FormID = "fscholarship_paymentdelete"; // form ID
var EW_PAGE_ID = scholarship_payment_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
scholarship_payment_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
scholarship_payment_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
scholarship_payment_delete.ValidateRequired = false; // no JavaScript validation
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
<?php

// Load records for display
if ($rs = $scholarship_payment_delete->LoadRecordset())
	$scholarship_payment_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($scholarship_payment_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$scholarship_payment_delete->Page_Terminate("scholarship_paymentlist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $scholarship_payment->TableCaption() ?><br><br>
<a href="<?php echo $scholarship_payment->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$scholarship_payment_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="scholarship_payment">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($scholarship_payment_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $scholarship_payment->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $scholarship_payment->status->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_payment->year->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_payment->scholarship_package_scholarship_package_id->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_payment->programarea_residentarea_id->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_payment->programarea_payingarea_id->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_payment->refund_amount->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_payment->payment_request_payment_request_id->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_payment->bankname->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_payment->account_no->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_payment->schools_school_id->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_payment->group_id->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$scholarship_payment_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$scholarship_payment_delete->lRecCnt++;

	// Set row properties
	$scholarship_payment->CssClass = "";
	$scholarship_payment->CssStyle = "";
	$scholarship_payment->RowAttrs = array();
	$scholarship_payment->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$scholarship_payment_delete->LoadRowValues($rs);

	// Render row
	$scholarship_payment_delete->RenderRow();
?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td<?php echo $scholarship_payment->status->CellAttributes() ?>>
<div<?php echo $scholarship_payment->status->ViewAttributes() ?>><?php echo $scholarship_payment->status->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_payment->year->CellAttributes() ?>>
<div<?php echo $scholarship_payment->year->ViewAttributes() ?>><?php echo $scholarship_payment->year->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_payment->scholarship_package_scholarship_package_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->scholarship_package_scholarship_package_id->ViewAttributes() ?>><?php echo $scholarship_payment->scholarship_package_scholarship_package_id->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_payment->programarea_residentarea_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->programarea_residentarea_id->ViewAttributes() ?>><?php echo $scholarship_payment->programarea_residentarea_id->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_payment->programarea_payingarea_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->programarea_payingarea_id->ViewAttributes() ?>><?php echo $scholarship_payment->programarea_payingarea_id->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_payment->refund_amount->CellAttributes() ?>>
<div<?php echo $scholarship_payment->refund_amount->ViewAttributes() ?>><?php echo $scholarship_payment->refund_amount->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_payment->payment_request_payment_request_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->payment_request_payment_request_id->ViewAttributes() ?>><?php echo $scholarship_payment->payment_request_payment_request_id->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_payment->bankname->CellAttributes() ?>>
<div<?php echo $scholarship_payment->bankname->ViewAttributes() ?>><?php echo $scholarship_payment->bankname->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_payment->account_no->CellAttributes() ?>>
<div<?php echo $scholarship_payment->account_no->ViewAttributes() ?>><?php echo $scholarship_payment->account_no->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_payment->schools_school_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->schools_school_id->ViewAttributes() ?>><?php echo $scholarship_payment->schools_school_id->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_payment->group_id->CellAttributes() ?>>
<div<?php echo $scholarship_payment->group_id->ViewAttributes() ?>><?php echo $scholarship_payment->group_id->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$scholarship_payment_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cscholarship_payment_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'scholarship_payment';

	// Page object name
	var $PageObjName = 'scholarship_payment_delete';

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
	function cscholarship_payment_delete() {
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
			define("EW_PAGE_ID", 'delete', TRUE);

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
		if (!$Security->CanDelete()) {
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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $scholarship_payment;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["scholarship_payment_id"] <> "") {
			$scholarship_payment->scholarship_payment_id->setQueryStringValue($_GET["scholarship_payment_id"]);
			if (!is_numeric($scholarship_payment->scholarship_payment_id->QueryStringValue))
				$this->Page_Terminate("scholarship_paymentlist.php"); // Prevent SQL injection, exit
			$sKey .= $scholarship_payment->scholarship_payment_id->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("scholarship_paymentlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("scholarship_paymentlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`scholarship_payment_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in scholarship_payment class, scholarship_paymentinfo.php

		$scholarship_payment->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$scholarship_payment->CurrentAction = $_POST["a_delete"];
		} else {
			$scholarship_payment->CurrentAction = "I"; // Display record
		}
		switch ($scholarship_payment->CurrentAction) {
			case "D": // Delete
				$scholarship_payment->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($scholarship_payment->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $scholarship_payment;
		$DeleteRows = TRUE;
		$sWrkFilter = $scholarship_payment->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in scholarship_payment class, scholarship_paymentinfo.php

		$scholarship_payment->CurrentFilter = $sWrkFilter;
		$sSql = $scholarship_payment->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();
		$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $scholarship_payment->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['scholarship_payment_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($scholarship_payment->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($scholarship_payment->CancelMessage <> "") {
				$this->setMessage($scholarship_payment->CancelMessage);
				$scholarship_payment->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
			if ($DeleteRows) {
				foreach ($rsold as $row)
					$this->WriteAuditTrailOnDelete($row);
			}
			$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
			$conn->RollbackTrans(); // Rollback changes
			$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteRollback")); // Batch delete rollback
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$scholarship_payment->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $scholarship_payment;

		// Call Recordset Selecting event
		$scholarship_payment->Recordset_Selecting($scholarship_payment->CurrentFilter);

		// Load List page SQL
		$sSql = $scholarship_payment->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$scholarship_payment->Recordset_Selected($rs);
		return $rs;
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
		// Call Row_Rendering event

		$scholarship_payment->Row_Rendering();

		// Common render codes for all row types
		// status

		$scholarship_payment->status->CellCssStyle = ""; $scholarship_payment->status->CellCssClass = "";
		$scholarship_payment->status->CellAttrs = array(); $scholarship_payment->status->ViewAttrs = array(); $scholarship_payment->status->EditAttrs = array();

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

			// status
			$scholarship_payment->status->HrefValue = "";
			$scholarship_payment->status->TooltipValue = "";

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

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'scholarship_payment';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $scholarship_payment;
		$table = 'scholarship_payment';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['scholarship_payment_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $scholarship_payment->fields) && $scholarship_payment->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($scholarship_payment->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					$oldvalue = "<MEMO>"; // Memo field
				} elseif ($scholarship_payment->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$oldvalue = "<XML>"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
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

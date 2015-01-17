<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "financial_yearinfo.php" ?>
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
$financial_year_delete = new cfinancial_year_delete();
$Page =& $financial_year_delete;

// Page init
$financial_year_delete->Page_Init();

// Page main
$financial_year_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var financial_year_delete = new ew_Page("financial_year_delete");

// page properties
financial_year_delete.PageID = "delete"; // page ID
financial_year_delete.FormID = "ffinancial_yeardelete"; // form ID
var EW_PAGE_ID = financial_year_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
financial_year_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
financial_year_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
financial_year_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $financial_year_delete->LoadRecordset())
	$financial_year_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($financial_year_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$financial_year_delete->Page_Terminate("financial_yearlist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $financial_year->TableCaption() ?><br><br>
<a href="<?php echo $financial_year->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$financial_year_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="financial_year">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($financial_year_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $financial_year->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $financial_year->financial_year_id->FldCaption() ?></td>
		<td valign="top"><?php echo $financial_year->year_name->FldCaption() ?></td>
		<td valign="top"><?php echo $financial_year->date_start->FldCaption() ?></td>
		<td valign="top"><?php echo $financial_year->date_end->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$financial_year_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$financial_year_delete->lRecCnt++;

	// Set row properties
	$financial_year->CssClass = "";
	$financial_year->CssStyle = "";
	$financial_year->RowAttrs = array();
	$financial_year->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$financial_year_delete->LoadRowValues($rs);

	// Render row
	$financial_year_delete->RenderRow();
?>
	<tr<?php echo $financial_year->RowAttributes() ?>>
		<td<?php echo $financial_year->financial_year_id->CellAttributes() ?>>
<div<?php echo $financial_year->financial_year_id->ViewAttributes() ?>><?php echo $financial_year->financial_year_id->ListViewValue() ?></div></td>
		<td<?php echo $financial_year->year_name->CellAttributes() ?>>
<div<?php echo $financial_year->year_name->ViewAttributes() ?>><?php echo $financial_year->year_name->ListViewValue() ?></div></td>
		<td<?php echo $financial_year->date_start->CellAttributes() ?>>
<div<?php echo $financial_year->date_start->ViewAttributes() ?>><?php echo $financial_year->date_start->ListViewValue() ?></div></td>
		<td<?php echo $financial_year->date_end->CellAttributes() ?>>
<div<?php echo $financial_year->date_end->ViewAttributes() ?>><?php echo $financial_year->date_end->ListViewValue() ?></div></td>
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
$financial_year_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cfinancial_year_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'financial_year';

	// Page object name
	var $PageObjName = 'financial_year_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $financial_year;
		if ($financial_year->UseTokenInUrl) $PageUrl .= "t=" . $financial_year->TableVar . "&"; // Add page token
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
		global $objForm, $financial_year;
		if ($financial_year->UseTokenInUrl) {
			if ($objForm)
				return ($financial_year->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($financial_year->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfinancial_year_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (financial_year)
		$GLOBALS["financial_year"] = new cfinancial_year();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'financial_year', TRUE);

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
		global $financial_year;

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
			$this->Page_Terminate("financial_yearlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

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
		global $Language, $financial_year;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["financial_year_id"] <> "") {
			$financial_year->financial_year_id->setQueryStringValue($_GET["financial_year_id"]);
			if (!is_numeric($financial_year->financial_year_id->QueryStringValue))
				$this->Page_Terminate("financial_yearlist.php"); // Prevent SQL injection, exit
			$sKey .= $financial_year->financial_year_id->QueryStringValue;
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
			$this->Page_Terminate("financial_yearlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("financial_yearlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`financial_year_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in financial_year class, financial_yearinfo.php

		$financial_year->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$financial_year->CurrentAction = $_POST["a_delete"];
		} else {
			$financial_year->CurrentAction = "I"; // Display record
		}
		switch ($financial_year->CurrentAction) {
			case "D": // Delete
				$financial_year->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($financial_year->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $financial_year;
		$DeleteRows = TRUE;
		$sWrkFilter = $financial_year->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in financial_year class, financial_yearinfo.php

		$financial_year->CurrentFilter = $sWrkFilter;
		$sSql = $financial_year->SQL();
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

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $financial_year->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['financial_year_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($financial_year->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($financial_year->CancelMessage <> "") {
				$this->setMessage($financial_year->CancelMessage);
				$financial_year->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$financial_year->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $financial_year;

		// Call Recordset Selecting event
		$financial_year->Recordset_Selecting($financial_year->CurrentFilter);

		// Load List page SQL
		$sSql = $financial_year->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$financial_year->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $financial_year;
		$sFilter = $financial_year->KeyFilter();

		// Call Row Selecting event
		$financial_year->Row_Selecting($sFilter);

		// Load SQL based on filter
		$financial_year->CurrentFilter = $sFilter;
		$sSql = $financial_year->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$financial_year->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $financial_year;
		$financial_year->financial_year_id->setDbValue($rs->fields('financial_year_id'));
		$financial_year->year_name->setDbValue($rs->fields('year_name'));
		$financial_year->date_start->setDbValue($rs->fields('date_start'));
		$financial_year->date_end->setDbValue($rs->fields('date_end'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $financial_year;

		// Initialize URLs
		// Call Row_Rendering event

		$financial_year->Row_Rendering();

		// Common render codes for all row types
		// financial_year_id

		$financial_year->financial_year_id->CellCssStyle = ""; $financial_year->financial_year_id->CellCssClass = "";
		$financial_year->financial_year_id->CellAttrs = array(); $financial_year->financial_year_id->ViewAttrs = array(); $financial_year->financial_year_id->EditAttrs = array();

		// year_name
		$financial_year->year_name->CellCssStyle = ""; $financial_year->year_name->CellCssClass = "";
		$financial_year->year_name->CellAttrs = array(); $financial_year->year_name->ViewAttrs = array(); $financial_year->year_name->EditAttrs = array();

		// date_start
		$financial_year->date_start->CellCssStyle = ""; $financial_year->date_start->CellCssClass = "";
		$financial_year->date_start->CellAttrs = array(); $financial_year->date_start->ViewAttrs = array(); $financial_year->date_start->EditAttrs = array();

		// date_end
		$financial_year->date_end->CellCssStyle = ""; $financial_year->date_end->CellCssClass = "";
		$financial_year->date_end->CellAttrs = array(); $financial_year->date_end->ViewAttrs = array(); $financial_year->date_end->EditAttrs = array();
		if ($financial_year->RowType == EW_ROWTYPE_VIEW) { // View row

			// financial_year_id
			$financial_year->financial_year_id->ViewValue = $financial_year->financial_year_id->CurrentValue;
			$financial_year->financial_year_id->CssStyle = "";
			$financial_year->financial_year_id->CssClass = "";
			$financial_year->financial_year_id->ViewCustomAttributes = "";

			// year_name
			$financial_year->year_name->ViewValue = $financial_year->year_name->CurrentValue;
			$financial_year->year_name->CssStyle = "";
			$financial_year->year_name->CssClass = "";
			$financial_year->year_name->ViewCustomAttributes = "";

			// date_start
			$financial_year->date_start->ViewValue = $financial_year->date_start->CurrentValue;
			$financial_year->date_start->ViewValue = ew_FormatDateTime($financial_year->date_start->ViewValue, 7);
			$financial_year->date_start->CssStyle = "";
			$financial_year->date_start->CssClass = "";
			$financial_year->date_start->ViewCustomAttributes = "";

			// date_end
			$financial_year->date_end->ViewValue = $financial_year->date_end->CurrentValue;
			$financial_year->date_end->ViewValue = ew_FormatDateTime($financial_year->date_end->ViewValue, 7);
			$financial_year->date_end->CssStyle = "";
			$financial_year->date_end->CssClass = "";
			$financial_year->date_end->ViewCustomAttributes = "";

			// financial_year_id
			$financial_year->financial_year_id->HrefValue = "";
			$financial_year->financial_year_id->TooltipValue = "";

			// year_name
			$financial_year->year_name->HrefValue = "";
			$financial_year->year_name->TooltipValue = "";

			// date_start
			$financial_year->date_start->HrefValue = "";
			$financial_year->date_start->TooltipValue = "";

			// date_end
			$financial_year->date_end->HrefValue = "";
			$financial_year->date_end->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($financial_year->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$financial_year->Row_Rendered();
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

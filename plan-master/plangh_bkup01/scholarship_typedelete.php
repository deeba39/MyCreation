<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "scholarship_typeinfo.php" ?>
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
$scholarship_type_delete = new cscholarship_type_delete();
$Page =& $scholarship_type_delete;

// Page init
$scholarship_type_delete->Page_Init();

// Page main
$scholarship_type_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var scholarship_type_delete = new ew_Page("scholarship_type_delete");

// page properties
scholarship_type_delete.PageID = "delete"; // page ID
scholarship_type_delete.FormID = "fscholarship_typedelete"; // form ID
var EW_PAGE_ID = scholarship_type_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
scholarship_type_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
scholarship_type_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
scholarship_type_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $scholarship_type_delete->LoadRecordset())
	$scholarship_type_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($scholarship_type_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$scholarship_type_delete->Page_Terminate("scholarship_typelist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $scholarship_type->TableCaption() ?><br><br>
<a href="<?php echo $scholarship_type->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$scholarship_type_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="scholarship_type">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($scholarship_type_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $scholarship_type->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $scholarship_type->scholarship_type_id->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_type->scholarship_type_name->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_type->scholarship_type_scale->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$scholarship_type_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$scholarship_type_delete->lRecCnt++;

	// Set row properties
	$scholarship_type->CssClass = "";
	$scholarship_type->CssStyle = "";
	$scholarship_type->RowAttrs = array();
	$scholarship_type->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$scholarship_type_delete->LoadRowValues($rs);

	// Render row
	$scholarship_type_delete->RenderRow();
?>
	<tr<?php echo $scholarship_type->RowAttributes() ?>>
		<td<?php echo $scholarship_type->scholarship_type_id->CellAttributes() ?>>
<div<?php echo $scholarship_type->scholarship_type_id->ViewAttributes() ?>><?php echo $scholarship_type->scholarship_type_id->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_type->scholarship_type_name->CellAttributes() ?>>
<div<?php echo $scholarship_type->scholarship_type_name->ViewAttributes() ?>><?php echo $scholarship_type->scholarship_type_name->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_type->scholarship_type_scale->CellAttributes() ?>>
<div<?php echo $scholarship_type->scholarship_type_scale->ViewAttributes() ?>><?php echo $scholarship_type->scholarship_type_scale->ListViewValue() ?></div></td>
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
$scholarship_type_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cscholarship_type_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'scholarship_type';

	// Page object name
	var $PageObjName = 'scholarship_type_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $scholarship_type;
		if ($scholarship_type->UseTokenInUrl) $PageUrl .= "t=" . $scholarship_type->TableVar . "&"; // Add page token
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
		global $objForm, $scholarship_type;
		if ($scholarship_type->UseTokenInUrl) {
			if ($objForm)
				return ($scholarship_type->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($scholarship_type->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cscholarship_type_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (scholarship_type)
		$GLOBALS["scholarship_type"] = new cscholarship_type();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'scholarship_type', TRUE);

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
		global $scholarship_type;

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
			$this->Page_Terminate("scholarship_typelist.php");
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
		global $Language, $scholarship_type;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["scholarship_type_id"] <> "") {
			$scholarship_type->scholarship_type_id->setQueryStringValue($_GET["scholarship_type_id"]);
			if (!is_numeric($scholarship_type->scholarship_type_id->QueryStringValue))
				$this->Page_Terminate("scholarship_typelist.php"); // Prevent SQL injection, exit
			$sKey .= $scholarship_type->scholarship_type_id->QueryStringValue;
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
			$this->Page_Terminate("scholarship_typelist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("scholarship_typelist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`scholarship_type_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in scholarship_type class, scholarship_typeinfo.php

		$scholarship_type->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$scholarship_type->CurrentAction = $_POST["a_delete"];
		} else {
			$scholarship_type->CurrentAction = "I"; // Display record
		}
		switch ($scholarship_type->CurrentAction) {
			case "D": // Delete
				$scholarship_type->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($scholarship_type->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $scholarship_type;
		$DeleteRows = TRUE;
		$sWrkFilter = $scholarship_type->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in scholarship_type class, scholarship_typeinfo.php

		$scholarship_type->CurrentFilter = $sWrkFilter;
		$sSql = $scholarship_type->SQL();
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
				$DeleteRows = $scholarship_type->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['scholarship_type_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($scholarship_type->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($scholarship_type->CancelMessage <> "") {
				$this->setMessage($scholarship_type->CancelMessage);
				$scholarship_type->CancelMessage = "";
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
				$scholarship_type->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $scholarship_type;

		// Call Recordset Selecting event
		$scholarship_type->Recordset_Selecting($scholarship_type->CurrentFilter);

		// Load List page SQL
		$sSql = $scholarship_type->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$scholarship_type->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $scholarship_type;
		$sFilter = $scholarship_type->KeyFilter();

		// Call Row Selecting event
		$scholarship_type->Row_Selecting($sFilter);

		// Load SQL based on filter
		$scholarship_type->CurrentFilter = $sFilter;
		$sSql = $scholarship_type->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$scholarship_type->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $scholarship_type;
		$scholarship_type->scholarship_type_id->setDbValue($rs->fields('scholarship_type_id'));
		$scholarship_type->scholarship_type_name->setDbValue($rs->fields('scholarship_type_name'));
		$scholarship_type->scholarship_type_scale->setDbValue($rs->fields('scholarship_type_scale'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $scholarship_type;

		// Initialize URLs
		// Call Row_Rendering event

		$scholarship_type->Row_Rendering();

		// Common render codes for all row types
		// scholarship_type_id

		$scholarship_type->scholarship_type_id->CellCssStyle = ""; $scholarship_type->scholarship_type_id->CellCssClass = "";
		$scholarship_type->scholarship_type_id->CellAttrs = array(); $scholarship_type->scholarship_type_id->ViewAttrs = array(); $scholarship_type->scholarship_type_id->EditAttrs = array();

		// scholarship_type_name
		$scholarship_type->scholarship_type_name->CellCssStyle = ""; $scholarship_type->scholarship_type_name->CellCssClass = "";
		$scholarship_type->scholarship_type_name->CellAttrs = array(); $scholarship_type->scholarship_type_name->ViewAttrs = array(); $scholarship_type->scholarship_type_name->EditAttrs = array();

		// scholarship_type_scale
		$scholarship_type->scholarship_type_scale->CellCssStyle = ""; $scholarship_type->scholarship_type_scale->CellCssClass = "";
		$scholarship_type->scholarship_type_scale->CellAttrs = array(); $scholarship_type->scholarship_type_scale->ViewAttrs = array(); $scholarship_type->scholarship_type_scale->EditAttrs = array();
		if ($scholarship_type->RowType == EW_ROWTYPE_VIEW) { // View row

			// scholarship_type_id
			$scholarship_type->scholarship_type_id->ViewValue = $scholarship_type->scholarship_type_id->CurrentValue;
			$scholarship_type->scholarship_type_id->CssStyle = "";
			$scholarship_type->scholarship_type_id->CssClass = "";
			$scholarship_type->scholarship_type_id->ViewCustomAttributes = "";

			// scholarship_type_name
			$scholarship_type->scholarship_type_name->ViewValue = $scholarship_type->scholarship_type_name->CurrentValue;
			$scholarship_type->scholarship_type_name->CssStyle = "";
			$scholarship_type->scholarship_type_name->CssClass = "";
			$scholarship_type->scholarship_type_name->ViewCustomAttributes = "";

			// scholarship_type_scale
			$scholarship_type->scholarship_type_scale->ViewValue = $scholarship_type->scholarship_type_scale->CurrentValue;
			$scholarship_type->scholarship_type_scale->CssStyle = "";
			$scholarship_type->scholarship_type_scale->CssClass = "";
			$scholarship_type->scholarship_type_scale->ViewCustomAttributes = "";

			// scholarship_type_id
			$scholarship_type->scholarship_type_id->HrefValue = "";
			$scholarship_type->scholarship_type_id->TooltipValue = "";

			// scholarship_type_name
			$scholarship_type->scholarship_type_name->HrefValue = "";
			$scholarship_type->scholarship_type_name->TooltipValue = "";

			// scholarship_type_scale
			$scholarship_type->scholarship_type_scale->HrefValue = "";
			$scholarship_type->scholarship_type_scale->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($scholarship_type->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$scholarship_type->Row_Rendered();
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

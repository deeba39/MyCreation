<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "grade_subjectinfo.php" ?>
<?php include "sponsored_studentinfo.php" ?>
<?php include "grade_yearinfo.php" ?>
<?php include "school_attendanceinfo.php" ?>
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
$grade_subject_delete = new cgrade_subject_delete();
$Page =& $grade_subject_delete;

// Page init
$grade_subject_delete->Page_Init();

// Page main
$grade_subject_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var grade_subject_delete = new ew_Page("grade_subject_delete");

// page properties
grade_subject_delete.PageID = "delete"; // page ID
grade_subject_delete.FormID = "fgrade_subjectdelete"; // form ID
var EW_PAGE_ID = grade_subject_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
grade_subject_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grade_subject_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grade_subject_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $grade_subject_delete->LoadRecordset())
	$grade_subject_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($grade_subject_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$grade_subject_delete->Page_Terminate("grade_subjectlist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grade_subject->TableCaption() ?><br><br>
<a href="<?php echo $grade_subject->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$grade_subject_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="grade_subject">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($grade_subject_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $grade_subject->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $grade_subject->subject->FldCaption() ?></td>
		<td valign="top"><?php echo $grade_subject->raw_score->FldCaption() ?></td>
		<td valign="top"><?php echo $grade_subject->letter_score->FldCaption() ?></td>
		<td valign="top"><?php echo $grade_subject->letter_description->FldCaption() ?></td>
		<td valign="top"><?php echo $grade_subject->grade_year_grade_year_id->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$grade_subject_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$grade_subject_delete->lRecCnt++;

	// Set row properties
	$grade_subject->CssClass = "";
	$grade_subject->CssStyle = "";
	$grade_subject->RowAttrs = array();
	$grade_subject->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$grade_subject_delete->LoadRowValues($rs);

	// Render row
	$grade_subject_delete->RenderRow();
?>
	<tr<?php echo $grade_subject->RowAttributes() ?>>
		<td<?php echo $grade_subject->subject->CellAttributes() ?>>
<div<?php echo $grade_subject->subject->ViewAttributes() ?>><?php echo $grade_subject->subject->ListViewValue() ?></div></td>
		<td<?php echo $grade_subject->raw_score->CellAttributes() ?>>
<div<?php echo $grade_subject->raw_score->ViewAttributes() ?>><?php echo $grade_subject->raw_score->ListViewValue() ?></div></td>
		<td<?php echo $grade_subject->letter_score->CellAttributes() ?>>
<div<?php echo $grade_subject->letter_score->ViewAttributes() ?>><?php echo $grade_subject->letter_score->ListViewValue() ?></div></td>
		<td<?php echo $grade_subject->letter_description->CellAttributes() ?>>
<div<?php echo $grade_subject->letter_description->ViewAttributes() ?>><?php echo $grade_subject->letter_description->ListViewValue() ?></div></td>
		<td<?php echo $grade_subject->grade_year_grade_year_id->CellAttributes() ?>>
<div<?php echo $grade_subject->grade_year_grade_year_id->ViewAttributes() ?>><?php echo $grade_subject->grade_year_grade_year_id->ListViewValue() ?></div></td>
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
$grade_subject_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrade_subject_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'grade_subject';

	// Page object name
	var $PageObjName = 'grade_subject_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $grade_subject;
		if ($grade_subject->UseTokenInUrl) $PageUrl .= "t=" . $grade_subject->TableVar . "&"; // Add page token
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
		global $objForm, $grade_subject;
		if ($grade_subject->UseTokenInUrl) {
			if ($objForm)
				return ($grade_subject->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($grade_subject->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgrade_subject_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (grade_subject)
		$GLOBALS["grade_subject"] = new cgrade_subject();

		// Table object (sponsored_student)
		$GLOBALS['sponsored_student'] = new csponsored_student();

		// Table object (grade_year)
		$GLOBALS['grade_year'] = new cgrade_year();

		// Table object (school_attendance)
		$GLOBALS['school_attendance'] = new cschool_attendance();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grade_subject', TRUE);

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
		global $grade_subject;

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
			$this->Page_Terminate("grade_subjectlist.php");
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
		global $Language, $grade_subject;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["grade_subject_id"] <> "") {
			$grade_subject->grade_subject_id->setQueryStringValue($_GET["grade_subject_id"]);
			if (!is_numeric($grade_subject->grade_subject_id->QueryStringValue))
				$this->Page_Terminate("grade_subjectlist.php"); // Prevent SQL injection, exit
			$sKey .= $grade_subject->grade_subject_id->QueryStringValue;
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
			$this->Page_Terminate("grade_subjectlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("grade_subjectlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`grade_subject_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in grade_subject class, grade_subjectinfo.php

		$grade_subject->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$grade_subject->CurrentAction = $_POST["a_delete"];
		} else {
			$grade_subject->CurrentAction = "I"; // Display record
		}
		switch ($grade_subject->CurrentAction) {
			case "D": // Delete
				$grade_subject->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($grade_subject->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $grade_subject;
		$DeleteRows = TRUE;
		$sWrkFilter = $grade_subject->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in grade_subject class, grade_subjectinfo.php

		$grade_subject->CurrentFilter = $sWrkFilter;
		$sSql = $grade_subject->SQL();
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
				$DeleteRows = $grade_subject->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['grade_subject_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($grade_subject->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($grade_subject->CancelMessage <> "") {
				$this->setMessage($grade_subject->CancelMessage);
				$grade_subject->CancelMessage = "";
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
				$grade_subject->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $grade_subject;

		// Call Recordset Selecting event
		$grade_subject->Recordset_Selecting($grade_subject->CurrentFilter);

		// Load List page SQL
		$sSql = $grade_subject->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$grade_subject->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $grade_subject;
		$sFilter = $grade_subject->KeyFilter();

		// Call Row Selecting event
		$grade_subject->Row_Selecting($sFilter);

		// Load SQL based on filter
		$grade_subject->CurrentFilter = $sFilter;
		$sSql = $grade_subject->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$grade_subject->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $grade_subject;
		$grade_subject->grade_subject_id->setDbValue($rs->fields('grade_subject_id'));
		$grade_subject->subject->setDbValue($rs->fields('subject'));
		$grade_subject->raw_score->setDbValue($rs->fields('raw_score'));
		$grade_subject->letter_score->setDbValue($rs->fields('letter_score'));
		$grade_subject->letter_description->setDbValue($rs->fields('letter_description'));
		$grade_subject->grade_year_grade_year_id->setDbValue($rs->fields('grade_year_grade_year_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grade_subject;

		// Initialize URLs
		// Call Row_Rendering event

		$grade_subject->Row_Rendering();

		// Common render codes for all row types
		// subject

		$grade_subject->subject->CellCssStyle = ""; $grade_subject->subject->CellCssClass = "";
		$grade_subject->subject->CellAttrs = array(); $grade_subject->subject->ViewAttrs = array(); $grade_subject->subject->EditAttrs = array();

		// raw_score
		$grade_subject->raw_score->CellCssStyle = ""; $grade_subject->raw_score->CellCssClass = "";
		$grade_subject->raw_score->CellAttrs = array(); $grade_subject->raw_score->ViewAttrs = array(); $grade_subject->raw_score->EditAttrs = array();

		// letter_score
		$grade_subject->letter_score->CellCssStyle = ""; $grade_subject->letter_score->CellCssClass = "";
		$grade_subject->letter_score->CellAttrs = array(); $grade_subject->letter_score->ViewAttrs = array(); $grade_subject->letter_score->EditAttrs = array();

		// letter_description
		$grade_subject->letter_description->CellCssStyle = ""; $grade_subject->letter_description->CellCssClass = "";
		$grade_subject->letter_description->CellAttrs = array(); $grade_subject->letter_description->ViewAttrs = array(); $grade_subject->letter_description->EditAttrs = array();

		// grade_year_grade_year_id
		$grade_subject->grade_year_grade_year_id->CellCssStyle = ""; $grade_subject->grade_year_grade_year_id->CellCssClass = "";
		$grade_subject->grade_year_grade_year_id->CellAttrs = array(); $grade_subject->grade_year_grade_year_id->ViewAttrs = array(); $grade_subject->grade_year_grade_year_id->EditAttrs = array();
		if ($grade_subject->RowType == EW_ROWTYPE_VIEW) { // View row

			// grade_subject_id
			$grade_subject->grade_subject_id->ViewValue = $grade_subject->grade_subject_id->CurrentValue;
			$grade_subject->grade_subject_id->CssStyle = "";
			$grade_subject->grade_subject_id->CssClass = "";
			$grade_subject->grade_subject_id->ViewCustomAttributes = "";

			// subject
			$grade_subject->subject->ViewValue = $grade_subject->subject->CurrentValue;
			$grade_subject->subject->CssStyle = "";
			$grade_subject->subject->CssClass = "";
			$grade_subject->subject->ViewCustomAttributes = "";

			// raw_score
			$grade_subject->raw_score->ViewValue = $grade_subject->raw_score->CurrentValue;
			$grade_subject->raw_score->CssStyle = "";
			$grade_subject->raw_score->CssClass = "";
			$grade_subject->raw_score->ViewCustomAttributes = "";

			// letter_score
			$grade_subject->letter_score->ViewValue = $grade_subject->letter_score->CurrentValue;
			$grade_subject->letter_score->CssStyle = "";
			$grade_subject->letter_score->CssClass = "";
			$grade_subject->letter_score->ViewCustomAttributes = "";

			// letter_description
			$grade_subject->letter_description->ViewValue = $grade_subject->letter_description->CurrentValue;
			$grade_subject->letter_description->CssStyle = "";
			$grade_subject->letter_description->CssClass = "";
			$grade_subject->letter_description->ViewCustomAttributes = "";

			// grade_year_grade_year_id
			if (strval($grade_subject->grade_year_grade_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`grade_year_id` = " . ew_AdjustSql($grade_subject->grade_year_grade_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year` FROM `grade_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grade_subject->grade_year_grade_year_id->ViewValue = $rswrk->fields('year');
					$rswrk->Close();
				} else {
					$grade_subject->grade_year_grade_year_id->ViewValue = $grade_subject->grade_year_grade_year_id->CurrentValue;
				}
			} else {
				$grade_subject->grade_year_grade_year_id->ViewValue = NULL;
			}
			$grade_subject->grade_year_grade_year_id->CssStyle = "";
			$grade_subject->grade_year_grade_year_id->CssClass = "";
			$grade_subject->grade_year_grade_year_id->ViewCustomAttributes = "";

			// subject
			$grade_subject->subject->HrefValue = "";
			$grade_subject->subject->TooltipValue = "";

			// raw_score
			$grade_subject->raw_score->HrefValue = "";
			$grade_subject->raw_score->TooltipValue = "";

			// letter_score
			$grade_subject->letter_score->HrefValue = "";
			$grade_subject->letter_score->TooltipValue = "";

			// letter_description
			$grade_subject->letter_description->HrefValue = "";
			$grade_subject->letter_description->TooltipValue = "";

			// grade_year_grade_year_id
			$grade_subject->grade_year_grade_year_id->HrefValue = "";
			$grade_subject->grade_year_grade_year_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($grade_subject->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grade_subject->Row_Rendered();
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

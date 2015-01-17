<?php

// Global variable for table object
$schools = NULL;

//
// Table class for schools
//
class cschools {
	var $TableVar = 'schools';
	var $TableName = 'schools';
	var $TableType = 'TABLE';
	var $school_id;
	var $school_name;
	var $address;
	var $towncity;
	var $school_type;
	var $contact_person_name;
	var $telephone;
	var $bankname;
	var $account_no;
	var $programarea_programarea_id;
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
	var $CurrentAction; // Current action
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message

	//
	// Table class constructor
	//
	function cschools() {
		global $Language;

		// school_id
		$this->school_id = new cField('schools', 'schools', 'x_school_id', 'school_id', '`school_id`', 3, -1, FALSE, '`school_id`', FALSE);
		$this->school_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['school_id'] =& $this->school_id;

		// school_name
		$this->school_name = new cField('schools', 'schools', 'x_school_name', 'school_name', '`school_name`', 200, -1, FALSE, '`school_name`', FALSE);
		$this->fields['school_name'] =& $this->school_name;

		// address
		$this->address = new cField('schools', 'schools', 'x_address', 'address', '`address`', 200, -1, FALSE, '`address`', FALSE);
		$this->fields['address'] =& $this->address;

		// towncity
		$this->towncity = new cField('schools', 'schools', 'x_towncity', 'towncity', '`towncity`', 200, -1, FALSE, '`towncity`', FALSE);
		$this->fields['towncity'] =& $this->towncity;

		// school_type
		$this->school_type = new cField('schools', 'schools', 'x_school_type', 'school_type', '`school_type`', 200, -1, FALSE, '`school_type`', FALSE);
		$this->fields['school_type'] =& $this->school_type;

		// contact_person_name
		$this->contact_person_name = new cField('schools', 'schools', 'x_contact_person_name', 'contact_person_name', '`contact_person_name`', 200, -1, FALSE, '`contact_person_name`', FALSE);
		$this->fields['contact_person_name'] =& $this->contact_person_name;

		// telephone
		$this->telephone = new cField('schools', 'schools', 'x_telephone', 'telephone', '`telephone`', 200, -1, FALSE, '`telephone`', FALSE);
		$this->fields['telephone'] =& $this->telephone;

		// bankname
		$this->bankname = new cField('schools', 'schools', 'x_bankname', 'bankname', '`bankname`', 200, -1, FALSE, '`bankname`', FALSE);
		$this->fields['bankname'] =& $this->bankname;

		// account_no
		$this->account_no = new cField('schools', 'schools', 'x_account_no', 'account_no', '`account_no`', 200, -1, FALSE, '`account_no`', FALSE);
		$this->fields['account_no'] =& $this->account_no;

		// programarea_programarea_id
		$this->programarea_programarea_id = new cField('schools', 'schools', 'x_programarea_programarea_id', 'programarea_programarea_id', '`programarea_programarea_id`', 3, -1, FALSE, '`programarea_programarea_id`', FALSE);
		$this->programarea_programarea_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['programarea_programarea_id'] =& $this->programarea_programarea_id;
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

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "schools_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	function getMasterFilter() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_FILTER];
	}

	function setMasterFilter($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_FILTER] = $v;
	}

	// Session detail WHERE clause
	function getDetailFilter() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_FILTER];
	}

	function setDetailFilter($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_FILTER] = $v;
	}

	// Master filter
	function SqlMasterFilter_programarea() {
		return "`programarea_id`=@programarea_id@";
	}

	// Detail filter
	function SqlDetailFilter_programarea() {
		return "`programarea_programarea_id`=@programarea_programarea_id@";
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`schools`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		if ($this->TableFilter <> "") {
			if ($sWhere <> "") $sWhere = "(" . $sWhere . ") AND (";
			$sWhere .= "(" . $this->TableFilter . ")";
		}
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
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

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter = "(" . $sFilter . ") AND ";
			$sFilter .= "(" . $this->CurrentFilter . ")";
		}
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `schools` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `schools` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `schools` WHERE ";
		$SQL .= ew_QuotedName('school_id') . '=' . ew_QuotedValue($rs['school_id'], $this->school_id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`school_id` = @school_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->school_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@school_id@", ew_AdjustSql($this->school_id->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
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
			return "schoolslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "schoolslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("schoolsview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "schoolsadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("schoolsedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("schoolsadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("schoolsdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->school_id->CurrentValue)) {
			$sUrl .= "school_id=" . urlencode($this->school_id->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase(\"InvalidRecord\"));";
		}
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=schools" : "";
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
		$this->school_id->setDbValue($rs->fields('school_id'));
		$this->school_name->setDbValue($rs->fields('school_name'));
		$this->address->setDbValue($rs->fields('address'));
		$this->towncity->setDbValue($rs->fields('towncity'));
		$this->school_type->setDbValue($rs->fields('school_type'));
		$this->contact_person_name->setDbValue($rs->fields('contact_person_name'));
		$this->telephone->setDbValue($rs->fields('telephone'));
		$this->bankname->setDbValue($rs->fields('bankname'));
		$this->account_no->setDbValue($rs->fields('account_no'));
		$this->programarea_programarea_id->setDbValue($rs->fields('programarea_programarea_id'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// school_id

		$this->school_id->CellCssStyle = ""; $this->school_id->CellCssClass = "";
		$this->school_id->CellAttrs = array(); $this->school_id->ViewAttrs = array(); $this->school_id->EditAttrs = array();

		// school_name
		$this->school_name->CellCssStyle = ""; $this->school_name->CellCssClass = "";
		$this->school_name->CellAttrs = array(); $this->school_name->ViewAttrs = array(); $this->school_name->EditAttrs = array();

		// address
		$this->address->CellCssStyle = ""; $this->address->CellCssClass = "";
		$this->address->CellAttrs = array(); $this->address->ViewAttrs = array(); $this->address->EditAttrs = array();

		// towncity
		$this->towncity->CellCssStyle = ""; $this->towncity->CellCssClass = "";
		$this->towncity->CellAttrs = array(); $this->towncity->ViewAttrs = array(); $this->towncity->EditAttrs = array();

		// school_type
		$this->school_type->CellCssStyle = ""; $this->school_type->CellCssClass = "";
		$this->school_type->CellAttrs = array(); $this->school_type->ViewAttrs = array(); $this->school_type->EditAttrs = array();

		// contact_person_name
		$this->contact_person_name->CellCssStyle = ""; $this->contact_person_name->CellCssClass = "";
		$this->contact_person_name->CellAttrs = array(); $this->contact_person_name->ViewAttrs = array(); $this->contact_person_name->EditAttrs = array();

		// telephone
		$this->telephone->CellCssStyle = ""; $this->telephone->CellCssClass = "";
		$this->telephone->CellAttrs = array(); $this->telephone->ViewAttrs = array(); $this->telephone->EditAttrs = array();

		// bankname
		$this->bankname->CellCssStyle = ""; $this->bankname->CellCssClass = "";
		$this->bankname->CellAttrs = array(); $this->bankname->ViewAttrs = array(); $this->bankname->EditAttrs = array();

		// account_no
		$this->account_no->CellCssStyle = ""; $this->account_no->CellCssClass = "";
		$this->account_no->CellAttrs = array(); $this->account_no->ViewAttrs = array(); $this->account_no->EditAttrs = array();

		// programarea_programarea_id
		$this->programarea_programarea_id->CellCssStyle = ""; $this->programarea_programarea_id->CellCssClass = "";
		$this->programarea_programarea_id->CellAttrs = array(); $this->programarea_programarea_id->ViewAttrs = array(); $this->programarea_programarea_id->EditAttrs = array();

		// school_id
		$this->school_id->ViewValue = $this->school_id->CurrentValue;
		$this->school_id->CssStyle = "";
		$this->school_id->CssClass = "";
		$this->school_id->ViewCustomAttributes = "";

		// school_name
		$this->school_name->ViewValue = $this->school_name->CurrentValue;
		$this->school_name->CssStyle = "";
		$this->school_name->CssClass = "";
		$this->school_name->ViewCustomAttributes = "";

		// address
		$this->address->ViewValue = $this->address->CurrentValue;
		$this->address->CssStyle = "";
		$this->address->CssClass = "";
		$this->address->ViewCustomAttributes = "";

		// towncity
		$this->towncity->ViewValue = $this->towncity->CurrentValue;
		$this->towncity->CssStyle = "";
		$this->towncity->CssClass = "";
		$this->towncity->ViewCustomAttributes = "";

		// school_type
		if (strval($this->school_type->CurrentValue) <> "") {
			$sFilterWrk = "`school_type` = '" . ew_AdjustSql($this->school_type->CurrentValue) . "'";
		$sSqlWrk = "SELECT `school_type` FROM `school_type`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->school_type->ViewValue = $rswrk->fields('school_type');
				$rswrk->Close();
			} else {
				$this->school_type->ViewValue = $this->school_type->CurrentValue;
			}
		} else {
			$this->school_type->ViewValue = NULL;
		}
		$this->school_type->CssStyle = "";
		$this->school_type->CssClass = "";
		$this->school_type->ViewCustomAttributes = "";

		// contact_person_name
		$this->contact_person_name->ViewValue = $this->contact_person_name->CurrentValue;
		$this->contact_person_name->CssStyle = "";
		$this->contact_person_name->CssClass = "";
		$this->contact_person_name->ViewCustomAttributes = "";

		// telephone
		$this->telephone->ViewValue = $this->telephone->CurrentValue;
		$this->telephone->CssStyle = "";
		$this->telephone->CssClass = "";
		$this->telephone->ViewCustomAttributes = "";

		// bankname
		$this->bankname->ViewValue = $this->bankname->CurrentValue;
		$this->bankname->CssStyle = "";
		$this->bankname->CssClass = "";
		$this->bankname->ViewCustomAttributes = "";

		// account_no
		$this->account_no->ViewValue = $this->account_no->CurrentValue;
		$this->account_no->CssStyle = "";
		$this->account_no->CssClass = "";
		$this->account_no->ViewCustomAttributes = "";

		// programarea_programarea_id
		if (strval($this->programarea_programarea_id->CurrentValue) <> "") {
			$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($this->programarea_programarea_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->programarea_programarea_id->ViewValue = $rswrk->fields('programarea_name');
				$rswrk->Close();
			} else {
				$this->programarea_programarea_id->ViewValue = $this->programarea_programarea_id->CurrentValue;
			}
		} else {
			$this->programarea_programarea_id->ViewValue = NULL;
		}
		$this->programarea_programarea_id->CssStyle = "";
		$this->programarea_programarea_id->CssClass = "";
		$this->programarea_programarea_id->ViewCustomAttributes = "";

		// school_id
		$this->school_id->HrefValue = "";
		$this->school_id->TooltipValue = "";

		// school_name
		$this->school_name->HrefValue = "";
		$this->school_name->TooltipValue = "";

		// address
		$this->address->HrefValue = "";
		$this->address->TooltipValue = "";

		// towncity
		$this->towncity->HrefValue = "";
		$this->towncity->TooltipValue = "";

		// school_type
		$this->school_type->HrefValue = "";
		$this->school_type->TooltipValue = "";

		// contact_person_name
		$this->contact_person_name->HrefValue = "";
		$this->contact_person_name->TooltipValue = "";

		// telephone
		$this->telephone->HrefValue = "";
		$this->telephone->TooltipValue = "";

		// bankname
		$this->bankname->HrefValue = "";
		$this->bankname->TooltipValue = "";

		// account_no
		$this->account_no->HrefValue = "";
		$this->account_no->TooltipValue = "";

		// programarea_programarea_id
		$this->programarea_programarea_id->HrefValue = "";
		$this->programarea_programarea_id->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
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

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Row Inserting event
	function Row_Inserting(&$rs) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict(&$rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

		// Row Deleting event
function Row_Deleting(&$rs) {
    // Enter your code here
    // To cancel, set return value to False 
   
                include_once("ext/school.php");
                $s=new school();
                $n=$s->can_delete_school($rs['school_id']);
                if($n==0){
                    return true;
                }
                if($n<0){
                    $this->CancelMessage="Deleting canceled. Error occured while verifing if school can be deleted. {$s->str_error}";
                    return false;
                }

        $this->CancelMessage="School cannot be  deleted because there are $n school attendace record that refer to this school. These records and all other record that refer to this school have to be deleted before the school record can be reomoved";
                return false;
    
}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>

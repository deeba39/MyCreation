<?php

// Global variable for table object
$sponsored_student_detail = NULL;

//
// Table class for sponsored_student_detail
//
class csponsored_student_detail {
	var $TableVar = 'sponsored_student_detail';
	var $TableName = 'sponsored_student_detail';
	var $TableType = 'CUSTOMVIEW';
	var $sponsored_student_id;
	var $student_firstname;
	var $student_middlename;
	var $student_lastname;
	var $student_telephone_1;
	var $student_telephone_2;
	var $student_dob;
	var $age;
	var $student_gender;
	var $student_address;
	var $app_submission_year;
	var $community;
	var $community_community_id;
	var $programarea_name;
	var $student_resident_programarea_id;
	var $District;
	var $community_districts_DistrictID;
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
	function csponsored_student_detail() {
		global $Language;

		// sponsored_student_id
		$this->sponsored_student_id = new cField('sponsored_student_detail', 'sponsored_student_detail', 'x_sponsored_student_id', 'sponsored_student_id', 'sponsored_student.sponsored_student_id', 3, -1, FALSE, 'sponsored_student.sponsored_student_id', FALSE);
		$this->sponsored_student_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['sponsored_student_id'] =& $this->sponsored_student_id;

		// student_firstname
		$this->student_firstname = new cField('sponsored_student_detail', 'sponsored_student_detail', 'x_student_firstname', 'student_firstname', 'sponsored_student.student_firstname', 200, -1, FALSE, 'sponsored_student.student_firstname', FALSE);
		$this->fields['student_firstname'] =& $this->student_firstname;

		// student_middlename
		$this->student_middlename = new cField('sponsored_student_detail', 'sponsored_student_detail', 'x_student_middlename', 'student_middlename', 'sponsored_student.student_middlename', 200, -1, FALSE, 'sponsored_student.student_middlename', FALSE);
		$this->fields['student_middlename'] =& $this->student_middlename;

		// student_lastname
		$this->student_lastname = new cField('sponsored_student_detail', 'sponsored_student_detail', 'x_student_lastname', 'student_lastname', 'sponsored_student.student_lastname', 200, -1, FALSE, 'sponsored_student.student_lastname', FALSE);
		$this->fields['student_lastname'] =& $this->student_lastname;

		// student_telephone_1
		$this->student_telephone_1 = new cField('sponsored_student_detail', 'sponsored_student_detail', 'x_student_telephone_1', 'student_telephone_1', 'student_applicant.student_telephone_1', 200, -1, FALSE, 'student_applicant.student_telephone_1', FALSE);
		$this->fields['student_telephone_1'] =& $this->student_telephone_1;

		// student_telephone_2
		$this->student_telephone_2 = new cField('sponsored_student_detail', 'sponsored_student_detail', 'x_student_telephone_2', 'student_telephone_2', 'student_applicant.student_telephone_2', 200, -1, FALSE, 'student_applicant.student_telephone_2', FALSE);
		$this->fields['student_telephone_2'] =& $this->student_telephone_2;

		// student_dob
		$this->student_dob = new cField('sponsored_student_detail', 'sponsored_student_detail', 'x_student_dob', 'student_dob', 'student_applicant.student_dob', 135, 7, FALSE, 'student_applicant.student_dob', FALSE);
		$this->student_dob->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['student_dob'] =& $this->student_dob;

		// age
		$this->age = new cField('sponsored_student_detail', 'sponsored_student_detail', 'x_age', 'age', '(Year(CurDate()) - Year(student_applicant.student_dob))', 20, -1, FALSE, '(Year(CurDate()) - Year(student_applicant.student_dob))', FALSE);
		$this->age->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['age'] =& $this->age;

		// student_gender
		$this->student_gender = new cField('sponsored_student_detail', 'sponsored_student_detail', 'x_student_gender', 'student_gender', 'student_applicant.student_gender', 200, -1, FALSE, 'student_applicant.student_gender', FALSE);
		$this->fields['student_gender'] =& $this->student_gender;

		// student_address
		$this->student_address = new cField('sponsored_student_detail', 'sponsored_student_detail', 'x_student_address', 'student_address', 'student_applicant.student_address', 200, -1, FALSE, 'student_applicant.student_address', FALSE);
		$this->fields['student_address'] =& $this->student_address;

		// app_submission_year
		$this->app_submission_year = new cField('sponsored_student_detail', 'sponsored_student_detail', 'x_app_submission_year', 'app_submission_year', 'student_applicant.app_submission_year', 3, -1, FALSE, 'student_applicant.app_submission_year', FALSE);
		$this->app_submission_year->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_submission_year'] =& $this->app_submission_year;

		// community
		$this->community = new cField('sponsored_student_detail', 'sponsored_student_detail', 'x_community', 'community', 'community.community', 200, -1, FALSE, 'community.community', FALSE);
		$this->fields['community'] =& $this->community;

		// community_community_id
		$this->community_community_id = new cField('sponsored_student_detail', 'sponsored_student_detail', 'x_community_community_id', 'community_community_id', 'sponsored_student.community_community_id', 3, -1, FALSE, 'sponsored_student.community_community_id', FALSE);
		$this->community_community_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['community_community_id'] =& $this->community_community_id;

		// programarea_name
		$this->programarea_name = new cField('sponsored_student_detail', 'sponsored_student_detail', 'x_programarea_name', 'programarea_name', 'programarea.programarea_name', 200, -1, FALSE, 'programarea.programarea_name', FALSE);
		$this->fields['programarea_name'] =& $this->programarea_name;

		// student_resident_programarea_id
		$this->student_resident_programarea_id = new cField('sponsored_student_detail', 'sponsored_student_detail', 'x_student_resident_programarea_id', 'student_resident_programarea_id', 'sponsored_student.student_resident_programarea_id', 3, -1, FALSE, 'sponsored_student.student_resident_programarea_id', FALSE);
		$this->student_resident_programarea_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['student_resident_programarea_id'] =& $this->student_resident_programarea_id;

		// District
		$this->District = new cField('sponsored_student_detail', 'sponsored_student_detail', 'x_District', 'District', 'districts.District', 200, -1, FALSE, 'districts.District', FALSE);
		$this->fields['District'] =& $this->District;

		// community_districts_DistrictID
		$this->community_districts_DistrictID = new cField('sponsored_student_detail', 'sponsored_student_detail', 'x_community_districts_DistrictID', 'community_districts_DistrictID', 'community.community_districts_DistrictID', 19, -1, FALSE, 'community.community_districts_DistrictID', FALSE);
		$this->community_districts_DistrictID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['community_districts_DistrictID'] =& $this->community_districts_DistrictID;
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
		return "sponsored_student_detail_Highlight";
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
		return "sponsored_student.student_resident_programarea_id=@student_resident_programarea_id@";
	}

	// Master filter
	function SqlMasterFilter_community() {
		return "`community_id`=@community_id@";
	}

	// Detail filter
	function SqlDetailFilter_community() {
		return "sponsored_student.community_community_id=@community_community_id@";
	}

	// Table level SQL
	function SqlFrom() { // From
		return "sponsored_student Left Join student_applicant On sponsored_student.student_applicant_student_applicant_id = student_applicant.student_applicant_id Left Join community On sponsored_student.community_community_id = community.community_id Left Join programarea On sponsored_student.student_resident_programarea_id = programarea.programarea_id Left Join districts On community.community_districts_DistrictID = districts.DistrictID";
	}

	function SqlSelect() { // Select
		return "SELECT sponsored_student.student_firstname, sponsored_student.student_middlename, sponsored_student.student_lastname, sponsored_student.student_resident_programarea_id, student_applicant.student_telephone_1, student_applicant.student_telephone_2, (Year(CurDate()) - Year(student_applicant.student_dob)) As age, student_applicant.student_dob, student_applicant.app_submission_year, student_applicant.student_gender, student_applicant.student_address, sponsored_student.sponsored_student_id, community.community, sponsored_student.community_community_id, programarea.programarea_name, districts.District, community.community_districts_DistrictID FROM " . $this->SqlFrom();
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
		return "INSERT INTO sponsored_student Left Join student_applicant On sponsored_student.student_applicant_student_applicant_id = student_applicant.student_applicant_id Left Join community On sponsored_student.community_community_id = community.community_id Left Join programarea On sponsored_student.student_resident_programarea_id = programarea.programarea_id Left Join districts On community.community_districts_DistrictID = districts.DistrictID ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE sponsored_student Left Join student_applicant On sponsored_student.student_applicant_student_applicant_id = student_applicant.student_applicant_id Left Join community On sponsored_student.community_community_id = community.community_id Left Join programarea On sponsored_student.student_resident_programarea_id = programarea.programarea_id Left Join districts On community.community_districts_DistrictID = districts.DistrictID SET ";
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
		$SQL = "DELETE FROM sponsored_student Left Join student_applicant On sponsored_student.student_applicant_student_applicant_id = student_applicant.student_applicant_id Left Join community On sponsored_student.community_community_id = community.community_id Left Join programarea On sponsored_student.student_resident_programarea_id = programarea.programarea_id Left Join districts On community.community_districts_DistrictID = districts.DistrictID WHERE ";
		$SQL .= ew_QuotedName('sponsored_student_id') . '=' . ew_QuotedValue($rs['sponsored_student_id'], $this->sponsored_student_id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "sponsored_student.sponsored_student_id = @sponsored_student_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->sponsored_student_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@sponsored_student_id@", ew_AdjustSql($this->sponsored_student_id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "sponsored_student_detaillist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "sponsored_student_detaillist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("sponsored_student_detailview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "sponsored_student_detailadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("sponsored_student_detailedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("sponsored_student_detailadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("sponsored_student_detaildelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->sponsored_student_id->CurrentValue)) {
			$sUrl .= "sponsored_student_id=" . urlencode($this->sponsored_student_id->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=sponsored_student_detail" : "";
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
		$this->sponsored_student_id->setDbValue($rs->fields('sponsored_student_id'));
		$this->student_firstname->setDbValue($rs->fields('student_firstname'));
		$this->student_middlename->setDbValue($rs->fields('student_middlename'));
		$this->student_lastname->setDbValue($rs->fields('student_lastname'));
		$this->student_telephone_1->setDbValue($rs->fields('student_telephone_1'));
		$this->student_telephone_2->setDbValue($rs->fields('student_telephone_2'));
		$this->student_dob->setDbValue($rs->fields('student_dob'));
		$this->age->setDbValue($rs->fields('age'));
		$this->student_gender->setDbValue($rs->fields('student_gender'));
		$this->student_address->setDbValue($rs->fields('student_address'));
		$this->app_submission_year->setDbValue($rs->fields('app_submission_year'));
		$this->community->setDbValue($rs->fields('community'));
		$this->community_community_id->setDbValue($rs->fields('community_community_id'));
		$this->programarea_name->setDbValue($rs->fields('programarea_name'));
		$this->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
		$this->District->setDbValue($rs->fields('District'));
		$this->community_districts_DistrictID->setDbValue($rs->fields('community_districts_DistrictID'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// student_firstname

		$this->student_firstname->CellCssStyle = "white-space: nowrap;"; $this->student_firstname->CellCssClass = "";
		$this->student_firstname->CellAttrs = array(); $this->student_firstname->ViewAttrs = array(); $this->student_firstname->EditAttrs = array();

		// student_middlename
		$this->student_middlename->CellCssStyle = "white-space: nowrap;"; $this->student_middlename->CellCssClass = "";
		$this->student_middlename->CellAttrs = array(); $this->student_middlename->ViewAttrs = array(); $this->student_middlename->EditAttrs = array();

		// student_lastname
		$this->student_lastname->CellCssStyle = "white-space: nowrap;"; $this->student_lastname->CellCssClass = "";
		$this->student_lastname->CellAttrs = array(); $this->student_lastname->ViewAttrs = array(); $this->student_lastname->EditAttrs = array();

		// student_telephone_1
		$this->student_telephone_1->CellCssStyle = "white-space: nowrap;"; $this->student_telephone_1->CellCssClass = "";
		$this->student_telephone_1->CellAttrs = array(); $this->student_telephone_1->ViewAttrs = array(); $this->student_telephone_1->EditAttrs = array();

		// student_telephone_2
		$this->student_telephone_2->CellCssStyle = "white-space: nowrap;"; $this->student_telephone_2->CellCssClass = "";
		$this->student_telephone_2->CellAttrs = array(); $this->student_telephone_2->ViewAttrs = array(); $this->student_telephone_2->EditAttrs = array();

		// student_dob
		$this->student_dob->CellCssStyle = "white-space: nowrap;"; $this->student_dob->CellCssClass = "";
		$this->student_dob->CellAttrs = array(); $this->student_dob->ViewAttrs = array(); $this->student_dob->EditAttrs = array();

		// age
		$this->age->CellCssStyle = "white-space: nowrap;"; $this->age->CellCssClass = "";
		$this->age->CellAttrs = array(); $this->age->ViewAttrs = array(); $this->age->EditAttrs = array();

		// student_gender
		$this->student_gender->CellCssStyle = "white-space: nowrap;"; $this->student_gender->CellCssClass = "";
		$this->student_gender->CellAttrs = array(); $this->student_gender->ViewAttrs = array(); $this->student_gender->EditAttrs = array();

		// student_address
		$this->student_address->CellCssStyle = "white-space: nowrap;"; $this->student_address->CellCssClass = "";
		$this->student_address->CellAttrs = array(); $this->student_address->ViewAttrs = array(); $this->student_address->EditAttrs = array();

		// app_submission_year
		$this->app_submission_year->CellCssStyle = "white-space: nowrap;"; $this->app_submission_year->CellCssClass = "";
		$this->app_submission_year->CellAttrs = array(); $this->app_submission_year->ViewAttrs = array(); $this->app_submission_year->EditAttrs = array();

		// community
		$this->community->CellCssStyle = "white-space: nowrap;"; $this->community->CellCssClass = "";
		$this->community->CellAttrs = array(); $this->community->ViewAttrs = array(); $this->community->EditAttrs = array();

		// student_resident_programarea_id
		$this->student_resident_programarea_id->CellCssStyle = "white-space: nowrap;"; $this->student_resident_programarea_id->CellCssClass = "";
		$this->student_resident_programarea_id->CellAttrs = array(); $this->student_resident_programarea_id->ViewAttrs = array(); $this->student_resident_programarea_id->EditAttrs = array();

		// District
		$this->District->CellCssStyle = "white-space: nowrap;"; $this->District->CellCssClass = "";
		$this->District->CellAttrs = array(); $this->District->ViewAttrs = array(); $this->District->EditAttrs = array();

		// student_firstname
		$this->student_firstname->ViewValue = $this->student_firstname->CurrentValue;
		$this->student_firstname->CssStyle = "";
		$this->student_firstname->CssClass = "";
		$this->student_firstname->ViewCustomAttributes = "";

		// student_middlename
		$this->student_middlename->ViewValue = $this->student_middlename->CurrentValue;
		$this->student_middlename->CssStyle = "";
		$this->student_middlename->CssClass = "";
		$this->student_middlename->ViewCustomAttributes = "";

		// student_lastname
		$this->student_lastname->ViewValue = $this->student_lastname->CurrentValue;
		$this->student_lastname->CssStyle = "";
		$this->student_lastname->CssClass = "";
		$this->student_lastname->ViewCustomAttributes = "";

		// student_telephone_1
		$this->student_telephone_1->ViewValue = $this->student_telephone_1->CurrentValue;
		$this->student_telephone_1->CssStyle = "";
		$this->student_telephone_1->CssClass = "";
		$this->student_telephone_1->ViewCustomAttributes = "";

		// student_telephone_2
		$this->student_telephone_2->ViewValue = $this->student_telephone_2->CurrentValue;
		$this->student_telephone_2->CssStyle = "";
		$this->student_telephone_2->CssClass = "";
		$this->student_telephone_2->ViewCustomAttributes = "";

		// student_dob
		$this->student_dob->ViewValue = $this->student_dob->CurrentValue;
		$this->student_dob->ViewValue = ew_FormatDateTime($this->student_dob->ViewValue, 7);
		$this->student_dob->CssStyle = "";
		$this->student_dob->CssClass = "";
		$this->student_dob->ViewCustomAttributes = "";

		// age
		$this->age->ViewValue = $this->age->CurrentValue;
		$this->age->CssStyle = "";
		$this->age->CssClass = "";
		$this->age->ViewCustomAttributes = "";

		// student_gender
		if (strval($this->student_gender->CurrentValue) <> "") {
			switch ($this->student_gender->CurrentValue) {
				case "M":
					$this->student_gender->ViewValue = "Male";
					break;
				case "F":
					$this->student_gender->ViewValue = "Female";
					break;
				default:
					$this->student_gender->ViewValue = $this->student_gender->CurrentValue;
			}
		} else {
			$this->student_gender->ViewValue = NULL;
		}
		$this->student_gender->CssStyle = "";
		$this->student_gender->CssClass = "";
		$this->student_gender->ViewCustomAttributes = "";

		// student_address
		$this->student_address->ViewValue = $this->student_address->CurrentValue;
		$this->student_address->CssStyle = "";
		$this->student_address->CssClass = "";
		$this->student_address->ViewCustomAttributes = "";

		// app_submission_year
		if (strval($this->app_submission_year->CurrentValue) <> "") {
			$sFilterWrk = "`app_year` = " . ew_AdjustSql($this->app_submission_year->CurrentValue) . "";
		$sSqlWrk = "SELECT `app_year` FROM `academic_year`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->app_submission_year->ViewValue = $rswrk->fields('app_year');
				$rswrk->Close();
			} else {
				$this->app_submission_year->ViewValue = $this->app_submission_year->CurrentValue;
			}
		} else {
			$this->app_submission_year->ViewValue = NULL;
		}
		$this->app_submission_year->CssStyle = "";
		$this->app_submission_year->CssClass = "";
		$this->app_submission_year->ViewCustomAttributes = "";

		// community
		$this->community->ViewValue = $this->community->CurrentValue;
		$this->community->CssStyle = "";
		$this->community->CssClass = "";
		$this->community->ViewCustomAttributes = "";

		// student_resident_programarea_id
		if (strval($this->student_resident_programarea_id->CurrentValue) <> "") {
			$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($this->student_resident_programarea_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->student_resident_programarea_id->ViewValue = $rswrk->fields('programarea_name');
				$rswrk->Close();
			} else {
				$this->student_resident_programarea_id->ViewValue = $this->student_resident_programarea_id->CurrentValue;
			}
		} else {
			$this->student_resident_programarea_id->ViewValue = NULL;
		}
		$this->student_resident_programarea_id->CssStyle = "";
		$this->student_resident_programarea_id->CssClass = "";
		$this->student_resident_programarea_id->ViewCustomAttributes = "";

		// District
		$this->District->ViewValue = $this->District->CurrentValue;
		$this->District->CssStyle = "";
		$this->District->CssClass = "";
		$this->District->ViewCustomAttributes = "";

		// student_firstname
		$this->student_firstname->HrefValue = "";
		$this->student_firstname->TooltipValue = "";

		// student_middlename
		$this->student_middlename->HrefValue = "";
		$this->student_middlename->TooltipValue = "";

		// student_lastname
		$this->student_lastname->HrefValue = "";
		$this->student_lastname->TooltipValue = "";

		// student_telephone_1
		$this->student_telephone_1->HrefValue = "";
		$this->student_telephone_1->TooltipValue = "";

		// student_telephone_2
		$this->student_telephone_2->HrefValue = "";
		$this->student_telephone_2->TooltipValue = "";

		// student_dob
		$this->student_dob->HrefValue = "";
		$this->student_dob->TooltipValue = "";

		// age
		$this->age->HrefValue = "";
		$this->age->TooltipValue = "";

		// student_gender
		$this->student_gender->HrefValue = "";
		$this->student_gender->TooltipValue = "";

		// student_address
		$this->student_address->HrefValue = "";
		$this->student_address->TooltipValue = "";

		// app_submission_year
		$this->app_submission_year->HrefValue = "";
		$this->app_submission_year->TooltipValue = "";

		// community
		$this->community->HrefValue = "";
		$this->community->TooltipValue = "";

		// student_resident_programarea_id
		$this->student_resident_programarea_id->HrefValue = "";
		$this->student_resident_programarea_id->TooltipValue = "";

		// District
		$this->District->HrefValue = "";
		$this->District->TooltipValue = "";

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

		return TRUE;
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

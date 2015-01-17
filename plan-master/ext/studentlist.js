/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function getStudents(){
                
    pid=$("#programarea_id").prop("value");
    year=$("#app_year").prop("value");
    search=$("#txtSearch").val();
    spst=$("#selectSchoarshipStatus").val();
   
    if(search.length<=0){
        search=0;
    }
    u="ext/ajax.php?cmd=8&programarea_id="+pid+"&year="+year+"&search_text="+search+"&spst="+spst+"&page="+page;
    
    objResult=synchAjax(u);
    if(objResult.result==0){
        showError(objResult.message);
        return;
    }
    recCount=objResult.count;
    students=objResult.students;
    showStudents();
    searchType=0;
}

function exportList(){
                
    pid=$("#programarea_id").prop("value");
    year=$("#app_year").prop("value");
    search=$("#txtSearch").val();
    spst=$("#selectSchoarshipStatus").val();
   
    if(search.length<=0){
        search=0;
    }
    u="ext/export.php?cmd=8&programarea_id="+pid+"&year="+year+"&search_text="+search+"&spst="+spst;
    
    document.location=u;
}

function getPaidForStudents(paid){
    pid=$("#programarea_id").prop("value");
    year=$("#app_year").prop("value");

    u="ext/ajax.php?cmd=13&paid="+paid+"&programarea_id="+pid+"&year="+year+"&page="+page;
    objResult=synchAjax(u);
    if(objResult.result==0){
        showError(objResult.message);
        students=new Array();
        showStudents();
        return;
    }
    recCount=objResult.count;
    students=objResult.students;
    showStudents();
    if(paid==1){
        showStatus(""+ recCount +" records found whose scholarship is paid for in this financial year");
        searchType=1;
    }else{
        showStatus(""+ recCount +" records found whose scholarship is yet to be paid in this financial year");
        searchType=2;
    }
}

function getStudentsInPaymentRequest(){           
    pid=$("#programarea_id").prop("value");
    year=$("#app_year").prop("value");
    prid=$("#requestId").val();
    

    if(prid==0){
        showStatus("select payment request");
        return;
    }
    u="ext/ajax.php?cmd=14&programarea_id="+pid+"&prid="+prid+"&year="+year+"&page="+page+"&search_text="+search;
    objResult=synchAjax(u);
    if(objResult.result==0){
        showError(objResult.message);
        students=new Array();
        showStudents();
        return;
    }
    recCount=objResult.count;
    students=objResult.students;
    showStudents();
    showStatus(""+ recCount +" records found in the selected payment request");
    searchType=3;

}

function getScholarshipEndingStudents(){
    //get year from txtEndingYear input box
    //get programarea
    //make ajax call to ajax.php command 18
    //then show students
    
}

function changeStudentsScholarship(status){
    if(status==3){
        if(!confirm("Once a scholarship is ended, it can not be activated. Are you sure you want to end the selected studnets scholarship?")){
            return;
        }
    }
    var str="ids=";
    var count=0;
    $("[type='checkbox']").each(function(i){
        if($(this).prop('checked')){
            str=str+$(this).val() + ",";
            count++;
        }
    });
    if(count<=0){
        showError("please select students");
        
    }
    str=str.substr(0,str.length-1);
    var u="ext/ajax.php?cmd=19&spst="+status+"&"+str;
    objResult=synchAjax(u);
    if(objResult.result==0){
        showStatus(objResult.message);
        return;
    }
    var successCount=0;
    var failCount=0;
    for(i=0;i<objResult.astatus.length;i++){
        if(objResult.astatus[i].status==1 ){
            var selector="[type='checkbox'][value='"+ objResult.astatus[i].id +"'";
            $(selector).prop("checked",false);
            successCount++;

        }else{
           failCount++;
        }
    }
    var statusName="";
    if(status==1){
        statusName="resumed";
    }else if(status==2){
       statusName="suspended"; 
    }else if (status==3){
        statusName="ended";
    }

    var message="out of selected records, "+successCount + " are "+statusName;
    if(failCount>0){
        message=message+", but "+ failCount+ " could not be " +statusName;
        showError(message);
    }else{
        showStatus(message);
    }
        
    
    
}

function showStudents(){
    clearTable(tableStudents,1);
    if(students==null){
        return;
    }
    for(i=0;i<students.length;i++){

       var r=tableStudents.insertRow(-1);
       if(i%2==0){
           r.className="default_report_line1";
       }else{
           r.className="default_report_line2";
       }
       var c=r.insertCell(0);
       c.innerHTML="<input type='checkbox' id='"+objResult.students[i].sponsored_student_id+"' name='"+objResult.students[i].sponsored_student_id+"' value='"+objResult.students[i].sponsored_student_id+"'>";
       var c=r.insertCell(1);
       c.innerHTML=students[i].programarea_name;
       c=r.insertCell(2);
       c.innerHTML=students[i].app_submission_year;
       c=r.insertCell(3)
       c.innerHTML=students[i].community;
       c=r.insertCell(4);
       c.innerHTML="<b>" +students[i].student_lastname +"</b>, " +students[i].student_firstname;
       c=r.insertCell(5);
       if(validateGender(objResult.students[i].student_gender)){
            c.innerHTML=objResult.students[i].student_gender;
       }else{
           c.innerHTML="<span class='default_error'>invalid</span>";
       }
       c=r.insertCell(6);
       c.innerHTML=formatDateFromMysql(students[i].student_dob);
       c=r.insertCell(7);
       c.innerHTML=students[i].student_telephone_1 +", " +students[i].student_telephone_2;
       c=r.insertCell(8);
       c.innerHTML=students[i].school_name;
       c=r.insertCell(9);
       c.innerHTML=students[i].grant_name;
       c=r.insertCell(10);
       c.innerHTML='<span class="hotspot" onclick="openRecord(this,'+i+','+students[i].sponsored_student_id+')">open</span>';
    }
    showStatus(""+ recCount+ " records found");
    //students=objResult.students;
}
            
function validate(){
    var r=true;
    if(!validateName($("#lastname").prop("value"))){
        $("#lastname").css("background-color","#ff6666");
        r=false;
    }else{
        $("#lastname").css("background-color","#ffffff");
    }
    if(!validateName($("#firstname").prop("value"))){
        $("#firstname").css("background-color","#ff6666");
        r=false;
    }else{
        $("#firstname").css("background-color","#ffffff");
    }

    if(!validateName($("#middlename").prop("value"))){
        $("#middlename").css("background-color","#ff6666");
    }else{
        $("#middlename").css("background-color","#ffffff");
    }

    if(!validateGender($("#gender").prop("value"))){
        $("#gender").css("background-color","#ff6666");
        $("#gender").prop("value","0");
        r=false;
    }else{
        $("#gender").css("background-color","#ffffff");
    }

    if($("#community").prop("value")<=0){
        $("#community").css("background-color","#ff6666");
        $("#community").prop("value",0);
        r=false; 
    }else{
        $("#community").css("background-color","#ffffff");
    }

    if(!validateDate($("#birthdate").val())){
        $("#birthdate").css("background-color","#ff6666");
        r=false;
    }else{
        $("#birthdate").css("background-color","#ffffff");
    }
    
    if(!validatePhone($("#telephone1").val())){
        $("#telephone1").css("background-color","#ff6666");
    }else{
        $("#telephone1").css("background-color","#ffffff");
    }
    
    var str=$("#telephone2").val();
    
    if(str.length>0){
        var r=/none/; 
        if(!validatePhone(str) && !r.text(str) ){
            $("#telephone2").css("background-color","#ff6666");
        }else{
            $("#telephone2").css("background-color","#ffffff");
        }
    }

    return r;
}

function clean(){
    var l=$("#lastname").prop("value");
    l=removeChar(l,"'");
    $("#lastname").prop("value",l);
    var f=$("#firstname").prop("value");
    f=removeChar(f,"'");
    $("#firstname").prop("value",f);
    var t=$("#telephone1").prop("value");
    t=removeChar(t,"'");
    t=removeChar(t,"\W")
    $("#telephone1").prop("value",t);
    var t=$("#telephone2").prop("value");
    t=removeChar(t,"'");
    $("#telephone2").prop("value",t);

    validate();
}
            
function saveUpdate(){
    if(currentStudentId==0){
        return;
    }
    showStatus("updateing...");
    var l=$("#lastname").prop("value");
    var f=$("#firstname").prop("value");
    var m=$("#middlename").prop("value");
    var g=$("#gender").prop("value");

    var d=document.getElementById("birthdate").value;
    var c=$("#selectDistrictForCommunity").prop("value");
    var t1=$("#telephone1").prop("value");
    var t2=$("#telephone2").prop("value");

    var u="ext/ajax.php?cmd=10"
            +"&student_id="+ currentStudentId
            +"&lastname="+l
            +"&firstname="+f
            +"&midlename="+m
            +"&gender="+g
            +"&birthdate="+d
            +"&community_id="+c
            +"&telephone1="+t1
            +"&telephone2="+t2
    objResult=synchAjax(u);
    if(objResult.result==0){
        showError(objResult.message);
        return;
    }else{
        showStatus("updated");
    }

}

function updateRecord(){

    if(students==null){
        return;
    }

    if(currentStudentId==0){
        return;
    }
    var index=currentIndex;
    closePopups();
    showStatus("updateing...");
    
    divViewUpdate.style.display="block";

    $("#lastname").prop("value",students[index].student_lastname);
    $("#firstname").prop("value",students[index].student_firstname);
    $("#middlename").prop("value",students[index].student_middlename);
    if(validateGender(students[index].student_gender)){
        $("#gender").prop("value",students[index].student_gender);
    }else{
        $("#gender").prop("value",0);
    }

    $("#selectDistrictForCommunity").prop("value",students[index].DistrictID);
    $( "#birthdate" ).datepicker( "setDate", getDateFromMysql(students[index].student_dob));
    //var defaultDate=new Date();
    //defaultDate.setYear(defaultDate.getFullYear()-12);
    //setDateInput(document.getElementById("birthdate"),students[index].student_dob,defaultDate);
    $("#telephone1").prop("value",students[index].student_telephone_1);
    $("#telephone2").prop("value",students[index].student_telephone_2);
    getCommunity(students[index].DistrictID);
    $("#community").prop("value",students[index].community_id);

}

function getStudentAttendanceAndScholarship(){
    getStudentAttendance();
    getStudentScholarship();
}

function getStudentAttendance(){
    if(currentStudentId==0){
        return;
    }
    var u="ext/ajax.php?cmd=9&id=" +currentStudentId;
    var objResult=synchAjax(u);
    if(objResult.result==0){
        showError(objResult.message);
        return;
    }
    var objDiv=document.getElementById("divAttendance");
    closePopups();
    //objDiv.style.position="absolute";
    //objDiv.style.top=event.clientY+20;
    //objDiv.style.left=200;
    objDiv.style.display="block";
    
    
    clearTable(document.getElementById("tableAttendance"),1);
    if(objResult.attendance.length==0){
        document.getElementById("spanAttendanceNoRecord").innerHTML="register to school";
        document.getElementById("spanAttendanceNoRecord").style.visibility="visible";
        document.getElementById("spanAttendanceNoRecord").style.className="hotspot";
    }
    
    
    for(i=0;i<objResult.attendance.length;i++){
        var r=document.getElementById("tableAttendance").insertRow(-1);
        var c=r.insertCell(0);
        c.innerHTML=formatDateFromMysql(objResult.attendance[i].start_date);
        c=r.insertCell(1);
        c.innerHTML=formatDateFromMysql(objResult.attendance[i].end_date);
        c=r.insertCell(2);
        c.innerHTML=objResult.attendance[i].program;
        c=r.insertCell(3);
        c.innerHTML=objResult.attendance[i].attendance_type;
        c=r.insertCell(4);
        c.innerHTML=objResult.attendance[i].school_name;
    }
    
    
    showStatus("student school registration ");
    

}

function getStudentScholarship(){
    if(currentStudentId==0){
        return;
    }
   
    var u="ext/ajax.php?cmd=20&id="+currentStudentId;
    objResult=synchAjax(u);
    if(objResult.result==0){
        showStatus(objResult.message);
        return;
    }
    
    clearTable(tableScholarshipPackage,1);
    for(i=0;i<objResult.scholarship_packages.length;i++){
        r=tableScholarshipPackage.insertRow(-1);
        var c=r.insertCell(0);
        c.innerHTML=formatDateFromMysql(objResult.scholarship_packages[i].start_date);
        c=r.insertCell(1);
        c.innerHTML=formatDateFromMysql(objResult.scholarship_packages[i].end_date);
        c=r.insertCell(2);
        c.innerHTML=getScholarshipStatusName(objResult.scholarship_packages[i].status);
        c=r.insertCell(3);
        c.innerHTML=objResult.scholarship_packages[i].scholarship_type;
        c=r.insertCell(4);
        c.innerHTML=objResult.scholarship_packages[i].annual_amount;
        c=r.insertCell(5)
        if(objResult.scholarship_packages[i].status==1){
            c.innerHTML="<span class='hotspot' onclick='suspendScholarship(this,"+objResult.scholarship_packages[i].scholarship_package_id
                +")'>supend</span> |"+
                            "<span class='hotspot' onclick='endScholarship(this,"+objResult.scholarship_packages[i].scholarship_package_id
                +")'>end</span>";
        }else if(objResult.scholarship_packages[i].status==2){
            c.innerHTML="<span class='hotspot' onclick='suspendScholarship(this,"+objResult.scholarship_packages[i].scholarship_package_id
                +")'>resume</span> |"+
                            "<span class='hotspot' onclick='endScholarship(this,"+objResult.scholarship_packages[i].scholarship_package_id
                +")'>end</span>";
        }else if(objResult.scholarship_packages[i].status==2){
            c.innerHTML="ended";
        }else if(objResult.scholarship_packages[i].status==0){
            c.innerHTML="start";
        };
    }
}

function getScholarshipStatusName(status){
    n=parseInt(status);
    switch(n){
        case 1:
            status="ACTIVE";
            break;
        case 2:
            status="SUSPENDED";
            break;
        case 3:
            status="ENDED";
            break;
        default:
            status="UNKNOWN";
            break;
    }
    return status;
}

function showConfirmPopup(){
    flagConfimred=false;
    document.getElementById("divConfirmPopup").style.display="block";
}

function addToPayment(){
    var prid=$("#requestId").val();
    
    if(prid==0){
        showStatus("select payment request");
        return;
    }
    var str="ids=";
    var count=0;
    $("[type='checkbox']").each(function(i){
        if($(this).prop('checked')){
            str=str+$(this).val() + ",";
            count++;
        }
    });
    if(count>0){
        str=str.substr(0,str.length-1);
        var u="ext/ajax.php?cmd=11&prid="+prid+"&"+str;
        objResult=synchAjax(u);
        if(objResult.result==0){
            showStatus(objResult.message);
            return;
        }
        var successCount=0;
        var failCount=0;
        for(i=0;i<objResult.astatus.length;i++){
            if(objResult.astatus[i].status >=200 ){
                var selector="[type='checkbox'][value='"+ objResult.astatus[i].id +"'";
                $(selector).prop("checked",false);
                successCount++;
           
            }else{
               failCount++;
            }
        }
           
        var message="out of selected records, "+successCount + " are added";
        if(failCount>0){
            message=message+", but "+ failCount+ " could not be added to the request";
            showError(message);
        }else{
            showStatus(message);
        }
        
    }else{
        showError("select students");
    }

}

function removeFromPayment(){
    prid=$("#requestId").val();
    
    if(prid==0){
        showStatus("select payment request");
        return;
    }
    var str="ids=";
    var count=0;
    $("[type='checkbox']").each(function(i){
        if($(this).prop('checked')){
            str=str+$(this).val() + ",";
            count++;
        }
    });
    if(count>0){
        str=str.substr(0,str.length-1);
        var u="ext/ajax.php?cmd=15&prid="+prid+"&"+str;
        objResult=synchAjax(u);
        if(objResult.result==0){
            showStatus(objResult.message);
            return;
        }
        var successCount=0;
        var failCount=0;
        for(i=0;i<objResult.astatus.length;i++){
            if(objResult.astatus[i].status==300 ){
                var selector="[type='checkbox'][value='"+ objResult.astatus[i].id +"'";
                $(selector).prop("checked",false);
                successCount++;
           
            }else{
               failCount++;
            }
        }
           
        var message="out of selected records "+successCount + " are removed";
        if(failCount>0){
            message=message+", but "+ failCount+ " could not be removed from the request";
            showError(message);
        }else{
            showStatus(message);
        }
    }else{
        showError("select students");
    }
    
}

function addToPaymentSingle(){
    if(currentStudentId==0){
        return;
    }
    prid=$("#requestId").val();
    if(prid==0){
        showStatus("select payment request");
        return;
    }
    
    var u="ext/ajax.php?cmd=11&prid="+prid+"&ids="+currentStudentId;
    var objResult=synchAjax(u);
    if(objResult.result==0){
        showError(objResult.message);
        return;
    }
    var status=objResult.status[0].status;
    if(status==201){
        showStatus("already in request");
    }else if(status==202){
        showStatus("the scholarship for this student has been added to a request this year");
    }else if(status==200){
        showStatus("added to selected request");
    }else if(status<0){
        showStatus("error while adding to request");
    }

    var u="ext/ajax.php?cmd=12&id=" +currentStudentId;
    var objResult=synchAjax(u);
    if(objResult.result==0){
        showError(objResult.message);
        return;
    }
    var objDiv=document.getElementById("divPayment");
    closePopups();

    objDiv.style.display="block";
    
    
    clearTable(document.getElementById("tablePayment"),1);
    
   
    for(i=0;i<objResult.payments.length;i++){
        var r=document.getElementById("tablePayment").insertRow(-1);
        var c=r.insertCell(0);
        c.innerHTML=formatDateFromMysql(objResult.payments[i].date);
        c=r.insertCell(1);
        c.innerHTML=objResult.payments[i].status;
        c=r.insertCell(2);
        c.innerHTML=objResult.payments[i].amount;
        c=r.insertCell(3);
        c.innerHTML=objResult.payments[i].school_name;
    }
}

function getStudentPayment(){
    if(currentStudentId==0){
        return;
    }
    var u="ext/ajax.php?cmd=12&id=" +currentStudentId;
    var objResult=synchAjax(u);
    if(objResult.result==0){
        showError(objResult.message);
        return;
    }
    var objDiv=document.getElementById("divPayment");
    closePopups();

    objDiv.style.display="block";
    
    
    clearTable(document.getElementById("tablePayment"),1);
    
   
    for(i=0;i<objResult.payments.length;i++){
        var r=document.getElementById("tablePayment").insertRow(-1);
        var c=r.insertCell(0);
        c.innerHTML=formatDateFromMysql(objResult.payments[i].date);
        c=r.insertCell(1);
        c.innerHTML=objResult.payments[i].status;
        c=r.insertCell(2);
        c.innerHTML=objResult.payments[i].amount;
        c=r.insertCell(3);
        c.innerHTML=objResult.payments[i].school_name;
    }
    showStatus("student payments ");
   
}

function getStudentPerformance(){
    if(currentStudentId==0){
        return;
    }
    closePopups();
    var u="ext/ajax.php?cmd=16&id="+currentStudentId;
    objResult=synchAjax(u);
    if(objResult.result==0){
        showStatus(objResult.message);
        return;
    }
    divPerformance.style.display="block";
    
    clearTable(tablePerformance,1);
    for(i=0;i<objResult.performance.length;i++){
        r=tablePerformance.insertRow(-1);
        var c=r.insertCell(0);
        c.innerHTML=objResult.performance[i].year;
        c=r.insertCell(1);
        c.innerHTML=objResult.performance[i].class;
        c=r.insertCell(2);
        c.innerHTML=objResult.performance[i].promoted==1? "Yes":"No";
        c=r.insertCell(3);
        c.innerHTML=objResult.performance[i].math;
        c=r.insertCell(3);
        c.innerHTML=objResult.performance[i].english;
    }
}

function recordPerformance(promoted){
    if(currentStudentId==0){
        return;
    }
    var math=$("#txtMath").val();
    if(math.length==0){
        math="NA";
    }
    
    
    var eng=$("#txtEng").val();
    if(eng.length==0){
        eng="NA";
    }
    u="ext/ajax.php?cmd=17&id="+currentStudentId+"&promoted="+promoted+"&math="+math+"&eng="+eng;
    
    objResult=synchAjax(u);
    if(objResult.result==0){
        showError(objResult.message);
        return;
    }
    
    getStudentPerformance();
}

function getCommunity(districtId){
    if(isNaN(districtId)){
        return;
    }
    if(districtId==0){
        return;
    }
    if(districtId==-1){
        var objDistrict=document.getElementById("selectDistrictForCommunity");
        if(objDistrict==null){
            return;
        }
        districtId=objDistrict.value;
    }

    var theUrl="ext/ajax.php?cmd=2&district_id="+districtId;
    var obj=synchAjax(theUrl);
    if(obj.result==0){
        return;
    }
    obj.communites.sort();
    var objCommunity=document.getElementById("community");
    if(objCommunity==null){
        return;
    }
    clearSelect(objCommunity,true);
    var objNewOption;
    for(i=0;i<obj.communites.length;i++){
        objNewOption=document.createElement("OPTION");
        objNewOption.value=obj.communites[i].communityID;
        objNewOption.text=obj.communites[i].community;
        objCommunity.options.add(objNewOption);

    }

}

function suspendScholarship(obj,scholarshipId){
    var u="ext/ajax.php?cmd=21&spid="+scholarshipId+"&st="+2;
    var objResult=synchAjax(u);
    if(objResult.result==0){
        showError(objResult.message);
        return;
    }
    var objRow=obj.parentNode.parentNode;
    objRow.cells[2].innerHTML=getScholarshipStatusName(2);
    objRow.cells[5].innerHTML="<span class='hotspot' onclick='resumeScholarship(this,"+scholarshipId
                +")'>resume</span> |"+
                            "<span class='hotspot' onclick='endScholarship(this,"+scholarshipId
                +")'>end</span>";
    
}

function endScholarship(obj,scholarshipId){
    var u="ext/ajax.php?cmd=21&spid="+scholarshipId+"&st="+3;
    var objResult=synchAjax(u);
    if(objResult.result==0){
        showError(objResult.message);
        return;
    }
    var objRow=obj.parentNode.parentNode;
    objRow.cells[2].innerHTML=getScholarshipStatusName(3);
    objRow.cells[5].innerHTML="";
    
}

function resumeScholarship(obj,scholarshipId){
    var u="ext/ajax.php?cmd=21&spid="+scholarshipId+"&st="+1;
    var objResult=synchAjax(u);
    if(objResult.result==0){
        showError(objResult.message);
        return;
    }
    var objRow=obj.parentNode.parentNode;
    objRow.cells[2].innerHTML=getScholarshipStatusName(1);
    objRow.cells[5].innerHTML="<span class='hotspot' onclick='suspendScholarship(this,"+scholarshipId
                +")'>supend</span> |"+
                            "<span class='hotspot' onclick='endScholarship(this,"+scholarshipId
                +")'>end</span>";
    
}

function changeSchool(obj, t){
    //create a drop down where the button is to select school
    //get list of schools by ajax 
    //poplulate the drop down
    //
}

function saveSchoolChange(){
    //pick selected school
    //make ajax call
}
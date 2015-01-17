/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var paymentId=0;
var schoolId=0;

function paymentSelected(pid){
   paymentId=pid;
   getPaymentDetail();
   newSearch(2); //get school for the selected payment
} 

function getSchools(){
//synchAjax is defined in ext/gen.js file
    var prid=paymentId;//$("#requestId").prop("value");
    if(prid==0){
        showError("please select a payment request");
        return;
    }
    var objResult=synchAjax("ext/ajaxpayments.php?cmd=3&prid="+prid+"&page="+page);
    if(objResult.result==0){
        showError(objResult.message);
        return;
    }
    //check if synchAjax has returned successful result
    //objResult.schools will be an array of schools record. 
    //Each rechord will have school name, school id, amount the school to be paid, number students from the school 	
    showSchools(objResult);        
    searchType=2;
}

function getStudentsInPaymentRequest(){

    var pid=$("#programarea_id").prop("value");
    var year=$("#app_year").prop("value");
    var prid=paymentId;//$("#requestId").prop("value");

    if(prid==0){
        showError("please select a payment request");
        return;
    }
    var u="ext/ajaxpayments.php?cmd=4&prid="+prid+"&programarea_id="+pid+"&year="+year+"&page="+page
    objResult=synchAjax(u);
    //check if objResult has successful result
    if(objResult.result==0){
        showError(objResult.message);
        return;
    }
    showStudents(objResult);
    searchType=3;
}

function getSchoolSutdents(sid){
    var pid=$("#programarea_id").prop("value");
    var year=$("#app_year").prop("value");
    var prid=paymentId;//$("#requestId").prop("value");

    if(prid==0){
        showError("please select a payment request");
        return;
    }
    var u="ext/ajaxpayments.php?cmd=8&prid="+prid+"&programarea_id="+pid+"&year="+year+"&page="+page+"&schid="+sid;
    objResult=synchAjax(u);
    //check if objResult has successful result
    if(objResult.result==0){
        showError(objResult.message);
        return;
    }
    showStudents(objResult);
    schoolId=sid;
    searchType=4;
}

function getPaymentDetail(){
    var prid=paymentId;//$("#requestId").prop("value");
    if(prid==0){
            return;
    }
    objResult=synchAjax("ext/ajaxpayments.php?cmd=5&prid="+prid);
    //we will deal with this later
    if(objResult.result==0){
        showError("Could not get payment detail for the selected request.");
        return;
    } 
    showPaymentDetail(objResult);

}

function showPaymentDetail(objResult){
   
    divPaymentDetail.style.display="block";
    $("#tdPaymentCode").text(objResult.payment.code);
    $("#tdPaymentStatus").html(showStatusCommands(objResult.payment.request_status,objResult.payment.payment_request_id));
    $("#tdAmount").text(objResult.payment.amount);
}

function showStatusCommands(status,id){

   var str=status; 
   if(status==="NEWREQ" && (userlevel==0 || userlevel==1)){
       str=str+"<span class='hotspot' onclick='changeStatus("+id+",1)'>submit</span>";
   }else if(status==="REQUESTED"  && (userlevel==0 || userlevel==3)){
       str=str+"<span class='hotspot onclick='changeStatus("+id+",2)'>disbursed</span>"; 
   }else if(status==="DISBURSED"  && (userlevel==0 || userlevel==1)){
       str=str+"<span class='hotspot' onclick='changeStatus("+id+",3)'>liquidated</span>"; 
   }else{

   } 
   return str;
}

function changeStatus(id,status){
   var str;
   if(status==1){
       str="submit";
   }else if(status==2){
       str="disburse";
   }else if(status==3){
       str="liqudate";
   } 
   if(!confirm("Are you sure you want to "+str+" this request?")){
       return;
   }

   var u="ext/ajaxpayments.php?cmd=6&prid="+id+"&st="+status;
   var objResult=synchAjax(u);
   if(objResult.result==0){
        showError(objResult.message);
        return;
    }
    
    getPaymentDetail();
    showStatus("Payment updated.");
}

function getPayments(){

   searchType=1;
   var fyid=$("#fin_year").prop("value");
   var pid=$("#programarea_id").prop("value");
   var st=0;
   var u="ext/ajaxpayments.php?cmd=2&fyid="+fyid+"&prgoramarea_id="+pid+"&st="+st+"&page="+page;
    var objResult=synchAjax(u);
    if(objResult.result==0){
        showError(objResult.message);
        return;
    }
    //check if synchAjax has returned successful result
    //objResult.schools will be an array of schools record. 
    //Each rechord will have school name, school id, amount the school to be paid, number students from the school 	
    showPayments(objResult);
}

function showSchools(objResult){

      tableSchools.style.display="block";
      tableStudents.style.display="none";
      tablePayments.style.display="none";


      clearTable(tableSchools,1);
      for(i=0;i<objResult.schools.length;i++){

       var r=tableSchools.insertRow(-1);
       if(i%2==0){
           r.className="default_report_line1";
       }else{
           r.className="default_report_line2";
       }

       var c=r.insertCell(0);
         c.innerHTML="<input type='checkbox' id='"+objResult.schools[i].school_id+"' name='"+objResult.schools[i].school_id+"' value='"+objResult.schools[i].school_id+"'>";
         var c=r.insertCell(1);
         c.innerHTML=objResult.schools[i].school_name;
         c=r.insertCell(2);        
         c.innerHTML=objResult.schools[i].total_amount;
         c=r.insertCell(3);        
         c.innerHTML=objResult.schools[i].payment_number  + " <span class='hotspot' onclick=newSearchgetSchoolSutdents("+objResult.schools[i].school_id +") >list</span>";
        //amount is missing
        //number of student is missing 
        //look at the table below
    }
    showStatus("showing schools in the selected payment request");
    schools=objResult.schools;
}

function showStudents(objResult){
    clearTable(tableStudents,1);
    tableSchools.style.display="none";
    tableStudents.style.display="block";
    tablePayments.style.display="none";

    for(i=0;i<objResult.students.length;i++){

       var r=tableStudents.insertRow(-1);
       if(i%2==0){
           r.className="default_report_line1";
       }else{
           r.className="default_report_line2";
       }
       var c=r.insertCell(0);
       c.innerHTML="<input type='checkbox' id='"+objResult.students[i].sponsored_student_id+"' name='"+objResult.students[i].sponsored_student_id+"' value='"+objResult.students[i].sponsored_student_id+"'>";
       var c=r.insertCell(1);
       c.innerHTML=objResult.students[i].programarea_name;
       c=r.insertCell(2);
       c.innerHTML=objResult.students[i].app_submission_year;
       c=r.insertCell(3)
       c.innerHTML=objResult.students[i].community;
       c=r.insertCell(4);
       c.innerHTML="<b>" +objResult.students[i].student_lastname +"</b>, " +objResult.students[i].student_firstname;
       c=r.insertCell(5);
       if(validateGender(objResult.students[i].student_gender)){
            c.innerHTML=objResult.students[i].student_gender;
       }else{
           c.innerHTML="<span class='default_error'>invalid</span>";
       }
       c=r.insertCell(6);
       c.innerHTML=formatDateFromMysql(objResult.students[i].student_dob);
       c=r.insertCell(7);
       c.innerHTML=objResult.students[i].student_telephone_1 +", " +objResult.students[i].student_telephone_2;
       c=r.insertCell(8);
       c.innerHTML=objResult.students[i].school_name;
       c=r.insertCell(9);
       c.innerHTML=objResult.students[i].scholarship_annaual_amount ;
       c=r.insertCell(10);
       c.innerHTML=objResult.students[i].grant_name;

    }
    showStatus("showing students in the selected payment request");
    students=objResult.students;
}

function showPayments(objResult){
      divPaymentDetail.style.display="none";
      tableSchools.style.display="none";
      tableStudents.style.display="none";
      tablePayments.style.display="block";

      clearTable(tablePayments,1);
      for(i=0;i<objResult.payments.length;i++){

       var r=tablePayments.insertRow(-1);
       if(i%2==0){
           r.className="default_report_line1";
       }else{
           r.className="default_report_line2";
       }

       var c=r.insertCell(0);
         c.innerHTML="<input type='checkbox' id='"+objResult.payments[i].payment_request_id+"' name='"+objResult.payments[i].payment_request_id+"' value='"+objResult.payments[i].payment_request_id+"'>";
         var c=r.insertCell(1);
         c.innerHTML=objResult.payments[i].code;
         c=r.insertCell(2);        
         c.innerHTML=objResult.payments[i].year_name;
         c=r.insertCell(3);        
         c.innerHTML=objResult.payments[i].programarea_name;
         c=r.insertCell(4);
         c.style.textAlign="right";
         c.innerHTML="GHS "+objResult.payments[i].amount;
         c=r.insertCell(5);        
         c.innerHTML=objResult.payments[i].request_status;
         c=r.insertCell(6);        
         c.innerHTML="<span onclick='paymentSelected("+objResult.payments[i].payment_request_id+")' class='hotspot'>view</span>";
         
    }
    showStatus("showing payments in the selected finacial year");
    payments=objResult.payments;
}

function exportSelected(){
    if(searchType==1){
        //export payment lists
         var fyid=$("#fin_year").prop("value");
         var pid=$("#programarea_id").prop("value");
         var st=0;
         var u="ext/exportpayments.php?cmd=2&fyid="+fyid+"&prgoramarea_id="+pid+"&st="+st;
         document.location=u;
    }else if(searchType==2){
         var prid=$("#requestId").prop("value");
         if(prid==0){
            return;
        }
        //export schools
        var u="ext/exportpayments.php?cmd=3&prid="+prid;
        document.location=u;
    }else if(searchType==3){
        var pid=$("#programarea_id").prop("value");
        var year=$("#app_year").prop("value");
        var prid=paymentId;//$("#requestId").prop("value");
        if(prid==0){
            return;
        }
        var u="ext/exportpayments.php?cmd=3&prid="+prid+"&programarea_id="+pid+"&year="+year;
        document.location=u;
    }
}
           
function createNewPaymentRequest(){
    var obj=document.getElementById("programarea_id");
    if(obj==null){
        //no program area so use users program area
    }else{
        if(obj.value==0){
            showError("please select program area");
            return;
        }
        
    }
    var pid=obj.value;
    var rqname=$("#requestName").prop("value");
    var u="ext/ajaxpayments.php?cmd=7&programarea_id="+pid+"&rqname="+rqname;
    var objResult=synchAjax(u);
    if(objResult.result==0){
        showStatus(objResult.message);
        return;
    } 
    //var objOption=document.createElement("OPTION");
    //objOption.value=objResult.payment.payment_request_id;
    //objOption.text=objResult.payment.code;
    //var objPaymentRequest=document.getElementById("requestId");
    //objPaymentRequest.add(objOption);
    //objPaymentRequest.value=objResult.payment.payment_request_id;
    paymentId=objResult.payment.payment_request_id;
    showPaymentDetail(objResult);
    cancelNewPaymentRequest();
    newSearch(2); //get school for the selected payment
    
}

function startNewPaymentRequest(){
    showStatus("creating request...");
    divNewPayment.style.left=event.clientX;
    divNewPayment.style.top=event.clientY;
    divNewPayment.style.display="block";
}

function cancelNewPaymentRequest(){
    divNewPayment.style.display='none';
}


var aa=null;
function custom_ajax(info)
{
	this.call = function() {
	info.element.innerHTML = info.busy.html;
	var request_data = '';
	if(info.request_data)
	{
		for(key in info.request_data)
		{
			request_data += ''+key+"="+encodeURI(info.request_data[key])+'&';
		}
	}
	//alert(info.request_data);
	//alert(request_data);
	$.ajax({ url: "custom_action/payment_request_action.php?"+request_data, dataType: "json",cache:false})
    .success(function(data) { info.element.innerHTML = info.success.html; info.element.innerHTML = data.message; /*alert(data.message); aa=data;*/})
    .error(function() { info.element.innerHTML = info.error.html; })
    .complete(function(jqXHR, textStatus) { /*info.element.innerHTML = info.complete.html;*/ })
	;
	}
}
function custom_payment_request_hello(m)
{	
	alert('Test:'+m);
}
function custom_payment_request_student_status(student_id)
{
	var obj = document.getElementById('payment_request_status_'+student_id);
	var data_params = new Array();
	data_params['action']='status';
	data_params['student_id']=''+student_id;
	var f = new custom_ajax({element:obj,busy:{html:'checking...'},success:{html:'Done'},error:{html:'Error'},complete:{html:'Complete'},request_data:data_params});
	f.call();
}

function custom_payment_request_student_add(student_id)
{
	var obj = document.getElementById('payment_request_status_'+student_id);
	var data_params = new Array();
	data_params['action']='add';
	data_params['student_id']=''+student_id;
	var f = new custom_ajax({element:obj,busy:{html:'adding...'},success:{html:'Done'},error:{html:'Error'},complete:{html:'Add Complete'},request_data:data_params});
	f.call();
}

function custom_payment_request_student_remove(student_id)
{
	var obj = document.getElementById('payment_request_status_'+student_id);
	var data_params = new Array();
	data_params['action']='remove';
	data_params['student_id']=''+student_id;
	var f = new custom_ajax({element:obj,busy:{html:'removing...'},success:{html:'Done'},error:{html:'Error'},complete:{html:'Remove Complete'},request_data:data_params});
	f.call();
}
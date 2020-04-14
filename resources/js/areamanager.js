//查询历史资料=====================================================================

$(function () {

	$('#checkDay').click(function(event) {
		$('.datetimepicker1').show();
		$('.datetimepicker2').hide();
	});
	$('#checkMonth').click(function(event) {
		$('.datetimepicker2').show();
		$('.datetimepicker1').hide();
	});

	$('#inDate').click(function(event) {
		var inDate = $('#datetimepicker1').val();
		historyList(inDate,'');
	});

	$('#inMonth').click(function(event) {
		var inMonth = $('#datetimepicker2').val();
	  	summaryList(inMonth);
	});


});

//月汇总
function summaryList(inMonth){

	var params1 = localStorage.getItem('params1');
    params1 = JSON.parse(params1);

    var postData = {
    	mobile:params1.mobile,
    	inMonth:inMonth
    }
    
    var sreachList = '';

	$.post(HttpUrl+'/main/summary/', postData, function(data) {

		console.log(data)

		if(data.data[0] != ''){
			var list = data.data[0].ReportList;
			console.log(list)
			var DataDate = data.data[0].DataDate;

			sreachList += '<caption>上报日期:'+DataDate+'</caption>';

			sreachList += '<thead><tr><th>名称</th><th>数量</th><th>计划量</th><th>完成比例</th></tr></thead><tbody>';
			if(list){
				for(i in list){
					sreachList += '<tr><td>'+list[i].CateGoryName+'</td>';
					sreachList += '<td>'+list[i].Quantity+' '+list[i].Unit+'</td>';
					sreachList += '<td>'+(list[i].MonthTasks == null?'':list[i].MonthTasks)+'</td>';
					sreachList += '<td>'+(list[i].Percentage == null?'':list[i].Percentage)+'</td>';
					sreachList += '</tr>';
				}
			}
			sreachList +='</tbody>';
		}else{
			sreachList = '<tr><td>没有数据!</td><td></td></tr>';
		}
		$('#sreachList').html(sreachList);
	},'JSON');

}

//日汇总
function historyList(inDate,inMonth){

	var params1 = localStorage.getItem('params1');
    params1 = JSON.parse(params1);

    var postData = {
    	sreach:'1',
    	mobile:params1.mobile,
    	inDate:inDate,
    	inMonth:inMonth
    }
    
    var sreachList = '';

	$.post(HttpUrl+'/main/history/', postData, function(data) {



		if(data.lists != ''){
			var list = data.lists.ReportList;
			var DataDate = data.lists.DataDate;

			sreachList += '<caption>上报日期:'+DataDate+'</caption>';
//<th>计划量</th><th>完成比例</th>
			sreachList += '<thead><tr><th>名称</th><th>数量</th></tr></thead><tbody>';
			if(data.lists.ReportList){
				for(i in list){
					sreachList += '<tr><td>'+list[i].CateGoryName+'</td>';
					sreachList += '<td>'+list[i].Quantity+' '+list[i].Unit+'</td>';
					//sreachList += '<td>'+(list[i].MonthTasks == null?'':list[i].MonthTasks)+'</td>';
					//sreachList += '<td>'+(list[i].Percentage == null?'':list[i].Percentage)+'</td>';
					sreachList += '</tr>';
				}
			}
			sreachList +='</tbody>';
		}else{
			sreachList = '<tr><td>没有数据!</td><td></td></tr>';
		}
		$('#sreachList').html(sreachList);
	},'JSON');

}

//上报资料页面========================================================================


$(function () {

  //初始化输入框
	var dataPostStorage = localStorage.getItem('dataPost');
	dataPostStorage =JSON.parse(dataPostStorage);

	// console.log(dataPostStorage);

	// var params1 = localStorage.getItem('params1');
	// params1 = JSON.parse(params1);


	// var myDate = new Date();
	// var year = myDate.getFullYear();
	// var month = myDate.getMonth()+1;

	// month = month < 10 ? '0'+month : month;
	// var dates = myDate.getDate();

	// year = year.toString();
	// month = month.toString();


	// var postData = {
	// 	mobile:params1.mobile,
	// 	inMonth:0
	// }



	// var MonthTasks = '';
	// var Quantity = '';
	// var Percentage = '';
	// $.post(HttpUrl+'/main/summary/', postData, function(data) {


	// 	if(data.data[0]){
	// 		var lists = data.data[0].ReportList;
	// 		console.log(lists)

	// 		for(i in lists)
	// 		{
	// 			if(lists[i].CateGoryName == '营业额'){
	// 				MonthTasks = lists[i].MonthTasks;
	// 				Quantity = lists[i].Quantity;
	// 				Percentage = lists[i].Percentage;
	// 			}
	// 		}

	// 		var  day = new Date(year,month,0);
	// 		var daycount = day.getDate();//当月天数

	// 		var dayer = MonthTasks / daycount;

	// 		var showTitleHtml = '';
	// 		showTitleHtml += '<tr><td><b>大区：</b>'+dataPostStorage.RegoinalName+'</td>';
	// 		showTitleHtml += '<td><b>片区：</b>'+dataPostStorage.SliceName+'</td>';
	// 		showTitleHtml += '</tr><tr><td><b>片区经理：</b>'+dataPostStorage.SliceManagerName+'</td>';
	// 		showTitleHtml += '<td><b>月任务：</b>'+MonthTasks+'</td></tr>';
	// 		showTitleHtml += '<tr><td><b>日均任务：</b>'+dayer.toFixed(2)+'</td><td><b>每日达成：</b>'+Percentage+'</td></tr>';
	// 		showTitleHtml += '<tr><td colspan="2"><b>当前实际完成：</b>'+Quantity+'</td><td></td></tr>';
	// 	}else{
	// 		showTitleHtml +='';
	// 	}

	// 	$('#show_title').html(showTitleHtml);
	// },'JSON');

  var PowerList = dataPostStorage.PowerList;

  var HTML = '';
  for(x in PowerList){
    HTML +='<div class="input-group">';
    HTML +='<span class="input-group-addon">'+PowerList[x].PowerName+'：</span>';
    HTML +='<input type="Number" id="info'+PowerList[x].PowerID+'" class="form-control">';
    HTML +=' <span class="input-group-addon">'+PowerList[x].PowerUnit+'</span>';
    HTML +='</div><br>';
  }
  $('#info_list').html(HTML);

  $('#save_info').click(function(event) {

  	var params = {};
    var areaInfo = [{}];
    for(i in PowerList){
        areaInfo[i] = {
          'cateGoryID':PowerList[i].PowerID,
          'value':$('#info'+PowerList[i].PowerID).val()
        }
    }

    var params1 = localStorage.getItem('params1');
    params1 = JSON.parse(params1);

    params.data = areaInfo;
    params.inDataDate = $('#datetimepicker1').val();
    params.mobile = params1.mobile;

    $.post(HttpUrl+'/main/ajax_infoSave',params,function(data){
    	console.log(data);

      if(data.info.CustomStatus == 10){
       	alert(data.info.CustomMessage);
       	window.location.href=data.jumpUrl;
      }else{
      	alert(data.info.CustomMessage);
        return false;
      }
    },'json');

  });



  //时间插件
  $('#datetimepicker1').datetimepicker({
      format: 'YYYYMMDD',
      locale: moment.locale('zh-cn')
  });
  $('#datetimepicker2').datetimepicker({
      format: 'YYYYMM',
      locale: moment.locale('zh-cn')
  });

});




//登录页面========================================================================

//初始化
$(function(){
	
	var paramsStorage = localStorage.getItem('params1');
	if(paramsStorage != null){
		var paramsStorage =JSON.parse(paramsStorage);
		$('#card').val(paramsStorage.card);
		$('#mobile').val(paramsStorage.mobile);
	}
	});

	//获取验证码
	$('#getcode').click(function(event) {
		var mobile = $('#mobile').val();
	
		if(mobile.length != 11){
			alert('请输入正确的手机号码！');
			return false;
		}
		var params = {
				mobile:mobile
				}
		$('#getcode').html('发送中');
		$.post(HttpUrl+'/login/sendSMS',params,function(data){
		
			if(data.CustomStatus == 10){
				$('#getcode').attr('disabled', true);
				var num = 60;
				var gettime = setInterval(function() {
						if (num <= 1) {
							clearInterval(gettime);
							$('#getcode').attr('disabled', false);
							$('#getcode').html('重新验证码');
						} else {
							num -= 1;
							$('#getcode').html(num + '秒');
						}
					}, 1000);
			}else{
				$('#getcode').attr('disabled', false);
				$('#getcode').html('重新验证码');
				alert(data.CustomMessage);
				return false;
			}
		},'json');

		
	});

	//登录
	$('#loginBtn').click(function(){
		var mobile = $('#mobile').val();
		var code   = $('#code').val();

		if(mobile.length != 11){
			alert('请输入正确的手机号码！');
			return false;
		}
		if(code == ''){
			alert('请输入验证码！');
			return false;
		}

		//验证码是否正确
		var params = {
				mobile:mobile,
				code:code
			}
		localStorage.setItem('params1',JSON.stringify(params));
		$('#loginBtn').attr('disabled', true);
		$('#loginBtn').html('登录中..');
		$.post(HttpUrl+'/login/isSendSMS',params,function(data){
			console.log(data);
			localStorage.setItem('dataPost',JSON.stringify(data));
			if(data.CustomStatus == 10){
				window.location.href = HttpUrl+"/main/index/"+params.mobile;
				$('#loginBtn').attr('disabled', true);
				$('#loginBtn').html('登录成功');
			}else{
				$('#loginBtn').attr('disabled', false);
				$('#loginBtn').html(' 登 录 ');
				alert(data.CustomMessage);
				return false;
			}
		},'json');

		

	});

	

/* 获取下一题 */
function fetchNext(){
	var itemid = current + 1;
	current = current + 1;
	if(current>topSub){
		current = current - 1;
		alert("已经是最后一题了吆！");
		return ;
	}

	/* 更新做题数量cookie值 */
	$.cookie('pr_order_num_' + sub ,current,{expires:365,path:'/'});	
	$.post("exec/takesub.exec.php",	  //Ajax 提交
			{
				subject:sub,
				type:"order",
				id:itemid
			},
	 		function(result){
				updatePage(result);
			}
	 );
}

/* 获取前一题 */
function fetchPrev(){
	var itemid = current - 1;
	current = current - 1;
	if(current==0){
		current = current + 1;
		alert("已经是第一题了吆！");
		return ;
	}
	$.post("exec/takesub.exec.php",
			{
				subject:sub,
				type:"order",
				id:itemid
			},
	 		function(result){
				updatePage(result);
			}
	 );
}

/* 随机获取一题 */
function fetchRandom(){
	$.post("exec/takesub.exec.php",
			{
				subject:sub,
				type:"random",
			},
	 		function(result){
				updatePage(result);
			}
	 );
}

function fetchSpNext(){
	var itemid = current + 1;
	current = current + 1;
	if(current>topSub){
		current = current - 1;
		alert("已经是最后一题了吆！");
		return ;
	}

	$.post("exec/takesub.exec.php",	  //Ajax 提交
			{
				subject:sub,
				type:"special",
				category:window.location.href.split('=')[2],
				id:itemid
			},
	 		function(result){
				updatePage(result);
			}
	 );
}

function fetchSpPrev(){
	var itemid = current - 1;
	current = current - 1;
	if(current==0){
		current = current + 1;
		alert("已经是第一题了吆！");
		return ;
	}
	$.post("exec/takesub.exec.php",
			{
				subject:sub,
				type:"special",
				category:window.location.href.split('=')[2],
				id:itemid
			},
	 		function(result){
				updatePage(result);
			}
	 );
}

/* 更新页面 */
function updatePage(result){
	/* 隐藏上一题的答题结果与题目解释 */
	$('#result')[0].style.display = "none";
	$('#explain')[0].style.display = "none";
	$('#explain')[0].style.maxHeight = "0px";

	/* 恢复单选按钮的状态 */
	for(var i=0;i<6;i++){
		$('input')[i].disabled = false;
	}
	for(var i=0;i<6;i++){
		$('input')[i].checked = false;
	}

	/* 从json中获取题目的详细信息 */
	var id = $("#bookmark")[0];
	var category = $('.describe')[0];
	var question = $('#question')[0];
	var analyse = $('#explain_content')[0];
	var option1 = $('label')[0];
	var option2 = $('label')[1];
	var option3 = $('label')[2];
	var option4 = $('label')[3];
	var answer = $('p#answer')[0];
	var iframe = $('iframe')[0];

	/* 更新页面元素的值 */
	if(type!="专项练习")   // 更新题号
		id.dataset.content = result['id'] + "/" + topSub;
	else
		id.dataset.content = current +  "/" + topSub;
    switch(result['category']){
      case "cat1":category.innerText = "距离题"; break;
      case "cat2":category.innerText = "罚款题"; break;
      case "cat3":category.innerText = "速度题"; break;
      case "cat4":category.innerText = "标线题"; break;
      case "cat5":category.innerText = "标志题"; break;
      case "cat6":category.innerText = "手势题"; break;
      case "cat7":category.innerText = "记分题"; break;
      case "cat8":category.innerText = "灯光题"; break;
      case "cat9":category.innerText = "仪表题"; break;
      case "cat10":category.innerText = "路况题"; break;
    }	
	question.innerText = result['question'];
	analyse.innerText = result['analyse'];
	answer.innerText = result['answer'];

	/* 设置页面中可能出现的媒体 */
	if(result['urlImg']){
		iframe.src = result['urlImg'];
	}else if(result['urlVideo']){
		iframe.src = result['urlVideo'];
	}else{
		iframe.src = "";
	}

	/* 显示题目 */
	if(result['genre']=="C"){		//选择题
		/* 将判断题隐藏 */
		$('.judge')[0].style.display = "none";
		$('.judge')[1].style.display = "none";

		option1.innerText = result['rA'];
		option2.innerText = result['rB'];
		option3.innerText = result['rC'];
		option4.innerText = result['rD'];
		for(var i=0;i<4;i++){
			$('.choose')[i].style.display = "block";
		}
	}else{		// 判断题
		/* 将选择题隐藏 */
		$('.judge')[0].style.display = "block";
		$('.judge')[1].style.display = "block";
		for(var i=0;i<4;i++){
			$('.choose')[i].style.display = "none";
		}
	}
}

/* 审批答题结果 */
function approval(ans){
	var answer = $('p#answer')[0];
	var result = $('#result')[0];

	/* 判断是否回答正确 */
	if(answer.innerText == ans){
		result.style.backgroundColor = "#00CC66";
		result.innerText = "恭喜您，答对了！";
		addCorrect();

		if($('#autonext')[0].checked == true){  // 自动跳转下一题
			if(type=="顺序练习")
				setTimeout(fetchNext,1500);
			else if(type=="随机练习")
				setTimeout(fetchRandom,1500);
			else
				setTimeout(fetchSpNext,1500);
		}

	}else{
		result.style.backgroundColor = "#CC0000";
		result.innerText = "答错了,正确答案是" + answer.innerText;
		addImproper();
	}

	/* 设置单选按钮的状态为禁止选择 */
	for(var i=0;i<6;i++){
		$('input')[i].disabled = true;
	}

	/* 显示结果 */
	$('#result')[0].style.display = "block";  
	$('#explain')[0].style.display = "block";
	$('#explain')[0].style.maxHeight = "1000px";
}

function addCorrect(){  		// 统计答对的数量
 	correct = correct + 1 ;
 	rate  = correct/(correct + improper) 
	$('.stst')[0].innerText = correct;
	$('.stst')[2].innerText = Math.floor(rate*100) + "%";
}

function addImproper(){			// 统计答错的数量
 	improper =  improper + 1;
 	rate  = correct/(correct + improper) 
 	$('.stst')[1].innerText = improper;
 	$('.stst')[2].innerText = Math.floor(rate*100) + "%";
}
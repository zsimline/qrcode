function submitItemC(){
	var formdata = new FormData();

	formdata.append("genre","C");
	formdata.append("c_subject", $("#c_subject")[0].value);
	formdata.append("c_category", $("#c_category")[0].value);
	formdata.append("c_question", $("#c_question")[0].value);
	formdata.append("c_explain", $("#c_explain")[0].value);
	formdata.append("c_optionA", $("#c_optionA")[0].value);
	formdata.append("c_optionB", $("#c_optionB")[0].value);
	formdata.append("c_optionC", $("#c_optionC")[0].value);
	formdata.append("c_optionD", $("#c_optionD")[0].value);
	formdata.append("c_answer", $("#c_answer")[0].value);
	formdata.append("c_img", $("#c_img")[0].files[0]);
	formdata.append("c_video", $("#c_video")[0].files[0]);

	$.ajax({
            url:"exec/insertitem.exec.php",
            type:"post",
            data:formdata,
            processData:false,
            contentType:false,
            success:function(data){
                 alert("提交题目成功");
             	$("#c_subject")[0].value = "1";
            	$("#c_category")[0].value = "cat1";
            	$("#c_question")[0].value = "";
            	$("#c_explain")[0].value = "";
            	$("#c_optionA")[0].value = "";
            	$("#c_optionB")[0].value = "";
            	$("#c_optionC")[0].value = "";
            	$("#c_optionD")[0].value = "";
            	$("#c_answer")[0].value = "A";
            	$("#c_img")[0].value = "";
            	$("#c_video")[0].value = "";
            }
	});
}

function submitItemJ(){
	var formdata = new FormData();

	formdata.append("genre","J");
	formdata.append("j_subject", $("#j_subject")[0].value);
	formdata.append("j_category", $("#j_category")[0].value);
	formdata.append("j_question", $("#j_question")[0].value);
	formdata.append("j_explain", $("#j_explain")[0].value);
	formdata.append("j_answer", $("#j_answer")[0].value);
	formdata.append("j_img", $("#j_img")[0].files[0]);
	formdata.append("j_video", $("#j_video")[0].files[0]);

	$.ajax({
            url:"exec/insertitem.exec.php",
            type:"post",
            data:formdata,
            processData:false,
            contentType:false,
            success:function(data){
                 alert("提交题目成功");
              	 $("#j_subject")[0].value = "1";
            	 $("#j_category")[0].value = "cat1";
            	 $("#j_question")[0].value = "";
            	 $("#j_explain")[0].value = "";
            	 $("#j_answer")[0].value = "T";
            	 $("#j_img")[0].value = "";
            	 $("#j_video")[0].value = "";
            }
	});
}

function deleteItem(arg,subject,id){
	if(confirm("是否要删除该题目？该操作不可逆转！")){
	
	var formdata = new FormData();
	formdata.append("subject", subject);
	formdata.append("id", id);
	
	$.ajax({
        url:"exec/deleteitem.exec.php",
        type:"post",
        data:formdata,
        processData:false,
        contentType:false,
        success:function(data){
        	arg.parentElement.style.display = "none";
            alert("删除题目成功");
        }
   });
  }
}


function showUpdateInfo(arg,subject,id){
	var agenre = new Array();
		agenre['选择题'] = "C";
		agenre['判断题'] = "J";
		
    var carray = new Array();
    	carray['距离题'] = "cat1";
    	carray['罚款题'] = "cat2";
    	carray['速度题'] = "cat3";
    	carray['标线题'] = "cat4";
    	carray['标志题'] = "cat5";
    	carray['手势题'] = "cat6";
    	carray['记分题'] = "cat7";
    	carray['灯光题'] = "cat8";
    	carray['仪表题'] = "cat9";
    	carray['路况题'] = "cat10";

	var par = arg.parentElement;
	$('#q_id')[0].value = par.children[1].innerText;
	$('#q_genre')[0].value = agenre[par.children[3].innerText];
	$('#q_category')[0].value = carray[par.children[5].innerText];
	$('#q_answer')[0].value = par.children[7].innerText;
	$('#q_question')[0].value = par.children[8].children[1].innerText;
	$('#q_optionA')[0].value = par.children[9].children[1].innerText;
	$('#q_optionB')[0].value = par.children[9].children[3].innerText;
	$('#q_optionC')[0].value = par.children[9].children[5].innerText;
	$('#q_optionD')[0].value = par.children[9].children[7].innerText;
	$('#q_analyse')[0].value = par.children[10].children[1].innerText
	
	$('#update')[0].style.display = 'block';
}

function updateItem(subject){    	
    	var formdata = new FormData();
    	
    	formdata.append("q_subject",subject);
    	formdata.append("q_id",$('#q_id')[0].value);
    	formdata.append("q_genre",$('#q_genre')[0].value);
    	formdata.append("q_category",$('#q_category')[0].value);
    	formdata.append("q_answer",$('#q_answer')[0].value);
    	formdata.append("q_question",$('#q_question')[0].value);
    	formdata.append("q_optionA",$('#q_optionA')[0].value);
    	formdata.append("q_optionB",$('#q_optionB')[0].value);
    	formdata.append("q_optionC",$('#q_optionC')[0].value);
    	formdata.append("q_optionD",$('#q_optionD')[0].value);
    	formdata.append("q_analyse",$('#q_analyse')[0].value);
    	formdata.append("q_img", $("#q_img")[0].files[0]);
    	formdata.append("q_video", $("#q_video")[0].files[0]);
    	
    	$.ajax({
            url:"exec/updateitem.exec.php",
            type:"post",
            data:formdata,
            processData:false,
            contentType:false,
            success:function(data){
                 alert("修改题目成功");
                 location.reload();
            }
    	});
}

function deleteUser(arg,userid){
	if(confirm("是否要删除该用户？该操作不可逆转！")){
	
	var formdata = new FormData();
	formdata.append("userid", userid);
	
	$.ajax({
        url:"exec/deleteuser.exec.php",
        type:"post",
        data:formdata,
        processData:false,
        contentType:false,
        success:function(data){
        	arg.parentElement.style.display = "none";
            alert("删除用户成功");
        }
   });
  }
}

function showUpdateUserInfo(arg,id){
	var par = arg.parentElement;
	$('#u_id')[0].value = par.children[1].innerText;
	$('#u_name')[0].value = par.children[3].innerText;
	$('#u_pwd')[0].value = par.children[5].innerText;
	$('#u_email')[0].value = par.children[7].innerText;
	$('#update')[0].style.display = 'block';
}

function updateUser(){    	
    	var formdata = new FormData();
    	formdata.append("userid",$('#u_id')[0].value);
    	formdata.append("username",$('#u_name')[0].value);
    	formdata.append("password",$('#u_pwd')[0].value);
    	formdata.append("email",$('#u_email')[0].value);
    	
    	$.ajax({
            url:"exec/updateuser.exec.php",
            type:"post",
            data:formdata,
            processData:false,
            contentType:false,
            success:function(data){
                 alert("修改用户成功");
                 location.reload();
            }
    	});
}

function closeInfo(){
	$('#update')[0].style.display = "none";
}





















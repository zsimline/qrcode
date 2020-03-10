function exit(){
	$.cookie('userid', '', { expires: -1 , path:'/'});
	$.cookie('identification', '', { expires: -1 , path:'/'});
	$.cookie('pr_order_num_1', '', { expires: -1 , path:'/'});
	$.cookie('pr_order_num_1', '', { expires: -1 , path:'/'});
	window.location.href = '/DrivingTest/user/login.php';
}
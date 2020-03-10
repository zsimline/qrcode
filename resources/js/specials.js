window.onload = function(){		// 同步cookie值
	if(typeof($.cookie('pr_order_num_1'))=="undefined"){  // 如果cookie值不存在，刷新页面重设cookie值
		location.reload();
	}else{
		/* 全局变量的设置 */
		sub = window.location.href.split('=')[1].split('&')[0];		//  科目
		type = $('#type')[0].innerText;		//类型
		current = 1;  // 当前题号
		topSub = parseInt($('#bookmark')[0].dataset.content.split('/')[1])   // 题目数量最大值
		correct = 0 ; 	// 答对的数量
		improper = 0 ;  // 答错的数量
		rate = 0 ;		// 正确率

		$("#bookmark")[0].dataset.content = current + "/" + $("#bookmark")[0].dataset.content.split('/')[1];
	}
};
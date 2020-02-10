$(document).ready(function(){

	$(".re_bt").click(function(){
		var params = $("form").serialize();
				$.ajax({
					type: 'post',
					url: 'reply_ok.php?=<?php echo $board["idx"]; ?>',
					data : params,
					dataType : 'html',
					success: function(data){
						$(".reply_view").html(data);
						$(".reply_content").val('');
					}
				});
			});

$("#rep_bt").click(function(){
		$.post("reply_ok.php",{
						bno:$(".bno").val(),
						content:$(".reply_content").val(),
					},
					function(data,success){
						if(success=="success"){
							$(".reply_view").html(data);
							alert("댓글이 작성되었습니다");
						}else{
							alert("댓글작성이 실패되었습니다");
						}
					});
				});

$(".dat_edit_bt").click(function(){
	/* dat_edit_bt클래스 클릭시 동작(댓글 수정) */
		var obj = $(this).closest(".dap_lo").find(".dat_edit");
		obj.dialog({
			modal:true,
			width:650,
			height:200,
			title:"댓글 수정"});

	});

$(".dat_delete_bt").click(function(){
	/* dat_delete_bt클래스 클릭시 동작(댓글 삭제) */
	var obj = $(this).closest(".dap_lo").find(".dat_delete");
	obj.dialog({
		modal:true,
		width:400,
		title:"댓글 삭제확인"});
	});

});
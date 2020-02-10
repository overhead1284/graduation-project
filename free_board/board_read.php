<?php
	include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */
	session_start();
	if(isset($_SESSION['ID'])){
		echo " <span class=\"login\">";
		echo $_SESSION['ID'];
		echo " 님 환영합니다.</span>";
		echo " <span class=\"login\"><a href=/user/logout.php>로그아웃</a></span>";
		echo " <span class=\"login\"><a href=/user/update-user.php>정보 수정</a></span>";
	}
	else{
		echo " <span class=\"login\"><a href=/login2.html>로그인</a></span>";
		echo " <span class=\"login\"><a href=/signup2.html>회원가입</a></span>";
	}
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="/css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="/css/style.css?afterr" />

<script type="text/javascript" src="/scripts/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/scripts/jquery-ui.js"></script>
<script type="text/javascript" src="/scripts/common.js"></script>


</head>
<body>
	<?php
		$bno = $_GET['idx']; /* bno함수에 idx값을 받아와 넣음*/
		$hit = mysqli_fetch_array(mq("select * from board where idx ='".$bno."'"));
		$hit = $hit['hit'] + 1;
		$fet = mq("update board set hit = '".$hit."' where idx = '".$bno."'");
		$sql = mq("select * from board where idx='".$bno."'"); /* 받아온 idx값을 선택 */
		$board = $sql->fetch_array();
	?>
<!-- 글 불러오기 -->
<div id="board_read">
	<h2><?php echo $board['title']; ?></h2>
		<div id="user_info">
			<?php echo $board['name']; ?> <?php echo $board['date']; ?> 조회:<?php echo $board['hit']; ?>
				<div id="bo_line"></div>
			</div>
			<div id="bo_content">
				<?php echo nl2br("$board[content]"); ?>
			</div>
	<!-- 목록, 수정, 삭제 -->
	<div id="bo_ser">
		<ul>
			<li><a href="/free_board/board_index.php">[목록으로]</a></li>
			<?php if(($_SESSION['ID'])==$board['name']){ ?>
			<li><a href="/free_board/board_modify.php?idx=<?php echo $board['idx']; ?>">[수정]</a></li>
			<li><a href="/free_board/board_delete.php?idx=<?php echo $board['idx']; ?>">[삭제]</a></li>
		<?php } ?>
		</ul>
	</div>
</div>

<!--- 댓글 불러오기 -->
<div id="foot_box"></div>
<div id="foot_box"></div>
<div class="reply_view">
	<h3>댓글목록</h3>
		<?php
			$sql3 = mq("select * from reply where con_num='".$bno."' order by idx desc");
			while($reply = $sql3->fetch_array()){
		?>
		<div class="dap_lo">
			<div><b><?php echo $reply['name'];?></b></div>
			<div class="dap_to comt_edit"><?php echo nl2br("$reply[content]"); ?></div>
			<div class="rep_me dap_to"><?php echo $reply['date']; ?></div>
			<?php if(($_SESSION['ID'])==$reply['name']){ ?>
			<div class="rep_me rep_menu">
				<a class="dat_edit_bt" href="#">수정</a>
				<a class="dat_delete_bt" href="#">삭제</a>
			</div>
			<?php } ?>
			<!-- 댓글 수정 폼 dialog -->

			<div class="dat_edit">
				<form method="post" action="reply_modify_ok.php">
					<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" /><input type="hidden" name="b_no" value="<?php echo $bno; ?>">
					<textarea name="content" class="dap_edit_t"><?php echo $reply['content']; ?></textarea>
					<input type="submit" value="수정하기" class="re_mo_bt">
				</form>
			</div>

			<!-- 댓글 삭제 비밀번호 확인 -->

			<div class='dat_delete'>
				<form action="reply_delete.php" method="post">
					<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" /><input type="hidden" name="b_no" value="<?php echo $bno; ?>">
			 		<p><input type="submit" value="확인"></p>
				 </form>
			</div>
		</div>
	<?php } ?>

	<!--- 댓글 입력 폼 -->
	<div class="dap_ins">
			<input type="hidden" name="bno" class="bno" value="<?php echo $bno; ?>">
			<h4 name="name"><?php echo $_SESSION['ID'] ?></h4>
			<div style="margin-top:10px; ">
				<textarea name="content" class="reply_content" id="re_content" ></textarea>
				<button id="rep_bt" class="re_bt">댓글</button>
			</div>
	</div>
</div><!--- 댓글 불러오기 끝 -->
<div id="foot_box"></div>


</body>
</html>

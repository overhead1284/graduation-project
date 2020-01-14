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
<link rel="stylesheet" type="text/css" href="/css/style.css" />
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
			<?php echo $board['name']; ?> <?php echo $_SESSION['ID']; ?>
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
			<li><a href="/free_board/modify.php?idx=<?php echo $board['idx']; ?>">[수정]</a></li>
			<li><a href="/free_board/delete.php?idx=<?php echo $board['idx']; ?>">[삭제]</a></li>
		<?php } ?>
		</ul>
	</div>
</div>
</body>
</html>

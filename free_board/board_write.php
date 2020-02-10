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
		echo " <span class=\"login\"><a href=/user/login2.html>로그인</a></span>";
		echo " <span class=\"login\"><a href=/user/signup2.html>회원가입</a></span>";
	}
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>
<body>
    <div id="board_write">
        <h1><a href="/free_board/board_index.php">자유게시판</a></h1>
        <h4>글 작성.</h4>
            <div id="write_area">
                <form action="/free_board/write_ok.php" method="post">
                    <div id="in_title">
                        <textarea name="title" id="utitle" rows="1" cols="30" placeholder="제목" maxlength="100" required></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_name">
                        <h3 name="name"><?php echo $_SESSION['ID'] ?></h3>
												<!--<h3 name="name" type="text" value=<?php //echo $_SESSION['ID'] ?> readonly="readonly"></h3>-->
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_content">
                        <textarea name="content" id="ucontent" placeholder="내용" required></textarea>
                    </div>
                    <div class="bt_se">
                        <button type="submit">글 작성</button>
                        <button type="reset">초기화</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

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
<link rel="stylesheet" type="text/css" href="/css/style.css" />

<link rel=stylesheet href="/codemirror-5.51.0/lib/codemirror.css">
<link rel=stylesheet href="/codemirror-5.51.0/doc/docs.css">
<link rel=stylesheet href="/codemirror-5.51.0/theme/dracula.css">
<link rel=stylesheet href="/codemirror-5.51.0/theme/darcula.css">
<script src="/codemirror-5.51.0/lib/codemirror.js"></script>
<script src="/codemirror-5.51.0/mode/xml/xml.js"></script>
<script src="/codemirror-5.51.0/mode/javascript/javascript.js"></script>
<script src="/codemirror-5.51.0/mode/css/css.js"></script>
<script src="/codemirror-5.51.0/mode/htmlmixed/htmlmixed.js"></script>

<script src="/codemirror-5.51.0/addon/edit/matchbrackets.js"></script>
<script src="/codemirror-5.51.0/addon/selection/active-line.js"></script>

<script src="/codemirror-5.51.0/doc/activebookmark.js"></script>


<title>게시판</title>

</head>
<body>
    <div id="board_write">
        <h4>글 작성.</h4>
            <div id="write_area">
                <form action="/free_board/write_ok.php" method="post">


                    <div id="in_content">


													<form style="position: relative; margin-top: .5em;">
													<textarea id=code> function findSequence(goal) {
  function find(start, history) {
    if (start == goal)
      return history;
    else if (start > goal)
      return null;
    else
      return find(start + 5, "(" + history + " + 5)") ||
             find(start * 3, "(" + history + " * 3)");
  }
  return find(1, "1");
}</textarea>
													</form>
													<script>
														var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
															lineNumbers: true,
															styleActiveLine: true,
															mode: "javascript",
															theme: "darcula",
															matchBrackets: true

														});


													</script>

                      <!--  <textarea name="content" id="ucontent" placeholder="내용" required></textarea>  -->
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

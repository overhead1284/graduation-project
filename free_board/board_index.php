<?php
  include  $_SERVER['DOCUMENT_ROOT']."/db.php";
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
  <!--
  <div id="write_btn">
    <a href="/signup2.html"><button>회원가입</button></a>
    <a href="/login2.html"><button>로그인</button></a>
  </div>
-->
<div id="board_area">
  <h1><a href="../index.html">메인 화면</a></h1>

  <h1>자유게시판</h1>
  <h4>자유게시판 제작중</h4>
    <table class="list-table">
      <thead>
          <tr>
              <th width="70">번호</th>
                <th width="500">제목</th>
                <th width="120">글쓴이</th>
                <th width="100">작성일</th>
                <th width="100">조회수</th>
                <th width="100">추천수</th>
            </tr>
        </thead>
        <?php
          $sql = mq("select * from board order by idx desc limit 0,10"); // board테이블에있는 idx를 기준으로 내림차순해서 5개까지 표시
            while($board = $sql->fetch_array())
            {
              $title=$board["title"];
              if(strlen($title)>30)
              {
                $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]); //title이 30을 넘어서면 ...표시
              }
        ?>
      <tbody>
        <tr>
          <td width="70"><?php echo $board['idx']; ?></td>
          <td width="500"><a href="board_read.php?idx=<?php echo $board["idx"];?>"><?php echo $title;?></a></td>
          <td width="120"><?php echo $board['name'];?></td>
          <td width="100"><?php echo $board['date'];?></td>
          <td width="100"><?php echo $board['hit']; ?></td>
          <td width="100"><?php echo $board['recmd']; ?></td>
        </tr>
      </tbody>
      <?php }?>
    </table>
    <div id="write_btn">
      <?php if(isset($_SESSION['ID'])){ ?>
      <a href="/free_board/board_write.php"><button>글쓰기</button></a>
    <?php } ?>
    </div>
  </div>
</body>
</html>

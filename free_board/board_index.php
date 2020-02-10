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
<link rel="stylesheet" type="text/css" href="/css/style.css?afterrr" />
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
          $sql4 = mq("select * from board where notice=1"); // board테이블에있는 idx를 기준으로 내림차순해서 5개까지 표시
            while($board = $sql4->fetch_array())
            {
              $title=$board["title"];
              if(strlen($title)>30)
              {
                $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]); //title이 30을 넘어서면 ...표시
              }
        ?>
      <tbody style="background:#EFFBFB;">
        <tr>
          <td width="70"><?php echo "공지" ?></td>
          <td width="500"><a href="board_read.php?idx=<?php echo $board["idx"];?>"><?php echo $title;?></a></td>
          <td width="120"><?php echo $board['name'];?></td>
          <td width="100"><?php echo $board['date'];?></td>
          <td width="100"><?php echo $board['hit']; ?></td>
          <td width="100"><?php echo $board['recmd']; ?></td>
        </tr>
      </tbody>
      <?php }?>

      <?php
      if(isset($_GET['page'])){
            $page = $_GET['page'];
              }else{
                $page = 1;
              }
                $sql = mq("select * from board");
                $row_num = mysqli_num_rows($sql); //게시판 총 레코드 수
                $list = 5; //한 페이지에 보여줄 개수
                $block_ct = 5; //블록당 보여줄 페이지 개수

                $block_num = ceil($page/$block_ct); // 현재 페이지 블록 구하기
                $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
                $block_end = $block_start + $block_ct - 1; //블록 마지막 번호

                $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
                if($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
                $total_block = ceil($total_page/$block_ct); //블럭 총 개수
                $start_num = ($page-1) * $list; //시작번호 (page-1)에서 $list를 곱한다.

                $sql2 = mq("select * from board order by idx desc limit $start_num, $list");
                while($board = $sql2->fetch_array()){
                $title=$board["title"];
                  if(strlen($title)>30)
                  {
                    $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
                  }
                  $sql3 = mq("select * from reply where con_num='".$board['idx']."'");
                  $rep_count = mysqli_num_rows($sql3);
                ?>

      <tbody>
        <tr>
          <td width="70"><?php echo $board['idx']; ?></td>
          <td width="500">
            <a href='/page/board/board_read.php?idx=<?php echo $board["idx"]; ?>'><?php echo $title,"&nbsp;"; ?><span class="re_ct">[<?php echo $rep_count; ?>]</span></a></td>
          <td width="120"><?php echo $board['name'];?></td>
          <td width="100"><?php echo $board['date'];?></td>
          <td width="100"><?php echo $board['hit']; ?></td>
          <td width="100"><?php echo $board['recmd']; ?></td>
        </tr>
      </tbody>
      <?php }?>
    </table>
    <div id="page_num">
      <ul>
        <?php
          if($page <= 1)
          { //만약 page가 1보다 크거나 같다면
            echo "<li class='fo_re'>처음</li>"; //처음이라는 글자에 빨간색 표시
          }else{
            echo "<li><a href='?page=1'>처음</a></li>"; //알니라면 처음글자에 1번페이지로 갈 수있게 링크
          }
          if($page <= 1)
          { //만약 page가 1보다 크거나 같다면 빈값

          }else{
          $pre = $page-1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
            echo "<li><a href='?page=$pre'>이전</a></li>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
          }
          for($i=$block_start; $i<=$block_end; $i++){
            //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
            if($page == $i){ //만약 page가 $i와 같다면
              echo "<li class='fo_re'>[$i]</li>"; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
            }else{
              echo "<li><a href='?page=$i'>[$i]</a></li>"; //아니라면 $i
            }
          }
          if($block_num >= $total_block){ //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
          }else{
            $next = $page + 1; //next변수에 page + 1을 해준다.
            echo "<li><a href='?page=$next'>다음</a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
          }
          if($page >= $total_page){ //만약 page가 페이지수보다 크거나 같다면
            echo "<li class='fo_re'>마지막</li>"; //마지막 글자에 긁은 빨간색을 적용한다.
          }else{
            echo "<li><a href='?page=$total_page'>마지막</a></li>"; //아니라면 마지막글자에 total_page를 링크한다.
          }
        ?>
      </ul>
    </div>

    <div id="write_btn">
      <?php if(isset($_SESSION['ID'])){ ?>
      <a href="/free_board/board_write.php"><button>글쓰기</button></a>
    <?php } ?>
    </div>
  </div>
</body>
</html>

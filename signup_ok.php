<?php

include $_SERVER['DOCUMENT_ROOT']."/db.php";

$connect = new mysqli("localhost","pjs7160","parkis1101","board_db");
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);

$num=0;

$sql = "insert into user(user_id,user_pw,email) values('".$_POST['name']."','".$userpw."','".$_POST['email']."')";
$result = $connect->query($sql);

if($result){?>
  <script type="text/javascript">alert("회원가입 완료");</script>
  <meta http-equiv="refresh" content="0 url=/free_board/board_index.php" />
<?php
}
else{
  echo "FAIL";
}

?>

<!--<script type="text/javascript">alert("글쓰기 완료되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=/board_index.php" />-->

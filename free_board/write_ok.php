<?php

include $_SERVER['DOCUMENT_ROOT']."/db.php";
session_start();
$connect = new mysqli("localhost","pjs7160","parkis1101","board_db");
//$db = new mysqli("localhost","pjs7160","parkis1101","board_db");

$date = date('Y-m-d');

$name = $_SESSION['ID'];
$title = $_POST['title'];
$content = $_POST['content'];
$num=0;



$sql = "insert into board(name,title,content,date,hit,recmd) values('".$_SESSION['ID']."','".$_POST['title']."','".$_POST['content']."','".$date."','0','0')";

$result = $connect->query($sql);
if($result){?>
  <script type="text/javascript">alert("글쓰기 완료");</script>
  <meta http-equiv="refresh" content="0 url=/free_board/board_index.php" />
<?php
}
else{
  echo "FAIL";
}

?>

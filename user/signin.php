<?php
include  $_SERVER['DOCUMENT_ROOT']."/db.php";
session_start();
$id = $_POST['id'];
$pw = $_POST['pw'];

$connect = mysqli_connect("localhost","pjs7160","parkis1101","board_db");
$sql = "select * from user where user_id = '$id'";

$result = mysqli_query($connect, $sql);
$member = mysqli_num_rows($result);
  if($member == 1){
    $row = mysqli_fetch_array($result);
    if(password_verify($pw, $row['user_pw'])){
      $_SESSION['ID'] = $id;
      if(isset($_SESSION['ID'])){
        header('Location: ../index.html');
      }
      else{
         echo "<script>
            alert(\"세션 저장 실패\");
            history.back();
         </script>";
      }
    }
    else{
      echo "<script>
         alert(\"비밀번호가 틀렸습니다.\");
         history.back();
      </script>";
    }
  }
  else{
    echo "<script>
       alert(\"$id\");
       history.back();
    </script>";
  }
?>

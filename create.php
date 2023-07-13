<?php
// var_dump($_POST);
// exit();  

// 各種項目設定
$dbn ='mysql:dbname=sllev_db;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';  //毎回同じ  サーバー使う時はサーバー側から指示あり
$pwd = ''; //毎回同じ

try {
  $pdo = new PDO($dbn, $user, $pwd);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // ユーザーのニックネームを取得
  $username = $_POST['username'];

  // ユーザーの回答をデータベースに保存
  $query = "INSERT INTO user_responses (username) VALUES (?)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$username]);

  // 保存されたデータのIDを取得
  $responseId = $pdo->lastInsertId();

  // home1.phpを表示し、home2_read.phpを実行するリダイレクト
  header("Location: home1.php?responseId=$responseId");
  exit();
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}
?>


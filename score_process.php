<?php
session_start();

$dbn ='mysql:dbname=sllev_db;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
  $pdo = new PDO($dbn, $user, $pwd);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // ユーザーの回答を取得
  $userAnswers = json_decode($_POST['userAnswers'], true);

  // デバッグ用コード
  var_dump($_SESSION['user_id']); // これが存在し、かつ整数であること
  var_dump($userAnswers); // これが配列であること

  // ユーザーの回答をデータベースに保存
  foreach ($userAnswers as $answer) {
    // デバッグ用コード
    var_dump($answer); // これが配列であること
    $query = "INSERT INTO scores_table (user_id, question_id, option_id, score) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['user_id'], $answer['question_id'], $answer['option_id'], $answer['score']]);
  }

  // 保存が完了したら、適当なページにリダイレクト（ここでは例としてhome1.phpにリダイレクト）
  header("Location: home1.php");
  exit();
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}
?>

<?php
session_start();

// 以下は create.php と同じ設定を使います
$dbn ='mysql:dbname=sllev_db;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';


try {
  $pdo = new PDO($dbn, $user, $pwd);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// 現在のカテゴリIDを取得または設定
$category_id = isset($_SESSION['category_id']) ? $_SESSION['category_id'] : 1;

// 質問と選択肢を取得するクエリを実行
$stmt = $pdo->prepare("SELECT * FROM questions_table WHERE category_id = ?");
$stmt->execute([$category_id]);
$questions = $stmt->fetchAll();

// 選択肢を取得するクエリを実行
$stmt = $pdo->prepare("SELECT * FROM options_table WHERE question_id IN (SELECT question_id FROM questions_table WHERE category_id = ?)");
$stmt->execute([$category_id]);
$options = $stmt->fetchAll();

} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

// 次のカテゴリIDをセッションに保存
$_SESSION['category_id'] = $category_id + 1;

// スコアの取得と表示
if (isset($_SESSION['totalScore'])) {
    echo "合計スコア: " . $_SESSION['totalScore'];
}


// 以下にHTMLを出力します
// ...
?>

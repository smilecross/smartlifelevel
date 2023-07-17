<?php
session_start();
//  var_dump($_POST);
// exit(); 

$dbn ='mysql:dbname=sllev_db;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
    $pdo = new PDO($dbn, $user, $pwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // user_idをセッションから取得（ログイン処理などでセッションに保存されていることを前提としています）
    $user_id = $_SESSION['user_id'];

    // $_POSTから回答データを取得
    $userAnswers = json_decode($_POST['userAnswers'], true); // <-- JSONをPHPの配列に変換します

    // 回答データをデータベースに保存
    foreach ($userAnswers as $answer) {
        // SQL文を準備
        $sql = "INSERT INTO scores_table (user_id, category_id, question_id, option_id, score, created_at, updated_at) 
                VALUES (:user_id, :category_id, :question_id, :option_id, :score, NOW(), NOW())";

        // SQL文を実行
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':category_id', $answer['category_id']);
        $stmt->bindParam(':question_id', $answer['question_id']);
        $stmt->bindParam(':option_id', $answer['option_id']);
        $stmt->bindParam(':score', $answer['score']);
        $stmt->execute();
    }

    // 結果表示ページへリダイレクト
    header('Location: result.php');
    exit();
    
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}

?>

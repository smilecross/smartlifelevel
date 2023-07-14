<?php
session_start();

$dbn ='mysql:dbname=sllev_db;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
    $pdo = new PDO($dbn, $user, $pwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_SESSION['username']) && isset($_GET['responseId'])) {
        // Get the response ID from the URL
        $responseId = $_GET['responseId'];

        // Query the database for the corresponding username
        $stmt = $pdo->prepare("SELECT username FROM user_responses WHERE id = ?");
        $stmt->execute([$responseId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set the username in the session
        $_SESSION['username'] = $result['username'];
    }

    // クエリの実行
    $query = $pdo->query('SELECT * FROM questions_table');
    $result = $query->fetchAll();

    $question_options = array();

    foreach ($result as $row) {
      if ($row['category_id'] == 1) {

        // 質問に対応する選択肢を取得
        $stmt = $pdo->prepare("SELECT * FROM options_table WHERE question_id = ?");
        $stmt->execute([$row['question_id']]);
        $options = $stmt->fetchAll();

        $question_options[$row['question_text']] = $options;
      }
    }

} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}

?>
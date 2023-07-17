<?php
header('Content-Type: application/json');
session_start();

//  var_dump($_POST);
// exit(); 

$dbn ='mysql:dbname=sllev_db;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
    $pdo = new PDO($dbn, $user, $pwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_SESSION['username']) && isset($_GET['user_id'])) {
        // Get the response ID from the URL
        $user_id = $_GET['user_id'];

        // Query the database for the corresponding username
        $stmt = $pdo->prepare("SELECT username FROM users_table WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set the username in the session
        $_SESSION['username'] = $result['username'];
    
    if (!isset($_SESSION['username'])) {
    die("Username not found in session. Please login first.");
}

    
    }

     // クエリの実行
    $query = $pdo->query('SELECT category_id, question_id, question_text FROM questions_table');
    $result = $query->fetchAll();

    $question_options = array();

    foreach ($result as $row) {

        // 質問に対応する選択肢を取得
        $stmt = $pdo->prepare("SELECT question_id,option_text,score FROM options_table WHERE question_id = ?");
        $stmt->execute([$row['question_id']]);
        $options = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // $options = $stmt->fetchAll();

        // カテゴリー、質問、回答、スコアの4項目だけ取得
        $question_options[$row['question_text']] = array(
            'category' => $row['category_id'],
            'question' => $row['question_text'],
            'options' => $options,
        );
    }

    //  var_dump($question_options);

} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}

// JSON形式で出力
echo json_encode($question_options, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>


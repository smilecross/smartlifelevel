<?php
session_start();

$dbn ='mysql:dbname=sllev_db;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
    $pdo = new PDO($dbn, $user, $pwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // user ID を取得
    $userId = $_SESSION['user_id']; // 更新して、認証システムからユーザーIDを取得する。

    // 最初のアクセスであるか、「次へ」ボタンがクリックされた場合、
    // セッションに保存されている現在のカテゴリーIDを追加。
    if (!isset($_SESSION['currentCategory']) || isset($_POST['next'])) {
        $_SESSION['currentCategory'] = isset($_SESSION['currentCategory']) ? $_SESSION['currentCategory'] + 1 : 1;
    }

    $currentCategoryId = $_SESSION['currentCategory'];

    if ($currentCategoryId <= 6) {
        // 現在のカテゴリの質問と回答を取得する
        $stmt = $pdo->prepare("SELECT q.question_id, q.question_text, q.category_id, o.option_text, o.option_id, o.score
                              FROM questions_table q
                              JOIN options_table o ON q.question_id = o.question_id
                              WHERE q.category_id = :categoryId
                              ORDER BY q.question_id");
        $stmt->execute(['categoryId' => $currentCategoryId]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $currentQuestion = '';
        foreach ($results as $row) {
            if ($currentQuestion !== $row['question_text']) {
                if ($currentQuestion !== '') {
                    echo '</fieldset>';
                }
                $currentQuestion = $row['question_text'];
                echo '<fieldset>';
                echo '<legend>' . $currentQuestion . '</legend>';
            }

            echo "<input type='radio' name='answer[" . $row['question_id'] . "]' value='" . $row['option_id'] . "'>";
            echo $row['option_text'] . "<br>";
        }

        if ($currentQuestion !== '') {
            echo '</fieldset>';
        }

        echo "<form method='POST'><input type='submit' name='next' value='次へ'></form>";
    } else {
        echo "すべてのカテゴリーを完了しました！";
    }

    // POSTデータを受け取った場合
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Initialize total score
        $totalScore = 0;

        $answers = $_POST['answer'];
    
        foreach ($answers as $questionId => $optionId) {
            // 選択された選択肢を検索
            foreach ($results as $row) {
                if ($row['question_id'] == $questionId && $row['option_id'] == $optionId) {
                    $totalScore += $row['score'];
                    // scores_tableに保存
                    $insertScoreQuery = 'INSERT INTO scores_table(user_id, question_id, option_id, score) VALUES (:user_id, :question_id, :option_id, :score)';
                    $scoreStmt = $pdo->prepare($insertScoreQuery);
                    $scoreStmt->execute([':user_id' => $userId, ':question_id' => $questionId, ':option_id' => $optionId, ':score' => $row['score']]);
                    break;
                }
            }
        }

        // users_tableのtotalScoreを更新
        $updateTotalScoreQuery = 'UPDATE users_table SET totalScore = :totalScore WHERE user_id = :user_id';
        $totalScoreStmt = $pdo->prepare($updateTotalScoreQuery);
        $totalScoreStmt->execute([':totalScore' => $totalScore, ':user_id' => $userId]);
    }
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}
?>


<?php
// var_dump($_POST);
// exit();

// 1.POSTデータ確認「ユーザーネーム登録」
if (
    //ダメな条件
  !isset($_POST['username']) || $_POST['username'] === '' 
) {
  exit('データが足りません');
}

$username = $_POST['username'];

// 各種項目設定
$dbn ='mysql:dbname=sllev_db;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';  //毎回同じ  サーバー使う時はサーバー側から指示あり
$pwd = ''; //毎回同じ

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

// SQL作成&実行
$sql = 'INSERT INTO users_table (user_id, username, created_at, updated_at) VALUES (NULL, :username, now(), now())';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':username', $username, PDO::PARAM_STR);

// 2.POSTデータ確認「居住地を選択」
if (isset($_POST['choice'])) {
  $choice = $_POST['choice'];

// SQL作成&実行
 $sql = "INSERT INTO residences_table (fukuoka, not_fukuoka) VALUES (:choice, '')";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':choice', $choice, PDO::PARAM_STR);
    $stmt->execute();

    echo "選択結果がresidences_tableに追加されました。";
}
    // データベースとの接続を閉じる

  header('Location:input.php');
exit();
//     $conn->close();
// }

?>


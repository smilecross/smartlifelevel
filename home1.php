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

} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="style.css">
    <!-- <script src="main.js" type="text/javascript"></script> -->
    <script src="https://cdn.tailwindcss.com" rel="stylesheet"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

</head>
<body class="md:flex mt-16 h-full font-mono">
     <section class="bg-emerald-100 text-gray-800 flex flex-col w-3/4 mx-auto px-4 py-2 rounded-lg <?php if(!isset($_POST['username'])) { echo 'hidden'; } ?> ">
        <h2 class="text-lg text-center"><?php echo $result[0]['question_text']; ?></h2>
        <ul class="text-left space-y-4">
            <?php
    foreach ($result as $row) {
      if ($row['category_id'] == 1) {
        echo "<li>" . $row['question_text'] . "</li>";
      }
    }
    ?>
        </ul>
    </section>
        <br>
        <div class="flex">
            <div class="text-center bg-emerald-100 hover:bg-blue-500 w-1/6 mx-auto px-4 py-2 rounded-full">
                <input type="submit" value="戻る">
            </div>
            <div class="text-center bg-emerald-100 hover:bg-blue-500 w-1/6 mx-auto px-4 py-2 rounded-full">
                <input type="submit" value="次へ">
            </div>
        </div>
</body>
</html>
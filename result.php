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

 // ユーザー名がセッションに存在するか確認します。
    if (!isset($_SESSION['username'])) {
        die("Username not found in session. Please login first.");
    }

    $username = $_SESSION['username'];




    // ユーザーの全ての回答を取得します。
    $stmt = $pdo->prepare("SELECT score FROM scores_table WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 得点の合計を計算します。
    $totalScore = 0;
    foreach ($results as $result) {
        $totalScore += $result['score'];
    }


    // カテゴリ数を取得します。
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM categories_table");
    $stmt->execute();
    $totalNumberOfCategories = $stmt->fetchColumn();

    // カテゴリ別スコアを取得します。
    $categoryScores = [];
    for ($categoryId = 1; $categoryId <= $totalNumberOfCategories; $categoryId++) {
        $stmt = $pdo->prepare("SELECT score FROM scores_table WHERE user_id = ? AND category_id = ?");
        $stmt->execute([$_SESSION['user_id'], $categoryId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categoryScore = 0;
        foreach ($results as $result) {
            $categoryScore += $result['score'];
        }
        
        $categoryScores[$categoryId] = $categoryScore;
    }

    // ここから追加
    $categoryScores = [];
    for ($categoryId = 1; $categoryId <= $totalNumberOfCategories; $categoryId++) {
        $stmt = $pdo->prepare("SELECT score FROM scores_table WHERE user_id = ? AND category_id = ?");
        $stmt->execute([$_SESSION['user_id'], $categoryId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categoryScore = 0;
        foreach ($results as $result) {
            $categoryScore += $result['score'];
        }
        
        $categoryScores[$categoryId] = $categoryScore;
    }

    $_SESSION['category_scores'] = $categoryScores;



    // スマートライフレベルを決定します。
    if ($totalScore >= 55) {
        $level = 5;
    } elseif ($totalScore >= 44) {
        $level = 4;
    } elseif ($totalScore >= 31) {
        $level = 3;
    } elseif ($totalScore >= 16) {
        $level = 2;
    } else {
        $level = 1;
    }   


} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}

?>

<!DOCTYPE html>
<html lang="ja" prefix="og: http://ogp.me/ns#">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:url" content="https://sub.life-money-tech.com/index.html">
    <meta property="og:title" content="スマートライフ診断">
    <meta property="og:description" content="スマホが欠かせない時代、これからは生活に活かせす時代です。どのくらい使いこなせているかちょっと調べてみませんか？">
    <meta property="og:type" content="Web">
    <meta property="og:image" content="img/smartlifecheck.png">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com" rel="stylesheet"></script>

    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-688BH1JFV5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-688BH1JFV5');
    </script>
</head>


<body class=" text-stone-800 h-full font-mono">


    <div class="bg-custom-bg">
        <!-- ここにコンテンツ> -->
    </div>

    <!-- スマートライフ診断：非表示、最後に表示 -->
    <section class="h-10 text-center mt-20 mb-20">

    <?php echo "<h1 class='text-2xl font-extrabold ' id='point'>{$username}さんの <br> スマートライフレベルは： <br> レベル{$level}です。</h1>"; ?>

    </section>

    
    
    <div class="flex justify-center items-center mt-30 bg-yellow-500 hover:bg-emerald-100 m-4 h-8 w-1/4 mx-auto rounded-full">
        <a href="level<?php echo $level; ?>.php"><button>詳しく</button></a>              
    </div>

     <!-- footer -->
    <footer class="text-center">
        <div class="mt-20">

            <img src="img/fukuoka3.png" alt="" class="inline">

        </div>
        <p class="text-xs">©️2023 CROSSHERT All Rights Reserved. </p>
    </footer>
    <!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->
</body>
</html>
<?php
session_start();

$dbn ='mysql:dbname=sllev_db;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
    $pdo = new PDO($dbn, $user, $pwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// 以下の配列は、各カテゴリーIDとそのカテゴリーの問題数を示しています。
// これらの値はあなたの実際のデータに合わせて変更してください。
$categoryDetails = [
    ['id' => 1, 'name' => '基本操作', 'numQuestions' => 10],
    ['id' => 2, 'name' => '福岡市行政サービス', 'numQuestions' => 10],
    ['id' => 3, 'name' => '行政サービス', 'numQuestions' => 10],
    ['id' => 4, 'name' => '暮らし', 'numQuestions' => 10],
    ['id' => 5, 'name' => 'お金', 'numQuestions' => 10],
    ['id' => 6, 'name' => '防災・セキュリティ', 'numQuestions' => 10],
];

$labels = [];
$scores = [];

try {
    foreach ($categoryDetails as $categoryDetail) {
        $stmt = $pdo->prepare("SELECT SUM(score) as totalScore FROM scores_table WHERE user_id = ? AND category_id = ?");
        $stmt->execute([$_SESSION['user_id'], $categoryDetail['id']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $labels[] = $categoryDetail['name'];
        $scores[] = $result['totalScore'] / $categoryDetail['numQuestions'];
    }
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <!-- <script src="node_modules/chart.js/dist/Chart.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <!-- レーダーチャート -->
    <canvas id="Chart3" width="350px" height="350px"></canvas>
    
    <script>
    const labels = <?php echo json_encode($labels); ?>;
    const scores = <?php echo json_encode($scores); ?>;

    // チャートのデータ指定
    const data = {
        labels: labels, // PHPから受け取ったラベルを利用
        datasets: [{
            label: 'Dataset 1',
            data: scores, // PHPから受け取ったスコアを利用
            borderColor: 'rgba(255, 99, 132, 1)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
        }]
    };

    const config = {
        type: 'radar',
        data: data,
        options: {
            scales: {
                r: {
                    min: 0,
                    max: 10,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Chart.js Radar Chart'
                }
            }
        },
    };

         // チャートを描画
    const myChart = new Chart(
        document.getElementById('Chart3'), // ここもChart5に修正
        config
    );
    </script>

    <!-- <h1>スマートライフ診断</h1> -->


    <!-- modalThree -->
    <div id="modalThree" class="modal-container">
        <div class="modal-body">
            <div class="modal-content">
                <img class="img" src="img/level3.png" alt="">
                <h3>いいね！でも、もっとイケるでしょう！</h3>
                <p>天気予報やニュースはもちろん、SNSやキャッシュレスも活用して利便性を感じているのではないでしょうか。<br>
                    ただ、もっと使いこなせるようになりたい！そう思っている方もいるかもしれませんね？これから行政サービスも自宅からスマホでできる時代になります。不安もあると思いますが、安全に安心してスマホを活用できるように情報をアップデートしていくと良さそうですね😉
                </p>
                <br>
                <p style="text-align: center;">* * * * *</p>
                <h4><span>新しい情報に触れる</span></h4>
                <h5>暮らしとお金とテクノロジー</h5>
                <p>暮らし+テクノロジー」「お金＋テクノロジー」をテーマにInstagramを通して情報をお届けするメディア「暮らしとお金とテクノロジー」</p>
                <a href="https://www.instagram.com/life.money.tech" class="level_btn">詳しく</a>
                <h4><span>知識を深める</span></h4>
                <h5>アプリCafe</h5>
                <p>月に一度のオンラインアプリCafeでは、デジタルな話題を中心に暮らしの変化について解説するオンラインで開催される無料セミナーです。</p>
                <a href="https://life-money-tech.com" class="level_btn">詳しく</a>
            </div>
        </div>
    </div>
    <!-- modalThree -->

    <!--要件：SNSボタン -->
    <!-- <div class="wrapper" >
            <div class='r_btn_box'>
                <a href="http://www.facebook.com/share.php?u={URL}" rel="nofollow noopener" target="_blank"><img
                        src="img/fb-black.png" alt=""></a>
                <a href="https://twiter.com/share?url={URL}" rel="nofollow noopener" target="_blank"><img
                        src="img/twitter-black.png" alt=""></a>
                <a href="http://line.me/R/msg/text/?{URL}%0a{ページのタイトルなど表示したいテキスト}" target="_blank"
                    rel="nofollow noopener"><img src="img/LINE-black.png" alt=""></a>
            </div>
        </div> -->
    <a href="index.html" class="top_btn">戻る</a>
    <!-- footer -->
    <footer>

        <p id="copy">©️2023 CROSSHERT All Rights Reserved. </p>
    </footer>

    <script src="main.js" type="text/javascript"></script>
</body>

</html>
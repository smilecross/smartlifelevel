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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartLife.Level4</title>
    <script src="https://cdn.tailwindcss.com" rel="stylesheet"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- レーダーチャート -->
     <div class="flex justify-center items-center mt-10 mb-10">
        <canvas id="Chart4" width="300px" height="300px"></canvas>
     </div>
    
    <script>
    const labels = <?php echo json_encode($labels); ?>;
    const scores = <?php echo json_encode($scores); ?>;

    // チャートのデータ指定
    const data = {
        labels: labels, // PHPから受け取ったラベルを利用
        datasets: [{
            label: 'スコア',
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
                    text: '診断結果'
                }
            }
        },
    };

         // チャートを描画
    const myChart = new Chart(
        document.getElementById('Chart4'), // ここもChart5に修正
        config
    );
    </script>
    
    <h2 class="mt-10 text-center text-xl font-semibold">Level.4</h2>
    <!-- modalFour -->
        <div class="m-10" id="modalFour">
                <h3 class="font-semibold">お、いいね！あともう一歩！</h3>
                <p>日々の暮らしでデジタルで完結できることが増えて快適さを感じているのではないでしょうか？<br>
                    これからさらにデジタル化は進んでも十分に対応できるはず！新しいサービスももっと取り入れてみても良さそうですね！
                </p>
                <br>
                <p style="text-align: center;">* * * * *</p>
                <h4 class="font-semibold"><span>新しい情報に触れる</span></h4>
                <h5>暮らしとお金とテクノロジー</h5>
                <p>暮らし+テクノロジー」「お金＋テクノロジー」をテーマにInstagramを通して情報をお届けするメディア「暮らしとお金とテクノロジー」</p>
                <div class="flex justify-center items-center bg-yellow-500 hover:bg-emerald-100 m-4 h-8 w-1/4 mx-auto rounded-full">
                    <a href="https://www.instagram.com/life.money.tech" >詳しく</a>
                </div>
                <h4 class="font-semibold"><span>知識を深める</span></h4>
                <h5>キャッシュレスアドバイザー</h5>
                <p>デジタル化が進む社会で、消費者の暮らしやお金のデジタル化に関する不安や悩みに特化して”キャッシュレスからweb3まで”サポートするアドバイザーです。</p>
                <div class="flex justify-center items-center bg-yellow-500 hover:bg-emerald-100 m-4 h-8 w-1/4 mx-auto rounded-full">
                    <a href="https://cashless-adviser.com" >詳しく</a>
                </div>
        </div>
    <!-- modalFour -->

    <!--要件：SNSボタン -->
    <div class="flex justify-center h-20 m-10" >
                <a class="object-contain" href="http://www.facebook.com/share.php?u={URL}" rel="nofollow noopener" target="_blank">
                    <img class="w-8 h-8 m-2" src="img/fb-black.png" alt=""></a>
                <a class="object-contain" href="https://twiter.com/share?url={URL}" rel="nofollow noopener" target="_blank">
                    <img class="w-8 h-8 m-2" src="img/twitter-black.png" alt=""></a>
                <a class="object-contain" href="http://line.me/R/msg/text/?{URL}%0a{ページのタイトルなど表示したいテキスト}" target="_blank"
                    rel="nofollow noopener">
                    <img class="w-8 h-8 m-2" src="img/LINE-black.png" alt=""></a>
        </div>

        <div class="flex justify-center items-center bg-emerald-100  hover:bg-yellow-500 m-4 h-8 w-1/6 rounded-full">
                <a href="index.html" >戻る</a>
        </div>
    
        <p class="text-xs">©️2023 CROSSHERT All Rights Reserved. </p>

</body>

</html>
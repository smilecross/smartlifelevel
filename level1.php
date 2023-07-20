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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartLife.Level1</title>
    <script src="https://cdn.tailwindcss.com" rel="stylesheet"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- レーダーチャート -->
    <div class="flex justify-center items-center mt-10 mb-10">
        <canvas id="Chart1" width="300px" height="300px"></canvas>
    </div>
    
    <script>
        const labels = <?php echo json_encode($labels); ?>;
        const scores = <?php echo json_encode($scores); ?>;
        console.log(scores);

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

    const myChart = new Chart(
        document.getElementById('Chart1').getContext('2d'), // ここは適切な要素のIDに変更
        {
            type: 'radar',
            data: data,
            options: {
                scales: {
                    r: {
                        min: 0,
                        max: 1,
                        ticks: {
                            stepSize: 0.2
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
            }
        }
    );
    </script>
    
    <h2 class="mt-10 text-center text-xl font-semibold">Level.1</h2>
    <!-- modalOne -->
        <div class="m-10" id="modalOne">
                <h3 class="font-semibold">時には、新しいものも試してみてね（^_-）</h3>
                <p>LINEのやり取りはできているけれど、他の機能はほとんど使うこともなくできればガラケーに戻したい、そんな風に感じている方もいるかもしれませんね！<br>
                    これから日本は人口が減ってどこも人が足りなくなり、それを補うためにデジタル化が進んでいきます。慣れるまでは確かに不安も面倒くささも付きまとうと思いますが、大手携帯電話ショップでは無料のスマホ教室も開催されているので、ぜひ活用してみて下さいね(^_-)
                </p>
                <br>
                <p style="text-align: center;">* * * * *</p>
                <h4 class="font-semibold"><span>基本操作をマスターする</span></h4>
                <h5>スマホ教室</h5>
                <p>大手携帯電話各社やパソコン教室なので開催される「スマホ教室」。基本操作から丁寧に教えてもらえるので、覗いてみてはいかがでしょう？</p>
                <h4 class="font-semibold"><span>色々な情報に触れる</span></h4>
                <h5>暮らしとお金とテクノロジー</h5>
                <p>暮らし+テクノロジー」「お金＋テクノロジー」をテーマにInstagramを通して情報をお届けするメディア</p>
                <div class="flex justify-center items-center bg-yellow-500 hover:bg-emerald-100 m-4 h-8 w-1/4 mx-auto rounded-full">
                    <a href="https://www.instagram.com/life.money.tech" >詳しく</a>        
                </div>
        </div>
    <!-- modalOne -->

    <!--要件：SNSボタン -->
        <div class="flex justify-center h-20 m-10" >
                <a class="object-contain" href="http://www.facebook.com/share.php?u=https://sub.life-money-tech.com/index.html" rel="nofollow noopener" target="_blank">
                    <img class="w-8 h-8 m-2" src="img/fb-black.png" alt=""></a>
                <a class="object-contain" href="https://twitter.com/share?url=https://sub.life-money-tech.com/index.html" rel="nofollow noopener" target="_blank">
                    <img class="w-8 h-8 m-2" src="img/twitter-black.png" alt=""></a>
                <a class="object-contain" href="http://line.me/R/msg/text/?https://sub.life-money-tech.com/index.html%0aスマートライフ診断を試してみて下さい!" target="_blank"
                    rel="nofollow noopener">
                    <img class="w-8 h-8 m-2" src="img/LINE-black.png" alt=""></a>
        </div>

        <div class="flex justify-center items-center bg-emerald-100  hover:bg-yellow-500 m-4 h-8 w-1/6 rounded-full">
                <a href="index.html" >戻る</a>
        </div>

        <p class="text-xs">©️2023 CROSSHERT All Rights Reserved. </p>
</body>
</html>
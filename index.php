<?php
session_start();
?>

<!-- 入れ替え -->
 <h1 class="h-1/6 mt-20 text-center text-2xl font-extrabold text-stone-800">スマートライフ診断</h1>
    <section class="text-center m-2">
        <span class="text-center">
        <p>なくてはならないスマートフォン</p>
        <p>当たり前に使ってはいるけれど</p>
        <br>
        <p>みんなはどんな風に使ってるんだろう？</p>
        <p>もっとできることがありそうだけど？</p>
        <br>
        <p>と思うことはありませんか？</p>
        <p>SNSやニュースを見る以外に生活にいかせているか</p>
        <p>ちょっと試してみませんか？</p>
        </span>
    </section>

<!-- ここまで -->

<section class="mt-20 text-center" >
<form action="create.php" method="POST">
    <fieldset>
        <div class="text-center">
            お名前（ニックネーム）<br>
             <input type="text" name="username" class="rounded border bg-gray-50 p-3">
        </div>
        <br>
        <div class="flex justify-center items-center bg-yellow-500 hover:bg-emerald-100 h-8 w-1/4 mx-auto rounded-full">
            <input type="submit" value="スタート">
        </div>
        <br>
      
            <p class="text-center text-sm">質問は全30問</p>
    </fieldset>
</form>
</section>

<!DOCTYPE html>
<html lang="ja" prefix="og: http://ogp.me/ns#">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:url" content="https://sub.life-money-tech.com/index.html">
    <meta property="og:title" content="スマートライフ診断">
    <meta property="og:description" content="スマホが欠かせない時代、これからは生活に活かす時代です。どのくらい使いこなせているかちょっと調べてみませんか？">
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

<body class="h-full bg-zinc-100 font-mono text-stone-800">
    
    <!-- footer -->
    <footer class="text-center">
        <div>
            <img src="img/fukuoka3.png" alt="" class="inline">
        </div>
        <p class="text-xs">©️2023 CROSSHERT All Rights Reserved. </p>
    </footer>
</body>
</html>
<?php
session_start();
?>

<section class="m-5 text-center" >
<form action="home1.php" method="POST">
    <fieldset>
        <div class="text-center">
            お名前（ニックネーム）<br>
             <input type="text" name="username" class="rounded border bg-gray-50 p-3">
        </div>
        <br>
        <div class="text-center bg-yellow-500 hover:bg-blue-500 w-1/4 mx-auto rounded-full">
            <input type="submit" value="スタート">
        </div>
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
    <meta property="og:description" content="スマホが欠かせない時代、これからは生活に活かせす時代です。どのくらい使いこなせているかちょっと調べてみませんか？">
    <meta property="og:type" content="Web">
    <meta property="og:image" content="img/smartlifecheck.png">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com" rel="stylesheet"></script>
    <link rel="stylesheet" href="style.css">
    <!-- <script src="main.js" type="text/javascript"></script> -->
    
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

<body class="md:flex h-full font-mono">
     <h1 class="h-1/5 m-10 text-center text-2xl font-extrabold">スマートライフ診断</h1>
    <section class="text-center m-10">
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
    

    
    <!-- スマートライフ診断：非表示、最後に表示 -->
    <section class="h-10 text-center m-10 <?php if(!isset($_POST['username'])) { echo 'hidden'; } ?>">
    <h1 class="text-2xl font-extrabold " id='point'>あなたのスマートライフレベルは：<span data-point-num ></span>です。</h1>
    </section>

    <!-- レベルごとのボタン 非表示から最後に表示-->
    <div class="text-center m-16 <?php if(!isset($_POST['username'])) { echo 'hidden'; } ?>" x-data="{ isOpen: false }">
        <!-- モーダルウィンドウのトリガー -->
        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded" @click="isOpen = true">診断結果</button>

        <!-- モーダルウィンドウのコンテンツ -->
        <!-- <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" x-show="isOpen">
            <div class="bg-white p-4 rounded shadow">
            モーダルウィンドウのコンテンツ
            <h2 class="text-xl mb-4">モーダルウィンドウ</h2>
            <p>モーダルウィンドウのコンテンツがここに入ります。</p>
            <button type="button" class="bg-red-500 text-white px-4 py-2 rounded mt-4" @click="isOpen = false">閉じる</button>
            </div>
        </div> 
    </div> -->

    <div class="text-center hidden" id="m-open-box">
        <button id="level5" class="modal-open" data-modal="modalFive">診断結果</button>
        <button id="level4" class="modal-open" data-modal="modalFour">診断結果</button>
        <button id="level3" class="modal-open" data-modal="modalThree">診断結果</button>
        <button id="level2" class="modal-open" data-modal="modalTwo">診断結果</button>
        <button id="level1" class="modal-open" data-modal="modalOne">診断結果</button>
    </div>

    <!-- <div class='b_btn_box' style="display: none;"> -->
    <!--要件１：'診断をはじめる'が表示されている。設問は非表示 -->
    <!-- <button id='back_btn'>戻る</button> -->
    <!-- </div> -->

    <!--要件１：SNSボタンは非表示からの最後に表示 -->
    <div class="flex" >
        <div class='r_btn_box'>
            <a href="http://www.facebook.com/share.php?u={URL}" rel="nofollow noopener" target="_blank"><img
                    src="img/fb-black.png" alt=""></a>
            <a href="https://twiter.com/share?url={URL}" rel="nofollow noopener" target="_blank"><img
                    src="img/twitter-black.png" alt=""></a>
            <a href="http://line.me/R/msg/text/?{URL}%0a{ページのタイトルなど表示したいテキスト}" target="_blank"
                rel="nofollow noopener"><img src="img/LINE-black.png" alt=""></a>
        </div>
    </div>
    <!-- modalFive -->
    <!-- <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" x-show="isOpen">
    <div class="bg-white p-4 rounded shadow"> -->
    <!-- モーダルウィンドウのコンテンツ -->
    <!-- <h2 class="text-xl mb-4">モーダルウィンドウ</h2>
    <p>モーダルウィンドウのコンテンツがここに入ります。</p>
    <button type="button" class="bg-red-500 text-white px-4 py-2 rounded mt-4" @click="isOpen = false">閉じる</button>
    </div>
    </div> -->
    <div id="modalFive" class="hidden">
        <div class="modal-body">
            <div class="modal-close">×</div>
            <div class="modal-content">
                <img class="img" src="img/level5.png" alt="">
                <h3>強強！！周りの人も助けてあげて♪</h3>
                <p>暮らしのあらゆる場面でデジタルを活用できていて素晴らしいです！<br>
                    これから、まだまだデジタル化は進みますが、この調子でスマートライフを楽しんで下さいね(^_-)
                </p>
                <p style="text-align: center;">＊ ＊ ＊ ＊ ＊</p>
                <h4><span>活躍の場を広げる</span></h4>
                <h5>デジタル推進委員</h5>
                <p>デジタル機器・サービスに不慣れな方等に対して、講習会等で教えたりサポートしたりする方です。</p>
                <a href="https://www.digital.go.jp/policies/digital_promotion_staff/" class="level_btn">詳しく</a>
                <h4><span>知識を深める</span></h4>
                <h5>キャッシュレスアドバイザー</h5>
                <p>デジタル化が進む社会で、消費者の暮らしやお金のデジタル化に関する不安や悩みに特化して”キャッシュレスからweb3まで”サポートするアドバイザーです。</p>
                <a href="https://cashless-adviser.com" class="level_btn">詳しく</a>
            </div>
        </div>
    </div>
    <!-- modalFive -->
    <!-- modalFour -->
    <div id="modalFour" class="hidden">
        <div class="modal-body">
            <div class="modal-close">×</div>
            <div class="modal-content">
                <img class="img" src="img/level4.png" alt="">
                <h3>お、いいね！あともう一歩！</h3>
                <p>日々の暮らしでデジタルで完結できることが増えて快適さを感じているのではないでしょうか？<br>
                    これからさらにデジタル化は進んでも十分に対応できるはず！新しいサービスももっと取り入れてみても良さそうですね！
                </p>
                <p style="text-align: center;">＊ ＊ ＊ ＊ ＊</p>
                <h4><span>新しい情報に触れる</span></h4>
                <h5>暮らしとお金とテクノロジー</h5>
                <p>暮らし+テクノロジー」「お金＋テクノロジー」をテーマにInstagramを通して情報をお届けするメディア「暮らしとお金とテクノロジー」</p>
                <a href="https://www.instagram.com/life.money.tech" class="level_btn">詳しく</a>
                <h4><span>知識を深める</span></h4>
                <h5>キャッシュレスアドバイザー</h5>
                <p>デジタル化が進む社会で、消費者の暮らしやお金のデジタル化に関する不安や悩みに特化して”キャッシュレスからweb3まで”サポートするアドバイザーです。</p>
                <a href="https://cashless-adviser.com" class="level_btn">詳しく</a>
            </div>
        </div>
    </div>
    <!-- modalFour -->
    <!-- modalThree -->
    <div id="modalThree" class="hidden">
        <div class="modal-body">
            <div class="modal-close">×</div>
            <div class="modal-content">
                <img class="img" src="img/level3.png" alt="">
                <h3>いいね！でも、もっとイケるでしょう！</h3>
                <p>天気予報やニュースはもちろん、SNSやキャッシュレスも活用して利便性を感じているのではないでしょうか。<br>
                    ただ、もっと使いこなせるようになりたい！そう思っている方もいるかもしれませんね？これから行政サービスも自宅からスマホでできる時代になります。不安もあると思いますが、安全に安心してスマホを活用できるように情報をアップデートしていくと良さそうですね😉
                </p>
                <p style="text-align: center;">＊ ＊ ＊ ＊ ＊</p>
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
    <!-- modalTwo -->
    <div id="modalTwo" class="hidden">
        <div class="modal-body">
            <div class="modal-close">×</div>
            <div class="modal-content">
                <img class="img" src="img/level2.png" alt="">
                <h3>伸び代サイコー！</h3>
                <p>家族や親しい友人とLINEをしたり天気予報やニュースを見たり、スマホも少しずつ慣れてはきたけれど仕組みがよく分からずにドキドキしながら利用するアプリがある、そんな方も多いのではないでしょうか？<br>
                    これから私たちの生活はますますデジタル化が進んでいきます。「あとで時間のある時に...」と後回しにすると忘れてしまいがちなので、ぜひ、立ち止まって調べて使ってみてくださいね😉
                </p>
                <p style="text-align: center;">＊ ＊ ＊ ＊ ＊</p>
                <h4><span>新しい情報に触れる</span></h4>
                <h5>暮らしとお金とテクノロジー</h5>
                <p>暮らし+テクノロジー」「お金＋テクノロジー」をテーマにInstagramを通して情報をお届けするメディア「暮らしとお金とテクノロジー」</p>
                <a href="https://www.instagram.com/life.money.tech" class="level_btn">詳しく</a>
                <h4><span>基本操作をマスターする</span></h4>
                <h5>スマホ教室</h5>
                <p>大手携帯電話各社やパソコン教室なので開催される「スマホ教室」。基本操作から丁寧に教えてもらえるので、覗いてみてはいかがでしょう？</p>
            </div>
        </div>
    </div>
    <!-- modalTwo -->
    <!-- modalOne -->
    <div id="modalOne" class="hidden">
        <div class="modal-body">
            <div class="modal-close">×</div>
            <div class="modal-content">
                <img class="img" src="img/level1.png" alt="">
                <h3>時には、新しいものも試してみてね（^_-）</h3>
                <p>LINEのやり取りはできているけれど、他の機能はほとんど使うこともなくできればガラケーに戻したい、そんな風に感じている方もいるかもしれませんね！<br>
                    これから日本は人口が減ってどこも人が足りなくなり、それを補うためにデジタル化が進んでいきます。慣れるまでは確かに不安も面倒くささも付きまとうと思いますが、大手携帯電話ショップでは無料のスマホ教室も開催されているので、ぜひ活用してみて下さいね😉
                </p>
                <p style="text-align: center;">＊ ＊ ＊ ＊ ＊</p>
                <h4><span>基本操作をマスターする</span></h4>
                <h5>スマホ教室</h5>
                <p>大手携帯電話各社やパソコン教室なので開催される「スマホ教室」。基本操作から丁寧に教えてもらえるので、覗いてみてはいかがでしょう？</p>
                <h4><span>色々な情報に触れる</span></h4>
                <h5>暮らしとお金とテクノロジー</h5>
                <p>暮らし+テクノロジー」「お金＋テクノロジー」をテーマにInstagramを通して情報をお届けするメディア</p>
                <a href="https://www.instagram.com/life.money.tech" class="level_btn">詳しく</a>
            </div>
        </div>
    </div>
    <!-- modalOne -->
    <!-- footer -->
    <footer class="text-center">
        <div>
            <img src="img/fukuoka1.png" alt="" class="inline">
        </div>
        <p>©️2023 CROSSHERT All Rights Reserved. </p>
    </footer>
</body>
</html>
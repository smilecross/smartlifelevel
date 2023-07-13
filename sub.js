// 「診断をはじめる」をクリックしたら設問が表示される
$('button').on('click', function () {
    $('#s_btn').hide();
    // リストの最初の項目を表示する 
    $('h2,ul').show();
    $('.b_btn_box').show();
    $('.message').hide();
    // render(0);

});

//設問が順次表示される。10ー30問
$(function () {
    let count = 0;
    let point = 0;
    const list = [
        // {
        //     'title': '住民票が必要！そんな時、お得なのはどこ？',
        //     'answer': [
        //         'コンビニ',
        //         '証明書発行コーナー',
        //         '居住地の区役所や出張所'
        //     ]
        // },
        {
            'title': 'パスポートの期限が切れる！すぐに手続きに行けない時どうする？',
            'answer': [
                'マイナポータルで申請する',
                '家族に代理で手続きを頼む',
                'あきらめる'
            ]
        },
        {
            'title': '引越し！子どもが小さくて手続きが大変な時どうする？',
            'answer': [
                'マイナポータルで時短する',
                '親に子どもを預けて1日で終わらせる',
                '親に代理で手続きしてもらう',
            ]
        },
        {
            'title': '老後の生活が心配。そんな時どうする？',
            'answer': [
                'ねんきんネットで受給額を調べる',
                'ファイナンシャル・プランナーに相談する',
                '年金保険に加入する'
            ]
        },
        {
            'title': '粗大ゴミを出した！そんな時、どうする？',
            'answer': [
                '福岡市のLINEで申込み&支払い',
                '粗大ゴミセンターに電話',
                'レンタル倉庫に保管する'
            ]
        }, {
            'title': '子どもの小学校の献立を確認したい！そんな時、どうする？',
            'answer': [
                '福岡市のLINEで小学校給食献立を登録しておく',
                '献立のプリントを探す',
                'ママ友に聞く'
            ]
        }, {
            'title': '福岡市内をバスで移動したい。その時、何で調べる？',
            'answer': [
                'マイルートで調べる',
                '西鉄バスナビで調べる',
                '地図アプリで調べる'
            ]
        }, {
            'title': '福岡市内を終日満喫したい。お得な方法をどれ？',
            'answer': [
                'チャリチャリで移動する',
                'バス、地下鉄の終日券を使う',
                'もちろんマイカードライブ'
            ]
        }, {
            'title': '急に雨に降られて止みそうにない！傘がないときどうする？',
            'answer': [
                'アイカサを借りる',
                'コンビニで傘を買う',
                'ぬれる'
            ]
        }, {
            'title': '引越しで口座の住所変更！こんな時、どうする？',
            'answer': [
                'マイナポータルで楽々変更',
                '隙間時間で銀行訪問',
                '放置する'
            ]
        },
        {
            'title': '電子マネーの残高が分からない！そんな時、どうしてる？',
            'answer': [
                '残高確認アプリでチェックする',
                '券売機やバスなどの乗降時にチェックする',
                'とりあえずチャージする'
            ]
        },
        // {
        //     'title': '財布を忘れた！どうしても現金が必要なとき、どうしてる？',
        //     'answer': [
        //         'PayPayにチャージしてコンビニATMから引き出す',
        //         '自宅に取りに帰る',
        //         '知り合いに連絡して貸してもらう'
        //     ]
        // }, {
        //     'title': 'スマホを紛失！そんな時、まず、どうする？',
        //     'answer': [
        //         '携帯ショップに駆け込む',
        //         'パソコンでスマホの場所を調べる',
        //         '警察に行く'
        //     ],
        // }, {
        //     'title': '外出先でスマホのバッテリーが10%を切った！そんな時どうする？',
        //     'answer': [
        //         'ChargSPOTを探して充電する',
        //         'カフェの充電スポットで充電する',
        //         'あきらめる'
        //     ],
        // }, {
        //     'title': '外出先での水分補給、どうしてる？',
        //     'answer': [
        //         '水筒を持ち歩き、給水スポットで給水する',
        //         'コンビニなどで購入する',
        //         'がまんする'
        //     ],
        // }, {
        //     'title': '災害の時に自分のスマホだけ警報が届かない！そんな時、どうする？',
        //     'answer': [
        //         '迷惑メール設定を変更する',
        //         '携帯ショップで相談する',
        //         '家族に届くから気にしない'
        //     ],
        // }, {
        //     'title': '体調がすぐれない！何科に行けばよいか分からないとき、どうする？',
        //     'answer': [
        //         'HELPOの無料相談で聞いてみる',
        //         'ユビーで調べる',
        //         'ネットで検索する'
        //     ],
        // }, {
        //     'title': '押し入れにしまっている引き出物を処分したい。そんな時、どうする？',
        //     'answer': [
        //         'メルカリに出品する',
        //         'ブックオフに持っていく',
        //         'ゴミとして処分する'
        //     ],
        // }, {
        //     'title': '新聞の切り抜きが面倒。そんな時、どうする？',
        //     'answer': [
        //         '電子版に切り替えて、アプリで記事を保存する',
        //         'ネットで同じ記事を探して保存する',
        //         'あきらめる'
        //     ],
        // }, {
        //     'title': 'お薬手帳を忘れがち！そんな時、どうする？',
        //     'answer': [
        //         'マイナポータルに記録されるので気にしない',
        //         'お薬手帳アプリを使う',
        //         'お薬手帳を常にカバンに入れておく'
        //     ],
        // }, {
        //     'title': 'お薬の飲み忘れてしまう！そんな時、どうしてる？',
        //     'answer': [
        //         'お薬手帳アプリのリマンダーを設定する',
        //         '曜日と朝昼夜ごとのお薬BOXに薬を入れる',
        //         '家族に気かけてもらう'
        //     ],
        // }, {
        //     'title': 'スマホの画面が見づらい時、どうする？',
        //     'answer': [
        //         '設定で文字サイズを大きく、太くする',
        //         'メガネをかける',
        //         '我慢する'
        //     ],
        // }, {
        //     'title': '災害時、スマホが繋がらない！公衆電話を探すとき、どうする？',
        //     'answer': [
        //         '地図アプリで検索する',
        //         '近くを探し回る',
        //         '近くにいる人に聞く'
        //     ],
        // }, {
        //     'title': '夕飯の準備中、食材が足りない！そんな時、どうする？',
        //     'answer': [
        //         'フードデリバリーで配達してもらう',
        //         '代替品を検索サイトで調べる',
        //         'あきらめる'
        //     ],
        // }, {
        //     'title': 'ガードレールが折れてる！そんな時、どうしてる？',
        //     'answer': [
        //         '福岡市のLINEから写真を撮って報告する',
        //         '自治会長に連絡する',
        //         'スルーする'
        //     ],
        // }, {
        //     'title': '課税証明が必要！そんな時、どうする？',
        //     'answer': [
        //         '福岡市のLINEで調べる',
        //         'ネットで申請予約する',
        //         '居住地の区役所に行く'
        //     ],
        // }, {
        //     'title': '家族に3万円を仕送り。お得で便利なのはどれ？',
        //     'answer': [
        //         'ことらで送金',
        //         'コード決済アプリで送金',
        //         'ATMで送金'
        //     ],
        // }, {
        //     'title': '家族の予定が分からないとき、どうしてる？',
        //     'answer': [
        //         'TimeTreeで共有',
        //         'Googleカレンダーで共有',
        //         '毎日家族に確認する'
        //     ],
        // }, {
        //     'title': '外出先でネットを使いたい！どれを使ってる？',
        //     'answer': [
        //         '契約している通信会社の回線',
        //         'ポケットWi-Fi',
        //         '無料で使えるWi-Fi'
        //     ],
        // }, {
        //     'title': '英語で道を聞かれて困った！そんな時、どうする？',
        //     'answer': [
        //         'LINE英語通訳や通訳アプリで通訳してもう',
        //         '英語のわかる人がいないか周りの人に声をかける',
        //         '逃げる'
        //     ],
        // },
    ];


    // 質問と回答を次々に表示する
    function render(count) {
        $('li').remove();
        $('h2').text(list[count]['title']); //h2のテキストにタイトルを入れる
        list[count]['answer'].forEach(function (text) {
            const li = `<li li > ${text}</li > `;
            $('ul').append(li);
        });
    }
    render(0);

    // カウントルール
    function pointGet(li_index) {
        switch (li_index) {
            case 0:
                return 1;
                break;
            case 1:
                return 0;
                break;
            case 2:
                return -1;
                break;
        };
    }

    //結果を表示する
    $('body').on('click', 'li', function () {
        var li_index = $('li').index(this);
        point += pointGet(li_index);
        if (count < list.length - 2) {
            count++;
            render(count);
        } else if (count === list.length - 2) {
            count++;
            render(count);
            $('#s_btn').hide();
        } else {
            var resultText = point_text(point);
            $('[data-point-num]').text(resultText); // data-point-num属性を持つ要素に結果を設定する
            $('h2, ul').hide();
            $('.point').fadeIn();
            console.log('end');
        }
    });


    // 診断結果
    function point_text(point) {
        let text = 'レベル';
        if (point >= 8) {
            text = 'Level.5';
            $('#level5').show();
            console.log(point)
        } else if (point <= 7 && point >= 4) {
            text = 'Level.4'
            $('#level4').show();
            console.log(point)
        } else if (point <= 3 && point >= -1) {
            text = 'Level.3'
            $('#level3').show();
            console.log(point)
        } else if (point <= -2 && point >= -6) {
            text = 'Level.2'
            $('#level2').show();
            console.log(point)
        } else if (point < -6) {
            text = 'Level.1'
            $('#level1').show();
            console.log(point)
        }
        return text;
    }



    // ボタンをクリックしたとき
    $('#level5').click(function () {
        window.location.href = 'level5.html';
    });

    $('#level4').click(function () {
        window.location.href = 'level4.html';
    });

    $('#level3').click(function () {
        window.location.href = 'level3.html';
    });

    $('#level2').click(function () {
        window.location.href = 'level2.html';
    });

    $('#level1').click(function () {
        window.location.href = 'level1.html';
    });


    // //「診断結果」をクリックしたらモーダルが表示される
    // $('.point').on('click', function () {

    //     // 変数に要素を入れる
    //     let open = $('.modal-open'),
    //         close = $('.modal-close'),
    //         container = $('.modal-container');

    //     //診断結果のテキストを取得する
    //     let resultText = $('[data-point-num]').text();

    //     switch (resultText) {
    //         case 'level.5':
    //             showModal('modalFive');
    //             break;
    //         case 'level.4':
    //             showModal('modalFour');
    //             break;
    //         case 'level.3':
    //             showModal('modalTree');
    //             break;
    //         case 'level.2':
    //             showModal('modalTwo');
    //             break;
    //         default:
    //             showModal('modalOne');
    //         //break;
    //     }
    // });
});

// 戻るボタンをクリックしたらモーダルを閉じる
$('#back_btn').on('click', function () {
    $('body').animate({ scrollTop: 0 }, 'slow');
});


// 閉じるボタンをクリックしたらモーダルを閉じる
function closeModal() {
    const container = $('.modal-container');
    container.removeClass('active');
    // hideAllLevels();
}

// モーダルの外側をクリックしたらモーダルを閉じる
$(document).on('click', function (e) {
    if (!$(e.target).closest('.modal-body').length) {
        closeModal();
    }
});


// container.addClass('active');
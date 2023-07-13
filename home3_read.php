<?php
$dbn ='mysql:dbname=sllev_db;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
  $pdo = new PDO($dbn, $user, $pwd);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

// データベースからランダムに質問と回答を取得
$query = "SELECT q.question_text, o.option_text
          FROM questions_table q
          JOIN options_table o ON q.question_id = o.question_id
          ORDER BY RAND()
          LIMIT 2";
$stmt = $pdo->query($query);

// 結果を取得
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// PHPの変数をJavaScriptの変数に変換して渡す
echo "<script>";
echo "const questions = " . json_encode($result) . ";";
echo "</script>";

?>

<script>
$(function() {
  let count = 0;
  let point = 0;
  
  // 質問と回答を次々に表示する処理

  function render(count) {
    $('li').remove();
    $('h2').text(questions[count]['question_text']); // 質問文を表示
    questions[count]['answer_text'].forEach(function(text) {
      const li = `<li>${text}</li>`;
      $('ul').append(li);
    });
  }
  
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

</script>
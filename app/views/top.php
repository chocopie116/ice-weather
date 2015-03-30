<html>
<head>
<meta name="description" content="ice weatherは、あなたの「今日何のアイスを食べようかな？」を7FのアイスクリームBOXまでのぞきにいかなくても自席でワクワクできるサービスです">
<meta name="keywords" content="アイスクリーム、アイス管理人様には足を向けてねれません">
<title>ice weather</title>
<script src='https://code.jquery.com/jquery-2.1.3.min.js'></script>
</head>
<body>
<h1>Ice weather </h1>
<p>Ice weatherは、今日何のアイスを食べようかな？とワクワクしながら7FのアイスクリームBOXまでのぞきにいかなくても自席で確認できるアプリケーションです</p><br>

<div id="current_weather" style="display:none">
    <h3><p class="time"></p>時点の冷凍庫の様子です</h3>
    <img src="">
</div>

<p>
ice weatherではテンションのあがるサイトをデザインしてくれるデザイナーさんや
コードをレビューしてくれるエンジニアを募集しています。
こういう機能つけてほしい！みたいなご意見があれば<a href="https://github.com/chocopie116/ice-weather/issues">こちら</a>に是非issueを上げてください
</p>
<a href="https://github.com/chocopie116/ice-weather">Contribute</a>

<script>
$(function() {
    var URL = '/api/ice/image';
    $.ajax({
        url: URL,
        type:'GET',
        dataType: 'json',
        timeout:2000,
        success: function(data) {
            // 成功
            var $currentWeather = $('#current_weather');
            $currentWeather.find('img').attr('src', data.image.url);
            $currentWeather.find('.time').text(data.image.created_at);
            $currentWeather.show();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
                // 失敗
            console.log("error");
        }
    });
});
console.log('ice creamに目がないフロントエンドエンジニア募集中 是非ここからjoinしてください。https://github.com/chocopie116/ice-weather');
</script>
</body>
</html>

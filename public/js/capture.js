(function(window, $) {
    $(function() {
        var video = document.querySelector('video');
        var canvas = document.querySelector('canvas');
        var ctx = canvas.getContext('2d');
        var localMediaStream = null;

        //カメラ使えるかチェック
        var hasGetUserMedia = function() {
            return !!(navigator.getUserMedia || navigator.webkitGetUserMedia ||
                      navigator.mozGetUserMedia || navigator.msGetUserMedia);
        }
        //エラー
        var onFailSoHard = function(e) {
            console.log('エラー!', e);
        };

        //カメラ画像キャプチャ
        var snapshot = function() {
            if (localMediaStream) {
                ctx.drawImage(video, 0, 0);
                var imgUrl = canvas.toDataURL('image/webp');

                document.querySelector('img').src = imgUrl;
                //saveSnapshot();
            }
        }

        var saveSnapshot = function() {
            var hostUrl= 'save.php'; // データ送信先
            var picUrl = $('#captured_pic').attr('src');
            $.ajax({
                url: hostUrl,
                type:'POST',
                dataType: 'json',
                data : {img : picUrl},
                timeout:10000,
                success: function(data) {
                    // 成功
                    alert("ok");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    // 失敗
                    alert("error");
                }
            });
        }

        if (!hasGetUserMedia()) {
            alert("未対応ブラウザです。");
        }


        window.URL = window.URL || window.webkitURL;
        navigator.getUserMedia  = navigator.getUserMedia || navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia || navigator.msGetUserMedia;

        navigator.getUserMedia({video: true}, function(stream) {
            video.src = window.URL.createObjectURL(stream);
            localMediaStream = stream;
        }, onFailSoHard);

        $(window).click(function() {
            snapshot();
        });
    })();
})(window, jQuery);

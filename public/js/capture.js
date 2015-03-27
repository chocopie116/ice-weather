'use strict';
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
            if (!localMediaStream) {
                return;
            }
            ctx.drawImage(video, 0, 0);
            var imgUrl = canvas.toDataURL('png');

            document.querySelector('img').src = imgUrl;
            saveSnapshot();
        }
        var dataURItoBlob = function (dataURI) {
            var binary = atob(dataURI.split(',')[1]);
            var array = [];
            for(var i = 0; i < binary.length; i++) {
                array.push(binary.charCodeAt(i));
            }
            return new Blob([new Uint8Array(array)], {type: 'image/jpeg'});
        }

        var saveSnapshot = function() {
            var hostUrl= '/api/ice/image'; // データ送信先
            var picUrl = $('#captured_pic').attr('src');
            var blob = dataURItoBlob(picUrl);
            var formData = new FormData();
            formData.append('acceptImage', blob);

            $.ajax({
                url: hostUrl,
                type:'POST',
                dataType: 'json',
                data : formData,
                timeout:10000,
                //ajaxがdataを整形しないように指定
                processData : false,
                //contentTypeもfalseに指定
                contentType : false,
                success: function(data) {
                    // 成功
                    console.log(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    // 失敗
                    console.log("error");
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

        $(window).on('click', function() {
            snapshot();
        });
    });
})(window, jQuery);

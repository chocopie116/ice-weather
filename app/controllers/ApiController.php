<?php

class ApiController extends BaseController
{
    public function getImage($target)
    {
    }

    public function postImage($target)
    {
        $img = Input::get('img');

        // ヘッダに「data:image/png;base64,」が付いているので、それは外す

        $img = preg_replace("/data:[^,]+,/i","",$img);

        // 残りのデータはbase64エンコードされているので、デコードする
        $img = base64_decode($img);

        // 文字列状態から画像リソース化
        $image = imagecreatefromstring($img);

        //画像として保存（ディレクトリは任意）
        imagesavealpha($image, TRUE); // 透明色の有効

        $path = '/img/ice/' . date('YmdHis') . '.png';

        imagepng($image , public_path() . $path);

        //DBに保存

        return Response::json(array('imgUrl' => $path), 200);
    }
}

<?php

class ApiController extends BaseController
{
    public function getImage($target)
    {
        $this->postImage($target);
    }

    public function postImage($target)
    {
        //$imagePublicPath = '/img/ice/' . date('YmdHis') . '.png';
        //$filePath = public_path() . $imagePublicPath;
        //move_uploaded_file($_FILES['acceptImage']['tmp_name'], $filePath);

        //TODO secretなので絶対commitすんな
        //cloudinary://:
        \Cloudinary::config(array(
            "cloud_name" => "hxhnynmvb",
            "api_key" => "637966466372176",
            "api_secret" => "Q8JWpD2VZCTw-1SY_cWTYBzsEsc"
        ));

        //var_dump($_FILES['acceptImage']);
        $result = \Cloudinary\Uploader::upload($_FILES['acceptImage']['tmp_name']);
        var_dump($result);

        //DBに保存

        return Response::json(array('imgUrl' => $imagePublicPath), 200);
    }
}

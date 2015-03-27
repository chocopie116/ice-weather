<?php

class ApiController extends BaseController
{
    public function getImage($target)
    {
        $this->postImage($target);
    }

    public function postImage($target)
    {
        $img = Input::get('img');

        //$imagePublicPath = '/img/ice/' . date('YmdHis') . '.png';
        //$filePath = public_path() . $imagePublicPath;
        //move_uploaded_file($_FILES['acceptImage']['tmp_name'], $filePath);

        //TODO secretなので絶対commitすんな
        \Cloudinary::config(array(
            "cloud_name" => "hfjbiwaqs",
            "api_key" => "189555235614418",
            "api_secret" => "nkaPz4jviODAo0yVbFJYuYmg_9o"
        ));
        //cloudinary://189555235614418:nkaPz4jviODAo0yVbFJYuYmg_9o@hfjbiwaqs

        //var_dump($_FILES['acceptImage']);
        echo 'ok';
        $file = '/home/demouser/ice-weather/public/img/snapshot_20150326_2117.jpg';
        //$result = \Cloudinary\Uploader::upload($_FILES['acceptImage']['tmp_name']);
        $result = \Cloudinary\Uploader::upload($file);
        var_dump($result);

        //DBに保存

        return Response::json(array('imgUrl' => $imagePublicPath), 200);
    }
}

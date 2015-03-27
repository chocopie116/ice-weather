<?php

class ApiController extends BaseController
{
    public function getImage($target)
    {
    }

    public function postImage($target)
    {
        $img = Input::get('img');

        $imagePublicPath = '/img/ice/' . date('YmdHis') . '.png';
        $filePath = public_path() . $imagePublicPath;
        move_uploaded_file($_FILES['acceptImage']['tmp_name'], $filePath);

        //DBに保存

        return Response::json(array('imgUrl' => $imagePublicPath), 200);
    }
}

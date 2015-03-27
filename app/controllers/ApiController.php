<?php

class ApiController extends BaseController
{
    public function getImage($target)
    {
    }

    public function postImage($target)
    {
        $imgFile = $_FILES['acceptImage']['tmp_name'];

        $cloudinaryUrl = getEnv('CLOUDINARY_URL');
        $parsedResult = parse_url($cloudinaryUrl);
        \Cloudinary::config(array(
            "cloud_name" => $parsedResult['host'],
            "api_key" =>  $parsedResult['user'],
            "api_secret" => $parsedResult['pass']
        ));

        $result = \Cloudinary\Uploader::upload($imgFile);
        $imgUrl = $result['url'];

        $url = new \ImageUrl();
        $url->image_url = $imgUrl;
        $url->save();

        return Response::json(array('imgUrl' => $imgUrl), 200);
    }
}

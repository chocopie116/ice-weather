<?php

class ApiController extends BaseController
{
    public function getImage($target)
    {
        $url = \Image::orderBy('created_at', 'DESC')->first();

        return Response::json(array(
            'image' => array(
                array(
                    'url' => $url->URL,
                    'created_at' => $url->CREATED_AT
                )
            )
        ), 200);
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

        $url = new \Image();
        $url->url = $imgUrl;
        $url->save();

        return Response::json(array(
            'image' => array(
                'url' => $url->url,
                'created_at' => $url->created_at
            )
        ), 200);
    }
}

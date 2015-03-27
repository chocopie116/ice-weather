<?php

class ApiController extends BaseController
{
    public function getImage($target)
    {
        $url = \Image::orderBy('created_at', 'DESC')->first();

        $data = array(
            'image' => array(
                'url' => $url->URL,
                'created_at' => $url->CREATED_AT
            )
        );
        return Response::json($data, 200);
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

        $data = array(
            'image' => array(
                'url' => $url->url,
                'created_at' => $url->created_at
            )
        );
        return Response::json($data, 200);
    }
}

ice-weather
============

[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)

##setup

```sh:sh
make install
```


## middleware

- DB は [ClearDB MySQL Database](https://addons.heroku.com/cleardb) を使っている
- 画像を保存するのに [Cloudinary(S3 + 画像加工URL + cdn)](https://addons.heroku.com/cloudinary) を使っている

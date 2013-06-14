Flickr Api Wrapper for PHP5.3
=============================

```php
$metadata = new Rezzza\Flickr\Metadata('api key', 'secret');
$metadata->setOauthAccess('access token', 'access token secret');

$factory  = new Rezzza\Flickr\ApiFactory($metadata, new Rezzza\Flickr\Http\GuzzleAdapter());

$xml = $factory->call('flickr.test.login');
$xml = $factory->call('flickr.photos.getInfo', array(
    'photo_id' => 1337,
));

$factory->upload('path/to/photo.png', 'my title');
```

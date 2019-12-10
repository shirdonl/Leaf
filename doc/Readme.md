# Leaf documentation

Leaf is a simple and lightweight HTTP client which is easy to use. This page is 
the index of the documentation. Please use the table of contents below to start
reading. 

* [Browser](#browser)
* [Submit forms](#submit-a-form) 
* [Client](/doc/client.md)
* [Middleware](/doc/middleware.md) 
* [Symfony Bundle](/doc/symfony.md) 


## Browser

The Browser is the high-level object to send HTTP requests. Main focus is on simplicity. 

When a `Browser` in constructed you have to select a [Client](/doc/client.md) to use. The 
`FileGetContents` client is used by default. See example of how
to use the Bowser: 

```php
use Leaf\Browser;
use Leaf\Client\FileGetContents;
use Nyholm\Psr7\Factory\Psr17Factory;

$client = new FileGetContents(new Psr17Factory());
$browser = new Browser($client, new Psr17Factory());

$response = $browser->get('https://www.baidu.com');
$response = $browser->get('https://www.baidu.com', ['User-Agent'=>'Leaf']);
$response = $browser->post('https://www.baidu.com', ['User-Agent'=>'Leaf'], 'http-post-body');

$response = $browser->head('https://www.baidu.com');
$response = $browser->patch('https://www.baidu.com');
$response = $browser->put('https://www.baidu.com');
$response = $browser->delete('https://www.baidu.com');


$response = $browser->request('GET', 'https://www.baidu.com');
```

You do also have a function to send PSR-7 requests. 

```php
use Nyholm\Psr7\Request;

$request = new Request('GET', 'https://google.com/foo');
$response = $browser->sendRequest($request)
```

## Submit a form

With Leaf you have built in support for posing forms. You could of course create your own PSR-7 request and posting it 
as you normally would. But it might be easier to use the `Browser::submit()` function or the `FormRequestBuilder`. 

Below is an example how to use `Browser::submit()` to upload a file. 

```php
$browser->submitForm('https://www.baidu.com/foo', [
    'user' => 'Shirdon Liao',
    'image' => [
        'path'=>'/path/to/image.jpg'
      ],
]);
``` 

```php
$browser->submitForm('https://www.baidu.com/foo', [
    'user[name]' => 'Shirdon Liao',
    'user[image]' => [
        'path'=>'/path/to/image.jpg',
        'filename' => 'my-image.jpg',
        'contentType' => 'image/jpg',
      ],
]);
``` 

### Using the FormRequestBuilder

If you have a large from or you want to build your request in a structured way you may use the `FormRequestBuilder`.

```php
use Leaf\Message\FormRequestBuilder;

$builder = new FormRequestBuilder();
$builder->addField('user[name]', 'Shirdon Liao');
$builder->addFile('user[image]', '/path/to/image.jpg', 'image/jpg', 'my-image.jpg');
$builder->addFile('cover-image', '/path/to/cover.jpg');

$browser->submitForm('https://www.baidu.com/foo', $builder->build());
``` 

---

Continue reading about [Clients](/doc/client.md).

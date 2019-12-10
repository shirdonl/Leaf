# Leaf 文档


Leaf是一个简单而轻量级的HTTP框架，易于使用。此页是文档的索引。请使用下面的目录开始阅读。 

## 浏览器对象：Browser


浏览器是发送HTTP请求的高级对象。主要关注的是简单性。

在构造“Browser”时，必须选择要使用的[客户端]（/doc/Client.md）。这个

`默认情况下使用FileGetContents`client。参见如下： 

```php
use Leaf\Browser;
use Leaf\Client\FileGetContents;
use Nyholm\Psr7\Factory\Psr17Factory;

$client = new FileGetContents(new Psr17Factory());
$browser = new Browser($client, new Psr17Factory());

$response = $browser->get('https://example.com');
$response = $browser->get('https://example.com', ['User-Agent'=>'Leaf']);
$response = $browser->post('https://example.com', ['User-Agent'=>'Leaf'], 'http-post-body');

$response = $browser->head('https://example.com');
$response = $browser->patch('https://example.com');
$response = $browser->put('https://example.com');
$response = $browser->delete('https://example.com');


$response = $browser->request('GET', 'https://example.com');
```

You do also have a function to send PSR-7 requests. 

```php
use Nyholm\Psr7\Request;

$request = new Request('GET', 'https://google.com/foo');
$response = $browser->sendRequest($request)
```

## 提交表单

有了Leaf，你已经建立了对请求表单的支持。你当然可以创建自己的PSR-7请求并发布，但使用Browser：：submit（）`函数或'FormRequestBuilder'可能更容易。


下面是如何使用“Browser：：submit（）”上载文件的示例。

```php
$browser->submitForm('https://example.com/foo', [
    'user' => 'Shirdon Liao',
    'image' => [
        'path'=>'/path/to/image.jpg'
      ],
]);
``` 

```php
$browser->submitForm('https://example.com/foo', [
    'user[name]' => 'Shirdon Liao',
    'user[image]' => [
        'path'=>'/path/to/image.jpg',
        'filename' => 'my-image.jpg',
        'contentType' => 'image/jpg',
      ],
]);
``` 

### 使用 FormRequestBuilder


如果您有一个大的from，或者您希望以结构化的方式构建您的请求，那么您可以使用“FormRequestBuilder”。 

```php
use Leaf\Message\FormRequestBuilder;

$builder = new FormRequestBuilder();
$builder->addField('user[name]', 'Shirdon Liao');
$builder->addFile('user[image]', '/path/to/image.jpg', 'image/jpg', 'my-image.jpg');
$builder->addFile('cover-image', '/path/to/cover.jpg');

$browser->submitForm('https://example.com/foo', $builder->build());
``` 

---

Continue reading about [Clients](/doc/client.md).

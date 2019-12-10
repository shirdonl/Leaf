<?php
/**
 * Sample index
 *
 * Author: Shirdon<https://www.shirdon.com>
 * Email: 823923263@qq.com
 */

require "../vendor/autoload.php";

use \Leaf\Browser;
use \Leaf\Client\FileGetContents;
use \Nyholm\Psr7\Factory\Psr17Factory;

$client = new FileGetContents(new Psr17Factory());
$browser = new Browser($client, new Psr17Factory());

$response = $browser->request('GET', 'https://www.baidu.com');

print_r($response->getBody()->getContents());

//$response = $browser->get('https://www.baidu.com');
//
//$response = $browser->get('https://www.baidu.com', ['User-Agent'=>'Leaf']);
//$response = $browser->post('https://www.baidu.com', ['User-Agent'=>'Leaf'], 'http-post-body');
//
//$response = $browser->head('https://www.baidu.com');
//$response = $browser->patch('https://www.baidu.com');
//$response = $browser->put('https://www.baidu.com');
//$response = $browser->delete('https://www.baidu.com');



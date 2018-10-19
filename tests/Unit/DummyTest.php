<?php
namespace App\Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class DummyTest extends TestCase
{
    public function testQuery()
    {
        $stack = [];
        $this->assertSame(0, count($stack));

        array_push($stack, 'foo');
        $this->assertSame('foo', $stack[count($stack) - 1]);
        $this->assertSame(1, count($stack));

        $this->assertSame('foo', array_pop($stack));
        $this->assertSame(0, count($stack));

//        $client = new Client([
//            // Base URI is used with relative requests
//            'base_uri' => 'http://localhost:8888',
//            // You can set any number of default request options.
//            'timeout'  => 3.0,
//        ]);
//
//        $response = $client->request('POST', '/', [
//            'body' => '{
//    "query": "{ user(message: \\"aaaa\\") {username posts {title author {email}}} }",
//    "variables": null
//}'
//        ]);
//
//        $code = $response->getStatusCode();
//        $reason = $response->getReasonPhrase();
//        $body = $response->getBody();
//
//        echo "Code: $code , Reason: $reason \n";
//        echo $body."\n";
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: liangyu
 * Date: 2018/12/13
 * Time: 16:14
 */

namespace App\Service\RPC;

use Grpc\BaseStub;
use Helloworld\HelloRequest;

class HelloWroldClient extends BaseStub
{
    public function __construct(string $hostname, array $opts, $channel = null)
    {
        parent::__construct($hostname, $opts, $channel);
    }

    public function SayHello(HelloRequest $argument, $metadata = [], $options = [])
    {
        return $this->_simpleRequest('/helloworld.MyGreeter/SayHello',
            $argument,
            ['\Helloworld\HelloReply', 'decode'],
            $metadata, $options
        );
    }
}
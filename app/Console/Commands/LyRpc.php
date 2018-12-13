<?php

namespace App\Console\Commands;

use App\Service\RPC\HelloWroldClient;
use Grpc\ChannelCredentials;
use Helloworld\HelloRequest;
use Illuminate\Console\Command;

class LyRpc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'LyRpc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ly测试rpc helloworld 调用';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new HelloWroldClient('127.0.0.1:10000', [
            'credentials' => ChannelCredentials::createInsecure()
        ]);

        $request = new HelloRequest();
        $request->setName('梁宇');
        //调用远程服务
        $get = $client->SayHello($request)->wait();

        //返回数组
        //$reply 是 TestReply 对象
        //$status 是数组
        list($reply, $status) = $get;
        //数组
        $getdata = $reply->getMessage();
        dd($getdata);
    }
}

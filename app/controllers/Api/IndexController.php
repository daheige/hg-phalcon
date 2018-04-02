<?php
namespace Api;

class IndexController extends Controller
{

    public function indexAction()
    {
        echo "<h1>hello api demo!</h1>";die;
    }

    public function testAction()
    {
        echo 22333;die;
    }

    //api success 调用
    //{"code":0,"message":"更新成功","data":{"name":"heige"},"timestamp":1522591665}
    public function infoAction()
    {
        var_dump(G('name'));
        var_dump(service('url'));die;
        $this->success(['name' => 'heige'], '更新成功'); //第一个参数可以为空
    }

    //{"code":500,"message":"访问异常","data":null,"timestamp":1522592022}
    public function fooAction()
    {
        $this->error(500, '访问异常');
    }

    //{"code":200,"message":"ok","data":null,"timestamp":1522592007}
    public function hgAction()
    {
        $this->ajaxReturn(200, 'ok');
    }

}

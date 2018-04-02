<?php
class IndexController extends BaseController
{

    public function indexAction()
    {
        echo "<h1>Hello hg-phalcon!</h1>";die;
    }

    public function testAction()
    {
        echo "调用logic<br/>";
        echo loadLogic('Test')->getUser();
        echo "<br/>";
        echo 22333;die;
    }

}

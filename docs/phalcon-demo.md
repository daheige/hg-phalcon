# phalcon执行流程(public/index.php)
    <?php
    //简单demo
    try {
        // Register an autoloader
        $loader = new Phalcon\Loader();
        $loader->registerDirs([
            '../app/controllers/',
            '../app/models/',
        ])->register();

        // Create a DI
        $di = new Phalcon\Di\FactoryDefault();

        // Setup the view component
        $di->set('view', function () {
            $view = new Phalcon\Mvc\View();
            $view->setViewsDir('../app/views/');
            return $view;
        });

        // Setup a base URI so that all generated URIs include the "tutorial" folder
        $di->set('url', function () {
            $url = new Phalcon\Mvc\Url();
            $url->setBaseUri('/');
            return $url;
        });

        // Handle the request
        $application = new Phalcon\Mvc\Application($di);
        echo $application->handle()->getContent();die;

    } catch (\Exception $e) {
        echo "Exception: ", $e->getMessage();
    }

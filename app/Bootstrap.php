<?php

/**
 * Bootstrap
 * @copyright Copyright (c) 2011 - 2014 Aleksandr Torosh (http://wezoom.com.ua)
 * @author Aleksandr Torosh <webtorua@gmail.com>
 */
class Bootstrap
{

    public function run()
    {
        $di = new \Phalcon\DI\FactoryDefault();


        $config = include APPLICATION_PATH . '/config/config.php';
        $di->set('config', $config);


        $registry = new \Phalcon\Registry();


        $loader = new \Phalcon\Loader();
        $loader->registerNamespaces($config->loader->namespaces->toArray());
        $loader->registerDirs(array(APPLICATION_PATH . "/plugins/"));
        $loader->register();


        $db = new \Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" => $config->database->host,
            "username" => $config->database->username,
            "password" => $config->database->password,
            "dbname" => $config->database->dbname,
            "charset" => $config->database->charset,
        ));
        $di->set('db', $db);


        $view = new \Phalcon\Mvc\View();

        define('MAIN_VIEW_PATH', '../../../views/');
        $view->setMainView(MAIN_VIEW_PATH . 'main');
        $view->setLayoutsDir(MAIN_VIEW_PATH . '/layouts/');
        $view->setLayout('main');
        $view->setPartialsDir(MAIN_VIEW_PATH . '/partials/');

        $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
        $volt->setOptions(array('compiledPath' => APPLICATION_PATH . '/cache/volt/'));

        $phtml = new \Phalcon\Mvc\View\Engine\Php($view, $di);
        $viewEngines = array(
            ".volt" => $volt,
            ".phtml" => $phtml,
        );
        $registry->viewEngines = $viewEngines;

        $view->registerEngines($viewEngines);

        if (isset($_GET['_ajax']) && $_GET['_ajax']) {
            $view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_LAYOUT);
        }

        $di->set('view', $view);


        $viewSimple = new \Phalcon\Mvc\View\Simple();
        $viewSimple->registerEngines($viewEngines);
        $di->set('viewSimple', $viewSimple);


        $url = new \Phalcon\Mvc\Url();
        $url->setBasePath('/');
        $url->setBaseUri('/');

        $cacheFrontend = new \Phalcon\Cache\Frontend\Data(array(
            "lifetime" => 60,
            "prefix" => HOST_HASH,
        ));

        switch ($config->cache) {
            case 'file':
                $cache = new \Phalcon\Cache\Backend\File($cacheFrontend, array(
                    "cacheDir" => __DIR__ . "/cache/backend/"
                ));
                break;
            case 'memcache':
                $cache = new \Phalcon\Cache\Backend\Memcache(
                    $cacheFrontend, array(
                    "host" => "localhost",
                    "port" => "11211"
                ));
                break;
        }
        $di->set('cache', $cache, true);
        $di->set('modelsCache', $cache, true);

        \Application\Widget\Proxy::$cache = $cache; // Modules Widget System


        switch ($config->metadata_cache) {
            case 'memory':
                $modelsMetadata = new \Phalcon\Mvc\Model\Metadata\Memory();
                break;
            case 'apc':
                $modelsMetadata = new \Phalcon\Mvc\Model\MetaData\Apc(array(
                    "lifetime" => 60,
                    "prefix" => HOST_HASH,
                ));
                break;
        }
        $di->set('modelsMetadata', $modelsMetadata);


        $cmsModel = new \Cms\Model\Configuration();
        $registry->cms = $cmsModel->getConfig(); // Отправляем в Registry


        // Application
        $application = new \Phalcon\Mvc\Application();
        $application->registerModules($config->modules->toArray());


        // Events Manager, Dispatcher
        $eventsManager = new \Phalcon\Events\Manager();
        $dispatcher = new \Phalcon\Mvc\Dispatcher();


        $eventsManager->attach("dispatch:beforeDispatchLoop", function ($event, $dispatcher, $di) use ($di, $view, $config) {
            new LocalizationPlugin($dispatcher);
            new AdminLocalizationPlugin($config);
            new AclPlugin($di->get('acl'), $dispatcher, $view);
            new MobileDetectPlugin($di->get('session'), $view);
        });

        $eventsManager->attach("dispatch:afterDispatchLoop", function ($event, $dispatcher, $di) use ($di) {
            new \Seo\Plugin\SeoManagerPlugin($dispatcher, $di->get('request'), $di->get('router'), $di->get('view'));
            new TitlePlugin($di);
            new LastModifiedPlugin($di->get('response'));
        });

        if ($registry->cms['PROFILER']) {
            $profiler = new \Phalcon\Db\Profiler();
            $di->set('profiler', $profiler);

            $eventsManager->attach('db', function ($event, $db) use ($profiler) {
                if ($event->getType() == 'beforeQuery') {
                    $profiler->startProfile($db->getSQLStatement());
                }
                if ($event->getType() == 'afterQuery') {
                    $profiler->stopProfile();
                }
            });
        }

        $db->setEventsManager($eventsManager);


        $dispatcher->setEventsManager($eventsManager);
        $di->set('dispatcher', $dispatcher);


        // Session
        $session = new \Phalcon\Session\Adapter\Files();
        $session->start();
        $di->set('session', $session);

        $acl = new \Application\Acl\DefaultAcl();
        $di->set('acl', $acl);

        // Подключение JS
        $assetsManager = new \Application\Assets\Manager();
        $assetsManager->collection('js')
            ->setLocal(true)
            ->addFilter(new \Phalcon\Assets\Filters\Jsmin())
            ->setTargetPath(ROOT . '/assets/js.js')
            ->setTargetUri('assets/js.js')
            ->join(true)
            ->addJs(ROOT . "/vendor/history/native.history.js")
            ->addJs(ROOT . "/vendor/noty/jquery.noty.js")
            ->addJs(ROOT . "/vendor/noty/themes/default.js")
            ->addJs(ROOT . "/vendor/noty/layouts/center.js")
            ->addJs(ROOT . "/static/js/library.js")
            ->addJs(ROOT . "/static/js/rotation.js")
            ->addJs(ROOT . "/static/js/main.js")
            ->addJs(ROOT . "/static/js/ajax.js");

        // Подключение JS админ.панели
        $assetsManager->collection('modules-admin-js')
            ->setLocal(true)
            ->addFilter(new \Phalcon\Assets\Filters\Jsmin())
            ->setTargetPath(ROOT . '/assets/modules-admin.js')
            ->setTargetUri('assets/modules-admin.js')
            ->join(true);

        // Подключение LESS
        $assetsManager->collection('modules-less')
            ->setLocal(true)
            ->addFilter(new \Application\Assets\Filter\Less())
            ->setTargetPath(ROOT . '/assets/modules.less')
            ->setTargetUri('assets/modules.less')
            ->join(true);

        // Подключение LESS админ.панели
        $assetsManager->collection('modules-admin-less')
            ->setLocal(true)
            ->addFilter(new \Application\Assets\Filter\Less())
            ->setTargetPath(ROOT . '/assets/modules-admin.less')
            ->setTargetUri('assets/modules-admin.less')
            ->join(true);


        // Add css and js for view
        $assetsManager->collection('theme-css')
            ->addCss('//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext')
            ->addCss('//fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic')
            ->addCss('//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css')
            ->addCss('vendor/theme/js/bxslider/jquery.bxslider.css')
            ->addCss('vendor/theme/js/flexslider/flexslider.css')
            ->addCss('vendor/theme/js/radial-progress/style.css')
            ->addCss('vendor/theme/css/animate.css')
            ->addCss('vendor/theme/css/bootstrap.min.css')
            ->addCss('vendor/theme/js/bootstrap-progressbar/bootstrap-progressbar-3.2.0.min.css')
            ->addCss('vendor/theme/js/jqueryui/jquery-ui.css')
            ->addCss('vendor/theme/js/jqueryui/jquery-ui.structure.css')
            ->addCss('vendor/theme/js/fancybox/jquery.fancybox.css')
            ->addCss('vendor/theme/fonts/fonts.css')

            ->addCss('vendor/theme/css/main-yellow.css')
            ->addCss('vendor/theme/css/custom.css')
            ->addCss('vendor/theme/js/rs-plugin/css/settings.css')
            ->addCss('vendor/theme/js/rs-plugin/css/settings-custom.css')
            ->addCss('vendor/theme/js/rs-plugin/videojs/video-js.css')
            ->addCss('static/css/main.css');


        $assetsManager->collection('theme-js')
            ->addJs('vendor/theme/js/breakpoints.js')
            ->addJs('vendor/theme/js/jquery/jquery-1.11.1.min.js')
            ->addJs('vendor/theme/js/scrollspy.js')
            ->addJs('vendor/theme/js/bootstrap-progressbar/bootstrap-progressbar.js')
            ->addJs('vendor/theme/js/bootstrap.min.js')
            ->addJs('vendor/theme/js/masonry.pkgd.min.js')
            ->addJs('vendor/theme/js/imagesloaded.pkgd.min.js')
            ->addJs('vendor/theme/js/bxslider/jquery.bxslider.min.js')
            ->addJs('vendor/theme/js/flexslider/jquery.flexslider.js')
            ->addJs('vendor/theme/js/smooth-scroll/SmoothScroll.js')
            ->addJs('vendor/theme/js/jquery.carouFredSel-6.2.1-packed.js')
            ->addJs('vendor/theme/js/rs-plugin/js/jquery.themepunch.plugins.min.js')
            ->addJs('vendor/theme/js/rs-plugin/js/jquery.themepunch.revolution.min.js')
            ->addJs('vendor/theme/js/rs-plugin/videojs/video.js')
            ->addJs('vendor/theme/js/jqueryui/jquery-ui.js')
            ->addJs('vendor/theme/js/modules/sliders.js')
            ->addJs('vendor/theme/js/modules/ui.js')
            ->addJs('vendor/theme/js/modules/retina.js')
            ->addJs('vendor/theme/js/modules/animate-numbers.js')
            ->addJs('vendor/theme/js/modules/parallax-effect.js')
            ->addJs('vendor/theme/js/modules/settings.js')
            ->addJs('vendor/theme/js/modules/maps-google.js')
            ->addJs('vendor/theme/js/modules/color-themes.js')
            ->addJs('vendor/theme/js/audioplayer/js/jquery.jplayer.min.js')
            ->addJs('vendor/theme/js/audioplayer/js/jplayer.playlist.min.js')
            ->addJs('vendor/theme/js/radial-progress/jquery.easing.1.3.js')
            ->addJs('//cdnjs.cloudflare.com/ajax/libs/d3/3.4.13/d3.min.js')
            ->addJs('vendor/theme/js/radial-progress/radialProgress.js')
            ->addJs('vendor/theme/js/progressbars.js')
            ->addJs('vendor/theme/js/google-chart.js')
            ->addJs('vendor/theme/js/j.placeholder.js')
            ->addJs('vendor/theme/js/fancybox/jquery.fancybox.pack.js')
            ->addJs('vendor/theme/js/fancybox/jquery.mousewheel.pack.js')
            ->addJs('vendor/theme/js/fancybox/jquery.fancybox.custom.js')
            ->addJs('vendor/theme/js/user.js')
            ->addJs('vendor/theme/js/timeline.js')
            ->addJs('vendor/theme/js/fontawesome-markers.js')
            ->addJs('vendor/theme/js/markerwithlabel.js')
            ->addJs('vendor/theme/js/cookie.js')
            ->addJs('vendor/theme/js/loader.js')
            ->addJs('vendor/theme/js/scrollIt/scrollIt.min.js')
            ->addJs('vendor/theme/js/modules/navigation-slide.js');


        $di->set('assets', $assetsManager);

        $flash = new \Phalcon\Flash\Session(array(
            'error' => 'ui red inverted segment',
            'success' => 'ui green inverted segment',
            'notice' => 'ui blue inverted segment',
            'warning' => 'ui orange inverted segment',
        ));
        $di->set('flash', $flash);

        $di->set('helper', new \Application\Mvc\Helper());

        $di->set('registry', $registry);

        $router = new \Application\Mvc\Router\DefaultRouter();
        $router->setDi($di);
        foreach ($application->getModules() as $module) {
            $routesClassName = str_replace('Module', 'Routes', $module['className']);
            if (class_exists($routesClassName)) {
                $routesClass = new $routesClassName();
                $router = $routesClass->init($router);
            }
            $initClassName = str_replace('Module', 'Init', $module['className']);
            if (class_exists($initClassName)) {
                $initClass = new $initClassName();
                $initClass->init($di);
            }
        }
        $di->set('router', $router);

        $application->setDI($di);

        $this->dispatch($di);

    }

    private function dispatch($di)
    {
        $router = $di['router'];

        $router->handle();

        $view = $di['view'];

        $dispatcher = $di['dispatcher'];

        $response = $di['response'];

        $dispatcher->setModuleName($router->getModuleName());
        $dispatcher->setControllerName($router->getControllerName());
        $dispatcher->setActionName($router->getActionName());
        $dispatcher->setParams($router->getParams());

        $moduleName = \Application\Utils\ModuleName::camelize($router->getModuleName());

        $ModuleClassName = $moduleName . '\Module';
        if (class_exists($ModuleClassName)) {
            $module = new $ModuleClassName;
            $module->registerAutoloaders();
            $module->registerServices($di);
        }

        $view->start();

        $registry = $di['registry'];
        if ($registry->cms['DEBUG_MODE']) {
            $debug = new \Phalcon\Debug();
            $debug->listen();

            $dispatcher->dispatch();
        } else {
            try {
                $dispatcher->dispatch();
            } catch (\Phalcon\Exception $e) {
                $view->setViewsDir(__DIR__ . '/modules/Index/views/');
                $view->setPartialsDir('');
                $view->e = $e;

                if ($e instanceof \Phalcon\Mvc\Dispatcher\Exception) {
                    $response->setHeader(404, 'Not Found');
                    $view->partial('error/error404');
                } else {
                    $response->setHeader(503, 'Service Unavailable');
                    $view->partial('error/error503');
                }
                $response->sendHeaders();
                echo $response->getContent();
                return;

            }
        }

        $view->render(
            $dispatcher->getControllerName(),
            $dispatcher->getActionName(),
            $dispatcher->getParams()
        );

        $view->finish();

        $response = $di['response'];

        if (isset($_GET['_ajax']) && $_GET['_ajax']) {
            $contents = $view->getContent();

            $return = new \stdClass();
            $return->html = $contents;
            $return->title = $di->get('helper')->title()->get();
            $return->success = true;

            if ($view->bodyClass) {
                $return->bodyClass = $view->bodyClass;
            }

            $headers = $response->getHeaders()->toArray();
            if (isset($headers[404]) || isset($headers[503])) {
                $return->success = false;
            }
            $response->setContentType('application/json', 'UTF-8');
            $response->setContent(json_encode($return));
        } else {
            $response->setContent($view->getContent());
        }

        $response->sendHeaders();

        echo $response->getContent();
    }

}

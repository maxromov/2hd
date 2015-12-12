<?php

namespace api;

use Silex\Application;

class ServicesLoader
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function bindServicesIntoContainer()
    {
        $this->app['orders.service'] = $this->app->share(function () {
            return new Services\OrdersService($this->app["db"]);
        });
    }
}

<?php

namespace api;

use Silex\Application;

class RoutesLoader
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->instantiateControllers();
    }

    private function instantiateControllers()
    {
        $this->app['orders.controller'] = $this->app->share(function () {
            return new Controllers\OrdersController($this->app['orders.service']);
        });
    }

    public function bindRoutesToControllers()
    {
        $api = $this->app["controllers_factory"];

        $api->get('/orders', "orders.controller:getAll");
        $api->get('/orders/{id}', "orders.controller:get");
        $api->post('/orders', "orders.controller:save");
        $api->put('/orders/{id}', "orders.controller:update");
        $api->delete('/orders/{id}', "orders.controller:delete");

        $this->app->mount($this->app["api.endpoint"].'/'.$this->app["api.version"], $api);
    }
}

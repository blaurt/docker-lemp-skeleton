<?php

namespace Core;

use App\ProductServiceFactory;
use Exception;

abstract class Controller
{
    /**
     * Parameters from the matched route
     * @var array
     */
    protected $route_params = [];

    protected $serviceFactory;
    protected $templateEngine;

    /**
     * Class constructor
     *
     * @param array $route_params Parameters from the route
     *
     * @return void
     */
    public function __construct(array $route_params, ProductServiceFactory $serviceFactory,TemplateEngine $templateEngine)
    {
        $this->serviceFactory = $serviceFactory;
        $this->route_params = $route_params;
        $this->templateEngine = $templateEngine;
    }

    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. Used to execute before and after
     * filter methods on action methods. Action methods need to be named
     * with an "Action" suffix, e.g. indexAction, showAction etc.
     *
     * @param string $name Method name
     * @param array $args Arguments passed to the method
     *
     * @return void
     * @throws Exception
     */
    public function __call($name, $args)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            throw new Exception("Method $method not found in controller " . get_class($this));
        }
    }

    /**
     * Before filter - called before an action method.
     *
     * @return void
     */
    protected function before()
    {
    }

    /**
     * After filter - called after an action method.
     *
     * @return void
     */
    protected function after()
    {
    }

    /**
     * @param string $parameter
     * @return void
     */
    public function redirect(string $parameter)
    {
        header("Location: " . $parameter);
    }

    /**
     * @param $template
     * @param $args
     * @return mixed
     */
    public function render($template, $args = [])
    {
        return $this->templateEngine->render($template,$args);
    }
}

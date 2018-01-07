<?php
/**
 * Dispatcher.php
 *
 * @package   Here
 * @author    ShadowMan <shadowman@shellboot.com>
 * @copyright Copyright (C) 2016-2017 ShadowMan
 * @license   MIT License
 * @link      https://github.com/JShadowMan/here
 */
namespace Here\Lib\Router;
use Here\Config\Constant\SysConstant;
use Here\Config\Router\UserRouterLifeCycleHook;
use Here\Lib\Exceptions\ExceptionBase;
use Here\Lib\Router\Collector\Channel\RouterChannel;
use Here\Lib\Router\Collector\Channel\RouterChannelInterface;
use Here\Lib\Router\Collector\CollectorInterface;
use Here\Lib\Router\Collector\DispatchError;
use Here\Lib\Router\Collector\MetaSyntax\Compiler\AddMiddleware\AddMiddleware;
use Here\Lib\Router\Collector\RouterCollector;


/**
 * @TODO logger of any requests(DecoratorPattern)
 * @TODO request life-cycle(hook)
 */


/**
 * Class Router
 * @package Here\Lib\Router
 */
final class Dispatcher {
    /**
     * @var RouterCollector
     */
    private $_collector;

    /**
     * Dispatcher constructor.
     * @param CollectorInterface $collector
     */
    final public function __construct(CollectorInterface $collector) {
        $this->_collector = $collector;
    }

    /**
     * @param string $request_method
     * @param string $request_uri
     */
    final public function dispatch(string $request_method, string $request_uri): void {
        try {
            // on request received
//            UserRouterLifeCycleHook::on_request_enter();

            // check method is allowed
            if (!AllowedMethods::contains($request_method)) {
                $this->trigger_error(405, "`{$request_method}` is not allowed");
            }

            try {
                $trimmed_uri = trim($request_uri, SysConstant::URL_SEPARATOR);
                $channel = $this->_collector->dispatch($request_method, $trimmed_uri);

                $this->_exec_callback($channel);
            } catch (DispatchError $exception) {
                // check error handler exists?
                $this->trigger_error($exception->get_error_code(), $exception->get_message());
            }
        } catch (ExceptionBase $except) {

        }
    }

    /**
     * @param RouterChannel $channel
     */
    final private function _exec_callback(RouterChannel $channel): void {
        try {
            $middleware = $channel->get_middleware_component();
            if ($middleware instanceof AddMiddleware) {
                // running middleware
                foreach ($middleware as $middleware_name) {
                    $this->_collector->start_middleware($middleware_name);
                }
            }

            // hook of callback before and middleware
            $channel->apply_callback();
            // hook if callback after and logger
        } catch (\ArgumentCountError $e) {}
    }

    /**
     * @param int $error_code
     * @param array ...$args
     */
    final public function trigger_error(int $error_code, ...$args): void {
        RouterResponse::response_status_code($error_code);
        var_dump($error_code, $args);
    }
}

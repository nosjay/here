<?php
/**
 * RouterCollector.php
 *
 * @package   Here
 * @author    ShadowMan <shadowman@shellboot.com>
 * @copyright Copyright (C) 2016-2017 ShadowMan
 * @license   MIT License
 * @link      https://github.com/JShadowMan/here
 */
namespace Here\Lib\Router\Collector;

/**
 * Class RouterCollector
 * @package Here\Lib\Router\Collector
 */
abstract class RouterCollector {
    /**
     * @NotRouterNode
     * RouterCollector constructor.
     */
    final public function __construct() {
        $ref = new \ReflectionClass(get_class($this));
        foreach ($ref->getMethods() as $method) {
            var_dump($method);
        }
    }
}

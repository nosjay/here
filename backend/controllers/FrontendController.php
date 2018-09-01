<?php
/**
 * FrontendController.php
 *
 * @package   here
 * @author    ShadowMan <shadowman@shellboot.com>
 * @copyright Copyright (C) 2016-2018 ShadowMan
 * @license   MIT License
 * @link      https://github.com/JShadowMan/here
 */
namespace Here\Controllers;


use Here\Libraries\RSA\RSAGenerator;

/**
 * Class EnvironmentController
 * @package Here\Controllers
 */
final class FrontendController extends ControllerBase {

    /**
     * initializing frontend environment
     * @throws \Exception
     */
    final public function initAction() {
        return $this->makeResponse(self::STATUS_OK, null, array(
            'security' => array(
                'rsa' => RSAGenerator::generate()->get(),
                'mask' => random_int(1000, 9999)
            ),
            'install' => true
        ));
    }

}

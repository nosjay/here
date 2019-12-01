<?php
/**
 * here application
 *
 * @package   here
 * @author    Jayson Wang <jayson@laboys.org>
 * @copyright Copyright (C) 2016-2019 Jayson Wang
 * @license   MIT License
 * @link      https://github.com/lsalio/here
 */
namespace Here\Library\Mvc\Controller;

use Phalcon\Cache\BackendInterface;
use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\Controller;
use Phalcon\Translate\Adapter;


/**
 * Class AbstractController
 * @package Here\Library\Mvc\Controller
 * @property BackendInterface $cache
 */
abstract class AbstractController extends Controller {

    /**
     * @var Adapter
     */
    protected $translator;

    /**
     * Setups the administrator for application when
     * administrator has not loaded
     *
     * @return ResponseInterface|void
     */
    public function initialize() {
        $this->translator = container('translator');
        // Redirect to setup page when administrator not loaded
        if (!container('administrator')->exists()) {
            if ($this->dispatcher->getControllerName() !== 'setup') {
                return $this->response->redirect(['for' => 'setup-wizard']);
            }
        }
    }

}

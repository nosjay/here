<?php
/**
 * here application
 *
 * @package   here
 * @author    Jayson Wang <jayson@laboys.org>
 * @copyright Copyright (C) 2016-2019 Jayson Wang
 * @license   MIT License
 * @link      https://github.com/nosjay/here
 */
namespace Here\Library\Mvc\Controller;

use Here\Library\Mvc\Component\Token;
use Phalcon\Mvc\Controller;


/**
 * Class AbstractController
 * @package Here\Library\Mvc\Controller
 */
abstract class AbstractController extends Controller {

    /**
     * Component of csrf generator/validator
     */
    use Token;

}

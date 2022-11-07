<?php

namespace App\Controllers;

use App\Models\VisitorModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        // Session
        $this->session = \Config\Services::session();

        // Cek Visitor
        $visitorModel = new VisitorModel();
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $agent = $this->request->getUserAgent();
        if ($agent->isBrowser()) {
            $agent = $agent->getBrowser() . ' ' . $agent->getVersion();
        } elseif ($agent->isRobot()) {
            $agent = $agent->getRobot();
        } elseif ($agent->isMobile()) {
            $agent = $agent->getMobile();
        } else {
            $agent = 'Unidentified User Agent';
        }
        $visitorModel->count_visitor($user_ip, $agent);
    }
}
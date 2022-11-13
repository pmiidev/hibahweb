<?php

namespace App\Controllers;

use App\Models\UserModel;
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

        // Akun login
        if (session('role')) {
            $this->akunModel = new UserModel();
            $this->akun = $this->akunModel->where('user_id', session('id'))->first();
        }

        // Nav Active Admin
        if (session('role') == 'admin') {
            if (url_is('admin')) {
                $this->active = 'dashboard';
            } elseif (url_is('admin/post*') || url_is('admin/category') || url_is('admin/tag')) {
                $this->active = 'post';
            } elseif (url_is('admin/inbox*')) {
                $this->active = 'inbox';
            } elseif (url_is('admin/comment*')) {
                $this->active = 'comment';
            } elseif (url_is('admin/subscriber*')) {
                $this->active = 'subscriber';
            } elseif (url_is('admin/member*')) {
                $this->active = 'member';
            } elseif (url_is('admin/testimonial*')) {
                $this->active = 'testimonial';
            } elseif (url_is('admin/team*')) {
                $this->active = 'team';
            } elseif (url_is('admin/users*')) {
                $this->active = 'users';
            } elseif (url_is('admin/setting*')) {
                $this->active = 'setting';
            }
        }
        // Nav Active Author
        if (session('role') == 'author') {
            if (url_is('author')) {
                $this->active = 'dashboard';
            } elseif (url_is('author/post*') || url_is('author/category') || url_is('author/tag')) {
                $this->active = 'post';
            } elseif (url_is('author/inbox*')) {
                $this->active = 'inbox';
            } elseif (url_is('author/comment*')) {
                $this->active = 'comment';
            } elseif (url_is('author/subscriber*')) {
                $this->active = 'subscriber';
            } elseif (url_is('author/member*')) {
                $this->active = 'member';
            } elseif (url_is('author/testimonial*')) {
                $this->active = 'testimonial';
            } elseif (url_is('author/team*')) {
                $this->active = 'team';
            } elseif (url_is('author/users*')) {
                $this->active = 'users';
            } elseif (url_is('author/setting*')) {
                $this->active = 'setting';
            }
        }
    }
}

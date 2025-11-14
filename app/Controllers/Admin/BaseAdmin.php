<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseAdmin extends BaseController
{
    protected $helpers = [];
    /**
     * @var \CodeIgniter\Session\SessionInterface
     */
    protected $session;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Load session and require admin for all admin controllers except the Auth controller
        $this->session = service('session');

        // allow access to login/logout without redirect loop
        $uri = service('uri');
        $segment1 = $uri->getSegment(1);
        $segment2 = $uri->getSegment(2);

        // If not authenticated and not on auth pages, redirect to admin login
        if (! $this->session->get('is_admin')) {
            // allow access to auth controller
            if (! ($segment1 === 'admin' && $segment2 === 'auth')) {
                // Use header redirect to avoid needing Response object here
                header('Location: /admin/auth/login');
                exit;
            }
        }
    }
}


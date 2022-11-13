<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// HomeController
$routes->get('/', 'HomeController::index', ['filter' => 'logedin']);

// SubscribeController
$routes->get('subscribe', static function () {
    return redirect()->to('/#footer');
});
$routes->post('subscribe', 'SubscribeController::index');

// GalleryController
$routes->get('gallery', 'GalleryController::index');

// TeamController
$routes->get('team', 'TeamController::index');

// PostController
$routes->get('search', 'PostController::search');
$routes->get('post', 'PostController::index');
$routes->get('post/(:segment)', 'PostController::index/$1');
$routes->get('tag/(:segment)', 'PostController::tag/$1');
$routes->post('post/send_comment', 'PostController::send_comment');

// CategoryController
$routes->get('category/(:segment)', 'CategoryController::index/$1');

// DocumentController
$routes->get('document', 'DocumentController::index');

// ContactController
$routes->get('contact', 'ContactController::index');

// LoginController & Logout
$routes->group('', ['filter' => 'logedin'], static function ($routes) {
    $routes->get('login', 'LoginController::index');
    $routes->post('login/validasi', 'LoginController::validasi');
});
$routes->get('logout', 'LoginController::logout');

// Admin Routes
$routes->group('admin', ['filter' => 'authadmin'], static function ($routes) {
    $routes->get('', 'Admin\AdminController::index');
    // Post Route
    $routes->group('post', static function ($routes) {
        $routes->get('', 'Admin\PostAdminController::index');
        $routes->post('', 'Admin\PostAdminController::publish');
        $routes->delete('', 'Admin\PostAdminController::delete');
        $routes->put('', 'Admin\PostAdminController::update');
        $routes->get('add_new', 'Admin\PostAdminController::add_new');
        $routes->get('(:num)/edit', 'Admin\PostAdminController::edit/$1');
    });
    // Category Route
    $routes->group('category', static function ($routes) {
        $routes->get('', 'Admin\CategoryAdminController::index');
        $routes->post('', 'Admin\CategoryAdminController::save');
        $routes->put('', 'Admin\CategoryAdminController::edit');
        $routes->delete('', 'Admin\CategoryAdminController::delete');
    });
    // Tag Route
    $routes->group('tag', static function ($routes) {
        $routes->get('', 'Admin\TagAdminController::index');
        $routes->post('', 'Admin\TagAdminController::save');
        $routes->put('', 'Admin\TagAdminController::edit');
        $routes->delete('', 'Admin\TagAdminController::delete');
    });
    // Inbox Route
    $routes->group('inbox', static function ($routes) {
        $routes->get('', 'Admin\InboxAdminController::index');
        $routes->get('(:num)', 'Admin\InboxAdminController::read/$1');
        $routes->delete('', 'Admin\InboxAdminController::delete');
    });
    // Comment Route
    $routes->group('comment', static function ($routes) {
        $routes->get('', 'Admin\CommentAdminController::index');
        $routes->post('', 'Admin\CommentAdminController::reply');
        $routes->post('publish', 'Admin\CommentAdminController::publish');
        $routes->put('', 'Admin\CommentAdminController::edit');
        $routes->delete('', 'Admin\CommentAdminController::delete');
        $routes->get('unpublish', 'Admin\CommentAdminController::unpublish');
    });
    // Subscriber Route
    $routes->group('subscriber', static function ($routes) {
        $routes->get('', 'Admin\SubscriberAdminController::index');
        $routes->delete('', 'Admin\SubscriberAdminController::delete');
        $routes->get('increase/(:num)', 'Admin\SubscriberAdminController::increase/$1');
        $routes->get('decrease/(:num)', 'Admin\SubscriberAdminController::decrease/$1');
        $routes->get('activate/(:num)', 'Admin\SubscriberAdminController::activate/$1');
        $routes->get('deactivate/(:num)', 'Admin\SubscriberAdminController::deactivate/$1');
    });
    // Member Route
    $routes->group('member', static function ($routes) {
        $routes->get('', 'Admin\MemberAdminController::index');
        $routes->post('', 'Admin\MemberAdminController::insert');
        $routes->put('', 'Admin\MemberAdminController::update');
        $routes->delete('', 'Admin\MemberAdminController::delete');
    });
    // Testimonial Route
    $routes->group('testimonial', static function ($routes) {
        $routes->get('', 'Admin\TestimonialAdminController::index');
        $routes->post('', 'Admin\TestimonialAdminController::insert');
        $routes->put('', 'Admin\TestimonialAdminController::update');
        $routes->delete('', 'Admin\TestimonialAdminController::delete');
    });
    // Team Route
    $routes->group('team', static function ($routes) {
        $routes->get('', 'Admin\TeamAdminController::index');
        $routes->post('', 'Admin\TeamAdminController::insert');
        $routes->put('', 'Admin\TeamAdminController::update');
        $routes->delete('', 'Admin\TeamAdminController::delete');
    });
    // Users Route
    $routes->group('users', static function ($routes) {
        $routes->get('', 'Admin\UsersAdminController::index');
        $routes->post('', 'Admin\UsersAdminController::insert');
        $routes->put('', 'Admin\UsersAdminController::update');
        $routes->delete('', 'Admin\UsersAdminController::delete');
        $routes->get('deactivate/(:num)', 'Admin\UsersAdminController::deactivate/$1');
        $routes->get('activate/(:num)', 'Admin\UsersAdminController::activate/$1');
    });
    // Setting Route
    $routes->group('setting', static function ($routes) {
        $routes->get('', static function () {
            return redirect()->to('admin/setting/profile');
        });
        // Setting My Profile
        $routes->get('profile', 'Admin\SettingAdminController::profile');
        $routes->post('profile', 'Admin\SettingAdminController::profile_update');
        $routes->put('profile', 'Admin\SettingAdminController::profile_password');
        // Setting Web
        $routes->get('web', 'Admin\SettingAdminController::web');
        $routes->put('web', 'Admin\SettingAdminController::web_update');

        // Setting Home
        $routes->get('home', 'Admin\SettingAdminController::home');
        $routes->put('home', 'Admin\SettingAdminController::home_update');

        // Setting About
        $routes->get('about', 'Admin\SettingAdminController::about');
        $routes->put('about', 'Admin\SettingAdminController::about_update');
    });
});

// User Routes
$routes->group('author', ['filter' => 'authauthor'], static function ($routes) {
    $routes->get('', 'Author\AuthorController::index');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

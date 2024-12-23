<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->post('/', 'Auth::index');
$routes->post('/login', 'Auth::UserAuth');
$routes->get('/logout', 'Auth::Logout');
$routes->get('/dashboard', 'Home::index');
$routes->get('/user', 'Home::User');
$routes->get('/profile', 'Home::Profile');
$routes->get('/book-list', 'Home::BookList');
$routes->post('/change-user-status', 'Home::ChangeuserStatus');
$routes->post('/user-add', 'Home::UserAdd');
$routes->post('/user-delete', 'Home::DeleteUser');
$routes->post('/user-profile-update', 'Home::ProfileUpload');
$routes->post('/update-password', 'Home::UpdateUserPassword');
$routes->get('/reset-password', 'Auth::ResetPassword');
$routes->post('/reset-user-pass', 'Auth::ResetPass');



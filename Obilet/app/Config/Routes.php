<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php'))
{
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
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('info', 'Home::getInfo');

$routes->get('listroles', 'RolesController::listRoles');
$routes->post('rolesassign', 'RolesController::assignRole'); 
$routes->post('rolesedit/(:num)', 'RolesController::editRole/$1'); 


$routes->get('getcities', 'TerminalsController::getAll');
$routes->post('terminalsstore', 'TerminalsController::store');
$routes->post('terminalsdelete/(:num)', 'TerminalsController::delete/$1');
$routes->get('terminalsindex', 'TerminalsController::index');
$routes->get('terminalsshow/(:num)', 'TerminalsController::show/$1');
$routes->get('terminaledit/(:num)', 'TerminalsController::edit/$1');
$routes->post('terminalsupdate/(:num)', 'TerminalsController::update/$1');

$routes->post('authenticate', 'UserLogin::authenticate');

$routes->post('adminlogin', 'AdminLoginController::authenticate');

$routes->post('userregister', 'UserLogin::register');

$routes->post('seferlerial','BusRoutesController::getRoutes');
$routes->get('bus_routes', 'BusRoutesController::index');
$routes->post('bus_routesstore', 'BusRoutesController::store');
$routes->get('bus_routesedit/(:num)', 'BusRoutesController::edit/$1');
$routes->post('bus_routesupdate/(:num)', 'BusRoutesController::update/$1');
$routes->post('bus_routesdelete/(:num)', 'BusRoutesController::delete/$1');

$routes->get('UserProfile', 'UserProfileController::index');
$routes->post('UserProfileupdate', 'UserProfileController::update');

$routes->post('pnrcontrol','TicketsController::checkPnr');
$routes->get('ticketslist', 'TicketsController::index');
$routes->post('ticketsstore', 'TicketsController::store');
$routes->get('ticketsshow/(:num)', 'TicketsController::show/$1');
$routes->post('ticketsupdate/(:num)', 'TicketsController::update/$1');
$routes->post('ticketsdestroy/(:num)', 'TicketsController::destroy/$1');

$routes->post('register', 'UserRegisterController::registerUsers');

$routes->get('adminprofile', 'AdminProfileController::index');
$routes->post('adminupdate', 'AdminProfileController::update');

$routes->get('adminreservations', 'AdminReservationController::index');
$routes->get('adminreservationsshow/(:num)', 'AdminReservationController::show/$1');
$routes->get('adminreservationsedit/(:num)', 'AdminReservationController::edit/$1');
$routes->post('adminreservationsupdate/(:num)', 'AdminReservationController::update/$1');
$routes->post('adminreservationsdelete/(:num)', 'AdminReservationController::delete/$1');
$routes->get('adminreservationsuser-list', 'AdminReservationController::userList');
$routes->get('adminreservationsuser-reservations/(:num)', 'AdminReservationController::userReservations/$1');

$routes->get('adminuserlist', 'AdminUserController::adminuserlist');

$routes->get('buscompanieslist', 'BusCompanies::busCompaniesList');
$routes->get('BusCompaniescreate', 'BusCompaniesController::create');
$routes->post('BusCompaniesstore', 'BusCompaniesController::store');
$routes->get('BusCompaniesedit/(:num)', 'BusCompaniesController::edit/$1');
$routes->post('BusCompaniesupdate/(:num)', 'BusCompaniesController::update/$1');
$routes->post('BusCompaniesdelete/(:num)', 'BusCompaniesController::delete/$1');
$routes->get('BusCompaniesshow/(:num)', 'BusCompaniesController::show/$1');

$routes->get('paymentsindex', 'PaymentController::index');
$routes->post('paymentsstore', 'PaymentController::store');
$routes->get('paymentsshow/(:num)', 'PaymentController::show/$1');
$routes->get('paymentsedit/(:num)', 'PaymentController::edit/$1');
$routes->post('paymentsupdate/(:num)', 'PaymentController::update/$1');
$routes->post('paymentsdelete/(:num)', 'PaymentController::delete/$1');

$routes->get('reservationsindex', 'ReservationController::index');
$routes->post('reservationsstore', 'ReservationController::store');
$routes->get('reservationsshow/(:num)', 'ReservationController::show/$1');
$routes->post('reservationsupdate/(:num)', 'ReservationController::update/$1');
$routes->post('reservationsdelete/(:num)', 'ReservationController::delete/$1');

$routes->get('seatsindex', 'Seats::index');
$routes->post('seatsstore', 'Seats::store');
$routes->get('seatsedit/(:num)', 'Seats::edit/$1');
$routes->post('seatsupdate/(:num)', 'Seats::update/$1');
$routes->put('seatsdelete/(:num)', 'Seats::delete/$1');

$routes->get('terminalsindex', 'TerminalsController::index');
$routes->post('terminalsstore', 'TerminalsController::store');
$routes->get('terminalsshow/(:num)', 'TerminalsController::show/$1');
$routes->post('terminalsupdate/(:num)', 'TerminalsController::update/$1');
$routes->post('terminalsdelete/(:num)', 'TerminalsController::delete/$1');
$routes->get('terminalsedit/(:num)', 'TerminalsController::edit/$1');

$routes->get('user_reservation', 'UserReservationController::index');
$routes->post('user_reservationstore', 'UserReservationController::store');
$routes->post('user_reservationupdate/(:num)', 'UserReservationController::update/$1');
$routes->post('user_reservationedit/(:num)', 'UserReservationController::edit/$1');
$routes->post('user_reservationshow/(:num)', 'UserReservationController::show/$1');
$routes->delete('user_reservationdelete/(:num)', 'UserReservationController::delete/$1');
$routes->post('purchaseWithCreditCard/(:num)', 'UserReservationController::purchaseWithCreditCard/$1');


$routes->post('purchaseWithCreditCard/(:num)', 'UserReservationController::purchaseWithCreditCard/$1');
$routes->post('cancelReservation/(:num)/(:num)', 'UserReservationController::cancelReservation/$1/$2');
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
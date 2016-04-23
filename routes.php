<?php


// register routes
$router->map('GET', '/register', 'Acme\Controllers\RegisterController@getShowRegisterPage', 'register');
$router->map('POST', '/register', 'Acme\Controllers\RegisterController@postShowRegisterPage', 'register_post');
$router->map('GET', '/verify-account', 'Acme\Controllers\RegisterController@getVerifyAccount', 'verify_account');
//$router->map('GET', '/account-activated', 'Acme\Controllers\PageController@getShowPage', 'account-activated');

// testimonial routes
$router->map('GET', '/testimonials', 'Acme\Controllers\TestimonialController@getShowTestimonials');


// logged in user routes
if(\Acme\Auth\LoggedIn::user()) {

    $router->map('GET', '/add-testimonial', 'Acme\Controllers\TestimonialController@getShowAdd', 'add_testimonial');
    $router->map('POST', '/add-testimonial', 'Acme\Controllers\TestimonialController@postShowAdd', 'add_testimonial_post');
}
$router->map('POST', '/admin/page/edit', 'Acme\Controllers\AdminController@postSavePage', 'save_page');
// admin login/ logout routes

// login/logout routes
$router->map('GET', '/login', 'Acme\Controllers\AuthenticationController@getShowLoginPage', 'login');
$router->map('POST', '/login', 'Acme\Controllers\AuthenticationController@postShowLoginPage', 'login_post');
$router->map('GET', '/logout', 'Acme\Controllers\AuthenticationController@getLogout', 'logout');
$router->map('GET', '/testuser', 'Acme\Controllers\AuthenticationController@getTestUser', 'testuser');
$router->map('GET', '/testemail', function(){
    $message = "";
     Acme\Email\sendEmail::sendEmail('john@here', 'My test subject', 'My message', 'somebody@unb.ca');
});



// pages routes
$router->map('GET', '/', 'Acme\Controllers\PageController@getShowHomePage', 'home');
$router->map('GET', '/page-not-found', 'Acme\Controllers\PageController@getShow404', '404' );
$router->map('GET', '/success', 'Acme\Controllers\PageController@getShowPage', 'success');
$router->map('GET', '/[*]', 'Acme\Controllers\PageController@getShowPage', 'generic_page' );
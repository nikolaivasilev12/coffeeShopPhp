<?php

Route::set('index.php', function() {
    Index::CreateView('Index');
});
Route::set('index', function() {
    Index::CreateView('Index');
});
Route::set('about-us', function() {
    AboutUs::CreateView('AboutUs');
});
Route::set('contact-us', function() {
    ContactUs::CreateView('ContactUs');
});
Route::set('login', function() {
    LoginUser::CreateView('Login');
});
Route::set('logout', function() {
    new Logoutor;
    Logoutor::CreateView('Login');
});
Route::set('product', function() {
    Products::CreateView('Products');
});
Route::set('new-user', function() {
    NewUser::CreateView('newUser');
});
Route::set('admin', function() {
    Admin::CreateView('Admin');
});
Route::set('edit-categories', function() {
    Admin::CreateView('editCategories');
});
Route::set('edit-products', function() {
    Admin::CreateView('editProducts');
});
Route::set('edit-news', function() {
    Admin::CreateView('editNews');
});
Route::set('edit-company', function() {
    Admin::CreateView('editCompanyInfo');
});
Route::set('chat', function() {
    Controller::CreateChat('chat');
});
Route::set('botman', function() {
    Controller::CreateView('botman');
});
Route::set('checkout', function() {
    Controller::CreateView('checkout');
});
Route::set('cartJS', function() {
    Controller::loadJS('cart');
});
Route::set('handle-cart-ep', function() {
    Controller::loadCartHandler('handle-cart-ep');
});
Route::set('profile', function() {
    Profile::CreateView('profile');
});
Route::set('edit-profile', function() {
    Admin::CreateView('editProfile');
});
Route::set('new-product', function() {
    Admin::CreateView('newProduct');
});
Route::set('checkout-success', function() {
    Controller::CreateView('checkoutSuccess');
});
Route::set('checkout-fail', function() {
    Controller::CreateView('checkoutFail');
});


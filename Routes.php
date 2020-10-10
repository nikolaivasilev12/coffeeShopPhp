<?php

Route::set('index.php', function() {
    Index::CreateView('Index');
});

Route::set('index', function() {
    Index::CreateView('Index');
});

Route::set('about-us', function() {
    AboutUs::CreateView('AboutUs');
    AboutUs::test();
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

Route::set('categories', function() {
    Products::CreateView('Categories');
    // new Products();
});
Route::set('product', function() {
    Products::CreateView('Products');
    // new Products();
});
Route::set('new-user', function() {
    Products::CreateView('newUser');
    // new Products();
});
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

Route::set('products', function() {
    Products::CreateView('Products');
});
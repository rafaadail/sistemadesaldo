<?php

$this->group(['middleware' => ['auth'], 'namespace' => 'Admin'], function(){
    $this->get('admin', 'AdminController@index')->name('admin.home');
});


$this->get('/', 'Site\AdminController@index')->name('home');


Auth::routes();



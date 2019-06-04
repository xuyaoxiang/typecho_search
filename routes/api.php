<?php
use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'middleware' => ['cors'],
    'namespace' => 'App\Http\Controllers\Api',
], function($api) {
    // 搜索
    $api->post('search', 'SearchController@index');

    $api->post('tag', 'SearchController@tag');
});

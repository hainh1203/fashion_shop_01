<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->name('api.')->group(function () {

    // Comment
    Route::apiResource('comment', 'CommentController')->only(['store', 'destroy']);

    // Notification
    Route::apiResource('notification', 'NotificationController')->only('update');

    // Category
    Route::delete('category/soft-delete/{category}', 'CategoryController@softDelete')->name('category.soft_delete');

    Route::put('category/restore/{id}', 'CategoryController@restoreItem')->name('category.restore.item');

    Route::delete('category/force-delete/{id}', 'CategoryController@forceDelete')->name('category.force_delete');

    Route::put('category/update/{category}', 'CategoryController@update')->name('category.update');

    Route::put('category/sort-order', 'CategoryController@sortOrder')->name('category.sort_order');

    // Brand
    Route::delete('brand/soft-delete/{id}', 'BrandController@softDelete')->name('brand.soft_delete');

    Route::put('brand/restore/{id}', 'BrandController@restoreItem')->name('brand.restore.item');

    Route::delete('brand/force-delete/{id}', 'BrandController@forceDelete')->name('brand.force_delete');

    Route::put('brand/update/{id}', 'BrandController@update')->name('brand.update');

    // Slider
    Route::delete('slider/soft-delete/{slider}', 'SliderController@softDelete')->name('slider.soft_delete');

    Route::put('slider/restore/{id}', 'SliderController@restoreItem')->name('slider.restore.item');

    Route::delete('slider/force-delete/{id}', 'SliderController@forceDelete')->name('slider.force_delete');

    Route::put('slider/update/{slider}', 'SliderController@update')->name('slider.update');

    // Tag
    Route::get('tag', 'TagController@index')->name('tag.index');

    Route::delete('tag/soft-delete/{tag}', 'TagController@softDelete')->name('tag.soft_delete');

    Route::put('tag/restore/{id}', 'TagController@restoreItem')->name('tag.restore.item');

    Route::delete('tag/force-delete/{id}', 'TagController@forceDelete')->name('tag.force_delete');

    Route::put('tag/update/{tag}', 'TagController@update')->name('tag.update');

    // Post
    Route::delete('post/soft-delete/{post}', 'PostController@softDelete')->name('post.soft_delete');

    Route::put('post/restore/{id}', 'PostController@restoreItem')->name('post.restore.item');

    Route::delete('post/force-delete/{id}', 'PostController@forceDelete')->name('post.force_delete');

    Route::put('post/update/{post}', 'PostController@update')->name('post.update');

    // Product
    Route::delete('product/soft-delete/{product}', 'ProductController@softDelete')->name('product.soft_delete');

    Route::put('product/restore/{id}', 'ProductController@restoreItem')->name('product.restore.item');

    Route::delete('product/force-delete/{id}', 'ProductController@forceDelete')->name('product.force_delete');

    Route::put('product/update/{product}', 'ProductController@update')->name('product.update');

    // Order
    Route::delete('order/soft-delete/{order}', 'OrderController@softDelete')->name('order.soft_delete');

    Route::put('order/restore/{id}', 'OrderController@restoreItem')->name('order.restore.item');

    Route::delete('order/force-delete/{id}', 'OrderController@forceDelete')->name('order.force_delete');

    Route::put('order/update/{order}', 'OrderController@update')->name('order.update');

    // User
    Route::delete('user/soft-delete/{user}', 'UserController@softDelete')->name('user.soft_delete');

    Route::put('user/restore/{id}', 'UserController@restoreItem')->name('user.restore.item');

    Route::delete('user/force-delete/{id}', 'UserController@forceDelete')->name('user.force_delete');

});

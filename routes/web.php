<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::name('frontend.')->group(function () {

    // page static
    Route::view('gioi-thieu.html', 'frontend.page.about_us')->name('page.about_us');

    Route::view('lien-he.html', 'frontend.page.contact')->name('page.contact');

    Route::namespace('Frontend')->group(function () {

        Route::get('/', 'HomeController@main')->name('home.main');

        Route::get('tim-kiem', 'HomeController@search')->name('home.search');

        // Cart
        Route::get('gio-hang.html', 'CartController@index')->name('cart.index');

        Route::get('thanh-toan.html', 'CartController@checkout')->name('cart.checkout');

        Route::post('thanh-toan.html', 'CartController@storeOrder')->name('order.store');

        Route::view('dat-hang-thanh-cong.html', 'frontend.cart.order_success')->name('order.success');

        Route::post('cart', 'CartController@add')->name('cart.add');

        Route::delete('cart/remove', 'CartController@remove')->name('cart.remove');

        Route::patch('cart/remove', 'CartController@update')->name('cart.update');

        // product
        Route::get('san-pham/{slug}.html', 'CategoryController@products')->name('category.product');

        Route::get('san-pham', 'ProductController@search')->name('product.search');

        Route::get('chi-tiet-san-pham/{slug}.html', 'ProductController@show')->name('product.show');

        // post
        Route::get('tin-tuc/{slug}.html', 'CategoryController@posts')->name('category.post');

        Route::get('chi-tiet-bai-viet/{slug}.html', 'PostController@show')->name('post.show');

        // tag
        Route::get('tag/{slug}.html', 'TagController@posts')->name('tag.posts');

        // brand
        Route::get('thuong-hieu/{slug}.html', 'BrandController@products')->name('brand.products');

        Route::middleware('auth')->group(function () {
            // Wish list
            Route::get('danh-sach-yeu-thich.html', 'WishListController@index')->name('wish_list.index');

            Route::delete('wish-list', 'WishListController@destroy')->name('wish_list.destroy');

            Route::post('wish-list', 'WishListController@store')->name('wish_list.store');

            // User
            Route::get('tai-khoan-cua-toi.html', 'UserController@myProfile')->name('user.my_profile');

            Route::get('don-hang-cua-toi.html', 'UserController@myOrder')->name('user.my_order');

            Route::get('don-hang-cua-toi/{id}', 'UserController@myOrderDetail')->name('user.my_order_detail');
        });

    });

});

Route::namespace('Auth')->middleware('auth')->group(function () {

    Route::put('user/change-info', 'UserController@changeInfo')->name('user.change_info');

    Route::put('user/change-password', 'UserController@changePassword')->name('user.change_password');

});

// Store review
Route::middleware('auth')->post('admin/review', 'Backend\ReviewController@store')->name('review.store');

Route::namespace('Backend')->prefix('admin')->middleware(['auth', 'check.role'])->group(function () {

    // Notification
    Route::view('notification', 'backend.notification.index')->name('notification.index');

    // Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');

    // Category
    Route::resource('category', 'CategoryController')->only(['store', 'edit', 'update']);

    Route::get('category-{type}', 'CategoryController@index')->name('category.index');

    Route::get('category-{type}/create', 'CategoryController@create')->name('category.create');

    Route::get('category-{type}/sort-order', 'CategoryController@sortOrder')->name('category.sort_order');

    Route::get('category-{type}/trash', 'CategoryController@trash')->name('category.trash');

    Route::post('category-{type}/restore', 'CategoryController@restore')->name('category.restore');

    Route::get('category-{type}/restore-all', 'CategoryController@restoreAll')->name('category.restore.all');

    Route::get('category-{type}/restore-time/{time}', 'CategoryController@restoreTime')->name('category.restore.time');

    // Product
    Route::resource('product', 'ProductController')->except(['show', 'destroy']);

    Route::get('product/trash', 'ProductController@trash')->name('product.trash');

    Route::post('product/restore', 'ProductController@restore')->name('product.restore');

    Route::get('product/restore-all', 'ProductController@restoreAll')->name('product.restore.all');

    Route::get('product/restore-time/{time}', 'ProductController@restoreTime')->name('product.restore.time');

    // Brand
    Route::resource('brand', 'BrandController')->except(['show', 'destroy']);

    Route::get('brand/trash', 'BrandController@trash')->name('brand.trash');

    Route::post('brand/restore', 'BrandController@restore')->name('brand.restore');

    Route::get('brand/restore-all', 'BrandController@restoreAll')->name('brand.restore.all');

    Route::get('brand/restore-time/{time}', 'BrandController@restoreTime')->name('brand.restore.time');

    // Tag
    Route::resource('tag', 'TagController')->except(['show', 'destroy']);

    Route::get('tag/trash', 'TagController@trash')->name('tag.trash');

    Route::post('tag/restore', 'TagController@restore')->name('tag.restore');

    Route::get('tag/restore-all', 'TagController@restoreAll')->name('tag.restore.all');

    Route::get('tag/restore-time/{time}', 'TagController@restoreTime')->name('tag.restore.time');

    // Post
    Route::resource('post', 'PostController')->except(['show', 'destroy']);

    Route::get('post/trash', 'PostController@trash')->name('post.trash');

    Route::post('post/restore', 'PostController@restore')->name('post.restore');

    Route::get('post/restore-all', 'PostController@restoreAll')->name('post.restore.all');

    Route::get('post/restore-time/{time}', 'PostController@restoreTime')->name('post.restore.time');

    // Comment
    Route::resource('comment', 'CommentController')->only(['index', 'destroy']);

    // Slider
    Route::resource('slider', 'SliderController')->except(['show', 'destroy']);

    Route::get('slider/trash', 'SliderController@trash')->name('slider.trash');

    Route::post('slider/restore', 'SliderController@restore')->name('slider.restore');

    Route::get('slider/restore-all', 'SliderController@restoreAll')->name('slider.restore.all');

    Route::get('slider/restore-time/{time}', 'SliderController@restoreTime')->name('slider.restore.time');

    // Review
    Route::resource('review', 'ReviewController')->only(['index', 'destroy']);

    // User
    Route::resource('user', 'UserController')->except(['show', 'destroy']);

    Route::get('user/my-profile', 'UserController@myProfile')->name('user.my_profile');

    Route::get('user/trash', 'UserController@trash')->name('user.trash');

    Route::post('user/restore', 'UserController@restore')->name('user.restore');

    Route::get('user/restore-all', 'UserController@restoreAll')->name('user.restore.all');

    Route::get('user/restore-time/{time}', 'UserController@restoreTime')->name('user.restore.time');

    // Order
    Route::resource('order', 'OrderController')->except(['show', 'destroy']);

    Route::get('order/trash', 'OrderController@trash')->name('order.trash');

    Route::post('order/restore', 'OrderController@restore')->name('order.restore');

    Route::get('order/restore-all', 'OrderController@restoreAll')->name('order.restore.all');

    Route::get('order/restore-time/{time}', 'OrderController@restoreTime')->name('order.restore.time');

    // Customer
    Route::resource('customer', 'CustomerController')->only(['index', 'show']);

});

Route::view('{any?}', 'frontend.page.404');

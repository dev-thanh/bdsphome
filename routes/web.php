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
Route::group(['namespace'=>'Frontend','middleware' => 'authMember'], function () {

    Route::get('/admin-post/quan-ly-tin-dang', 'ProfileController@adminPostManagement')->name('admin.post-management');

    Route::get('/admin-post/quan-ly-tai-khoan', 'ProfileController@adminAccountManagement')->name('admin.account-management');

    Route::get('/quan-huyen/{id}', 'ProfileController@ajaxGetDistrict')->name('admin.ajax-district');

    Route::get('/xa-phuong/{id}', 'ProfileController@ajaxGetWards')->name('admin.ajax-wards');

    Route::post('/update-account', 'ProfileController@updateAccount')->name('admin.update-account');

    Route::get('/admin-post/thay-doi-mat-khau', 'ProfileController@changePassword')->name('admin.change-password');

    Route::post('/post-change-password', 'ProfileController@postChangePassword')->name('admin.post-change-password');

    Route::get('/admin-post/dang-tin', 'ProfileController@adminAddPost')->name('admin.add-post');

    Route::get('/admin-post/test', 'ProfileController@adminAddPostTest')->name('admin.add-post-test');
    

});

Route::group(['namespace'=>'Frontend'], function () {

    Route::get('/', 'IndexController@getHome')->name('home.index');

    Route::get('/dang-nhap', 'IndexController@login')->name('home.login');

    Route::get('/dang-ky', 'IndexController@register')->name('home.register');

    Route::get('/refreshcaptcha', 'IndexController@refreshCaptcha');

    Route::post('/post-register', 'IndexController@postRegister')->name('home.post-register');

    Route::post('/post-login', 'IndexController@postLogin')->name('home.post-login');

    Route::get('/dang-xuat', 'IndexController@logOut')->name('home.logout');

    Route::get('/gioi-thieu', 'IndexController@getAbout')->name('home.about');


    Route::get('/verify-account/{code}', 'IndexController@verifyRegister')->name('home.verify-account');

    

    Route::get('/thong-tin-tai-khoan', 'IndexController@profile')->name('home.profile');

    Route::get('/cap-nhat-tai-khoan', 'IndexController@editAccount')->name('home.edit-account');

    Route::post('/post-cap-nhat-tai-khoan', 'IndexController@postEditAccount')->name('home.post-edit-account');

    Route::get('/quen-mat-khau', 'IndexController@forgotPassword')->name('home.quen-mat-khau');

    Route::post('/post-quen-mat-khau', 'IndexController@postForgotPassword')->name('home.post-quen-mat-khau');

    Route::get('/resetPassword/{token}', 'IndexController@resetPassword')->name('home.resetPassword');

    Route::post('/new-password', 'IndexController@newPassword')->name('home.new-password');

    Route::get('/auth/redirect/{provider}', 'SocialController@redirect');

    Route::get('/auth/{provider}/callback', 'SocialController@callback');

    /** Tin tức */
    Route::get('/tin-tuc', 'IndexController@getListNews')->name('home.news');

    Route::get('/tin-tuc/{slug}', 'IndexController@getSingleNews')->name('home.news-single');

    Route::get('/ajax-load-news', 'IndexController@ajaxLoadMoreNews')->name('home.ajax-load-news');

    /** Dịch vụ */
    Route::get('/dich-vu', 'IndexController@getListServices')->name('home.services');

    Route::get('/dich-vu/{slug}', 'IndexController@getSingleServices')->name('home.services-single');

    Route::get('/ajax-load-services', 'IndexController@ajaxLoadMoreServices')->name('home.ajax-load-services');

    Route::get('/lien-he', 'IndexController@getContact')->name('home.contact');

    // Route::post('/lien-he/gui', 'IndexController@postContact')->name('home.post-contact');
});









Route::get('/search', 'IndexController@getSearch')->name('home.search');



Route::get('filter-products', 'IndexController@getFilterProductsAjax')->name('home.filterProducts');


Route::get('/chinh-sach/{slug}', 'IndexController@policy')->name('home.policy');

Route::post('/nhan-tin-khuen-mai', 'IndexController@sendSale')->name('home.send-sale');

Route::get('/cau-hoi-thuong-gap', 'IndexController@getFaq')->name('home.faq');

Route::get('thanh-toan-b1', 'IndexController@getCheckOut1')->name('home.check-out1');





Route::get('order/{id}', 'IndexController@getCheckOut3')->name('home.check-out3');

Route::post('post-thanh-toan-b3', 'IndexController@postCheckOut3')->name('home.post-check-out3');

Route::get('kiem-tra-diem', 'IndexController@checkPoint')->name('home.check-point');

// Route::post('hoan-tat-thanh-toan', 'IndexController@postCheckOut')->name('home.check-out.post');




Route::get('/danh-muc/{slug}', 'IndexController@categoryProduct')->name('home.category-product');

Route::post('/filter-products', 'IndexController@getFilterProductsAjax')->name('home.filterProducts');

/* Tỉnh thành quận huyện */

Route::get('/quan-huyen/{id}', 'CheckoutController@getDistrict')->name('home.get-district');

Route::get('/xa-phuong/{id}', 'CheckoutController@getWards')->name('home.get-wards');

Route::group(['namespace' => 'Admin'], function () {

    Route::group(['prefix' => 'backend', 'middleware' => 'auth'], function () {
       	Route::get('/home', 'HomeController@index')->name('backend.home');

        Route::resource('users', 'UserController', ['except' => [
            'show'
        ]]);

        $routes = config('admin.route');

        foreach ($routes as $key => $route) {
            Route::resource($key, ucfirst($key).'Controller', ['except' => ['show']] );
            if($route['multi_del'] == true){
                Route::post( $key.'/postMultiDel', ['as' => $key.'.postMultiDel', 'uses' => ucfirst($key).'Controller@deleteMuti']);
            }
        }

        Route::get('products/get-slug', 'ProductsController@getAjaxSlug')->name('products.get-slug');

        Route::get('products/get-all', 'ProductsController@getAllProducts')->name('products.get-all');
       

        Route::group(['prefix' => 'product-attributes'], function() {
            Route::get('/', 'ProductAttributeTypesController@getList')->name('product-attributes.index');
            Route::post('/store', 'ProductAttributeTypesController@postStore')->name('product-attributes.store');
            Route::get('/{id}/edit', 'ProductAttributeTypesController@getEdit')->name('product-attributes.edit');
            Route::post('/{id}/edit', 'ProductAttributeTypesController@postEdit')->name('product-attributes.post.edit');
            Route::delete('/{id}/delete', 'ProductAttributeTypesController@delete')->name('product-attributes.destroy');
        });

        Route::get('category-filter', 'FilterController@getListCategory')->name('list-category-filter');

        Route::get('sort-filter', 'FilterController@getSort')->name('sort-category-filter');
        Route::post('sort-filter-update', 'FilterController@postSort')->name('sort.filter.update');




        Route::resource('image', 'ImageController', ['except' => [
            'show'
        ]]);
        Route::post('image/postMultiDel', ['as' => 'image.postMultiDel', 'uses' => 'ImageController@deleteMuti']);
        // Bài viết
        Route::resource('categories-post', 'CategoriesPostController', ['except' => ['show']]);
        Route::resource('posts', 'PostController', ['except' => ['show']]);
        Route::post('posts/postMultiDel', ['as' => 'posts.postMultiDel', 'uses' => 'PostController@deleteMuti']);
        Route::get('posts/get-slug', 'PostController@getAjaxSlug')->name('posts.get-slug');

        Route::get('posts/promotion-news', 'PostController@promotionNews')->name('posts.promotion-news');

        Route::get('posts/create-promotion-news', 'PostController@createPromotionNews')->name('posts.create-promotion-news');

        Route::post('posts/posts-create-promotion-news', 'PostController@postCreatePromotionNews')->name('posts.posts-create-promotion-news');

        Route::get('posts/edit-promotion-news/{id}', 'PostController@editPromotionNews')->name('posts.edit-promotion-news');

        Route::post('posts/post-edit-promotion-news/{id}', 'PostController@postEditPromotionNews')->name('posts.post-edit-promotion-news');


        // Dự án
        Route::resource('categories-projects', 'CategoriesProjectsController', ['except' => ['show']]);
        Route::resource('projects', 'ProjectsController', ['except' => ['show']]);
        Route::post('projects/postMultiDel', ['as' => 'projects.postMultiDel', 'uses' => 'ProjectsController@deleteMuti']);
        Route::get('projects/get-slug', 'ProjectsController@getAjaxSlug')->name('projects.get-slug');

        // Dịch vụ
        Route::resource('services', 'ServicesController', ['except' => ['show']]);
        Route::post('services/postMultiDel', ['as' => 'services.postMultiDel', 'uses' => 'ServicesController@deleteMuti']);
        Route::get('services/get-slug', 'ServicesController@getAjaxSlug')->name('services.get-slug');


        Route::resource('category', 'CategoryController', ['except' => ['show']]);
        // Liên hệ
        Route::group(['prefix' => 'contact'], function () {
            Route::get('/', ['as' => 'get.list.contact', 'uses' => 'ContactController@getListContact']);
            Route::post('/delete-muti', ['as' => 'contact.postMultiDel', 'uses' => 'ContactController@postDeleteMuti']);
            Route::get('{id}/edit', ['as' => 'contact.edit', 'uses' => 'ContactController@getEdit']);
            Route::post('{id}/edit', ['as' => 'contact.post', 'uses' => 'ContactController@postEdit']);
            Route::delete('{id}/delete', ['as' => 'contact.destroy', 'uses' => 'ContactController@getDelete']);
            Route::get('/danh-sach-dang-ky-nhan-tin-khuyen-mai', ['as' => 'get.list.mail-sale', 'uses' => 'ContactController@getListMailSale']);
            Route::get('/xoa-email/{id}', ['as' => 'get.list.delete-mail-sale', 'uses' => 'ContactController@deleteMailSale']);
        });

        Route::group(['prefix' => 'pages'], function() {
            Route::get('/', ['as' => 'pages.list', 'uses' => 'PagesController@getListPages']);
            Route::get('build', ['as' => 'pages.build', 'uses' => 'PagesController@getBuildPages']);
            Route::post('build', ['as' => 'pages.build.post', 'uses' => 'PagesController@postBuildPages']);
            Route::post('/create', ['as' => 'pages.create', 'uses' => 'PagesController@postCreatePages']);
        });

        Route::group(['prefix' => 'options'], function() {
            Route::get('/general', 'SettingController@getGeneralConfig')->name('backend.options.general');
            Route::post('/general', 'SettingController@postGeneralConfig')->name('backend.options.general.post');

            Route::get('/developer-config', 'SettingController@getDeveloperConfig')->name('backend.options.developer-config');
            Route::post('/developer-config', 'SettingController@postDeveloperConfig')->name('backend.options.developer-config.post');
        });

        Route::group(['prefix' => 'menu'], function () {
            Route::get('/', ['as' => 'setting.menu', 'uses' => 'MenuController@getListMenu']);
            Route::get('edit/{id}', ['as' => 'backend.config.menu.edit', 'uses' => 'MenuController@getEditMenu']);
            Route::post('add-item/{id}', ['as' => 'setting.menu.addItem', 'uses' => 'MenuController@postAddItem']);
            Route::post('update', ['as' => 'setting.menu.update', 'uses' => 'MenuController@postUpdateMenu']);
            Route::get('delete/{id}', ['as' => 'setting.menu.delete', 'uses' => 'MenuController@getDelete']);
            Route::get('edit-item/{id}', ['as' => 'setting.menu.geteditItem', 'uses' => 'MenuController@getEditItem']);
            Route::post('edit', ['as' => 'setting.menu.editItem', 'uses' => 'MenuController@postEditItem']);
        });

        //Chính sách
        Route::group(['prefix' => 'policy'], function () {
            Route::get('/', ['as' => 'policy.list', 'uses' => 'PolicyController@getListPolicy']);
            Route::get('/add-plicy', ['as' => 'policy.add', 'uses' => 'PolicyController@addPolicy']);
            Route::post('/post-add-plicy', ['as' => 'policy.post-add', 'uses' => 'PolicyController@postAddPolicy']);
            Route::get('/edit-policy/{id}', ['as' => 'policy.edit', 'uses' => 'PolicyController@editPolicy']);
            Route::post('/post-edit-policy/{id}', ['as' => 'policy.post-edit', 'uses' => 'PolicyController@postEditPolicy']);
            Route::get('/delete-policy/{id}', ['as' => 'policy.delete', 'uses' => 'PolicyController@deletePolicy']);

            //Liên hệ footer
            Route::get('/ft-ct', ['as' => 'policy.list-ftct', 'uses' => 'PolicyController@getListFooterContact']);
            Route::get('/add-ftct', ['as' => 'policy.add-ftct', 'uses' => 'PolicyController@addFooterContact']);
            Route::post('/post-add-ftct', ['as' => 'policy.post-add-ftct', 'uses' => 'PolicyController@postAddFooterContact']);
            Route::get('/edit-ftct/{id}', ['as' => 'policy.edit-ftct', 'uses' => 'PolicyController@editFooterContact']);
            Route::post('/post-edit-ftct/{id}', ['as' => 'policy.post-edit-ftct', 'uses' => 'PolicyController@postEditFooterContact']);
            Route::get('/delete-ftct/{id}', ['as' => 'policy.delete-ftct', 'uses' => 'PolicyController@deleteFooterContact']);

        });

       Route::get('/get-layout', 'HomeController@getLayOut')->name('get.layout');


    });
});

Auth::routes(
    [
        'register' => false,
        'verify' => false,
        'reset' => false,
    ]
);

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
Route::get('thumbnail', ['as' => 'image.thumbnail', 'uses' =>'ImageController@thumbnail']);
// For images uploading route//
Route::get('upload/getFiles/{file}', array('as' => 'image.getFiles', 'uses' => 'ImageController@getFiles'));
Route::get('gallary/getFiles/{file}', array('as' => 'gallary.getFiles', 'uses' => 'ImageController@getGallaryFiles'));
Route::get('banner/getFiles/{file}', array('as' => 'banner.getFiles', 'uses' => 'ImageController@getBannerFiles'));
Route::post('/upload', ['as' => 'image.store' , 'uses' => 'ImageController@store']);
Route::post('/gallary/store', ['as' => 'image.upload' , 'uses' => 'ImageController@upload']);
Route::post('/banner/store', ['as' => 'image.upload' , 'uses' => 'ImageController@banner']);
Route::post('/banner/delete', ['as' => 'image.remove', 'uses' =>'ImageController@banner_remove']);
Route::post('/gallary/delete', ['as' => 'image.remove', 'uses' =>'ImageController@gallary_remove']);
Route::post('/upload/delete', ['as' => 'image.remove', 'uses' =>'ImageController@remove']);
Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');
//-End-//


Route::group(['middleware' => ['guest']], function () {

    Route::get('/','HomeController@index');

    Route::group(['namespace' => 'Admin'], function()
    {
        // ADMIN
        Route::get('/admin', array('as' => 'admin.login', 'uses' => 'AdminController@index'));
        Route::get('admin/login', 'Auth\LoginController@getLoginForm');
        Route::post('admin/authenticate', 'Auth\LoginController@authenticate');

        Route::get('admin/register', 'Auth\RegisterController@getRegisterForm');
        Route::post('admin/saveregister', 'Auth\RegisterController@saveRegisterForm');
    });

    // USER
    Route::group(['namespace' => 'Site'], function()
    {
        /*Route::post(
            'password/email' , 'Auth\ForgotPasswordController@sendResetLinkEmail'
        );*/
        //Route::get('login', 'Auth\LoginController@getLoginForm');
        Route::get('login', function () {
            return redirect()->intended('');
        });
        Route::post('authenticate', 'Auth\LoginController@authenticate');

        //Route::get('sigup', 'Auth\RegisterController@getRegisterForm');
        Route::get('sigup', function () {
            return redirect()->intended('');
        });
        Route::post('saveregister', 'Auth\RegisterController@saveRegisterForm');

        Route::get('page/{slug}', 'PagesController@index');
        /*Route::get('page/{slug}', 'IndexController@contact_us');
        Route::get('page/{slug}', 'IndexController@term');*/
        Route::get('contact_us', 'IndexController@contact_us');
        Route::post('contactus', 'IndexController@contactus_store');
        Route::get('listings', 'ListingsController@index');
        Route::get('listings/{id}', 'ListingsController@getListings');
        Route::get('vendor/profile/{id}', 'ListingsController@vendor_profile');
        Route::get('gallery', 'GallaryController@index');
        Route::get('service/filter', array('as' => 'service.filter', 'uses' => 'ListingsController@filter'));
        Route::post('service/search', array('as' => 'service.search', 'uses' => 'ListingsController@search'));
        Route::post('subscribe', array('as' => 'user.subscribe', 'uses' => 'IndexController@subscribe'));
        Route::get('search', array('as' => 'vendor.search', 'uses' => 'ListingsController@search'));
        Route::post('sort_reviews', array('as' => 'sort.reviews', 'uses' => 'VendorController@sortReviews'));
        Route::post('user_sort_reviews', array('as' => 'sort.user_reviews', 'uses' => 'VendorController@userSortReviews'));
    });

});

Route::group(['namespace' => 'Site'], function()
{
    Route::group(['middleware' => ['user']], function () {

        Route::get('user/logout', 'Auth\LoginController@getLogout');
        Route::get('user/dashboard', 'UserController@index');
        Route::get('vendor/dashboard', 'VendorController@index');
        //Route::get('user/reset_password', 'Auth\PasswordController@index');

        Route::post('password/reset', 'Auth\PasswordController@reset');
        Route::post('vendor/store_info', array('uses'=>'VendorController@store', 'as' => 'vendor.store'));
        Route::post('vendor/gallary', array('uses'=>'VendorController@gallary', 'as' => 'gallary.store'));
        Route::post('vendor/store_service_values', array('uses'=>'VendorController@store_service_values', 'as' => 'vendor.store_service_values'));
        Route::post('user/store', array('uses'=>'UserController@store', 'as' => 'user.store'));
        Route::post('user/change_profile_pic', array('uses'=>'UserController@change_profile_pic', 'as' => 'user.change_profile_pic'));
        Route::post('vendor/store_review', array('uses'=>'VendorController@store_review', 'as' => 'user.review'));
        Route::post('vendor/bookmark/{id}', array('uses'=>'UserController@bookmark_vendor', 'as' => 'user.bookmark'));
        Route::post('vendor/unbookmark/{id}', array('uses'=>'UserController@unbookmark_vendor', 'as' => 'user.unbookmark'));
    });
});

Route::group(['namespace' => 'Admin'], function()
{
    Route::group(['middleware' => 'admin'], function()
    {
        Route::get('/admin', array('as' => 'admin.login', 'uses' => 'AdminController@index'));
        Route::get('admin/dashboard', 'AdminController@dashboard');
        Route::get('admin/change_password', 'AdminController@change_password');
        Route::post('admin/change_profile_pic', array('uses'=>'AdminController@change_profile_pic', 'as' => 'admin.change_profile_pic'));
        Route::post('admin/reset_password', 'AdminController@reset');
        Route::post('admin/edit_profile', array('uses'=>'AdminController@edit_profile', 'as' => 'admin.edit'));

        // For all types of user
        Route::get('admin/manage_vendors', array('as' => 'admin.manage_vendors', 'uses' => 'UserController@manage_vendors'));
        Route::get('admin/manage_users', array('as' => 'admin.manage_users', 'uses' => 'UserController@manage_users'));
        Route::post('admin/user_status/{id}', 'UserController@user_status');
        Route::get('admin/manage_vendors/data', array('as' => 'admin.manage_vendors_data', 'uses' => 'UserController@manage_vendors_data'));
        Route::get('admin/manage_users/data', array('as' => 'admin.manage_users_data', 'uses' => 'UserController@manage_users_data'));
        Route::get('admin/gallary/{id}', 'UserController@gallary');
        Route::get('admin/user_detail/{id}', array('as' => 'admin.user_detail', 'uses' => 'UserController@user_detail'));
        Route::get('admin/vendor_detail/{id}', array('as' => 'admin.vendor_detail', 'uses' => 'UserController@vendor_detail'));

        Route::get('admin/logout', 'Auth\LoginController@getLogout');

        Route::post('admin/remove_image/{img}', array('uses'=>'UserController@remove_image', 'as' => 'gallary.delete'));
        Route::post('admin/remove_banner/{img}', array('uses'=>'UserController@remove_banner', 'as' => 'banner.delete'));
    });

        // For vendors services category
        Route::get('admin/category', 'CategoriesController@index');
        Route::get('admin/category/data', 'CategoriesController@data');
        Route::get('admin/category/reorder', 'CategoriesController@getReorder');
        Route::get('admin/category/{category}/edit', 'CategoriesController@edit');
        Route::post('admin/category/store', array('uses'=>'CategoriesController@store', 'as' => 'category.store'));
        Route::post('admin/category_delete/{id}', array('uses'=>'CategoriesController@delete', 'as' => 'category.delete'));
        Route::resource('category', 'CategoriesController');

        // For slider images
        Route::get('admin/slider', 'SliderController@index');
        Route::get('admin/slider/data', 'SliderController@data');
        Route::get('admin/slider/create', 'SliderController@create');
        Route::post('admin/slider/store', array('uses'=>'SliderController@store', 'as' => 'slider.store'));
        Route::post('admin/slider_delete/{id}', array('uses'=>'SliderController@delete', 'as' => 'slider.delete'));
        Route::post('admin/slider/update', array('uses'=>'SliderController@update', 'as' => 'slider.update'));
        Route::post('admin/slider/PostReorder', array('uses'=>'SliderController@PostReorder', 'as' => 'slider.PostReorder'));
        Route::get('admin/slider/{slider}/edit', 'SliderController@edit');

        // For vendors review & ratings
        Route::get('admin/review', 'ReviewController@index');
        Route::get('admin/reviews/data', 'ReviewController@data');
         // For vendors review & ratings
        Route::get('admin/review/{id}', 'ReviewController@reviews');
        Route::get('admin/reviews/data/{id}', 'ReviewController@data');
        Route::post('admin/review_delete/{id}', array('uses'=>'ReviewController@delete', 'as' => 'review.delete'));
        Route::post('admin/review_status/{id}', 'ReviewController@status');

        // For subscribers
        Route::get('admin/subscribers', 'SubscriberController@index');
        Route::get('admin/subscribers/data', 'SubscriberController@data');
        Route::post('admin/subscriber_delete/{id}', array('uses'=>'SubscriberController@delete', 'as' => 'subscriber.delete'));

        // For pages
        Route::get('admin/pages', 'PagesController@index');
        Route::get('admin/pages/data', 'PagesController@data');
        Route::get('admin/pages/create', 'PagesController@create');
        Route::get('admin/pages/{id}/edit', 'PagesController@edit');
        Route::post('admin/pages/store', array('uses'=>'PagesController@store', 'as' => 'pages.store'));
        Route::post('admin/pages/update', array('uses'=>'PagesController@update', 'as' => 'pages.update'));
        Route::post('admin/pages_delete/{id}', array('uses'=>'PagesController@delete', 'as' => 'pages.delete'));

        // For Home Page Content Section4
        Route::get('admin/home_page_section4', 'IndexController@section4_index');
        Route::post('admin/home_section4/store', array('uses'=>'IndexController@home_section4_store', 'as' => 'home_section4.store'));

        // For Home Page Featured Vendors Gallery
        Route::get('admin/featured_vendors', 'IndexController@featured_vendors_index');
        Route::get('admin/featured_vendors/data', 'IndexController@featured_vendors_data');
        Route::get('admin/featured_vendors/create', 'IndexController@featured_vendors_create');
        Route::get('admin/featured_vendors/{id}/edit', 'IndexController@featured_vendors_edit');
        Route::post('admin/featured_vendors/store', array('uses'=>'IndexController@featured_vendors_store', 'as' => 'featured_vendors.store'));
        Route::post('admin/featured_vendors/update', array('uses'=>'IndexController@featured_vendors_update', 'as' => 'featured_vendors.update'));

        // For Home Page User Comment
        Route::get('admin/user_comments', 'IndexController@user_comments_index');
        Route::get('admin/user_comments/data', 'IndexController@user_comments_data');
        Route::get('admin/user_comments/create', 'IndexController@user_comments_create');
        Route::get('admin/user_comments/{id}/edit', 'IndexController@user_comments_edit');
        Route::post('admin/user_comments/store', array('uses'=>'IndexController@user_comments_store', 'as' => 'user_comments.store'));
        Route::post('admin/user_comments/update', array('uses'=>'IndexController@user_comments_update', 'as' => 'user_comments.update'));

        // For Home Page Local Vendors Section
        Route::get('admin/local_vendors', 'IndexController@local_vendors_index');
        Route::get('admin/local_vendors/data', 'IndexController@local_vendors_data');
        Route::get('admin/local_vendors/create', 'IndexController@local_vendors_create');
        Route::get('admin/local_vendors/{id}/edit', 'IndexController@local_vendors_edit');
        Route::post('admin/local_vendors/store', array('uses'=>'IndexController@local_vendors_store', 'as' => 'local_vendors.store'));
        Route::post('admin/local_vendors/update', array('uses'=>'IndexController@local_vendors_update', 'as' => 'local_vendors.update'));
        

        // For Settings
        Route::get('admin/settings', 'SettingsController@index');
        Route::post('admin/settings/store', array('uses'=>'SettingsController@store', 'as' => 'settings.store'));
        Route::post('admin/social_url/store', array('uses'=>'SettingsController@save_social_url', 'as' => 'social_url.store'));
        Route::post('admin/contact_setting/store', array('uses'=>'SettingsController@save_contact_setting', 'as' => 'contact_setting.store'));
});

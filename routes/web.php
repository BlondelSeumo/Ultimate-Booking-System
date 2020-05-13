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
Route::get('/intro','LandingpageController@index');

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/a', 'Controller@a')->name('home2');
//Contact
Route::match(['get','post'],'/contact','\Modules\Contact\Controllers\ContactController@index'); // Contact
Route::match(['post'],'/contact/store','\Modules\Contact\Controllers\ContactController@store'); // Contact

Route::get('/test_functions', 'HomeController@test');
Route::get('/update/110', 'HomeController@updateTo110')->middleware('auth');
//Route::get('/admin/module/core/test/test/{s1?}/{s2?}', '\\Modules\\Core\\Admin\\TestController@test');

//Homepage
Route::post('newsletter/subscribe','\Modules\User\Controllers\UserController@subscribe')->name('newsletter.subscribe');

// Social Login
Route::get('social-login/{provider}', 'Auth\LoginController@socialLogin');
Route::get('social-callback/{provider}', 'Auth\LoginController@socialCallBack');


// Page
Route::group(['prefix'=>config('page.page_route_prefix')],function(){
    Route::get('/','\Modules\Page\Controllers\PageController@index');// Search
    Route::get('/{slug}','\Modules\Page\Controllers\PageController@detail');// Detail
});

// Tour
Route::group(['prefix'=>config('tour.tour_route_prefix')],function(){
    Route::get('/','\Modules\Tour\Controllers\TourController@index')->name('tour.search'); // Search
    Route::get('/{slug}','\Modules\Tour\Controllers\TourController@detail');// Detail
});

// Location
Route::group(['prefix'=>config('location.location_route_prefix')],function(){
    Route::get('/{slug}','\Modules\Location\Controllers\LocationController@detail')->name("location.detail");;// Detail
});

// News
Route::group(['prefix'=>config('news.news_route_prefix')],function(){
    Route::get('/'.config('news.news_category_route_prefix').'/{slug}', '\Modules\News\Controllers\CategoryNewsController@index');
    Route::get('/'.config('news.news_tag_route_prefix').'/{slug}', '\Modules\News\Controllers\TagNewsController@index');
    Route::get('/','\Modules\News\Controllers\NewsController@index');// News Page
    Route::get('/{slug}','\Modules\News\Controllers\NewsController@detail');// Detail
});

// User Profile
Route::post('/register','\Modules\User\Controllers\UserController@userRegister');
Route::post('/login','\Modules\User\Controllers\UserController@userLogin');
Route::group(['prefix'=>'user','middleware' => ['auth']],function(){
    Route::match(['get','post'],'/dashboard','\Modules\User\Controllers\UserController@dashboard');
    Route::post('/reloadChart','\Modules\User\Controllers\UserController@reloadChart');

    Route::match(['get','post'],'/profile','\Modules\User\Controllers\UserController@profile');
    Route::match(['get','post'],'/profile/change-password','\Modules\User\Controllers\UserController@changePassword');
    Route::get('/booking-history','\Modules\User\Controllers\UserController@bookingHistory');

    Route::match(['get','post'],'/tour','\Modules\User\Controllers\ManageTourController@manageTour');
    Route::match(['get','post'],'/tour/create','\Modules\User\Controllers\ManageTourController@createTour');
    Route::match(['get','post'],'/tour/edit/{slug}','\Modules\User\Controllers\ManageTourController@editTour');
    Route::match(['get','post'],'/tour/del/{slug}','\Modules\User\Controllers\ManageTourController@deleteTour');
});

// Booking
Route::group(['prefix'=>config('booking.booking_route_prefix')],function(){
    Route::post('/addToCart','\Modules\Booking\Controllers\BookingController@addToCart')->middleware('auth');// Detail
    Route::post('/doCheckout','\Modules\Booking\Controllers\BookingController@doCheckout')->middleware('auth');// Detail

    Route::get('/confirm/{gateway}','\Modules\Booking\Controllers\BookingController@confirmPayment');// Detail
    Route::get('/cancel/{gateway}','\Modules\Booking\Controllers\BookingController@cancelPayment');// Detail

    Route::get('/{code}','\Modules\Booking\Controllers\BookingController@detail')->middleware('auth');// Detail
    Route::get('/{code}/checkout','\Modules\Booking\Controllers\BookingController@checkout')->middleware('auth');// Detail
    Route::get('/{code}/check-status','\Modules\Booking\Controllers\BookingController@checkStatusCheckout')->middleware('auth');// Detail
});

// Media
Route::group(['prefix'=>'media'],function(){
    Route::get('/preview/{id}/{size?}','\Modules\Media\Controllers\MediaController@preview');//
});
Route::group(['middleware' => ['auth']],function(){
    Route::match(['get','post'],'/admin/module/media/store','\Modules\Media\Admin\MediaController@store');
    Route::match(['get','post'],'/admin/module/media/getLists','\Modules\Media\Admin\MediaController@getLists');
});

//Review
Route::group(['middleware' => ['auth']],function(){
    Route::get('/review',function (){ return redirect('/'); });
    Route::post('/review','\Modules\Review\Controllers\ReviewController@addReview');
});

// Logs
Route::get('admin/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware(['auth', 'dashboard','system_log_view']);


// Admin Route
Route::group(['prefix'=>'admin','middleware' => ['auth','dashboard']], function() {

    Route::match(['get','post'],'/',function (){
        $module = ucfirst(htmlspecialchars('Dashboard'));
        $controller = ucfirst(htmlspecialchars($module));
        $class = "\\Modules\\$module\\Admin\\";
        $action = 'index';

        if(class_exists($class.$controller.'Controller') && method_exists($class.$controller.'Controller',$action)){
            return App::call($class.$controller.'Controller@'.$action,[]);
        }

        abort(404);
    });

    Route::match(['get','post'],'/module/{module}/{controller?}/{action?}/{param1?}/{param2?}/{param3?}',function ($module,$controller = '',$action = '',$param1 = '',$param2 = '',$param3 = ''){
        $module = ucfirst(htmlspecialchars($module));
        $controller = ucfirst(htmlspecialchars($controller));
        $class = "\\Modules\\$module\\Admin\\";

        if(!class_exists($class.$controller.'Controller')){
            $param3 = $param2;
            $param2 = $param1;
            $param1 = $action;
            $action = $controller;
            $controller = $module;
        }

        $action = $action ? $action : 'index';
        if(class_exists($class.$controller.'Controller') && method_exists($class.$controller.'Controller',$action)){

            $p = array_values(array_filter([$param1,$param2,$param3]));

            return App::call($class.$controller.'Controller@'.$action,$p);

//            return App::make($class.$controller.'Controller')->callAction($action,$p);

        }

        abort(404);
    });

});


// Tour Route
//Route::get('/tour/page-search', 'TourController@index')->name('page_search_tour');

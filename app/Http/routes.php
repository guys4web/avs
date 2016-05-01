<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Model binding into route
 */
Route::model('blogcategory', 'App\BlogCategory');
Route::model('blog', 'App\Blog');
Route::model('file', 'App\File');
Route::model('task', 'App\Task');
Route::model('users', 'App\User');
Route::model('services', 'App\Service');
Route::model('visas', 'App\Visa');

Route::pattern('slug', '[a-z0-9- _]+');

Route::group(array('prefix' => 'admin'), function () {

	# Error pages should be shown without requiring login
	Route::get('404', function () {
		return View('admin/404');
	});
	Route::get('500', function () {
		return View::make('admin/500');
	});

	# Lock screen
	Route::get('lockscreen', function () {
		return View::make('admin/lockscreen');
	});

	# All basic routes defined here
	Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
	Route::post('signin', 'AuthController@postSignin');
	Route::post('signup', array('as' => 'signup', 'uses' => 'AuthController@postSignup'));
	Route::post('forgot-password', array('as' => 'admin-forgot-password', 'uses' => 'AuthController@postForgotPassword'));
	Route::get('login2', function () {
		return View::make('admin/login2');
	});

	# Register2
	Route::get('register2', function () {
		return View::make('admin/register2');
	});
	Route::post('register2', array('as' => 'register2', 'uses' => 'AuthController@postRegister2'));

	# Forgot Password Confirmation
	Route::get('forgot-password/{userId}/{passwordResetCode}', array('as' => 'admin-forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
	Route::post('forgot-password/{userId}/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

	# Logout
	Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

	# Account Activation
	Route::get('activate/{userId}/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));
});

Route::group(array('prefix' => 'admin', 'middleware' => 'SentinelAdmin'), function () {
    # Dashboard / Index
	Route::get('/', array('as' => 'dashboard','uses' => 'JoshController@showHome'));


    # User Management
    Route::group(array('prefix' => 'users'), function () {
        Route::get('/', array('as' => 'users', 'uses' => 'UsersController@index'));
        Route::get('create', 'UsersController@create');
        Route::post('create', 'UsersController@store');
        Route::get('{userId}/delete', array('as' => 'delete/user', 'uses' => 'UsersController@destroy'));
        Route::get('{userId}/confirm-delete', array('as' => 'confirm-delete/user', 'uses' => 'UsersController@getModalDelete'));
        Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'UsersController@getRestore'));
        Route::get('{userId}', array('as' => 'users.show', 'uses' => 'UsersController@show'));
        Route::post('passwordreset', 'UsersController@passwordreset');
    });
    Route::resource('users', 'UsersController');

	Route::get('deleted_users',array('as' => 'deleted_users','before' => 'Sentinel', 'uses' => 'UsersController@getDeletedUsers'));

	# Role Management
    Route::group(array('prefix' => 'roles'), function () {
        Route::get('/', array('as' => 'roles', 'uses' => 'RolesController@index'));
        Route::get('create', array('as' => 'create/role', 'uses' => 'RolesController@create'));
        Route::post('create', 'RolesController@store');
        Route::get('{roleId}/edit', array('as' => 'update/role', 'uses' => 'RolesController@edit'));
        Route::post('{roleId}/edit', 'RolesController@update');
        Route::get('{roleId}/delete', array('as' => 'delete/role', 'uses' => 'RolesController@destroy'));
        Route::get('{roleId}/confirm-delete', array('as' => 'confirm-delete/role', 'uses' => 'RolesController@getModalDelete'));
        Route::get('{roleId}/restore', array('as' => 'restore/role', 'uses' => 'RolesController@getRestore'));
    });
    /*routes for blog*/
    Route::group(array('prefix' => 'blog'), function () {
            Route::get('/', array('as' => 'blogs', 'uses' => 'BlogController@index'));
            Route::get('create', array('as' => 'create/blog', 'uses' => 'BlogController@create'));
            Route::post('create', 'BlogController@store');
            Route::get('{blog}/edit', array('as' => 'update/blog', 'uses' => 'BlogController@edit'));
            Route::post('{blog}/edit', 'BlogController@update');
            Route::get('{blog}/delete', array('as' => 'delete/blog', 'uses' => 'BlogController@destroy'));
            Route::get('{blog}/confirm-delete', array('as' => 'confirm-delete/blog', 'uses' => 'BlogController@getModalDelete'));
            Route::get('{blog}/restore', array('as' => 'restore/blog', 'uses' => 'BlogController@getRestore'));
            Route::get('{blog}/show', array('as' => 'blog/show', 'uses' => 'BlogController@show'));
            Route::post('{blog}/storecomment', array('as' => 'restore/blog', 'uses' => 'BlogController@storecomment'));
    });

    /*routes for blog category*/
	Route::group(array('prefix' => 'blogcategory'), function () {
        Route::get('/', array('as' => 'blogcategories', 'uses' => 'BlogCategoryController@index'));
        Route::get('create', array('as' => 'create/blogcategory', 'uses' => 'BlogCategoryController@create'));
        Route::post('create', 'BlogCategoryController@store');
        Route::get('{blogcategory}/edit', array('as' => 'update/blogcategory', 'uses' => 'BlogCategoryController@edit'));
        Route::post('{blogcategory}/edit', 'BlogCategoryController@update');
        Route::get('{blogcategory}/delete', array('as' => 'delete/blogcategory', 'uses' => 'BlogCategoryController@destroy'));
		Route::get('{blogcategory}/confirm-delete', array('as' => 'confirm-delete/blogcategory', 'uses' => 'BlogCategoryController@getModalDelete'));
		Route::get('{blogcategory}/restore', array('as' => 'restore/blogcategory', 'uses' => 'BlogCategoryController@getRestore'));
	});

	/*routes for file*/
	Route::group(array('prefix' => 'file'), function () {
            Route::post('create', 'FileController@store');
            Route::post('createmulti', 'FileController@postFilesCreate');
            Route::delete('delete', 'FileController@delete');
	});

	Route::get('crop_demo', function () {
        return redirect('admin/imagecropping');
    });
    Route::post('crop_demo','JoshController@crop_demo');

	/* laravel example routes */
	# countries
	Route::get('countries', 'CountriesController@index');
	Route::get('countries/data', array('as' => 'admin.countries.data', 'uses' => 'CountriesController@index'));

	# services
	Route::get('services', 'ServicesController@adminIndex');
        Route::post('services/post', 'ServicesController@store');
	Route::any('countries/{country}', 'ServicesController@countries');
	# visas
	Route::get('visas', 'VisasController@adminIndex');
	Route::post('visas/create', 'VisasController@create');
	Route::get('visas/destroy/{id}',array( 'uses' => 'VisasController@destroy' , 'as' => 'del_visa' ));
	Route::get('visas/show/{id}', 'VisasController@show');
	Route::post('visas/update/{id}', 'VisasController@update');
        Route::post('visas/edit/{id}', 'VisasController@edit');
	# datatables
	Route::get('datatables', 'DataTablesController@index');
	Route::get('datatables/data', array('as' => 'admin.datatables.data', 'uses' => 'DataTablesController@data'));

    //tasks section
    Route::post('task/create', 'TaskController@store');
    Route::get('task/data', 'TaskController@data');
    Route::post('task/{task}/edit', 'TaskController@update');
    Route::post('task/{task}/delete', 'TaskController@delete');


	# Remaining pages will be called from below controller method
	# in real world scenario, you may be required to define all routes manually

	Route::get('{name?}', 'JoshController@showView');

	#Services Routes
	Route::get('service/new', 'ServicesController@newProduct');
	Route::get('services/destroy/{id}', 'ServicesController@destroy');
	Route::post('services/save', 'ServicesController@add');
    #orders
    Route::group(array('prefix' => 'orders'), function () {
        
        Route::get('index', 'OrdersController@index');
        Route::any('datatables', 'OrdersController@datatables');
        Route::any('payment', 'OrdersController@payment');
    });


});

#FrontEndController
Route::get('login', array('as' => 'login','uses' => 'FrontEndController@getLogin'));
Route::post('login','FrontEndController@postLogin');
Route::get('register', array('as' => 'register','uses' => 'FrontEndController@getRegister'));
Route::post('register','FrontEndController@postRegister');
Route::get('activate/{userId}/{activationCode}',array('as' =>'activate','uses'=>'FrontEndController@getActivate'));
Route::get('forgot-password',array('as' => 'forgot-password','uses' => 'FrontEndController@getForgotPassword'));
Route::post('forgot-password','FrontEndController@postForgotPassword');
# Forgot Password Confirmation
Route::get('forgot-password/{userId}/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'FrontEndController@getForgotPasswordConfirm'));
Route::post('forgot-password/{userId}/{passwordResetCode}', 'FrontEndController@postForgotPasswordConfirm');
# My account display and update details
Route::group(array('middleware' => 'SentinelUser'), function () {
    Route::get('my-account', array('as' => 'my-account', 'uses' => 'FrontEndController@myAccount'));
    Route::put('my-account', 'FrontEndController@update');
    Route::get("track",array("as"=>"track","uses"=>"FrontEndController@track"));
});
Route::get('logout', array('as' => 'logout','uses' => 'FrontEndController@getLogout'));
# contact form
Route::post('contact',array('as' => 'contact','uses' => 'FrontEndController@postContact'));

#frontend views
Route::get('/', array('as' => 'home', 'uses' => 'JoshController@showUserIndex'));
// Route::post('apply', array('as' => 'apply', 'uses' => 'CartController@create'));
Route::any('apply', array('middleware'=>'SentinelUser','as' => 'apply', 'uses' => 'CartController@create'));
Route::post('cart/billing', array('middleware'=>'SentinelUser','as' => 'cart_billing', 'uses' => 'CartController@updateBilling'));
Route::any('cart/additem/{productId}', array('middleware'=>'SentinelUser','as' => 'additem', 'uses' => 'CartController@addItem'));
Route::any('cart/removeitem/{id}', array('middleware'=>'SentinelUser','as' => 'removeitem', 'uses' => 'CartController@removeItem'));
Route::post('cart/payment', array('middleware'=>'SentinelUser','as' => 'cart_payment', 'uses' => 'CartController@payment'));
Route::any('cart/done', array('middleware'=>'SentinelUser','as' => 'cart_done', 'uses' => 'CartController@done'));
Route::get("cart/passengers",array('middleware'=>'SentinelUser',"as"=>"cart_passengers","uses"=>"CartController@passengers"));
Route::any('cart', array('middleware'=>'SentinelUser','as' => 'cart', 'uses' => 'CartController@showCart'));

Route::resource('carts', 'CartController');

Route::get('blog', array('as' => 'blog', 'uses' => 'BlogController@getIndexFrontend'));
Route::get('blog/{slug}/tag', 'BlogController@getBlogTagFrontend');
Route::get('blogitem/{slug?}', 'BlogController@getBlogFrontend');
Route::post('blogitem/{blog}/comment', 'BlogController@storeCommentFrontend');

Route::post('start_payment', array('as' => 'start_payment','uses' => 'PaymentController@postIndex'));
Route::any('prepare_payment/{currencycode}/{amt}', array('as' => 'prepare_payment','uses' => 'PaymentController@prepare'));
Route::any('payment_done/{payum_token}', array('as' => 'payment_done','uses' => 'PaymentController@done'));

Route::any('visa/service/{id}', 'VisasController@findByService');
Route::any('requirements/visa/{id}', 'RequirementsController@findByVisa');
Route::get('{name?}', 'JoshController@showFrontEndView');
# End of frontend views

#test controller payment

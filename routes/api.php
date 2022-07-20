<?php


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

Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1', 'as' => 'v1.'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', 'AuthController@authenticate');
        Route::post('/logout', 'AuthController@logout');
        Route::post('/check', 'AuthController@check');
        Route::post('/check/if/user/exists', 'AuthController@checkIfUserExists');
        Route::post('/register', 'AuthController@register');
        Route::get('/activate/{token}', 'AuthController@activate');
        Route::post('/password', 'AuthController@password');
        Route::post('/validate-password-reset', 'AuthController@validatePasswordReset');
        Route::post('/reset', 'AuthController@reset');
        Route::post('/social/token', 'SocialAuthController@getToken');
        Route::post('/two-factor-auth', 'AuthController@storeOTP');
        Route::post('/two-factor-auth/resend/{number}', 'AuthController@resendOTP');
    });


    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::get('/auth/user', 'AuthController@getAuthUser');
        Route::post('/aspirant', 'AspirantController@store');
        Route::get('/enter-results/{electoral_area}', 'AspirantController@enterResults');
        Route::post('/enter-results', 'AspirantController@storeResults');
        Route::get('/vote-status', 'AspirantController@voteStatus');
        Route::get('/aspirant', 'AspirantController@index');
        Route::delete('/aspirant/{id}', 'AspirantController@destroy');
        Route::get('/aspirant/{id}', 'AspirantController@show');
        Route::patch('/aspirant/{id}', 'AspirantController@update');
        // Route::post('/aspirant/status', 'AspirantController@toggleStatus');

        Route::get('/configuration/fetch', 'ConfigurationController@index');
        Route::post('/configuration', 'ConfigurationController@store');

        Route::get('/user', 'UserController@index');

        Route::get('/ward/progress', 'UserController@getWardProgress');
        Route::get('/county/progress', 'UserController@getCountyProgress');
        Route::get('/national/progress', 'UserController@getNationalProgress');
        Route::get('/constituency/progress', 'UserController@getConstituencyProgress');

        Route::post('/user/update-avatar/{id}', 'UserController@updateAvatar');
        Route::post('/user/remove-avatar', 'UserController@removeAvatar');
        Route::delete('/user/{id}', 'UserController@destroy');
        Route::get('/user/{id}', 'UserController@show');
        Route::put('/user/{id}', 'UserController@updateProfile');
        Route::get('/user-dashboard', 'UserController@dashboard');
        Route::get('/fetch-results', 'UserController@results');

        Route::get('/county', 'LocationsController@fetchCounty');
        Route::get('/constituency', 'LocationsController@fetchConstituency');
        Route::get('/ward', 'LocationsController@fetchWard');
        Route::get('/polling', 'LocationsController@fetchPolling');
        Route::get('/polling-fetch/{name}', 'LocationsController@fetchPollingByName');

        Route::post('/county_progress', 'UserController@CountyProgress');
        Route::post('/national_progress', 'UserController@NationalProgress');
        Route::post('/constituency_progress', 'UserController@ConstituencyProgress');
        Route::post('/ward_progress', 'UserController@WardProgress');

        Route::post('/store-survey', 'SurveyController@storeSurvey');
  	    Route::get('/fetch-surveys', 'SurveyController@fetchSurveys');
        Route::get('/fetch-survey/{id}', 'SurveyController@fetchByID');
  	    Route::patch('/update-survey/{id}', 'SurveyController@updateSurvey');

  	    Route::delete('/delete-survey/{id}', 'SurveyController@deleteSurvey');

  	    Route::post('/store-question', 'SurveyController@saveQuestion');
        Route::get('/fetch-survey-questions', 'SurveyController@fetchSurveyQuestions');
        Route::get('/fetch-question/{id}', 'SurveyController@fetchQuestionByID');
        Route::patch('/update-question/{id}', 'SurveyController@updateQuestion');
        Route::post('/delete-question', 'SurveyController@deleteQuestion');

        Route::post('/question/answer', 'SurveyController@answerQuestion');
        Route::get('/fetch-answers', 'SurveyController@getAnswers');
        Route::get('/question/{id}/answers', 'SurveyController@getQuestionAnswers');

        Route::post('/store-announcement', 'AnnouncementController@store');
  	    Route::get('/fetch-announcements', 'AnnouncementController@fetch');
        Route::get('/fetch-announcement/{id}', 'AnnouncementController@fetchByID');
  	    //  Route::post('/update-announcement', 'AnnouncementController@update');
        Route::patch('/update-announcement/{id}', 'AnnouncementController@update');
        Route::delete('/delete-announcement/{id}', 'AnnouncementController@delete');

        Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    });
});

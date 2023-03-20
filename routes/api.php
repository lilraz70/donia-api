<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\V1\Admin\UserController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\V1\Admin\BesoinController;
use App\Http\Controllers\Api\V1\Admin\ReleaseGoodApiController;


//////////////////////:razak///////////////////
Route::post("store_user", [UserController::class, 'store']);
Route::post("user_login_by_phone", [UserController::class, 'loginByPhone']);
Route::post("user_login_by_google", [UserController::class, 'loginByGoogle']);
Route::post("user_login_by_facebook", [UserController::class, 'loginByFacebook']);
//////////////////////////end//////////////////




Route::post('register', 'Api\\AuthController@register');
Route::post('login', 'Api\\AuthController@login');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('loginphone', 'Api\\AuthController@loginphone');

Route::post('password/forgot-password', [ForgotPasswordController::class, 'sendResetLinkResponse'])->name('passwords.sent');
Route::post('password/reset', [ResetPasswordController::class, 'sendResetResponse'])->name('passwords.reset');

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {


//////////////////RAZAK///////////////////////

Route::post("change_profil_picture/{id}", [UserController::class, 'changeProfilPicture']);

//////////////////END/////////////////////////

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

     //*** search api quartiers
        Route::get('user-search', 'UsersApiController@search');

    // Content Category
    Route::apiResource('content-categories', 'ContentCategoryApiController');

    // Property Type
    Route::apiResource('property-types', 'PropertyTypeApiController');

    // Type Of House
    Route::apiResource('type-of-houses', 'TypeOfHouseApiController');

    // Type Adm Doc
    Route::apiResource('type-adm-docs', 'TypeAdmDocApiController');

    // Land Category
    Route::apiResource('land-categories', 'LandCategoryApiController');

    // Unit Measure
    Route::apiResource('unit-measures', 'UnitMeasureApiController');

    // Type Of Wheel
    Route::apiResource('type-of-wheels', 'TypeOfWheelApiController');

    // Type Of Utility
    Route::apiResource('type-of-utilities', 'TypeOfUtilityApiController');

    // Motricity Type
    Route::apiResource('motricity-types', 'MotricityTypeApiController');

    // Model Of Vehicle
    Route::apiResource('model-of-vehicles', 'ModelOfVehicleApiController');

    // Rim Type
    Route::apiResource('rim-types', 'RimTypeApiController');

    // Color Type
    Route::apiResource('color-types', 'ColorTypeApiController');

    // Gear Box
    Route::apiResource('gear-boxes', 'GearBoxApiController');

    // Vehicle Type
    Route::apiResource('vehicle-types', 'VehicleTypeApiController');

    // Type Of Trip
    Route::apiResource('type-of-trips', 'TypeOfTripApiController');

    // Convenience Type
    Route::apiResource('convenience-types', 'ConvenienceTypeApiController');

    // Hosting Type
    Route::apiResource('hosting-types', 'HostingTypeApiController');

    // Servicesinclus
    Route::apiResource('servicesinclus', 'ServicesinclusApiController');

    // Objecttype
    Route::apiResource('objecttypes', 'ObjecttypeApiController');

    // Rating Type
    Route::apiResource('rating-types', 'RatingTypeApiController');

    // Type Offer
    Route::apiResource('type-offers', 'TypeOfferApiController');

    // Payment Mode
    Route::apiResource('payment-modes', 'PaymentModeApiController');

    // Emergency Level
    Route::apiResource('emergency-levels', 'EmergencyLevelApiController');

    // Reason
    Route::apiResource('reasons', 'ReasonApiController');

    // Day
    Route::apiResource('days', 'DayApiController');

    // Type Of Media
    Route::apiResource('type-of-media', 'TypeOfMediaApiController');

    // Set Country
    Route::apiResource('set-countries', 'SetCountryApiController');

    // City
    Route::apiResource('cities', 'CityApiController');

    //*** search api city
    Route::get('cities-search', 'CityApiController@search');

    //*** search api name of cities
    Route::get('city-name/{country_id}', 'CityApiController@allCityName');

     //*** Retreive City id by name
    Route::get('city-id/{name}', 'CityApiController@cityId');


    // Quartier
    Route::apiResource('quartiers', 'QuartierApiController');

    //*** search api quartiers
    Route::get('quartiers-search', 'QuartierApiController@search');

    // Areas Of Service
    Route::apiResource('areas-of-services', 'AreasOfServiceApiController');

    // Configuration
    Route::apiResource('configurations', 'ConfigurationApiController');

    // List Of Country
    Route::apiResource('list-of-countries', 'ListOfCountryApiController');

    // List Statut
    Route::apiResource('list-statuts', 'ListStatutApiController');

    // Parameter User Type
    Route::apiResource('parameter-user-types', 'ParameterUserTypeApiController');

    // Brand
    Route::apiResource('brands', 'BrandApiController');

    // Comment
    Route::apiResource('comments', 'CommentApiController');

    // License
    Route::apiResource('licenses', 'LicenseApiController');

    // Notification
    Route::apiResource('notifications', 'NotificationApiController');

    // Carpooling Vehicle
    Route::apiResource('carpooling-vehicles', 'CarpoolingVehicleApiController');

    // Energy Type
    Route::apiResource('energy-types', 'EnergyTypeApiController');

    // Ratings
    Route::apiResource('ratings', 'RatingsApiController');

    // Trips
    Route::apiResource('trips', 'TripsApiController');

    // Trip Frequency
    Route::apiResource('trip-frequencies', 'TripFrequencyApiController');

    // Accept Cgu
    Route::apiResource('accept-cgus', 'AcceptCguApiController');

    // Userservices
    Route::apiResource('userservices', 'UserservicesApiController');

    // Userparam
    Route::apiResource('userparams', 'UserparamApiController');

    // Signaler
    Route::apiResource('signalers', 'SignalerApiController');

    // Approve
    Route::apiResource('approves', 'ApproveApiController');

    // Carpools
    Route::apiResource('carpools', 'CarpoolsApiController');

    // Release Good
    Route::resource('release-goods', ReleaseGoodApiController::class);

    //*** search release good
        Route::get('release-goods-search/{user_id}', 'ReleaseGoodApiController@search');

    // Release Good Convenience
    Route::apiResource('release-good-conveniences', 'ReleaseGoodConvenienceApiController');

    // Local
    Route::apiResource('locals', 'LocalApiController');

    // Land
    Route::apiResource('lands', 'LandApiController');

    // Local Convenience
    Route::apiResource('local-conveniences', 'LocalConvenienceApiController');

    // Land Docs
    Route::apiResource('land-docs', 'LandDocsApiController');

    // Lodging
    Route::apiResource('lodgings', 'LodgingApiController');

    // Hosting Availability
    Route::apiResource('hosting-availabilities', 'HostingAvailabilityApiController');

    // Hostingspec
    Route::apiResource('hostingspecs', 'HostingspecApiController');

    // Hosting Services
    Route::apiResource('hosting-services', 'HostingServicesApiController');

    // Allmedias
    Route::post('allmedias/media', 'AllmediasApiController@storeMedia')->name('allmedias.storeMedia');
    Route::apiResource('allmedias', 'AllmediasApiController');

    // Sell Rent Car
    Route::apiResource('sell-rent-cars', 'SellRentCarApiController');

    // Vehicle Availability
    Route::apiResource('vehicle-availabilities', 'VehicleAvailabilityApiController');

    // Need Vehicle
    Route::apiResource('need-vehicles', 'NeedVehicleApiController');

    // Besoin Hebergement
    Route::apiResource('besoin-hebergements', 'BesoinHebergementApiController');

    // Need Land
    Route::apiResource('need-lands', 'NeedLandApiController');

    // Besoin Local
    Route::apiResource('besoin-locals', 'BesoinLocalApiController');

    // Bookreleasegood
    Route::apiResource('bookreleasegoods', 'BookreleasegoodApiController');

     //Route::post('bookreleasegood/{user_id}', 'BookreleasegoodApiController@search');
     // Besoin
     //////////////////////:razak///////////////////
Route::put("update_user/{id}", [UserController::class, 'update']);
Route::apiResource('besoins', BesoinController::class);
Route::get('user-besoin/{id}',[ BesoinController::class, 'userBesoin']);
Route::put("change_profil_picture/{id}", [UserController::class, 'changeProfilPicture']);
Route::get('destroye-release-good/{id}',[ReleaseGoodApiController::class, 'destroyRelease']);
Route::post("upload_image", [ReleaseGoodApiController::class, 'uploadImage']);

//////////////////////////end//////////////////

});

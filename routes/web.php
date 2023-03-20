<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Property Type
    Route::delete('property-types/destroy', 'PropertyTypeController@massDestroy')->name('property-types.massDestroy');
    Route::post('property-types/parse-csv-import', 'PropertyTypeController@parseCsvImport')->name('property-types.parseCsvImport');
    Route::post('property-types/process-csv-import', 'PropertyTypeController@processCsvImport')->name('property-types.processCsvImport');
    Route::resource('property-types', 'PropertyTypeController');

    // Type Of House
    Route::delete('type-of-houses/destroy', 'TypeOfHouseController@massDestroy')->name('type-of-houses.massDestroy');
    Route::post('type-of-houses/parse-csv-import', 'TypeOfHouseController@parseCsvImport')->name('type-of-houses.parseCsvImport');
    Route::post('type-of-houses/process-csv-import', 'TypeOfHouseController@processCsvImport')->name('type-of-houses.processCsvImport');
    Route::resource('type-of-houses', 'TypeOfHouseController');

    // Type Adm Doc
    Route::delete('type-adm-docs/destroy', 'TypeAdmDocController@massDestroy')->name('type-adm-docs.massDestroy');
    Route::post('type-adm-docs/parse-csv-import', 'TypeAdmDocController@parseCsvImport')->name('type-adm-docs.parseCsvImport');
    Route::post('type-adm-docs/process-csv-import', 'TypeAdmDocController@processCsvImport')->name('type-adm-docs.processCsvImport');
    Route::resource('type-adm-docs', 'TypeAdmDocController');

    // Land Category
    Route::delete('land-categories/destroy', 'LandCategoryController@massDestroy')->name('land-categories.massDestroy');
    Route::post('land-categories/parse-csv-import', 'LandCategoryController@parseCsvImport')->name('land-categories.parseCsvImport');
    Route::post('land-categories/process-csv-import', 'LandCategoryController@processCsvImport')->name('land-categories.processCsvImport');
    Route::resource('land-categories', 'LandCategoryController');

    // Unit Measure
    Route::delete('unit-measures/destroy', 'UnitMeasureController@massDestroy')->name('unit-measures.massDestroy');
    Route::post('unit-measures/parse-csv-import', 'UnitMeasureController@parseCsvImport')->name('unit-measures.parseCsvImport');
    Route::post('unit-measures/process-csv-import', 'UnitMeasureController@processCsvImport')->name('unit-measures.processCsvImport');
    Route::resource('unit-measures', 'UnitMeasureController');

    // Type Of Wheel
    Route::delete('type-of-wheels/destroy', 'TypeOfWheelController@massDestroy')->name('type-of-wheels.massDestroy');
    Route::post('type-of-wheels/parse-csv-import', 'TypeOfWheelController@parseCsvImport')->name('type-of-wheels.parseCsvImport');
    Route::post('type-of-wheels/process-csv-import', 'TypeOfWheelController@processCsvImport')->name('type-of-wheels.processCsvImport');
    Route::resource('type-of-wheels', 'TypeOfWheelController');

    // Type Of Utility
    Route::delete('type-of-utilities/destroy', 'TypeOfUtilityController@massDestroy')->name('type-of-utilities.massDestroy');
    Route::post('type-of-utilities/parse-csv-import', 'TypeOfUtilityController@parseCsvImport')->name('type-of-utilities.parseCsvImport');
    Route::post('type-of-utilities/process-csv-import', 'TypeOfUtilityController@processCsvImport')->name('type-of-utilities.processCsvImport');
    Route::resource('type-of-utilities', 'TypeOfUtilityController');

    // Motricity Type
    Route::delete('motricity-types/destroy', 'MotricityTypeController@massDestroy')->name('motricity-types.massDestroy');
    Route::post('motricity-types/parse-csv-import', 'MotricityTypeController@parseCsvImport')->name('motricity-types.parseCsvImport');
    Route::post('motricity-types/process-csv-import', 'MotricityTypeController@processCsvImport')->name('motricity-types.processCsvImport');
    Route::resource('motricity-types', 'MotricityTypeController');

    // Model Of Vehicle
    Route::delete('model-of-vehicles/destroy', 'ModelOfVehicleController@massDestroy')->name('model-of-vehicles.massDestroy');
    Route::post('model-of-vehicles/parse-csv-import', 'ModelOfVehicleController@parseCsvImport')->name('model-of-vehicles.parseCsvImport');
    Route::post('model-of-vehicles/process-csv-import', 'ModelOfVehicleController@processCsvImport')->name('model-of-vehicles.processCsvImport');
    Route::resource('model-of-vehicles', 'ModelOfVehicleController');

    // Rim Type
    Route::delete('rim-types/destroy', 'RimTypeController@massDestroy')->name('rim-types.massDestroy');
    Route::post('rim-types/parse-csv-import', 'RimTypeController@parseCsvImport')->name('rim-types.parseCsvImport');
    Route::post('rim-types/process-csv-import', 'RimTypeController@processCsvImport')->name('rim-types.processCsvImport');
    Route::resource('rim-types', 'RimTypeController');

    // Color Type
    Route::delete('color-types/destroy', 'ColorTypeController@massDestroy')->name('color-types.massDestroy');
    Route::post('color-types/parse-csv-import', 'ColorTypeController@parseCsvImport')->name('color-types.parseCsvImport');
    Route::post('color-types/process-csv-import', 'ColorTypeController@processCsvImport')->name('color-types.processCsvImport');
    Route::resource('color-types', 'ColorTypeController');

    // Gear Box
    Route::delete('gear-boxes/destroy', 'GearBoxController@massDestroy')->name('gear-boxes.massDestroy');
    Route::post('gear-boxes/parse-csv-import', 'GearBoxController@parseCsvImport')->name('gear-boxes.parseCsvImport');
    Route::post('gear-boxes/process-csv-import', 'GearBoxController@processCsvImport')->name('gear-boxes.processCsvImport');
    Route::resource('gear-boxes', 'GearBoxController');

    // Vehicle Type
    Route::delete('vehicle-types/destroy', 'VehicleTypeController@massDestroy')->name('vehicle-types.massDestroy');
    Route::post('vehicle-types/parse-csv-import', 'VehicleTypeController@parseCsvImport')->name('vehicle-types.parseCsvImport');
    Route::post('vehicle-types/process-csv-import', 'VehicleTypeController@processCsvImport')->name('vehicle-types.processCsvImport');
    Route::resource('vehicle-types', 'VehicleTypeController');

    // Type Of Trip
    Route::delete('type-of-trips/destroy', 'TypeOfTripController@massDestroy')->name('type-of-trips.massDestroy');
    Route::post('type-of-trips/parse-csv-import', 'TypeOfTripController@parseCsvImport')->name('type-of-trips.parseCsvImport');
    Route::post('type-of-trips/process-csv-import', 'TypeOfTripController@processCsvImport')->name('type-of-trips.processCsvImport');
    Route::resource('type-of-trips', 'TypeOfTripController');

    // Convenience Type
    Route::delete('convenience-types/destroy', 'ConvenienceTypeController@massDestroy')->name('convenience-types.massDestroy');
    Route::post('convenience-types/parse-csv-import', 'ConvenienceTypeController@parseCsvImport')->name('convenience-types.parseCsvImport');
    Route::post('convenience-types/process-csv-import', 'ConvenienceTypeController@processCsvImport')->name('convenience-types.processCsvImport');
    Route::resource('convenience-types', 'ConvenienceTypeController');

    // Hosting Type
    Route::delete('hosting-types/destroy', 'HostingTypeController@massDestroy')->name('hosting-types.massDestroy');
    Route::post('hosting-types/parse-csv-import', 'HostingTypeController@parseCsvImport')->name('hosting-types.parseCsvImport');
    Route::post('hosting-types/process-csv-import', 'HostingTypeController@processCsvImport')->name('hosting-types.processCsvImport');
    Route::resource('hosting-types', 'HostingTypeController');

    // Servicesinclus
    Route::delete('servicesinclus/destroy', 'ServicesinclusController@massDestroy')->name('servicesinclus.massDestroy');
    Route::post('servicesinclus/parse-csv-import', 'ServicesinclusController@parseCsvImport')->name('servicesinclus.parseCsvImport');
    Route::post('servicesinclus/process-csv-import', 'ServicesinclusController@processCsvImport')->name('servicesinclus.processCsvImport');
    Route::resource('servicesinclus', 'ServicesinclusController');

    // Objecttype
    Route::delete('objecttypes/destroy', 'ObjecttypeController@massDestroy')->name('objecttypes.massDestroy');
    Route::post('objecttypes/parse-csv-import', 'ObjecttypeController@parseCsvImport')->name('objecttypes.parseCsvImport');
    Route::post('objecttypes/process-csv-import', 'ObjecttypeController@processCsvImport')->name('objecttypes.processCsvImport');
    Route::resource('objecttypes', 'ObjecttypeController');

    // Rating Type
    Route::delete('rating-types/destroy', 'RatingTypeController@massDestroy')->name('rating-types.massDestroy');
    Route::post('rating-types/parse-csv-import', 'RatingTypeController@parseCsvImport')->name('rating-types.parseCsvImport');
    Route::post('rating-types/process-csv-import', 'RatingTypeController@processCsvImport')->name('rating-types.processCsvImport');
    Route::resource('rating-types', 'RatingTypeController');

    // Type Offer
    Route::delete('type-offers/destroy', 'TypeOfferController@massDestroy')->name('type-offers.massDestroy');
    Route::post('type-offers/parse-csv-import', 'TypeOfferController@parseCsvImport')->name('type-offers.parseCsvImport');
    Route::post('type-offers/process-csv-import', 'TypeOfferController@processCsvImport')->name('type-offers.processCsvImport');
    Route::resource('type-offers', 'TypeOfferController');

    // Payment Mode
    Route::delete('payment-modes/destroy', 'PaymentModeController@massDestroy')->name('payment-modes.massDestroy');
    Route::post('payment-modes/parse-csv-import', 'PaymentModeController@parseCsvImport')->name('payment-modes.parseCsvImport');
    Route::post('payment-modes/process-csv-import', 'PaymentModeController@processCsvImport')->name('payment-modes.processCsvImport');
    Route::resource('payment-modes', 'PaymentModeController');

    // Emergency Level
    Route::delete('emergency-levels/destroy', 'EmergencyLevelController@massDestroy')->name('emergency-levels.massDestroy');
    Route::post('emergency-levels/parse-csv-import', 'EmergencyLevelController@parseCsvImport')->name('emergency-levels.parseCsvImport');
    Route::post('emergency-levels/process-csv-import', 'EmergencyLevelController@processCsvImport')->name('emergency-levels.processCsvImport');
    Route::resource('emergency-levels', 'EmergencyLevelController');

    // Reason
    Route::delete('reasons/destroy', 'ReasonController@massDestroy')->name('reasons.massDestroy');
    Route::post('reasons/parse-csv-import', 'ReasonController@parseCsvImport')->name('reasons.parseCsvImport');
    Route::post('reasons/process-csv-import', 'ReasonController@processCsvImport')->name('reasons.processCsvImport');
    Route::resource('reasons', 'ReasonController');

    // Day
    Route::delete('days/destroy', 'DayController@massDestroy')->name('days.massDestroy');
    Route::post('days/parse-csv-import', 'DayController@parseCsvImport')->name('days.parseCsvImport');
    Route::post('days/process-csv-import', 'DayController@processCsvImport')->name('days.processCsvImport');
    Route::resource('days', 'DayController');

    // Type Of Media
    Route::delete('type-of-media/destroy', 'TypeOfMediaController@massDestroy')->name('type-of-media.massDestroy');
    Route::post('type-of-media/parse-csv-import', 'TypeOfMediaController@parseCsvImport')->name('type-of-media.parseCsvImport');
    Route::post('type-of-media/process-csv-import', 'TypeOfMediaController@processCsvImport')->name('type-of-media.processCsvImport');
    Route::resource('type-of-media', 'TypeOfMediaController');

    // Set Country
    Route::delete('set-countries/destroy', 'SetCountryController@massDestroy')->name('set-countries.massDestroy');
    Route::post('set-countries/parse-csv-import', 'SetCountryController@parseCsvImport')->name('set-countries.parseCsvImport');
    Route::post('set-countries/process-csv-import', 'SetCountryController@processCsvImport')->name('set-countries.processCsvImport');
    Route::resource('set-countries', 'SetCountryController');

    // City
    Route::delete('cities/destroy', 'CityController@massDestroy')->name('cities.massDestroy');
    Route::post('cities/parse-csv-import', 'CityController@parseCsvImport')->name('cities.parseCsvImport');
    Route::post('cities/process-csv-import', 'CityController@processCsvImport')->name('cities.processCsvImport');
    Route::resource('cities', 'CityController');

    // Quartier
    Route::delete('quartiers/destroy', 'QuartierController@massDestroy')->name('quartiers.massDestroy');
    Route::post('quartiers/parse-csv-import', 'QuartierController@parseCsvImport')->name('quartiers.parseCsvImport');
    Route::post('quartiers/process-csv-import', 'QuartierController@processCsvImport')->name('quartiers.processCsvImport');
    Route::resource('quartiers', 'QuartierController');

    // Areas Of Service
    Route::delete('areas-of-services/destroy', 'AreasOfServiceController@massDestroy')->name('areas-of-services.massDestroy');
    Route::post('areas-of-services/parse-csv-import', 'AreasOfServiceController@parseCsvImport')->name('areas-of-services.parseCsvImport');
    Route::post('areas-of-services/process-csv-import', 'AreasOfServiceController@processCsvImport')->name('areas-of-services.processCsvImport');
    Route::resource('areas-of-services', 'AreasOfServiceController');

    // Configuration
    Route::delete('configurations/destroy', 'ConfigurationController@massDestroy')->name('configurations.massDestroy');
    Route::post('configurations/parse-csv-import', 'ConfigurationController@parseCsvImport')->name('configurations.parseCsvImport');
    Route::post('configurations/process-csv-import', 'ConfigurationController@processCsvImport')->name('configurations.processCsvImport');
    Route::resource('configurations', 'ConfigurationController');

    // List Of Country
    Route::delete('list-of-countries/destroy', 'ListOfCountryController@massDestroy')->name('list-of-countries.massDestroy');
    Route::post('list-of-countries/parse-csv-import', 'ListOfCountryController@parseCsvImport')->name('list-of-countries.parseCsvImport');
    Route::post('list-of-countries/process-csv-import', 'ListOfCountryController@processCsvImport')->name('list-of-countries.processCsvImport');
    Route::resource('list-of-countries', 'ListOfCountryController');

    // List Statut
    Route::delete('list-statuts/destroy', 'ListStatutController@massDestroy')->name('list-statuts.massDestroy');
    Route::post('list-statuts/parse-csv-import', 'ListStatutController@parseCsvImport')->name('list-statuts.parseCsvImport');
    Route::post('list-statuts/process-csv-import', 'ListStatutController@processCsvImport')->name('list-statuts.processCsvImport');
    Route::resource('list-statuts', 'ListStatutController');

    // Parameter User Type
    Route::delete('parameter-user-types/destroy', 'ParameterUserTypeController@massDestroy')->name('parameter-user-types.massDestroy');
    Route::post('parameter-user-types/parse-csv-import', 'ParameterUserTypeController@parseCsvImport')->name('parameter-user-types.parseCsvImport');
    Route::post('parameter-user-types/process-csv-import', 'ParameterUserTypeController@processCsvImport')->name('parameter-user-types.processCsvImport');
    Route::resource('parameter-user-types', 'ParameterUserTypeController');

    // Favoris
    Route::delete('favoris/destroy', 'FavorisController@massDestroy')->name('favoris.massDestroy');
    Route::resource('favoris', 'FavorisController');

    // Brand
    Route::delete('brands/destroy', 'BrandController@massDestroy')->name('brands.massDestroy');
    Route::post('brands/parse-csv-import', 'BrandController@parseCsvImport')->name('brands.parseCsvImport');
    Route::post('brands/process-csv-import', 'BrandController@processCsvImport')->name('brands.processCsvImport');
    Route::resource('brands', 'BrandController');

    // Comment
    Route::delete('comments/destroy', 'CommentController@massDestroy')->name('comments.massDestroy');
    Route::post('comments/parse-csv-import', 'CommentController@parseCsvImport')->name('comments.parseCsvImport');
    Route::post('comments/process-csv-import', 'CommentController@processCsvImport')->name('comments.processCsvImport');
    Route::resource('comments', 'CommentController');

    // License
    Route::delete('licenses/destroy', 'LicenseController@massDestroy')->name('licenses.massDestroy');
    Route::post('licenses/parse-csv-import', 'LicenseController@parseCsvImport')->name('licenses.parseCsvImport');
    Route::post('licenses/process-csv-import', 'LicenseController@processCsvImport')->name('licenses.processCsvImport');
    Route::resource('licenses', 'LicenseController');

    // Notification
    Route::delete('notifications/destroy', 'NotificationController@massDestroy')->name('notifications.massDestroy');
    Route::post('notifications/parse-csv-import', 'NotificationController@parseCsvImport')->name('notifications.parseCsvImport');
    Route::post('notifications/process-csv-import', 'NotificationController@processCsvImport')->name('notifications.processCsvImport');
    Route::resource('notifications', 'NotificationController');

    // Carpooling Vehicle
    Route::delete('carpooling-vehicles/destroy', 'CarpoolingVehicleController@massDestroy')->name('carpooling-vehicles.massDestroy');
    Route::post('carpooling-vehicles/parse-csv-import', 'CarpoolingVehicleController@parseCsvImport')->name('carpooling-vehicles.parseCsvImport');
    Route::post('carpooling-vehicles/process-csv-import', 'CarpoolingVehicleController@processCsvImport')->name('carpooling-vehicles.processCsvImport');
    Route::resource('carpooling-vehicles', 'CarpoolingVehicleController');

    // Energy Type
    Route::delete('energy-types/destroy', 'EnergyTypeController@massDestroy')->name('energy-types.massDestroy');
    Route::post('energy-types/parse-csv-import', 'EnergyTypeController@parseCsvImport')->name('energy-types.parseCsvImport');
    Route::post('energy-types/process-csv-import', 'EnergyTypeController@processCsvImport')->name('energy-types.processCsvImport');
    Route::resource('energy-types', 'EnergyTypeController');

    // Ratings
    Route::delete('ratings/destroy', 'RatingsController@massDestroy')->name('ratings.massDestroy');
    Route::post('ratings/parse-csv-import', 'RatingsController@parseCsvImport')->name('ratings.parseCsvImport');
    Route::post('ratings/process-csv-import', 'RatingsController@processCsvImport')->name('ratings.processCsvImport');
    Route::resource('ratings', 'RatingsController');

    // Trips
    Route::delete('trips/destroy', 'TripsController@massDestroy')->name('trips.massDestroy');
    Route::post('trips/parse-csv-import', 'TripsController@parseCsvImport')->name('trips.parseCsvImport');
    Route::post('trips/process-csv-import', 'TripsController@processCsvImport')->name('trips.processCsvImport');
    Route::resource('trips', 'TripsController');

    // Trip Frequency
    Route::delete('trip-frequencies/destroy', 'TripFrequencyController@massDestroy')->name('trip-frequencies.massDestroy');
    Route::post('trip-frequencies/parse-csv-import', 'TripFrequencyController@parseCsvImport')->name('trip-frequencies.parseCsvImport');
    Route::post('trip-frequencies/process-csv-import', 'TripFrequencyController@processCsvImport')->name('trip-frequencies.processCsvImport');
    Route::resource('trip-frequencies', 'TripFrequencyController');

    // Accept Cgu
    Route::delete('accept-cgus/destroy', 'AcceptCguController@massDestroy')->name('accept-cgus.massDestroy');
    Route::post('accept-cgus/parse-csv-import', 'AcceptCguController@parseCsvImport')->name('accept-cgus.parseCsvImport');
    Route::post('accept-cgus/process-csv-import', 'AcceptCguController@processCsvImport')->name('accept-cgus.processCsvImport');
    Route::resource('accept-cgus', 'AcceptCguController');

    // Userservices
    Route::delete('userservices/destroy', 'UserservicesController@massDestroy')->name('userservices.massDestroy');
    Route::post('userservices/parse-csv-import', 'UserservicesController@parseCsvImport')->name('userservices.parseCsvImport');
    Route::post('userservices/process-csv-import', 'UserservicesController@processCsvImport')->name('userservices.processCsvImport');
    Route::resource('userservices', 'UserservicesController');

    // Userparam
    Route::delete('userparams/destroy', 'UserparamController@massDestroy')->name('userparams.massDestroy');
    Route::post('userparams/parse-csv-import', 'UserparamController@parseCsvImport')->name('userparams.parseCsvImport');
    Route::post('userparams/process-csv-import', 'UserparamController@processCsvImport')->name('userparams.processCsvImport');
    Route::resource('userparams', 'UserparamController');

    // Signaler
    Route::delete('signalers/destroy', 'SignalerController@massDestroy')->name('signalers.massDestroy');
    Route::post('signalers/parse-csv-import', 'SignalerController@parseCsvImport')->name('signalers.parseCsvImport');
    Route::post('signalers/process-csv-import', 'SignalerController@processCsvImport')->name('signalers.processCsvImport');
    Route::resource('signalers', 'SignalerController');

    // Approve
    Route::delete('approves/destroy', 'ApproveController@massDestroy')->name('approves.massDestroy');
    Route::post('approves/parse-csv-import', 'ApproveController@parseCsvImport')->name('approves.parseCsvImport');
    Route::post('approves/process-csv-import', 'ApproveController@processCsvImport')->name('approves.processCsvImport');
    Route::resource('approves', 'ApproveController');

    // Carpools
    Route::delete('carpools/destroy', 'CarpoolsController@massDestroy')->name('carpools.massDestroy');
    Route::post('carpools/parse-csv-import', 'CarpoolsController@parseCsvImport')->name('carpools.parseCsvImport');
    Route::post('carpools/process-csv-import', 'CarpoolsController@processCsvImport')->name('carpools.processCsvImport');
    Route::resource('carpools', 'CarpoolsController');

    // Release Good
    Route::delete('release-goods/destroy', 'ReleaseGoodController@massDestroy')->name('release-goods.massDestroy');
    Route::post('release-goods/parse-csv-import', 'ReleaseGoodController@parseCsvImport')->name('release-goods.parseCsvImport');
    Route::post('release-goods/process-csv-import', 'ReleaseGoodController@processCsvImport')->name('release-goods.processCsvImport');
    Route::resource('release-goods', 'ReleaseGoodController');

    // Release Good Convenience
    Route::delete('release-good-conveniences/destroy', 'ReleaseGoodConvenienceController@massDestroy')->name('release-good-conveniences.massDestroy');
    Route::post('release-good-conveniences/parse-csv-import', 'ReleaseGoodConvenienceController@parseCsvImport')->name('release-good-conveniences.parseCsvImport');
    Route::post('release-good-conveniences/process-csv-import', 'ReleaseGoodConvenienceController@processCsvImport')->name('release-good-conveniences.processCsvImport');
    Route::resource('release-good-conveniences', 'ReleaseGoodConvenienceController');

    // Local
    Route::delete('locals/destroy', 'LocalController@massDestroy')->name('locals.massDestroy');
    Route::post('locals/parse-csv-import', 'LocalController@parseCsvImport')->name('locals.parseCsvImport');
    Route::post('locals/process-csv-import', 'LocalController@processCsvImport')->name('locals.processCsvImport');
    Route::resource('locals', 'LocalController');

    // Land
    Route::delete('lands/destroy', 'LandController@massDestroy')->name('lands.massDestroy');
    Route::post('lands/parse-csv-import', 'LandController@parseCsvImport')->name('lands.parseCsvImport');
    Route::post('lands/process-csv-import', 'LandController@processCsvImport')->name('lands.processCsvImport');
    Route::resource('lands', 'LandController');

    // Local Convenience
    Route::delete('local-conveniences/destroy', 'LocalConvenienceController@massDestroy')->name('local-conveniences.massDestroy');
    Route::post('local-conveniences/parse-csv-import', 'LocalConvenienceController@parseCsvImport')->name('local-conveniences.parseCsvImport');
    Route::post('local-conveniences/process-csv-import', 'LocalConvenienceController@processCsvImport')->name('local-conveniences.processCsvImport');
    Route::resource('local-conveniences', 'LocalConvenienceController');

    // Land Docs
    Route::delete('land-docs/destroy', 'LandDocsController@massDestroy')->name('land-docs.massDestroy');
    Route::post('land-docs/parse-csv-import', 'LandDocsController@parseCsvImport')->name('land-docs.parseCsvImport');
    Route::post('land-docs/process-csv-import', 'LandDocsController@processCsvImport')->name('land-docs.processCsvImport');
    Route::resource('land-docs', 'LandDocsController');

    // Lodging
    Route::delete('lodgings/destroy', 'LodgingController@massDestroy')->name('lodgings.massDestroy');
    Route::post('lodgings/parse-csv-import', 'LodgingController@parseCsvImport')->name('lodgings.parseCsvImport');
    Route::post('lodgings/process-csv-import', 'LodgingController@processCsvImport')->name('lodgings.processCsvImport');
    Route::resource('lodgings', 'LodgingController');

    // Hosting Availability
    Route::delete('hosting-availabilities/destroy', 'HostingAvailabilityController@massDestroy')->name('hosting-availabilities.massDestroy');
    Route::post('hosting-availabilities/parse-csv-import', 'HostingAvailabilityController@parseCsvImport')->name('hosting-availabilities.parseCsvImport');
    Route::post('hosting-availabilities/process-csv-import', 'HostingAvailabilityController@processCsvImport')->name('hosting-availabilities.processCsvImport');
    Route::resource('hosting-availabilities', 'HostingAvailabilityController');

    // Hostingspec
    Route::delete('hostingspecs/destroy', 'HostingspecController@massDestroy')->name('hostingspecs.massDestroy');
    Route::post('hostingspecs/parse-csv-import', 'HostingspecController@parseCsvImport')->name('hostingspecs.parseCsvImport');
    Route::post('hostingspecs/process-csv-import', 'HostingspecController@processCsvImport')->name('hostingspecs.processCsvImport');
    Route::resource('hostingspecs', 'HostingspecController');

    // Hosting Services
    Route::delete('hosting-services/destroy', 'HostingServicesController@massDestroy')->name('hosting-services.massDestroy');
    Route::post('hosting-services/parse-csv-import', 'HostingServicesController@parseCsvImport')->name('hosting-services.parseCsvImport');
    Route::post('hosting-services/process-csv-import', 'HostingServicesController@processCsvImport')->name('hosting-services.processCsvImport');
    Route::resource('hosting-services', 'HostingServicesController');

    // Allmedias
    Route::delete('allmedias/destroy', 'AllmediasController@massDestroy')->name('allmedias.massDestroy');
    Route::post('allmedias/media', 'AllmediasController@storeMedia')->name('allmedias.storeMedia');
    Route::post('allmedias/ckmedia', 'AllmediasController@storeCKEditorImages')->name('allmedias.storeCKEditorImages');
    Route::post('allmedias/parse-csv-import', 'AllmediasController@parseCsvImport')->name('allmedias.parseCsvImport');
    Route::post('allmedias/process-csv-import', 'AllmediasController@processCsvImport')->name('allmedias.processCsvImport');
    Route::resource('allmedias', 'AllmediasController');

    // Sell Rent Car
    Route::delete('sell-rent-cars/destroy', 'SellRentCarController@massDestroy')->name('sell-rent-cars.massDestroy');
    Route::post('sell-rent-cars/parse-csv-import', 'SellRentCarController@parseCsvImport')->name('sell-rent-cars.parseCsvImport');
    Route::post('sell-rent-cars/process-csv-import', 'SellRentCarController@processCsvImport')->name('sell-rent-cars.processCsvImport');
    Route::resource('sell-rent-cars', 'SellRentCarController');

    // Vehicle Availability
    Route::delete('vehicle-availabilities/destroy', 'VehicleAvailabilityController@massDestroy')->name('vehicle-availabilities.massDestroy');
    Route::post('vehicle-availabilities/parse-csv-import', 'VehicleAvailabilityController@parseCsvImport')->name('vehicle-availabilities.parseCsvImport');
    Route::post('vehicle-availabilities/process-csv-import', 'VehicleAvailabilityController@processCsvImport')->name('vehicle-availabilities.processCsvImport');
    Route::resource('vehicle-availabilities', 'VehicleAvailabilityController');

    // Need Vehicle
    Route::delete('need-vehicles/destroy', 'NeedVehicleController@massDestroy')->name('need-vehicles.massDestroy');
    Route::post('need-vehicles/parse-csv-import', 'NeedVehicleController@parseCsvImport')->name('need-vehicles.parseCsvImport');
    Route::post('need-vehicles/process-csv-import', 'NeedVehicleController@processCsvImport')->name('need-vehicles.processCsvImport');
    Route::resource('need-vehicles', 'NeedVehicleController');

    // Besoin Hebergement
    Route::delete('besoin-hebergements/destroy', 'BesoinHebergementController@massDestroy')->name('besoin-hebergements.massDestroy');
    Route::post('besoin-hebergements/parse-csv-import', 'BesoinHebergementController@parseCsvImport')->name('besoin-hebergements.parseCsvImport');
    Route::post('besoin-hebergements/process-csv-import', 'BesoinHebergementController@processCsvImport')->name('besoin-hebergements.processCsvImport');
    Route::resource('besoin-hebergements', 'BesoinHebergementController');

    // Need Land
    Route::delete('need-lands/destroy', 'NeedLandController@massDestroy')->name('need-lands.massDestroy');
    Route::post('need-lands/parse-csv-import', 'NeedLandController@parseCsvImport')->name('need-lands.parseCsvImport');
    Route::post('need-lands/process-csv-import', 'NeedLandController@processCsvImport')->name('need-lands.processCsvImport');
    Route::resource('need-lands', 'NeedLandController');

    // Besoin Local
    Route::delete('besoin-locals/destroy', 'BesoinLocalController@massDestroy')->name('besoin-locals.massDestroy');
    Route::post('besoin-locals/parse-csv-import', 'BesoinLocalController@parseCsvImport')->name('besoin-locals.parseCsvImport');
    Route::post('besoin-locals/process-csv-import', 'BesoinLocalController@processCsvImport')->name('besoin-locals.processCsvImport');
    Route::resource('besoin-locals', 'BesoinLocalController');

    // Bookreleasegood
    Route::delete('bookreleasegoods/destroy', 'BookreleasegoodController@massDestroy')->name('bookreleasegoods.massDestroy');
    Route::post('bookreleasegoods/parse-csv-import', 'BookreleasegoodController@parseCsvImport')->name('bookreleasegoods.parseCsvImport');
    Route::post('bookreleasegoods/process-csv-import', 'BookreleasegoodController@processCsvImport')->name('bookreleasegoods.processCsvImport');
    Route::resource('bookreleasegoods', 'BookreleasegoodController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});

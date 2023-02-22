<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GlobalSearchController extends Controller
{
    private $models = [
        'User'              => 'cruds.user.title',
        'PropertyType'      => 'cruds.propertyType.title',
        'TypeOfHouse'       => 'cruds.typeOfHouse.title',
        'TypeAdmDoc'        => 'cruds.typeAdmDoc.title',
        'LandCategory'      => 'cruds.landCategory.title',
        'UnitMeasure'       => 'cruds.unitMeasure.title',
        'TypeOfWheel'       => 'cruds.typeOfWheel.title',
        'TypeOfUtility'     => 'cruds.typeOfUtility.title',
        'MotricityType'     => 'cruds.motricityType.title',
        'ModelOfVehicle'    => 'cruds.modelOfVehicle.title',
        'RimType'           => 'cruds.rimType.title',
        'ColorType'         => 'cruds.colorType.title',
        'GearBox'           => 'cruds.gearBox.title',
        'VehicleType'       => 'cruds.vehicleType.title',
        'TypeOfTrip'        => 'cruds.typeOfTrip.title',
        'ConvenienceType'   => 'cruds.convenienceType.title',
        'HostingType'       => 'cruds.hostingType.title',
        'Servicesinclu'     => 'cruds.servicesinclu.title',
        'Objecttype'        => 'cruds.objecttype.title',
        'RatingType'        => 'cruds.ratingType.title',
        'TypeOffer'         => 'cruds.typeOffer.title',
        'PaymentMode'       => 'cruds.paymentMode.title',
        'EmergencyLevel'    => 'cruds.emergencyLevel.title',
        'Reason'            => 'cruds.reason.title',
        'Day'               => 'cruds.day.title',
        'TypeOfMedium'      => 'cruds.typeOfMedium.title',
        'SetCountry'        => 'cruds.setCountry.title',
        'City'              => 'cruds.city.title',
        'Quartier'          => 'cruds.quartier.title',
        'AreasOfService'    => 'cruds.areasOfService.title',
        'Configuration'     => 'cruds.configuration.title',
        'ListOfCountry'     => 'cruds.listOfCountry.title',
        'ListStatut'        => 'cruds.listStatut.title',
        'ParameterUserType' => 'cruds.parameterUserType.title',
        'Brand'             => 'cruds.brand.title',
        'Comment'           => 'cruds.comment.title',
        'Notification'      => 'cruds.notification.title',
        'CarpoolingVehicle' => 'cruds.carpoolingVehicle.title',
        'EnergyType'        => 'cruds.energyType.title',
        'Trip'              => 'cruds.trip.title',
        'Carpool'           => 'cruds.carpool.title',
        'ReleaseGood'       => 'cruds.releaseGood.title',
        'SellRentCar'       => 'cruds.sellRentCar.title',
        'NeedVehicle'       => 'cruds.needVehicle.title',
    ];

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search === null || !isset($search['term'])) {
            abort(400);
        }

        $term           = $search['term'];
        $searchableData = [];
        foreach ($this->models as $model => $translation) {
            $modelClass = 'App\Models\\' . $model;
            $query      = $modelClass::query();

            $fields = $modelClass::$searchable;

            foreach ($fields as $field) {
                $query->orWhere($field, 'LIKE', '%' . $term . '%');
            }

            $results = $query->take(10)
                ->get();

            foreach ($results as $result) {
                $parsedData           = $result->only($fields);
                $parsedData['model']  = trans($translation);
                $parsedData['fields'] = $fields;
                $formattedFields      = [];
                foreach ($fields as $field) {
                    $formattedFields[$field] = Str::title(str_replace('_', ' ', $field));
                }
                $parsedData['fields_formated'] = $formattedFields;

                $parsedData['url'] = url('/admin/' . Str::plural(Str::snake($model, '-')) . '/' . $result->id . '/edit');

                $searchableData[] = $parsedData;
            }
        }

        return response()->json(['results' => $searchableData]);
    }
}

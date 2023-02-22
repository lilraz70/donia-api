<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySellRentCarRequest;
use App\Http\Requests\StoreSellRentCarRequest;
use App\Http\Requests\UpdateSellRentCarRequest;
use App\Models\Brand;
use App\Models\ColorType;
use App\Models\EnergyType;
use App\Models\GearBox;
use App\Models\ListOfCountry;
use App\Models\ListStatut;
use App\Models\ModelOfVehicle;
use App\Models\MotricityType;
use App\Models\RimType;
use App\Models\SellRentCar;
use App\Models\TypeOffer;
use App\Models\TypeOfUtility;
use App\Models\TypeOfWheel;
use App\Models\User;
use App\Models\VehicleType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SellRentCarController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sell_rent_car_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SellRentCar::with(['brand', 'modelofvehicle', 'colortype', 'energytype', 'gearbox', 'vehicletype', 'typeofutility', 'motricitytype', 'typeofwheel', 'rimtype', 'listofcountry', 'user', 'liststatut', 'typeoffer'])->select(sprintf('%s.*', (new SellRentCar())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'sell_rent_car_show';
                $editGate = 'sell_rent_car_edit';
                $deleteGate = 'sell_rent_car_delete';
                $crudRoutePart = 'sell-rent-cars';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('finition', function ($row) {
                return $row->finition ? $row->finition : '';
            });
            $table->editColumn('nb_place', function ($row) {
                return $row->nb_place ? $row->nb_place : '';
            });
            $table->editColumn('annee_fabrication', function ($row) {
                return $row->annee_fabrication ? $row->annee_fabrication : '';
            });
            $table->editColumn('conso_au_100_km', function ($row) {
                return $row->conso_au_100_km ? $row->conso_au_100_km : '';
            });
            $table->editColumn('nb_chevaux', function ($row) {
                return $row->nb_chevaux ? $row->nb_chevaux : '';
            });
            $table->editColumn('nb_cylindre', function ($row) {
                return $row->nb_cylindre ? $row->nb_cylindre : '';
            });
            $table->editColumn('accessoires', function ($row) {
                return $row->accessoires ? $row->accessoires : '';
            });
            $table->editColumn('kilometrage', function ($row) {
                return $row->kilometrage ? $row->kilometrage : '';
            });
            $table->editColumn('options', function ($row) {
                return $row->options ? $row->options : '';
            });
            $table->editColumn('pannes_signalees', function ($row) {
                return $row->pannes_signalees ? $row->pannes_signalees : '';
            });
            $table->editColumn('immatriculation', function ($row) {
                return $row->immatriculation ? $row->immatriculation : '';
            });
            $table->addColumn('brand_intitule', function ($row) {
                return $row->brand ? $row->brand->intitule : '';
            });

            $table->addColumn('modelofvehicle_intitule', function ($row) {
                return $row->modelofvehicle ? $row->modelofvehicle->intitule : '';
            });

            $table->addColumn('colortype_intitule', function ($row) {
                return $row->colortype ? $row->colortype->intitule : '';
            });

            $table->addColumn('energytype_intitule', function ($row) {
                return $row->energytype ? $row->energytype->intitule : '';
            });

            $table->addColumn('gearbox_intitule', function ($row) {
                return $row->gearbox ? $row->gearbox->intitule : '';
            });

            $table->addColumn('vehicletype_intitule', function ($row) {
                return $row->vehicletype ? $row->vehicletype->intitule : '';
            });

            $table->addColumn('typeofutility_intitule', function ($row) {
                return $row->typeofutility ? $row->typeofutility->intitule : '';
            });

            $table->addColumn('motricitytype_intitule', function ($row) {
                return $row->motricitytype ? $row->motricitytype->intitule : '';
            });

            $table->addColumn('typeofwheel_intitule', function ($row) {
                return $row->typeofwheel ? $row->typeofwheel->intitule : '';
            });

            $table->addColumn('rimtype_intitule', function ($row) {
                return $row->rimtype ? $row->rimtype->intitule : '';
            });

            $table->addColumn('listofcountry_intitule', function ($row) {
                return $row->listofcountry ? $row->listofcountry->intitule : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('liststatut_intitule', function ($row) {
                return $row->liststatut ? $row->liststatut->intitule : '';
            });

            $table->addColumn('typeoffer_intitule', function ($row) {
                return $row->typeoffer ? $row->typeoffer->intitule : '';
            });

            $table->editColumn('prix_vente', function ($row) {
                return $row->prix_vente ? $row->prix_vente : '';
            });
            $table->editColumn('prix_location', function ($row) {
                return $row->prix_location ? $row->prix_location : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('libelle', function ($row) {
                return $row->libelle ? $row->libelle : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'brand', 'modelofvehicle', 'colortype', 'energytype', 'gearbox', 'vehicletype', 'typeofutility', 'motricitytype', 'typeofwheel', 'rimtype', 'listofcountry', 'user', 'liststatut', 'typeoffer']);

            return $table->make(true);
        }

        $brands            = Brand::get();
        $model_of_vehicles = ModelOfVehicle::get();
        $color_types       = ColorType::get();
        $energy_types      = EnergyType::get();
        $gear_boxes        = GearBox::get();
        $vehicle_types     = VehicleType::get();
        $type_of_utilities = TypeOfUtility::get();
        $motricity_types   = MotricityType::get();
        $type_of_wheels    = TypeOfWheel::get();
        $rim_types         = RimType::get();
        $list_of_countries = ListOfCountry::get();
        $users             = User::get();
        $list_statuts      = ListStatut::get();
        $type_offers       = TypeOffer::get();

        return view('admin.sellRentCars.index', compact('brands', 'model_of_vehicles', 'color_types', 'energy_types', 'gear_boxes', 'vehicle_types', 'type_of_utilities', 'motricity_types', 'type_of_wheels', 'rim_types', 'list_of_countries', 'users', 'list_statuts', 'type_offers'));
    }

    public function create()
    {
        abort_if(Gate::denies('sell_rent_car_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = Brand::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $modelofvehicles = ModelOfVehicle::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $colortypes = ColorType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $energytypes = EnergyType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $gearboxes = GearBox::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicletypes = VehicleType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeofutilities = TypeOfUtility::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $motricitytypes = MotricityType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeofwheels = TypeOfWheel::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rimtypes = RimType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $listofcountries = ListOfCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeoffers = TypeOffer::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sellRentCars.create', compact('brands', 'colortypes', 'energytypes', 'gearboxes', 'listofcountries', 'liststatuts', 'modelofvehicles', 'motricitytypes', 'rimtypes', 'typeoffers', 'typeofutilities', 'typeofwheels', 'users', 'vehicletypes'));
    }

    public function store(StoreSellRentCarRequest $request)
    {
        $sellRentCar = SellRentCar::create($request->all());

        return redirect()->route('admin.sell-rent-cars.index');
    }

    public function edit(SellRentCar $sellRentCar)
    {
        abort_if(Gate::denies('sell_rent_car_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = Brand::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $modelofvehicles = ModelOfVehicle::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $colortypes = ColorType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $energytypes = EnergyType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $gearboxes = GearBox::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicletypes = VehicleType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeofutilities = TypeOfUtility::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $motricitytypes = MotricityType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeofwheels = TypeOfWheel::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rimtypes = RimType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $listofcountries = ListOfCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeoffers = TypeOffer::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sellRentCar->load('brand', 'modelofvehicle', 'colortype', 'energytype', 'gearbox', 'vehicletype', 'typeofutility', 'motricitytype', 'typeofwheel', 'rimtype', 'listofcountry', 'user', 'liststatut', 'typeoffer');

        return view('admin.sellRentCars.edit', compact('brands', 'colortypes', 'energytypes', 'gearboxes', 'listofcountries', 'liststatuts', 'modelofvehicles', 'motricitytypes', 'rimtypes', 'sellRentCar', 'typeoffers', 'typeofutilities', 'typeofwheels', 'users', 'vehicletypes'));
    }

    public function update(UpdateSellRentCarRequest $request, SellRentCar $sellRentCar)
    {
        $sellRentCar->update($request->all());

        return redirect()->route('admin.sell-rent-cars.index');
    }

    public function show(SellRentCar $sellRentCar)
    {
        abort_if(Gate::denies('sell_rent_car_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sellRentCar->load('brand', 'modelofvehicle', 'colortype', 'energytype', 'gearbox', 'vehicletype', 'typeofutility', 'motricitytype', 'typeofwheel', 'rimtype', 'listofcountry', 'user', 'liststatut', 'typeoffer');

        return view('admin.sellRentCars.show', compact('sellRentCar'));
    }

    public function destroy(SellRentCar $sellRentCar)
    {
        abort_if(Gate::denies('sell_rent_car_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sellRentCar->delete();

        return back();
    }

    public function massDestroy(MassDestroySellRentCarRequest $request)
    {
        SellRentCar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

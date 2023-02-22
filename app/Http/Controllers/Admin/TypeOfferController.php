<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTypeOfferRequest;
use App\Http\Requests\StoreTypeOfferRequest;
use App\Http\Requests\UpdateTypeOfferRequest;
use App\Models\TypeOffer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TypeOfferController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('type_offer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TypeOffer::query()->select(sprintf('%s.*', (new TypeOffer())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'type_offer_show';
                $editGate = 'type_offer_edit';
                $deleteGate = 'type_offer_delete';
                $crudRoutePart = 'type-offers';

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
            $table->editColumn('intitule', function ($row) {
                return $row->intitule ? $row->intitule : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.typeOffers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('type_offer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOffers.create');
    }

    public function store(StoreTypeOfferRequest $request)
    {
        $typeOffer = TypeOffer::create($request->all());

        return redirect()->route('admin.type-offers.index');
    }

    public function edit(TypeOffer $typeOffer)
    {
        abort_if(Gate::denies('type_offer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOffers.edit', compact('typeOffer'));
    }

    public function update(UpdateTypeOfferRequest $request, TypeOffer $typeOffer)
    {
        $typeOffer->update($request->all());

        return redirect()->route('admin.type-offers.index');
    }

    public function show(TypeOffer $typeOffer)
    {
        abort_if(Gate::denies('type_offer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOffers.show', compact('typeOffer'));
    }

    public function destroy(TypeOffer $typeOffer)
    {
        abort_if(Gate::denies('type_offer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeOffer->delete();

        return back();
    }

    public function massDestroy(MassDestroyTypeOfferRequest $request)
    {
        TypeOffer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

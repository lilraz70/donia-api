<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPaymentModeRequest;
use App\Http\Requests\StorePaymentModeRequest;
use App\Http\Requests\UpdatePaymentModeRequest;
use App\Models\PaymentMode;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PaymentModeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('payment_mode_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PaymentMode::query()->select(sprintf('%s.*', (new PaymentMode())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'payment_mode_show';
                $editGate = 'payment_mode_edit';
                $deleteGate = 'payment_mode_delete';
                $crudRoutePart = 'payment-modes';

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

        return view('admin.paymentModes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('payment_mode_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paymentModes.create');
    }

    public function store(StorePaymentModeRequest $request)
    {
        $paymentMode = PaymentMode::create($request->all());

        return redirect()->route('admin.payment-modes.index');
    }

    public function edit(PaymentMode $paymentMode)
    {
        abort_if(Gate::denies('payment_mode_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paymentModes.edit', compact('paymentMode'));
    }

    public function update(UpdatePaymentModeRequest $request, PaymentMode $paymentMode)
    {
        $paymentMode->update($request->all());

        return redirect()->route('admin.payment-modes.index');
    }

    public function show(PaymentMode $paymentMode)
    {
        abort_if(Gate::denies('payment_mode_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paymentModes.show', compact('paymentMode'));
    }

    public function destroy(PaymentMode $paymentMode)
    {
        abort_if(Gate::denies('payment_mode_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentMode->delete();

        return back();
    }

    public function massDestroy(MassDestroyPaymentModeRequest $request)
    {
        PaymentMode::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

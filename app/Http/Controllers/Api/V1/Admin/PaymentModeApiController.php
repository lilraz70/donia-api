<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentModeRequest;
use App\Http\Requests\UpdatePaymentModeRequest;
use App\Http\Resources\Admin\PaymentModeResource;
use App\Models\PaymentMode;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentModeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payment_mode_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PaymentModeResource(PaymentMode::all());
    }

    public function store(StorePaymentModeRequest $request)
    {
        $paymentMode = PaymentMode::create($request->all());

        return (new PaymentModeResource($paymentMode))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PaymentMode $paymentMode)
    {
        abort_if(Gate::denies('payment_mode_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PaymentModeResource($paymentMode);
    }

    public function update(UpdatePaymentModeRequest $request, PaymentMode $paymentMode)
    {
        $paymentMode->update($request->all());

        return (new PaymentModeResource($paymentMode))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PaymentMode $paymentMode)
    {
        abort_if(Gate::denies('payment_mode_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentMode->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

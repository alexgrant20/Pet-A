<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StorePaymentTypeRequest;
use App\Http\Requests\Admin\UpdatePaymentTypeRequest;
use App\Models\PaymentType;
use Yajra\DataTables\Facades\DataTables;

class PaymentTypeController extends Controller
{
    public function getList()
    {
        $paymentTypes = PaymentType::all();

        return DataTables::of($paymentTypes)
            ->addIndexColumn()
            ->addColumn('action', function ($paymentType) {
                return view('app.admin.master.payment-type.components.__action', compact('paymentType'));
            })
            ->make();
    }

    public function index()
    {
        return view('app.admin.master.payment-type.index');
    }

    public function create()
    {
        return view('app.admin.master.payment-type.create');
    }

    public function store(StorePaymentTypeRequest $request)
    {
        PaymentType::create($request->validated());

        return to_route('admin.master.payment-type.index')->with('success-toast', 'Payment Type Successfully Created');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(PaymentType $paymentType)
    {
        return view('app.admin.master.payment-type.edit', compact('paymentType'));
    }

    public function update(UpdatePaymentTypeRequest $request, PaymentType $paymentType)
    {
        $paymentType->update($request->validated());

        return to_route('admin.master.payment-type.index')->with('success-toast', 'Payment Type Successfully Updated');
    }

    public function destroy(PaymentType $paymentType)
    {
        $paymentType->delete();

        return to_route('admin.master.payment-type.index')->with('success-toast', 'Payment Type Successfully Deleted');
    }
}

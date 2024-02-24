<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MonthlyController extends Controller
{
    private function checkCustomer($id)
    {
        $customer = \App\Models\Customers::where('hashed_id',$id)->first();
        if (!$customer)
            return redirect()->back()->with($this->sendAlert('error', 'Hata', 'Müşteri bulunamadı')
            );
        return $customer;
    }
    public function index(Request $request,$customerID)
    {
        $customer = $this->checkCustomer($customerID);
        $month = $request->has('month') ? $request->month : $customer->current_month;
        $records = \App\Models\Monthly::where('customer_id',$customerID)
            ->where('created_at','>=', date('Y').'-'.$month.'-01 00:00:00')
            ->get();
        return view('customers.monthly.index', compact('records','customer'));
    }

    public function store(Request $request,$id)
    {
        $user = new \App\Models\Monthly();
        $user->name = $request->name;
        $user->customer_id = $id;
        $user->count = $request->count;
        $user->price = $request->price;
        $user->total_amount = $request->count * $request->price;

        if ($request->filled('created_at'))
            $user->created_at = $request->created_at;

        $user->save();
        return redirect()->route('customers.monthly.index', $id)->with($this->sendAlert('success', 'Başarılı', 'Aylık kaydı başarıyla oluşturuldu'));
    }

    public function edit($customerID,$id)
    {
        $customer = $this->checkCustomer($customerID);
        $record = \App\Models\Monthly::find($id);
        if (!$record)
            return redirect()->back()->with($this->sendAlert('danger', 'Hata', 'Kayıt bulunamadı')
            );

        return view('customers.monthly.edit', compact('record','customer'));
    }

    public function create($customerID)
    {
        $customer = $this->checkCustomer($customerID);

        return view('customers.monthly.edit', compact('customer'));
    }

    public function update(Request $request, $customerID,$id)
    {
        $customer = $this->checkCustomer($customerID);
        $user = \App\Models\Monthly::find($id);
        if (!$user)
            return redirect()->back()->with($this->sendAlert('danger', 'Hata', 'Kayıt bulunamadı')
            );

        $user->name = $request->name;
        $user->count = $request->count;
        $user->price = $request->price;
        $user->total_amount = $request->count * $request->price;

        if ($request->has('created_at') && $request->created_at != $user->created_at)
            $user->created_at = $request->created_at;

        $user->save();
        return redirect()->back()->with($this->sendAlert('success', 'Başarılı', 'Aylık kaydı başarıyla güncellendi'));
    }

    public function delete($customerID,$id)
    {
        $customer = $this->checkCustomer($customerID);
        $user = \App\Models\Monthly::find($id);
        $user->delete();
        return redirect()->back()->with($this->sendAlert('success', 'Başarılı', 'Aylık kaydı başarıyla silindi'));
    }
}

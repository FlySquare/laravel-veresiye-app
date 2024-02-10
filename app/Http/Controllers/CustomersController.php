<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = \App\Models\Customers::all();
        return view('customers.index', compact('customers'));
    }

    public function store(Request $request)
    {
        $user = new \App\Models\Customers();
        $user->name = $request->name;
        $user->hashed_id = md5($request->name . time());
        $user->slug = Str::slug($request->name);
        $user->telephone = $request->telephone;
        $user->address = $request->address;
        $user->current_month = $request->current_month;
        $user->save();
        return redirect()->route('customers.index')->with($this->sendAlert('success', 'Başarılı', 'Müşteri başarıyla oluşturuldu'));
    }

    public function edit($id)
    {
        $customer = \App\Models\Customers::where('hashed_id',$id)->first();
        if (!$customer)
            return redirect()->back()->with($this->sendAlert('danger', 'Hata', 'Müşteri bulunamadı')
            );

        return view('customers.edit', compact('customer'));
    }

    public function create()
    {
        return view('customers.edit');
    }

    public function update(Request $request, $id)
    {
        $user = \App\Models\Customers::where('hashed_id',$id)->first();
        if (!$user)
            return redirect()->back()->with($this->sendAlert('danger', 'Hata', 'Müşteri bulunamadı')
            );

        $user->name = $request->name;
        $user->telephone = $request->telephone;
        $user->address = $request->address;
        $user->current_month = $request->current_month;
        $user->save();
        return redirect()->back()->with($this->sendAlert('success', 'Başarılı', 'Müşteri başarıyla güncellendi'));
    }

    public function delete($id)
    {
        $user = \App\Models\Customers::where('hashed_id',$id)->first();
        if (!$user)
            return redirect()->back()->with($this->sendAlert('danger', 'Hata', 'Müşteri bulunamadı')
            );

        $user->delete();
        return redirect()->back()->with($this->sendAlert('success', 'Başarılı', 'Müşteri başarıyla silindi'));
    }
}

@extends('layout.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            @if(isset($group))
                                <h3 class="card-title">Müşteri Düzenliyorusunuz</h3>
                            @else
                                <h3 class="card-title">Müşteri Ekliyorsunuz</h3>
                            @endif
                        </div>
                        <form method="post" action="@if(isset($customer)) {{route('customers.update', $customer->hashed_id)}} @else {{ route('customers.store') }} @endif">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Name">İsim <small class="requiredStar">(zorunlu)</small></label>
                                            <input type="text" @if(isset($customer)) value="{{ $customer->name }}" @endif class="form-control" id="Name" name="name" placeholder="İsim">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="telephone">Telefon <small class="requiredStar">(zorunlu)</small></label>
                                            <input type="text" @if(isset($customer)) value="{{ $customer->telephone }}" @endif class="form-control" id="telephone" name="telephone" placeholder="Telefon">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="address">Adres <small class="requiredStar">(zorunlu)</small></label>
                                            <input type="text" @if(isset($customer)) value="{{ $customer->address }}" @endif class="form-control" id="address" name="address" placeholder="İsim">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="current_month">Müşteride Gözükecek Hesap Ayı <small class="requiredStar">(zorunlu)</small></label>
                                            <select class="form-control" name="current_month">
                                                @for($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i < 10 ? '0'.$i : $i }}" @if(isset($customer) && $customer->current_month == $i) selected @endif>{{ $i < 10 ? '0'.$i : $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    @if(isset($customer))
                                       Müşteriyi Güncelle
                                    @else
                                       Müşteriyi Ekle
                                    @endif
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layout.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            @if(isset($record))
                                <h3 class="card-title">Aylık adisyonu düzenliyorsunuz</h3>
                            @else
                                <h3 class="card-title">Yeni aylık adisyon oluşturuyorsunuz</h3>
                            @endif
                        </div>
                        <form method="post" action="@if(isset($record)) {{route('customers.monthly.update', [$customer->hashed_id,$record->id])}} @else {{ route('customers.monthly.store', $customer->hashed_id) }} @endif">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="Name">Ürün İsmi <small class="requiredStar">(zorunlu)</small></label>
                                            <input type="text" @if(isset($record)) value="{{ $record->name }}" @endif class="form-control" id="Name" name="name" placeholder="Ürün İsmi">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="count">Adet <small class="requiredStar">(zorunlu)</small></label>
                                            <input type="text" @if(isset($record)) value="{{ $record->count }}" @endif class="form-control" id="count" name="count" placeholder="Adet">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="price">Birim Fiyat <small class="requiredStar">(zorunlu)</small></label>
                                            <input type="text" @if(isset($record)) value="{{ $record->price }}" @endif class="form-control" id="price" name="price" placeholder="Birim Fiyat">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    @if(isset($record))
                                      Aylık Adisyon Kaydını Düzenle
                                    @else
                                        Aylık Adisyon Kaydını Oluştur
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

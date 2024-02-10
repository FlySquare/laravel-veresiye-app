@extends('layout.master')
@section('content')
    @push('css')
        <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    @endpush
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tüm müşterileri burada görebilirsiniz</h3>
                        </div>
                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-2">
                                        <a href="{{ route('customers.create') }}">
                                            <button type="button" class="btn btn-primary btn-block">
                                                <i class="fa fa-plus"></i>
                                                Yeni Müşteri Oluştur
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example2"
                                               class="table table-bordered table-hover dataTable dtr-inline"
                                               aria-describedby="example2_info">
                                            <thead>
                                            <tr>
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending">
                                                    ID
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending">
                                                    İsim
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Platform(s): activate to sort column ascending">
                                                    Telefon
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">
                                                    Adres
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending">Diğer
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($customers as $customer)
                                                <tr>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        #{{ $customer->id }}</td>
                                                    <td>{{ $customer->name }}</td>
                                                    <td>{{ $customer->telephone }}</td>
                                                    <td>{{ $customer->address }}</td>
                                                    <td>
                                                        <a target="_blank" href="{{ route('slug', $customer->slug) }}"
                                                           class="btn bg-warning">
                                                            <i class="fas fa-user"></i>
                                                        </a>
                                                        <a href="{{ route('customers.monthly.index', [$customer->hashed_id,'month'=>$customer->current_month]) }}"
                                                           class="btn bg-purple">
                                                            <i class="fas fa-chart-area"></i>
                                                        </a>
                                                        <a href="{{ route('customers.edit', $customer->hashed_id) }}"
                                                           class="btn bg-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('customers.delete', ['id' => $customer->hashed_id]) }}"
                                                           class="btn bg-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">ID</th>
                                                <th rowspan="1" colspan="1"> İsim</th>
                                                <th rowspan="1" colspan="1">Telefon</th>
                                                <th rowspan="1" colspan="1">Adres</th>
                                                <th rowspan="1" colspan="1">Diğer</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')

        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
        <script>
            $(function () {
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": false,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/@if(app()->getLocale() == 'de'){{'German'}}@elseif(app()->getLocale() == 'tr'){{'Turkish'}}@elseif(app()->getLocale() == 'en'){{'English'}}@endif.json"
                    }
                });
            });
        </script>
    @endpush
@endsection

@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Orders
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/vendors/datatables/extensions/Responsive/css/responsive.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/select2/select2-bootstrap.min.css') }}"/>
    <!-- end of page level css-->
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
    <!--section starts-->
    <h1>Orders List</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
                Dashboard
            </a>
        </li>
        <li class="active">Visas</li>
    </ol>
</section>
<!--section ends-->
<section class="content">
    <div class="row">
        <div class="col-md-12">
             <div class="panel panel-primary ">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="orders-table-d">
                        <thead>
                            <tr class="filters">
                                <th>ID</th>
                                <th>Payment</th>
                                <th>User</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
     <script src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script>
     $(document).ready(function() {
        $('#orders-table-d').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ action("OrdersController@datatables") }}' ,
            columns: [
                {data: 'id', name: 'id'},
                {data: 'cart_id', name: 'payment'},
                {data: 'user_id', name: 'user'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
    </script>
@stop

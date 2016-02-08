@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Countries Data
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/vendors/datatables/extensions/Responsive/css/responsive.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
    <!-- end of page level css-->
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
    <!--section starts-->
    <h1>Countries Data</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
                Dashboard
            </a>
        </li>        
        <li class="active">Countries Data</li>
    </ol>
</section>
<!--section ends-->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Countries
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th>Name</th>
                                <th>Full Name</th>
                                <th>Capital</th>
                                <th>Currency</th>
                                <th>Currency Symbol</th>
                                <th>Popular</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($countries as $id => $country)                                
                                <tr>
                                    <td>{{$country->name}}</td>
                                    <td>{{$country->full_name}}</td>
                                    <td>{{$country->capital}}</td>
                                    <td>-{{$country->currency}}</td>
                                    <td>-{{$country->currency_symbol}}</td>
                                    <td>-<input type="checkbox" name="popular-{{$country->id}}">{{$country->popular}}</td>
                                </tr>                            
                                @endforeach                            
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->            
        </div>
    </div>
</section>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/table-responsive.js') }}"></script>
@stop
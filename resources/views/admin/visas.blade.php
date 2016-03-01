@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Visas Data
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
    <h1>Visas Data</h1>
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
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box panel-primary">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left">
                        <i class="livicon" data-name="medal" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
                        >@lang('visas/title.visaslist')
                    </h4>
                    <div class="pull-right">
                    <a href="#myModal" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Service</th>
                                <th>Country</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($visas as $visa)

                                <tr>
                                    <td>{{$visa->name}}</td>
                                    <td class="truncate">{{$visa->description}}</td>
                                    <td>{{$visa->Service[0]->name}}</td>
                                    <td>{{$visa->Service[0]->Country->name}}</td>
                                    <td>{{$visa->Service[0]->pivot->price}}</td>
                                    <td>
                                        <a href="{{ action('VisasController@show',['id'=>$visa->id])  }}">
                                            <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit visa"></i>
                                        </a>

                                        <a href="#" data-toggle="modal" data-target="#delete_confirm">
                                            <i class="livicon" data-name="remove-alt" data-size="18"
                                               data-loop="true" data-c="#f56954" data-hc="#f56954"
                                               title="delete visa"></i>
                                        </a>
                                    </td>
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
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create Visa</h4>
      </div>
      <div class="modal-body">
        <form id="form-add-visa"  class="form-horizontal" action="{{ action('VisasController@create') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="form-body">
                <div class="form-group">
                    <label for="name" class="col-md-3 control-label">
                        Name
                    </label>
                    <div class="col-md-9">
                            <input type="text" id="name"  name="name" placeholder="Name visa" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-md-3 control-label">
                        Description
                    </label>
                    <div class="col-md-9">
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-md-3 control-label">
                        Price
                    </label>
                    <div class="col-md-9">
                            <input type="text"  id="price" name="price" placeholder="Price visa" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Select country:</label>
                    <div class="col-md-9">
                        <select data-placeholder="Choose a country"  data-href="{{ action('ServicesController@countries',["country"=>"#value#"]) }}" id="country" name="country" style="width:100%" class="form-control select2">
                            <option>Choose a country</option>
                            @foreach($countries as $country)
                            <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Service:</label>
                  <div class="col-md-9">
                      <select id="service" name="service" class="form-control">
                          <option value="">Service list</option>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-9">Requirements</label>
                    <div class="col-md-9">
                        <ul>
                         @foreach($requirements as $req)
                            <li><input type="checkbox" name="requirements[]" value="{{$req->id}}">{{$req->title}}</li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="visa-save-change" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/table-responsive.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.full.js') }}"></script>
    <script src="{{ asset('assets/js/visa.js') }}"></script>
@stop

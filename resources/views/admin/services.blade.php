@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Services Data
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
    <h1>Services</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
                Dashboard
            </a>
        </li>        
        <li class="active">Services</li>
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
                        Services
                    </div>
                     <div class="pull-right">
                        <a href="#myModal" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th>Name</th>
                                <th>Country</th>
                                <th>Min. Processing</th>
                                <th>Max. Processing</th>
                                <th> &nbsp; </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $id => $service)
                                <tr>
                                    <td>{{$service->name}}</td>
                                    <td>{{$service->country}}</td>
                                    <td>{{$service->min_process}}</td>
                                    <td>{{$service->max_process}}</td>
                                    <td>  
                                        <a data-id="{{ $service->id }}" class="edit-service" href="#">
                                            <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit service"></i>
                                        </a>                                        
                                        <a  data-id="{{ $service->id }}" class="delete-service" data-nb="{{$service->nbProduct() }}" href="#">
                                            <i class="livicon" data-name="remove-alt" data-size="18"  data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete service"></i>
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
        <h4 class="modal-title" id="myModalLabel">Create Service</h4>
      </div>
      <div class="modal-body">
        <form id="form-add-service"  class="form-horizontal" action="{{ action('ServicesController@store') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="form-body">
                <div class="form-group">
                    <label for="name" class="col-md-3 control-label">
                        Name
                    </label>
                    <div class="col-md-9">
                        <input type="text" id="name"  name="name" placeholder="Service name" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Select country:</label>
                    <div class="col-md-9">
                        <select data-placeholder="Choose a country"  id="country" name="country" style="width:100%" class="form-control select2">
                            <option>Choose a country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-md-3 control-label">
                        Min process
                    </label>
                    <div class="col-md-9">
                            <input type="number"  id="min" name="min" placeholder="Min process" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-md-3 control-label">
                        Max process
                    </label>
                    <div class="col-md-9">
                            <input type="number"  id="Max process" name="max" placeholder="Max process" class="form-control"/>
                    </div>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="save-service" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- modal delete service -->
<div class="modal fade" id="modal-delete" role="dialog">
  <div class="modal-dialog" role="document">
    <form method="POST" action="{{ action('ServicesController@delete') }}" class="modal-content">
        <input type="hidden" name="id"/>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Delete Service</h4>
        </div>
        <div class="modal-body">          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" id="btn-delete-service" class="btn btn-danger">Delete</button>
        </div>
    </form>
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
    
    <script>
           $(document).ready(function(){
                $('.select2').select2(); 
              
                $('#form-add-service').validate({
                    errorPlacement: function (error, element) {
                        element.before(error);
                    },
                    rules: {
                        name : {
                            required:true
                        },
                        country : {
                          required:true,
                        }
                    },
                    messages: {

                    }
                });
              
           });
           $(document).on("click","#save-service",function(){
                $('#form-add-service').submit();
           });
           $(document).on('click','.delete-service',function(){
                var id = $(this).attr("data-id");
                var nb = $(this).attr("data-nb");
                
                if(parseInt(nb)>0){
                    var texte = "You can't delete this service because this have "+nb+" products " ;
                    $('#btn-delete-service').hide();
                }else{
                    var texte = "Are you sure ?" ;
                    $('#btn-delete-service').attr("data-id",id);
                    $('#btn-delete-service').show();
                }
                
                $('#modal-delete').find('.modal-body').html(texte);
                $('#modal-delete').modal("show");
           });
           $(document).on('click','#btn-delete-service',function(){
               var id = $(this).attr("data-id");
               var href = "" ;
           });
    </script>
@stop
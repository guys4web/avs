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
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        List of products : {{ $visa->name }}
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th>&nbsp;</th>
                                <th>Service</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($visa->products as $product)
                              <tr>
                                  <td>
                                      <a title="Edit price" data-id="{{ $product->id }}" data-value="{{ $product->price }}" class="edit-product-price"  href="#">
                                          <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA"></i>
                                      </a>
                                      <a href="#" class="delete-product-price" data-id="{{ $product->id }}" data-value="{{ $product->nbCartItem() }}">
                                           <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete product"></i>
                                      </a>
                                  </td>
                                  <td class="info-service" data-service="{{ $product->service->id }}" data-price="{{ $product->price }}" data-country="{{ $product->service->country_id }}">{{ $product->service->name }}</td>
                                  <td>{{ $product->price }}</td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <a href="#myModal" data-toggle="modal" data-target="#myModal" class="btn btn-labeled btn-success">
                  <span class="btn-label">
                          <i class="glyphicon glyphicon-plus"></i>
                  </span>
                  Attach a new service/product to this visa
            </a>
            <a href="#visaName" data-toggle="modal" data-target="#visaName" class="btn btn-labeled btn-success">
                  <span class="btn-label">
                          <i class="glyphicon glyphicon-pencil"></i>
                  </span>
                  Edit visa name
            </a>
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
        <h4 class="modal-title" id="myModalLabel">Create a Product</h4>
      </div>
      <div class="modal-body">
        <form id="form-add-visa"  class="form-horizontal" action="{{ action('VisasController@update',['id'=>$visa->id]) }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="form-body">
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


<div class="modal fade" id="visaName" role="dialog">
  <div class="modal-dialog" role="document">
   <form id="form-add-visa"  class="modal-content" action="{{ action('VisasController@edit',['id'=>$visa->id]) }}" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit visa name / description</h4>
      </div>
      <div class="modal-body">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="form-body">
                <div class="form-group">
                    <label>
                        Name
                    </label>
                    <input type="text"  id="name" name="name" value="{{ $visa->name }}" placeholder="Visa name" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea  class="form-control" name="description">{{ $visa->description }}</textarea>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="visa-name-change" class="btn btn-primary">Save changes</button>
      </div>
    </form>
  </div>
</div>


<div class="modal fade" id="model_price" role="dialog">
  <div class="modal-dialog" role="document">
   <form class="modal-content" action="{{ action('VisasController@price') }}" method="POST">
       <input type="hidden" name="id" />
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit product price</h4>
      </div>
      <div class="modal-body">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="form-body">
                <div class="form-group">
                    <label>
                        Price
                    </label>
                    <input type="text" name="price" value="" placeholder="Product price" class="form-control" required/>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
  </div>
</div>


<div class="modal fade" id="model_delete" role="dialog">
  <div class="modal-dialog" role="document">
   <form class="modal-content" action="{{ action('VisasController@delete') }}" method="POST">
       <input type="hidden" name="id" />
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete product</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
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
    <script src="{{ asset('assets/js/visa.js') }}"></script>
    <script>
          $(document).on('change','#service',function(){
              var val = $(this).val();
              $('.info-service').each(function(i,e){
                  if($(e).attr("data-service")==val){
                      $('#price').val($(e).attr("data-price"));
                      $('#visa-save-change').html("Update Products");
                  }
              });
          });
          $(document).ready(function(){
                $('#myModal').on('hidden.bs.modal', function (e) {
                    $('#price').val("");
                    $('#country').find("option").removeAttr("selected");
                    $('#country').find("option[val='']").attr("selected","selected");
                    $('#service').html("<option value=''>Service list</option>");
                    $('#visa-save-change').html("Save changes");
                });


          });
          $(document).on('click','.edit-product-price',function(){
                var id = $(this).attr("data-id");
                var price = $(this).attr("data-value");
                
                $('#model_price').find('input[name="id"]').val(id);
                $('#model_price').find('input[name="price"]').val(price);
                
                $('#model_price').modal("show");
          });
          $(document).on('click','.delete-product-price',function(){
                var id = $(this).attr("data-id");
                var nb = $(this).attr("data-value");
                $('#model_delete').find('input[name="id"]').val(id);
                if(parseInt(nb)>0){
                    $('#model_delete').find("button[type='submit']").hide();
                    var text = "Can't delete this product , because have "+nb+" items cart " ;
                }else{
                    $('#model_delete').find("button[type='submit']").show();
                    var text = "Are you sure ?" ;
                }
                $('#model_delete').find('.modal-body').html(text);
                $('#model_delete').modal("show");
          });        
    </script>
@stop

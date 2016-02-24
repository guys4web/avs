@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
document
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Documents</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>documents</li>
        <li class="active">documents</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    document {{ $document->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $document->id }}</td></tr>
                     <tr><td>title</td><td>{{ $document['title'] }}</td></tr>
					<tr><td>package_id</td><td>{{ $document['package_id'] }}</td></tr>
					<tr><td>passenger_id</td><td>{{ $document['passenger_id'] }}</td></tr>
					<tr><td>doc_id</td><td>{{ $document['doc_id'] }}</td></tr>
					<tr><td>exp_date</td><td>{{ $document['exp_date'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop
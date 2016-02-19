@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
agent
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Agents</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>agents</li>
        <li class="active">agents</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    agent {{ $agent->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $agent->id }}</td></tr>
                     <tr><td>first_name</td><td>{{ $agent['first_name'] }}</td></tr>
					<tr><td>last_name</td><td>{{ $agent['last_name'] }}</td></tr>
					<tr><td>mobile_phone</td><td>{{ $agent['mobile_phone'] }}</td></tr>
					<tr><td>office_phone</td><td>{{ $agent['office_phone'] }}</td></tr>
					<tr><td>email</td><td>{{ $agent['email'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop
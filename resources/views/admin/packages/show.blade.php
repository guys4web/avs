@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
package
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Packages</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>packages</li>
        <li class="active">packages</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    package {{ $package->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $package->id }}</td></tr>
                     <tr><td>passenger_name</td><td>{{ $package['passenger_name'] }}</td></tr>
					<tr><td>carrier</td><td>{{ $package['carrier'] }}</td></tr>
					<tr><td>tracking_num</td><td>{{ $package['tracking_num'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop
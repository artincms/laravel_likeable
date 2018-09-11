@extends('laravel_likeable_system::backend.layouts.master')
@section('page_title')
    Laravel Tag Manager
@stop
@section('custom_plugin_js')
@endsection
@section('content')
<div class="container-fluid">
    <div class="col-sm-12">
        <div class="col-xs-12 tag_manager_parrent_div">
            <table id="LikeManagerGridData" class="table " width="100%"></table>
        </div>
    </div>
</div>

@endsection
@section('inline_js')
    @include('laravel_likeable_system::backend.helper.inline_js')
@stop
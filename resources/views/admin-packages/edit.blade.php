@extends('layouts.admin')
@section('title', 'Edit Package')
@section('content')<div class="card card-premium"><div class="card-header bg-white border-0 pt-4"><h5>Edit Health Package</h5></div><div class="card-body">@include('admin-packages.form', compact('package', 'tests', 'selectedTests'))</div></div>@endsection

@extends('layouts.admin')
@section('title', 'Add Package')
@section('content')<div class="card card-premium"><div class="card-header bg-white border-0 pt-4"><h5>Add Health Package</h5></div><div class="card-body">@include('admin-packages.form', ['package' => null, 'selectedTests' => []])</div></div>@endsection

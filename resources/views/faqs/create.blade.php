@extends('layouts.admin')
@section('title', 'Add FAQ')
@section('content')<div class="card card-premium"><div class="card-header bg-white border-0 pt-4"><h5>Add FAQ</h5></div><div class="card-body">@include('faqs.form', ['faq' => null])</div></div>@endsection

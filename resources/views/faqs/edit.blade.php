@extends('layouts.admin')
@section('title', 'Edit FAQ')
@section('content')<div class="card card-premium"><div class="card-header bg-white border-0 pt-4"><h5>Edit FAQ</h5></div><div class="card-body">@include('faqs.form', compact('faq'))</div></div>@endsection

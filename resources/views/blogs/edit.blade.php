@extends('layouts.admin')

@section('title', 'Edit Blog')

@section('content')
<div class="card card-premium"><div class="card-header bg-white border-bottom-0 pt-4"><h5 class="mb-0">Edit Blog Article</h5></div><div class="card-body">
    @include('blogs.form', compact('blog'))
</div></div>
@endsection

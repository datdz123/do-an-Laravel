@extends('back/layouts/masterlayout')
@section('content')
@section('title', 'Quản lý files')
<section class="content">
        <iframe src="/laravel-filemanager?type=Images" style="width: 100%; height: 100vh; overflow: hidden; border: none;"></iframe>
</section>
@endsection

@extends('frontend.layout.master')
@section('header-title','Profile')
@section('content')
    <div id="root"></div>
@endsection
@section('script')
    <script src="{{ mix('react/profile.js') }}"></script>
@endsection
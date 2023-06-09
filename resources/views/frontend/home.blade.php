@extends('frontend.layout.master')
@section('content')
   <div id="root"></div>
@endsection
@section('script')
    <script src="{{mix('react/home.js')}}"></script>
@endsection
@extends('layouts.app') 
@section('head')
    <link href="{{ asset('module/news/css/news.css') }}" rel="stylesheet"> 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/daterange/daterangepicker.css") }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/fotorama/fotorama.css") }}" />
@endsection
@section('content')
<div class="bravo-news">
    @php
        $title_page = setting_item("news_page_list_title");
        if(!empty($custom_title_page)){
            $title_page = $custom_title_page;
        }
    @endphp
    @if(!empty($title_page))
        <div class="bravo_banner" @if($bg = setting_item("news_page_list_banner")) style="background-image: url({{get_file_url($bg,'full')}})" @endif >
            <div class="container">
                <h1>
                    {{ $title_page }}
                </h1>
            </div>
        </div>
    @endif
    @include('News::frontend.layouts.details.news-breadcrumb')
    <div class="bravo_content">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    @include('News::frontend.layouts.details.news-detail')
                </div>
                <div class="col-md-3">
                    @include('News::frontend.layouts.details.news-sidebar')
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection

 
  
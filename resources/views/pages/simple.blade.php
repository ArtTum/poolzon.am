@extends('layouts.main')

@section('content')
    <style>
        .text-box ul{
            list-style: inside;
        }
    </style>
<div class="page-container__inner simple-page bg-light">
    <div class="top-bg top-bg--top margin-bottom-large" style="background-image: url('/images/top-bg.png')">
        <div class="inner-container">
            <h1 class="title--primary font-large-xs font-primary--medium margin-bottom-medium-lg">
                {{ \App\Http\Helpers\Translate::text($page->lang(), 'page_name') }}
            </h1>
            <div class="text-box">
                {!! \App\Http\Helpers\Translate::text($page->lang(), 'page_description') !!}
            </div>
        </div>
    </div>

</div>
@endsection

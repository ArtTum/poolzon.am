@extends('layouts.main')
@section('step', 'none')
@section('content')
<div id="stepOne" class="tab-content">
    @include('pages.order.step-one')
</div>
<div id="stepTwo" class="tab-content">
    @include('pages.order.step-two')
</div>
<div id="stepThree" class="tab-content">
    @include('pages.order.step-three')
</div>

<div class="tab flex max-width-large">
    <span class="tab-links" onclick="openTab(event, 'stepOne')" id="defaultOpen"></span>
    <span class="tab-links" onclick="openTab(event, 'stepTwo')" ></span>
    <span class="tab-links" onclick="openTab(event, 'stepThree')"></span>
</div>

@endsection

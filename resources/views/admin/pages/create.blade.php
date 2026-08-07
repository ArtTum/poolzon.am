<?php
/**
 * Created by PhpStorm.
 * User: artur999
 * Date: 1/28/2019
 * Time: 12:58 AM
 */
?>

@extends('admin.layouts.main')
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endsection

@extends('layouts.app')

@section('content')
    @if(count(\Cart::getContent()) > 0)
        @foreach(\Cart::getContent() as $item)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-lg-3">
                        <img src="/images/{{ $item->attributes->image }}"
                             style="width: 50px; height: 50px;"
                        >
                    </div>
                    <div class="col-lg-6">
                        <b>{{$item->name}}</b>
                        <br><small>Qty: {{$item->quantity}}</small>
                    </div>
                    <div class="col-lg-3">
                        <p>${{ \Cart::get($item->id)->getPriceSum() }}</p>
                    </div>
                    <hr>
                </div>
            </li>
        @endforeach
        <br>
        <li class="list-group-item">
            <div class="row">
                <div class="col-lg-10">
                    <b>Total: </b>${{ \Cart::getTotal() }}
                </div>
                <div class="col-lg-2">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </li>
        <br>
        <div class="row" style="margin: 0px;">
            <a class="btn btn-dark btn-sm btn-block" href="{{ route('cart.index') }}">
                CART <i class="fa fa-arrow-right"></i>
            </a>
            <a class="btn btn-dark btn-sm btn-block" href="">
                CHECKOUT <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    @else
        <li class="list-group-item">Your Cart is Empty</li>
    @endif
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ '/' }}">
                E-COMMERCE STORE
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop') }}">SHOP</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle"
                           href="#" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false"
                        >
                        <span class="badge badge-pill badge-dark">
                            <i class="fa fa-shopping-cart"></i> {{ \Cart::getTotalQuantity()}}
                        </span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="width: 450px; padding: 0px; border-color: #9DA0A2">
                            <ul class="list-group" style="margin: 20px;">
                                @include('partials.cart-drop')
                            </ul>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 80px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shop</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-7">
                        <h4>Products In Our Store</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-lg-3">
                            <div class="card" style="margin-bottom: 20px; height: auto;">
                                <img src="{{ '/uploads/products/'.$product->product_image }}"
                                     class="card-img-top mx-auto"
                                     style="height: 150px; width: 150px;display: block;"
                                     alt="{{ '/uploads/products/'.$product->product_image }}"
                                >
                                <div class="card-body">
                                    <a href=""><h6 class="card-title">{{ $product->name }}</h6></a>
                                    <p>${{ $product->price }}</p>
                                    <form action="/add" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $product->id }}" id="id" name="id">
                                        <input type="hidden" value="{{ \App\Http\Helpers\Translate::text($product->lang(), 'product_name') }}" id="name" name="name">
                                        <input type="hidden" value="{{ $product->price }}" id="price" name="price">
                                        <input type="hidden" value="{{ '/uploads/products/'.$product->product_image }}" id="img" name="img">
                                        <input type="hidden" value="category" id="slug" name="slug">
                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                        <div class="card-footer" style="background-color: white;">
                                            <div class="row">
                                                <button class="btn btn-secondary btn-sm" class="tooltip-test" title="add to cart">
                                                    <i class="fa fa-shopping-cart"></i> add to cart
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

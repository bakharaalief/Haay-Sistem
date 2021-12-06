@extends('layouts.normal.app')

@section('content')
<div class="jumbotron">
    <div class="overlay"></div>
    <div class="inner">
        <h1 class="display-4">HAAYKA KITCHEN</h1>
        <p class="lead">Your Sweet Day Start From Your First Bite</p>
    </div>
</div>

<h1 class="text-center text-font font-weight-bold">Menu</h1>

<div class="menu-category container">
    @foreach ($dataFoodCategory as $foodCategory)
    <a class="menu-category-item" href="">
        <img 
            class="menu-category-item-cover" 
            src="https://wallpapershome.com/images/pages/pic_h/14961.jpg" alt="">
        <h1 class="menu-category-item-title">{{ $foodCategory->category}}</h1>
    </a>
    @endforeach
</div>



<h1 class="text-center text-font font-weight-bold pt-5">Tentang Kami</h1>

<div class="about-me container">
    <p class="about-me-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
        Iure voluptas reiciendis, mollitia fuga, earum suscipit consequuntur vero ratione nulla sunt quam, 
        maiores quis ab repudiandae magnam vel quos necessitatibus explicabo.
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
        Iure voluptas reiciendis, mollitia fuga, earum suscipit consequuntur vero ratione nulla sunt quam, 
        maiores quis ab repudiandae magnam vel quos necessitatibus explicabo.
    </p>

    <img class="about-me-image" src="https://www.delmontefoods.com/sites/default/files/2019-08/Locations2.jpg" alt="">
</div>
@endsection
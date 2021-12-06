@extends('layouts.normal.app')

@section('content')
<h1 class="text-center text-font font-weight-bold pt-4">Daftar Menu</h1>

<div class="menu-detail container">
    <div class="row">
        <div class="side-1 col-sm-2 mr-5">
            
            <h4>Category</h4>

            <div class="menu-detail-category">
                @foreach ($dataFoodCategory as $foodCategory)
                <a class="menu-detail-category-item" href="http://">{{ $foodCategory->category }}</a>
                @endforeach
            </div>

            <h4>Ukuran</h4>

            <div class="menu-detail-category">
                @foreach ($dataFoodSize as $foodSize)
                <a class="menu-detail-category-item" href="http://">{{ $foodSize->size }}</a>
                @endforeach
            </div>

            <h4>Type</h4>

            <div class="menu-detail-category">
                @foreach ($dataFoodType as $foodType)
                <a class="menu-detail-category-item" href="http://">{{ $foodType->type }}</a>
                @endforeach
            </div>

        </div>
        <div class="side-2 col-xl">
            @foreach ($dataFoodMenu as $foodMenu)
            <a href="{{ route('normal.menuDetail', ['id' => $foodMenu->id ])}}">
                <div class="menu-detail-item">
                    <img class="menu-detail-item-cover" src="https://upload.wikimedia.org/wikipedia/commons/0/04/Pound_layer_cake.jpg" alt="">

                    <div class="menu-detail-item-desc">
                        <h1 class="menu-detail-item-name">{{ $foodMenu->name }}</h1>
                        <h1 class="menu-detail-item-category">{{ $foodMenu->getCategory->category }}</h1>
                        <h1 class="menu-detail-item-size">{{ $foodMenu->getSize->size }}</h1> 

                        <div class="menu-detail-item-type">
                            @if (count($foodMenu->getFoodType) > 0)
                                @foreach ($foodMenu->getFoodType as $foodType)
                                <div class="type">
                                    <p>{{ $foodType->type }}</p>
                                </div>           
                                @endforeach         
                            @else
                            <div class="type">
                                <p>None</p>
                            </div>   
                            @endif
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
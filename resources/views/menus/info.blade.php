@extends('layouts.app')
@section('content')

<div class="ripple-background">
   
<div class="card mt-4">
    
    <div class="card-header">Restorano ir dienos patiekalo detalės:</div>
    <div class="card-body">
        <h3>Pagrindinis patiekalas:  {{ $menu->title }} | <span style="font-size: 1rem">Pasiūlymai: {{ count($menu->restaurants) }}</span></h3>
        <table class="table redTable">
            <thead>
                <tr>
                    <th>Kaina eur: </th>
                    <th>Porcijos svoris g: </th>
                    <th>Mėsos kiekis porcijoje g:  </th>
                    <th>Aprašymas:   </th>
                </tr>
            </thead>
            {{-- @foreach ($menus as $menu) --}}
            <tr>
                <td>{{ $menu->price }}</td>
                <td>{{ $menu->weight }}</td>
                <td>{{ $menu->meat }}</td>
                <td>{!! $menu->about !!}</td>
            </tr>
            {{-- @endforeach --}}
        </table>
        <h4>Šį menu jums gali pasiūlyti:</h4>
        <hr>
        @foreach ($restaurants as $restaurant)
        <h5>Restorano pavadinimas: {{ $restaurant->title }} </h5>
        <h6>Žmonių kiekis, telpantis restorane: {{ $restaurant->customers }}</h6>
        <h6>Darbuotojų kiekis:  {{ $restaurant->employees }}</h6>
        <hr>
        {{-- <h5>Pagrindinis patiekalas:  {{ $restaurant->menu->title }}</h5>
        <h6>Kaina eur:  {{ $restaurant->menu->price }}</h6>
        <h6>Porcijos svoris g:  {{ $restaurant->menu->weight }}</h6>
        <h6>Mėsos kiekis porcijoje g:  {{ $restaurant->menu->meat }}</h6>
        <h6>Aprašymas:  {!! $restaurant->menu->about !!}</h6> --}}
        {{-- <h5>Lankytini miestai: ( {{ count($customer->country->towns) }} )</td></h5>  --}}
        @endforeach
    </div>
</div>
@endsection
        <div class="circle xxlarge shade1"></div>
        <div class="circle xlarge shade2"></div>
        <div class="circle large shade3"></div>
        <div class="circle mediun shade4"></div>
        <div class="circle small shade5"></div>
      </div>


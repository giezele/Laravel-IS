@extends('layouts.app')
@section('content')

<div class="ripple-background">

<div class="card mt-4">
    <div class="card-header">Restorano ir dienos patiekalo detalės:</div>
    <div class="card-body">
        <h4>Pavadinimas: {{ $restaurant->title }} </h4>
        <h5>Žmonių kiekis telpantis restorane: {{ $restaurant->customers }}</h5>
        <h5>Darbuotojų kiekis:  {{ $restaurant->employees }}</h5>
        <hr>
        {{-- <h5>Pagrindinis patiekalas:  {{ $restaurant->menu->title }}</h5>
        <h6>Kaina eur:  {{ $restaurant->menu->price }}</h6>
        <h6>Porcijos svoris g:  {{ $restaurant->menu->weight }}</h6>
        <h6>Mėsos kiekis porcijoje g:  {{ $restaurant->menu->meat }}</h6>
        <h6>Aprašymas:  {!! $restaurant->menu->about !!}</h6> --}}
        {{-- <h5>Lankytini miestai: ( {{ count($customer->country->towns) }} )</td></h5>  --}}
        <table class="table redTable">
            <thead>
                <tr>
                    <th>Pagrindinis patiekalas:  </th>
                    <th>Kaina eur: </th>
                    <th>Porcijos svoris g: </th>
                    <th>Mėsos kiekis porcijoje g:  </th>
                    <th>Aprašymas:   </th>
                </tr>
            </thead>
            <tbody>
            {{-- @foreach ($restaurant->menus as $menu) --}}
            <tr>
                <td>{{ $restaurant->menu->title }}</td>
                <td>{{ $restaurant->menu->price }}</td>
                <td>{{ $restaurant->menu->weight }}</td>
                <td>{{ $restaurant->menu->meat }}</td>
                <td>{!! $restaurant->menu->about !!}</td>
            </tr>
            {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
@endsection
<div class="circle xxlarge shade1"></div>
<div class="circle xlarge shade2"></div>
<div class="circle large shade3"></div>
<div class="circle mediun shade4"></div>
<div class="circle small shade5"></div>
</div>
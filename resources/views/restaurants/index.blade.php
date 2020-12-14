@extends('layouts.app')
@section('content')

 <div class="card mt-2">
         {{-- filtras  --}}
    <div class="card-header card-header-md">
        <div class="pull-left">
            <form class="form-inline" action="{{ route('restaurant.index') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-btn">
                        <select name="menu_id" id="" class="form-control">
                            <option value="" selected disabled>Pasirinkite menu filtravimui:</option>
                            @foreach ($menus as $menu)
                            <option value="{{ $menu->id }}" 
                                @if($menu->id == app('request')->input('menu_id')) 
                                    selected="selected" 
                                @endif>
                                {{ $menu->title }}
                            </option>
                            @endforeach
                        </select>
                    </span>
                    <span class="input-group-btn mb-4">
                        <button type="submit" class="btn btn-primary " title="Submit"><i class="fa fa-check"></i></button>
                        {{-- <button type="submit" class="btn btn-primary">Pasirinkti</button> --}}
                    </span>
                </div>
            </form>
        </div>
        {{-- searchas --}}
        <div class=" pull-right">
            <form action="{{ route('restaurant.index') }}" method="GET" role="search">
                <div class="input-group">
                    <a href="{{ route('restaurant.index') }}" >
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button" title="Refresh page">
                            <span class="fa fa-retweet"></span>
                        </button>
                    </span>
                    </a>
                    
                    <input type="text" class="form-control border-right-0 border" name="term" placeholder="Restorano paieška" id="term">

                    <span class="input-group-append">
                        <button class="btn bg-transparent border-left-0 border" type="submit" title="Search projects">
                            <span class="fa fa-search "></span>
                        </button>
                    </span>
                </div>
            </form>
        </div>


    </div>

     <div class="card-body">

        {{-- DB klaidu logika --}}    {{-- Database error/success display logic --}}
        @if (session('status_success'))
        <p style="color: green"><b>{{ session('status_success') }}</b></p>
        @else
        <p style="color: red"><b>{{ session('status_error') }}</b></p>
        @endif

        @if($errors->any())
        <h4 style="color: red">{{$errors->first()}}</h4>
        @endif

        <div class="table-responsive table-responsive-sm">
        <table class="table redTable">
            <thead>
                <tr>
                    <th>Pavadinimas</th>
                    <th>Klientai</th>
                    <th>Darbuotojai</th>
                    <th>Menu</th>
                    <th>Veiksmai</th>
                </tr>
            </thead>
            @foreach ($restaurants as $restaurant)
            <tr>
                <td>{{ $restaurant->title }}</td>
                <td>{{ $restaurant->customers }}</td>
                <td>{{ $restaurant->employees }}</td>
                <td>{{ $restaurant->menu->title }}</td>
                <td>
                    <form action={{ route('restaurant.destroy', $restaurant->id) }} method="POST">
                        <a class="btn btn-success" href={{ route('restaurant.edit', $restaurant->id) }} title="Update"><i class="fa fa-pencil"></i></a>
                        @csrf @method('delete')
                        <button class="btn btn-danger" type="submit" title="Delete">
                            <span class="fa fa-trash"></span>
                        </button>
                                  {{-- tik idejus uzkomentuoti'PERZIURETI' mygtuka --}}
                        <a href={{ route('restaurant.details', $restaurant->id) }} class="btn btn-primary" title="Details"><i class="fa fa-info-circle"></i></a>

                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div>
            <a href="{{ route('restaurant.create') }}" class="btn btn-success" title="Add new"><i class="fa fa-plus-square"></i> Pridėti</a>
        </div>
    </div>
 </div>
@endsection
 

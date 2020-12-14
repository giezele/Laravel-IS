@extends('layouts.app')
@section('content')

 <div class="card mt-2">

         {{-- filtras  --}}
         <div class="card-header card-header-md">
            <div class="pull-left">
                <form class="form-inline" action="{{ route('menu.index') }}" method="GET" role="filter">

                    <div class="input-group">
                        <span class="input-group-btn">
                            <select name="menu_id" id="" class="form-control">
                                <option value="" selected disabled>Pasirinkite restoraną filtravimui:</option>
                                @foreach ($restaurants as $restaurant)
                                <option value="{{ $restaurant->menu_id }}" 
                                    @if($restaurant->menu_id == app('request')->input('menu_id')) 
                                        selected="selected" 
                                    @endif>
                                    {{ $restaurant->title }} 
                                    
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
            <div class="pull-right">
                <form action="{{ route('menu.index') }}" method="GET" role="search">
    
                    <div class="input-group">
                        <a href="{{ route('menu.index') }}" >
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" title="Refresh page">
                                <span class="fa fa-retweet"></span>
                            </button>
                        </span>
                        </a>
                        
                        <input type="text" class="form-control border-right-0 border" name="term" placeholder="Menu paieška" id="term">
    
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

 
        <div class="table-responsive table-responsive-sm ">
            <table class="table redTable">
                <thead>
                <tr>
                    <th>Pavadinimas</th>
                    <th>Kaina</th>
                    <th>Svoris</th>
                    <th>Mėsos kiekis</th>
                    <th>Aprašymas</th>
                    <th>Veiksmai</th>
                </tr>
                </thead>
                @foreach ($menus as $menu)
                <tr>
                    {{-- | <span style="font-size: 10px">Miestai: {{ count($menu->restaurants) }}</span> --}}
                    <td>{{ $menu->title }} | <span style="font-size: 10px">Rest. kiekis: {{ count($menu->restaurants) }}</span></td>
                    <td>{{ $menu->price }}</td>
                    <td>{{ $menu->weight }}</td>
                    <td>{{ $menu->meat }}</td>
                    <td>{!! $menu->about !!}</td>
                    <td>
                        <form action={{ route('menu.destroy', $menu->id) }} method="POST">
                            <a class="btn btn-success" href={{ route('menu.edit', $menu->id) }} title="Update"><i class="fa fa-pencil"></i></a>
                            @csrf @method('delete')
                            <button class="btn btn-danger" type="submit" title="Delete">
                                <span class="fa fa-trash"></span>
                            </button>
                               {{-- tik idejus uzkomentuoti'PERZIURETI' mygtuka --}}
                            <a href={{ route('menu.info', $menu->id) }} class="btn btn-primary" title="Details"><i class="fa fa-info-circle"></i></a>

                        </form>
                    </td>

                </tr>
                @endforeach
            </table>
        </div>
        <div>
            <a href="{{ route('menu.create') }}" class="btn btn-success" title="Add new"><i class="fa fa-plus-square"></i> Pridėti</a>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('content')

<div class="container mt-2">
     <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pakeiskime menu informaciją</div>
                <div class="card-body">
                       
                        {{-- DB klaidu logika --}}    {{-- Database error/success display logic --}}
                    @if (session('status_success'))
                    <p style="color: green"><b>{{ session('status_success') }}</b></p>
                    @else
                    <p style="color: red"><b>{{ session('status_error') }}</b></p>
                    @endif


                    @if ($errors->any())
                    <div>
                        @foreach ($errors->all() as $error)
                            <p style="color: red">{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif 

                    <form method="POST" action="{{ route('menu.update', $menu->id) }}">
                        @csrf @method("PUT")
                        <div class="form-group">
                            <label for="">Pavadinimas</label>
                            <input type="text" name="title" class="form-control" value="{{ $menu->title }}">
                        </div>
                        <div class="form-group">
                            <label for="">Kaina</label>
                            <input type="number" name="price" class="form-control" value="{{ $menu->price }}">
                        </div>
                        <div class="form-group">
                            <label for="">Svoris</label>
                            <input type="number" name="weight" class="form-control" value="{{ $menu->weight }}">
                        </div>
                        <div class="form-group">
                            <label for="">Mėsos sv: </label>
                            <input type="number" name="meat" class="form-control" value="{{ $menu->meat }}">
                        </div>
                        <div class="form-group">
                            <label for="">Aprašymas:</label>
                            <textarea id="mce" type="text" name="about" rows=10 cols=100 class="form-control">{{ $menu->about }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Pakeisti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('content')

 <div class="container mt-2">
    <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Sukurkime menu:</div>
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

                   <form action="{{ route('menu.store') }}" method="POST">
                       @csrf
                       @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                       <div class="form-group">
                           <label>Pavadinimas: </label>
                           <input type="text" name="title" class="form-control">
                       </div>
                       <div class="form-group">
                           <label>Kaina: </label>
                           <input type="number" name="price" class="form-control"> 
                       </div>
                       <div class="form-group">
                            <label>Svoris: </label>
                            <input type="number" name="weight" class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label>Mėsos sv: </label>
                            <input type="number" name="meat" class="form-control"> 
                        </div>
                       <div class="form-group">
                           <label>Aprašymas: </label>
                           <textarea id="mce" name="about" rows=10 cols=100 class="form-control"></textarea>
                       </div>
                       <button type="submit" class="btn btn-primary">Prideti</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

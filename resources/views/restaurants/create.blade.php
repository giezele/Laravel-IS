@extends('layouts.app')
@section('content')

    
 <div class="container mt-2">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Įveskime restoraną:</div>
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
 
                   <form action="{{ route('restaurant.store') }}" method="POST">
                       @csrf
                       @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                       <div class="form-group">
                            <label for="">Pavadinimas: </label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Klientai: </label>
                            <input type="number" name="customers" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Darbuotojai: </label>
                            <input type="number" name="employees" class="form-control">
                        </div>
                       <div class="form-group">
                           <label>Menu: </label>
                           <select name="menu_id" id="" class="form-control">
                                <option value="" selected disabled>Pasirinkite menu</option>
                                @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                                @endforeach
                           </select>
                       </div>
                       <button type="submit" class="btn btn-primary">Pateikti</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
 

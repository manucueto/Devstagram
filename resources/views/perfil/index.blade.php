@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{auth()->user()->username}}

@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" action="{{route('perfil.store')}}" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{session('mensaje')}}</p>

                @endif
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-600">
                        Username
                    </label>
                    <input type="text" id="username" name="username" placeholder="Tu nombre de usuario" class="border p-3 w-full rounded-lg @error('username')
                        border-red-500
                    @enderror " value="{{auth()->user()->username}}">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-600">
                        E-mail
                    </label>
                    <input type="text" id="email" name="email" placeholder="Tu E-mail" class="border p-3 w-full rounded-lg @error('email')
                        border-red-500
                    @enderror " value="{{auth()->user()->email}}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                {{-- <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-600">
                        Actual Password
                    </label>
                    <input type="password" id="password" name="password" placeholder="Password actual"  class="border p-3 w-full rounded-lg @error('password')
                        border-red-500
                    @enderror ">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-600">
                        Nueva Password 
                    </label>
                    <input type="password" id="password_nueva" name="password_nueva" placeholder="Password nueva"  class="border p-3 w-full rounded-lg @error('password_nueva')
                        border-red-500
                    @enderror ">
                    @error('password_nueva')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div> --}}

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-600">
                        Imagen Perfil
                    </label>
                    <input type="file" id="imagen" name="imagen" class="border p-3 w-full rounded-lg " value="" accept="image/png, image/gif, image/jpeg" >
                    
                </div>

                <input type="submit" value="Guardar cambios" class="bg-sky-600 hover:bg-sky-700 transition colors cursor-pointer uppercase w-full p-3 text-white rounded-lg">
            </form>
        
        </div>
    </div>
@endsection
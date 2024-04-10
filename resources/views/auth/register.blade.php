@extends('layouts.app')

@section('titulo')
    Regístrate en Devstagram 
@endsection

@section('contenido')

    <div class="md:flex md:justify-center md:gap-10 md:items-center ">
        <div class="md:w-6/12 p-5">
            <img src="{{asset('img/registrar.jpg')}}" alt="imagen registro de usuarios">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{route('register')}}" method="POST" novalidate>
                @csrf <!-- el atributo action es para hacer referencia de que al enviarse el formulario va a ejecutar el metodo post de crear-cuenta-->
                
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-600">
                        Nombre
                    </label>
                    <input type="text" id="name" name="name" placeholder="Tu nombre" class="border p-3 w-full rounded-lg @error('name')
                        border-red-500
                    @enderror " value="{{old('name')}}">
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-600">
                        Username
                    </label>
                    <input type="text" id="username" name="username" placeholder="Tu nombre de usuario"  class="border p-3 w-full rounded-lg @error('username')
                        border-red-500
                    @enderror " value="{{old('username')}}">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-600">
                        Email
                    </label>
                    <input type="email" id="email" name="email" placeholder="Tu Email de registro"  class="border p-3 w-full rounded-lg @error('email')
                        border-red-500
                    @enderror " value="{{old('email')}}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-600">
                        Password
                    </label>
                    <input type="password" id="password" name="password" placeholder="Password de registro"  class="border p-3 w-full rounded-lg @error('password')
                        border-red-500
                    @enderror ">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-600">
                        Repetir Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite tu password"  class="border p-3 w-full rounded-lg">
                    {{-- @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror --}}
                </div>
                <input type="submit" value="Crear Cuenta" class="bg-sky-600 hover:bg-sky-700 transition colors cursor-pointer uppercase w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
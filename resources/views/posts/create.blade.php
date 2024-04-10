@extends('layouts.app')

@section('titulo')
    Crea una nueva publicación
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{route('imagenes.store')}}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rouded flex flex-col justify-center items-center">
            @csrf</form>
        </div>
        <div class="md:w-1/2 bg-white p-10 rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{route('posts.store')}}" method="POST" novalidate>
                @csrf <!-- el atributo action es para hacer referencia de que al enviarse el formulario va a ejecutar el metodo post de crear-cuenta-->
                
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-600">
                        Título
                    </label>
                    <input type="text" id="titulo" name="titulo" placeholder="Título de la publicación" class="border p-3 w-full rounded-lg @error('titulo')
                        border-red-500
                    @enderror " value="{{old('titulo')}}">
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-600">
                        Descripción
                    </label>
                    <textarea id="descripcion" name="descripcion" placeholder="Descripción de la publicación" class="border p-3 w-full rounded-lg @error('name')
                        border-red-500
                    @enderror " >{{old('descripcion')}}</textarea>
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input name="imagen" type="hidden" value="{{old('imagen')}}">
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <input type="submit" value="Crear Publicación" class="bg-sky-600 hover:bg-sky-700 transition colors cursor-pointer uppercase w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
@extends('layouts.main')

@section('title', 'Сокращение ссылок')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{route('form')}}" method="post">
        @csrf
        <div class="form-outline md-4">
            <input id="link" type="text" name="link" value="{{old('link')}}"/>
            <label for="link">Ваша ссылка</label>
        </div>
        <button type="submit">Отправить</button>

    </form>
@endsection

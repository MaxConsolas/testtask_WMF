<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Проверка ИНН</title>

        <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1>Проверка статуса налогоплательщика</h1>
                <p class="lead">Введите ИНН налогоплательщика, для которого<br/> будет осуществлена проверка статуса самозанятого</p>
                <form method="POST" action="{{ route('check') }}" class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                    @csrf
                    <div class="form-group @error ('inn') has-error @enderror">
                        <label class="control-label" for="inn">Проверяемый ИНН</label>
                        <input type="text" name="inn" class="form-control" placeholder="ИНН" value="{{ old('inn') ?? '' }}">
                        @error ('inn')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="form-group @error ('date') has-error @enderror">
                        <label class="control-label" for="date">Дата</label>
                        <input type="date" class="form-control" name="date" placeholder="Дата" value="{{ old('date') ?? '' }}">
                        @error ('date')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <button type="submit" class="btn btn-primary">Проверить</button>
                </form>
        </div>
        <div class="mt-5">
            @if(!empty(session()->get('denied')))
                <p class="bg-danger">{{ session()->get('denied') }}</p>
            @endif
            @if(!empty(session()->get('message')))
                <p class="bg-warning">{{ session()->get('message') }}</p>
            @endif
        </div>
        </div>
    </body>
</html>

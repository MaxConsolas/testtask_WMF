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
            <p class="lead">Введите ИНН налогоплательщика, а также дату <br/>для которой будет осуществлена проверка статуса самозанятого</p>
            <form method="POST" action="{{ route('check') }}" class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                @csrf
                <div class="form-group @error ('inn') has-error @enderror">
                    <label class="control-label" for="inn">Проверяемый ИНН</label>
                    <input type="text" name="inn" class="form-control" placeholder="ИНН">
                    @error ('inn')
                        <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group @error ('date') has-error @enderror">
                    <label class="control-label" for="date">Дата</label>
                    <input type="date" class="form-control" name="date" placeholder="Дата">
                    @error ('date')
                        <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Проверить</button>
            </form>
          </div>
        </div>
    </body>
</html>

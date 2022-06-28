<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<div class="container bgcont">

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="panel-body">
        {!! Form::open(['method'=>'POST', 'route' => 'link.create']) !!}
        {{ csrf_field() }}
        {!! Form::label('original_link', 'Enter link (2048 max):') !!}
        {!! Form::text('original_link', null, ['class' => 'form-control']) !!}

        {!! Form::label('visit_limit', 'Enter the visit limit (2147483647 max):') !!}
        {!! Form::number('visit_limit', null, ['class' => 'form-control']) !!}

        {!! Form::label('lifetime', 'Enter link lifetime (24 hours max):') !!}
        {!! Form::number('lifetime', null, ['class' => 'form-control']) !!}

        <div class="form-group mt-2">
            {!! Form::button('Уменьшить', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>

    <body>
        <h1>Xin chào {{ $mailData['name'] }} </h1>
        <h3>{{ $mailData['title'] }}</h3>    
        <h3>Lý do: {{ $mailData['body'] }} </h3>
        <p>Cảm ơn</p>
    </body>
</html>
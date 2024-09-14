<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>64 Backend</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .container {
            width: 100vw;
            height: 100svh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            flex-direction: column;
        }
        * {
            font-family: 'Roboto', sans-serif;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src={{ asset('assets/img/imago.png') }} width="30%" />
        <h2>64 Backend</h2>
        <h5>Status: <span style="color: lightgreen;">[OK 200]</span></h5>
        <h5 style="margin-top: -20px;">Powered by <a href="https://64train.com" style="color: lightsalmon;">64 Software Train</a></h5>
        <h5 style="margin-top: -20px;">Go to <a href="{{ env('APP_URL').'/docs/api' }}" style="color: lightsalmon;">API DOCUMENTATION</a></h5>
        <h5>v.0.0.1</h5>
    </div>
</body>

</html>

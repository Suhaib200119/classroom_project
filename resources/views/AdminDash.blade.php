<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            justify-items: center;
        }
    </style>
</head>

<body>
    <h1>Admin Dash</h1>
    <form class="nav-item" action="{{ route('logout', 'admin') }}" method="post">
        @csrf
        <button class="btn " style="wieth:100%;color:white" type="submit">logout</button>
    </form>
</body>

</html>

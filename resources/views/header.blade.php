<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/style.css">
    <title>ResMus</title>
</head>
<body class="pad">
    <header>
        <img href="" alt="">
        <nav>
            @guest
            <a class="logo" href="/">ResMus</a>
            <a class="but1" href="/">Главная</a>
            <a class="but1" href="/signin">Войти/Зарегистрироваться</a>
            @endguest

            @auth
            <a class="logo" href="/">ResMus</a>
            <a class="but1" href="/">Главная</a>
            <a class="but1" href="/lk">Личный кабинет</a>
            <a class="but1" href="/signout">Выйти</a>
            @endauth
        </nav>
    </header>


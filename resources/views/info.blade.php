<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            <?php
            switch (trim($_SERVER['REQUEST_URI'], '/')) {
                case 'about':
                    echo 'О компании';
                    break;
                case 'about/us':
                    echo 'О нас';
                    break;
                case 'contacts':
                    echo 'Контакты';
                    break;
                default:
                    echo '404';
            }
            ?>
        </div>

        <div class="links">
            <a href="/">Главная</a>
            <a href="/about/">О компании</a>
            <a href="/contacts/">Контакты</a>
        </div>

        <?php
        if (trim($_SERVER['REQUEST_URI'], '/') === 'about'): ?>
        <div class="links">
            <a href="/about/us/">О нас</a>
        </div>
        <?php endif; ?>

    </div>
</div>
</body>
</html>

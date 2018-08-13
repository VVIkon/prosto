<!doctype html>
<html lang="ru-ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Просто</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
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

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
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
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        .segment{
            display: inline-block;
            position:  relative;
        }

        .segment-wraper{
            position:  relative;
            border:  1px solid black;
            display: inline-block;
            margin: 5px 10px;
            padding: 0 5px;
        }
        .route-wrapper{
            position: relative;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="top-right links">
        <a href="#">Home</a>
    </div>

    <div class="content">
        <div class="title m-b-md">
            Маршруты
        </div>
            <ul class="route-wrapper">
            <?php foreach($routes as $route): ?>
                <li class="route-wrapper">
                    <?php foreach($route as $segment): ?>
                        <div class ="segment-wraper">
                            <div class="segment"> From: <?= $segment['from'] ?></div>
                            <div class="segment"> To: <?= $segment['to'] ?></div>
                            <div class="segment"> Depart: <?= $segment['ddate'] ?></div>
                        </div>
                    <?php endforeach;?>
                </li>
            <?php endforeach; ?>
            </ul>
    </div>
</div>
</body>
</html>

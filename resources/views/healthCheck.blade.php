<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }
        .menu {
            float:left;
            width:20%;
            text-align:center;
        }
        .menu a {
            background-color:#e5e5e5;
            padding:8px;
            margin-top:7px;
            display:block;
            width:100%;
            color:black;
        }
        .main {
            float:left;
            width:60%;
            padding:0 20px;
        }
        .right {
            background-color:#e5e5e5;
            float:left;
            width:20%;
            padding:15px;
            margin-top:7px;
            text-align:center;
        }

        @media only screen and (max-width:620px) {
            /* For mobile phones: */
            .menu, .main, .right {
                width:100%;
            }
        }
    </style>
</head>
<body style="font-family:Verdana;color:#aaaaaa;">

<div style="background-color:#e5e5e5;padding:15px;text-align:center;">
    <h1>Health Check Ups</h1>
</div>

<div style="overflow:auto">
    <div class="menu">
        <a href="#">Basic Health Check Up</a>
        <a href="#">Diabetic Health Check Up</a>
        <a href="#">Female Health Check Up</a>
        <a href="#">Master Health Check Up</a>
        <a href="#">Cardiac Health Check Up</a>
    </div>

    <div class="main">
        <h2>Lorum Ipsum</h2>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
    </div>

    <div class="right">
        <h2>About</h2>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
    </div>
</div>

<div style="background-color:#e5e5e5;text-align:center;padding:10px;margin-top:7px;">© copyright w3schools.com</div>

</body>
</html>
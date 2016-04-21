<!DOCTYPE html>
<html>
    <head>
        <title>CineBound</title>

        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

        <style>
            html, body {
                height: 100%;
                background: url(/bg.jpg) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title" style="font-family: 'Montserrat', sans-serif;">CineBound</div>
                <a href="/auth/facebook"><img src="facebook_login.png" alt="Sign In with Facebook" class="pull-right" style="margin-top:20px;" /></a>
                <a href="/auth/google"><img src="/google_signin_buttons/web/1x/btn_google_signin_light_pressed_web.png" alt="Sign In with Google" class="pull-right" style="margin-top:20px;" /></a>
            </div>
        </div>
    </body>
</html>

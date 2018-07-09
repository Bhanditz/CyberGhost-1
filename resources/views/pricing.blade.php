<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pricing page</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        @if($os == "Ubuntu")
        @include('layouts.linuxStyle')
        @endif
        @if($os == "Windows")
        @include('layouts.windowsStyle')
        @endif

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Pricing Page
                </div>
                <div class="row">
                    <div class="col-md-6"> 
                        <h3>App name</h3>
                        <p>{{$name}}</p>
                    </div>
                    <div class="col-md-6"> 
                        <h3>App price</h3>
                        <p class="{{$_COOKIE['cookie']['voucher'] == "empty value" ? 'emptyValueCookie' : 
                                ($_COOKIE['cookie']['voucher'] == "registered now" ? 'registeredNowCookie' : 
                                ($_COOKIE['cookie']['voucher'] == "new member" ? 'newMemberCookie' : ''))}}">
                            {{$price}} $</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

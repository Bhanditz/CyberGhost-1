<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CyberGhost</title>

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
                    CyberGhost
                </div>

                <div class="links">
                    <a href="{{ url('/pricing') }}"><p class="{{$_COOKIE['cookie']['voucher'] == "empty value" ? 'emptyValueCookie' : 
                                ($_COOKIE['cookie']['voucher'] == "registered now" ? 'registeredNowCookie' : 
                                ($_COOKIE['cookie']['voucher'] == "new member" ? 'newMemberCookie' : ''))}}">
                            Pricing Page</p></a>
                    <a href="{{ url('dummy')}}"><p>Dummy Page</p></a>
                </div>
            </div>
        </div>
    </body>
</html>

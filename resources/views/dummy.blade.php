<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
                    Dummy
                </div>

                <div class="links" style="color: black">
                    <p> Browser Locale : {{$locale}} </p>
                    <p> Browser : {{$browser}} </p>
                    <p> Client IP : {{$ip}} </p>
                    <p> Config Files:
                        @foreach($files as $f)
                        {{$f .","}}
                        @endforeach
                    </p>
                    <p> Location:<div>
                        Country: {{$location->country}}
                        City: {{$location->city}}
                        Lat: {{$location->lat}}
                        Lon: {{$location->lon}} </div> 
                    </p>
                    @desktop
                    <p> User is logged from web!</p>
                    @enddesktop
                    @mobile
                    <p> User is logged from mobile!</p>
                    @endmobile
                </div>
            </div>
        </div>
    </body>
</html>

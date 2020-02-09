<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('includes.headDash')
    </head>
    <body id="page-top">
        <div id="wrapper">            
            @include('includes.headerDash')            

            
            @yield('content')    
            

        
            @include('includes.footerDash')
        
        
    </body>
</html>
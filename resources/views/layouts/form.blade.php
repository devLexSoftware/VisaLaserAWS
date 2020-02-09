<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.head')
</head>
<body>	
    <header class="row">
        @include('includes.header')
    </header>

    <div id="main">
        <div class="container">
        
            <div class="row">
            @yield('content1')    
            </div>
            <div class="row">
            @yield('content2')
            </div>
            
            <div class="row">
            @yield('content3')            
            </div>
        </div>
    </div>

    
        <div class="row">
            @include('includes.aside')
        </div>
        
    </div>

    <footer class="row">
        @include('includes.footer')
    </footer>

</body>
</html>
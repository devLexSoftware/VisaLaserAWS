<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.head')
</head>
<body>

@if(\Session::has('message'))
		@include('includes.statuspay')
	@endif
	
    <header class="row">
        @include('includes.header')
    </header>
 
    <div id="main">
        <div class="container">
        
            <div class="col-md-4">
            @yield('content')    
            </div>
            <div class="col-md-4">
            @yield('content2')
            </div>
            <div class="col-md-4">
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
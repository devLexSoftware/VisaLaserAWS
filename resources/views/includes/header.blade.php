<div id="top">
    <div class="container">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <img src="images/logo_1.png" class="img-responsive">
            </div>

            <div class="col-4 d-flex justify-content-end align-items-center">

            </div>
            <div class="col-4 text-center">
                <p class="blog-header-logo text-dark" style="font-size:34px;">CSC American Visa México</p>
            </div>
        </div>
    </div>

</div>

 





<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-nav">

                <li class="">
                    <a href="home">INICIO</a>
                </li>
                <li class="">
                    <a href="tramite">TRÁMITE</a>
                </li>
                <li class="">
                    <a href="registerUser">REGISTRO</a>
                </li>
                <li class="">
                    <a href="contact">CONTACTO</a>
                </li>



                
                @if (Auth::guard('custom')->check())
                    <li class="">
                        <a href="perfil">PERFIL</a>
                    </li>
                    <li class="navbar-right">
                    <a href="logout">Logout</a>
                </li>
                
                @elseif (Auth::guard('admin')->check())
                <li class="navbar-right">
                    <a href="logout">Logout</a>
                </li>
                @else
                
                <li class="">
                    <a href="login">LOGIN</a>
                </li>
                @endif
                
            </ul>
        </div>
    </div>
</nav>
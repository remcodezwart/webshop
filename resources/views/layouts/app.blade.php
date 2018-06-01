<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                            <li><a href="{{ route('AllProducts') }}">Producten</a></li>
                            <li><a href="{{ route('AllCategories') }}">Categorieën</a></li>
                            <li><a href="{{ route('home') }}">Dashboard</a></li>
                        @guest
                            <li><a href="{{ route('login') }}">Inloggen</a></li>
                            <li><a href="{{ route('register') }}">Registeren</a></li>
                        @else
                            <li><a href="{{ route('orders') }}">Overzicht orders</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        
        <div style="display:none" id="error" class="container">
            <div id="error-list" class="alert alert-danger" role="alert">
                <span class="sr-only">Error(s):</span>
            
            </div>
        </div>

        <div style="display:none" id="succes" class="container">
            <div id="succes-list" class="alert alert-success" role="alert">
                <span class="sr-only">Succes:</span>
            
            </div>
        </div>
        @yield('feedback')
        @yield('content')
        <div class="container" data-spy="affix">
            <button type="button" class="shoppingCartContainer btn btn-default" data-toggle="modal" data-target="#myModal">
                Winkel wagentje
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Winkel wagentje</h4>
              </div>
              <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>product</th>
                            <th>prijs</th>
                            <th>aantal</th>
                            <th>totaal</th>
                            <th>acties</th>
                        </tr>
                    </thead>
                    <tbody id="orders">
                        
                    </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <p class="text-center">Totaalprijs &#8364;<span id="total">0</span></p>
                <form class="pull-left" action="{{ route('placeOrder') }}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary">bestel</button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Winkel wagentje sluiten</button>   
              </div>
            </div>
          </div>
        </div>


    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/juqery.js') }}"></script>
    <script src="{{ asset('js/shoppingCart.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

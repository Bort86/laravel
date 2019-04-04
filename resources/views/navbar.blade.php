<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/pop.jpg') }}" alt="logo" width="150" height="100">
            {{ config('app.name') }} 
            <img src="{{ asset('img/pop.jpg') }}" alt="logo" width="150" height="100">
            {{ config('app.name') }} 
            <img src="{{ asset('img/pop.jpg') }}" alt="logo" width="150" height="100">
            {{ config('app.name') }} 
            <img src="{{ asset('img/pop.jpg') }}" alt="logo" width="150" height="100">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{trans('messages.cats')}} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('catlist')}}">List all</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('catcreate')}}">Add</a></li>
                        <li><a class="dropdown-item" href="{{route('catfind')}}">Find & edit</a></li>
                    </ul>
                </li>  
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Products <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('productlist')}}">List all</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('productcreate')}}">Add</a></li>
                        <li><a class="dropdown-item" href="{{route('prodfind')}}">Find & Edit</a></li>
                    </ul>
                </li>  
            </ul>
        </div>
    </div>
</nav>


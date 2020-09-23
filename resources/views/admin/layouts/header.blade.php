<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="{{ route('posts.index') }}">{{ config('app.name') }}</a>

    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        {{ Auth::user()->name }}
    </a>

    <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdown">
        <a id="dropdownLogout" class="dropdown-item py-2" href="{{ route('logout') }}">
            {{ __('auth.logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</nav>


<ul class="nav navbar-nav">
    <li><a href="/" target="_blank">Front</a></li>
    @if (Auth::check())
    <li @if (Request::is('admin/lang*')) class="active" @endif>
        <div ID="lang-sw">
            <label for="lang-switcher">Lang </label>
            <select name="lang-switcher" id="lang-switcher" onchange="window.location = '/admin/lang/'+$(this).val();">
                 <option value="en" @if(session('lang') == 'en') selected @endif>EN</option>
                 <option value="ru" @if(session('lang') == 'ru') selected @endif>RU</option>
            </select>
        </div>

    </li>
    <li @if (Request::is('admin/category*')) class="active" @endif>
         <a href="/admin/category">Categories</a>
    </li>
    @endif
</ul>
<ul class="nav navbar-nav navbar-right">
    @if (Auth::guest())
    <li><a href="/auth/login">Login</a></li>
    @else
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
           aria-expanded="false">{{ Auth::user()->name }}
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="{{ url('/logout') }}"
                   onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>                
            </li>
        </ul>
    </li>
    @endif
</ul>
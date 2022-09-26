<li class="nav-item">
    <a href="{{ route('home.index') }}" class="nav-link {{ Request::is('home.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Panel</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('survey.index_user_surveys') }}" class="nav-link {{ Request::is('survey.index_user_surveys') ? 'active' : '' }}">
        <i class="fa-solid fa-clipboard-question"></i>
        <p>Twoje ankiety</p>
    </a>
</li>

@if (Auth::user()->hasRole('admin'))
<li class="nav-item">
    <a href="{{ route('user.index') }}" class="nav-link {{ Request::is('user.index') ? 'active' : '' }}">
        <i class="fas fa-users"></i>
        <p>Lista użytkowników</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('survey.index') }}" class="nav-link {{ Request::is('survey.index') ? 'active' : '' }}">
        <i class="fa-solid fa-globe"></i>
        <p>Lista ankiet</p>
    </a>
</li>
@endif

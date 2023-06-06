<aside id="l-sidebar" class="bg-white px-8 py-12 border-r border-slate-300 h-full">
    <nav role="navigation">
        <div class="logo pb-16">
            <a href="{{ route('admin.dashboard') }}">
                <img width="200" src="{{ asset('images/logo.svg') }}" alt="Roomly" />
            </a>
        </div>
        <ul class="menu">
            <li>
                <a href="{{ route('admin.dashboard') }}">Tableau de bord</a>
            </li>
            {{-- <li>
                <a href="{{ route('admin.rooms.index') }}">Rooms</a>
            </li> --}}
            <li>
                <a href="{{ route('admin.users.index') }}">Utilisateurs</a>
            </li>
        </ul>
    </nav>
</aside>
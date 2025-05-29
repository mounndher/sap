<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="">Stisla</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="">St</a>
    </div>
    <ul class="sidebar-menu">
    <li class="">Dashboard</li>

    <li class="{{ setSidebarActive('dashboard') }}">
        <a href="{{ route('dashboard') }}" class="nav-link ">
            <i class="fas fa-fire"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="menu-header">Donneés de base</li>

    <li class="dropdown {{ setSidebarActive(['layout-default', 'layout-transparent', 'layout-top-navigation']) }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-columns"></i>
            <span>Layout</span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
            <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
            <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
        </ul>
    </li>

    <li class="{{ setSidebarActive('articles.index') }}">
        <a class="nav-link" href="{{ route('articles.index') }}">
            <i class="fas fa-newspaper"></i>
            <span>Article Page</span>
        </a>
    </li>

    <li class="{{ setSidebarActive('typearticles.index') }}">
        <a class="nav-link" href="{{ route('typearticles.index') }}">
            <i class="far fa-square"></i>
            <span>Type d'Article Page</span>
        </a>
    </li>

    <li class="{{ setSidebarActive('groupearticles.index') }}">
        <a class="nav-link" href="{{ route('groupearticles.index') }}">
            <i class="far fa-square"></i>
            <span>Groupe d'Article Page</span>
        </a>
    </li>

    <li class="{{ setSidebarActive('classvs.index') }}">
        <a class="nav-link" href="{{ route('classvs.index') }}">
            <i class="far fa-square"></i>
            <span>Class valoris</span>
        </a>
    </li>

    <li class="menu-header">Achat</li>

    <li class="{{ setSidebarActive('groupeacheteurs.index') }}">
        <a class="nav-link" href="{{ route('groupeacheteurs.index') }}">
          <i class="fas fa-file-invoice-dollar"></i>
            <span>Groupe d'Acheteur Page</span>
        </a>
    </li>

    <li class="menu-header">Setting</li>

    <li class="{{ setSidebarActive('Ldapsetting.index') }}">
        <a class="nav-link" href="{{ route('Ldapsetting.index') }}">
            <i class="fas fa-cog"></i> <!-- icône "setting" -->
            <span>Setting Ldap Page</span>
        </a>
    </li>

    <li class="">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-user"></i> <!-- icône "user" -->
            <span>User</span>
        </a>
    </li>
    <li class="">
        <a class="nav-link" href="{{ route('usersap.index') }}">
           <i id="toggleIcon" class="fas fa-eye"></i>
            <span>User SAP</span>
        </a>
    </li>

</ul>


</aside>

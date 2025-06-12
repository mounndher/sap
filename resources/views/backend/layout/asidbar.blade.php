<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="">Stisla</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="">St</a>
    </div>
    <ul class="sidebar-menu">


        <li class="{{ setSidebarActive('dashboard') }}">
            <a href="{{ route('dashboard') }}" class="nav-link ">
                <i class="fas fa-fire"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="menu-header">Donneés de base</li>


        @if(hasPermission(['Article index','Article create','edit Article']) || isSuperAdmin())
        <li class="{{ setSidebarActive('articles.index') }}">
            <a class="nav-link" href="{{ route('articles.index') }}">
                <i class="fas fa-newspaper"></i>
                <span>Article Page</span>
            </a>
        </li>
        @endif

        @if(hasPermission(["Type d'Article index","Type d'Article create","Type d'Article update","Type d'Article delete"]) || isSuperAdmin())
        <li class="{{ setSidebarActive('articles.index') }}">
        <li class="{{ setSidebarActive('typearticles.index') }}">
            <a class="nav-link" href="{{ route('typearticles.index') }}">
                <i class="far fa-square"></i>
                <span>Type d'Article Page</span>
            </a>
        </li>
        @endif

        @if(hasPermission(["Groupes d Acheteurs index","Groupes d Acheteurs create","Groupes d Acheteurs update","Groupes d Acheteurs delete"]) || isSuperAdmin())
        <li class="{{ setSidebarActive('groupearticles.index') }}">
            <a class="nav-link" href="{{ route('groupearticles.index') }}">
                <i class="far fa-square"></i>
                <span>Groupe d'Article Page</span>
            </a>
        </li>
        @endif
        @if(hasPermission(["Class valoris index","Class valoris create","Class valoris update","Class valoris delete"]) || isSuperAdmin())
        <li class="{{ setSidebarActive('classvs.index') }}">
            <a class="nav-link" href="{{ route('classvs.index') }}">
                <i class="far fa-square"></i>
                <span>Class valoris</span>
            </a>
        </li>
        @endif

        @if(hasPermission(["Groupes d Acheteurs index","Groupes d Acheteurs create","Groupes d Acheteurs update","Groupes d Acheteurs delete"]) || isSuperAdmin())
        <li class="menu-header">Achat</li>
        <li class="{{ setSidebarActive('groupeacheteurs.index') }}">
            <a class="nav-link" href="{{ route('groupeacheteurs.index') }}">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Groupe d'Acheteur Page</span>
            </a>
        </li>
        @endif

        <li class="menu-header">Setting</li>
        @if(hasPermission(["setting ldap index","setting ldap update"]) || isSuperAdmin())

        <li class="{{ setSidebarActive('Ldapsetting.index') }}">
            <a class="nav-link" href="{{ route('Ldapsetting.index') }}">
                <i class="fas fa-cog"></i> <!-- icône "setting" -->
                <span>Setting Ldap Page</span>
            </a>
        </li>
        @endif
        @if(hasPermission(["Smtp index","tempalte email index",'Emailuser index']) || isSuperAdmin())

        <li class="dropdown {{ setSidebarActive(['mail_settings.*', 'mail_recipients.*', 'layout-top-navigation']) }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fas fa-columns"></i>
                <span>Email</span>
            </a>
            <ul class="dropdown-menu">
                @if(hasPermission(["Smtp index","Smtp update"]) || isSuperAdmin())
                <li class="{{ request()->routeIs('mail_settings.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('mail_settings.index') }}">Smtp Setting</a>
                </li>
                @endif
                @if(hasPermission(["Emailuser index","Emailuser create","Emailuser delete","Emailuser update"]) || isSuperAdmin())
                <li><a class="nav-link " href="{{ route('mail_recipients.index') }}">Email user</a></li>
                @endif
                @if(hasPermission(["tempalte email index","tempalte email update"]) || isSuperAdmin())
                <li><a class="nav-link " href="{{ route('template_email_validation.index') }}">Email template validtion</a></li>
                @endif
            </ul>
        </li>
        @endif
        @if((hasPermission(['usersap index']) || isSuperAdmin()))
        <li class="{{ setSidebarActive('users.index') }}">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="fas fa-user"></i> <!-- icône "user" -->
                <span>User</span>
            </a>
        </li>
        @endif

        @if(hasPermission(['usersap index','usersap update']) || isSuperAdmin())
        <li class="{{ setSidebarActive('usersap.index') }}">
            <a class="nav-link" href="{{ route('usersap.index') }}">
                <i id="toggleIcon" class="fas fa-eye"></i>
                <span>User SAP</span>
            </a>
        </li>
        @endif

        <li class="{{ setSidebarActive('setting.index') }}">
            <a class="nav-link" href="{{ route('setting.index') }}">
                <i id="toggleIcon" class="fas fa-eye"></i>
                <span>Setting</span>
            </a>
        </li>


        @if(hasPermission(["access management index"]) || isSuperAdmin())
        <li class="dropdown {{ setSidebarActive(['role.index', 'layout-transparent', 'layout-top-navigation']) }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fas fa-users"></i>
                <span>Access Management</span>
            </a>
            <ul class="dropdown-menu">
                @if(hasPermission(["access management index","access management update","access management index"]) || isSuperAdmin())
                <li><a class="nav-link {{ setSidebarActive('role.index') }}" href="{{ route('roles.index') }}">Role and Permission</a></li>
                @endif
                <li><a class="nav-link {{ setSidebarActive('role-users.index') }}" href="{{ route('role-users.index') }}">Role user</a></li>

            </ul>
        </li>
        @endif


    </ul>


</aside>

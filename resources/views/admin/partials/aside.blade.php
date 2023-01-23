<aside class="sidebar">
    <nav class="nav">
        <ul class="w-100">

            <li class="
            @if ((Route::currentRouteName() == 'admin.dashboard') )
                active
            @endif
            "><a href="{{route('admin.dashboard')}}"><i class="fa-solid fa-table-columns"></i> Dashboard </a></li>

            <li class="
            @if ((Route::currentRouteName() == 'admin.projects.index') || (Route::currentRouteName() == 'admin.projects.orderby'))
                active
            @endif
            "><a href="{{route('admin.projects.index')}}"><i class="fa-solid fa-diagram-project mx-3"></i> Projects </a></li>

            <li class="
            @if (Route::currentRouteName() == 'admin.projects.create')
                active
            @endif
            "><a href=" {{route('admin.projects.create')}} "><i class="fa-solid fa-plus"></i> New Project</a></li>



        </ul>
    </nav>
</aside>



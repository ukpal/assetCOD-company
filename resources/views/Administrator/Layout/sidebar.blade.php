<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('dashboard')}}" class="brand-link">

    <img id="default-brand-image" src="{{URL::asset('public/Administrator/dist/img/AdminLTELogo.png')}}" alt="Logo"
      class="d-none brand-image img-circle elevation-3" style="opacity: .8">
    <img id="brand-image" src="" alt="Logo" class="d-none brand-image img-circle elevation-3" style="opacity: .8">


    @if(Session::has('loggedUser'))
    <span class="brand-text font-weight-light">{{Session::get('loggedUser')->first_name}}</span>
    @else
    <span class="brand-text font-weight-light">AssetCOD</span>
    @endif
    
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item menu-open">
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('admin/dashboard')}}"
                class="nav-link {{Request::is('admin/dashboard*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard</p>
              </a>
              <a href="{{route('subscription')}}"
                class="nav-link {{Request::is('admin/subscription*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Subscription</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('modules')}}" class="nav-link {{Request::is('admin/modules*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Modules</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('roles')}}" class="nav-link {{Request::is('admin/roles*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Role</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('settings')}}" class="nav-link {{Request::is('admin/settings*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Setting</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('users')}}" class="nav-link {{Request::is('admin/users*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Users</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>
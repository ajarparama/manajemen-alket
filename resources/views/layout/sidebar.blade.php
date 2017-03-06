  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('img/'.Auth::user()->userpic) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->nama }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">NAVIGATION</li>
        <!-- Optionally, you can add icons to the links -->
        <li @if (Request::is('home*')) class="active" @endif ><a href="{{ url('home') }}"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li @if (Request::is('alket*')) class="treeview active" @elseif (Request::is('mediamassa*')) class="treeview active" @elseif (Request::is('siup*')) class="treeview active" @else class="treeview" @endif>
          <a href="#"><i class="fa fa-book"></i> <span>Alket</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li @if (Request::is('alket*')) class="active" @endif><a href="{{ url('alket') }}"><i class="fa fa-circle-o"></i>Alket Jual Beli</a></li>
            <li @if (Request::is('mediamassa*')) class="active" @endif><a href="{{ url('mediamassa') }}"><i class="fa fa-circle-o"></i>Alket Media Massa</a></li>
            <li @if (Request::is('siup*')) class="active" @endif><a href="{{ url('siup') }}"><i class="fa fa-circle-o"></i>SIUP dan TDP</a></li>
          </ul>
        </li>
        <li @if (Request::is('ppat*')) class="treeview active" @elseif (Request::is('lapppat*')) class="treeview active" @elseif (Request::is('cetak-laporan*')) class="treeview active" @elseif (Request::is('monitoring*')) class="treeview active" @else class="treeview" @endif>
          <a href="#"><i class="fa fa-address-book"></i> <span>PPAT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li @if (Request::is('ppat*')) class="active" @endif ><a href="{{ url('ppat') }}"><i class="fa fa-circle-o"></i>Daftar PPAT</a></li>
            <li @if (Request::is('lapppat*')) class="active" @endif ><a href="{{ url('lapppat') }}"><i class="fa fa-circle-o"></i>Input Laporan</a></li>
            <li @if (Request::is('cetak-laporan*')) class="active" @endif><a href="{{ url('cetak-laporan') }}"><i class="fa fa-circle-o"></i>Cetak Laporan</a></li>
            <li @if (Request::is('monitoring*')) class="active" @endif><a href="{{ url('monitoring') }}"><i class="fa fa-circle-o"></i>Monitoring PPAT</a></li>
          </ul>
        </li>
        <li @if (Request::is('setting*')) class="active" @endif ><a href="{{ url('setting') }}"><i class="fa fa-gear"></i> <span>Setting</span></a></li>
        <form role="form" method="POST" action="{{ url('/logout') }}">
          {{ csrf_field() }}
          <li class="logout"><button type="submit" class="btn btn-logout btn-flat"><i class="fa fa-circle-o text-red"></i> <span> Logout</span></button></li>
        </form>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

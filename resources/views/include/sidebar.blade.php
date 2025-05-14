<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('dashboard.index') }}">
            <span class="align-middle">{{ env('APP_NAME') }}</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item {{ Request::routeIs('dashboard.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard.index') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::routeIs('user.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('user.index') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Data User</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::routeIs('gejala.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('gejala.index') }}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Data
                        Gejala</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::routeIs('jenis-abk.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('jenis-abk.index') }}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Penyakit & Kondisi
                        ABK</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::routeIs('form') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('form') }}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Form</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::routeIs('diagnosis.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('diagnosis.index') }}">
                    <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Diagnosis</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

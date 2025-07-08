<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="javascript:void(0);" onclick="window.history.back();">
            <span class="align-middle">{{ env('APP_NAME') }}</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            @if (Auth::check() && Auth::user()->role === 'admin')
                <li class="sidebar-item {{ Request::routeIs('dashboard.index') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('dashboard.index') }}">
                        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                    </a>
                </li>

                <li
                    class="sidebar-item {{ Request::routeIs('aturan.index') || Request::routeIs('aturan.create') || Request::routeIs('aturan.edit') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('aturan.index') }}">
                        <i class="align-middle" data-feather="list"></i> <span class="align-middle">Data Aturan</span>
                    </a>
                </li>

                <li
                    class="sidebar-item {{ Request::routeIs('poin_observasi.index') || Request::routeIs('poin_observasi.create') || Request::routeIs('poin_observasi.edit') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('poin_observasi.index') }}">
                        <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Data Poin
                            Observasi</span>
                    </a>
                </li>
            @endif

            <li
                class="sidebar-item {{ Request::routeIs('observasi.create') || Request::routeIs('observasi.result') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('observasi.create') }}">
                    <i class="align-middle" data-feather="edit-3"></i> <span class="align-middle">Form Observasi</span>
                </a>
            </li>

            <li
                class="sidebar-item {{ Request::routeIs('observasi.user.index') || Request::routeIs('observasi.admin.index') ? 'active' : '' }}">
                <a class="sidebar-link"
                    href="{{ Auth::user()->role == 'admin' ? route('observasi.admin.index') : route('observasi.user.index') }}">
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">Riwayat Observasi</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

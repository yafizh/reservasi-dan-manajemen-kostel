<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">ADMIN</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MENU USER</li>
                <li class="nav-item">
                    <a href="/admin" @class(['nav-link', 'active' => request()->segment(1) == 'admin'])>
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Admin
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/employees" @class(['nav-link', 'active' => request()->segment(1) == 'employees'])>
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Pegawai
                        </p>
                    </a>
                </li>
                <li class="nav-header">MENU KAMAR</li>
                <li class="nav-item">
                    <a href="/room-types" @class([
                        'nav-link',
                        'active' =>
                            request()->segment(1) == 'room-types' &&
                            (request()->segment(2) !== 'rooms' &&
                                (request()->segment(2) === null ||
                                    request()->segment(2) === 'create' ||
                                    request()->segment(3) === 'show' ||
                                    request()->segment(3) === 'edit')),
                    ])>
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                            Tipe Kamar
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/room-types/rooms" @class([
                        'nav-link',
                        'active' =>
                            request()->segment(2) == 'rooms' || request()->segment(3) == 'rooms',
                    ])>
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            Kamar
                        </p>
                    </a>
                </li>
                <li class="nav-header">MENU PEMESANAN KAMAR</li>
                <li class="nav-item">
                    <a href="/reservations" @class([
                        'nav-link',
                        'active' => request()->segment(1) == 'reservations',
                    ])>
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Pemesanan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/check-ins" @class(['nav-link', 'active' => request()->segment(1) == 'check-ins'])>
                        <i class="nav-icon far fa-calendar-check"></i>
                        <p>
                            Check In
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/check-outs" @class([
                        'nav-link',
                        'active' => request()->segment(1) == 'check-outs',
                    ])>
                        <i class="nav-icon far fa-calendar-minus"></i>
                        <p>
                            Check Out
                        </p>
                    </a>
                </li>
                <li class="nav-header">MENU LAPORAN</li>
                <li @class([
                    'nav-item',
                    'menu-open' => request()->segment(1) === 'report',
                ])>
                    <a href="#" @class(['nav-link', 'active' => request()->segment(1) === 'report'])>
                        <i class="nav-icon far fa-file-pdf"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/report/employees" @class([
                                'nav-link',
                                'active' => request()->segment(2) == 'employees',
                            ])>
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pegawai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/report/reservations" @class([
                                'nav-link',
                                'active' => request()->segment(2) == 'reservations',
                            ])>
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pemesanan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/report/check-ins" @class(['nav-link', 'active' => request()->segment(2) == 'check-ins'])>
                                <i class="far fa-circle nav-icon"></i>
                                <p>Check In</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/report/check-outs" @class([
                                'nav-link',
                                'active' => request()->segment(2) == 'check-outs',
                            ])>
                                <i class="far fa-circle nav-icon"></i>
                                <p>Check Out</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/report/available-rooms" @class([
                                'nav-link',
                                'active' => request()->segment(2) == 'available-rooms',
                            ])>
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ketersediaan Kamar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/report/employee-services" @class([
                                'nav-link',
                                'active' => request()->segment(2) == 'employee-services',
                            ])>
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pelayanan Pegawai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/report/reservation-chart" @class([
                                'nav-link',
                                'active' => request()->segment(2) == 'reservation-chart',
                            ])>
                                <i class="far fa-circle nav-icon"></i>
                                <p>Grafik Pemesanan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/report/check-in-chart" @class([
                                'nav-link',
                                'active' => request()->segment(2) == 'check-in-chart',
                            ])>
                                <i class="far fa-circle nav-icon"></i>
                                <p>Grafik Check In</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>

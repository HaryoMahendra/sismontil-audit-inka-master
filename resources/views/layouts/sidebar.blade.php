<div class="sidebar-menu">
    <div class="sidebar-header">
        <a href="{{ url('/') }}"><img src="{{ asset('logoinka.png') }}" alt="logo" width="500%"></a>
    </div>
    <div class="user-panel mt-3 pb-0 mb-3 d-flex" style="padding-left: 32px; padding-right: 32px;">
        <div class="image">
            <img src="https://www.businessnetworks.com/sites/default/files/default_images/default-avatar.png"
                style="width: 3rem; height: 3rem; border-radius: 50%;" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info pl-3">
            @if (auth()->check())
                <div style="color: #8d97ad !important;">Hi, <a href="{{ url('/') }}"
                        style="color: #8d97ad !important;">
                        {{ auth()->user()->name }}</a></div>
                <span class="badge badge-success">
                    {{ auth()->user()->role->role }}
                </span>
            @else
                <div style="color: #8d97ad !important;">Hi, Guest</div>
            @endif
        </div>
    </div>
    <div class="main-menu pt-0">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="{{ url('/') }}"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                    </li>
                    @if (auth()->check() && auth()->user()->role && auth()->user()->role->role == 'Admin')
                        <hr
                            style="display: block; height: 1px; border: 0; border-top: 1px solid #343e50; margin: 1em 0; margin-left: 32px; margin-right: 32px;">
                        <li>
                            <a href="#" aria-expanded="true"><i class="ti-layout"></i><span>Master
                                        Data</span></a>
                            <ul class="collapse">
                                <li><a href="{{ url('/data-ncr') }}">Data NCR</a></li>
                                <li><a href="{{ url('/data-ofi') }}">Data OFI</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('/monitoring-tl') }}"><i class="ti-write"></i><span>Monitoring Tindak Lanjut</span></a>
                        </li>
                        {{-- Kondisi baru untuk menu CAT --}}
                        @if (auth()->check() && auth()->user()->role && in_array(auth()->user()->role->role, ['Admin', 'Auditor', 'Wakil Manajemen']))
                            <li>
                                <a href="{{ url('/cat') }}"><i class="ti-alert"></i><span>CAT</span></a>
                            </li>
                        @endif
                        <hr
                            style="display: block; height: 1px; border: 0; border-top: 1px solid #343e50; margin: 1em 0; margin-left: 32px; margin-right: 32px;">
                        <li>
                            <a href="{{ route('tema.index') }}"><i class="fa-solid fa-clipboard-list"></i><span>Tema
                                        Audit</span></a>
                        </li>
                        <li>
                            <a href="{{ route('user.index') }}"><i class="fa-solid fa-users"></i><span>Pengguna</span></a>
                        </li>
                        <hr
                            style="display: block; height: 1px; border: 0; border-top: 1px solid #343e50; margin: 1em 0; margin-left: 32px; margin-right: 32px;">
                    @else
                        <li>
                            <a href="#" aria-expanded="true"><i class="ti-layout"></i><span>Master
                                        Data</span></a>
                            <ul class="collapse">
                                <li><a href="{{ url('/data-ncr') }}">Data NCR</a></li>
                                <li><a href="{{ url('/data-ofi') }}">Data OFI</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('/monitoring-tl') }}"><i class="ti-write"></i><span>Monitoring
                                        Tindak Lanjut</span></a>
                        </li>
                        {{-- Kondisi baru untuk menu CAT untuk non-Admin --}}
                        @if (auth()->check() && auth()->user()->role && in_array(auth()->user()->role->role, ['Auditor', 'Wakil Manajemen']))
                            <li>
                                <a href="{{ url('/cat') }}"><i class="ti-alert"></i><span>CAT</span></a>
                            </li>
                        @endif
                        <hr
                            style="display: block; height: 1px; border: 0; border-top: 1px solid #343e50; margin: 1em 0; margin-left: 32px; margin-right: 32px;">
                    @endif

                     <li>
                        <a href="{{ url('/hubungi') }}"><i class="ti-headphone-alt"></i><span>Hubungi</span></a>
                    </li>
                    
                    <li>
                        <a href="{{ url('/faq') }}"><i class="ti-help-alt"></i><span>FAQ</span></a>
                    </li>
                  
                    <hr
                            style="display: block; height: 1px; border: 0; border-top: 1px solid #343e50; margin: 1em 0; margin-left: 32px; margin-right: 32px;">
                    <li>
                        <a href="{{ url('logout') }}"><i class="ti-power-off"></i><span>Logout</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
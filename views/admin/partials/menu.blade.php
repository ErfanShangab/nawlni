@php
    $r = \Route::current()->getAction();
    $route = (isset($r['as'])) ? $r['as'] : '';
@endphp
@unlessrole('agent')
<li class="nav-item mT-20">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.dash') ? 'active' : '' }}" href="{{ route(ADMIN . '.dash') }}">
        <span class="icon-holder">
            <i class="c-blue-500 ti-home"></i>
        </span>
        <span class="title">لوحة التحكم</span>
    </a>
</li>
@endunlessrole

@role('super_admin')

<li class="nav-item mT-20">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.users') ? 'active' : '' }}" href="{{ route(ADMIN . '.users.index') }}">
        <span class="icon-holder">
            <i class="c-brown-500 ti-user"></i>
        </span>
        <span class="title">الموظفون</span>
    </a>
</li>
@endrole



@unlessrole('agent')
<li class="nav-item mT-20">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.drivers') ? 'active' : '' }}" href="{{ route(ADMIN . '.drivers.index') }}">
        <span class="icon-holder">
            <i class="c-brown-500 ti-car"></i>
        </span>
        <span class="title">الكباتن</span>
    </a>
</li>
@endunlessrole

@unlessrole('agent')
<li class="nav-item mT-20">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.clients') ? 'active' : '' }}" href="{{ route(ADMIN . '.clients.index') }}">
        <span class="icon-holder">
            <i class="c-brown-500 ti-user"></i>
        </span>
        <span class="title">العملاء</span>
    </a>
</li>
@endunlessrole

@unlessrole('agent')
<li class="nav-item  mT-20">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.customers') ? 'active' : '' }}" href="{{ route(ADMIN . '.customers.index') }}">
        <span class="icon-holder">
            <i class="c-brown-500 ti-user"></i>
        </span>
        <span class="title">الزبائن</span>
    </a>
</li>
@endunlessrole

@unlessrole('agent')
<li class="nav-item  mT-20">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.orders') ? 'active' : '' }}" href="{{ route(ADMIN . '.orders.index') }}">
        <span class="icon-holder">
            <i class="c-brown-500 ti-clipboard"></i>
        </span>
        <span class="title">الطلبيات</span>
    </a>
</li>
@endunlessrole

@unlessrole('agent')
<li class="nav-item  mT-20">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.products') ? 'active' : '' }}" href="{{ route(ADMIN . '.products.index') }}">
        <span class="icon-holder">
            <i class="c-brown-500 ti-gift"></i>
        </span>
        <span class="title">المنتجات</span>
    </a>
</li>
@endunlessrole
@unlessrole('agent')
<li class="nav-item  mT-20">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.categories') ? 'active' : '' }}" href="{{ route(ADMIN . '.categories.index') }}">
        <span class="icon-holder">
            <i class="c-brown-500 ti-layout-grid4"></i>

        </span>
        <span class="title">التصنيفات</span>
    </a>
</li>
@endunlessrole

{{-- @unlessrole('agent')

<li class="nav-item  mT-20">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.reports') ? 'active' : '' }}" href="{{ route(ADMIN . '.pays.index') }}">
        <span class="icon-holder">
            <i class="c-brown-500 ti-money"></i>
        </span>
        <span class="title">التقارير  </span>
    </a>
</li>
@endunlessrole --}}

@role('super_admin')

<li class="nav-item  mT-20">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.configs') ? 'active' : '' }}" href="{{ route(ADMIN . '.configs.index') }}">
        <span class="icon-holder">
            <i class="c-brown-500 ti-settings"></i>
        </span>
        <span class="title">الإعدادت المتقدمة  </span>
    </a>
</li>
@endrole

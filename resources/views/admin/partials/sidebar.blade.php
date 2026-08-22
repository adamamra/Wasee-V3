<div class="flex flex-col h-full">
    {{-- Logo --}}
    <div class="h-16 flex items-center gap-3 px-5 border-b border-white/10 shrink-0">
        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white text-sm shadow-lg shadow-primary-500/30"><i class="fas fa-shield-halved"></i></div>
        <div>
            <span class="text-base font-black text-white tracking-wide">وصيّ</span>
            <span class="text-[10px] text-gray-500 block leading-tight">لوحة الإدارة</span>
        </div>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 py-3 overflow-y-auto">
        <div class="px-4 pb-2">
            <span class="text-[10px] font-bold text-gray-600 uppercase tracking-widest">القائمة</span>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3.5 px-5 py-2.5 mx-2 rounded-xl text-sm font-medium text-gray-400 hover:bg-white/10 hover:text-white transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-primary-500/15 text-primary-200' : '' }}">
            <span class="w-9 h-9 rounded-lg flex items-center justify-center text-sm transition-all duration-200 group-hover:bg-white/10 {{ request()->routeIs('admin.dashboard') ? 'bg-primary-500/25 text-primary-300' : 'bg-white/5' }}">
                <i class="fas fa-chart-pie"></i>
            </span>
            <span>الرئيسية</span>
        </a>

        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3.5 px-5 py-2.5 mx-2 rounded-xl text-sm font-medium text-gray-400 hover:bg-white/10 hover:text-white transition-all duration-200 group {{ request()->routeIs('admin.users.*') ? 'bg-primary-500/15 text-primary-200' : '' }}">
            <span class="w-9 h-9 rounded-lg flex items-center justify-center text-sm transition-all duration-200 group-hover:bg-white/10 {{ request()->routeIs('admin.users.*') ? 'bg-primary-500/25 text-primary-300' : 'bg-white/5' }}">
                <i class="fas fa-users"></i>
            </span>
            <span>المستخدمين</span>
        </a>

        <a href="{{ route('admin.organizations.index') }}" class="flex items-center gap-3.5 px-5 py-2.5 mx-2 rounded-xl text-sm font-medium text-gray-400 hover:bg-white/10 hover:text-white transition-all duration-200 group {{ request()->routeIs('admin.organizations.*') ? 'bg-primary-500/15 text-primary-200' : '' }}">
            <span class="w-9 h-9 rounded-lg flex items-center justify-center text-sm transition-all duration-200 group-hover:bg-white/10 {{ request()->routeIs('admin.organizations.*') ? 'bg-primary-500/25 text-primary-300' : 'bg-white/5' }}">
                <i class="fas fa-building"></i>
            </span>
            <span>المؤسسات</span>
        </a>

        <a href="{{ route('admin.parcels.index') }}" class="flex items-center gap-3.5 px-5 py-2.5 mx-2 rounded-xl text-sm font-medium text-gray-400 hover:bg-white/10 hover:text-white transition-all duration-200 group {{ request()->routeIs('admin.parcels.*') ? 'bg-primary-500/15 text-primary-200' : '' }}">
            <span class="w-9 h-9 rounded-lg flex items-center justify-center text-sm transition-all duration-200 group-hover:bg-white/10 {{ request()->routeIs('admin.parcels.*') ? 'bg-primary-500/25 text-primary-300' : 'bg-white/5' }}">
                <i class="fas fa-box"></i>
            </span>
            <span>الطلبات</span>
        </a>
    </nav>

    {{-- Footer --}}
    <div class="border-t border-white/10 py-3 px-4 shrink-0 space-y-1">
        <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium text-gray-500 hover:bg-white/10 hover:text-gray-300 transition-all duration-200">
            <span class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-xs"><i class="fas fa-globe"></i></span>
            <span>الموقع العام</span>
        </a>
        <a href="#" onclick="event.preventDefault(); document.getElementById('{{ md5('logout') }}').submit();" class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium text-red-400/70 hover:bg-red-500/10 hover:text-red-400 transition-all duration-200">
            <span class="w-8 h-8 rounded-lg bg-red-500/10 flex items-center justify-center text-xs"><i class="fas fa-right-from-bracket"></i></span>
            <span>تسجيل الخروج</span>
        </a>
        <form id="{{ md5('logout') }}" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
    </div>
</div>
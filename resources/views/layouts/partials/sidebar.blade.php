<!-- Sidebar -->
<aside class="bg-white shadow-lg h-full text-gray-700" x-data="{ activeDropdown: null }">
    <!-- Logo -->
    <div class="px-6 py-5 border-b border-gray-200 bg-white">
        <div class="flex items-center">
            <a href="/dashboard" class="nav-link">
            <img src="{{ asset('images/diary_kitchen_logo.jpg') }}" alt="Logo" class="w-10 h-10 mr-3">
            <div>
                <h1 class="text-xl font-bold text-gray-800">DIARY-KITCHEN</h1>
                <p class="text-xs text-gray-500">Medan</p>
            </a>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="px-3 py-4 h-[calc(100%-13rem)] overflow-y-auto">
        <div class="mb-3 px-3">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Menu Utama</p>
        </div>
        <ul class="space-y-1">
            <li>
                <a href="/dashboard" class="{{ request()->is('dashboard') ? 'flex items-center px-4 py-2.5 text-gray-700 bg-pink-100 hover:bg-pink-200 rounded-lg transition-colors group' : 'flex items-center px-4 py-2.5 text-gray-600 hover:bg-pink-50 hover:text-gray-800 rounded-lg transition-colors group' }}">
                    <i class="fas fa-home w-5 h-5 mr-3 {{ request()->is('dashboard') ? 'text-pink-600' : 'text-gray-500 group-hover:text-pink-600' }} transition-colors"></i>
                    <span class="{{ request()->is('dashboard') ? 'font-medium' : '' }}">Dashboard</span>
                </a>
            </li>
        
            <!-- Menu Barang -->
            <li>
                <button @click="activeDropdown = activeDropdown === 'barang' ? null : 'barang'" 
                    class="w-full flex items-center justify-between px-4 py-2.5 text-gray-600 hover:bg-pink-50 hover:text-gray-800 rounded-lg transition-colors group">
                    <div class="flex items-center">
                        <i class="fas fa-box w-5 h-5 mr-3 text-gray-500 group-hover:text-pink-600 transition-colors"></i>
                        <span>Barang</span>
                    </div>
                    <i class="fas" :class="activeDropdown === 'barang' ? 'fa-chevron-down' : 'fa-chevron-right'"></i>
                </button>
                <div x-show="activeDropdown === 'barang'" x-collapse class="pl-12 pr-3 py-1 mt-1 space-y-1">
                    <a href="/barang" class="{{ request()->is('barang*') ? 'flex items-center px-4 py-2.5 text-gray-700 bg-pink-100 hover:bg-pink-200 rounded-lg transition-colors group' : 'flex items-center px-4 py-2.5 text-gray-600 hover:bg-pink-50 hover:text-gray-800 rounded-lg transition-colors group' }}">
                        <i class="fas fa-users w-5 h-5 mr-3 {{ request()->is('barang*') ? 'text-pink-600' : 'text-gray-500 group-hover:text-pink-600' }} transition-colors"></i>
                        <span class="{{ request()->is('barang*') ? 'font-medium' : '' }}">Barang</span>
                    </a>
                    <a href="/kategori-barang" class="block py-2 px-3 text-sm text-gray-600 hover:bg-pink-50 hover:text-pink-700 rounded-lg transition-colors">
                        <i class="fas fas fa-layer-group mr-2"></i> Kategori Barang
                    </a>
                </div>
            </li>
            {{-- contoh alur routenya --}}
            {{-- <li>
                <a href="/pasien" class="{{ request()->is('pasien*') ? 'flex items-center px-4 py-2.5 text-gray-700 bg-pink-100 hover:bg-pink-200 rounded-lg transition-colors group' : 'flex items-center px-4 py-2.5 text-gray-600 hover:bg-pink-50 hover:text-gray-800 rounded-lg transition-colors group' }}">
                    <i class="fas fa-users w-5 h-5 mr-3 {{ request()->is('pasien*') ? 'text-pink-600' : 'text-gray-500 group-hover:text-pink-600' }} transition-colors"></i>
                    <span class="{{ request()->is('pasien*') ? 'font-medium' : '' }}">Pasien</span>
                </a>
            </li> --}}
        </ul>
    </nav>
</aside>

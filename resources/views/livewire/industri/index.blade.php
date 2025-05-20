<div class="p-6 bg-gray-900 min-h-screen text-gray-100 space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Daftar Industri</h1>
            <p class="text-gray-400">Kelola data industri</p>
        </div>

        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
            <!-- Search Bar -->
            <input wire:model.live.debounce.300ms="search" type="text"
                class="w-full md:w-64 px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500"
                placeholder="Cari industri...">

            <!-- Add Industri Button -->
            <a href="{{ route('industri.create') }}"
                class="bg-blue-600 hover:bg-blue-500 text-white font-semibold px-5 py-2 rounded-lg shadow-md text-center">
                Tambah Industri
            </a>
        </div>
    </div>

    <!-- Notification -->
    @if (session()->has('message'))
        <div class="p-4 bg-green-900/50 border-l-4 border-green-500 text-green-100 rounded shadow">
            {{ session('message') }}
        </div>
    @endif

    <!-- Table Section -->
    <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl shadow-xl overflow-hidden border border-gray-700/50">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700/50 text-sm">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-gray-300 uppercase">Nama</th>
                        <th class="px-1 py-3 text-left font-semibold text-gray-300 uppercase">Bidang Usaha</th>
                        <th class="px-10 py-3 text-left font-semibold text-gray-300 uppercase">Alamat</th>
                        <th class="px-5 py-3 text-left font-semibold text-gray-300 uppercase">Kontak</th>
                        <th class="px-5 py-3 text-left font-semibold text-gray-300 uppercase">Email</th>
                        <th class="px-5 py-3 text-left font-semibold text-gray-300 uppercase">Website</th>
                        <th class="px-5 py-3 text-mid font-semibold text-gray-300 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800/30 divide-y divide-gray-700/50">
                    @forelse ($industriList as $industri)
                        <tr class="hover:bg-gray-700/50 transition">
                            <td class="px-7 py-4 text-white font-medium">{{ $industri->nama }}</td>
                            <td class="px-2 py-4 text-gray-300">{{ $industri->bidang_usaha }}</td>
                            <td class="px-10 py-4 text-gray-300">{{ $industri->alamat }}</td>
                            <td class="px-5 py-4 text-gray-300">{{ $industri->kontak }}</td>
                            <td class="px-5 py-4 text-gray-300">{{ $industri->email }}</td>
                            <td class="px-5 py-4 text-gray-300">
                                <a href="{{ $industri->website }}" target="_blank" class="text-blue-400 hover:underline">
                                    {{ $industri->website }}
                                </a>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('industri.show', $industri->id) }}"
                                        class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 rounded">
                                        View
                                    </a>
                                    <a href="{{ route('industri.edit', $industri->id) }}"
                                        class="bg-green-600 hover:bg-green-500 text-white px-3 py-1 rounded">
                                        Edit
                                    </a>
                                    <button wire:click="confirmDelete({{ $industri->id }})"
                                        class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-400">
                                <p class="text-lg mb-1">Tidak ada data industri ditemukan</p>
                                <p class="text-sm">Coba ubah kata kunci pencarian atau tambahkan industri baru</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if ($deleteId)
<div class="fixed inset-0 bg-gray-900/80 backdrop-blur-lg flex items-center justify-center z-50">

    <div class="bg-gray-800 p-6 rounded shadow-lg text-white">
        <p>Yakin ingin menghapus data ini?</p>
        <div class="mt-4 flex justify-end space-x-3">
            <button
                wire:click="delete({{ $deleteId }})"
                class="bg-red-600 hover:bg-red-500 px-4 py-2 rounded transition-colors duration-200"
            >
                Ya
            </button>
            <button
                wire:click="$set('deleteId', null)"
                class="bg-gray-600 hover:bg-gray-500 px-4 py-2 rounded transition-colors duration-200"
            >
                Batal
            </button>
        </div>
    </div>
</div>


@endif
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-400">Menampilkan</span>
            <select wire:model.live="numpage"
                class="bg-gray-800 border border-gray-700 text-white rounded px-3 py-1 text-sm">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <span class="text-sm text-gray-400">data per halaman</span>
        </div>
        <div class="text-white">
            {{ $industriList->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>

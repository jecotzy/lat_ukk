<div class="p-6 bg-gray-900 min-h-screen text-gray-100 space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Daftar Guru</h1>
            <p class="text-gray-400">Kelola data guru</p>
        </div>

        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
            <!-- Search Bar -->
            <input wire:model.debounce.300ms="search" type="text"
                class="w-full md:w-64 px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500"
                placeholder="Cari guru...">

            <!-- Add Guru Button -->
            <a href="{{ route('guru.create') }}"
                class="bg-blue-600 hover:bg-blue-500 text-white font-semibold px-5 py-2 rounded-lg shadow-md text-center">
                Tambah Guru
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
                        <th class="px-7 py-3 text-left font-semibold text-gray-300 uppercase">NIP</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-300 uppercase">Gender</th>
                        <th class="px-10 py-3 text-left font-semibold text-gray-300 uppercase">Alamat</th>
                        <th class="px-5 py-3 text-left font-semibold text-gray-300 uppercase">Kontak</th>
                        <th class="px-30 py-3 text-right font-semibold text-gray-300 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800/30 divide-y divide-gray-700/50">
                    @forelse ($guruList as $guru)
                        <tr class="hover:bg-gray-700/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap flex items-center gap-3">
                                @if ($guru->foto)
                                    <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto {{ $guru->nama }}"
                                        class="h-10 w-10 rounded-full object-cover border border-gray-600">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-700 flex items-center justify-center text-gray-300 font-medium">
                                        {{ substr($guru->nama, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="font-medium text-white">{{ $guru->nama }}</div>
                                    <div class="text-gray-400">{{ $guru->email }}</div>
                                </div>
                            </td>
                            <td class="px-8 py-4 text-gray-200">{{ $guru->nip }}</td>
                            <td class="px-6 py-4 text-gray-200">
                                {{ $this->ketGender($guru->gender) }}
                            </td>
                            <td class="px-10 py-4 text-gray-200">{{ $guru->alamat }}</td>
                            <td class="px-6 py-4 text-gray-300">{{ $guru->kontak }}</td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('guru.show', $guru->id) }}"
                                        class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 rounded">
                                        View
                                    </a>
                                    <a href="{{ route('guru.edit', $guru->id) }}"
                                        class="bg-green-600 hover:bg-green-500 text-white px-3 py-1 rounded">
                                        Edit
                                    </a>
                                    <button wire:click="confirmDelete({{ $guru->id }})"
                                        class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                                <p class="text-lg mb-1">Tidak ada data guru ditemukan</p>
                                <p class="text-sm">Coba ubah kata kunci pencarian atau tambahkan guru baru</p>
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
            <select wire:model="numpage" wire:change="updatePageSize($event.target.value)" id="perPage"
                        class="px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-100 rounded-md">
                    <option value="1">1</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="{{ $guruList->total() }}">semua</option>
            </select>
            <span class="text-sm text-gray-700 dark:text-gray-200">data per halaman</span>

            <span class="text-sm text-gray-400">data per halaman</span>
        </div>
        <div class="text-white">
        {{ $guruList->links() }}
        </div>
    </div>
</div>

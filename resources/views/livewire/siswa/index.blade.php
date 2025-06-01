<div class="p-6 bg-gray-900 min-h-screen text-gray-100 space-y-6">

    <!-- Header Section: Judul dan Tombol Tambah serta Pencarian -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Daftar Siswa</h1>
            <p class="text-gray-400">Kelola data siswa</p>
        </div>

        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
            <!-- Search Bar: Filter data siswa -->
            <input wire:model.live.debounce.300ms="search" type="text"
                class="w-full md:w-64 px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500"
                placeholder="Cari siswa...">

            <!-- Tombol Tambah Siswa -->
            <!-- agar hanya super admin yang melihat -->
            @role('super_admin')
            <a href="{{ route('siswa.create') }}"
                class="bg-blue-600 hover:bg-blue-500 text-white font-semibold px-5 py-2 rounded-lg shadow-md text-center">
                Tambah Siswa
            </a>
            @endrole
        </div>
    </div>

    <!-- Notification: Tampilkan pesan sukses dari session -->
    @if (session()->has('message'))
        <div class="p-4 bg-green-900/50 border-l-4 border-green-500 text-green-100 rounded shadow">
            {{ session('message') }}
        </div>
    @endif

    <!-- Table Section: Tabel daftar siswa -->
    <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl shadow-xl overflow-hidden border border-gray-700/50">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700/50 text-sm">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-gray-300 uppercase">Nama</th>
                        <th class="px-5 py-3 text-left font-semibold text-gray-300 uppercase">NIS</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-300 uppercase">Gender</th>
                        <th class="px-7 py-3 text-left font-semibold text-gray-300 uppercase">Kontak</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-300 uppercase">Status PKL</th>
                        <th class="px-20 py-3 text-mid font-semibold text-gray-300 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800/30 divide-y divide-gray-700/50">
                    <!-- Loop data siswa -->
                    @forelse ($siswaList as $siswa)
                        <tr class="hover:bg-gray-700/50 transition">
                            <!-- Kolom Nama dengan foto profil atau inisial -->
                            <td class="px-6 py-4 whitespace-nowrap flex items-center gap-3">
                                @if ($siswa->foto)
                                    <img src="{{ asset('storage/' . $siswa->foto) }}"
                                         alt="Foto {{ $siswa->nama }}"
                                         class="h-10 w-10 rounded-full object-cover border border-gray-600">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-700 flex items-center justify-center text-gray-300 font-medium">
                                        {{ substr($siswa->nama, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="font-medium text-white">{{ $siswa->nama }}</div>
                                    <div class="text-gray-400">{{ $siswa->email }}</div>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-gray-200">{{ $siswa->nis }}</td>
                            <td class="px-6 py-4 text-gray-200">{{ $this->ketGender($siswa->gender) }}</td>
                            <td class="px-7 py-4 text-gray-300">{{ $siswa->kontak }}</td>

                            <!-- Status PKL dengan badge warna dinamis -->
                            <td class="px-5 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                    {{ $siswa->status_lapor_pkl == 'yes' ? 'bg-green-900/50 text-green-300' : 'bg-amber-900/50 text-amber-300' }}">
                                    {{ $this->ketStatusPKL($siswa->status_lapor_pkl) }}
                                </span>
                            </td>

                            <!-- Kolom Aksi: Tombol View, Edit, Delete -->
                            <td class="px-6 py-4 text-right">
                                @role('super_admin')
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('siswa.show', $siswa->id) }}"
                                        class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 rounded">View</a>
                                        <a href="{{ route('siswa.edit', $siswa->id) }}"
                                        class="bg-green-600 hover:bg-green-500 text-white px-3 py-1 rounded">Edit</a>
                                        <button wire:click="confirmDelete({{ $siswa->id }})"
                                        class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                                    </div>
                                @else
                                    <!-- Jika bukan super_admin: tampilkan View saja dan center -->
                                    <div class="flex justify-center">
                                        <a href="{{ route('siswa.show', $siswa->id) }}"
                                        class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 rounded">View</a>
                                    </div>
                                @endrole
                            </td>
                        </tr>
                    @empty
                        <!-- Pesan jika data siswa kosong -->
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                <p class="text-lg mb-1">Tidak ada data siswa ditemukan</p>
                                <p class="text-sm">Coba ubah kata kunci pencarian atau tambahkan siswa baru</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Modal Konfirmasi Delete -->
            @if ($deleteId)
                <div class="fixed inset-0 bg-gray-900/80 backdrop-blur-lg flex items-center justify-center z-50">
                    <div class="bg-gray-800 p-6 rounded shadow-lg text-white">
                        <p>Yakin ingin menghapus data ini?</p>
                        <div class="mt-4 flex justify-end space-x-3">
                            <button wire:click="delete({{ $deleteId }})"
                                    class="bg-red-600 hover:bg-red-500 px-4 py-2 rounded transition-colors duration-200">
                                Ya
                            </button>
                            <button wire:click="$set('deleteId', null)"
                                    class="bg-gray-600 hover:bg-gray-500 px-4 py-2 rounded transition-colors duration-200">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Pagination dan Pengaturan Jumlah Data per Halaman -->
    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="inline-flex items-center border border-gray-300 dark:border-gray-600 rounded-md overflow-hidden shadow-sm
            bg-gray-800 dark:bg-gray-900 text-gray-200 dark:text-gray-300
            focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500 transition text-sm">
            <span class="px-4 py-2 font-medium border-r border-gray-700 dark:border-gray-700 select-none">
                Menampilkan
            </span>

            <select wire:model="numpage" wire:change="updatePageSize($event.target.value)" id="perPage"
                    class="px-4 py-2 bg-gray-900 dark:bg-gray-800 text-gray-200 dark:text-gray-300
                            focus:outline-none focus:ring-0 cursor-pointer appearance-none">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="{{ $siswaList->total() }}">semua</option>
            </select>

            <span class="px-4 py-2 font-medium border-l border-gray-700 dark:border-gray-700 select-none">
                data per halaman
            </span>
        </div>

        <div class="text-white">
            <!-- Link pagination otomatis dari Laravel -->
            {{ $siswaList->links() }}
        </div>
    </div>

</div>

<div class="p-6 bg-gray-900 min-h-screen text-gray-100 max-w-4xl mx-auto rounded-lg shadow-lg mt-10">
    <!-- Grid Bento -->
    <div class="grid grid-cols-6 grid-rows-4 gap-6">
        <!-- Nama Siswa & Foto -->
        <div class="col-span-3">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm flex items-center justify-between space-x-4">
                <div>
                    <h3 class="font-semibold text-lg text-gray-300">Nama Siswa</h3>
                    <p class="text-white mt-2">{{ $pkl->siswa->nama }}</p>
                </div>
                @if($pkl->siswa->foto)
                    <img src="{{ asset('storage/' . $pkl->siswa->foto) }}"
                         alt="Foto {{ $pkl->siswa->nama }}"
                         class="w-16 h-16 rounded-full object-cover border-2 border-gray-600">
                @else
                    <div class="w-16 h-16 rounded-full bg-gray-600 flex items-center justify-center text-gray-300">
                        N/A
                    </div>
                @endif
            </div>
        </div>

        <!-- Nama Industri -->
        <div class="col-span-3 col-start-4">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm">
                <h3 class="font-semibold text-lg text-gray-300">Industri</h3>
                <p class="text-white mt-2">{{ $pkl->industri->nama }}</p>
            </div>
        </div>

        <!-- Guru Pembimbing -->
        <div class="col-span-3 row-start-2">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm">
                <h3 class="font-semibold text-lg text-gray-300">Guru Pembimbing</h3>
                <p class="text-white mt-2">{{ $pkl->guru->nama }}</p>
            </div>
        </div>

        <!-- Tanggal Mulai -->
        <div class="col-span-3 col-start-4 row-start-2">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm">
                <h3 class="font-semibold text-lg text-gray-300">Tanggal Mulai</h3>
                <p class="text-white mt-2">{{ \Carbon\Carbon::parse($pkl->mulai)->translatedFormat('d F Y') }}</p>
            </div>
        </div>

        <!-- Tanggal Selesai -->
        <div class="col-span-3 row-start-3">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm">
                <h3 class="font-semibold text-lg text-gray-300">Tanggal Selesai</h3>
                <p class="text-white mt-2">{{ \Carbon\Carbon::parse($pkl->selesai)->translatedFormat('d F Y') }}</p>
            </div>
        </div>

        <!-- Lama PKL -->
        <div class="col-span-3 col-start-4 row-start-3">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm">
                <h3 class="font-semibold text-lg text-gray-300">Lama PKL</h3>
                <p class="text-white mt-2">
                    {{ \Carbon\Carbon::parse($pkl->mulai)->diffInWeeks($pkl->selesai) }} Minggu
                </p>
            </div>
        </div>

        <!-- Catatan atau Keterangan Tambahan -->
        <div class="col-span-6 row-start-4">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm text-center">
                <h3 class="font-semibold text-lg text-gray-300">Status</h3>
                <p class="text-white mt-2">
                    PKL dari tanggal {{ \Carbon\Carbon::parse($pkl->mulai)->format('d/m/Y') }}
                    sampai {{ \Carbon\Carbon::parse($pkl->selesai)->format('d/m/Y') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center mt-6">
        <a href="{{ route('pkl') }}"
           class="inline-block bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200">
            Kembali
        </a>
    </div>
</div>

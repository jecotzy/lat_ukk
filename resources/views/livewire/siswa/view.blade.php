<div class="p-6 bg-gray-900 min-h-screen text-gray-100 max-w-4xl mx-auto rounded-lg shadow-lg mt-10">
    <!-- Grid Bento -->
    <div class="grid grid-cols-6 grid-rows-4 gap-6">
        <div class="col-span-3">
    <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm flex items-center justify-between space-x-4">
        <div>
            <h3 class="font-semibold text-lg text-gray-300">Nama</h3>
            <p class="text-white mt-2">{{ $siswa->nama }}</p>
        </div>
        @if($siswa->foto)
            <img src="{{ asset('storage/' . $siswa->foto) }}"
                 alt="Foto {{ $siswa->nama }}"
                 class="w-16 h-16 rounded-full object-cover border-2 border-gray-600">
        @else
            <div class="w-16 h-16 rounded-full bg-gray-600 flex items-center justify-center text-gray-300">
                N/A
            </div>
        @endif
    </div>
</div>

        <div class="col-span-3 col-start-4">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm">
                <h3 class="font-semibold text-lg text-gray-300">NIS</h3>
                <p class="text-white mt-2">{{ $siswa->nis }}</p>
            </div>
        </div>
        <div class="col-span-3 row-start-2">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm">
                <h3 class="font-semibold text-lg text-gray-300">Gender</h3>
                <p class="text-white mt-2">{{ $this->ketGender($siswa->gender) }}</p>
            </div>
        </div>
        <div class="col-span-3 col-start-4 row-start-2">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm">
                <h3 class="font-semibold text-lg text-gray-300">Alamat</h3>
                <p class="text-white mt-2">{{ $siswa->alamat }}</p>
            </div>
        </div>
        <div class="col-span-3 row-start-3">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm">
                <h3 class="font-semibold text-lg text-gray-300">Kontak</h3>
                <p class="text-white mt-2">{{ $siswa->kontak }}</p>
            </div>
        </div>
        <div class="col-span-3 col-start-4 row-start-3">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm">
                <h3 class="font-semibold text-lg text-gray-300">Email</h3>
                <p class="text-white mt-2">{{ $siswa->email }}</p>
            </div>
        </div>
        <div class="col-span-6 row-start-4">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm text-center">
                <h3 class="font-semibold text-lg text-gray-300">Status PKL</h3>
                <p class="text-white mt-2">{{ $this->ketStatusPKL($siswa->status_pkl) }}</p>
            </div>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center mt-6">
        <a href="{{ route('siswa') }}"
           class="inline-block bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200">
            Kembali
        </a>
    </div>
</div>

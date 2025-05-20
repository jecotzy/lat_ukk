<div class="p-6 bg-gray-900 min-h-screen text-gray-100 max-w-4xl mx-auto rounded-lg shadow-lg mt-10">
    <!-- Grid Bento -->
    <div class="grid grid-cols-6 grid-rows-4 gap-6">
        <!-- Nama dan Logo -->
        <div class="col-span-3">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm flex items-center justify-between space-x-4">
                <div>
                    <h3 class="font-semibold text-lg text-gray-300">Nama Industri</h3>
                    <p class="text-white mt-2">{{ $industri->nama }}</p>
                </div>
                @if($industri->logo)
                    <img src="{{ asset('storage/' . $industri->logo) }}"
                         alt="Logo {{ $industri->nama }}"
                         class="w-16 h-16 rounded-full object-cover border-2 border-gray-600">
                @else
                    <div class="w-16 h-16 rounded-full bg-gray-600 flex items-center justify-center text-gray-300">
                        {{ substr($industri->nama, 0, 1) }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Bidang Usaha -->
        <div class="col-span-3 col-start-4">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm">
                <h3 class="font-semibold text-lg text-gray-300">Bidang Usaha</h3>
                <p class="text-white mt-2">{{ $industri->bidang_usaha }}</p>
            </div>
        </div>

        <!-- Alamat -->
        <div class="col-span-3 row-start-2">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm">
                <h3 class="font-semibold text-lg text-gray-300">Alamat</h3>
                <p class="text-white mt-2">{{ $industri->alamat }}</p>
            </div>
        </div>

        <!-- Kontak -->
        <div class="col-span-3 row-start-2">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm">
                <h3 class="font-semibold text-lg text-gray-300">Kontak</h3>
                <p class="text-white mt-2">{{ $industri->kontak }}</p>
            </div>
        </div>

        <!-- Email -->
        <div class="col-span-3 col-start-1 row-start-3">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm">
                <h3 class="font-semibold text-lg text-gray-300">Email</h3>
                <p class="text-white mt-2">{{ $industri->email }}</p>
            </div>
        </div>

        <!-- Website -->
        <div class="col-span-3">
            <div class="bg-gray-800/50 rounded-lg p-4 shadow-sm">
                <h3 class="font-semibold text-lg text-gray-300">Website</h3>
                <p class="text-white mt-2">
                    @if($industri->website)
                        <a href="{{ $industri->website }}" target="_blank" class="text-blue-400 hover:underline">
                            {{ $industri->website }}
                        </a>
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center">
        <a href="{{ route('industri') }}"
           class="inline-block bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200">
            Kembali
        </a>
    </div>
</div>

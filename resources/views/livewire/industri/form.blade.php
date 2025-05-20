<div class="p-6 bg-gray-900 min-h-screen text-gray-100 space-y-6">
    <h1 class="text-2xl font-bold text-white">Form Industri</h1>
    <p class="text-gray-400">Isi data industri dengan lengkap</p>

    @if (session()->has('message'))
        <div class="p-4 bg-green-900/50 border-l-4 border-green-500 text-green-100 rounded shadow">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-5">
        {{-- Nama --}}
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-300">Nama Industri</label>
            <input wire:model.defer="nama" type="text" id="nama"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 mt-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('nama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Bidang Usaha --}}
        <div>
            <label for="bidang_usaha" class="block text-sm font-medium text-gray-300">Bidang Usaha</label>
            <input wire:model.defer="bidang_usaha" type="text" id="bidang_usaha"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 mt-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('bidang_usaha') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Alamat --}}
        <div>
            <label for="alamat" class="block text-sm font-medium text-gray-300">Alamat</label>
            <textarea wire:model.defer="alamat" id="alamat" rows="3"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 mt-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            @error('alamat') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Kontak --}}
        <div>
            <label for="kontak" class="block text-sm font-medium text-gray-300">Kontak</label>
            <input wire:model.defer="kontak" type="text" id="kontak"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 mt-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('kontak') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
            <input wire:model.defer="email" type="email" id="email"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 mt-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Website --}}
        <div>
            <label for="website" class="block text-sm font-medium text-gray-300">Website</label>
            <input wire:model.defer="website" type="text" id="website"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 mt-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('website') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex justify-end mt-6">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-500 text-white font-semibold px-6 py-2 rounded-md shadow">
                Simpan
            </button>
        </div>
    </form>
</div>

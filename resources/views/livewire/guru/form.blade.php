<div class="p-6 max-w-3xl mx-auto bg-gray-900 text-gray-100 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6 text-center text-white">{{ $id ? 'Edit Guru' : 'Tambah Guru' }}</h2>

    @if (session()->has('message'))
        <div class="p-4 bg-green-900/50 border-l-4 border-green-500 text-green-100 rounded shadow">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Nama -->
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-300">Nama</label>
            <input id="nama" type="text" wire:model.defer="nama"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-2 mt-2 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- NIP -->
        <div>
            <label for="nip" class="block text-sm font-medium text-gray-300">NIP</label>
            <input id="nip" type="text" wire:model.defer="nip"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-2 mt-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('nip') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Gender -->
        <div>
            <label class="block text-sm font-medium text-gray-300 mt-2 mb-1">Gender</label>
            <div class="flex gap-6">
                <label class="inline-flex items-center">
                    <input type="radio" wire:model.defer="gender" value="L"
                        class="form-radio text-blue-500 bg-gray-800 border-gray-700" />
                    <span class="ml-2">Laki-laki</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" wire:model.defer="gender" value="P"
                        class="form-radio text-blue-500 bg-gray-800 border-gray-700" />
                    <span class="ml-2">Perempuan</span>
                </label>
            </div>
            @error('gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Kontak -->
        <div>
            <label for="kontak" class="block text-sm font-medium text-gray-300">Kontak</label>
            <input id="kontak" type="text" wire:model.defer="kontak"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-2 mt-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('kontak') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
            <input id="email" type="email" wire:model.defer="email"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-2 mt-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Alamat -->
        <div>
            <label for="alamat" class="block text-sm font-medium text-gray-300">Alamat</label>
            <textarea id="alamat" wire:model.defer="alamat" rows="3"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-2 mt-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
            @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Tombol -->
        <div class="flex justify-between">
            <a href="{{ route('guru') }}"
                class="inline-block bg-gray-700 text-gray-300 px-6 py-3 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200">
                Batal
            </a>

            <button type="submit"
                class="bg-blue-600 cursor-pointer text-white px-6 py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                Simpan
            </button>
        </div>
    </form>
</div>

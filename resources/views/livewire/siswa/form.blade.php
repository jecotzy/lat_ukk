<div class="p-6 max-w-3xl mx-auto bg-gray-900 text-gray-100 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6 text-center text-white">{{ $id ? 'Edit Siswa' : 'Tambah Siswa' }}</h2>

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Nama -->
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-300">Nama</label>
            <input id="nama" type="text" wire:model="nama"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-2 mt-2 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Foto -->
        <div>
            <label for="foto" class="block text-sm font-medium text-gray-300">Foto</label>
            <input id="foto" type="file" wire:model="foto"
                class="w-full text-gray-100 mt-2" />
            @error('foto') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <!-- Preview Foto jika ada -->
            @if ($foto)
                <img src="{{ $foto->temporaryUrl() }}" alt="Preview Foto" class="mt-2 h-24 w-24 object-cover rounded-md border border-gray-600">
            @elseif ($existingFoto)
                <img src="{{ asset('storage/' . $existingFoto) }}" alt="Foto Siswa" class="mt-2 h-24 w-24 object-cover rounded-md border border-gray-600">
            @endif
        </div>


        <!-- NIS -->
        <div>
            <label for="nis" class="block text-sm font-medium text-gray-300">NIS</label>
            <input id="nis" type="text" wire:model="nis"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-2 mt-2 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('nis') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Gender -->
        <div>
            <label class="block text-sm font-medium text-gray-300 mt-2 mb-1">Gender</label>
            <div class="flex gap-6">
                <label class="inline-flex items-center">
                    <input type="radio" wire:model="gender" value="L" class="form-radio text-blue-500 bg-gray-800 border-gray-700" />
                    <span class="ml-2">Laki Laki</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" wire:model="gender" value="P" class="form-radio text-blue-500 bg-gray-800 border-gray-700" />
                    <span class="ml-2">Perempuan</span>
                </label>
            </div>
            @error('gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Alamat -->
        <div>
            <label for="alamat" class="block text-sm font-medium text-gray-300">Alamat</label>
            <textarea id="alamat" wire:model="alamat" rows="2"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-2 mt-2 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
            @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Kontak -->
        <div>
            <label for="kontak" class="block text-sm font-medium text-gray-300">Kontak</label>
            <input id="kontak" type="text" wire:model="kontak"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-2 mt-2 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('kontak') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
            <input id="email" type="email" wire:model="email"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-2 mt-2 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Status PKL -->
        <div>
            <label class="block text-sm font-medium text-gray-300 mt-2 mb-1">Status PKL</label>
            <div class="flex gap-6">
                <label class="inline-flex items-center">
                    <input type="radio" wire:model="status_lapor_pkl" value="no" class="form-radio text-blue-500 bg-gray-800 border-gray-700" />
                    <span class="ml-2">Belum diterima PKL</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" wire:model="status_lapor_pkl" value="yes" class="form-radio text-blue-500 bg-gray-800 border-gray-700" />
                    <span class="ml-2">Sudah diterima PKL</span>
                </label>

            </div>
            @error('status_pkl') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-between">
            <a href="{{ route('siswa') }}"
                class="inline-block bg-gray-700 text-gray-300 px-6 py-3 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200">
                Cancel
            </a>

            <button type="submit"
                class="bg-blue-600 cursor-pointer text-white px-6 py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                Simpan
            </button>
        </div>
    </form>
</div>

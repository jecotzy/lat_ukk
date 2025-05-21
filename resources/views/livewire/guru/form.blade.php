<div class="min-h-screen bg-gray-900 flex items-center justify-center p-6">
  <div class="w-full max-w-lg bg-gray-800 rounded-lg shadow-lg p-8 space-y-6">
    <h1 class="text-3xl font-extrabold text-white mb-2">{{ $id ? 'Edit Guru' : 'Tambah Guru' }}</h1>
    <p class="text-gray-400 mb-6">Silakan isi data guru dengan lengkap</p>

    @if (session()->has('message'))
      <div class="p-4 bg-green-900/70 border-l-4 border-green-500 text-green-100 rounded shadow mb-4 transition duration-300">
        {{ session('message') }}
      </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
      {{-- Nama --}}
      <div>
        <label for="nama" class="block text-sm font-semibold text-gray-300 mb-1">Nama</label>
        <input id="nama" type="text" wire:model.defer="nama"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition" />
        @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- NIP --}}
      <div>
        <label for="nip" class="block text-sm font-semibold text-gray-300 mb-1">NIP</label>
        <input id="nip" type="text" wire:model.defer="nip"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition" />
        @error('nip') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Gender --}}
      <div>
        <label class="block text-sm font-semibold text-gray-300 mb-1">Gender</label>
        <div class="flex gap-6">
          <label class="inline-flex items-center">
            <input type="radio" wire:model.defer="gender" value="L"
              class="form-radio text-blue-500 bg-gray-800 border-gray-600 focus:ring-blue-500" />
            <span class="ml-2 text-gray-200">Laki-laki</span>
          </label>
          <label class="inline-flex items-center">
            <input type="radio" wire:model.defer="gender" value="P"
              class="form-radio text-blue-500 bg-gray-800 border-gray-600 focus:ring-blue-500" />
            <span class="ml-2 text-gray-200">Perempuan</span>
          </label>
        </div>
        @error('gender') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Kontak --}}
      <div>
        <label for="kontak" class="block text-sm font-semibold text-gray-300 mb-1">Kontak</label>
        <input id="kontak" type="text" wire:model.defer="kontak"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition" />
        @error('kontak') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Email --}}
      <div>
        <label for="email" class="block text-sm font-semibold text-gray-300 mb-1">Email</label>
        <input id="email" type="email" wire:model.defer="email"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition" />
        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Alamat --}}
      <div>
        <label for="alamat" class="block text-sm font-semibold text-gray-300 mb-1">Alamat</label>
        <textarea id="alamat" wire:model.defer="alamat" rows="3"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition resize-none"></textarea>
        @error('alamat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Tombol --}}
      <div class="flex justify-between">
        <a href="{{ route('guru') }}"
          class="inline-block bg-gray-700 hover:bg-gray-600 text-gray-200 font-semibold px-6 py-3 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200">
          Batal
        </a>
        <button type="submit"
          class="bg-blue-600 hover:bg-blue-700 active:bg-blue-800 transition text-white font-semibold px-8 py-3 rounded-md shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-400">
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>

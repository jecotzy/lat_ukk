<div class="min-h-screen bg-gray-900 flex items-center justify-center p-6">
  <div class="w-full max-w-lg bg-gray-800 rounded-lg shadow-lg p-8 space-y-6">
    <h1 class="text-3xl font-extrabold text-white mb-2">Form Industri</h1>
    <p class="text-gray-400 mb-6">Isi data industri dengan lengkap</p>

    @if (session()->has('message'))
      <div class="p-4 bg-green-900/70 border-l-4 border-green-500 text-green-100 rounded shadow mb-4 transition duration-300">
        {{ session('message') }}
      </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
      {{-- Nama --}}
      <div>
        <label for="nama" class="block text-sm font-semibold text-gray-300 mb-1">Nama Industri</label>
        <input wire:model.defer="nama" type="text" id="nama"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition" />
        @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Bidang Usaha --}}
      <div>
        <label for="bidang_usaha" class="block text-sm font-semibold text-gray-300 mb-1">Bidang Usaha</label>
        <input wire:model.defer="bidang_usaha" type="text" id="bidang_usaha"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition" />
        @error('bidang_usaha') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Alamat --}}
      <div>
        <label for="alamat" class="block text-sm font-semibold text-gray-300 mb-1">Alamat</label>
        <textarea wire:model.defer="alamat" id="alamat" rows="3"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
        @error('alamat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Kontak --}}
      <div>
        <label for="kontak" class="block text-sm font-semibold text-gray-300 mb-1">Kontak</label>
        <input wire:model.defer="kontak" type="text" id="kontak"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition" />
        @error('kontak') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Email --}}
      <div>
        <label for="email" class="block text-sm font-semibold text-gray-300 mb-1">Email</label>
        <input wire:model.defer="email" type="email" id="email"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition" />
        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Website --}}
      <div>
        <label for="website" class="block text-sm font-semibold text-gray-300 mb-1">Website</label>
        <input wire:model.defer="website" type="text" id="website"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition" />
        @error('website') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Tombol Simpan --}}
      <div class="flex justify-end">
        <button type="submit"
          class="bg-blue-600 hover:bg-blue-700 active:bg-blue-800 transition text-white font-semibold px-8 py-3 rounded-md shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-400">
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>

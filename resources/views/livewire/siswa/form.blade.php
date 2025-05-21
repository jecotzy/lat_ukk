<div class="min-h-screen bg-gray-900 flex items-center justify-center p-6">
  <div class="w-full max-w-lg bg-gray-800 rounded-lg shadow-lg p-8 space-y-6">
    <h1 class="text-3xl font-extrabold text-white mb-2">{{ $id ? 'Edit Siswa' : 'Tambah Siswa' }}</h1>
    <p class="text-gray-400 mb-6">Silakan isi data siswa dengan lengkap</p>

    <form wire:submit.prevent="save" class="space-y-6">
      {{-- Nama --}}
      <div>
        <label for="nama" class="block text-sm font-semibold text-gray-300 mb-1">Nama</label>
        <input id="nama" type="text" wire:model.defer="nama"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition" />
        @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

{{-- Foto --}}
<div>
  <label for="foto" class="block text-sm font-semibold text-gray-300 mb-1">Foto</label>

  <div
    x-data="{ isDragging: false }"
    x-on:dragover.prevent="isDragging = true"
    x-on:dragleave.prevent="isDragging = false"
    x-on:drop.prevent="isDragging = false"
    class="relative w-32 h-32 rounded-full border-2 border-dashed flex items-center justify-center transition duration-200 ease-in-out"
    :class="isDragging ? 'border-blue-500 bg-blue-50 dark:bg-gray-800' : 'border-gray-600'"
  >
    <!-- Input file disembunyikan -->
    <input id="foto" type="file" wire:model="foto" class="hidden" />

    <!-- Label tombol upload -->
    @if (!$foto && !$existingFoto)
    <label for="foto"
      class="absolute inset-0 flex flex-col items-center justify-center cursor-pointer text-gray-400 rounded-full text-center p-2 hover:bg-gray-700/10 transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 16v1a2 2 0 002 2h3m4 0h3a2 2 0 002-2v-1m-6 4V4m0 0L8 8m4-4l4 4" />
      </svg>
      <span class="text-xs">Upload</span>
    </label>
    @endif

    <!-- Preview Foto -->
    @if ($foto || $existingFoto)
    <div class="absolute inset-0">
      <img
        src="{{ $foto ? $foto->temporaryUrl() : asset('storage/' . $existingFoto) }}"
        alt="Preview Foto"
        class="w-full h-full object-cover rounded-full border border-gray-600 shadow"
      />

      <!-- Tombol Hapus -->
      <button
        type="button"
        wire:click="hapusFoto"
        class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-700 transition"
        title="Hapus Foto"
      >
        &times;
      </button>
    </div>
    @endif

    @error('foto')
    <p class="absolute -bottom-6 text-red-500 text-xs text-center w-full">{{ $message }}</p>
    @enderror
  </div>
</div>






      {{-- NIS --}}
      <div>
        <label for="nis" class="block text-sm font-semibold text-gray-300 mb-1">NIS</label>
        <input id="nis" type="tel" wire:model.defer="nis" pattern="[0-9]*" inputmode="numeric"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition" />
        @error('nis') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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

      {{-- Alamat --}}
      <div>
        <label for="alamat" class="block text-sm font-semibold text-gray-300 mb-1">Alamat</label>
        <textarea id="alamat" wire:model.defer="alamat" rows="3"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 resize-none focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
        @error('alamat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Kontak --}}
      <div>
        <label for="kontak" class="block text-sm font-semibold text-gray-300 mb-1">Kontak</label>
        <input id="kontak" type="tel" wire:model.defer="kontak" pattern="[0-9]*" inputmode="numeric"
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

      {{-- Status PKL --}}
      <div>
        <label class="block text-sm font-semibold text-gray-300 mb-1">Status PKL</label>
        <div class="flex gap-6">
          <label class="inline-flex items-center">
            <input type="radio" wire:model.defer="status_lapor_pkl" value="no"
              class="form-radio text-blue-500 bg-gray-800 border-gray-600 focus:ring-blue-500" />
            <span class="ml-2 text-gray-200">Belum diterima PKL</span>
          </label>
          <label class="inline-flex items-center">
            <input type="radio" wire:model.defer="status_lapor_pkl" value="yes"
              class="form-radio text-blue-500 bg-gray-800 border-gray-600 focus:ring-blue-500" />
            <span class="ml-2 text-gray-200">Sudah diterima PKL</span>
          </label>
        </div>
        @error('status_lapor_pkl') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Tombol --}}
      <div class="flex justify-between">
        <a href="{{ route('siswa') }}"
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

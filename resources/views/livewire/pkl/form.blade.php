<div class="min-h-screen bg-gray-900 flex items-center justify-center p-6">
  <div class="w-full max-w-lg bg-gray-800 rounded-lg shadow-lg p-8 space-y-6">
    <h1 class="text-3xl font-extrabold text-white mb-2">Form PKL</h1>
    <p class="text-gray-400 mb-6">Isi data Praktik Kerja Lapangan dengan lengkap</p>

    @if (session()->has('message'))
      <div class="p-4 bg-green-900/70 border-l-4 border-green-500 text-green-100 rounded shadow mb-4 transition duration-300">
        {{ session('message') }}
      </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
      {{-- Siswa --}}
      <div>
          <label for="siswa_id" class="block text-sm font-semibold text-gray-300 mb-1">Siswa</label>
            <select wire:model.defer="siswa_id" id="siswa_id"
              class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition">
              <option value="">-- Pilih Siswa --</option>
              @foreach ($siswaList as $siswa)
              <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
              @endforeach
            </select>
          @error('siswa_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
      </div>

      {{-- Industri --}}
      <div>
        <label for="industri_id" class="block text-sm font-semibold text-gray-300 mb-1">Industri</label>
        <select wire:model.defer="industri_id" id="industri_id"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition">
          <option value="">-- Pilih Industri --</option>
          @foreach ($industriList as $industri)
            <option value="{{ $industri->id }}">{{ $industri->nama }}</option>
          @endforeach
        </select>
        @error('industri_id')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Guru --}}
      <div>
        <label for="guru_id" class="block text-sm font-semibold text-gray-300 mb-1">Guru Pembimbing</label>
        <select wire:model.defer="guru_id" id="guru_id"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition">
          <option value="">-- Pilih Guru --</option>
          @foreach ($guruList as $guru)
            <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
          @endforeach
        </select>
        @error('guru_id')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Tanggal Mulai --}}
      <div>
        <label for="mulai" class="block text-sm font-semibold text-gray-300 mb-1">Tanggal Mulai</label>
        <input wire:model.defer="mulai" type="date" id="mulai"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition" />
        @error('mulai')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Tanggal Selesai --}}
      <div>
        <label for="selesai" class="block text-sm font-semibold text-gray-300 mb-1">Tanggal Selesai</label>
        <input wire:model.defer="selesai" type="date" id="selesai"
          class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-3 text-gray-100 focus:outline-none focus:ring-3 focus:ring-blue-500 focus:border-blue-500 transition" />
        @error('selesai')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Tombol Simpan --}}
      <div class="flex justify-end">
        <button type="submit"
          class="bg-blue-600 hover:bg-blue-700 active:bg-blue-800 transition text-white font-semibold px-8 py-3 rounded-md shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-400">
          Simpan
        </button>
      </div>
    </form>
          {{-- Tombol Simpan --}}
      <div class="flex justify-end">
        <button type="submit"
          class="bg-blue-600 hover:bg-blue-700 active:bg-blue-800 transition text-white font-semibold px-8 py-3 rounded-md shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-400">
          Simpan
        </button>
      </div>
      @if ($showDuplicateModal)
        <div class="fixed inset-0 bg-gray-900/80 backdrop-blur-lg flex items-center justify-center z-50">
            <div class="bg-gray-800 p-6 rounded shadow-lg text-white max-w-md w-full">
                <h2 class="text-lg font-bold mb-4">Sudah Melaporkan PKL</h2>
                <p class="text-gray-300">
                    Anda sudah pernah menambahkan laporan PKL sebelumnya. Anda hanya dapat menambahkan satu laporan.
                </p>

                <div class="mt-6 flex justify-end space-x-3">
                    <button wire:click="$set('showDuplicateModal', false)"
                            class="bg-gray-600 hover:bg-gray-500 px-4 py-2 rounded transition-colors duration-200">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif
  </div>
</div>

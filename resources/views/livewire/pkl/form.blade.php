<div class="p-6 bg-gray-900 min-h-screen text-gray-100 space-y-6">
    <h1 class="text-2xl font-bold text-white">Form PKL</h1>
    <p class="text-gray-400">Isi data Praktik Kerja Lapangan dengan lengkap</p>

    @if (session()->has('message'))
        <div class="p-4 bg-green-900/50 border-l-4 border-green-500 text-green-100 rounded shadow">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-5">
        {{-- Siswa --}}
        <div>
            <label for="siswa_id" class="block text-sm font-medium text-gray-300">Siswa</label>
            <select wire:model.defer="siswa_id" id="siswa_id"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 mt-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih Siswa --</option>
                @foreach ($siswaList as $siswa)
                    <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                @endforeach
            </select>
            @error('siswa_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Industri --}}
        <div>
            <label for="industri_id" class="block text-sm font-medium text-gray-300">Industri</label>
            <select wire:model.defer="industri_id" id="industri_id"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 mt-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih Industri --</option>
                @foreach ($industriList as $industri)
                    <option value="{{ $industri->id }}">{{ $industri->nama }}</option>
                @endforeach
            </select>
            @error('industri_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Guru --}}
        <div>
            <label for="guru_id" class="block text-sm font-medium text-gray-300">Guru Pembimbing</label>
            <select wire:model.defer="guru_id" id="guru_id"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 mt-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih Guru --</option>
                @foreach ($guruList as $guru)
                    <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                @endforeach
            </select>
            @error('guru_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Tanggal Mulai --}}
        <div>
            <label for="mulai" class="block text-sm font-medium text-gray-300">Tanggal Mulai</label>
            <input wire:model.defer="mulai" type="date" id="mulai"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 mt-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('mulai') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Tanggal Selesai --}}
        <div>
            <label for="selesai" class="block text-sm font-medium text-gray-300">Tanggal Selesai</label>
            <input wire:model.defer="selesai" type="date" id="selesai"
                class="w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 mt-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('selesai') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
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

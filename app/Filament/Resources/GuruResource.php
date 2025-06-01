<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuruResource\Pages;  // Namespace untuk halaman CRUD Guru
use App\Models\Guru;                            // Model Guru
use Filament\Forms;                            // Form builder Filament
use Filament\Forms\Form;                        // Kelas Form Filament
use Filament\Resources\Resource;               // Kelas Resource dasar Filament
use Filament\Tables;                           // Helper tabel Filament
use Filament\Tables\Table;                      // Kelas Table Filament

class GuruResource extends Resource
{
    // Tentukan model yang digunakan resource ini
    protected static ?string $model = Guru::class;

    // Ikon sidebar menu untuk resource ini, menggunakan ikon topi akademik
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    // Grup menu sidebar, di sini dikelompokkan di 'Master Data'
    protected static ?string $navigationGroup = 'Master Data';

    // Definisi form input untuk create dan edit data guru
    public static function form(Form $form): Form
    {
        return $form->schema([
            // Input teks nama guru, wajib diisi
            Forms\Components\TextInput::make('nama')->required(),

            // Input teks NIP (Nomor Induk Pegawai), wajib diisi
            Forms\Components\TextInput::make('nip')->required(),

            // Dropdown select gender, opsi 'L' (Laki-laki) dan 'P' (Perempuan), wajib diisi
            Forms\Components\Select::make('gender')
                ->options(['L' => 'Laki-laki', 'P' => 'Perempuan'])
                ->required(),

            // Textarea alamat guru, wajib diisi
            Forms\Components\Textarea::make('alamat')->required(),

            // Input kontak (nomor telepon atau lainnya), wajib diisi
            Forms\Components\TextInput::make('kontak')->required(),

            // Input email, wajib dan harus valid format email
            Forms\Components\TextInput::make('email')->email()->required(),
        ]);
    }

    // Definisi kolom tabel pada halaman list guru
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom nama guru yang bisa dicari (searchable)
                Tables\Columns\TextColumn::make('nama')->searchable(),

                // Kolom NIP guru
                Tables\Columns\TextColumn::make('nip'),

                // Kolom gender guru
                Tables\Columns\TextColumn::make('gender'),

                // Kolom email guru
                Tables\Columns\TextColumn::make('email'),
            ])
            ->actions([
                // Tombol edit untuk setiap baris data guru
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Aksi massal hapus data guru yang dipilih
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // Relasi terkait resource ini (kosong, bisa diisi jika ada relasi)
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // Halaman-halaman CRUD untuk resource Guru
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGurus::route('/'),           // Halaman daftar guru
            'create' => Pages\CreateGuru::route('/create'),  // Halaman tambah guru baru
            'edit' => Pages\EditGuru::route('/{record}/edit'),// Halaman edit data guru
        ];
    }
}

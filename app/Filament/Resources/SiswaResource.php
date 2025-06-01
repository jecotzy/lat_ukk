<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;  // Namespace halaman CRUD untuk resource Siswa
use App\Models\Siswa;                            // Model Siswa
use Filament\Forms;                             // Form builder Filament
use Filament\Forms\Form;                         // Form Filament
use Filament\Resources\Resource;                // Kelas dasar resource Filament
use Filament\Tables;                            // Helper tabel Filament
use Filament\Tables\Table;                      // Kelas tabel Filament

class SiswaResource extends Resource
{
    // Model yang digunakan resource ini
    protected static ?string $model = Siswa::class;

    // Ikon di menu navigasi sidebar Filament
    protected static ?string $navigationIcon = 'heroicon-o-user';

    // Grup menu di sidebar, contoh: "Master Data"
    protected static ?string $navigationGroup = 'Master Data';

    // Definisi form input untuk create & edit data siswa
    public static function form(Form $form): Form
    {
       return $form->schema([
            // Input teks untuk nama siswa, wajib diisi
            Forms\Components\TextInput::make('nama')->required(),

            // Input teks untuk NIS, wajib dan harus unik kecuali saat edit (ignoreRecord)
            Forms\Components\TextInput::make('nis')->required()->unique(ignoreRecord: true),

            // Dropdown select untuk jenis kelamin, opsi L (Laki-laki) dan P (Perempuan), wajib diisi
            Forms\Components\Select::make('gender')
                ->options(['L' => 'Laki-laki', 'P' => 'Perempuan'])->required(),

            // Textarea untuk alamat, wajib diisi
            Forms\Components\Textarea::make('alamat')->required(),

            // Input teks untuk kontak (nomor telepon atau lainnya), wajib diisi
            Forms\Components\TextInput::make('kontak')->required(),

            // Input email, wajib dan harus valid format email
            Forms\Components\TextInput::make('email')->email()->required(),

            // Upload foto, hanya menerima file gambar, disimpan di folder "foto_siswa"
            Forms\Components\FileUpload::make('foto')->image()->directory('foto_siswa'),

            // Dropdown select untuk status pelaporan PKL, opsi 'no' dan 'yes', wajib diisi
            Forms\Components\Select::make('status_lapor_pkl')
                ->options(['no' => 'Belum Lapor', 'yes' => 'Sudah Lapor'])
                ->required(),
        ]);
    }

    // Definisi tabel data siswa yang ditampilkan di halaman list
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom foto siswa, tampil sebagai gambar melingkar, ambil dari disk 'public'
                Tables\Columns\ImageColumn::make('foto')
                    ->disk('public')
                    ->label('Foto')
                    ->circular(),

                // Kolom nama siswa, bisa dicari (searchable)
                Tables\Columns\TextColumn::make('nama')->searchable(),

                // Kolom NIS siswa
                Tables\Columns\TextColumn::make('nis'),

                // Kolom gender siswa
                Tables\Columns\TextColumn::make('gender'),

                // Kolom email siswa
                Tables\Columns\TextColumn::make('email'),

                // Kolom status lapor PKL siswa
                Tables\Columns\TextColumn::make('status_lapor_pkl'),
            ])
            ->filters([
                // Belum ada filter yang ditambahkan, bisa ditambahkan nanti
            ])
            ->actions([
                // Tindakan per baris: tombol edit
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tindakan massal: hapus beberapa data sekaligus
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // Definisi relasi tambahan (kosong di sini)
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // Definisi halaman CRUD dan rute untuk resource siswa
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiswas::route('/'),           // Halaman daftar siswa
            'create' => Pages\CreateSiswa::route('/create'),   // Halaman buat siswa baru
            'edit' => Pages\EditSiswa::route('/{record}/edit'),// Halaman edit data siswa
        ];
    }
}

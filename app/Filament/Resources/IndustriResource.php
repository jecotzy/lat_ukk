<?php

// Namespace tempat resource ini berada
namespace App\Filament\Resources;

// Import class halaman yang digunakan (List, Create, Edit)
use App\Filament\Resources\IndustriResource\Pages;

// Import model Industri
use App\Models\Industri;

// Import komponen dari Filament untuk form
use Filament\Forms;
use Filament\Forms\Form;

// Import komponen dasar Resource dari Filament
use Filament\Resources\Resource;

// Import komponen dari Filament untuk tabel
use Filament\Tables;
use Filament\Tables\Table;

class IndustriResource extends Resource
{
    // Menentukan model utama yang digunakan dalam resource ini
    protected static ?string $model = Industri::class;

    // Menentukan ikon yang digunakan pada menu navigasi sidebar
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    // Menempatkan resource ini ke dalam grup menu bernama "Master Data"
    protected static ?string $navigationGroup = 'Master Data';

    // Fungsi untuk mendefinisikan form create dan edit
    public static function form(Form $form): Form
    {
        return $form->schema([
            // Input teks untuk nama industri (wajib diisi)
            Forms\Components\TextInput::make('nama')->required(),

            // Input teks untuk bidang usaha (wajib diisi)
            Forms\Components\TextInput::make('bidang_usaha')->required(),

            // Textarea untuk alamat industri (wajib diisi)
            Forms\Components\Textarea::make('alamat')->required(),

            // Input teks untuk kontak (wajib diisi)
            Forms\Components\TextInput::make('kontak')->required(),

            // Input email (dengan validasi format email, wajib diisi)
            Forms\Components\TextInput::make('email')->email()->required(),

            // Input teks untuk website (dengan validasi URL, opsional)
            Forms\Components\TextInput::make('website')->url(),
        ]);
    }

    // Fungsi untuk mendefinisikan tampilan tabel (halaman index)
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom teks untuk nama industri (dapat dicari)
                Tables\Columns\TextColumn::make('nama')->searchable(),

                // Kolom teks untuk bidang usaha
                Tables\Columns\TextColumn::make('bidang_usaha'),

                // Kolom teks untuk email
                Tables\Columns\TextColumn::make('email'),

                // Kolom teks untuk website (maksimal 20 karakter ditampilkan)
                Tables\Columns\TextColumn::make('website')->limit(20),
            ])
            // Aksi untuk mengedit data per baris
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            // Aksi massal (bulk) untuk menghapus beberapa data sekaligus
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // Fungsi untuk mendefinisikan relasi (jika ada), saat ini kosong
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // Fungsi untuk mendefinisikan halaman-halaman yang tersedia dalam resource ini
    public static function getPages(): array
    {
        return [
            // Halaman index (list industri)
            'index' => Pages\ListIndustris::route('/'),

            // Halaman tambah industri
            'create' => Pages\CreateIndustri::route('/create'),

            // Halaman edit industri (dengan parameter record)
            'edit' => Pages\EditIndustri::route('/{record}/edit'),
        ];
    }
}

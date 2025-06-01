<?php

// Namespace untuk resource Filament
namespace App\Filament\Resources;

// Import halaman-halaman PKL (List, Create, Edit)
use App\Filament\Resources\PklResource\Pages;

// Import model PKL
use App\Models\Pkl;

// Import komponen form dari Filament
use Filament\Forms;
use Filament\Forms\Form;

// Import resource base dari Filament
use Filament\Resources\Resource;

// Import komponen tabel dari Filament
use Filament\Tables;
use Filament\Tables\Table;

class PklResource extends Resource
{
    // Model utama yang digunakan oleh resource ini
    protected static ?string $model = Pkl::class;

    // Ikon menu di sidebar
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    // Kelompok menu di sidebar
    protected static ?string $navigationGroup = 'PKL';

    // Form untuk create dan edit data PKL
    public static function form(Form $form): Form
    {
        return $form->schema([
            // Dropdown untuk memilih siswa, menggunakan relasi `siswa` dan menampilkan field `nama`
            Forms\Components\Select::make('siswa_id')
                ->relationship('siswa', 'nama')
                ->searchable()
                ->required()
                ->preload(),

            // Dropdown untuk memilih guru pembimbing
            Forms\Components\Select::make('guru_id')
                ->relationship('guru', 'nama')
                ->searchable()
                ->required()
                ->preload(),

            // Dropdown untuk memilih industri tempat PKL
            Forms\Components\Select::make('industri_id')
                ->relationship('industri', 'nama')
                ->searchable()
                ->required()
                ->preload(),

            // Tanggal mulai PKL
            Forms\Components\DatePicker::make('mulai')->required(),

            // Tanggal selesai PKL
            Forms\Components\DatePicker::make('selesai'),
        ]);
    }

    // Tabel untuk halaman list data PKL
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Menampilkan nama siswa dari relasi
                Tables\Columns\TextColumn::make('siswa.nama')
                    ->label('Siswa')
                    ->searchable(),

                // Menampilkan nama guru pembimbing dari relasi
                Tables\Columns\TextColumn::make('guru.nama')
                    ->label('Guru')
                    ->searchable(),

                // Menampilkan nama industri dari relasi
                Tables\Columns\TextColumn::make('industri.nama')
                    ->label('Industri')
                    ->searchable(),

                // Tanggal mulai PKL
                Tables\Columns\TextColumn::make('mulai'),

                // Tanggal selesai PKL
                Tables\Columns\TextColumn::make('selesai'),
            ])
            // Aksi edit per baris
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            // Aksi hapus massal (bulk delete)
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // Relasi tambahan (jika ada), untuk saat ini kosong
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // Halaman-halaman terkait: index (list), create, edit
    public static function getPages(): array
    {
         return [
            'index' => Pages\ListPkls::route('/'),
            'create' => Pages\CreatePkl::route('/create'),
            'edit' => Pages\EditPkl::route('/{record}/edit'),
        ];
    }
}

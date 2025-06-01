<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;  // Namespace untuk halaman CRUD
use App\Models\User;                             // Model User
use Filament\Forms\Form;                         // Form builder Filament
use Filament\Resources\Resource;                 // Kelas dasar resource Filament
use Filament\Tables;                             // Helper tabel Filament
use Filament\Tables\Table;                       // Kelas tabel Filament
use Filament\Forms\Components\TextInput;        // Komponen input teks
use Filament\Tables\Columns\TextColumn;          // Kolom teks di tabel
use Filament\Tables\Columns\BadgeColumn;         // Kolom badge (label warna) di tabel
use Illuminate\Support\Facades\Hash;            // Untuk hash password
use Filament\Forms\Components\Grid;              // Grid layout form
use Filament\Forms\Components\Select;            // Komponen dropdown/select

class UserResource extends Resource
{
    // Model yang digunakan resource ini
    protected static ?string $model = User::class;

    // Ikon yang muncul di sidebar navigasi Filament
    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'User';

    // Label navigasi yang tampil di sidebar
    protected static ?string $navigationLabel = 'Users';

    // Label plural untuk model
    protected static ?string $pluralModelLabel = 'Users';

    // Label tunggal untuk model
    protected static ?string $modelLabel = 'User';

    // Urutan posisi menu di navigasi
    protected static ?int $navigationSort = 1;

    // Definisi form untuk create & edit User
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Gunakan grid 2 kolom untuk layout inputan
                Grid::make(2)
                    ->schema([
                        // Input untuk nama user, wajib diisi, maksimal 255 karakter
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        // Input email, wajib, harus format email, unik (abaikan record saat edit)
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),

                        // Input password, tipe password
                        TextInput::make('password')
                            ->password()
                            // Jika ada input password baru, hash sebelum simpan
                            ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                            // Password hanya disimpan jika ada input, tidak wajib di edit
                            ->dehydrated(fn ($state) => filled($state))
                            ->maxLength(255)
                            ->label('Password'),

                        // Dropdown select untuk roles (relasi many-to-many)
                        Select::make('roles')
                            ->relationship('roles', 'name') // ambil nama role dari relasi roles
                            ->multiple()                    // bisa pilih banyak role
                            ->preload()                    // preload data agar cepat saat form ditampilkan
                            ->label('Roles'),
                    ]),
            ]);
    }

    // Definisi tabel untuk daftar data User
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom nama user, bisa di-sort dan di-search
                TextColumn::make('name')->sortable()->searchable(),

                // Kolom email user, bisa di-sort dan di-search
                TextColumn::make('email')->sortable()->searchable(),

                // Kolom badge untuk role, tampil dengan warna primary dan label "Roles"
                BadgeColumn::make('roles.name')
                    ->colors(['primary'])
                    ->label('Roles'),
            ])
            ->filters([
                // Bisa ditambahkan filter custom di sini jika perlu
            ])
            ->actions([
                // Tindakan per baris data: edit dan hapus
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tindakan massal: hapus banyak data sekaligus
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // Relasi tambahan yang bisa ditampilkan di resource ini (kosong di sini)
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // Mendefinisikan rute halaman untuk resource User
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),            // Halaman list user
            'create' => Pages\CreateUser::route('/create'),    // Halaman buat user baru
            'edit' => Pages\EditUser::route('/{record}/edit'), // Halaman edit user
        ];
    }
}

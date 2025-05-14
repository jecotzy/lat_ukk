<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Filament\Resources\SiswaResource\RelationManagers;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Master Data';


    public static function form(Form $form): Form
    {
       return $form->schema([
            Forms\Components\TextInput::make('nama')->required(),
            Forms\Components\TextInput::make('nis')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('gender')
                ->options(['L' => 'Laki-laki', 'P' => 'Perempuan'])->required(),
            Forms\Components\Textarea::make('alamat')->required(),
            Forms\Components\TextInput::make('kontak')->required(),
            Forms\Components\TextInput::make('email')->email()->required(),
            Forms\Components\FileUpload::make('foto')->image()->directory('fotosiswa'),
            Forms\Components\Select::make('status_lapor_pkl')
                ->options(['no' => 'Belum Lapor', 'yes' => 'Sudah Lapor'])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('nama')->searchable(),
            Tables\Columns\TextColumn::make('nis'),
            Tables\Columns\TextColumn::make('gender'),
            Tables\Columns\TextColumn::make('email'),
            Tables\Columns\TextColumn::make('status_lapor_pkl'),
        ])->filters([])->actions([
            Tables\Actions\EditAction::make(),
        ])->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}

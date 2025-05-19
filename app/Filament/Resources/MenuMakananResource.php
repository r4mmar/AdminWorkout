<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuMakananResource\Pages;
use App\Models\MenuMakanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class MenuMakananResource extends Resource
{
    protected static ?string $model = MenuMakanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_makanan')
                    ->label('Nama Makanan')
                    ->required()
                    ->maxLength(255),

                TextInput::make('kalori')
                    ->label('Kalori')
                    ->numeric()
                    ->required(),

                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->nullable(),

                FileUpload::make('image')
                    ->label('Gambar')
                    ->image()
                    ->directory('menu-makanan') // Simpan di storage/app/public/menu-makanan
                    ->visibility('public') // Tambahkan ini agar dapat diakses publik
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_makanan')->label('Nama Makanan')->sortable()->searchable(),
                TextColumn::make('kalori')->label('Kalori')->sortable(),
                TextColumn::make('deskripsi')->label('Deskripsi')->limit(50),
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->disk('public') // storage/app/public
                    ->visibility('public')
                    ->height(60)
                    ->rounded(),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenuMakanans::route('/'),
            'create' => Pages\CreateMenuMakanan::route('/create'),
            'edit' => Pages\EditMenuMakanan::route('/{record}/edit'),
        ];
    }
}

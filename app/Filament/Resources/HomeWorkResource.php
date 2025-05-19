<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeWorkResource\Pages;
use App\Models\HomeWork;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class HomeWorkResource extends Resource
{
    protected static ?string $model = HomeWork::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_latihan')
                    ->label('Nama Latihan')
                    ->required()
                    ->maxLength(255),

                Select::make('kategori')
                    ->label('Kategori')
                    ->required()
                    ->options([
                        'Latihan Kardio' => 'Latihan Kardio',
                        'Latihan Kekuatan' => 'Latihan Kekuatan',
                        'Latihan Fleksibilitas & Mobilitas' => 'Latihan Fleksibilitas & Mobilitas',
                        'Latihan Keseimbangan dan Stabilitas' => 'Latihan Keseimbangan dan Stabilitas',
                        'HIIT' => 'HIIT (High Intensity Interval Training)',
                        'Latihan Ringan untuk Pemula / Rehabilitasi' => 'Latihan Ringan untuk Pemula / Rehabilitasi',
                    ]),

                Select::make('alat')
                    ->label('Alat')
                    ->required()
                    ->options([
                        'tanpa alat' => 'Tanpa Alat',
                        'dengan alat' => 'Dengan Alat',
                    ]),

                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_latihan')->label('Nama Latihan')->sortable()->searchable(),
                TextColumn::make('kategori')->label('Kategori')->sortable(),
                TextColumn::make('alat')->label('Alat')->sortable(),
                TextColumn::make('deskripsi')->label('Deskripsi')->limit(50),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHomeWorks::route('/'),
            'create' => Pages\CreateHomeWork::route('/create'),
            'edit' => Pages\EditHomeWork::route('/{record}/edit'),
        ];
    }
}

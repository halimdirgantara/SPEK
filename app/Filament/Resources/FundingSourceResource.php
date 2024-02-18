<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FundingSourceResource\Pages;
use App\Filament\Resources\FundingSourceResource\RelationManagers;
use App\Models\FundingSource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FundingSourceResource extends Resource
{
    protected static ?string $model = FundingSource::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListFundingSources::route('/'),
            'create' => Pages\CreateFundingSource::route('/create'),
            'edit' => Pages\EditFundingSource::route('/{record}/edit'),
        ];
    }
}

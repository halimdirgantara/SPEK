<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Filament\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('package_link')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('organization_id')
                    ->required()
                    ->numeric(),
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('package_code')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('package_name')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('institution_name')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('work_unit')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('budget_year')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('work_volume')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\IconColumn::make('domestic_products')
                //     ->boolean(),
                // Tables\Columns\IconColumn::make('small_business')
                //     ->boolean(),
                // Tables\Columns\IconColumn::make('spp_economic_aspect')
                //     ->boolean(),
                // Tables\Columns\IconColumn::make('spp_social_aspect')
                //     ->boolean(),
                // Tables\Columns\IconColumn::make('spp_environmental_aspect')
                //     ->boolean(),
                // Tables\Columns\IconColumn::make('pre_dipa_dpa')
                //     ->boolean(),
                // Tables\Columns\TextColumn::make('total_budget')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('procurement_type')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('procurement_method')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('utilization_start')
                //     ->date()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('utilization_end')
                //     ->date()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('contract_start')
                //     ->date()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('contract_end')
                //     ->date()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('provider_selection_start')
                //     ->date()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('provider_selection_end')
                //     ->date()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('package_update_date')
                //     ->dateTime()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('organization_id')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('created_by')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}

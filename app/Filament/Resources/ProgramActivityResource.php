<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Organization;
use App\Models\ProgramActivity;
use Filament\Resources\Resource;
use App\Filament\Resources\ProgramActivityResource\Pages;

class ProgramActivityResource extends Resource
{
    protected static ?string $model = ProgramActivity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(12),
                Forms\Components\TextInput::make('account_number')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(12),
                Forms\Components\Select::make('type')
                    ->options([
                        'program' => 'Program',
                        'kegiatan' => 'Kegiatan',
                        'sub-kegiatan' => 'Sub Kegiatan',
                    ])
                    ->native(false)
                    ->columnSpan(12),
                Forms\Components\Select::make('parent_id')
                    ->label('Parent')
                    ->options(ProgramActivity::all()->pluck('name', 'id'))
                    ->searchable()
                    ->columnSpan(12),
                Forms\Components\Select::make('organization_id')
                    ->label('Organization')
                    ->options(Organization::all()->pluck('name', 'id'))
                    ->searchable()
                    ->columnSpan(12),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('account_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('parent.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('organization.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('creator.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListProgramActivities::route('/'),
            'create' => Pages\CreateProgramActivity::route('/create'),
            'edit' => Pages\EditProgramActivity::route('/{record}/edit'),
        ];
    }
}

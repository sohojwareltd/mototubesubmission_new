<?php

namespace App\Filament\Resources\Videos\Tables;

use App\Models\Video;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VideosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('full_name')
                    ->label('Name')
                    ->state(fn (Video $record): string => trim("{$record->first_name} {$record->last_name}"))
                    ->searchable(['first_name', 'last_name']),
                TextColumn::make('email')->searchable(),
                TextColumn::make('person_who_filmed')->label('Filmed By'),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutUsResource\Pages;
use App\Filament\Resources\AboutUsResource\RelationManagers;
use App\Models\AboutUs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutUsResource extends Resource
{
    protected static ?string $model = AboutUs::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

       public static function can(string $ability, $record = null): bool
    {
        return true;
    }
    public static function form(Form $form): Form
    {
        return $form
             ->schema([
                Forms\Components\Textarea::make('content')
                    ->label('About Us')
                    ->required()
                    ->rows(10)
                    ->placeholder('Enter About Us text...'),

                Forms\Components\TextInput::make('phone')
                    ->label('Phone Number')
                    ->required()
                    ->maxLength(10)
                    ->tel()
                    ->placeholder('+963...'),

                Forms\Components\TextInput::make('facebook')
                    ->label('Facebook')
                    ->nullable()
                    ->url(),

                Forms\Components\TextInput::make('instagram')
                    ->label('Instagram')
                    ->nullable()
                    ->url(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
           ->columns([
                Tables\Columns\TextColumn::make('content')->limit(50),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('facebook')->limit(30),
                Tables\Columns\TextColumn::make('instagram')->limit(30),
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
            'index' => Pages\ListAboutUs::route('/'),
            'create' => Pages\CreateAboutUs::route('/create'),
            'edit' => Pages\EditAboutUs::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceProviderResource\Pages;
use App\Filament\Resources\ServiceProviderResource\RelationManagers;
use App\Models\ServiceProvider;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceProviderResource extends Resource
{
    protected static ?string $model = ServiceProvider::class;

    protected static ?string $navigationIcon = 'heroicon-s-clipboard';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with('tags')
            ->orderByDesc('views');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('provider_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('shop_name')
                    ->maxLength(255)
                    ->required()
                    ->default(null),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->Length(10) ->minLength(10)
    ->maxLength(10)
                    ->default(null),
                Forms\Components\TextInput::make('whatsapp')
                    ->length(10)
                    ->maxLength(10)
                    ->default(null),
                Forms\Components\TextInput::make('facebook')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('instagram')
                    ->maxLength(255)
                    ->default(null),
                SpatieMediaLibraryFileUpload::make('image')
                   ->collection('image')
                    ->image()
                    ->disk('public')
                    ->directory('service_providers')
                    ->preserveFilenames()
                    ->required(),
                Forms\Components\Textarea::make('gallery')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('contract_start')
                    ->required()
                    ->default(now()->startOfDay())
                    ->beforeOrEqual(now()),
                Forms\Components\DatePicker::make('contractd')
                    ->required()
                    ->after(fn($get) => $get('contract_start')),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('inactive'),
                Forms\Components\TextInput::make('views')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('category_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('subcategory_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('state_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('city_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('tag')
                    ->relationship('tags', 'name')
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('provider_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shop_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('whatsapp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('facebook')
                    ->searchable(),
                Tables\Columns\TextColumn::make('instagram')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->getStateUsing(fn($record) => $record->getFirstMediaUrl('image')),

                Tables\Columns\TextColumn::make('contract_start')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contractd')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->badge()
                    ->color(fn($state) => $state->color()),
                Tables\Columns\TextColumn::make('views')
                    ->numeric()
                    ->label('views')
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subcategory.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city.name')
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
                Tables\Columns\TextColumn::make('tags.name')
                    ->label('tags')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('name category')
                    ->options(fn() => \App\Models\Category::pluck('name', 'id')->toArray()),

                Tables\Filters\SelectFilter::make('subcategory_id')
                    ->label('subcategory')
                    ->options(fn() => \App\Models\Subcategory::pluck('name', 'id')->toArray()),

                Tables\Filters\SelectFilter::make('state_id')
                    ->label('state')
                    ->options(fn() => \App\Models\State::pluck('name', 'id')->toArray()),

                Tables\Filters\SelectFilter::make('city_id')
                    ->label('city')
                    ->options(fn() => \App\Models\City::pluck('name', 'id')->toArray()),

                Tables\Filters\SelectFilter::make('tags')
                    ->label('tag')
                    ->relationship('tags', 'name'),

                Tables\Filters\SelectFilter::make('status')
                    ->label('status')
                    ->options([
                        'active' => 'active',
                        'inactive' => 'inactive',
                        'expired' => 'expired',
                    ]),

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
            'index' => Pages\ListServiceProviders::route('/'),
            'create' => Pages\CreateServiceProvider::route('/create'),
            'edit' => Pages\EditServiceProvider::route('/{record}/edit'),
        ];
    }
}

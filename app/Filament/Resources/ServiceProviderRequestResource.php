<?php

namespace App\Filament\Resources;

use App\Enum\statusServiceProviderRequestEnum;
use App\Filament\Resources\ServiceProviderRequestResource\Pages;
use App\Filament\Resources\ServiceProviderRequestResource\RelationManagers;
use App\Models\ServiceProviderRequest;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\SelectFilter;

class ServiceProviderRequestResource extends Resource
{
    protected static ?string $model = ServiceProviderRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('provider_name')
                    ->required()
                    ->searchable()
                    ->maxLength(255),
                Forms\Components\TextInput::make('shop_name')
                    ->maxLength(255)
                    ->searchable()
                    ->default(null),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->searchable()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('whatsapp')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('facebook')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('instagram')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\FileUpload::make('image')
                    ->image(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options(statusServiceProviderRequestEnum::toArray())
                    ->required()
                    ->default(statusServiceProviderRequestEnum::PENDING->value),
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
                Forms\Components\Toggle::make('is_read')
                    ->label('Is Read')
                    ->default(false),
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
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
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
                Tables\Columns\TextColumn::make('is_read')
                    ->label('Read Status')
                    ->formatStateUsing(fn(bool $state) => $state ? 'Read' : 'Unread')
                    ->badge()
                    ->color(fn(bool $state) => $state ? 'success' : 'warning'),
            ])
            ->filters([
               SelectFilter::make('status')
        ->label('Status')
        ->options([
            statusServiceProviderRequestEnum::PENDING->value  => 'Pending',
            statusServiceProviderRequestEnum::APPROVED->value => 'Approved',
            statusServiceProviderRequestEnum::REJECTED->value => 'Rejected',
        ]),

                SelectFilter::make('is_read')
                    ->label('Read Status')
                    ->options([
                        true => 'Read',
                        false => 'Unread',
                    ]),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Action::make('changeStatus')
                    ->label('Change Status')
                    ->icon('heroicon-o-pencil')
                    ->form([
                        Select::make('status')
                            ->label('New Status')
                            ->options(statusServiceProviderRequestEnum::toArray())
                            ->required(),
                    ])
                    ->action(function (array $data, ServiceProviderRequest $record): void {
                        $record->update(['status' => $data['status']]);
                    })
                    ->modalHeading('Update Request Status')

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
            'index' => Pages\ListServiceProviderRequests::route('/'),
            'create' => Pages\CreateServiceProviderRequest::route('/create'),
            'edit' => Pages\EditServiceProviderRequest::route('/{record}/edit'),
        ];
    }
}

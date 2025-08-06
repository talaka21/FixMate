<?php

namespace App\Filament\Resources;

use App\Enum\stateStatusEnum;
use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\ServiceProvider;
use App\Models\Slider;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\SelectAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required(),
                Forms\Components\Select::make('service_provider_id')
                    ->label('Service Provider')
                    ->options(fn() => ServiceProvider::pluck('provider_name', 'id')->toArray())
                    ->searchable()
                    ->nullable(),
                Forms\Components\Select::make('status')
                    ->options(stateStatusEnum::toArray())
                    ->default(stateStatusEnum::ACTIVE->value)
                    ->required(),


                Forms\Components\DateTimePicker::make('created_at')
                    ->label('Created At'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('serviceProvider.provider_name')
                    ->label('Service Provider')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        stateStatusEnum::ACTIVE => 'success',
                        stateStatusEnum::INACTIVE => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ]),
                SelectFilter::make('service_provider_id')
                    ->label('Service Provider')
                    ->options(function () {
                        return ServiceProvider::pluck('provider_name', 'id')->toArray();
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Action::make('changeStatus')
                    ->label('Change Status')
                    ->icon('heroicon-o-pencil')
                    ->form([
                        Select::make('status')
                            ->label('New Status')
                            ->options(stateStatusEnum::toArray())
                            ->required(),
                    ])
                    ->action(function (array $data, Slider $record): void {
                        $record->update(['status' => $data['status']]);
                    })
                    ->modalHeading('Update Request Status'),
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}

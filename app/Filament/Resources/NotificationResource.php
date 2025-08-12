<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationResource\Pages;
use App\Filament\Resources\NotificationResource\RelationManagers;
use App\Models\Notification;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('target_type')
                    ->label('Send To')
                    ->options([
                        'all' => 'All',
                        'provider' => 'PROVIDER ',
                    ])
                    ->required()
                    ->reactive(),

                Forms\Components\Select::make('target_id')
                    ->label('User Name')
                    ->options(
                        fn() => User::where('status', 'active')
                            ->get()
                            ->mapWithKeys(fn($u) => [$u->id => $u->first_name . ' ' . $u->last_name])
                            ->toArray()
                    )
                    ->searchable()
                    ->visible(fn(callable $get) => $get('target_type') === 'provider'),

                Forms\Components\Toggle::make('is_read')
                    ->required(),
                Forms\Components\DatePicker::make('send_date')
                    ->label('Date')
                    ->required()
                    ->default(now()->toDateString())
                    ->minDate(now()),

                Forms\Components\TimePicker::make('send_time')
                    ->label('Time')
                    ->required()
                    ->default(now()->format('H:i')),
                Forms\Components\TextInput::make('created_by')
                    ->numeric()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('target_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('target_id')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('send_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('createdByUser.full_name')
                    ->label('Created By')
                    ->searchable(),
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
                Filter::make('send_at')
                    ->label('Filter by Date')
                    ->form([
                        DatePicker::make('from')->label('From Date'),
                        DatePicker::make('to')->label('To Date'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn($q) => $q->whereDate('send_at', '>=', $data['from']))
                            ->when($data['to'], fn($q) => $q->whereDate('send_at', '<=', $data['to']));
                    }),
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
            'index' => Pages\ListNotifications::route('/'),
            'create' => Pages\CreateNotification::route('/create'),
            'edit' => Pages\EditNotification::route('/{record}/edit'),
        ];
    }
}

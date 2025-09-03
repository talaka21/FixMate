<?php

namespace App\Filament\Resources;

use App\Enum\ContactStatuEnum;
use App\Filament\Resources\ContactRequestResource\Pages;
use App\Filament\Resources\ContactRequestResource\RelationManagers;
use App\Models\ContactRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactRequestResource extends Resource
{
    protected static ?string $model = ContactRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
 protected static ?string $navigationLabel = 'Contact Us Requests';
    protected static ?string $navigationGroup = 'Support';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
              Forms\Components\TextInput::make('user_name')
                    ->disabled()
                    ->label('User Name'),

                Forms\Components\TextInput::make('phone_number')
                    ->disabled()
                    ->label('Phone Number'),

                Forms\Components\Textarea::make('message')
                    ->disabled()
                    ->label('Message'),

                Forms\Components\Select::make('status')
                    ->options(collect(ContactStatuEnum::cases())->mapWithKeys(fn($case) => [$case->value => $case->name]))
                    ->default(ContactStatuEnum::UNREAD->value)
                    ->label('Status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
      return $table
            ->columns([
                  Tables\Columns\TextColumn::make('user_name')
                    ->searchable()
                    ->label('User Name'),

                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable()
                    ->label('Phone Number'),

                Tables\Columns\TextColumn::make('message')
                    ->limit(50)
                    ->label('Message'),

                Tables\Columns\TextColumn::make('status')
                    ->colors([
                        'danger' => ContactStatuEnum::UNREAD->value,
                        'success' =>ContactStatuEnum::READ->value,
                    ])
                    ->sortable()
                    ->label('Status'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(collect(ContactStatuEnum::cases())->mapWithKeys(fn($case) => [$case->value => $case->name]))
                    ->label('Filter by Status'),
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
            'index' => Pages\ListContactRequests::route('/'),
            'create' => Pages\CreateContactRequest::route('/create'),
            'edit' => Pages\EditContactRequest::route('/{record}/edit'),
        ];
    }
}

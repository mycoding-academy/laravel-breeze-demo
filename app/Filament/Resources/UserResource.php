<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\BelongsToManyMultiSelect;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->nullable()
                    ->required(fn (Component $livewire): bool => $livewire instanceof Pages\CreateUser)
                    ->maxLength(255)
                    ->same('passwordConfirmation')
                    ->dehydrateStateUsing(fn ($state) => !empty($state) ? Hash::make($state) : ""),
                Forms\Components\TextInput::make('passwordConfirmation')
                    ->password()
                    ->required(fn (Component $livewire): bool => $livewire instanceof Pages\CreateUser),
                BelongsToManyMultiSelect::make('roles')->relationship('roles', 'name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->hidden(fn (Component $livewire): bool => $livewire instanceof Pages\ListUsers),  
            ])
            ->filters([
                Tables\Filters\Filter::make('verified')
                ->query(fn (Builder $query): Builder => $query->whereNotNull('email_verified_at')),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['first_name', 'last_name'];
    }

}

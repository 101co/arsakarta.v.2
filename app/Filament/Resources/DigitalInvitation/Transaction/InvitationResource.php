<?php

namespace App\Filament\Resources\DigitalInvitation\Transaction;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Pages\SubNavigationPosition;
use App\Filament\Clusters\DigitalInvitation\Transaction;
use App\Models\DigitalInvitation\Transaction\Invitation;
use App\Filament\Resources\DigitalInvitation\Transaction\InvitationResource\Pages;

class InvitationResource extends Resource
{
    protected static ?string $model = Invitation::class;

    protected static ?string $cluster = Transaction::class;
    protected static ?string $slug = 'invitation';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        $menuCode = 'INVTT001';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListInvitations::route('/'),
            'create' => Pages\CreateInvitation::route('/create'),
            'edit' => Pages\EditInvitation::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources\DigitalInvitation\Master;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Database\Eloquent\Builder;
use App\Models\DigitalInvitation\Master\Layout;
use App\Filament\Clusters\DigitalInvitation\Master;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DigitalInvitation\Master\LayoutResource\Pages;
use App\Filament\Resources\DigitalInvitation\Master\LayoutResource\RelationManagers;

class LayoutResource extends Resource
{
    protected static ?string $model = Layout::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'layout';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        $menuCode = 'INVTM001';
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageLayouts::route('/'),
        ];
    }
}

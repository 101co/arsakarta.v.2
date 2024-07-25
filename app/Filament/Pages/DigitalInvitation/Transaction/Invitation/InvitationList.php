<?php

namespace App\Filament\Pages\DigitalInvitation\Transaction\Invitation;

use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Tables\Concerns\InteractsWithTable;
use App\Filament\Clusters\DigitalInvitation\Transaction;
use App\Models\DigitalInvitation\Transaction\Invitation;

class InvitationList extends Page implements HasTable
{
    use InteractsWithTable;
    
    protected static ?string $cluster = Transaction::class;
    protected static ?string $slug = 'invitation-list';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 1;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    public static function canAccess(): bool
    {
        $menuCode = 'INVTT001';
        return authUserMenu($menuCode, auth()->user()->id);
    }
    
    public function table(Table $table): Table
    {
        return $table
            ->query(Invitation::query())
            ->columns([
                TextColumn::make('name'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    protected static string $view = 'filament.pages.digital-invitation.transaction.invitation.invitation-list';
}

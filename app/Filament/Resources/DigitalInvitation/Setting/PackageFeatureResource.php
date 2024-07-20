<?php

namespace App\Filament\Resources\DigitalInvitation\Setting;

use App\Enums\Icons;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Unique;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\ToggleColumn;
use App\Filament\Clusters\DigitalInvitation\Setting;
use Filament\Tables\Columns\Layout\Split as TableSplit;
use App\Models\DigitalInvitation\Setting\PackageFeature;
use App\Filament\Resources\DigitalInvitation\Setting\PackageFeatureResource\Pages;

class PackageFeatureResource extends Resource
{
    protected static ?string $model = PackageFeature::class;

    protected static ?string $cluster = Setting::class;
    protected static ?string $slug = 'package-feature';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?int $navigationSort = 2;

    public static function canViewAny(): bool
    {
        $menuCode = 'INVTX002';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Split::make([
                Section::make([
                    Select::make('package_id')
                        ->relationship('package', 'package_name')
                        ->preload()
                        ->unique(PackageFeature::class, 'id', null, $ignoreRecord = true, $modifyRuleUsing = function (Unique $rule, string $context, ?Model $record) {
                            if ($record)
                            {
                                return $rule
                                    ->where('package_id', $record->package_id)
                                    ->whereNot('id', $record->id);
                            }

                            return null;
                        })
                        ->searchable(),
                    Repeater::make('features')
                        ->schema([
                            Select::make('feature_id')
                                ->relationship('feature', 'feature_name')
                                ->label('Feature')
                                ->preload()
                                ->searchable()
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                ->required()
                        ])
                        ->label('Arrange Feature')
                        ->addActionLabel('Add More Feature')
                ])
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TableSplit::make([
                    TextColumn::make('package.package_name')
                        ->label('Package Name')
                        ->searchable()
                        ->sortable(),
                    ToggleColumn::make('is_active')
                        ->label('Is Active')
                        ->alignEnd()
                ])
            ])
            ->filters([])
            ->contentGrid([
                'sm' => 1,
                'xl' => 3,
            ])
            ->actions([
                getCustomTableAction(ActionType::EDIT, 'Update', 'Choose Menu', Icons::EDIT, null, false),
                getCustomTableAction(ActionType::DELETE, null, 'Delete Menu', null, null, null)
            ])
            ->bulkActions([
                getCustomTableAction(ActionType::BULK_DELETE, null, null, null, null, null)
            ])
            ->headerActions([
                getCustomTableAction(ActionType::CREATE, 'Add', 'Choose Menu', Icons::ADD, false, false)
            ])
            ->emptyStateActions([
                getCustomTableAction(ActionType::CREATE, 'Add', 'Choose Menu', Icons::ADD, false, false)
            ])
            ->defaultPaginationPageOption(10)
            ->striped()
            ->heading('Setting Event Type Layout')
            ->deferLoading();
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackageFeatures::route('/'),
            'create' => Pages\CreatePackageFeature::route('/create'),
            'edit' => Pages\EditPackageFeature::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources\ProjectManagement\Transaction;

use App\Enums\Icons;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Forms\Components\DateTimePicker;
use App\Models\ProjectManagement\Master\Project;
use App\Models\ProjectManagement\Master\TaskType;
use Filament\Forms\Components\Split as SplitForm;
use App\Models\ProjectManagement\Transaction\Task;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use App\Filament\Clusters\ProjectManagement\Transaction;
use App\Filament\Resources\ProjectManagement\Transaction\TaskResource\Pages;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;
    
    protected static ?string $cluster = Transaction::class;
    protected static ?string $slug = 'task';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 1;
    
    public static function canViewAny(): bool
    {
        $menuCode = 'PRMGT001';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(100)
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->rows(5),
                Select::make('project_id')
                    ->searchable()
                    ->relationship('project', 'name')
                    ->getOptionLabelFromRecordUsing(fn (Project $record) => "{$record->name}")
                    ->preload()
                    ->live()
                    ->columnSpanFull(),
                SplitForm::make([
                    Select::make('task_type_id')
                        ->searchable()
                        ->relationship('taskType', 'name')
                        ->getOptionLabelFromRecordUsing(fn (TaskType $record) => "{$record->name}")
                        ->preload()
                        ->live(),
                    Select::make('status')
                        ->label('Status')
                        ->required()
                        ->options([
                            'notstarted'    => 'Not Started',
                            'inprogress'    => 'In Progress',
                            'complete'      => 'Complete'
                        ]),
                ]),
                SplitForm::make([
                    DateTimePicker::make('plan_start_date')
                        ->label('Start Date (Plan)'),
                    DateTimePicker::make('plan_end_date')
                        ->label('End Date (Plan)'),
                ]),
                SplitForm::make([
                    DateTimePicker::make('actual_start_date')
                        ->label('Start Date (Actual)'),
                    DateTimePicker::make('actual_end_date')
                        ->label('End Date (Actual)'),
                ]),
                SplitForm::make([
                    TextInput::make('plan_hours')
                        ->readOnly()
                        ->columnSpanFull(),
                    TextInput::make('actual_hours')
                        ->readOnly()
                        ->columnSpanFull()
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    TextColumn::make('title')
                        ->label('Task Name')
                        ->size(TextColumnSize::Medium)
                        ->searchable()
                        ->sortable(),
                    Split::make([
                        TextColumn::make('taskType.name')
                            ->grow(false)
                            ->color('info')
                            ->badge(),
                        TextColumn::make('project.name')
                            ->color('warning')
                            ->badge(),
                    ]),
                    Split::make([
                        TextColumn::make('plan_start_date')
                            ->grow(false)
                            ->size(TextColumnSize::ExtraSmall)
                            ->weight(FontWeight::Bold),
                        TextColumn::make('plan_end_date')
                            ->size(TextColumnSize::ExtraSmall)
                            ->weight(FontWeight::Bold),
                    ]),
                    TextColumn::make('status')
                        ->color(fn (string $state): string => match($state)
                        {
                            'notstarted'    => 'danger',
                            'inprogress'    => 'warning',
                            'complete'      => 'success'
                        })
                        ->badge()
                ])
                ->space(2)
            ])
            ->filters([
                Filter::make('plan_start_date')
                ->form([
                    DatePicker::make('plan_start_date')
                        ->default(now()->addDays(-7)),
                    DatePicker::make('plan_end_date')
                        ->default(now()),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['plan_start_date'],
                            fn (Builder $query, $date): Builder => $query->whereDate('plan_start_date', '>=', $date),
                        )
                        ->when(
                            $data['plan_end_date'],
                            fn (Builder $query, $date): Builder => $query->whereDate('plan_end_date', '<=', $date),
                        );
                })
            ])
            ->actions([
                getCustomTableAction(ActionType::EDIT, 'Update', null, Icons::EDIT, null, false),
                getCustomTableAction(ActionType::DELETE, null, 'Delete Task', null, null, null)
            ])
            ->bulkActions([
                getCustomTableAction(ActionType::BULK_DELETE, null, null, null, null, null)
            ])
            ->headerActions([
                getCustomTableAction(ActionType::CREATE, 'Add', null, Icons::ADD, false, false)
            ])
            ->emptyStateActions([
                getCustomTableAction(ActionType::CREATE, 'Add', null, Icons::ADD, false, false)
            ])
            ->heading('Project')
            ->deferLoading()
            ->defaultPaginationPageOption(10)
            ->striped();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTasks::route('/'),
        ];
    }
}

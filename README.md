## Create New Menu
php artisan make:filament-resource ../../YourMenu --model --migration --simple

## Create Clusters (Grouping Menu)
php artisan make:filament-cluster ../../YourCluster

### Add this code to cluster
    protected static ?string $slug = 'sys-man-master';
    protected static ?string $navigationGroup = 'System Manager';
    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

## Edit YourMenuResource
### Add this code
    protected static ?string $cluster = YourCluster::class;
    protected static ?string $slug = 'your-menu-slug';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        $menuCode = 'XXXXM001';
        return authUserMenu($menuCode, auth()->user()->id);
    }

## Modif Component From List Page
### Remove Title
    public function getTitle(): string | Htmlable
    {
        return __('');
    }

### Remove Default Create Button
    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

## Modif Component From Create Page
### Change Redirect After Save
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

### Change / Custom Button
    protected function getFormActions(): array
    {
        return 
        [
            getCustomCreateFormAction('Save', Icons::CHECK),
            getCustomCreateAnotherFormAction('Save & Add Other', Icons::CHECK),
            getCustomCancelFormAction('Cancel', Icons::CROSS, Js::from($this->previousUrl ?? static::getResource()::getUrl()))
        ];
    }

### Modif Data Before Save
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->user()->name;
        $data['updated_by'] = auth()->user()->name;
        return $data;
    }

## Modif Component From Edit Page
### Change Redirect After Save
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

### Change / Custom Button
    protected function getFormActions(): array
    {
        return 
        [
            getCustomSaveFormAction('Save', Icons::CHECK),
            getCustomCancelFormAction('Cancel', Icons::CROSS, Js::from($this->previousUrl ?? static::getResource()::getUrl()))
        ];
    }

### Modif Data Before Save
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->user()->name;
        $data['updated_by'] = auth()->user()->name;
        return $data;
    }

### Remove Default Delete Button
    protected function getHeaderActions(): array
    {
        return [];
    }

## Optimizing Images

### Installasi
    composer require spatie/laravel-medialibrary

### Publish Config
    php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider"

### Jalankan Migrate
    php artisan migrate

### Implement Media Lybrary
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Spatie\MediaLibrary\HasMedia;
    use Spatie\MediaLibrary\InteractsWithMedia;

    class YourModel extends Model implements HasMedia
    {
        use InteractsWithMedia;

        public function registerMediaCollections(): void
        {
            $this->addMediaCollection('images');
        }

        public function addImage($image)
        {
            $this->addMedia($image)
                ->toMediaCollection('images');
        }
    }

### Override Filament Registration
#### Create Page Register
    php artisan make:filament-page Auth/Register

#### Edit Page Register
    use Filament\Forms\Components\Select;
    use Filament\Forms\Components\Component;
    
    class Register extends BaseRegister
    {
        protected function getForms(): array
        {
            return [
                'form' => $this->form(
                    $this->makeForm()
                        ->schema([
                            $this->getNameFormComponent(),
                            $this->getEmailFormComponent(),
                            $this->getPasswordFormComponent(),
                            $this->getPasswordConfirmationFormComponent(),
                            $this->getRoleFormComponent(), 
                        ])
                        ->statePath('data'),
                ),
            ];
        }
    
        protected function getRoleFormComponent(): Component
        {
            return Select::make('role')
                ->options([
                    'buyer' => 'Buyer',
                    'seller' => 'Seller',
                ])
                ->default('buyer')
                ->required();
        }
    }

#### Edit AdminPanelProvider
    use App\Filament\Pages\Auth\Register;
    
    class AdminPanelProvider extends PanelProvider
    {
        public function panel(Panel $panel): Panel
        {
            return $panel
                ->default()
                ->id('admin')
                ->path('admin')
                ->login()
                ->registration(Register::class) 
                // ...
        }
    }

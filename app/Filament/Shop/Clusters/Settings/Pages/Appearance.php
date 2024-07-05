<?php

namespace App\Filament\Shop\Clusters\Settings\Pages;

use App\Enums\Setting\Font;
use App\Enums\Setting\PrimaryColor;
use App\Enums\Setting\RecordsPerPage;
use App\Enums\Setting\TableSortDirection;
use App\Filament\Shop\Clusters\Settings;
use App\Models\Setting\Appearance as AppearanceModel;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Exceptions\Halt;
use Livewire\Attributes\Locked;

/**
 * @property Form $form
 */
class Appearance extends Page
{
    use InteractsWithFormActions;

    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';

    protected static ?string $title = 'Appearance';

    protected static string $view = 'filament.shop.clusters.settings.pages.appearance';

    protected static ?string $cluster = Settings::class;

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::ScreenTwoExtraLarge;
    }

    public ?array $data = [];

    #[Locked]
    public ?AppearanceModel $record = null;

    public function mount(): void
    {
        $tenant = Filament::getTenant();
        $this->record = AppearanceModel::whereBelongsTo(Filament::getTenant())->firstOrNew([
            'shop_id' => $tenant->id
        ]);
        //have some problem when it dosen't have any appearance created
        // $this->record->save();\

        $this->fillForm();
        // dd($this->record);

    }

    public function fillForm(): void
    {
        $data = $this->record->attributesToArray();
        $this->form->fill($data);

    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            $this->handleRecordUpdate($this->record, $data);

        } catch (Halt $exception) {
            return;
        }

        $this->getSavedNotification()->send();
    }


    public function setDefaultSettings(): void
    {
        try {

//            $data = $this->form->getState();
            $this->form->fill([
                'primary_color' => PrimaryColor::DEFAULT,
                'bg_color' => PrimaryColor::Gray,
                'font' => Font::DEFAULT,
                'table_sort_direction' => TableSortDirection::DEFAULT,
                'records_per_page' => RecordsPerPage::DEFAULT,

            ]);
        } catch (Halt $exception) {
            return;
        }

        $this->getDefaultSettingsNotifications()->send();
    }

    protected function getSavedNotification(): Notification
    {
        return Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'));
    }
    protected function getDefaultSettingsNotifications(): Notification
    {
        return Notification::make()
            ->success()
            ->title(__('Field Set with default setting'));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getGeneralSection(),
                $this->getDataPresentationSection(),
            ])
            ->model($this->record)
            ->statePath('data')
            ->operation('edit');
    }


    protected function getGeneralSection(): Component
    {
        return Section::make('General')
            ->schema([
                Select::make('primary_color')
                    ->allowHtml()
                    ->native(false)
                    ->options(
                        collect(PrimaryColor::cases())
                            ->sort(static fn($a, $b) => $a->value <=> $b->value)
                            ->mapWithKeys(static fn($case) => [
                                $case->value => "<span class='flex items-center gap-x-4'>
                                <span class='rounded-full w-4 h-4' style='background:rgb(" . $case->getColor()[600] . ")'></span>
                                <span>" . $case->getLabel() . '</span>
                                </span>',
                            ]),
                    ),

                Select::make('bg_color')
                    ->allowHtml()
                    ->native(false)
                    ->options(
                        collect(PrimaryColor::cases())
                            ->sort(static fn($a, $b) => $a->value <=> $b->value)
                            ->mapWithKeys(static fn($case) => [
                                $case->value => "<span class='flex items-center gap-x-4'>
                                <span class='rounded-full w-4 h-4' style='background:rgb(" . $case->getColor()[600] . ")'></span>
                                <span>" . $case->getLabel() . '</span>
                                </span>',
                            ]),
                    ),
                Select::make('font')
                    ->allowHtml()
                    ->native(false)
                    ->options(
                        collect(Font::cases())
                            ->mapWithKeys(static fn($case) => [
                                $case->value => "<span style='font-family:{$case->getLabel()}'>{$case->getLabel()}</span>",
                            ]),
                    ),
            ])->columns();
    }

    protected function getDataPresentationSection(): Component
    {
        return Section::make('Data Presentation')
            ->schema([
                Select::make('table_sort_direction')
                    ->options(TableSortDirection::class),
                Select::make('records_per_page')
                    ->options(RecordsPerPage::class),
            ])->columns();
    }


    protected function handleRecordUpdate(AppearanceModel $record, array $data): AppearanceModel
    {
        $record->fill($data);

        $keysToWatch = [
            'primary_color',
            'bg_color',
            'font',
        ];

        if ($record->isDirty($keysToWatch)) {
            $this->dispatch('appearanceUpdated');
        }

        $record->save();

        return $record;
    }



    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
            $this->getDefaultSettingsFormAction(),
        ];
    }

    protected function getSaveFormAction(): Action
    {
        return Action::make('save')
            ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
            ->submit('save')
            ->keyBindings(['mod+s']);
    }

    protected function getDefaultSettingsFormAction(): Action
    {
        return Action::make('setDefaultSettings')
            ->label(__('Default Default'))
            ->action( fn() => $this->setDefaultSettings());
//            ->submit('setDefaultSettings');
    }

}

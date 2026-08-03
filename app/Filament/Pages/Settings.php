<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Hash;

class Settings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?int $navigationSort = 2;

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $user = Filament::auth()->user();

        $this->form->fill([
            'site' => [
                'title' => setting('site.title'),
                'description' => setting('site.description'),
                'email' => setting('site.email'),
                'cc_emails' => setting('site.cc_emails'),
                'google_analytics_tracking_id' => setting('site.google_analytics_tracking_id'),
            ],
            'admin' => [
                'name' => $user->name,
                'email' => $user->email,
                'password' => null,
            ],
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Settings')
                    ->tabs([
                        Tab::make('Site Settings')
                            ->schema([
                                TextInput::make('site.title')->label('Site Title')->required()->maxLength(255),
                                Textarea::make('site.description')->label('Site Description')->maxLength(1000),
                                TextInput::make('site.email')->label('Notification Email')->email()->maxLength(255),
                                TextInput::make('site.cc_emails')->label('CC Emails')->helperText('Comma separated list of email addresses.')->maxLength(255),
                                TextInput::make('site.google_analytics_tracking_id')->label('Google Analytics Tracking ID')->maxLength(255),
                            ]),
                        Tab::make('My Profile')
                            ->schema([
                                TextInput::make('admin.name')->label('Name')->required()->maxLength(255),
                                TextInput::make('admin.email')->label('Email')->email()->required()->maxLength(255),
                                TextInput::make('admin.password')->label('New Password')->password()->revealable()->minLength(8)->maxLength(255),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getFormContentComponent(),
            ]);
    }

    public function getFormContentComponent(): Component
    {
        return Form::make([EmbeddedSchema::make('form')])
            ->id('form')
            ->livewireSubmitHandler('save')
            ->footer([
                Actions::make($this->getFormActions())
                    ->alignment(Alignment::Start)
                    ->key('form-actions'),
            ]);
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')->label('Save')->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data['site'] as $key => $value) {
            Setting::query()->updateOrCreate(
                ['key' => "site.{$key}"],
                ['value' => $value, 'group' => 'site'],
            );
        }

        $user = Filament::auth()->user();
        $user->name = $data['admin']['name'];
        $user->email = $data['admin']['email'];

        if (filled($data['admin']['password'] ?? null)) {
            $user->password = Hash::make($data['admin']['password']);
        }

        $user->save();

        $this->data['admin']['password'] = null;

        Notification::make()
            ->title('Settings saved')
            ->success()
            ->send();
    }
}

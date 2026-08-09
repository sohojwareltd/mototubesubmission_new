<?php

namespace App\Filament\Resources\Videos\Schemas;

use App\Models\Video;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Html;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class VideoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Section::make('Submitter')
                    ->icon(Heroicon::OutlinedUser)
                    ->columnSpan(1)
                    ->columns(1)
                    ->schema([
                        TextEntry::make('full_name')
                            ->label('Full Name')
                            ->state(fn (Video $record): string => trim("{$record->first_name} {$record->last_name}")),
                        TextEntry::make('email')
                            ->icon(Heroicon::OutlinedEnvelope)
                            ->copyable(),
                        TextEntry::make('phone')
                            ->icon(Heroicon::OutlinedPhone)
                            ->placeholder('—'),
                        TextEntry::make('birthdate')
                            ->label('Date of Birth')
                            ->placeholder('—'),
                        TextEntry::make('video_credit')
                            ->label('Social Media Handle')
                            ->placeholder('—'),
                        TextEntry::make('user_ip')
                            ->label('Submitted From IP'),
                    ]),

                Section::make('Location')
                    ->icon(Heroicon::OutlinedMapPin)
                    ->columnSpan(1)
                    ->columns(1)
                    ->schema([
                        TextEntry::make('city'),
                        TextEntry::make('state'),
                        TextEntry::make('country'),
                        TextEntry::make('when_filmed')
                            ->label('When Filmed')
                            ->placeholder('—'),
                    ]),

                Section::make('Submission Details')
                    ->icon(Heroicon::OutlinedClipboardDocumentList)
                    ->columnSpan(1)
                    ->columns(1)
                    ->schema([
                        TextEntry::make('id')
                            ->label('Submission ID')
                            ->badge(),
                        TextEntry::make('created_at')
                            ->label('Submitted On')
                            ->dateTime(),
                        TextEntry::make('video_url')
                            ->label('External Video URL')
                            ->url(fn (?string $state): ?string => Str::startsWith($state ?? '', ['http://', 'https://']) ? $state : null)
                            ->openUrlInNewTab()
                            ->placeholder('—'),
                    ]),

                Section::make('Video')
                    ->icon(Heroicon::OutlinedFilm)
                    ->columnSpanFull()
                    ->columns(1)
                    ->schema([
                        Html::make(function (Video $record) {
                            $url = $record->videoUrl();

                            if (! $url) {
                                return '<p class="text-sm text-gray-500">No video file uploaded.</p>';
                            }

                            return <<<HTML
                                <video controls preload="metadata" style="width:100%; max-height:480px; border-radius:0.5rem; background:#000;">
                                    <source src="{$url}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                HTML;
                        }),
                        TextEntry::make('video_file_name')
                            ->label('File Name')
                            ->state(fn (Video $record): ?string => $record->video ? Str::afterLast($record->video, '/') : null)
                            ->placeholder('—')
                            ->copyable(),
                        TextEntry::make('description')
                            ->columnSpanFull()
                            ->prose(),
                    ]),

                Section::make('Copyright Verification')
                    ->icon(Heroicon::OutlinedScale)
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('person_who_filmed')
                            ->label('Person Who Filmed'),
                        TextEntry::make('person_who_filmed_other')
                            ->label('Person Who Filmed (Other)')
                            ->placeholder('—'),
                        TextEntry::make('submit_other_website')
                            ->label('Submitted To Another Website?'),
                        TextEntry::make('submit_place')
                            ->label('Where Submitted')
                            ->placeholder('—'),
                        TextEntry::make('did_anyone_reach')
                            ->label('Did Anyone Reach Out?'),
                        TextEntry::make('share_reach_name')
                            ->label('Company/Page Name')
                            ->placeholder('—'),
                        TextEntry::make('aggrement_with_another_company')
                            ->label('Licensing Agreement With Another Company?'),
                        TextEntry::make('people_appearing')
                            ->label('People Appearing In Video?'),
                        TextEntry::make('people_appearing_list')
                            ->label('Who Appears')
                            ->columnSpanFull()
                            ->placeholder('—'),
                    ]),

                Section::make('Signature')
                    ->icon(Heroicon::OutlinedPencil)
                    ->columnSpanFull()
                    ->columns(1)
                    ->schema([
                        ImageEntry::make('signature')
                            ->hiddenLabel()
                            ->disk('s3')
                            ->height(150)
                            ->visibility('private')
                            ->extraImgAttributes(['style' => 'background:#fff; border-radius:0.5rem; padding:0.5rem;']),
                    ]),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Videos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VideoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Submitter')
                    ->columns(2)
                    ->schema([
                        TextInput::make('first_name')->required()->maxLength(30),
                        TextInput::make('last_name')->required()->maxLength(30),
                        TextInput::make('email')->email()->required()->maxLength(100),
                        TextInput::make('phone')->maxLength(200),
                        TextInput::make('birthdate')->label('Date of Birth')->maxLength(100),
                        TextInput::make('video_credit')->label('Social Media Handle')->maxLength(200),
                    ]),
                Section::make('Location')
                    ->columns(3)
                    ->schema([
                        TextInput::make('city')->required()->maxLength(30),
                        TextInput::make('state')->required()->maxLength(30),
                        TextInput::make('country')->required()->maxLength(30),
                    ]),
                Section::make('Video')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('video')->disk('s3')->directory('videos')->required(),
                        TextInput::make('video_url')->label('Video URL')->url()->maxLength(255),
                        TextInput::make('when_filmed')->label('When Filmed')->maxLength(30),
                        Textarea::make('description')->required()->maxLength(3000)->columnSpanFull(),
                    ]),
                Section::make('Copyright Verification')
                    ->columns(2)
                    ->schema([
                        Select::make('person_who_filmed')
                            ->label('Person Who Filmed')
                            ->options([
                                'Me' => 'Me',
                                'A Family Member' => 'A Family Member',
                                'A Friend' => 'A Friend',
                                'Someone I Know' => 'Someone I Know',
                                'A Dashcam' => 'A Dashcam',
                                'A Security Camera' => 'A Security Camera',
                                'Other' => 'Other',
                            ])
                            ->required(),
                        TextInput::make('person_who_filmed_other')->label('Person Who Filmed (Other)')->maxLength(200),
                        Select::make('submit_other_website')
                            ->label('Submitted To Another Website?')
                            ->options([
                                'No, I Did Not' => 'No, I Did Not',
                                "Yes, Another Company's Website" => "Yes, Another Company's Website",
                                'Yes, A Facebook Page' => 'Yes, A Facebook Page',
                                'Yes, A Twitter Account' => 'Yes, A Twitter Account',
                                'Yes, An Instagram Account' => 'Yes, An Instagram Account',
                                'Yes, A YouTube Channel' => 'Yes, A YouTube Channel',
                                'Yes, A Snaphat Account' => 'Yes, A Snaphat Account',
                            ])
                            ->required(),
                        TextInput::make('submit_place')->label('Where Submitted')->maxLength(200),
                        Select::make('did_anyone_reach')
                            ->label('Did Anyone Reach Out?')
                            ->options([
                                'No, You Are The First Company' => 'No, You Are The First Company',
                                'Yes, Another Company Contacted Me' => 'Yes, Another Company Contacted Me',
                                'Yes, Some Social Media Accounts Messaged Me' => 'Yes, Some Social Media Accounts Messaged Me',
                            ])
                            ->required(),
                        TextInput::make('share_reach_name')->label('Company/Page Name')->maxLength(200),
                        Select::make('aggrement_with_another_company')
                            ->label('Licensing Agreement With Another Company?')
                            ->options([
                                'No, I Did Not' => 'No, I Did Not',
                                'Yes, I Have Filled An Online Form.' => 'Yes, I Have Filled An Online Form.',
                                'Yes, I Have Signed An Exclusive Agreement.' => 'Yes, I Have Signed An Exclusive Agreement.',
                                'Yes, I Have Signed A Non-Exclusive Agreement.' => 'Yes, I Have Signed A Non-Exclusive Agreement.',
                            ])
                            ->required(),
                        Select::make('people_appearing')
                            ->label('People Appearing In Video?')
                            ->options([
                                'yes' => 'Yes',
                                'no' => 'No',
                            ])
                            ->required(),
                        TextInput::make('people_appearing_list')->label('Who Appears')->maxLength(200)->columnSpanFull(),
                    ]),
                Section::make('Signature & Metadata')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('signature')->disk('s3')->directory('signature')->image(),
                        TextInput::make('user_ip')->label('User IP')->disabled(),
                    ]),
            ]);
    }
}

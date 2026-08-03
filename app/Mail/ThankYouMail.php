<?php

namespace App\Mail;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThankYouMail extends Mailable
{
    use Queueable, SerializesModels;
    public $video;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Video $video)
    {
        $this->video= $video;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email =  $this->subject('Thank you for submitting your video!')
                    ->markdown('emails.thank_you');
            $email->attach(public_path('terms/terms_of_service.pdf'), [
                        'as' => 'Terms Of Service.pdf',
                        'mime' => 'application/pdf',
                   ]);
            $email->attach(public_path('terms/terms_of_submission.pdf'), [
                        'as' => 'Terms Of Submission.pdf',
                        'mime' => 'application/pdf',
                   ]);
        return $email;
    }
}

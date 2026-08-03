<?php

namespace App\Mail;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VideoSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $video;
    public $cc_emails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Video $video,$cc_emails)
    {
        $this->video = $video;
        $this->cc_emails = $cc_emails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->cc($this->cc_emails)
		             ->subject('New Submission From mototubesubmission '. $this->video->id)
					 ->markdown('emails.video-submited');
    }
}

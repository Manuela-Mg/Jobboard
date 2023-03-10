<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplicationDone extends Mailable
{
    use Queueable, SerializesModels;

    public string $fr;
    public string $sub;
    public string $vue;
    /**
     * The jobapp instance.
     *
     * @var App\Models\User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $fr, string $sub, string $vue)
    {
        $this->user = $user;
        $this->fr = $fr;
        $this->sub = $sub;
         $this->vue = $vue;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fr)
            ->subject($this->sub)
            ->view($this->vue);
    }
}

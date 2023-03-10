<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reminder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $sub="Shaikha's Closet";
        if(session()->has('sub')&&session()->get('sub')!=''){
            $sub=session()->get('sub');
            session()->forget('sub');
        }
        return $this->subject($sub)->view('mailrepass');
    }
}

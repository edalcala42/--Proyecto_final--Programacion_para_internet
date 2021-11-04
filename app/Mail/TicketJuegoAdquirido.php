<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketJuegoAdquirido extends Mailable
{
    use Queueable, SerializesModels;
    public $ticket;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ticket = "Adquiriste el juego!";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('juegos@adquiridos.test', 'Juego Adquirido')->view('emails.juego-adquirido');
    }
}

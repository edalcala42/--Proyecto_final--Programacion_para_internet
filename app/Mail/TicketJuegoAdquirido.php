<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Juego;
use App\Models\User;

class TicketJuegoAdquirido extends Mailable
{
    use Queueable, SerializesModels;
    public $ticket;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Juego $juego)
    {
        $this->ticket = "
        Felicidades, $user->name.\n
        Adquiriste $juego->titulo al precio de: $ $juego->precio mxn.";
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

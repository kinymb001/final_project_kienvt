<?php

namespace App\Services;

use App\Mail\TicketCreatedMail;
use Illuminate\Support\Facades\Mail;

class SendTicketCreatedEmail
{
    public function send($user, $ticket)
    {
        // Gửi email cho người tạo ticket
        Mail::to($user->email)->send(new TicketCreatedMail($ticket));
    }
}

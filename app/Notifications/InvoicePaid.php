<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use App\invoices;

class InvoicePaid extends Notification
{
    use Queueable;
    private $invoices;


    public function __construct( $invoices)
    {
        $this->invoices = $invoices;
    }


    public function via($notifiable)
    {
        return ['database'];
    }


    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }


    // public function toArray($notifiable)
    // {
    //     return [
    //     //
    //     ];
    // }

    public function toDatabase($notifiable){
        return [
            'id'=>$this->invoices->id,
            'title'=>'تم الدفع بواسطة',
            'user' => Auth::user()->name
        ];
    }



}

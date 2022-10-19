<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class mailSend extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(string $mailType, array $cart, int $total, string $name, string $postal, string $address, string $tel, string $mail)
    {
        $this->mailType = $mailType;
        $this->cart = $cart;
        $this->total = $total;
        $this->name = $name;
        $this->postal = $postal;
        $this->address = $address;
        $this->tel = $tel;
        $this->mail = $mail;
    }

    public function build()
    {
        if ($this->mailType === 'returnMail') {
            return $this->from('4leafclover1214@gmail.com')
                ->subject('ご購入ありがとうございました。')
                ->view('mail.return')
                ->with([
                    'cart' => $this->cart,
                    'total' => $this->total,
                    'name' => $this->name,
                    'postal' => $this->postal,
                    'address' => $this->address,
                    'tel' => $this->tel,
                    'mail' => $this->mail
                ]);
        }
        if ($this->mailType === 'adminMail') {
            return $this->from('4leafclover1214@gmail.com')
                ->subject('注文がありました。')
                ->view('mail.admin')
                ->with([
                    'cart' => $this->cart,
                    'total' => $this->total,
                    'name' => $this->name,
                    'postal' => $this->postal,
                    'address' => $this->address,
                    'tel' => $this->tel,
                    'mail' => $this->mail
                ]);
        }
    }
}
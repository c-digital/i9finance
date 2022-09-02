<?php

namespace App\Mail;

use App\Utility;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Storage;

class ContractEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $contract;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contract)
    {
        $this->contract = $contract;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $contract = $this->contract;

        $logo = asset(Storage::url('uploads/logo/'));

        $vars['[customer_name]'] = $contract->customer->name;
        $vars['[customer_contact]'] = $contract->customer->contact;
        $vars['[customer_email]'] = $contract->customer->email;

        $vars['[billing_name]'] = $contract->billing_name;
        $vars['[billing_country]'] = $contract->billing_country;
        $vars['[billing_state]'] = $contract->billing_state;
        $vars['[billing_city]'] = $contract->billing_city;
        $vars['[billing_phone]'] = $contract->billing_phone;
        $vars['[billing_zipcode]'] = $contract->billing_zipcode;
        $vars['[billing_address]'] = $contract->billing_address;

        $vars['[shipping_name]'] = $contract->shipping_name;
        $vars['[shipping_country]'] = $contract->shipping_country;
        $vars['[shipping_state]'] = $contract->shipping_state;
        $vars['[shipping_city]'] = $contract->shipping_city;
        $vars['[shipping_phone]'] = $contract->shipping_phone;
        $vars['[shipping_zipcode]'] = $contract->shipping_zipcode;
        $vars['[shipping_address]'] = $contract->shipping_address;

        $vars['[project]'] = $contract->project;
        $vars['[theme]'] = $contract->theme;
        $vars['[amount]'] = $contract->amount;
        $vars['[type]'] = $contract->type;
        $vars['[date_start]'] = $contract->date_start;
        $vars['[date_end]'] = $contract->date_end;


        $filename = Str::slug($contract->theme) . '.pdf';
        $filename = storage_path() . '/pdf/' . $filename;

        $pdf = Pdf::loadView('contracts.pdf', compact('contract', 'logo', 'vars'));
        $pdf->download($filename);

        $this->from('info@i9finance.com')
            ->subject(__('Contract'))
            ->view('email.contract')
            ->attach($filename);
    }
}

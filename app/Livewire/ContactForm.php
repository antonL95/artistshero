<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Mail\ContactFormMail;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Rule;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class ContactForm extends Component
{
    use Interactions;

    #[Rule('required')]
    public string $name = '';

    #[Rule(['required', 'email'])]
    public string $email = '';

    #[Rule('required')]
    public string $subject = '';

    #[Rule(['required', 'min:10'])]
    public string $message = '';


    public function sendMessage(): void
    {
        $data = $this->validate();

        Mail::to('info@artistshero.com')->send(
            new ContactFormMail(
                $data['email'],
                $data['name'],
                $data['subject'],
                $data['message'],
            ),
        );

        $this->toast()->success('Email sent!', 'Email sent successfully')->send();

        $this->reset();
    }


    public function render(): View
    {
        return view('livewire.contact-form');
    }
}

<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Rule;
use App\Models\Contact as ContactModel;
use App\Mail\ContactFormReceived;
use App\Mail\ContactFormAutoReply;
use Illuminate\Support\Facades\Mail;

#[Layout('components.layouts.app')]
#[Title('Contact Us — CenBa Africa Business Excellence Awards')]
class Contact extends Component
{
    #[Rule('required|string|max:160')]
    public string $name = '';

    #[Rule('required|email|max:255')]
    public string $email = '';

    #[Rule('nullable|string|max:30')]
    public string $phone = '';

    #[Rule('nullable|string|max:160')]
    public string $subject = '';

    #[Rule('required|string|min:10|max:2000')]
    public string $message = '';

    public bool $submitted = false;

    public function send(): void
    {
        $this->validate();

        $contact = ContactModel::create([
            'name'    => $this->name,
            'email'   => $this->email,
            'phone'   => $this->phone ?: null,
            'subject' => $this->subject ?: null,
            'message' => $this->message,
        ]);

        // Notify admin
        Mail::to(config('mail.admin_address', env('ADMIN_NOTIFY_EMAIL')))
            ->queue(new ContactFormReceived($contact));

        // Auto-reply to sender
        Mail::to($this->email)
            ->queue(new ContactFormAutoReply($contact));

        $this->reset(['name', 'email', 'phone', 'subject', 'message']);
        $this->submitted = true;
    }

    public function render()
{
    $hash = '#';
    $schema = '<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ContactPage",
    "@id": "' . route('contact') . $hash . 'webpage",
    "url": "' . route('contact') . '",
    "name": "Contact Us — CenBa Africa Business Excellence Awards",
    "isPartOf": { "@id": "' . url('/') . $hash . 'website" },
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "' . route('home') . '" },
            { "@type": "ListItem", "position": 2, "name": "Contact Us", "item": "' . route('contact') . '" }
        ]
    },
    "inLanguage": "en"
}
</script>';

    return view('livewire.pages.contact')->with('schema', $schema);
}
}
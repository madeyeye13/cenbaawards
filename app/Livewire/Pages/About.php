<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Setting;

#[Layout('components.layouts.app')]
#[Title('About Us — CenBa Africa Business Excellence Awards')]
class About extends Component
{
    public array $faqs = [];
    public ?int $activeFaq = null;
    public ?string $heroImage = null;
    public ?string $aboutImage1 = null;
    public ?string $aboutImage2 = null;
    public ?string $historyImage = null;
    public ?string $instituteImage1 = null;
    public ?string $instituteImage2 = null;

    public function mount(): void
    {
        $this->faqs = [
            [
                'question' => 'What is CenBa Africa Business Excellence Award?',
                'answer'   => 'The CenBa Africa Business Excellence Awards celebrate outstanding achievements in business across Africa, recognizing innovation, leadership, and excellence in various industries.',
            ],
            [
                'question' => 'Who can participate in the awards?',
                'answer'   => 'The awards are open to businesses of all sizes operating in Africa, including startups, SMEs, and large corporations across various sectors.',
            ],
            [
                'question' => 'How can I nominate a business or myself for an award?',
                'answer'   => 'Nominations can be submitted through our official website during the nomination period. Detailed guidelines and criteria for each category are provided on the official website at www.cenbabusinessaward.com.',
            ],
            [
                'question' => 'What categories are available for nomination?',
                'answer'   => 'Categories include Best Startup, Most Innovative Company, Excellence in Customer Service, FMCG Sector, Creativity and Innovation, Social Impact, Mining, Beverage, Rural Banks, Herbal Industry, Tourism and Hospitality, Agriculture, and several industry-specific awards.',
            ],
            [
                'question' => 'What is the judging process?',
                'answer'   => 'A panel of industry experts evaluates the nominations based on predefined criteria. The evaluation includes a review of submitted documentation and may involve interviews or site visits.',
            ],
            [
                'question' => 'When will the winners be announced?',
                'answer'   => 'Winners will be announced at the awards ceremony, typically held in November/December every year. The 2026 ceremony is scheduled for 28th November 2026 at Golden Bean Hotel, Kumasi.',
            ],
            [
                'question' => 'Is there a fee to enter the awards?',
                'answer'   => 'Please refer to the nomination guidelines on our website for detailed information on any applicable fees.',
            ],
            [
                'question' => 'How can I attend the awards ceremony?',
                'answer'   => 'All award winners are issued a ticket to the awards ceremony. Details about the venue and date will be communicated to all participants.',
            ],
            [
                'question' => 'Can I sponsor the awards?',
                'answer'   => 'Yes, sponsorship opportunities are available. Interested parties can contact us via our website for more information on sponsorship packages.',
            ],
            [
                'question' => 'Who can I contact for more information?',
                'answer'   => 'For additional inquiries, please reach out via the contact form on the website, send a WhatsApp message to +233 549 404 274, or email cenbaeducation@gmail.com.',
            ],
        ];
        $this->heroImage      = Setting::get('about_hero_image');
        $this->aboutImage1    = Setting::get('about_image_1');
        $this->aboutImage2    = Setting::get('about_image_2');
        $this->historyImage   = Setting::get('about_history_image');
        $this->instituteImage1 = Setting::get('about_institute_image_1');
        $this->instituteImage2 = Setting::get('about_institute_image_2');
    }

    public function toggleFaq(int $index): void
    {
        $this->activeFaq = $this->activeFaq === $index ? null : $index;
    }

    public function render()
{
    $hash = '#';
    $schema = '<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "AboutPage",
    "@id": "' . route('about') . $hash . 'webpage",
    "url": "' . route('about') . '",
    "name": "About CenBa Africa Business Excellence Awards",
    "description": "Celebrating Africa\'s finest businesses since 2016.",
    "isPartOf": { "@id": "' . url('/') . $hash . 'website" },
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "' . route('home') . '" },
            { "@type": "ListItem", "position": 2, "name": "About Us", "item": "' . route('about') . '" }
        ]
    },
    "inLanguage": "en"
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "What is CenBa Africa Business Excellence Award?",
            "acceptedAnswer": { "@type": "Answer", "text": "The CenBa Africa Business Excellence Awards celebrate outstanding achievements in business across Africa, recognizing innovation, leadership, and excellence in various industries." }
        },
        {
            "@type": "Question",
            "name": "Who can participate in the awards?",
            "acceptedAnswer": { "@type": "Answer", "text": "The awards are open to businesses of all sizes operating in Africa, including startups, SMEs, and large corporations across various sectors." }
        },
        {
            "@type": "Question",
            "name": "How can I nominate a business for an award?",
            "acceptedAnswer": { "@type": "Answer", "text": "Nominations can be submitted through our official website during the nomination period at www.cenbabusinessaward.com." }
        },
        {
            "@type": "Question",
            "name": "When will the winners be announced?",
            "acceptedAnswer": { "@type": "Answer", "text": "Winners will be announced at the awards ceremony scheduled for 28th November 2026 at Golden Bean Hotel, Kumasi." }
        },
        {
            "@type": "Question",
            "name": "Can I sponsor the awards?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes, sponsorship opportunities are available. Contact us via the website contact form for more information." }
        }
    ]
}
</script>';

    return view('livewire.pages.about')->with('schema', $schema);
}
}
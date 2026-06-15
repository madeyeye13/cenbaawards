<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('About Us — CenBa Africa Business Excellence Awards')]
class About extends Component
{
    public array $faqs = [];
    public ?int $activeFaq = null;

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
    }

    public function toggleFaq(int $index): void
    {
        $this->activeFaq = $this->activeFaq === $index ? null : $index;
    }

    public function render()
    {
        return view('livewire.pages.about');
    }
}
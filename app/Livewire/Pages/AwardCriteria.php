<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Setting;

#[Layout('components.layouts.app')]
#[Title('Award Criteria — CenBa Africa Business Excellence Awards')]
class AwardCriteria extends Component
{
    public array $criteria = [];
    public array $eligibility = [];
    public ?string $heroImage = null;

    public function mount(): void
    {
        $this->criteria = [
            ['title' => 'Excellence', 'body' => 'Evaluates the level of achievement or accomplishment in a particular field — assessing the quality of work, performance, or contribution to the field.'],
            ['title' => 'Innovation', 'body' => 'Recognises individuals or organisations that have introduced novel ideas, methods, or solutions. Innovation is seen as a driving force for progress and positive change.'],
            ['title' => 'Impact', 'body' => 'Focuses on recognising individuals or initiatives that have made a significant impact in a specific area — social, cultural, environmental, or scientific.'],
            ['title' => 'Leadership', 'body' => 'Looks at individuals who have demonstrated exceptional leadership qualities, such as inspiring and motivating others, driving change, and achieving notable results.'],
        ];

        $this->eligibility = [
            ['title' => 'Established Businesses', 'body' => 'Companies that have been operational for at least one year and demonstrate significant achievements.'],
            ['title' => 'Startups', 'body' => 'New businesses within their first three years that show remarkable growth and potential.'],
            ['title' => 'Nonprofits and NGOs', 'body' => 'Organisations making impactful contributions to their communities and industries.'],
            ['title' => 'Public and Private Sector Entities', 'body' => 'Institutions committed to excellence and innovation in their operations.'],
        ];

        $this->heroImage = Setting::get('criteria_hero_image');
    }

    public function render()
{
    $hash = '#';
    $schema = '<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "@id": "' . route('award.criteria') . $hash . 'webpage",
    "url": "' . route('award.criteria') . '",
    "name": "Award Criteria — CenBa Africa Business Excellence Awards",
    "isPartOf": { "@id": "' . url('/') . $hash . 'website" },
    "inLanguage": "en"
}
</script>';

    return view('livewire.pages.award-criteria')->with('schema', $schema);
}
}
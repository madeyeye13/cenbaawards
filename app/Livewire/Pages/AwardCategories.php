<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Award Categories — CenBa Africa Business Excellence Awards')]
class AwardCategories extends Component
{
    public array $industryCategories = [];
    public array $sectorCategories = [];

    public function mount(): void
    {
        $this->industryCategories = [
            ['name' => 'FMCG Sector', 'body' => 'The Fast Moving Consumer Goods (FMCG) Award recognises outstanding performance and impact of companies in the FMCG sector.'],
            ['name' => 'Creativity and Innovation Sector', 'body' => 'Recognising outstanding creativity and innovation in various fields, such as arts, sciences, technology, and business.'],
            ['name' => 'Social Impact Sector', 'body' => 'Designed to recognise outstanding performance and impact of individuals, organisations, and businesses making a positive difference in their communities and beyond.'],
            ['name' => 'Mining Sector', 'body' => 'Designed to recognise outstanding performance and impact of individuals, organisations, and businesses in the mining industry.'],
            ['name' => 'Beverage Sector', 'body' => 'Recognising outstanding performance and impact of individuals, organisations, and businesses in the beverage industry.'],
            ['name' => 'Rural Banks', 'body' => 'Recognising outstanding performance and impact of rural banks in serving their communities.'],
            ['name' => 'Herbal Industry', 'body' => 'Recognising outstanding performance of companies in the herbal industry, including natural health products, herbal supplements, and traditional medicines.'],
            ['name' => 'Tourism and Hospitality Sector', 'body' => 'Recognising companies in the tourism industry, including hotels, resorts, travel agencies, airlines, and other hospitality businesses.'],
            ['name' => 'Agric Sector', 'body' => 'Recognising outstanding performance and impact of individuals, organisations, and businesses in the agricultural sector.'],
        ];

        $this->sectorCategories = [
            ['name' => 'Corporate Social Responsibility', 'body' => 'A company that believes in giving back to the community, actively participates in philanthropic initiatives, supports environmentally friendly practices, and contributes to charitable causes.'],
            ['name' => 'Business Sustainability Award', 'body' => 'Recognising businesses that have demonstrated exceptional commitment to sustainable practices and reducing their environmental impact.'],
            ['name' => 'Creativity & Innovation Award', 'body' => 'Recognising businesses that have introduced new and innovative products, flavours, or packaging that improved customer satisfaction and increased sales.'],
            ['name' => 'Environmental Sustainability Award', 'body' => 'Recognising businesses that have demonstrated exceptional commitment to sustainable practices and reducing their environmental impact.'],
            ['name' => 'Lifetime Achievement Award', 'body' => 'Recognising individuals who have made exceptional contributions in their respective industries throughout their careers and significant impact in their communities.'],
            ['name' => 'Best Brand Development', 'body' => 'Recognising continuous brand development crucial to attracting new investors, partners and customers, remaining competitive and well-positioned for future growth.'],
            ['name' => 'Outstanding Customer Focus Award', 'body' => 'For an organisation that goes the extra mile and builds itself around the needs and wants of its target market, providing services that meet customers\' expectations.'],
        ];
    }

    public function render()
    {
        return view('livewire.pages.award-categories');
    }
}
<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TablePackage;
use App\Models\Setting;

/**
 * Reusable public section listing active Award Table Packages plus the
 * site-wide "no cost to apply" note. Drop it into any page with:
 *   <livewire:award-table-packages />
 */
class AwardTablePackages extends Component
{
    public function render()
    {
        $packages = TablePackage::where('is_active', true)->orderBy('sort_order')->get();
        $note = Setting::get('table_packages_note', 'There is no cost in submitting an application form.');

        return view('livewire.award-table-packages', compact('packages', 'note'));
    }
}

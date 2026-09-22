<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * The original 2026_09_22_120000 migration already ran on some
     * environments with the old placeholder rows ("Table for 5" etc).
     * This migration replaces whatever is currently in table_packages
     * with the three tiers the client actually confirmed, so it's safe
     * to run regardless of which seed state an environment is in.
     */
    public function up(): void
    {
        DB::table('table_packages')->delete();

        $now = now();
        DB::table('table_packages')->insert([
            [
                'name' => 'CABEA – Gold Table',
                'seats' => 4,
                'price' => 11500.00,
                'features' => json_encode([
                    'Near-stage seating optimized for prime networking',
                    'A red carpet video interview',
                    'Free training for staff and management of your company',
                    'A feature in the "Success Stories" section of the CABEA Magazine',
                    'A full interview on the My Business Doctor TV Show on Oyerepa & Promise TV',
                    'A free advert placement in the Citi Business Directory for one year',
                ]),
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'CABEA – Silver Table',
                'seats' => 3,
                'price' => 9500.00,
                'features' => json_encode([
                    'Preferred seating tailored for mid-sized teams',
                    'Professional high-resolution stage photography of your award moment',
                    'A colour page company profile in the CABEA Magazine',
                    'A full interview on the My Business Doctor TV Show on Oyerepa & Promise TV',
                    'A free advert placement in the Citi Business Directory for one year',
                ]),
                'sort_order' => 2,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Bronze Table',
                'seats' => 2,
                'price' => 8000.00,
                'features' => json_encode([
                    'Serves as an essential participation package',
                    'A 3-course gourmet dinner and the official Digital Excellence Seal',
                    'A colour page company profile in the CABEA Magazine',
                    'A full interview on the My Business Doctor TV Show on Oyerepa & Promise TV',
                    'A free advert placement in the Citi Business Directory for one year',
                ]),
                'sort_order' => 3,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('table_packages')->whereIn('name', [
            'CABEA – Gold Table',
            'CABEA – Silver Table',
            'Bronze Table',
        ])->delete();
    }
};

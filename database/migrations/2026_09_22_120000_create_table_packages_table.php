<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('table_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedTinyInteger('seats');
            $table->decimal('price', 10, 2);
            $table->json('features')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed the packages the client confirmed for the Awards & Dinner Night,
        // so a fresh `php artisan migrate` is all that's needed on deploy.
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
        Schema::dropIfExists('table_packages');
    }
};

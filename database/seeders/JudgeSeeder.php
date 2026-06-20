<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Judge;

class JudgeSeeder extends Seeder
{
    public function run(): void
    {
        $judges = [
            [
                'name' => 'Prof. Faisal Idris',
                'title' => 'Dean, Faculty of Business Education',
                'organization' => 'University of Skills Training and Entrepreneurial Development (USTED)',
                'location' => 'Kumasi, Ashanti Region, Ghana',
                'bio' => 'Prof. Faisal Idris brings extensive teaching experience in business education and entrepreneurship. He has held leadership roles in various academic committees and initiatives aimed at enhancing educational quality and fostering student engagement. He emphasizes the importance of collaboration between academia and industry to enhance educational outcomes.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Andrews Ayiku',
                'title' => 'Lecturer',
                'organization' => 'University of Professional Studies (UPSA)',
                'location' => 'Accra, Ghana',
                'bio' => 'Dr. Andrew Ayiku has over ten years of experience as a Business and Marketing Strategy Consultant, with a focus on business and marketing strategy. He has served as a consultant for various organizations, aiding in the development and implementation of effective marketing strategies, and actively engages in curriculum development to align academic programs with industry needs.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Fabio Petroni',
                'title' => 'Director of Programs',
                'organization' => 'E4Impact Foundation',
                'location' => 'Italy',
                'bio' => 'Fabio has been a pivotal figure in the E4Impact initiative since 2013, becoming Director of Programs in 2015. He manages the E4Impact Alliance, coordinating MBA programs and driving expansion into African countries. He holds a Master\'s Degree in International Relations and a Bachelor\'s Degree in Business Administration, and is dedicated to promoting sustainable development through entrepreneurship in emerging economies.',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Isaac Tweneboah-Koduah, PhD',
                'title' => 'Lead Consultant & Lecturer',
                'organization' => 'HiPAG Services / Garden City University College (GCUC)',
                'location' => 'Kumasi, Ghana',
                'bio' => 'Dr. Isaac Tweneboah-Koduah is a seasoned strategic marketing innovation and entrepreneurship professional with over 16 years of experience across various industries. A Chartered Marketer, he is dedicated to empowering SME CEOs through enterprise development strategies, training programs, and innovative marketing solutions.',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Luther Kwame Adinkra, PhD',
                'title' => 'Head of Programs',
                'organization' => 'Pure F.M',
                'location' => 'Kumasi, Ashanti, Ghana',
                'bio' => 'Luther Kwame Adinkra is dedicated to pushing the boundaries of media and arts, consistently delivering impactful content and innovative strategies in the ever-evolving media landscape. He holds a Master of Philosophy in Communication Design and a Bachelor of Arts in Graphic Design, both from Kwame Nkrumah University of Science and Technology (KNUST).',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($judges as $judge) {
            Judge::create($judge);
        }
    }
}
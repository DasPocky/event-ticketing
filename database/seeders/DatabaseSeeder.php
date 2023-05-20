<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'Dennis Schwerdt',
            'email' => 'ds@s-vtec.de',
            'password' => bcrypt('ChangeMe2023#'),
        ]);
        $user->organizer()->create([
            'user_id' => $user->id,
            'name' => 'Schwerdt Veranstaltungstechnik',
            'address' => 'Tulpenweg 6',
            'zip' => '41517',
            'city' => 'Grevenbroich',
            'country' => 'Deutschland',
            'email' => 'info@s-vtec.de',
            'phone' => '+49 2181 819 99 99',
            'website' => 'https://www.s-vtec.de',
        ]);

        $eventCategories = [
            'Musik' => ['Rock', 'Pop', 'Jazz', 'Klassik', 'Hip-Hop', 'Country', 'Blues', 'Reggae', 'Electro', 'Indie'],
            'Sport' => ['Fußball', 'Basketball', 'Tennis', 'E-Sports', 'Laufen', 'Schwimmen', 'Radfahren', 'Baseball', 'Rugby', 'Boxen'],
            'Bildung' => ['Workshops', 'Seminare', 'Vorlesungen', 'Webinare', 'Kongresse', 'Symposien', 'Buchlesungen', 'Diskussionsrunden', 'Studiengruppen', 'Tutorien'],
            'Kultur' => ['Theater', 'Museum', 'Galerieausstellung', 'Filmvorführung', 'Oper', 'Ballett', 'Kunstinstallation', 'Skulptur', 'Fotografie', 'Street Art'],
            'Unterhaltung' => ['Comedy', 'Zirkus', 'Magic Shows', 'Kabarett', 'Stand-Up', 'Quiznacht', 'Karaoke', 'Live Podcast', 'Buchclub', 'Theaterstücke'],
            'Gesundheit' => ['Yoga', 'Pilates', 'Meditation', 'Wellness Retreat', 'Ernährungsworkshop', 'Laufgruppe', 'Fitnessklasse', 'Massageworkshop', 'Gesundheitsseminar', 'Detox Retreat'],
            'Essen & Trinken' => ['Weinprobe', 'Bierfest', 'Food Festival', 'Kochkurs', 'Barista Kurs', 'Cocktail Workshop', 'Gourmet Dinner', 'Street Food Markt', 'Bäckerei Tour', 'Whisky Verkostung'],
            'Technologie' => ['Coding Bootcamp', 'Hackathon', 'Tech Meetup', 'Gaming Convention', 'Product Demo', 'Startup Pitch', 'Tech Talk', 'Robotik Workshop', 'Data Science Seminar', 'AI Konferenz'],
        ];

        foreach ($eventCategories as $categoryName => $subCategories) {
            $category = Category::create(['name' => $categoryName]);

            foreach ($subCategories as $subCategoryName) {
                SubCategory::create([
                    'category_id' => $category->id,
                    'name' => $subCategoryName
                ]);
            }

        }

        $eventTags = [
            'Outdoor',
            'Indoor',
            'Familienfreundlich',
            'Kostenlos',
            'VIP',
            'Bildung',
            'Netzwerk',
            'Charity',
            'Live-Musik',
            'Essen und Trinken',
            'Kunst',
            'Theater',
            'Sport',
            'Technologie',
            'Gesundheit und Wellness',
            'Film',
            'Fotografie',
            'Buchlesung',
            'Diskussion',
            'Workshop',
            'Seminar',
            'Konferenz',
            'Festival',
            'Wettbewerb',
            'Nachtveranstaltung'
        ];

        foreach ($eventTags as $tagName) {
            if (!Tag::where('name', $tagName)->exists()) {
                Tag::create(['name' => $tagName]);
            }
        }

    }
}

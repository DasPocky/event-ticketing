<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\Venue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Exception;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $organizer = \App\Models\User::factory()->create([
            'name' => 'Dennis Schwerdt',
            'email' => 'ds@s-vtec.de',
            'password' => bcrypt('ChangeMe2023#'),
        ]);
        $organizer->organizer()->create([
            'user_id' => $organizer->id,
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

        $venue = Venue::factory()->create([
            'user_id' => $organizer->id,
            'name' => '1. FC Grevenbroich-Süd',
            'address' => 'Haupstr. 150',
            'zip' => '41517',
            'city' => 'Grevenbroich',
            'country' => 'Deutschland',
            'contact_name' => 'Dennis Schwerdt',
            'contact_phone' => '+49 2181 819 99 99',
            'contact_email' => 'info@s-vtec.de',
            'notes' => 'Notes zur Location',
        ]);

        $event = \App\Models\Event::factory()->create([
            'user_id' => $organizer->id,
            'category_id' => 1,
            'sub_category_id' => 1,
            'venue_id' => $venue->id,
            'title' => 'Süd Rock',
            'description' => 'Süd Rock ist ein Rockfestival in Grevenbroich',
            'entry_datetime' => '2022-07-08 17:00:00',
            'start_datetime' => '2022-07-08 18:00:00',
            'end_datetime' => '2022-07-08 23:00:00',
            'status' => 1,
            'website' => 'https://www.suedrock.de'
        ]);

        $ticket = \App\Models\Ticket::factory()->create([
            'event_id' => $event->id,
            'name' => 'VIP Ticket',
            'quantity' => 100,
        ]);

        $ticket = \App\Models\Ticket::factory()->create([
            'event_id' => $event->id,
            'name' => 'Normales Ticket',
            'quantity' => 500,
        ]);

        $ticket = \App\Models\Ticket::factory()->create([
            'event_id' => $event->id,
            'name' => 'Senioren Ticket',
            'quantity' => 500,
        ]);

        $ticket = \App\Models\Ticket::factory()->create([
            'event_id' => $event->id,
            'name' => 'Kinder Ticket',
            'quantity' => 500,
        ]);

        $customer = \App\Models\User::factory()->create([
            'name' => 'Björn End',
            'email' => 'bjoern@endmail.de',
            'password' => bcrypt('ChangeMe2023#'),
        ]);
        $customer->customer()->create([
            'user_id' => $customer->id,
            'address' => 'Briedestraße 80',
            'zip' => '40599',
            'city' => 'Düsseldorf',
            'country' => 'Deutschland',
            'phone' => '+49 173 45 22 65 2',
        ]);

    }
}

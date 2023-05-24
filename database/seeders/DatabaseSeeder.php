<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\Ticket;
use App\Models\TicketGroup;
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
        // Prüfe ob der Ordner storage/app/public/images/events und /app/public/images/venues existiert, wenn Ja, dann lösche diese Ordner mit Inhalt und lege Sie neu an

        if (Storage::exists('public/images/events')) {
            Storage::deleteDirectory('public/images/events');
            Storage::makeDirectory('public/images/events');
        } else {
            Storage::makeDirectory('public/images/events');
        }

        if (Storage::exists('public/images/venues')) {
            Storage::deleteDirectory('public/images/venues');
            Storage::makeDirectory('public/images/venues');
        } else {
            Storage::makeDirectory('public/images/venues');
        }

        // Benutzer anlegen
        $organizer = \App\Models\User::factory()->create([
            'name' => 'Dennis Schwerdt',
            'email' => 'ds@s-vtec.de',
            'password' => bcrypt('ChangeMe2023#'),
        ]);

        // Organizer anlegen
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

        $ticketGroup = TicketGroup::factory()->create([
            'name' => 'VIP',
            'event_id' => $event->id,
            'quantity_total' => 100,
            'quantity_sold' => 0
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'VIP Ticket',
            'quantity_sold' => 0,
            'price' => 100.00
        ]);

        $ticketGroup = TicketGroup::factory()->create([
            'name' => 'Normal',
            'event_id' => $event->id,
            'quantity_total' => 100,
            'quantity_sold' => 0
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Erwachsener',
            'quantity_sold' => 0,
            'price' => 65.00
        ]);


        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Kind',
            'quantity_sold' => 0,
            'price' => 20.00
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Senioren',
            'quantity_sold' => 0,
            'price' => 45.00
        ]);

        $venue = Venue::factory()->create([
            'user_id' => $organizer->id,
            'name' => 'Olympiastadion Berlin',
            'address' => 'Olympischer Platz 3',
            'zip' => '14053',
            'city' => 'Berlin',
            'country' => 'Deutschland',
            'contact_name' => 'Johannes Bauer',
            'contact_phone' => '+49 30 30688100',
            'contact_email' => 'info@olympiastadion.berlin',
            'notes' => 'Das Olympiastadion Berlin befindet sich im Westend im Bezirk Charlottenburg-Wilmersdorf.',
        ]);

        $event = \App\Models\Event::factory()->create([
            'user_id' => $organizer->id,
            'category_id' => 1,
            'sub_category_id' => 1,
            'venue_id' => $venue->id,
            'title' => 'Berlin Rocks',
            'description' => 'Berlin Rocks ist ein großes Rockfestival im Olympiastadion Berlin.',
            'entry_datetime' => '2023-08-12 16:00:00',
            'start_datetime' => '2023-08-12 18:00:00',
            'end_datetime' => '2023-08-13 23:00:00',
            'status' => 1,
            'website' => 'https://www.berlinrocks.de'
        ]);

        $ticketGroup = TicketGroup::factory()->create([
            'name' => 'Loge',
            'event_id' => $event->id,
            'quantity_total' => 100,
            'quantity_sold' => 0
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Erwachsener',
            'quantity_sold' => 0,
            'price' => 185.00
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Kind',
            'quantity_sold' => 0,
            'price' => 130.00
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Senior',
            'quantity_sold' => 0,
            'price' => 160.00
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Schüler/Studenten',
            'quantity_sold' => 0,
            'price' => 145.00
        ]);
        $ticketGroup = TicketGroup::factory()->create([
            'name' => 'Normal',
            'event_id' => $event->id,
            'quantity_total' => 500,
            'quantity_sold' => 0
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Erwachsener',
            'quantity_sold' => 0,
            'price' => 85.00
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Kind',
            'quantity_sold' => 0,
            'price' => 30.00
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Senior',
            'quantity_sold' => 0,
            'price' => 60.00
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Schüler/Studenten',
            'quantity_sold' => 0,
            'price' => 45.00
        ]);

        $venue = Venue::factory()->create([
            'user_id' => $organizer->id,
            'name' => 'Olympiastadion München',
            'address' => 'Spiridon-Louis-Ring 21',
            'zip' => '80809',
            'city' => 'München',
            'country' => 'Deutschland',
            'contact_name' => 'Martin Schmidt',
            'contact_phone' => '+49 89 30670',
            'contact_email' => 'info@olympiapark.de',
            'notes' => 'Das Olympiastadion befindet sich im Olympiapark München im Bezirk Milbertshofen-Am Hart.',
        ]);

        $event = \App\Models\Event::factory()->create([
            'user_id' => $organizer->id,
            'category_id' => 1,
            'sub_category_id' => 1,
            'venue_id' => $venue->id,
            'title' => 'München Rockt',
            'description' => 'München Rockt ist ein großes Rockfestival im Olympiastadion München.',
            'entry_datetime' => '2023-09-01 16:00:00',
            'start_datetime' => '2023-09-01 18:00:00',
            'end_datetime' => '2023-09-02 03:00:00',
            'status' => 1,
            'website' => 'https://www.muenchenrockt.de'
        ]);

        $ticketGroup = TicketGroup::factory()->create([
            'name' => 'Premium',
            'event_id' => $event->id,
            'quantity_total' => 120,
            'quantity_sold' => 0
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Erwachsener',
            'quantity_sold' => 0,
            'price' => 185.00
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Kind',
            'quantity_sold' => 0,
            'price' => 40.00
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Senior',
            'quantity_sold' => 0,
            'price' => 75.00
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Schüler/Studenten',
            'quantity_sold' => 0,
            'price' => 60.00
        ]);

        $ticketGroup = TicketGroup::factory()->create([
            'name' => 'Standard',
            'event_id' => $event->id,
            'quantity_total' => 250,
            'quantity_sold' => 0
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Erwachsener',
            'quantity_sold' => 0,
            'price' => 100.00
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Kind',
            'quantity_sold' => 0,
            'price' => 35.00
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Senior',
            'quantity_sold' => 0,
            'price' => 65.00
        ]);

        $ticket = Ticket::factory()->create([
            'ticket_group_id' => $ticketGroup->id,
            'event_id' => $event->id,
            'name' => 'Schüler/Studenten',
            'quantity_sold' => 0,
            'price' => 50.00
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

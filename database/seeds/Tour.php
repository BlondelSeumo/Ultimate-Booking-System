<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;
use Modules\Tour\Models\TourCategory;

use Modules\Review\Models\Review;
use Modules\Review\Models\ReviewMeta;

class Tour extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories =  [
            ['name' => 'City trips', 'content' => '', 'status' => 'publish',],
            ['name' => 'Ecotourism', 'content' => '', 'status' => 'publish',],
            ['name' => 'Escorted tour', 'content' => '', 'status' => 'publish',],
            ['name' => 'Ligula', 'content' => '', 'status' => 'publish',]
        ];

        foreach ($categories as $category){
            $row = new TourCategory( $category );
            $row->save();
        }

        $list_gallery = [];
        for($i=1 ; $i <=7 ; $i++){
            $list_gallery[] = MediaFile::findMediaByName("gallery-".$i)->id;
        }

        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'American Parks Trail end Rapid City',
                'slug' => 'american-parks-trail',
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural tour Northern California Summer 2019, you have a 8 day tour package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("tour-1")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-1")->id,
                'category_id' => rand(1, 4),
                'location_id' => 1,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'address' => "Arrondissement de Paris",
                'is_featured' => "0",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "2000",
                'sale_price' => rand(100, 800),
                'map_lat' => "48.852754",
                'map_lng' => "2.339155",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'max_people' => rand(10,20),
                'min_people' =>1,
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]);
        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'New York: Museum of Modern Art',
                'slug' => Str::slug('New York: Museum of Modern Art', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural tour Northern California Summer 2019, you have a 8 day tour package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("tour-2")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-2")->id,
                'category_id' => rand(1, 4),
                'location_id' => 1,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'address' => "Porte de Vanves",
                'is_featured' => "1",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "900",
                'sale_price' => rand(100, 800),
                'map_lat' => "48.853917",
                'map_lng' => "2.307199",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'max_people' => rand(10,20),
                'min_people' =>1,
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]);
        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'Los Angeles to San Francisco Express',
                'slug' => Str::slug('Los Angeles to San Francisco Express', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural tour Northern California Summer 2019, you have a 8 day tour package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("tour-3")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-3")->id,
                'category_id' => rand(1, 4),
                'location_id' => 1,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'address' => "Petit-Montrouge",
                'is_featured' => "1",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "1500",
                'sale_price' => rand(100, 800),
                'map_lat' => "48.884900",
                'map_lng' => "2.346377",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'max_people' => rand(10,20),
                'min_people' =>1,
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]);
        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'Paris Vacation Travel ',
                'slug' => Str::slug('Paris Vacation Travel ', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural tour Northern California Summer 2019, you have a 8 day tour package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("tour-4")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-4")->id,
                'category_id' => rand(1, 4),
                'location_id' => 2 ,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'address' => "New York",
                'is_featured' => "1",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "850",
                'sale_price' => rand(100, 800),
                'map_lat' => "40.707891",
                'map_lng' => "-74.008825",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'max_people' => rand(10,20),
                'min_people' =>1,
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]);
        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'Southwest States (Ex Los Angeles) ',
                'slug' => Str::slug('Southwest States', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural tour Northern California Summer 2019, you have a 8 day tour package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("tour-5")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-5")->id,
                'category_id' => rand(1, 4),
                'location_id' => 2 ,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'address' => "Regal Cinemas Battery Park 11",
                'is_featured' => "0",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "1900",
                'sale_price' => rand(100, 1800),
                'map_lat' => "40.714578",
                'map_lng' => "-73.983888",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'max_people' => rand(10,20),
                'min_people' =>1,
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]);
        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'Eastern Discovery (Start New Orleans)',
                'slug' => Str::slug('Eastern Discovery', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural tour Northern California Summer 2019, you have a 8 day tour package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("tour-6")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-6")->id,
                'category_id' => rand(1, 4),
                'location_id' => 2,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'address' => "Prince St Station",
                'is_featured' => "1",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "2100",
                'sale_price' => rand(100, 1800),
                'map_lat' => "40.720161",
                'map_lng' => "-74.009628",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'max_people' => rand(10,20),
                'min_people' =>1,
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'Eastern Discovery (Start New Orleans)',
                'slug' => Str::slug('Eastern Discovery', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural tour Northern California Summer 2019, you have a 8 day tour package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("tour-7")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-7")->id,
                'category_id' => rand(1, 4),
                'location_id' => 2,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'address' => "Pier 36 New York",
                'is_featured' => "0",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "2100",
                'sale_price' => rand(100, 1800),
                'map_lat' => "40.708581",
                'map_lng' => "-73.998817",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'max_people' => rand(10,20),
                'min_people' =>1,
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'Pure Luxe in Punta Mita',
                'slug' => Str::slug('Pure Luxe in Punta Mita', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural tour Northern California Summer 2019, you have a 8 day tour package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("tour-8")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-8")->id,
                'category_id' => rand(1, 4),
                'location_id' => 3,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'address' => "Trimmer Springs Rd, Sanger",
                'is_featured' => "0",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "2100",
                'sale_price' => rand(100, 1800),
                'map_lat' => "36.822484",
                'map_lng' => "-119.365266",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'max_people' => rand(10,20),
                'min_people' =>1,
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'Tastes and Sounds of the South 2019',
                'slug' => Str::slug('Tastes and Sounds of the South 2019', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural tour Northern California Summer 2019, you have a 8 day tour package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("tour-9")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-9")->id,
                'category_id' => rand(1, 4),
                'location_id' => 4,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'address' => "United States",
                'is_featured' => "0",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "2100",
                'sale_price' => rand(100, 1800),
                'map_lat' => "37.040023",
                'map_lng' => "-95.643144",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'max_people' => rand(10,20),
                'min_people' =>1,
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'Giverny and Versailles Small Group Day Trip',
                'slug' => Str::slug('Giverny and Versailles Small Group Day Trip', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural tour Northern California Summer 2019, you have a 8 day tour package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("tour-10")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-10")->id,
                'category_id' => rand(1, 4),
                'location_id' => 5,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'address' => "Washington, DC, USA",
                'is_featured' => "0",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "2100",
                'sale_price' => rand(100, 1800),
                'map_lat' => "34.049345",
                'map_lng' => "-118.248479",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'max_people' => rand(10,20),
                'min_people' =>1,
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'Trip of New York – Discover America',
                'slug' => Str::slug('Trip of New York – Discover America', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural tour Northern California Summer 2019, you have a 8 day tour package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("tour-11")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-11")->id,
                'category_id' => rand(1, 4),
                'location_id' => 6,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'address' => "New Jersey",
                'is_featured' => "0",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "2100",
                'sale_price' => rand(100, 1800),
                'map_lat' => "40.035329",
                'map_lng' => "-74.417227",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'max_people' => rand(10,20),
                'min_people' =>1,
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'Segway Tour of Washington, D.C. Highlights',
                'slug' => Str::slug('Segway Tour of Washington, D.C. Highlights', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural tour Northern California Summer 2019, you have a 8 day tour package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("tour-12")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-12")->id,
                'category_id' => rand(1, 4),
                'location_id' => 7,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'address' => "Francisco Parnassus Campus",
                'is_featured' => "0",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "2100",
                'sale_price' => rand(100, 1800),
                'map_lat' => "37.782668",
                'map_lng' => "-122.425058",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'max_people' => rand(10,20),
                'min_people' =>1,
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'Hollywood Sign Small Group Tour in Luxury Van',
                'slug' => Str::slug('Hollywood Sign Small Group Tour in Luxury Van', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural tour Northern California Summer 2019, you have a 8 day tour package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("tour-13")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-13")->id,
                'category_id' => rand(1, 4),
                'location_id' => 8,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'address' => "Virginia",
                'is_featured' => "0",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "2100",
                'sale_price' => rand(100, 1800),
                'map_lat' => "37.445688",
                'map_lng' => "-78.673668",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'max_people' => rand(10,20),
                'min_people' =>1,
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'Los Angeles to San Francisco Express',
                'slug' => Str::slug('Los Angeles to San Francisco Express', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural tour Northern California Summer 2019, you have a 8 day tour package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("tour-14")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-14")->id,
                'category_id' => rand(1, 4),
                'location_id' => 7,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'address' => "Comprehensive Cancer Center",
                'is_featured' => "0",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "2100",
                'sale_price' => rand(100, 1800),
                'map_lat' => "37.757522",
                'map_lng' => "-122.447984",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'max_people' => rand(10,20),
                'min_people' =>1,
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'Cannes and Antibes Night Tour',
                'slug' => Str::slug('Cannes and Antibes Night Tour', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural tour Northern California Summer 2019, you have a 8 day tour package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("tour-15")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-15")->id,
                'category_id' => rand(1, 4),
                'location_id' => 1,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'address' => "UCSF Helen Diller Family",
                'is_featured' => "0",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "2100",
                'sale_price' => rand(100, 1800),
                'map_lat' => "48.829194",
                'map_lng' => "2.352004",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'max_people' => rand(10,20),
                'min_people' =>1,
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'River Cruise Tour on the Seine',
                'slug' => Str::slug('River Cruise Tour on the Seine', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural tour Northern California Summer 2019, you have a 8 day tour package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("tour-16")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-16")->id,
                'category_id' => rand(1, 4),
                'location_id' => 1,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'address' => "Nevada, US",
                'is_featured' => "0",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "2100",
                'sale_price' => rand(100, 1800),
                'map_lat' => "48.851338",
                'map_lng' => "2.300528",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'max_people' => rand(10,20),
                'min_people' =>1,
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );



        // Add meta for tour
        foreach ($IDs as $tour){
            DB::table('bravo_tour_meta')->insertGetId(
                [
                    'tour_id' => $tour,
                    'enable_person_types' => '1',
                    'person_types' => '[{"name":"Adult","desc":"Age 18+","min":"1","max":"10","price":"1000"},{"name":"Child","desc":"Age 6-17","min":"0","max":"10","price":"300"}]',
                    'enable_extra_price' => '1',
                    'extra_price' => '[{"name":"Clean","price":"100","type":"one_time"}]',
                ]
            );
            for ($i = 1 ; $i <= 5 ; $i++){
                if( rand(1,5) == $i) continue;
                if( rand(1,5) == $i) continue;
                $metaReview = [];
                $list_meta = [
                    "Service",
                    "Organization",
                    "Friendliness",
                    "Area Expert",
                    "Safety",
                ];
                $total_point = 0;
                foreach ($list_meta as $key => $value) {
                    $point = rand(4,5);
                    $total_point += $point;
                    $metaReview[] = [
                        "object_id"    => $tour,
                        "object_model" => "tour",
                        "name"         => $value,
                        "val"          => $point,
                        "create_user"  => "1",
                    ];
                }
                $rate = round($total_point / count($list_meta), 1);
                if ($rate > 5) $rate = 5;
                $titles = ["Great Trip","Good Trip","Trip was great","Easy way to discover the city"];
                $review = new Review([
                    "object_id"    => $tour,
                    "object_model" => "tour",
                    "title"        => $titles[rand(0, 3)],
                    "content"      => "Eum eu sumo albucius perfecto, commodo torquatos consequuntur pro ut, id posse splendide ius. Cu nisl putent omittantur usu, mutat atomorum ex pro, ius nibh nonumy id. Nam at eius dissentias disputando, molestie mnesarchum complectitur per te",
                    "rate_number"  => $rate,
                    "author_ip"    => "127.0.0.1",
                    "status"       => "approved",
                    "publish_date" => date("Y-m-d H:i:s"),
                    "create_user"  => "1",
                ]);
                if ($review->save()) {
                    if (!empty($metaReview)) {
                        foreach ($metaReview as $meta) {
                            $meta['review_id'] = $review->id;
                            $reviewMeta = new ReviewMeta($meta);
                            $reviewMeta->save();
                        }
                    }
                }
            }
        }

        // Settings Tour
        DB::table('core_settings')->insert(
            [
                [
                    'name' => 'tour_page_search_title',
                    'val' => 'Search for tour',
                    'group' => "tour",
                ],
                [
                    'name' => 'tour_page_search_banner',
                    'val' => MediaFile::findMediaByName("banner-search")->id,
                    'group' => "tour",
                ],
                [
                    'name' => 'tour_layout_search',
                    'val' => 'normal',
                    'group' => "tour",
                ],
                [
                    'name' => 'tour_enable_review',
                    'val' => '1',
                    'group' => "tour",
                ],
                [
                    'name' => 'tour_review_approved',
                    'val' => '0',
                    'group' => "tour",
                ],
                [
                    'name' => 'tour_review_stats',
                    'val' => '[{"title":"Service"},{"title":"Organization"},{"title":"Friendliness"},{"title":"Area Expert"},{"title":"Safety"}]',
                    'group' => "tour",
                ]
            ]
        );

        $a = new \Modules\Core\Models\Attributes([
            'name'=>'Travel Styles',
            'service'=>'tour'
        ]);

        $a->save();

        foreach (['Cultural','Nature & Adventure','Marine','Independent','Activities','Festival & Events','Special Interest'] as $term){
            $t = new \Modules\Core\Models\Terms([
                'name'=>$term,
                'attr_id'=>$a->id
            ]);

            $t->save();
        }

        $a = new \Modules\Core\Models\Attributes([
            'name'=>'Facilities',
            'service'=>'tour'
        ]);

        $a->save();

        foreach (['Wifi','Gymnasium','Mountain Bike','Satellite Office','Staff Lounge','Golf Cages','Aerobics Room'] as $term){
            $t = new \Modules\Core\Models\Terms([
                'name'=>$term,
                'attr_id'=>$a->id
            ]);

            $t->save();
        }
    }
}

<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Tag;
use Modules\Media\Models\MediaFile;

class News extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('core_settings')->insert(
            [
                [
                    'name' => 'news_page_list_title',
                    'val' => 'News',
                    'group' => "news",
                ],
                [
                    'name' => 'news_page_list_banner',
                    'val' => MediaFile::findMediaByName("news-banner")->id,
                    'group' => "news",
                ],
                [
                    'name' => 'news_sidebar',
                    'val' => '[{"title":null,"content":null,"type":"search_form"},{"title":"About Us","content":"Nam dapibus nisl vitae elit fringilla rutrum. Aenean sollicitudin, erat a elementum rutrum, neque sem pretium metus, quis mollis nisl nunc et massa","type":"content_text"},{"title":"Recent News","content":null,"type":"recent_news"},{"title":"Categories","content":null,"type":"category"},{"title":"Tags","content":null,"type":"tag"}]',
                    'group' => "news",
                ],
            ]
        );

        $list_categories = [
              ['name' => 'Adventure Travel', 'slug' => 'adventure-travel',  'status' => 'publish' ]
            , ['name' => 'Ecotourism', 'slug' => 'ecotourism',  'status' => 'publish' ]
            , ['name' => 'Sea Travel ', 'slug' => 'sea-travel',  'status' => 'publish' ]
            , ['name' => 'Hosted Tour', 'slug' => 'hosted-tour',  'status' => 'publish' ]
            , ['name' => 'City trips ', 'slug' => 'city-trips',  'status' => 'publish' ]
            , ['name' => 'Escorted Tour ', 'slug' => 'escorted-tour',  'status' => 'publish' ]
        ];
        foreach ($list_categories as $category){
            $row = new NewsCategory( $category );
            $row->save();
        }
        $list_tags = [
             ['name' => 'park', 'slug' => 'park' ],
             ['name' => 'National park', 'slug' => 'national-park' ],
             ['name' => 'Moutain', 'slug' => 'moutain' ],
             ['name' => 'Travel', 'slug' => 'travel' ],
             ['name' => 'Summer', 'slug' => 'summer'],
             ['name' => 'Walking', 'slug' => 'walking'],
        ];
        foreach ($list_tags as $tag) {
            $row = new Tag($tag);
            $row->save();
        }


        DB::table('core_news')->insert([
            'title' => 'The day on Paris',
            'slug' => Str::slug('The day on Paris', '-'),
            'content' => ' From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception  From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception <br/>From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception<br/>
    From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception',
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' => MediaFile::findMediaByName("news-1")->id,
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'Pure Luxe in Punta Mita',
            'slug' => Str::slug('Pure Luxe in Punta Mita', '-'),
            'content' => ' From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception <br/>From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception<br/>
    From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception',
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' => MediaFile::findMediaByName("news-2")->id,
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'All Aboard the Rocky Mountaineer',
            'slug' => Str::slug('All Aboard the Rocky Mountaineer', '-'),
            'content' => ' From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception  From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception <br/>From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception<br/>
    From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception',
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' => MediaFile::findMediaByName("news-3")->id,
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'City Spotlight: Philadelphia',
            'slug' => Str::slug('City Spotlight: Philadelphia', '-'),
            'content' => ' From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception  From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception <br/>From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception<br/>
    From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception',
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' => MediaFile::findMediaByName("news-4")->id,
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'Tiptoe through the Tulips of Washington',
            'slug' => Str::slug('Tiptoe through the Tulips of Washington', '-'),
            'content' => ' From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception  From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception <br/>From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception<br/>
    From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception',
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' => MediaFile::findMediaByName("news-5")->id,
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'A Seaside Reset in Laguna Beach',
            'slug' => Str::slug('A Seaside Reset in Laguna Beach', '-'),
            'content' => ' From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception  From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception <br/>From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception<br/>
    From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception',
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' => MediaFile::findMediaByName("news-6")->id,
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'America  National Parks with Denver',
            'slug' => Str::slug('America  National Parks with Denver', '-'),
            'content' => ' From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception  From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception <br/>From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception<br/>
    From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception',
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' => MediaFile::findMediaByName("news-7")->id,
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'Morning in the Northern sea',
            'slug' => Str::slug('Morning in the Northern sea', '-'),
            'content' => ' From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception  From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception <br/>From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception<br/>
    From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception',
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' => MediaFile::findMediaByName("news-2")->id,
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
    }
}

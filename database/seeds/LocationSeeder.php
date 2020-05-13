<?php
use Illuminate\Database\Seeder;
use Modules\Location\Models\Location;
use Modules\Media\Models\MediaFile;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            [
                'name' => 'Paris',
                'map_lat' => '48.856613',
                'map_lng' => '2.352222',
                'map_zoom' => '12',
                'image_id' => MediaFile::findMediaByName("location-1")->id,
                'status' => 'publish',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'New York, United States',
                'map_lat' => '40.712776',
                'map_lng' => '-74.005974',
                'map_zoom' => '12',
                'image_id' => MediaFile::findMediaByName("location-2")->id,
                'status' => 'publish',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'California',
                'map_lat' => '36.778259',
                'map_lng' => '-119.417931',
                'map_zoom' => '12',
                'image_id' => MediaFile::findMediaByName("location-3")->id,
                'status' => 'publish',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'United States',
                'map_lat' => '37.090240',
                'map_lng' => '-95.712891',
                'map_zoom' => '12',
                'image_id' => MediaFile::findMediaByName("location-4")->id,
                'status' => 'publish',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Los Angeles',
                'map_lat' => '34.052235',
                'map_lng' => '-118.243683',
                'map_zoom' => '12',
                'image_id' => MediaFile::findMediaByName("location-5")->id,
                'status' => 'publish',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'New Jersey',
                'map_lat' => '40.058323',
                'map_lng' => '-74.405663',
                'map_zoom' => '12',
                'image_id' => MediaFile::findMediaByName("location-1")->id,
                'status' => 'publish',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'San Francisco',
                'map_lat' => '37.774929',
                'map_lng' => '-122.419418',
                'map_zoom' => '12',
                'image_id' => MediaFile::findMediaByName("location-2")->id,
                'status' => 'publish',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Virginia',
                'map_lat' => '37.431572',
                'map_lng' => '-78.656891',
                'map_zoom' => '12',
                'image_id' => MediaFile::findMediaByName("location-3")->id,
                'status' => 'publish',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        ];

        foreach ($locations as $location){
            $row = new Location( $location );
            $row->save();
        }
    }
}

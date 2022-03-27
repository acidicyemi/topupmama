<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Country;
use App\Models\Publisher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $res = Http::get('https://www.anapioficeandfire.com/api/books?pageSize=50')->json();

        foreach ($res as $r) {
            $as = collect($r["authors"])->map(function($a) {
                return Author::firstOrCreate([
                    "name" => $a
                ])->id;
            });
            $country = Country::firstOrCreate([
                "name" => $r["country"]
            ]);

            $publisher = Publisher::firstOrCreate([
                "name" => $r["publisher"]
            ]);

            $b = Book::firstOrCreate([
                "name" => $r["name"],
                "publisher_id" => $publisher->id,
                "country_id" => $country->id,
                "resource_id" => 1,
                "isbn" => $r["isbn"],
                "number_of_pages" => $r["numberOfPages"],
                "released_date" => $r["released"],
                "media_type" => $r["mediaType"],
            ]);
            
            $b->authors()->sync($as);
        }
        
    }
}

<?php

namespace Database\Seeders;

use App\Models\Book;
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
            // dd($r, "k");
            Book::firstOrCreate([
                "name" => $r["name"],
                "publisher_id" => 1,
                "country_id" => 1,
                "resource_id" => 1,
                "isbn" => $r["isbn"],
                "number_of_pages" => $r["numberOfPages"],
                "released_date" => $r["released"],
                "media_type" => $r["mediaType"],
            ]);
        }
        
    }
}

<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CharacterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = true;
        $page = 1;
        $pageSize = 50;

        while ($status) {
            $res = Http::get(sprintf('https://www.anapioficeandfire.com/api/characters?pageSize=%s&page=%s', $pageSize, $page))->json();
            if (count($res) === 0) $status = false;
            foreach ($res as $r) {
                $cId = explode("https://www.anapioficeandfire.com/api/characters/", $r["url"]);
                Character::firstOrCreate([
                    "id" => $cId[1],
                    "name" => $r["name"],
                    "gender" => $r["gender"],
                    "culture" => $r["culture"],
                ]);
            }
            $page++;
        }
    }
}

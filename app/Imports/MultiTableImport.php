<?php

namespace App\Imports;

use App\Models\Essence;
use App\Models\Product;
use App\Models\SubEssence;
use App\Models\Tag;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Services\TranslationService;

class MultiTableImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        //    0 => "id"
        //    1 => "image_name"
        //    2 => "image_name_original"
        //    3 => "source"
        //    4 => "owner"
        //    5 => "redactor"
        //    6 => "license"
        //    7 => "url"
        //    8 => "rating"
        //    9 => "downloaded"
        //    10 => "viewing"
        //    11 => "sub_viewing"
        //    12 => "is_moderated"
        //    13 => "is_premium"
        //    14 => "is_bad_wallpaper"
        //    15 => "show_to_app"
        //    16 => "censorship"
        //    17 => "created_at"
        //    18 => "must_be_removed"
        //    19 => "is_show_india_admin"
        //    20 => "imagePaths"
        //    21 => "user.id"
        //    22 => "user.login"
        //    23 => "user.email"
        //    24 => "user.role"
        //    25 => "user.id_generate_key"
        //    26 => "user.profile.name"
        //    27 => "user.profile.surname"
        //    28 => "user.profile.patronymic"
        //    29 => "author.id"
        //    30 => "author.name"
        //    31 => "tags"
        //    32 => "categories"
        //    33 => "collections"
        //    34 => "selections"
        //    35 => "user.profile"
        //    36 => "author"
        $categories = Essence::create([
            'name' => 'Categories',
            'sort' => 500,
            'display_type' => 0
        ]);
        $selections = Essence::create([
            'name' => 'Selections',
            'sort' => 500,
            'display_type' => 0
        ]);
        foreach ($collection as $key => $row) {
            if ($key !== 0) {
                $collections = json_decode($row[32], true);
                $authorData = json_decode($row[36], true);
                $product = Product::create([
                    'image' => '/storage/old-images/' . $row[1],
                    'source' => $row[3],
                    'license' => $row[6],
                    'vip' => $row[13] == 'null' ? 0 : $row[13],
                    'name' => count($collections) ? TranslationService::translate($collections[0]['name']) : 'temp-name',
                    'live' => 0,
                    'live_image' => null,
                    'new' => 0,
                    'popular' => 0,
                    'sort' => 500,
                    'author' => is_array($authorData) && isset($authorData['name']) ? $authorData['name'] : null,
                ]);
                foreach ($collections as $subEssenceInfo) {
                    if (!$subEssence = SubEssence::where('name', TranslationService::translate($subEssenceInfo['name']))->first()) {
                        $subEssence = SubEssence::create([
                            'name' => TranslationService::translate($subEssenceInfo['name']),
                            'essence_id' => $categories->id,
                            'sort' => 500,
                        ]);
                    }
                    $subEssence->products()->attach($product->id);
                }
            }
        }
    }
}

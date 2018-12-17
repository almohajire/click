<?php

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        DB::table('configs')->insert([
            'slug' => 'points-multiplication',
            'nameSetting' => 'points-multiplication',
            'value' => '100',
            'type' => 'number',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('configs')->insert([
            'slug' => 'points-to-activate',
            'nameSetting' => 'points-to-activate',
            'value' => '2',
            'type' => 'number',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('configs')->insert([
            'slug' => 'links-to-add',
            'nameSetting' => 'links-to-add',
            'value' => '10',
            'type' => 'number',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('configs')->insert([
            'slug' => 'how-many-clicks-to-add-1',
            'nameSetting' => 'how-many-clicks-to-add-1',
            'value' => '10',
            'type' => 'number',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('configs')->insert([
            'slug' => 'paginate-links',
            'nameSetting' => 'paginate-links',
            'value' => '9',
            'type' => 'number',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        

        DB::table('configs')->insert([
            'slug' => 'if-all-ads-fail',
            'nameSetting' => 'if-all-ads-fail',
            'value' => 'https://en.wikipedia.org/wiki/Solidity',
            'type' => 'url',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('configs')->insert([
            'slug' => 'time-skip-ad-second',
            'nameSetting' => 'time-skip-ad-second',
            'value' => '4',
            'type' => 'number',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('configs')->insert([
            'slug' => 'bg-profile-img',
            'nameSetting' => 'bg-profile-img',
            'value' => 'bg-profile-img.jpg',
            'type' => 'file',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        ///////////////////

		DB::table('configs')->insert([
            'slug' => 'site-name',
            'nameSetting' => 'site name',
            'value' => 'Fatima Azzahrae',
            'type' => 'text',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('configs')->insert([
            'slug' => 'description',
            'nameSetting' => 'Description',
            'value' => 'C\'est un site pour la gestion d\'ecole fatima azzahrae à Allal tazi',
            'type' => 'textarea',
            'created_at' => date('Y-m-d H:i:s'),
        ]);




        DB::table('configs')->insert([
            'slug' => 'by',
            'nameSetting' => 'by',
            'value' => 'Idda tech',
            'type' => 'text',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('configs')->insert([
            'slug' => 'url-by',
            'nameSetting' => 'company',
            'value' => 'https://it2018.wixsite.com/it18',
            'type' => 'url',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('configs')->insert([
            'slug' => 'mobile-number',
            'nameSetting' => 'phone number',
            'value' => '+212 06 63 22 60 32',
            'type' => 'tel',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('configs')->insert([
            'slug' => 'fix-number',
            'nameSetting' => 'fix number',
            'value' => '+212 06 69 48 93 69',
            'type' => 'tel',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('configs')->insert([
            'slug' => 'adress',
            'nameSetting' => 'adress',
            'value' => 'N°211 Lot el houda',
            'type' => 'textarea',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('configs')->insert([
            'slug' => 'city',
            'nameSetting' => 'city',
            'value' => 'Allal tazi',
            'type' => 'text',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('configs')->insert([
            'slug' => 'zip_code',
            'nameSetting' => 'zip code',
            'value' => '14052',
            'type' => 'text',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('configs')->insert([
            'slug' => 'email',
            'nameSetting' => 'Adress email',
            'value' => 'fatimaazzahraeschool@gmail.com',
            'type' => 'email',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('configs')->insert([
            'slug' => 'youtube',
            'nameSetting' => 'Youtube chanel',
            'value' => 'UClZ8x36HHgUlaCGAKmixxEg',
            'type' => 'text',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('configs')->insert([
            'slug' => 'twitter',
            'nameSetting' => 'Twitter account',
            'value' => 'FatimaAzzahrae6v',
            'type' => 'text',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('configs')->insert([
            'slug' => 'facebook',
            'nameSetting' => 'Facebook Page',
            'value' => 'Fatima-azzahrae-185877205288816',
            'type' => 'text',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('configs')->insert([
            'slug' => 'github',
            'nameSetting' => 'Git account',
            'value' => 'git',
            'type' => 'text',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('configs')->insert([
            'slug' => 'google-plus',
            'nameSetting' => 'Google account',
            'value' => 'Fatima-azzahrae-185877205288816',
            'type' => 'text',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('configs')->insert([
            'slug' => 'lat',
            'nameSetting' => 'Latitude',
            'value' => "34,521380",
            'type' => 'text',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('configs')->insert([
            'slug' => 'lng',
            'nameSetting' => 'Langitude',
            'value' => "-6,323930",
            'type' => 'text',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('configs')->insert([
            'slug' => 'paypal',
            'nameSetting' => 'Paypal account',
            'value' => 'paypal',
            'type' => 'text',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('configs')->insert([
            'slug' => 'tags',
            'nameSetting' => 'Tags',
            'value' => 'tag1|tag2',
            'type' => 'textarea',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('configs')->insert([
            'slug' => 'no-image',
            'nameSetting' => 'No image',
            'value' => 'no-image.png',
            'type' => 'file',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('configs')->insert([
            'slug' => 'logo',
            'nameSetting' => 'Logo',
            'value' => 'logo.jpg',
            'type' => 'file',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('configs')->insert([
            'slug' => 'test-language',
            'nameSetting' => 'Test Language',
            'value' => 'ar-TN',
            'type' => 'text',
            'created_at' => date('Y-m-d H:i:s'),
        ]);








    }
}

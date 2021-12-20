<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title' => 'Undefined Page Title',
                'desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
                'position'=> 0,
                'status'=>false,
                'created_at'=> date('Y-m-d h:m:s'),
                'updated_at'=> date('Y-m-d h:m:s'),
                'url'=>'',
                'target'=>'',
                'default_view'=> false,
                'default_desc'=>'',
            ],

            ['title' => 'About Us',
                'desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
                'position'=> 1,
                'status'=>true,
                'created_at'=> date('Y-m-d h:m:s'),
                'updated_at'=> date('Y-m-d h:m:s'),
                'url'=>'pages.about.us',
                'target'=>'',
                'default_view'=> true,
                'default_desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
            ],

            ['title' => 'Movies',
                'desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
                'position'=> 2,
                'status'=>true,
                'created_at'=> date('Y-m-d h:m:s'),
                'updated_at'=> date('Y-m-d h:m:s'),
                'url'=>'category.movie',
                'target'=>'',
                'default_view'=> true,
                'default_desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
            ],

            ['title' => 'TvShows',
                'desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
                'position'=> 3,
                'status'=>true,
                'created_at'=> date('Y-m-d h:m:s'),
                'updated_at'=> date('Y-m-d h:m:s'),
                'url'=>'category.show',
                'target'=>'',
                'default_view'=> true,
                'default_desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
            ],

            ['title' => 'Corporate Information',
                'desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
                'position'=> 4,
                'status'=>true,
                'created_at'=> date('Y-m-d h:m:s'),
                'updated_at'=> date('Y-m-d h:m:s'),
                'url'=>'pages.information',
                'target'=>'',
                'default_view'=> true,
                'default_desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
            ],

            ['title' => 'Privacy Policy',
                'desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
                'position'=> 5,
                'status'=>true,
                'created_at'=> date('Y-m-d h:m:s'),
                'updated_at'=> date('Y-m-d h:m:s'),
                'url'=>'pages.privacy.policy',
                'target'=>'',
                'default_view'=> true,
                'default_desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
            ],

            ['title' => 'Terms & Conditions',
                'desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
                'position'=> 6,
                'status'=>true,
                'created_at'=> date('Y-m-d h:m:s'),
                'updated_at'=> date('Y-m-d h:m:s'),
                'url'=>'pages.terms.and.conditions',
                'target'=>'',
                'default_view'=> true,
                'default_desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
            ],

            ['title' => 'Help',
                'desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
                'position'=> 7,
                'status'=>true,
                'created_at'=> date('Y-m-d h:m:s'),
                'updated_at'=> date('Y-m-d h:m:s'),
                'url'=>'pages.help',
                'target'=>'',
                'default_view'=> true,
                'default_desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
            ],

            ['title' => 'FAQ',
                'desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
                'position'=> 8,
                'status'=>true,
                'created_at'=> date('Y-m-d h:m:s'),
                'updated_at'=> date('Y-m-d h:m:s'),
                'url'=>'pages.faq',
                'target'=>'',
                'default_view'=> true,
                'default_desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
            ],

            ['title' => 'Contact Us',
                'desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
                'position'=> 9,
                'status'=>true,
                'created_at'=> date('Y-m-d h:m:s'),
                'updated_at'=> date('Y-m-d h:m:s'),
                'url'=>'pages.contact.us',
                'target'=>'',
                'default_view'=> true,
                'default_desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, Netus et malesuada fames ac turpis.',
            ],

            ['title' => 'Legal Notice',
                'desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit,Netus et malesuada fames ac turpis.',
                'position'=> 10,
                'status'=>true,
                'created_at'=> date('Y-m-d h:m:s'),
                'updated_at'=> date('Y-m-d h:m:s'),
                'url'=>'pages.legals',
                'target'=>'',
                'default_view'=> true,
                'default_desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit,Netus et malesuada fames ac turpis.',
            ],


        ];

        DB::table('pages')->insert($data);
    }
}

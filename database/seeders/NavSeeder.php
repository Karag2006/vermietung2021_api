<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Nav;

class NavSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $navs = [
            [
                'id'                => 1,
                'name'              => 'Dashboard',
                'icon'              => 'fas fa-tachometer-alt',
                'link'              => '/dashboard',
            ],
            [
                'id'                => 2,
                'name'              => 'Kunden',
                'icon'              => 'fas fa-users',
                'link'              => '/customers',
            ],
            [
                'id'                => 3,
                'name'              => 'Angebote',
                'icon'              => 'fas fa-id-card-alt',
                'link'              => '/offers',
            ],
            [
                'id'                => 4,
                'name'              => 'Reservierungen',
                'icon'              => 'fas fa-address-card',
                'link'              => '/reservations',
            ],
            [
                'id'                => 5,
                'name'              => 'Mietverträge',
                'icon'              => 'fas fa-file-signature',
                'link'              => '/contracts',
            ],
            [
                'id'                => 6,
                'name'              => 'Benutzerverwaltung',
                'icon'              => 'fas fa-users',
                'children'          => '7;8'
            ],
            [
                'id'                => 7,
                'name'              => 'Rollen',
                'icon'              => 'fas fa-user-tag',
                'link'              => '/roles',
            ],
            [
                'id'                => 8,
                'name'              => 'Benutzer',
                'icon'              => 'fas fa-uses-cog',
                'link'              => '/users',
            ],
            [
                'id'                => 9,
                'name'              => 'Anhängerverwaltung',
                'icon'              => 'fas fa-trailer',
                'children'          => '10;11'
            ],
            [
                'id'                => 10,
                'name'              => 'Anhänger',
                'icon'              => 'fas fa-trailer',
                'link'              => '/trailers',
            ],
            [
                'id'                => 11,
                'name'              => 'Zubehör',
                'icon'              => 'fas fa-sitemap',
                'link'              => '/accessories',
            ],
            [
                'id'                => 12,
                'name'              => 'Einstellungen',
                'icon'              => 'fas fa-cogs',
                'link'              => '/options',
            ],

        ];

        foreach($navs as $link) {
            Nav::create($link);
        }
    }
}

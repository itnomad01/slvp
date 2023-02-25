<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orgs')->insert([
            'title' => 'Студия ТВ',
            'brandtitle' => 'Бренд ТВ',
            'ogrn' => '1234567890123',
            'inn' => '1234567890',
            'kpp' => '123456789',
            'address' => 'город Н, ул. Котов, д. 404',
            'fintitle' => 'УФК по НН (Студия ТВ)',
            'personal_acc' => '12345678901234567890',
            'bank_name' => 'Отделение НН - ЦБ НН //УФК по НН',
            'bic' => '123456789',
            'corresp_acc' => '09876543210987654321',
            'email' => 'stv@example.org',
            'tel' => '99999999999'
        ]);
    }
}

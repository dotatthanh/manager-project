<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tạo admin
        User::create([
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('123123123'),
        	'name' => 'Admin',
            'tech_stack_id' => '1',
            'room_id' => '1',
        	'birthday' => '2000-08-17',
        	'phone_number' => '0394121584',
        	'address' => 'Sóc Trăng - Cần Thơ',
            'card_id' => '123123123123',
            'foreign_language' => 'Tiếng Anh',
            'experience' => 'Làm việc lâu năm',
        	'gender' => 'Nam',
        ]);
    }
}

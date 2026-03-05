<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enum\Category;
use App\Models\CategoryRecipient;

use Illuminate\Database\Seeder;
use App\Enum\UserRole;
use App\Enum\UserClass;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //superadmin
        User::create([
            'email' => 'spadmin@test.com',
            'full_name' => "super admin",
            'role' => UserRole::SuperAdmin->value,
            'password' => 'testlmao'
        ]);

        //admin
        User::create([
            'email' => 'testadmin@test.com',
            'full_name' => "admin test",
            'role' => UserRole::Admin->value,
            'password' => "testlmao"
        ]);

        $student = User::create([
            'email' => 'teststudent@test.com',
            'full_name' => 'student test',
            'nis' => '489357234856378',
            'role' => UserRole::Student->value,
            'class' => UserClass::XII_RPL_1->value,
            'password' => 'testlmao'
        ]);

        foreach (Category::cases() as $category) {

            CategoryRecipient::factory()->create([
                'from_category' => $category->value,
            ]);
        }


        //if (in_array(app()->environment(), ['local', 'dev'])) {
        //    Feedback::factory(7)->create([
        //        'user_id' => $student->id
        //    ]);

        //    Feedback::factory(10)->create();
        //    CategoryRecipient::factory(10)->create();
        //}
    }
}

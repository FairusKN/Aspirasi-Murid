<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
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
            'email' => 'fairuskamal@gmail.com',
            'full_name' => "Fairus Kamal Nafis",
            'role' => UserRole::Admin->value,
            'password' => "testlmao"
        ]);

        //student
        //User::create([
        //    'email' => 'student@gmail.com',
        //    'full_name' => 'Adit',
        //    'role' => UserRole::Student->value,
        //    'nis' => 123432432,
        //    'class' => UserClass::XII_RPL_1->value,
        //    'password' => 'testlmao'
        //]);

        ////Recipient
        //$category = Category::create([
        //    'category_name' => "Sarana & Prasarana"
        //]);

        //$recipient = User::create([
        //    'email' => 'rep@gmail.com',
        //    'full_name' => 'Abdi',
        //    'role' => UserRole::Recipient->value,
        //    'password' => 'testlmao'
        //]);

        //CategoryRecipient::create([
        //    'category_id' => $category->id,
        //    'user_id' => $recipient->id
        //]);


        //$student = User::create([
        //    'email' => 'teststudent@test.com',
        //    'full_name' => 'student test',
        //    'nis' => '489357234856378',
        //    'role' => UserRole::Student->value,
        //    'class' => UserClass::XII_RPL_1->value,
        //    'password' => 'testlmao'
        //]);

        //foreach (Category::cases() as $category) {

        //    CategoryRecipient::factory()->create([
        //        'from_category' => $category->value,
        //    ]);
        //}


        //if (in_array(app()->environment(), ['local', 'dev'])) {
        //    Feedback::factory(7)->create([
        //        'user_id' => $student->id
        //    ]);

        //    Feedback::factory(10)->create();
        //    CategoryRecipient::factory(10)->create();
        //}
    }
}

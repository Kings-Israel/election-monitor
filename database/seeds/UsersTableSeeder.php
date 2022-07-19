<?php


use App\Models\User\User;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder.
 */
class UsersTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->truncate('users');

        factory(User::class, 50)->create();

        factory(User::class)->create([
            'first_name' => 'Kings',
            'last_name' => 'Israel',
            'email' => 'kings@deveint.com',
            'role' => 'admin',
            'phone' => '+254707137687'
        ]);

        $this->enableForeignKeys();
    }
}

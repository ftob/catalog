<?php


use App\References\AppReference;
use App\User;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends \Illuminate\Database\Seeder
{

    const DEFAULT_USER_NAME = 'user';
    const DEFAULT_USER_EMAIL = 'litebackend@gmail.com';
    const DEFAULT_USER_PASSWORD = 'q12345';


    public function run()
    {
        if (!User::where(['email' => self::DEFAULT_USER_EMAIL])->first()
            && app()->environment() !== AppReference::ENV_PRODUCTION) {

            $user = new User();

            $user->fill([
                'name' => self::DEFAULT_USER_NAME,
                'email' => self::DEFAULT_USER_EMAIL,
                'password' => \Hash::make(self::DEFAULT_USER_PASSWORD)
            ]);

            $user->save();
            $this->command->info("Seed default user");
        }
    }
}
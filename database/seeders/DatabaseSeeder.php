<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Shop\Order;
use App\Models\Shop\Product;
use App\Models\Test;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use InvalidArgumentException;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;


class DatabaseSeeder extends Seeder
{
     /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin'
        ]);

        $this->call([
            BrandSeeder::class,
            CategoryGroupSeeder::class,
            CategorySeeder::class,
            DeliveryAddressSeeder::class,
        ]);

        // Check if categories are seeded correctly
        $this->seedWithProgress(Product::class, 50, function () {
            return Product::factory()->withLongDescription()->withCategories()->withVariants();
        });

        $this->seedWithProgress(Order::class, 100, function () {
            return Order::factory();
        });

        if (Category::count() > 0) {
            $this->seedWithProgress(Test::class, 9, function () {
                return Test::factory();
            });
        } else {
            $this->command->info('No categories found! Make sure CategorySeeder is working.');
        }
    }

    /**
     * Seed the given factory with progress bar.
     *
     * @param string $model
     * @param int $count
     * @param \Closure $factoryCallback
     */
    protected function seedWithProgress(string $modelClass, int $count, \Closure $factoryCallback)
    {
        // Ensure the class exists and is a valid model
        if (!class_exists($modelClass) || !is_subclass_of($modelClass, Model::class)) {
            throw new InvalidArgumentException("Invalid model class provided.");
        }


        $modelInstance = new $modelClass;
        $tableName = $modelInstance->getTable();

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $count);


        $output->writeln("Seeding table: $tableName");

        $progressBar->start();

        for ($i = 0; $i < $count; $i++) {
            $factoryCallback()->create();
            $progressBar->advance();
        }

        $progressBar->finish();
        $output->writeln("");
    }
}

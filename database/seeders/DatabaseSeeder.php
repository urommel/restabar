<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\MenuEntry;
use App\Models\Table;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Susan',
            'email' => 'susan@example.com',
            'password' => bcrypt('123456'),
            'role' => Role::FRONTLINE,
        ]);
        User::factory()->create([
            'name' => 'John',
            'email' => 'johnn@example.com',
            'password' => bcrypt('123456'),
            'role' => Role::KITCHEN,
        ]);

        Table::factory()->count(5)
            ->state(new Sequence(
                ['id' => 1, 'name' => 'Mesa 1'],
                ['id' => 2, 'name' => 'Mesa 2'],
                ['id' => 3, 'name' => 'Mesa 3'],
                ['id' => 4, 'name' => 'Mesa 4'],
                ['id' => 5, 'name' => 'Mesa 5'],
            ))
            ->create();
        MenuEntry::factory()->count(10)
            ->state(new Sequence(
                [
                    'id' => 1,
                    'name' => 'Burger Clásica',
                    'description' => '200 gr de carne, queso cheddar, vegetales',
                    'price' => 550
                ],
                [
                    'id' => 2,
                    'name' => 'Doble Queso',
                    'description' => 'Carne, doble queso cheddar, vegetales',
                    'price' => 750
                ],
                [
                    'id' => 3,
                    'name' => 'Veggie Deluxe',
                    'description' => 'Hamburguesa de lentejas, vegetales, aguacate',
                    'price' => 600
                ],
                [
                    'id' => 4,
                    'name' => 'Swiss Burger',
                    'description' => 'Carne, queso suizo, lechuga, tomate',
                    'price' => 650
                ],
                [
                    'id' => 5,
                    'name' => 'Bacon Cheese',
                    'description' => 'Queso cheddar, bacon, vegetales',
                    'price' => 700
                ],
                [
                    'id' => 6,
                    'name' => 'BBQ Especial',
                    'description' => 'Carne, salsa BBQ, queso cheddar, cebolla caramelizada',
                    'price' => 720
                ],
                [
                    'id' => 7,
                    'name' => 'Spicy Jack',
                    'description' => 'Queso pepper jack, jalapeños, salsa picante',
                    'price' => 680
                ],
                [
                    'id' => 8,
                    'name' => 'Mushroom Swiss',
                    'description' => 'Carne, champiñones salteados, queso suizo, cebolla caramelizada',
                    'price' => 800
                ],
                [
                    'id' => 9,
                    'name' => 'Truffle Brie',
                    'description' => 'Queso brie, rúcula, tomate seco, mayonesa trufada',
                    'price' => 720
                ],
                [
                    'id' => 10,
                    'name' => 'Buffalo Chicken',
                    'description' => 'Pollo empanizado, salsa buffalo, lechuga, aderezo ranch',
                    'price' => 750
                ],

            ))
            ->create();
    }
}

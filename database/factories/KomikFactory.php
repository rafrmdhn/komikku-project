<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Komik>
 */
class KomikFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'author' => $this->faker->name(),
            'category_id' => $this->faker->numberBetween(1, 4),
            'stock' => $this->faker->numberBetween(),
            'description' => $this->faker->paragraph(),
            'isbn' => $this->faker->isbn10(),
            'publication_year' => $this->faker->date(),
            'price' => $this->faker->randomFloat(2),
            'photo' => function () {
                $imagePath = $this->faker->image('public/storage/images/komik', 640, 480, null, false);
                return 'images/komik/' . $imagePath; // Menyimpan path relatif
            },
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtudiantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Etudiant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker;
        return [

            'nom' => $this->faker->lastName($gender),
            'prenom' => $this->faker->firstName($gender),
            'code_cne' => $this->faker->numerify("R########"),
            'code_cin' => $this->faker->bothify("??####"),
            'filiere' => $this->faker->randomElement(["GI", "GA", "TM"]),
            'annee' => $this->faker->randomElement([1, 2]),
        ];
    }
}

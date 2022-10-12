<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'group_id' => function () {
                return Group::factory()->create()->id;
            },
            'user_id' => function () {
                return User::factory()->create()->id;
            }
        ];
    }
}

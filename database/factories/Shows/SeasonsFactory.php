<?php

namespace Database\Factories\Shows;

use App\Models\Shows\Episodes;
use App\Models\Shows\Seasons;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeasonsFactory extends Factory
{
    protected $model = Seasons::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

//        $episodes = Episodes::factory(5)->create()->all();
//        //dd($episodes);
//        $ids=[];
//        foreach ($episodes as $episode)
//        {
//            $id = $episode->first()->id;
//            $ids[$id]=$id;
//        }



        return [
            'name'=> $this->faker->word(),
            'desc' => $this->faker->text(200),
            'display_image'=> $this->faker->imageUrl(744,432),
            'status'=> $this->faker->boolean(),
        ];
    }
}

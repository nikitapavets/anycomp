<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('categories')->delete();

	    Category::create([
		    'category' => 'Компьютер'
	    ]);

	    Category::create([
		    'category' => 'Ноутбук'
	    ]);

	    Category::create([
		    'category' => 'Планшет'
	    ]);

	    Category::create([
		    'category' => 'Телефон'
	    ]);

	    Category::create([
		    'category' => 'Навигатор'
	    ]);

	    Category::create([
		    'category' => 'Принтер'
	    ]);

	    Category::create([
		    'category' => 'Клавиатура'
	    ]);

	    Category::create([
		    'category' => 'Мышь'
	    ]);

	    Category::create([
		    'category' => 'Блок питания'
	    ]);
    }
}


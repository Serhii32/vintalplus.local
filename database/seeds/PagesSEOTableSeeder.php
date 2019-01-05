<?php

use Illuminate\Database\Seeder;
use App\SEO_Page;

class PagesSEOTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = new SEO_Page();
        $page->page = "Главная";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Продукция";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "О нас";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Контакты";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Доставка и оплата";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Новости";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Партнеры";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Статьи";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Проекты";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Вакансии";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Услуги";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Категории";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Каталог";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Поиск";
	    $page->save();
    }
}

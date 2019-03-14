<?php

use Illuminate\Database\Seeder;
use App\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = new Page();
        $page->page = "Вакансии";
        $page->url = "page.jobs";
	    $page->save();

        $page = new Page();
        $page->page = "Контакты";
        $page->url = "page.contacts";
        $page->save();

        $page = new Page();
        $page->page = "Доставка и оплата";
        $page->url = "page.delivery-payment";
        $page->save();

        $page = new Page();
        $page->page = "О нас";
        $page->url = "page.about";
        $page->save();
    }
}

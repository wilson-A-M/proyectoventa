<?php

namespace App\Console\Commands;

use App\Services\NewsScraper;
use Illuminate\Console\Command;

class ScrapeElDiario extends Command
{
    protected $signature = 'scrape:eldiario';
    protected $description = 'Scrapea noticias de El Diario';

    public function handle(NewsScraper $scraper)
    {
        $this->info('Iniciando scraping de El Diario...');
        $scraper->scrapeElDiario();
        $this->info('Scraping completado');
    }
}

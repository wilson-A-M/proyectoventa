<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NewsScraper;

class ScrapeNews extends Command
{
    protected $signature = 'news:scrape';
    protected $description = 'Scrapea noticias de los periódicos configurados';

    public function handle(NewsScraper $scraper)
    {
        $this->info('Iniciando scraping...');
        $scraper->scrapeElDiario();
        $this->info('Scraping completado');
    }
}

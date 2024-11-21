<?php

namespace App\Services;

use Goutte\Client;
use App\Models\News;
use Illuminate\Support\Facades\Log;

class NewsScraper
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36 Brave/91.0.4472.124');
    }

    public function scrapeElDiario()
    {
        $noticias = [];

        try {
            $crawler = $this->client->request('GET', 'https://www.eldiario.net/portal/');

            $crawler->filter('.card')->each(function ($node) use (&$noticias) {
                try {
                    $titulo = $node->filter('.card-title')->count() > 0 ? $node->filter('.card-title')->text() : null;
                    $url = $node->filter('a')->attr('href');

                    if (!str_starts_with($url, 'http')) {
                        $url = 'https://www.eldiario.net' . $url;
                    }

                    if ($titulo && !News::where('url', $url)->exists()) {
                        $articleCrawler = $this->client->request('GET', $url);
                        $contenido = $articleCrawler->filter('.contenido-noticia')->count() > 0
                            ? $articleCrawler->filter('.contenido-noticia')->text()
                            : 'Contenido no disponible';

                        $noticias[] = [
                            'titulo' => $titulo,
                            'contenido' => $contenido,
                            'fuente' => 'El Diario',
                            'url' => $url,
                            'categoria' => $this->obtenerCategoria($url),
                            'fecha_publicacion' => now(),
                        ];

                        usleep(rand(2000000, 4000000)); // Delay para evitar bloqueo
                    }
                } catch (\Exception $e) {
                    Log::error('Error procesando noticia:', ['url' => $url, 'error' => $e->getMessage()]);
                }
            });
        } catch (\Exception $e) {
            Log::error('Error global en scraping: ' . $e->getMessage());
            throw $e;
        }

        return $noticias;
    }

    public function obtenerCategoria($url)
    {
        $categorias = [
            'politica' => 'Política',
            'economia' => 'Economía',
            'sociedad' => 'Sociedad',
            'nacional' => 'Nacional',
            'internacional' => 'Internacional',
            'deportes' => 'Deportes'
        ];

        foreach ($categorias as $slug => $nombre) {
            if (str_contains($url, $slug)) {
                return $nombre;
            }
        }

        return 'General';
    }
}

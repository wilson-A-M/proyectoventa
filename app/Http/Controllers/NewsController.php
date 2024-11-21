<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\NewsScraper;
use Illuminate\Http\Request;
use Goutte\Client;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    private $scraper;

    public function __construct(NewsScraper $scraper)
    {
        $this->scraper = $scraper;
    }

    public function scrape()
    {
        try {
            Log::info('Iniciando scraping...');

            $client = new Client();
            $crawler = $client->request('GET', 'https://www.eldiario.net/portal/');

            // Seleccionamos el selector más exitoso del método test
            $selectorPrincipal = 'h3.entry-title.td-module-title';
 // Este debe coincidir con lo que descubriste en test.

            $noticias = [];
            $crawler->filter($selectorPrincipal)->each(function ($node) use (&$noticias, $client) {
                try {
                    $titulo = $node->text();
                    $url = $node->filter('a')->count() > 0 ? $node->filter('a')->attr('href') : null;

                    if ($url && !str_starts_with($url, 'http')) {
                        $url = 'https://www.eldiario.net' . $url;
                    }

                    if ($titulo && $url) {
                        $noticias[] = [
                            'titulo' => $titulo,
                            'contenido' => 'Contenido no disponible', // Agregaremos esto más adelante
                            'fuente' => 'El Diario',
                            'url' => $url,
                            'categoria' => 'General', // Puedes ajustar esto con tu método obtenerCategoria
                            'fecha_publicacion' => now(),
                        ];
                    }
                } catch (\Exception $e) {
                    Log::error('Error procesando noticia:', ['error' => $e->getMessage()]);
                }
            });

            // Guardar noticias en la base de datos
            foreach ($noticias as $data) {
                try {
                    News::create($data);
                    Log::info('Noticia guardada', $data);
                } catch (\Exception $e) {
                    Log::error('Error al guardar noticia en la base de datos', ['data' => $data, 'error' => $e->getMessage()]);
                }
            }

            return response()->json(['message' => 'Scraping completado y noticias almacenadas exitosamente']);
        } catch (\Exception $e) {
            Log::error("Error general en scraping: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function index()
    {
        $noticias = News::latest('fecha_publicacion')
            ->paginate(15);

        return view('news.index', compact('noticias'));
    }

    public function porCategoria($categoria)
    {
        $noticias = News::where('categoria', $categoria)
            ->latest('fecha_publicacion')
            ->paginate(15);

        return view('news.index', compact('noticias'));
    }

    public function test()
    {
        try {
            $client = new Client();
            $crawler = $client->request('GET', 'https://www.eldiario.net/portal/');

            // Probamos diferentes selectores comunes
            $selectores = [
                '.news-item',
                '.article',
                '.post',
                '.entry',
                '.card',
                'article',
                '.nota',
                '.noticia'
            ];

            $resultados = [];

            foreach ($selectores as $selector) {
                try {
                    $elementos = $crawler->filter($selector);
                    $resultados[$selector] = [
                        'cantidad' => $elementos->count(),
                        'ejemplo' => $elementos->count() > 0 ? [
                            'html' => $elementos->first()->html(),
                            'texto' => $elementos->first()->text(),
                        ] : null
                    ];
                } catch (\Exception $e) {
                    $resultados[$selector] = ['error' => $e->getMessage()];
                }
            }

            return response()->json([
                'resultados' => $resultados,
                'estructura_pagina' => [
                    'titulos' => $crawler->filter('h1, h2, h3')->each(function ($node) {
                        return [
                            'tipo' => $node->nodeName(),
                            'texto' => $node->text(),
                            'clases' => $node->attr('class')
                        ];
                    }),
                    'enlaces' => $crawler->filter('a')->each(function ($node) {
                        return [
                            'texto' => $node->text(),
                            'href' => $node->attr('href'),
                            'clases' => $node->attr('class')
                        ];
                    })
                ]
            ]);
        } catch (\Exception $e) {
            Log::error("Error en test de scraping: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

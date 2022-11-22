<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController
{
    #[Route("/api/pokemons", methods: ['GET'])]
    public function getPokemons()
    {
        $pokemons = [
            [
                'nombre' => 'charmander',
                'descripcion' =>
                    'Prefiere las cosas calientes. Dicen que cuando llueve le sale vapor de la punta de la cola.',
                'imagen' =>
                    'https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png',
                'id' => '004',
            ],
            [
                'nombre' => 'Pichu',
                'descripcion' =>
                    'A pesar de su pequeño tamaño, puede soltar descargas capaces de electrocutar a un adulto, si bien él también acaba sobresaltado.',
                'imagen' =>
                    'https://assets.pokemon.com/assets/cms2/img/pokedex/full/172.png',
                'id' => '172',
            ],
            [
                'nombre' => 'Dragonite',
                'descripcion' =>
                    'Un Pokémon bondadoso y compasivo al que le resulta imposible dar la espalda a Pokémon o humanos que se encuentren a la deriva.',
                'imagen' =>
                    'https://assets.pokemon.com/assets/cms2/img/pokedex/full/149.png',
                'id' => '149',
            ],
        ];

        return new JsonResponse($pokemons);
    }
}

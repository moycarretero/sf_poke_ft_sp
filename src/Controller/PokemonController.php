<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController {
    #[Route('/pokemon')]
    public function getPokemon () {
        $pokemon = ['name' => 'Bulbasur', 
                    'description' => 'Este Pokémon nace con una semilla en el lomo, que brota con el paso del tiempo.',
                    'img' => 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png',
                    'code' => '001'
    ];
    return $this->render('Pokemons/ShowPokemon.html.twig', ['pokemon' => $pokemon]);
    }
}

<?php 

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController {

    #[Route('/pokemon/{id}')] 
    public function getPokemon (EntityManagerInterface $doctrine, $id) {
        $repo = $doctrine -> getRepository(Pokemon :: class);
        $pokemon = $repo -> find($id); 
        return $this->render('Pokemons/ShowPokemon.html.twig', ['pokemon' => $pokemon]);
    }

    #[Route('/pokemonList')]
    public function getPokemonList (EntityManagerInterface $doctrine) {

        $repo = $doctrine -> getRepository(Pokemon::class);
        $pokemonList = $repo -> findAll();
        return $this->render('Pokemons/ShowPokemonList.html.twig', ['pokemonList' => $pokemonList]);
    }

    #[Route('/pokemonAdd')]
    public function addPokemon(EntityManagerInterface $doctrine) {
        $pokemon = new Pokemon ();
        $pokemon -> setName('Bulbasur');
        $pokemon -> setDescription('Este Pokémon nace con una semilla en el lomo, que brota con el paso del tiempo.');
        $pokemon -> setImage('https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png');
        $pokemon -> setCode('001');

        $pokemon2 = new Pokemon ();
        $pokemon2 -> setName('Ivysaur');
        $pokemon2 -> setDescription('Este Pokémon nace con una semilla en el lomo, que brota con el paso del tiempo.');
        $pokemon2 -> setImage('https://assets.pokemon.com/assets/cms2/img/pokedex/full/002.png');
        $pokemon2 -> setCode('002');

        $pokemon3 = new Pokemon ();
        $pokemon3 -> setName('Venusaur');
        $pokemon3 -> setDescription('Este Pokémon nace con una semilla en el lomo, que brota con el paso del tiempo.');
        $pokemon3 -> setImage('https://assets.pokemon.com/assets/cms2/img/pokedex/full/003.png');
        $pokemon3 -> setCode('003');
        
        $doctrine -> persist($pokemon);
        $doctrine -> persist($pokemon2);
        $doctrine -> persist($pokemon3);

        $doctrine -> flush();
        return new Response('pokemon insertados correctamente');


    }
}

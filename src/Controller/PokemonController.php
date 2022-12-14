<?php 

namespace App\Controller;

use App\Entity\Debilidad;
use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Manager\PokemonManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController {

    #[Route('/pokemon/{id}', name: "getPokemon")] 
    public function getPokemon (EntityManagerInterface $doctrine, $id) {
        $repo = $doctrine -> getRepository(Pokemon :: class);
        $pokemon = $repo -> find($id); 
        return $this->render('Pokemons/ShowPokemon.html.twig', ['pokemon' => $pokemon]);
    }

    #[Route('/pokemonList', name: "getPokemonList")]
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
        
        $debilidad = new Debilidad ();
        $debilidad -> setName('Fuego');

        $debilidad2 = new Debilidad ();
        $debilidad2 -> setName('Hielo');

        $debilidad3 = new Debilidad ();
        $debilidad3 -> setName('Veneno');

        $pokemon -> addDebilidade($debilidad);
        $pokemon -> addDebilidade($debilidad3);

        $pokemon2 -> addDebilidade($debilidad2);

        $doctrine -> persist($pokemon);
        $doctrine -> persist($pokemon2);
        $doctrine -> persist($pokemon3);
        $doctrine -> persist($debilidad);
        $doctrine -> persist($debilidad2);
        $doctrine -> persist($debilidad3);

        $doctrine -> flush();
        return new Response('pokemon insertados correctamente');


    }

    #[Route('/createPokemon', name: "createPokemon")]
    public function createPokemon (EntityManagerInterface $doctrine, Request $request, PokemonManager $manager) {
        $form = $this -> createForm(PokemonType::class);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()){
            $pokemon = $form -> getData();
            //Recogemos el fichero img del formulario
            $imageFile = $form -> get('imageFile') -> getData();
            if ($imageFile) {
                $image = $manager -> uploadImage($imageFile, $this->getParameter('kernel.project_dir').'/public/images');
                $pokemon -> setImage("/images/$image");
            }
            $doctrine -> persist($pokemon);
            $doctrine -> flush();

            $manager->sendMail($pokemon->getName());
            $this -> addFlash("éxito", "Pokemon insertado correctamente");
            return $this -> redirectToRoute("getPokemonList");
        }
        return $this -> renderForm("Pokemons/CreatePokemon.html.twig", ["Pokeform"=> $form]);
    }


    #[Route('/editPokemon/{id}', name: "editPokemon")]
    public function editPokemon (EntityManagerInterface $doctrine, Request $request, $id) {
        $repo = $doctrine -> getRepository(Pokemon :: class);
        $pokemon = $repo -> find($id);
        $form = $this -> createForm(PokemonType::class, $pokemon);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()){
            $pokemon = $form -> getData();
            $doctrine -> persist($pokemon);
            $doctrine -> flush();
            $this -> addFlash("éxito", "Pokemon editado correctamente");
            return $this -> redirectToRoute("getPokemonList");
        }
        return $this -> renderForm("Pokemons/CreatePokemon.html.twig", ["Pokeform"=> $form]);
    }

    #[Route('/deletePokemon/{id}', name: "deletePokemon")]
    #[IsGranted("ROLE_ADMIN")]
    public function deletePokemon (EntityManagerInterface $doctrine, $id){
        $repo = $doctrine -> getRepository(Pokemon :: class);
        $pokemon = $repo -> find($id);
        $doctrine -> remove($pokemon);
        $doctrine -> flush();
        $this -> addFlash("éxito", "Pokemon eliminado correctamente");
        return $this -> redirectToRoute("getPokemonList");
    }

    #[Route("/react/pokemon")]
    public function reactPokemon()
    {
        return $this->render("Pokemons/reactPoke.html.twig");
    }
}

import React, {Component} from "react";
import axios from 'axios';

class Pokemons extends Component{
    constructor() {
        super();
        this.state = {pokemons:[], loading:true};
    }

    componentDidMount() {
        this.getPokemons();
    }

    getPokemons(){
        axios.get(`http://localhost:8000/api/pokemons`).then(pokemons=>{
            this.setState({pokemons: pokemons.data, loading:false})
        })
    }

    render() {
        const loading = this.state.loading;

        return (
            <>
                <div className="row">
                    <h2>Pokemons</h2>
                </div>

                {loading ? (
                    <div className={'row text-center'}>
                        <span className="fa fa-spin fa-spinner fa-4x"></span>
                    </div>
                ): (
                    <div className={'row'}>
                        {this.state.pokemons.map(pokemon =>
                            <div className="col mb-4">
                                <div className="card">
                                    <img src={pokemon.imagen} className="card-img-top"/>
                                    <div className="card-body">
                                        <h5 className="card-title">{pokemon.nombre}</h5>
                                        <p className="card-text">{pokemon.descripcion}</p>
                                        <a href="#" className="btn btn-primary">Más
                                            Info</a>
                                    </div>
                                </div>
                            </div>
                        )}
                    </div>
                )}
            </>
        )
    }

}

export default Pokemons;

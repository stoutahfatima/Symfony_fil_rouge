// ./assets/js/components/Posts.js
    
import React, {Component} from 'react';
import axios from 'axios';
    
    
class Produits extends Component {
    constructor() {
        super();
        
        this.state = { produits: [], loading: true}
    }
    
    componentDidMount() {
        this.getProduits();
    }
    
    getProduits() {
        axios.get(`http://localhost:8000/api/produits`).then(res => {
            const produits = res.data.slice(0,15);
            this.setState({ produits, loading: false })
        })
    }
    
    render() {
        const loading = this.state.loading;
        return (
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center"><span>Liste des produits</span>Created with <i
                                className="fa fa-heart"></i> by yemiwebby </h2>
                        </div>
    
                        {loading ? (
                            <div className={'row text-center'}>
                                <span className="fa fa-spin fa-spinner fa-4x"></span>
                            </div>
    
                        ) : (
                            <div className={'row'}>
                                {this.state.produits.map(produit =>
                                    <div className="col-md-10 offset-md-1 row-block" key={produit.id}>
                                        <ul id="sortable">
                                            <li>
                                                <div className="media">
                                                    <div className="media-body">
                                                        <h4>{produit.nom}</h4>
                                                        <p>{produit.stock}</p>
                                                        <p>{produit.prixht}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                </section>
            </div>
        )
    }
}
    
export default Produits;

import React, {Component} from 'react';
import {Routes, Route,Redirect, Link} from 'react-router-dom';
//import Users from './Users';
import Produits from './Produits';
    
class Home extends Component {
    
    render() {
        return (
           <div>
               <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
                   <Link className={"navbar-brand"} to={"/react"}> B </Link>
                   <div className="collapse navbar-collapse" id="navbarText">
                       <ul className="navbar-nav mr-auto">
                           <li className="nav-item">
                               <Link className={"nav-link"} to={"/produits"}> Produits </Link>
                           </li>
    
                       </ul>
                   </div>
               </nav>
               <Routes>
                    <Route path="/react" element={<Produits />} />
                    <Route path="/produits" element={<Produits />} />
                </Routes>
           </div>
        )
    }
}
    
export default Home;
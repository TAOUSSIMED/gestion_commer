<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Route::resource('/clients','ClientController');
Route::get('/', function () {
    return view('base2');
});
Route::get('/erreur', function () {
    return view('erreur');
});

Route::get('/categorie','categorieviewcontroller@index');
Route::get('/categorie/insert','categorieviewcontroller@insertform');
Route::post('/categorie/create','categorieviewcontroller@insert');
Route::get('/categorie/supprimer/{id}','categorieviewcontroller@destroy');
Route::get('/produit','produitviewcontroller@index');
Route::get('/produit/insert','produitviewcontroller@insertform');
Route::post('/produit/create','produitviewcontroller@insert');
Route::get('/produit/supprimer/{id}','produitviewcontroller@destroy');
Route::get('/produit/{id}','produitviewcontroller@indexx');
Route::get('/client_fournisseur','cl_fouviewcontroller@index');
Route::get('/client_fournisseur/insert','cl_fouviewcontroller@insertform');
Route::post('/client_fournisseur/create','cl_fouviewcontroller@insert');
Route::get('/client_fournisseur/supprimer/{id}','cl_fouviewcontroller@destroy');
Route::get('/client_fournisseur/modifie/{id}','cl_fouviewcontroller@modifie');
Route::post('/client_fournisseur/accepted/{id}','cl_fouviewcontroller@modifier');
Route::get('/produit/modifier/{id}','produitviewcontroller@modifie');
Route::post('/produit/accepted/{id}','produitviewcontroller@modifier');
Route::post('/rechercher','produitviewcontroller@rechercher');
Route::post('/rechercher2','cl_fouviewcontroller@rechercher');
Route::get('/devis','devisviewcontroller@gen');
Route::get('/devis_achats','devisviewcontroller@index');
Route::get('/devis_ventes','devisviewcontroller@index2');
Route::get('/devis/{id}','devisviewcontroller@find');
Route::post('/devis/create','devisviewcontroller@insert');
Route::get('/devis/supprimer/{id}','devisviewcontroller@destroy');
Route::get('/devis/modifie/{id}','devisviewcontroller@modifie');
Route::post('/devis/accepted/{id}','devisviewcontroller@modifier');
Route::post('/ligne_devis/create','devisviewcontroller@insertt');
Route::get('/ligne_devis/supprimer/{id}','devisviewcontroller@destroy2');
Route::get('/ligne_devis/modifie/{id}','devisviewcontroller@modifie2');
Route::post('/ligne_devis/accepted/{id}','devisviewcontroller@modifier2');
Route::get('/facture','factureviewcontroller@index');
Route::post('/facture/create','factureviewcontroller@insert');
Route::get('/facture/supprimer/{id}','factureviewcontroller@destroy');
Route::get('/facture/modifie/{id}','factureviewcontroller@modifie');
Route::post('/facture/accepted/{id}','factureviewcontroller@modifier');
Route::get('/facture/{id}','factureviewcontroller@find');
Route::post('/ligne_facture/create','factureviewcontroller@insertt');
Route::get('/ligne_facture/supprimer/{id}','factureviewcontroller@destroy2');
Route::get('/ligne_facture/modifie/{id}','factureviewcontroller@modifie2');
Route::post('/ligne_facture/accepted/{id}','factureviewcontroller@modifier2');
Route::get('/bon_commande','commandeviewcontroller@gen');
Route::get('/bon_commande_achats','commandeviewcontroller@index');
Route::get('/bon_commande_ventes','commandeviewcontroller@index2');
Route::post('/bon_commande/create','commandeviewcontroller@insert');
Route::get('/bon_commande/modifie/{id}','commandeviewcontroller@modifie');
Route::post('/bon_commande/accepted/{id}','commandeviewcontroller@modifier');
Route::get('/bon_commande/supprimer/{id}','commandeviewcontroller@destroy');
Route::get('/bon_commande/{id}','commandeviewcontroller@find');
Route::get('/ligne_bon_commande/supprimer/{id}','commandeviewcontroller@destroy2');
Route::post('/ligne_bon_commande/create','commandeviewcontroller@insertt');
Route::get('/ligne_bon_commande/modifie/{id}','commandeviewcontroller@modifie2');
Route::post('/ligne_bon_commande/accepted/{id}','commandeviewcontroller@modifier2');
Route::get('/bon_livraison','livraisonviewcontroller@index');
Route::get('/bon_livraison_achats','livraisonviewcontroller@index2');
Route::get('/bon_livraison_ventes','livraisonviewcontroller@index3');
Route::post('/bon_livraison/create','livraisonviewcontroller@insert');
Route::get('/bon_livraison/supprimer/{id}','livraisonviewcontroller@destroy');
Route::get('/bon_livraison/modifie/{id}','livraisonviewcontroller@modifie');
Route::post('/bon_livraison/accepted/{id}','livraisonviewcontroller@modifier');
Route::get('/bon_livraison/{id}','livraisonviewcontroller@find');
Route::get('/ligne_livraison/supprimer/{id}','livraisonviewcontroller@destroy2');
Route::post('/ligne_livraison/create','livraisonviewcontroller@insertt');
Route::get('/ligne_livraison/modifie/{id}','livraisonviewcontroller@modifie2');
Route::post('/ligne_livraison/accepted/{id}','livraisonviewcontroller@modifier2');
Route::get('/client','cl_fouviewcontroller@client');
Route::get('/fournisseur','cl_fouviewcontroller@fournisseur');
Route::get('/prospect','cl_fouviewcontroller@prospect');
Route::post('/pdf','cl_fouviewcontroller@pdf');
Route::post('/pdf_produit','produitviewcontroller@pdf');
Route::post('/pdf_client','cl_fouviewcontroller@pdf2');
Route::post('/pdf_fournisseur','cl_fouviewcontroller@pdf3');
Route::post('/pdf_prospect','cl_fouviewcontroller@pdf4');
Route::get('/pdf_devis/{id}','devisviewcontroller@pdf');
Route::get('/pdf_facture/{id}','factureviewcontroller@pdf');
Route::get('/pdf_commande/{id}','commandeviewcontroller@pdf');
Route::get('/pdf_livraison/{id}','livraisonviewcontroller@pdf');
Route::post('/OKK','connectionviewcontroller@index');
Route::get('/login', function () {
    return view('login');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/erreurlogin', function () {
    return view('erreurlogin');
});
Route::post('/utilisateur/create','connectionviewcontroller@insert');







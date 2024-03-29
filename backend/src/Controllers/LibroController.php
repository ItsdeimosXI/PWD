<?php
namespace Raiz\Controllers;


use Raiz\Bd\LibroDAO;
use Raiz\Models\Libro;
use Raiz\Bd\AutorDAO;
use Raiz\Bd\CategoriasDAO;
use Raiz\Bd\GeneroDAO;
use Raiz\Bd\EditorialDAO;



class LibroController implements InterfaceController{

    //Clase que controla de acuerdo a lo que pida la vista: 
    // --- CRUD --- 
    //  Listar 
    //  encontrar uno
    //  crear
    //  actualizar
    //  borrar  

    public static function listar(): array
    {
        $libros = [];
        $listadoLibros = LibroDAO::listar();
        foreach($listadoLibros as $libro){
            $libros[] = $libro->serializar();
        }
        return $libros;
    }
    
    public static function encontrarUno(string $id): ?array
    {
        $Libro = LibroDAO::encontrarUno($id);
        if($Libro===null){
            return $Libro;
        }else{
            return $Libro->serializar();
        }
        
        
        
    }

    public static function crear(array $parametros): array
    {   
        $parametros['genero'] = GeneroDAO::encontrarUno($parametros['id_genero']);
        $parametros['categoria'] = CategoriasDAO::encontrarUno($parametros['id_categoria']);
        $parametros['editorial'] = EditorialDAO::encontrarUno($parametros['id_editorial']);
        // Cargar detalles completos de los autores
        $autores = [];
        foreach ($parametros['id_autor'] as $idAutor) {
            $autor = AutorDAO::encontrarUno($idAutor);
            if ($autor !== null) {
                $autores[] = $autor;
            }
        }
        $parametros['autorList'] = $autores;
        $Libro = new Libro(
            id: null,
            titulo: $parametros['titulo'],
            autorList: $parametros['autorList'],
            editorial: $parametros['editorial'],
            cant_paginas: $parametros['cant_paginas'],
            anio: $parametros['anio'],
            genero: $parametros['genero'],
            categoria: $parametros['categoria'],
        );
    
        LibroDAO::crear($Libro);
        return $Libro->serializar();
    }
    
    public static function actualizar(array $parametros): array
    {
        $parametros['genero'] = GeneroDAO::encontrarUno($parametros['id_genero']);
        $parametros['categoria'] = CategoriasDAO::encontrarUno($parametros['id_categoria']);
        $parametros['editorial'] = EditorialDAO::encontrarUno($parametros['id_editorial']);
        $autores = [];
        foreach ($parametros['id_autor'] as $idAutor) {
            $autor = AutorDAO::encontrarUno($idAutor);
            if ($autor !== null) {
                $autores[] = $autor;
            }
        }
        
        $parametros['autorList'] = $autores;
        var_dump($autores);
        $libro = new Libro(
            id: $parametros['id'],
            titulo: $parametros['titulo'],
            autorList: $parametros['autorList'],
            editorial: $parametros['editorial'],
            cant_paginas: $parametros['cant_paginas'],
            anio: $parametros['anio'],
            genero: $parametros['genero'],
            categoria: $parametros['categoria'],
            estado: $parametros['estado'],
        );

        LibroDAO::actualizar($libro);
        return $libro->serializar();
    }


    public function actualizarEstado(array $parametros){
        $Libro = Libro::deserializar($parametros);
        LibroDAO::actualizarEstado($Libro);
        return $Libro->serializar();
    }


    public static function borrar(string $id):void
    {
        LibroDAO::borrar($id);
        
    }
    
    


}


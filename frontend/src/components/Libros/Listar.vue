<template>
    <div>
        <section class="intro">
            <div class="gradient-custom-1 h-100">
                <div class="mask d-flex align-items-center h-100">
                    <div class="container">
                        <div class="input-goup mb-3">
                            <router-link :to="{ name: 'CrearLibro' }">
                                <button class="btn btn-success">
                                    <i class="fa-solid fa-check"> </i>Crear nuevo Libro
                                </button>
                            </router-link>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="table-responsive bg-white">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">TITULO</th>
                                                <th scope="col">AUTOR</th>
                                                <th scope="col">EDITORIAL</th>
                                                <th scope="col">AÑO</th>
                                                <th scope="col">CANTIDAD DE PAGINAS</th>
                                                <th scope="col">GENERO</th>
                                                <th scope="col">CATEGORIA</th>
                                                <th scope="col">ESTADO</th>
                                                <th scope="col">ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="libro in libros" :key="libro.id">
                                                <th scope="row" style="color: #666666;">{{ libro.id }}</th>
                                                <td>{{ libro.titulo }}</td>
                                                <td>
                                                    <template v-if="libro.autor && libro.autor.length > 0">
                                                        <span v-for="(autor, index) in libro.autor" :key="index">
                                                            {{ autor.nombre_apellido }}
                                                            <span v-if="index < libro.autor.length - 1">, </span>
                                                        </span>
                                                    </template>
                                                </td>
                                                <td>{{ libro.editorial['nombre'] }}</td>
                                                <td>{{ libro.anio }}</td>
                                                <td>{{ libro.cant_paginas }}</td>
                                                <td>{{ libro.genero['descripcion'] }}</td>
                                                <td>{{ libro.categoria['descripcion'] }}</td>
                                                <td>{{ libro.estado }}</td>
                                                <td>
                                                    <router-link :to="{ path: '/libros/actualizar/' + libro.id }"
                                                        class="btn btn-warning">
                                                        <i class="fa-solid fa-edit"></i>
                                                    </router-link>
                                                    <button class="btn btn-danger"
                                                        @click="eliminar(libro.id, libro.titulo)">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                                &nbsp;

                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script lang="ts">
import axios from 'axios';
import { confirmar } from '../Funciones/Funciones.js';
export default {
    data() {
        return {
            libros: null
        }
    },
    mounted() {
        this.getLibros();
    },
    methods: {
        getLibros() {
            axios.get('http://127.0.0.1:8000/api/expediente/').then(
                response => (
                    this.libros = response.data
                )
            );

        },
        eliminar(id: any, descripcion: any, url = 'http://127.0.0.1:8000/apiv1/libros', mensaje = 'Libro eliminado', href = '/Libros') {
            confirmar(id, descripcion, url, mensaje, href)
        }
    }
}
</script>

                    
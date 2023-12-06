import { createRouter, createWebHistory } from 'vue-router'
import Home from '../components/Home.vue';
import SociosListar from '../components/Socios/Listar.vue';
import ListarGeneros from '../components/Generos/ListarGeneros.vue';
import SociosCrear from '../components/Socios/Crear.vue';
import CrearGeneros from '../components/Generos/CrearGenero.vue';
import SocioActualizar from '../components/Socios/Actualizar.vue';
import ActualizarGenero from '../components/Generos/ActualizarGenero.vue';
import LibrosListar from '../components/Libros/Listar.vue';
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../components/About.vue')
    },
    {
      path: '/socios',
      name: 'Socios',
      component: SociosListar
    },
    {
      path: '/generos',
      name: 'Generos',
      component: ListarGeneros
    },
    {
      path: '/generos/crear',
      name: 'CrearGeneros',
      component: CrearGeneros
    },
    {
      path: '/generos/actualizar/:id',
      name: 'ActualizarGenero',
      component: ActualizarGenero
    },
    {
      path: '/socios/crear',
      name: 'sociosCrear',
      component: SociosCrear
    },
    { path: '/socios/actualizar/:id', 
    name: 'ActualizarSocio', 
    component: SocioActualizar }
    ,
    { path: '/libros/', 
    name: 'Libros', 
    component: LibrosListar },
  ]
})

export default router
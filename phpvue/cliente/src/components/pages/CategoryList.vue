<template>
    <layout-div>
      <div class="container">
        <h2 class="text-center mt-5 mb-3">Gestor de Categorías</h2>
        <div class="card">
          <div class="card-header">
            <router-link to="/create" class="btn btn-outline-primary"
              >Crear nueva categoría
            </router-link>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Fecha Actualizada</th>
                  <th>Borrado</th>
                  <th width="240px">Acción</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="category in categories" :key="category.category_id">
                  <td>{{ category.name }}</td>
                  <td>{{ category.last_update }}</td>
                  <td>{{ category.isDeleted }}</td>
                  <td>
                    <router-link
                      :to="`/show/${category.category_id}`"
                      class="btn btn-outline-info mx-1"
                      >Mostrar</router-link
                    >
                    <router-link
                      :to="`/edit/${category.category_id}`"
                      class="btn btn-outline-success mx-1"
                      >Editar</router-link
                    >
                    <button
                      @click="handleDelete(category.category_id)"
                      className="btn btn-outline-danger mx-1"
                    >
                      Eliminar
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </layout-div>
  </template>
  
  <script>
  import axios from "axios";
  import LayoutDiv from "../LayoutDiv.vue";
  import Swal from "sweetalert2";
  
  export default {
    name: "CategoryList",
    components: {
      LayoutDiv,
    },
    data() {
      return {
        posts: [],
        categories: [],
      };
    },
    created() {
      this.fetchCategoryList();
    },
    methods: {
      fetchCategoryList() {
        axios
          .get("http://localhost/tecnoweb/phpvue/api/api.php")
          .then((response) => {
            this.categories = response.data;
            return response;
          })
          .catch((error) => {
            return error;
          });
      },
      handleDelete(id) {
        Swal.fire({
          title: "Confirmación de eliminacion",
          text: "Estas seguro? No podras cambiar esta acción!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Cancelar",
          confirmButtonText: "Si, eliminalo!",
        }).then((result) => {
          if (result.isConfirmed) {
            axios
              .delete(`http://localhost/tecnoweb/phpvue/api/api.php?id=${id}`)
              .then((response) => {
                alert(id);
                Swal.fire({
                  icon: "success",
                  title: "Categoría eliminada correctamente!",
                  showConfirmButton: false,
                  timer: 1500,
                });
                this.fetchCategoryList();
                return response;
              })
              .catch((error) => {
                Swal.fire({
                  icon: "error",
                  title: "Un error ha ocurrido!",
                  showConfirmButton: false,
                  timer: 1500,
                });
                return error;
              });
          }
        });
      },
    },
  };
  </script>
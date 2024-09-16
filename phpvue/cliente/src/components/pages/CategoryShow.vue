<template>
    <layout-div>
      <h2 class="text-center mt-5 mb-3">Mostrar Categorias</h2>
      <div class="card">
        <div class="card-header">
          <router-link class="btn btn-outline-info float-right" to="/"> 
            Ver todas las Categorias
          </router-link>
        </div>
        <div class="card-body">
          <b className="text-muted">Nombre:</b>
          <p>{{ category.name }}</p>
          <b className="text-muted">Fecha:</b>
          <p>{{ category.last_update }}</p>
          <b className="text-muted">Eliminado:</b>
          <p>{{ category.isDeleted }}</p>
        </div>
      </div>
    </layout-div>
  </template>
  
  <script>
  import axios from "axios";
  import LayoutDiv from "../LayoutDiv.vue";
  import Swal from "sweetalert2";
  
  export default {
    name: "CategoryShow",
    components: {
      LayoutDiv,
    },
    data() {
      return {
        category: {
          name: "",
          last_update: "",
          isDeleted: 0
        },
        isSaving: false,
      };
    },
    created() {
      const id = this.$route.params.id;
      axios
        .get(`http://localhost/tecnoweb/phpvue/api/api.php?id=${id}`)
        .then((response) => {
          let categoryInfo = response.data;
          this.category.name = categoryInfo[0].name;
          this.category.last_update = categoryInfo[0].last_update;
          this.category.isDeleted = categoryInfo[0].isDeleted;
          
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
    },
    methods: {},
  };
  </script>
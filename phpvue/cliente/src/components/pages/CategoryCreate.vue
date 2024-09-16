<template>
    <layout-div>
      <h2 class="text-center mt-5 mb-3">Crear nueva categoria</h2>
      <div class="card">
        <div class="card-header">
          <router-link class="btn btn-outline-info float-right" to="/"
            >Ver todas las categorias
          </router-link>
        </div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <label htmlFor="name">Nombre</label>
              <input
                v-model="category.name"
                type="text"
                class="form-control"
                id="name"
                name="name"
              />
            </div>
            <button
              @click="handleSave()"
              :disabled="isSaving"
              type="button"
              class="btn btn-outline-primary mt-3"
            >
              Guardar Categoria
            </button>
          </form>
        </div>
      </div>
    </layout-div>
  </template>
  
  <script>
  import axios from "axios";
  import LayoutDiv from "../LayoutDiv.vue";
  import Swal from "sweetalert2";
  
  export default {
    name: "CategoryCreate",
    components: {
      LayoutDiv,
    },
    data() {
      return {
        category: {
          name: "",
        },
        isSaving: false,
      };
    },
    methods: {
      handleSave() {
        this.isSaving = true;
        axios
          .post("http://localhost/tecnoweb/phpvue/api/api.php", this.category)
          .then((response) => {
            Swal.fire({
              icon: "success",
              title: "Categoria guardada exitosamente!",
              showConfirmButton: false,
              timer: 1500,
            });
            this.isSaving = false;
            this.category.name = "";
            return response;
          })
          .catch((error) => {
            this.isSaving = false;
            Swal.fire({
              icon: "error",
              title: "Un error ha ocurrido!",
              showConfirmButton: false,
              timer: 1500,
            });
            return error;
          });
      },
    },
  };
  </script>
import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import axios from "axios";
import Swal from "sweetalert2";

const CategoryList = () => {
  const [categories, setCategories] = useState([]);

  useEffect(() => {
    fetchCategoryList();
  }, []);

  const fetchCategoryList = async () => {
    try {
      const response = await axios.get(
        "http://localhost/tecnoweb/phpvue/api/api.php"
      );
      setCategories(response.data);
    } catch (error) {
      console.error(error);
    }
  };

  const handleDelete = (id) => {
    Swal.fire({
      title: "Confirmación de eliminación",
      text: "¿Estas seguro? ¡No podrás cambiar esta acción!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, eliminalo!",
    }).then((result) => {
      if (result.isConfirmed) {
        axios
          .delete(`http://localhost/tecnoweb/phpvue/api/api.php?id=${id}`, {
            data: { id },
          })
          .then((response) => {
            Swal.fire({
              icon: "success",
              title: "¡Categoría eliminada correctamente!",
              showConfirmButton: false,
              timer: 1500,
            });
            fetchCategoryList();
          })
          .catch((error) => {
            Swal.fire({
              icon: "error",
              title: "¡Un error ha ocurrido!",
              showConfirmButton: false,
              timer: 1500,
            });
            console.error(error);
          });
      }
    });
  };

  return (
    <div className="container">
      <h2 className="text-center mt-5 mb-3">Gestor de Categorías</h2>
      <div className="card">
        <div className="card-header">
          <Link to="/create" className="btn btn-outline-primary">
            Crear nueva categoría
          </Link>
        </div>
        <div className="card-body">
          <table className="table table-bordered">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Fecha Actualizada</th>
                <th>Borrado</th>
                <th width="240px">Acción</th>
              </tr>
            </thead>
            <tbody>
              {categories.map((category) => (
                <tr key={category.category_id}>
                  <td>{category.name}</td>
                  <td>{category.last_update}</td>
                  <td>{category.isDeleted}</td>
                  <td>
                    <Link
                      to={`/show/${category.category_id}`}
                      className="btn btn-outline-info mx-1"
                    >
                      Mostrar
                    </Link>
                    <Link
                      to={`/edit/${category.category_id}`}
                      className="btn btn-outline-success mx-1"
                    >
                      Editar
                    </Link>
                    <button
                      onClick={() => handleDelete(category.category_id)}
                      className="btn btn-outline-danger mx-1"
                    >
                      Eliminar
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

export default CategoryList;

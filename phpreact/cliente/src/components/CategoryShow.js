import React, { useEffect, useState } from "react";
import { Link, useParams } from "react-router-dom";
import axios from "axios";
import Swal from "sweetalert2";

const CategoryShow = () => {
  const { id } = useParams();
  const [category, setCategory] = useState({
    name: "",
    last_update: "",
    isDeleted: 0,
  });

  useEffect(() => {
    const fetchCategory = async () => {
      try {
        const response = await axios.get(
          `http://localhost/tecnoweb/phpreact/api/api.php?id=${id}`
        );
        const categoryInfo = response.data[0];
        setCategory({
          name: categoryInfo.name,
          last_update: categoryInfo.last_update,
          isDeleted: categoryInfo.isDeleted,
        });
      } catch (error) {
        Swal.fire({
          icon: "error",
          title: "Un error ha ocurrido!",
          showConfirmButton: false,
          timer: 1500,
        });
        console.error(error);
      }
    };

    fetchCategory();
  }, [id]);

  return (
    <div className="container">
      <h2 className="text-center mt-5 mb-3">Mostrar Categorias</h2>
      <div className="card">
        <div className="card-header">
          <Link to="/" className="btn btn-outline-info float-right">
            Ver todas las Categorias
          </Link>
        </div>
        <div className="card-body">
          <b className="text-muted">Nombre:</b>
          <p>{category.name}</p>
          <b className="text-muted">Fecha:</b>
          <p>{category.last_update}</p>
          <b className="text-muted">Eliminado:</b>
          <p>{category.isDeleted}</p>
        </div>
      </div>
    </div>
  );
};

export default CategoryShow;

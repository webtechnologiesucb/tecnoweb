import React, { useState, useEffect } from "react";
import { Link, useParams, useNavigate } from "react-router-dom";
import axios from "axios";
import Swal from "sweetalert2";

const CategoryEdit = () => {
  const { id } = useParams();
  const [category, setCategory] = useState({ name: "" });
  const [isSaving, setIsSaving] = useState(false);
  const navigate = useNavigate();

  useEffect(() => {
    const fetchCategory = async () => {
      try {
        const response = await axios.get(
          `http://localhost/tecnoweb/phpreact/api/api.php?id=${id}`
        );
        const categoryInfo = response.data[0];
        setCategory({ id: categoryInfo.category_id, name: categoryInfo.name });
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

  const handleSave = async () => {
    setIsSaving(true);
    try {
      await axios.patch(
        `http://localhost/tecnoweb/phpreact/api/api.php?id=${id}`,
        category
      );
      Swal.fire({
        icon: "success",
        title: "Categoria actualizada exitosamente!",
        showConfirmButton: false,
        timer: 1500,
      });
      setIsSaving(false);
      navigate("/");
    } catch (error) {
      setIsSaving(false);
      Swal.fire({
        icon: "error",
        title: "Un error ha ocurrido!",
        showConfirmButton: false,
        timer: 1500,
      });
      console.error(error);
    }
  };

  return (
    <div className="container">
      <h2 className="text-center mt-5 mb-3">Edit Category</h2>
      <div className="card">
        <div className="card-header">
          <Link to="/" className="btn btn-outline-info float-right">
            Ver todas las categorías
          </Link>
        </div>
        <div className="card-body">
          <form>
            <div className="form-group">
              <label htmlFor="name">Nombre</label>
              <input
                value={category.name}
                onChange={(e) =>
                  setCategory({ ...category, name: e.target.value })
                }
                type="text"
                className="form-control"
                id="name"
                name="name"
              />
            </div>
            <button
              onClick={handleSave}
              disabled={isSaving}
              type="button"
              className="btn btn-outline-primary mt-3"
            >
              Guardar Categoria
            </button>
          </form>
        </div>
      </div>
    </div>
  );
};

export default CategoryEdit;

import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import axios from "axios";
import Swal from "sweetalert2";

const CategoryCreate = () => {
  const [category, setCategory] = useState({ name: "" });
  const [isSaving, setIsSaving] = useState(false);
  const navigate = useNavigate();

  const handleSave = async () => {
    setIsSaving(true);
    try {
      const response = await axios.post(
        "http://localhost/tecnoweb/phpreact/api/api.php",
        category
      );
      Swal.fire({
        icon: "success",
        title: "Categoria guardada exitosamente!",
        showConfirmButton: false,
        timer: 1500,
      });
      setCategory({ name: "" });
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
      <h2 className="text-center mt-5 mb-3">Crear nueva categoria</h2>
      <div className="card">
        <div className="card-header">
          <Link to="/" className="btn btn-outline-info float-right">
            Ver todas las categorias
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

export default CategoryCreate;

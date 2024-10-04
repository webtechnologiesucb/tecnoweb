from flask import Flask, jsonify, request
from db import obtener_conexion

app = Flask(__name__)

@app.route('/categories', methods=['GET'])
def obtener_categorias():
    conexion = obtener_conexion()
    categorias = []
    with conexion.cursor() as cursor:
        cursor.execute("SELECT category_id, name, last_update, isDeleted FROM category WHERE isDeleted = 0")
        categorias = cursor.fetchall()
    conexion.close()
    return jsonify(categorias)

@app.route('/category', methods=['POST'])
def agregar_categoria():
    nueva_categoria = request.json
    conexion = obtener_conexion()
    with conexion.cursor() as cursor:
        cursor.execute("INSERT INTO category (name, last_update, isDeleted) VALUES (%s, NOW(), 0)", (nueva_categoria['name'],))
        conexion.commit()
    conexion.close()
    return jsonify({'mensaje': 'Categoría agregada'}), 201

@app.route('/category/<int:id>', methods=['PATCH'])
def actualizar_categoria(id):
    datos_categoria = request.json
    conexion = obtener_conexion()
    with conexion.cursor() as cursor:
        cursor.execute("UPDATE category SET name = %s, last_update = NOW() WHERE category_id = %s AND isDeleted = 0", (datos_categoria['name'], id))
        conexion.commit()
    conexion.close()
    return jsonify({'mensaje': 'Categoría actualizada'})

@app.route('/category/<int:id>', methods=['DELETE'])
def eliminar_categoria(id):
    conexion = obtener_conexion()
    with conexion.cursor() as cursor:
        cursor.execute("UPDATE category SET isDeleted = 1, last_update = NOW() WHERE category_id = %s", (id,))
        conexion.commit()
    conexion.close()
    return jsonify({'mensaje': 'Categoría eliminada'})

if __name__ == '__main__':
    app.run(debug=True)

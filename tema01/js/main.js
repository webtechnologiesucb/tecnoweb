//NaN Not a Number
// para cadenas '' "" ´Hola ${name}´ comillas oblicuas
//querySelectorAll
//querySelector
//matches
//closest

"use strict";

const contenido = document.getElementById("contenido");
contenido.innerHTML = "Hola estudiantes";

// ingresarEdad();

function ingresarEdad() {
  //console.time();
  let respuesta = confirm("Deseas proceder?");
  if (respuesta) {
    let edad = Number(prompt("Ingresa tu edad:"));
    console.log("Tu edad es: " + edad);
    console.log(respuesta);
  }
  //console.timeEnd();
  //console.count();
}
//console.trace();
//console.table(["apples", "oranges", "bananas"]);
//console.dir();
/*
console.count(); 
console.assert
console.table
console.time
console.timeEnd
console.warn
console.error
console.clear
console.dir
console.trace
*/

//node.append(...nodes or strings) despues
//node.prepend(...nodes or strings) antes
//node.before(...nodes or strings) antes del objeto
//node.after(...nodes or strings) despues del objeto
//node.replaceWith(...nodes or strings)

//insertAdjacentHTML
//insertAdjacentText
//.cloneNode

// let fragment = new DocumentFragment();

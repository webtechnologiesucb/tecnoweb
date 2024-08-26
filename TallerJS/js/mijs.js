function mensaje()
{
     alert('Eligio aqui!');
}

function obtenerClic()
{
    document.getElementsByTagName('p')[0].onclick = 
    mensaje();
}
window.onload = obtenerClic;
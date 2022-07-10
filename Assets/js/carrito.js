const btnAddDeseo = document.querySelectorAll('.btnAddDeseo');
const btnAddCarrito = document.querySelectorAll('.btnAddCarrito');
const btnDeseo = document.querySelector('#btnCantidadDeseo');
const btnCarrito = document.querySelector('#btnCantidadCarrito');

let listaDeseo, listaCarrito;
document.addEventListener('DOMContentLoaded', function(){
    if (localStorage.getItem('listaDeseo') != null) {
        listaDeseo = JSON.parse(localStorage.getItem('listaDeseo'));
    }
    if (localStorage.getItem('listaCarrito') != null) {
        listaCarrito = JSON.parse(localStorage.getItem('listaCarrito'));
    }
    
    for (let i = 0; i<btnAddDeseo.length; i++) {
        btnAddDeseo[i].addEventListener('click', function() {
            let idProducto = btnAddDeseo[i].getAttribute('prod');
            agregarDeseo(idProducto);
        })   
    }
    for (let i = 0; i<btnAddCarrito.length; i++) {
        btnAddCarrito[i].addEventListener('click', function() {
            let idProducto = btnAddCarrito[i].getAttribute('prod');
            agregarCarrito(idProducto,1);
          })
    }
    cantidadDeseo();
    cantidadCarrito();
})
//Agregar productos a la lista de deseo
function agregarDeseo(idProducto) {
    if (localStorage.getItem('listaDeseo') == null) {
        listaDeseo = [];
    } else {
        let listaExiste = JSON.parse(localStorage.getItem('listaDeseo'));
        for (let i = 0; i < listaExiste.length; i++) {
           if (listaExiste[i]['idProducto'] == idProducto) {
                Swal.fire(
                'Aviso',
                'EL PRODUCTO YA ESTA EN LISTA DE DESEO',
                'warning'
                )
                return;
           }
        }
        listaDeseo.concat(localStorage.getItem('listaDeseo'));
    }
    listaDeseo.push({
        "idProducto": idProducto,
        "cantidad": 1
    })
    localStorage.setItem('listaDeseo', JSON.stringify(listaDeseo));
    Swal.fire(
        'Aviso',
        'PRODUCTO AGREGADO A LA LISTA DE DESEOS',
        'success'
      )
    cantidadDeseo();
}
function cantidadDeseo() {
    let listas = JSON.parse(localStorage.getItem('listaDeseo'));
    if (listas != null) {
        btnDeseo.textContent = listas.length;        
    } else {
        btnDeseo.textContent = 0;          
    }   
}

//Agregar productos al Carrito
function agregarCarrito(idProducto, cantidad) {
    if (localStorage.getItem('listaCarrito') == null) {
        listaCarrito = [];
    } else {
        let listaExiste = JSON.parse(localStorage.getItem('listaCarrito'));
        for (let i = 0; i < listaExiste.length; i++) {
           if (listaExiste[i]['idProducto'] == idProducto) {
                Swal.fire(
                'Aviso',
                'EL PRODUCTO YA ESTA agregado',
                'warning'
                )
                return;
           }
        }
        listaCarrito.concat(localStorage.getItem('listaCarrito'));
    }
    listaCarrito.push({
        "idProducto": idProducto,
        "cantidad": cantidad
    })
    localStorage.setItem('listaCarrito', JSON.stringify(listaCarrito));
    Swal.fire(
        'Aviso',
        'PRODUCTO AGREGADO AL CARRITO',
        'success'
      )
    cantidadCarrito();
}
function cantidadCarrito() {
    let listas = JSON.parse(localStorage.getItem('listaCarrito'));
    if (listas != null) {
        btnCarrito.textContent = listas.length;        
    } else {
        btnCarrito.textContent = 0;          
    }   
}
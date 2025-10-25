<link rel="stylesheet" href="https://bootswatch.com/5/solar/bootstrap.min.css" />


<main>
	
	<?php require_once("header.html"); ?>
	<body>
		<div id="header" class="container align-items-center p-5 my-5 position-relative d-flex justify-content-between align-items-center ">


			<div class="carritoCompras">
				<button class="btn bg-dark text-light">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
						class="bi bi-cart" viewBox="0 0 16 16">
						<path
							d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
					</svg>
					<!-- <span class="badge bg-primary rounded-pill"></span> -->
				</button>

				<div class="container compras position-absolute bg-dark text-center p-3">
					<p>No hay productos seleccionados</p>
					<!--INICIO ROW -->
					<!-- <div class="row my-3 py-3 align-items-center border-bottom">
						<div class="col-md-3">
							<img
								src="https://cdn.dummyjson.com/product-images/1/thumbnail.jpg"
								alt=""
								class="img-fluid"
							/>
						</div>

						<div class="col-md-3">
							<p>Producto 1</p>
						</div>

						<div class="col-md-3">
							<p>100€</p>
						</div>

						<div class="col-md-3">
							<button class="btn-close"></button>
						</div>
					</div> -->
					<!-- FIN ROW -->
				</div>

				<!-- FIN CARRITO -->
			</div>
</div>

		<section id="elementos" class="container border p-5">
			<div class="row">
				<!-- INICIO COL -->
				<!-- <div class="col-md-4">
					<div class="card border-primary mb-3" style="max-width: 20rem">
						<div class="card-header">
							<img
								src="https://cdn.dummyjson.com/product-images/1/thumbnail.jpg"
								alt=""
								class="img-fluid"
							/>
						</div>
						<div class="card-body">
							<h4 class="card-title">titulo producto</h4>
							<p class="card-text">descripcion producto</p>
							<p>100€</p>
							<button class="btn btn-danger">Añadir al carrito</button>
						</div>
					</div>
				</div> -->

				<!-- FIN COL -->
			</div>
		</section>
		<script src="../productos.js"></script>
		<script>
			
			let row = document.querySelector("section#elementos .row");
			let compras = document.querySelector(".compras");
			let carritoCompras = document.querySelector(".carritoCompras");
			let carrito = [];
			let numProductosCarrito = document.createElement("span");
			let contador = 0;
			numProductosCarrito.classList.add("badge", "bg-primary", "rounded-pill");
			carritoCompras.append(numProductosCarrito);

			console.log(productos);
			document.addEventListener("DOMContentLoaded", () => {
				 function cargarProductos() {
					productos.forEach((producto) => {
						row.innerHTML += ` 
					
				<div class="col-md-4">
					<div class="card border-primary mb-3">
						<div class="card-header">
							<img
								src="${producto.imagen}"
								alt=""
								class="img-fluid"
							/>
						</div>
						<div class="card-body d-flex flex-column">
							<h4 class="card-title">${producto.nombre}</h4>
							<p class="card-text">${producto.descripcion}</p>
							
							<p><span>${producto.precio}</span> €</p>
							<button class="btn btn-danger mt-auto py-3" onClick="agregarAlCarrito(this,${producto.id})" >Añadir al carrito</button>
						</div>
					</div>
				</div>
				
				`;
					});
				}

				cargarProductos();

				// AGREGAR PRDOCUTOS AL CARRITO
			});

			function agregarAlCarrito(elemento, id) {
				let padre = elemento.parentElement.parentElement;
				// console.log(padre);
				let elementoActual = {
					id,
					nombre: padre.querySelector("h4").textContent,
					imagen: padre.querySelector("img").src,
					cantidad: 1,
					precio: padre.querySelector("p span").textContent,
				};
				let existeProducto = carrito.some((producto) => producto.id == id);
				if (!existeProducto) {
					carrito = [...carrito, elementoActual];
					console.log(carrito);
				} else {
					carrito.map((producto) => {
						if (producto.id == id) {
							producto.cantidad++;
						}
					});
				}
				// let existeProducto = carrito.some((producto) => producto.id);

				// if (!existeProducto) {
				// 	carrito.push(elementoActual);
				// }

				// if (!existeProducto) {
				// 	carrito.push(elementoActual);
				// }

				// console.log(carrito);
				cargarCarrito();
			}


			function cargarCarrito() {
				limpiar();

				// numProductosCarrito.textContent

				let cantidadTotal = carrito.reduce((acum, objeto) => {
					return acum + objeto.cantidad;
				}, 0);
				numProductosCarrito.textContent = cantidadTotal;

				carrito.forEach((producto) => {
					compras.innerHTML += `
			<div class="row my-3 py-3 align-items-center border-bottom">
						<div class="col-md-3">
							<img
								src="${producto.imagen}"
								alt=""
								class="img-fluid"
							/>
						</div>

						<div class="col-md-3">
							<p>${producto.nombre}</p>
						</div>

						<div class="col-md-3">
							<p>${producto.precio}€ x ${producto.cantidad}</p>
						</div>

						<div class="col-md-3">
							<button class="btn-close" onClick="borrarProductoCarrito(this, ${producto.id})"></button>
						</div>
					</div>
		
		`;
				});
			}

			function borrarProductoCarrito(elemento, id) {
				let cantidadTotal = carrito.reduce((acum, objeto) => {
					return acum + objeto.cantidad;
				}, 0);
				cantidadTotal--;
				numProductosCarrito.textContent = cantidadTotal;

				elemento.parentElement.parentElement.remove();
				// carrito.splice(carrito.indexOf(id), 1);

				// carrito = carrito.filter((producto) => producto.id != id);
				carrito = carrito.filter((producto) => producto.id !== id);
			}
			function limpiar() {
				compras.innerHTML = "";
			}
		</script>
</main>
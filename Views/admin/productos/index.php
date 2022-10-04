<?php include_once 'Views/template/header-admin.php' ?>
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">

            <!-- BREADCRUMB -->
            <div class="page-meta mb-3">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Datatables</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Productos</li>
                    </ol>
                </nav>
            </div>
            <!-- /BREADCRUMB -->
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <button class="btn btn-primary mb-4 me-4" id="registrar_producto">
                        Agregar Producto
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>

                    </button>
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <table id="tblProductos" class="table dt-table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Categoria</th>
                                        <th>Producto</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Imagen</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--  BEGIN FOOTER  -->
    <div class="footer-wrapper">
        <div class="footer-section f-section-1">
            <p class="">Copyright © <span class="dynamic-year">2022</span> <a target="_blank" href="https://designreset.com/cork-admin/">DesignReset</a>, All rights reserved.</p>
        </div>
        <div class="footer-section f-section-2">
            <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg></p>
        </div>
    </div>
    <!--  END CONTENT AREA  -->
</div>
<!--  END CONTENT AREA  -->

<!-- Modal -->
<div class="modal fade" id="productoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleProducto"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <form id="frmProducto">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="imagen_actual" name="imagen_actual">
                    <div class="row mb-4">
                        <div class="col">
                            <select class="form-control " name="categoria2" id="categoria2">
                                <!--class="form-select mb-4" aria-label="Default select example" <option selected>Categoría</option> -->
                                <option selected>Categoría</option>
                                <?php foreach ($data['categorias'] as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['categoria']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col">
                            <div class="form-group ">
                                <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo de producto">
                            </div>
                        </div>
                    </div>


                    <div class="form-group mb-4">
                        <label for="categoria">Categoría</label>
                        <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Categoría">
                    </div>
                    <div class="form-group mb-4">
                        <label for="producto">Producto</label>
                        <input type="text" class="form-control" id="producto" name="producto" placeholder="Producto">
                    </div>
                    <div class="form-group mb-4">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="imagen">Imagen (opcional)</label>
                        <input id="imagen" class="form-control-file" type="file" name="imagen">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnAccion"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>Assets/js/modulos/productos.js"></script>


<?php include_once 'Views/template/footer-admin.php' ?>
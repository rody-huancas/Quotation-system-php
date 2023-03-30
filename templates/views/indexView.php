<?php require_once INCLUDES . 'head.php' ?>
<?php require_once INCLUDES . 'navbar.php' ?>

<!-- CONTENT -->
<div class="container-fluid py-5">
    <div class="row">
        <div class="col-12 wrapper_notifications">
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7 col-12">
            <div class="card mb-3">
                <div class="card-header">Información del cliente</div>
                <div class="card-body">
                    <form action="">
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre" required>
                            </div>
                            <div class="col-4">
                                <label for="empresa">Empresa</label>
                                <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Ingrese su empresa" required>
                            </div>
                            <div class="col-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su email" required>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Agregar un nuevo concepto</div>
                <div class="card-body">
                    <form id="add_to_quote" method="POST">
                        <div class="form-group row">
                            <div class="col-3">
                                <label for="concepto">Concepto</label>
                                <input type="text" class="form-control" id="concepto" name="concepto" placeholder="Ingrese el concepto" required>
                            </div>
                            <div class="col-3">
                                <label for="tipo">Tipo de producto</label>
                                <select name="tipo" id="tipo" class="form-control">
                                    <option value="producto">Producto</option>
                                    <option value="servicio">Servicio</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" max="99999" value="1" required>
                            </div>
                            <div class="col-3">
                                <label for="precio_unitario">Precio Unitario</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control" id="precio_unitario" name="precio_unitario" placeholder="0.00" required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button class="btn btn-success" type="submit">Agregar Concepto</button>
                        <button class="btn btn-danger" type="reset">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-12">
            <div class="wrapper_update_concept" style="display: none;">
                <div class="card mb-3">
                    <div class="card-header">Editando concepto</div>
                    <div class="card-body">
                        <form id="save_concept" method="POST">
                            <input type="hidden" class="form-control" id="id_concepto" name="id_concepto" required>
                            <div class="form-group d-grid justify-content-center row" style="grid-template-columns: repeat(3, 1fr); grid-gap: 20px;">
                                <div class="col-5">
                                    <label for="concepto">Concepto</label>
                                    <input type="text" class="form-control" id="concepto" name="concepto" placeholder="Ingrese el concepto" required>
                                </div>
                                <div class="col-5">
                                    <label for="tipo">Tipo de producto</label>
                                    <select name="tipo" id="tipo" class="form-control">
                                        <option value="producto">Producto</option>
                                        <option value="servicio">Servicio</option>
                                    </select>
                                </div>
                                <div class="col-5">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" max="99999" value="1" required>
                                </div>
                                <div class="col-5">
                                    <label for="precio_unitario">Precio Unitario</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text" class="form-control" id="precio_unitario" name="precio_unitario" placeholder="0.00" required>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-success" type="submit">Guardar Concepto</button>
                            <button class="btn btn-danger" type="reset" id="cancel_edit">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Resumen de cotización
                    <button class="btn btn-danger float-right restart_quote">Reiniciar</button>
                </div>
                <div class="card-body wrapper_quote">

                </div>
                <div class="card-footer">
                    <button class="btn btn-success" id="generate_quote">Generar Cotización</button>
                    <a class="btn btn-primary" id="download_quote" style="display: none;" href="">Descargar PDF</a>
                    <button class="btn btn-success" id="send_quote" style="display: none;">Envíar por correo</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ENDCONTENT -->

<?php require_once INCLUDES . 'footer.php' ?>
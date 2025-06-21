<div id="modalmantenimiento" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 id="lbltitulo" class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Nuevo Registro</h6>
            </div>
            <form method="post" id="asistencia_form" enctype="multipart/form-data">
                <div class="modal-body pd-25">
                    <input type="hidden" name="id_asistencia" id="id_asistencia" />
                    <input type="hidden" name="usu_id" id="usu_id" value="<?php echo $_SESSION['usu_id']; ?>" />
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="fecha">Fecha: *</label>
                                <input class="form-control" id="fecha" type="date" name="fecha" required />
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12 center">
                            <video id="theVideo" autoplay muted></video>
                            <canvas id="theCanvas"></canvas> <!-- Mantener oculto el canvas -->
                        </div>
                        <img id="preview_foto" src="" width="300" height="300" class="img-thumbnail" style="display: none;">
                        <div class="d-grid gap-2 d-md-block">
                            <button type="button" class="btn btn-primary" id="btnCapture">Tomar foto</button>
                            <button type="button" class="btn btn-primary" id="btnDownloadImage" disabled>Descargar Imagen</button>
                            <button type="button" class="btn btn-primary" id="btnSendImageToServer" disabled>Guardar Imagen</button>
                            <button type="button" class="btn btn-primary" id="btnStartCamera">Iniciar Cámara</button>          
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="hora">Hora:</label>
                                <input class="form-control" id="hora" name="hora" readonly>
                            </div>
                        </div>
                        <br>
                        <!-- Mostrar Mapa en lugar de latitud/longitud como campos -->
                        <div id="map" style="height: 400px; width: 100%;"></div> <!-- Aquí estará el mapa de OpenStreetMap -->
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="latitud">Latitud:</label>
                                <input class="form-control" id="latitud" name="latitud" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="longitud">Longitud:</label>
                                <input class="form-control" id="longitud" name="longitud" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="action" value="add" class="btn btn-outline-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">
                        <i class="fa fa-check"></i> Guardar
                    </button>
                    <button type="button" class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" 
                            aria-label="Close" aria-hidden="true" data-dismiss="modal">
                        <i class="fa fa-close"></i> Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script type="text/javascript" src="capturarFoto.js"></script>
<!-- Agrega Leaflet.js -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

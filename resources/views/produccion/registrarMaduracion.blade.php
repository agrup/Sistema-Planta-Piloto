 

 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalFinalizar">Maduracion</button>
  <div class="modal"  id="myModalFinalizar">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Registrar Maduracion</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>×</span>
          </button>
        </div>
        <div class="modal-body">

       
            <div class="form-group">

              <label>Fecha de Inicio de Maduración</label>
              <input type="date" class="form-control" name="fechaMaduracion">
              <small class="form-text text-muted"></small>

            </div>

            <button type="submit" class="btn btn-primary" formaction="/produccion/postMaduracion/{{$lote['id']}}">Guardar</button>
        
        </div>
       
      </div>
    </div>
  </div>

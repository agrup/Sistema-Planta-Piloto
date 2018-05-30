 
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Finalizar</button>
  <div class="modal"  id="myModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Finalizar Lote</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>×</span>
          </button>
        </div>
        <div class="modal-body">
           <div class="p-0">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <form class="">
                    
                       <div class="form-group">
                        <label for="exampleInputEmail1">Fecha de Finalizacion</label>
                        <input type="date" class="form-control" id="inlineFormInput" name="fechaVencimiento">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Fecha de Vencimiento</label>
                        <input type="date" class="form-control" id="inlineFormInput" name="fechaFinalizacion">
                      </div>
                      @if( $lote['tipoLote']=="maduracion")
                            <div class="form-group">
                              <label for="exampleInputEmail1">Cantidad al Finalizar (Productos en Maduración)</label>
                              <input type="text" class="form-control" id="inlineFormInput" name="cantidad">
                            </div>
                            
                      @endif
                      <button type="submit" class="btn btn-primary" formaction="/produccion/postFinalizarLote/{{$lote['id']}}">Guardar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
    
        </div>
       
      </div>
    </div>
  </div>

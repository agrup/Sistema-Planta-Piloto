@include('elementosComunes.aperturaBoton')
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Agregar Formulación</button>
@include('elementosComunes.cierreBoton')
  <div class="modal"  id="myModal">
    <div class="modal-dialog" role="document">
     <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title">Agregar Formulación</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>×</span>
          </button>
        </div>
        <div class="modal-body">

            
            <div class="form-group">
              
  
             
              
              @include('elementosComunes.aperturaTabla')
                    <thead>
                      <tr>
                        <th>Ingrediente</th>
                        <th>Cantidad</th>
                        <th>Tipo Unidad</th>
                      </tr>
                    </thead>

                    <tbody id="tbodyFormulacion">

                    <label>Cantidad Final</label>
                    <input type="text" name="productoCantidad"  class="form-control inputFormulacion" required> <label id="labelTipoUnidad"></label>
                    <button type="button" class="btn btn-primary" id="agregarInsumo">Agregar Insumo</button>  
                      <tr id="trFormulacion" class="trFormulacion"><td><select  id="selectInsumo" class="form-control selectInsumo inputFormulacion" >
                                <option  selected="selected" value="default">--Seleccione un Insumo--</option>
                                @foreach ($insumos as $insumo)                           
                                  <option  id="producto" data-id="{{$insumo['id']}}" data-unit="{{$insumo['tipoUnidad']}}" value="{{$insumo['nombre']}}">{{$insumo['nombre']}}</option>
                                @endforeach
                              </select>
                          </td>            

                          <td><input type="text" id="cantidad"  name="cantidad" class="form-control inputFormulacion" required></td>
                          <td><span id="tdTipoUnidad"></span></td>
                          <td><p class="eliminarRow" >x</p></td>
                      </tr>                 

                    </tbody>
              @include('elementosComunes.cierreTabla')

              

              {{-- <label>Fecha de Inicio de Maduración</label>
              <input type="date" class="form-control" name="fechaMaduracion">
              <small class="form-text text-muted"></small> --}}

            </div>
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarFormulacion">Guardar Formulación</button>
            {{-- <button type="submit" class="btn btn-primary" formaction="/produccion/postMaduracion/{{$lote['id']}}">Guardar</button> --}}
        
        </div>
       
     </div>
    </div>
  </div>

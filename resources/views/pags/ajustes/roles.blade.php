@extends('pags.ajustes')
@section('seccion')
<script type="text/javascript" src="{{asset('js/roles.js')}}"></script>
<div class="panel panel-default">
	<div class="panel-heading" id="head">
		<h4>Roles</h4>
	</div>
	<div class="panel-body">
    <div class="table-responsive">
      <table class="table table-striped table-bordered" style="margin-bottom: 0px">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
        @if($totRows > 0)
          @foreach($roles as $rol)
          <tr>
            <td>{{$rol->nombre}}</td>
            <td>{{$rol->descripcion}}</td>
            <td style="text-align: center">
              <h4 style="margin: 0;">
                <a type="button" data-toggle="modal" data-target="#ModalActualizar"
                  data-id=         "{{$rol->id}}"
                  data-nombre=     "{{$rol->nombre}}"
                  data-descripcion="{{$rol->descripcion}}"><i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 10px"></i></a>
              </h4>
            </td>
          </tr>
          @endforeach
        @else
          <tr>
            <td colspan=3>No se encontraron resultados</td>
          </tr>
        @endif
        </tbody>
      </table>
    </div>
    <?php
    $queryString = [];
    if (isset($_GET['q'])) {
      $queryString['q'] = $_GET['q'];
    } if (isset($_GET['rows'])) {
      $queryString['rows'] = $_GET['rows'];
    } if (isset($_GET['page'])) {
      $queryString['page'] = $_GET['page'];
    }
    ?>
    {{$roles->appends($queryString)->links()}}
    @include('inc.filas')
  </div>
</div>

<!-- Modal - Actualizar -->
<div class="modal fade" id="ModalActualizar" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualizar Rol</h4>
      </div>
      {!!Form::open(['action' => ['RolesController@update', 1], 'method' => 'POST'])!!}
        <div class="modal-body">
          <div class="form-group">
            {{Form::hidden('id', '', ['id' => 'idInput'])}}
            {{Form::label('', 'Nombre')}}
            {{Form::text('nombre', '', ['id' => 'nombreInput', 'class' => 'form-control', 'required'])}}
            {{Form::label('', 'Descripción')}}
            {{Form::textarea('descripcion', '', ['id' => 'descripcionInput', 'class' => 'form-control', 'required'])}}
            {{Form::hidden('ruta', url()->current()."?".http_build_query($_GET))}}
            {{Form::hidden('_method', 'PUT')}}
          </div>
        </div>
        <div class="modal-footer">
          {{Form::submit('Actualizar', ['class' => 'btn btn-danger'])}}
        </div>
      {!!Form::close()!!}
    </div>
  </div>
</div>
@endsection
@extends('layouts.main')
@section('main.content')
<table class="data-test table-striped table-light table table-bordered">
  <h1 class="text-center">CRUD for JSON</h1>
  <thead>
    <tr class="">
      <th scope="col">#</th>
      <th scope="col">Имя</th>
      <th scope="col">Фамилия</th>
      <th scope="col">Старана</th>
      <th scope="col">Действие</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>
<div class="text-center bg-light">
  <a class="btn btn-success btn-md" href="javascript:void(0)" id="createStudent">Добавить студента</a>
</div>
<div class="modal fade" id="ajaxModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title border-right" id="modalHeading"></h4>
        <div class="modal-body">
          <form action="" id="studentForm" name="studentForm" class="form-horizontal">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              Имя: <br>
              <input type="text" class="form-control" id="first" name="first" placeholder="Введите имя" required>
              Фамилия: <br>
              <input type="text" class="form-control" id="last" name="last" placeholder="Введите фамилию" required>
              Имя: <br>
              <input type="text" class="form-control" id="country" name="country" placeholder="Введите страну" required>
            </div>
            <button type="submit" class="btn-success" id="saveBtn" value="Добавить">Сохранить</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
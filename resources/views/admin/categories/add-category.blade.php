@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row"><br>
    <div class="col-md-10 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Додај нову категорију</h3>
        </div>
        <div class="panel-body">
          <div class="" id="message"></div>
          <form class="form-horizontal" role="form" enctype="multipart/form-data">
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" id="isMain" checked> Категорија ће бити једна од главних
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group hidden" id="mainCategory">
              <label for="parent_id" class="col-sm-2 control-label">Главна категорија</label>
              <div class="col-sm-10">
                <select class="form-control" name="parent_id" id="parent_id">
                  <option value="1">Категорија 1</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Назив категорије</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name" placeholder="Назив категорије">
              </div>
            </div>

            <div class="form-group">
              <label for="description" class="col-sm-2 control-label">Опис категорије</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="description" id="description" rows="8" cols="80"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="image" class="col-sm-2 control-label">Фотографија која репрезентује категорију</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="image" id="image" value="">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-10">
                <img src="" alt="" style="background-color:red; width:30px; height:30px">
              </div>
            </div>

            <div class="form-group">
              <label for="url" class="col-sm-2 control-label">УРЛ скраћеница</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="url" id="url" placeholder="УРЛ скраћеница">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> Активна категорија
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Додај категорију</button>
                <button type="button" class="btn btn-default">Назад на категорије</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {

    $(document).on('change', '#isMain', function(e) {
      e.preventDefault();
      var checkVal = $(this).is(":checked");
      if(checkVal === false) {
        $('#mainCategory').removeClass('hidden');
      } else {
        $('#mainCategory').addClass('hidden');
      }
    });


  });
</script>

@endsection

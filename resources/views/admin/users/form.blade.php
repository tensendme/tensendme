{{csrf_field()}}
<div class="form-row">
    <div class="col-md-4">
        <div class="form-group">
            <select class="form-control" name="role_id" id="role_id">
                @foreach($roles as $role)
                    <option {{$user->role_id == $role->id ? ' selected ': ''}}
                            value="{{$role->id}}">
                        {{$role->name}}
                    </option>
                @endforeach
            </select>
            <label class="form-control-plaintext" for="role_id">Пожалуйста выберите роль</label>
        </div>
    </div>
</div>
<div class="form-group col-md-12 text-right">
    <button  class="mb-2 btn btn-primary mr-1" type="submit">Сохранить
        <i class="material-icons md-12">check_circle</i>
    </button>
</div>


@include('admin.layouts.parts.error')

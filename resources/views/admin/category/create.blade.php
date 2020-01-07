@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Категории</span>
            <h3 class="page-title">Категории</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Добавление категории</h6>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control is-valid" id="validationServer01" placeholder="First name" value="Catalin" required>
                                <div class="valid-feedback">The first name looks good!</div>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control is-valid" id="validationServer02" placeholder="Last name" value="Vasile" required>
                                <div class="valid-feedback">The last name looks good!</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control is-invalid" id="validationServer03" placeholder="Username" value="catalin.vasile" required>
                            <div class="invalid-feedback">This username is taken.</div>
                        </div>
                        <div class="form-group">
                            <select class="form-control is-invalid">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                            <div class="invalid-feedback">Please select your state.</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

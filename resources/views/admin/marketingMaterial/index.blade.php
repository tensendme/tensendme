@extends('admin.layouts.admin')

@section('styles')
    <style>
        .custom_image_size {
            height: 50px;
            width: auto;
        }
    </style>
@endsection

@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Маркетинговые материалы</span>
            <h3 class="page-title">Маркетинговые материалы</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Маркетинговые материалы</h6>
                </div>
                <div class="card-header border-bottom">
                    <a href="{{route('marketingMaterial.create')}}" type="button"
                       class="mb-2 btn btn-medium btn-primary mr-1">Добавить
                        <i class="material-icons md-12">add_circle</i>
                    </a>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Название</th>
                            <th scope="col" class="border-0">Ссылка</th>
                            <th scope="col" class="border-0">Фото</th>
                            <th scope="col" class="border-0">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($marketingMaterials as $marketingMaterial)
                            <tr>
                                <td>{{$marketingMaterial->id}}</td>
                                <td>{{$marketingMaterial->name}}</td>
                                <td>{{$marketingMaterial->url}}</td>
                                <td>
                                    @if($marketingMaterial->image_path)
                                        <img class="custom_image_size" src="{{asset($marketingMaterial->image_path)}}">
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-outline-primary mb-2 "
                                       href="{{route('marketingMaterial.edit', ['id' => $marketingMaterial->id])}}">
                                        <i class="material-icons md-12">edit</i>
                                    </a>

                                    <form class="d-inline" action="{{route('marketingMaterial.delete', ['id' => $marketingMaterial->id])}}"
                                          enctype="multipart/form-data"
                                          method="post">
                                        <input type="hidden" name="_method" value="delete" />
                                        {{csrf_field()}}
                                        <button type="submit" class="btn btn-outline-danger mb-2">
                                            <i class="material-icons md-12">delete</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

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
                    <h6 class="m-0">Категории</h6>
                </div>
                <div class="card-header border-bottom">
                    <a href="{{route('category.create')}}" type="button" class="mb-2 btn btn-primary mr-1">Добавить</a>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Название</th>
                            <th scope="col" class="border-0">Относится к</th>
                            <th scope="col" class="border-0">Родительская категория</th>
                            <th scope="col" class="border-0">Дествия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->categoryType->name}}</td>
                                <td>{{($category->parentCategory) ? $category->parentCategory->name : ''}}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('category.edit', ['id' => $category->id])}}">
                                        Изменить
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="card-footer">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

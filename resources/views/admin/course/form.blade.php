{{csrf_field()}}
<div class="form-row">
    <div class="form-group col-md-6">
        <input type="text" class="form-control"
               name="title"
               value="{{$course ? $course->title : old('title')}}"
               placeholder="Наименование"
               id="title"
               required>
        <label class="form-control-plaintext" for="title">Пожалуйста введите название курса</label>
    </div>
    <div class="form-group col-md-6">
        <select id="author_id" class="form-control js-example-basic-single" name="author_id">
            @if($course)
                <option value="{{$course->author_id}}" selected>
                    {{$course->author ? $course->author->name . '(' . $course->author->phone . ')' : ''}}</option>
            @endif
        </select>
        <label class="form-control-plaintext" for="author_id">Пожалуйста выберите автора</label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <textarea type="text" class="form-control"
                  name="description"
                  placeholder="Краткое описание курса"
                  id="description"
                  rows="8"
                  required>{{$course ? $course->description : old('description')}}</textarea>
        <label class="form-control-plaintext" for="description">Пожалуйста введите описание курса</label>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <select class="form-control" name="category_id" id="category_id">
                @foreach($categories as $category)
                    <option {{$course ? ($course->category_id == $category->id ? ' selected ': '') : ''}}
                            value="{{$category->id}}">
                        {{$category->name}}
                    </option>
                @endforeach
            </select>
            <label class="form-control-plaintext" for="category_id">Пожалуйста выберите категорию</label>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-5">
        <input type="file"
               id="file"
               class="form-control"
               name="image"
               accept="image/*"
               placeholder="Фото"
               required>
        <label class="form-control-plaintext" for="file">Пожалуйста выберите фото</label>
    </div>
    <div class="form-group col-md-1">
        <input type="checkbox"
               data-on="Вкл"
               data-off="Откл"
               onchange="toggleImage(this)"
               checked
               data-toggle="toggle"
               data-size="md">
    </div>
    <div class="form-group col-md-5">
            <input class="form-control" type="file" name="video" id="video" accept="video/*">
            <label class="form-control-plaintext" for="video">Пожалуйста выберите видео материал для трейлера</label>
        </div>
        <div class="form-group col-md-1">
            <input type="checkbox"
                   data-on="Вкл"
                   data-off="Откл"
                   onchange="toggleVideo(this)"
                   checked
                   data-toggle="toggle"
                   data-size="md">
        </div>
    </div>
<div class="form-row">
    <div class="form-group col-md-6">
        @for($i = 0; $i < 4; $i++)
            <input type="text" class="form-control"
                   name="information[{{$i}}]"
                   value="{{$course ? (array_key_exists($i, $course->information_list) ? $course->information_list[$i] : '') : old('information['.$i .']')}}"
                   placeholder="Что возьмете с курса?"
                   id="get{{$i}}">
            <label class="form-control-plaintext" for="get{{$i}}">Пожалуйста введите название курса</label>
        @endfor
    </div>
</div>
<div class="form-group col-md-12 text-right">
    <button class="mb-2 btn btn-primary mr-1" type="submit">Сохранить
        <i class="material-icons md-12">check_circle</i>
    </button>
</div>

@section('scripts')
    <script>
        var authorSelect = document.getElementById('author_id');
        var nextLink = '/authors';
        var term = '';

        $(document).ready(function () {
            $('.js-example-basic-single').select2();
            // $.onScroll()
            $('#author_id').select2({
                ajax: {
                    url: nextLink,
                    processResults: function (response, params) {
                        // var query = {
                        //     search: params.term,
                        //     page: params.page
                        // };
                        params.page = params.page || 1;
                        console.log(params);
                        nextLink = response.next_page_url;
                        var pagination = false;
                        const data = response.data;
                        if(nextLink != null) pagination = true;
                        var obj = {"results" : [], "pagination" : {"more" : pagination}};
                        data.forEach(author => {
                             obj1 = {"text": author.name + '(' + (author.phone || '') + ')',
                                 "id": author.id};
                             obj.results.push(obj1);
                        });
                        console.log(JSON.parse(JSON.stringify(obj)));
                        return obj;
                    }
                }
            });
        });

        function toggleImage(el) {
            document.getElementById('file').disabled = !el.checked;
        }
        function toggleVideo(el) {
            document.getElementById('video').disabled = !el.checked;
        }
    </script>
@endsection
@include('admin.layouts.parts.error')

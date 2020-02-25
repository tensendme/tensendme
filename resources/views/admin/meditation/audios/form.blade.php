{{csrf_field()}}
<div class="form-row">
    <div class="form-group col-md-6">
    <select class="form-control" name="language_id" id="language_id">
        @foreach($languages as $language)
            <option {{$audio ? ($audio->audio_language_id == $language->id ? ' selected ': '') : ''}}
                    value="{{$language->id}}">
                {{$language->name}}
            </option>
        @endforeach
    </select>
        <label class="form-control-plaintext" for="language_id">Пожалуйста выберите язык</label>
    </div>
    <div class="form-group col-md-6">
        <select id="author_id" class="form-control js-example-basic-single" name="author_id" required>
            @if($audio)
                <option value="{{$audio->author_id}}" selected>
                    {{$audio->author->name . '(' . $audio->author->phone . ')'}}</option>
            @endif
        </select>
        <label class="form-control-plaintext" for="author_id">Пожалуйста выберите автора</label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-9">
        <input class="form-control" type="file" name="audio" id="audio"
               accept=".mp3">
        @if($audio)
            <audio src="{{asset($audio->audio_path)}}" controls>
                Не поддерживается
            </audio>
        @endif
        <label class="form-control-plaintext" for="audio">Пожалуйста выберите аудио</label>
    </div>
    <div class="form-group col-md-3">
        <input type="checkbox" class="form-control" name="access"
               data-on="Вкл"
               data-off="Откл"
               data-toggle="toggle"
               data-size="md" id="access"
               value="1" {{$audio ? ($audio->free ? 'checked' : '') : ''}}>
        <label class="form-control-plaintext" for="access">Пожалуйста выберите тип доступа (Бесплатно или за подписку)</label>
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
    </script>
@endsection
@include('admin.layouts.parts.error')

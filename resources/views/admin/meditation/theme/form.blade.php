{{csrf_field()}}
<div class="form-row">
    <div class="form-group col-md-12">
        <input type="text" class="form-control"
               name="title"
               value="{{$theme ? $theme->title : old('title')}}"
               placeholder="Наименование"
               id="title"
               required>
        <label class="form-control-plaintext" for="title">Пожалуйста введите название медитации</label>
    </div>
</div>
<?php $i=0;?>
@foreach($audioTypes as $audioType)
    <p>{{$audioType->name}}</p>
    <div class="col-md-6">
        <div class="form-group">
            @if(!empty($theme->audios[$i]))
            @if($theme->audios[$i]->audio_language_id == $audioType->id)
                <audio src="{{asset($theme->audios[$i]->audio_path)}}" controls>
                    Не поддерживается
                </audio>
            @endif
            @else Не добавлено
            @endif
            <input class="form-control" type="file" name="audio[{{$audioType->id}}]" id="audio{{$audioType->id}}" accept=".mp3">
            <label class="form-control-plaintext" for="audio{{$audioType->id}}">Пожалуйста выберите аудио</label>
        </div>
    </div>
    <?php $i++?>
@endforeach
<div class="form-group col-md-12 text-right">
    <button class="mb-2 btn btn-primary mr-1" type="submit">Сохранить
        <i class="material-icons md-12">check_circle</i>
    </button>
</div>


@include('admin.layouts.parts.error')

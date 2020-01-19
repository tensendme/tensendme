{{csrf_field()}}
<div class="form-row">
    <div class="form-group col-md-12">
        <input type="text" class="form-control"
               name="question"
               value="{{$faq ? $faq->question : old('question')}}"
               placeholder="Вопрос"
               id="question"
               required>
        <label class="form-control-plaintext" for="title">Пожалуйста введите вопрос FAQ</label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <textarea type="text" class="form-control"
                  name="answer"
                  placeholder="Ответ"
                  id="answer"
                  required>{{$faq ? $faq->answer : old('answer')}}</textarea>
        <label class="form-control-plaintext" for="description">Пожалуйста введите  ответ FAQ</label>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <input class="form-control" type="file" name="image" id="image" accept="image/*">
        <label class="form-control-plaintext" for="image">Пожалуйста выберите фото</label>
    </div>
</div>
<div class="form-group col-md-12 text-right">
    <button class="mb-2 btn btn-primary mr-1" type="submit">Сохранить
        <i class="material-icons md-12">check_circle</i>
    </button>
</div>


@include('admin.layouts.parts.error')

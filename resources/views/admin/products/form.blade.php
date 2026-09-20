<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ !isset($item) ? 'Добавить товар' : 'Редактировать товар' }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ !isset($item) ? route('admin.products.store') : route('admin.products.update', ['product' => $item->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($item))  @method('PUT') @endif

                    <div class="form-group">
                        <label for="">Название</label>
                        <input type="text" name="title" class="form-control" value="{{ isset($item) ? $item->title : old("title") }}">
                    </div>

                    <div class="form-group">
                        <label for="">Категория</label>
                        <select class="form-control" name="category_id">
                            <option value="">-</option>
                            @foreach($categories as $k => $v)
                                <option value="{{ $k }}" {{ isset($item) && $item->category_id == $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Краткое описание</label>
                        <textarea name="shortDesc" class="form-control editor" cols="30" rows="10">{{ isset($item) ? $item->shortDesc : old("shortDesc") }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Описание</label>
                        <textarea name="description" class="form-control editor" cols="30" rows="10">{{ isset($item) ? $item->description : old("description") }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="ico">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="thumbnail"
                                       class="custom-file-input" accept="image/png, image/jpeg">
                                <label class="custom-file-label" for="thumbnails">Choose file</label>
                            </div>
                        </div>
                        @if(isset($item))
                            <div><img src="{{ $item->getImage('thumbnail') }}" alt="" class="img-thumbnail mt-2" style="width: 150px"></div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-success">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</div>


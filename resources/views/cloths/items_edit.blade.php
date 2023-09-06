<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Colorset</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Colorset</h1>
        <h2>Edit Item</h2>
        <form action="/cloths/items/{{ $item->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="image">
                <img src="{{ $item->item_img }}" alt="画像が読み込めません。"/>
                <input type="file" name="item[item_img]">
            </div>
            <div class="category">
                <h2>Category</h2>
                <select name="item[category_id]">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="color">
                <h2>Color</h2>
                <select name="item[color_id]">
                    @foreach($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="save"/>
        </form>
    </body>
</html>

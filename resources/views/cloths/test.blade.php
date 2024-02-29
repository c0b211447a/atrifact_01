<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Colorset</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/header.css" rel="stylesheet">
        <link href="/css/add_items_layout.css" rel="stylesheet">
    </head>
    <header class="header_inline_block">
        <h1>Colorset</h1>
        <nav>
            <ul>
                <li><h1><a href="/cloths/colors">COLOR</a></h1></li>
                <li><h1><a href="/cloths/items">ITEMS</a></h1></li>
                <li><h1><a href="/cloths/patterns">PATTERNS</a></h1></li>
            </ul>
        </nav>
    </header>
    <body>
        <form action="/cloths/items/{{ $item->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="add_item_image">
                <h2>Image</h2>
                <img id="select_img" src="{{ $item->item_img }}" alt="画像が読み込めません。"/>
                <input type="file" name="item[item_img]">
            </div>
            <div class="add_item_category_and_save">
                <h2>Category</h2>
                <select name="item[category_id]">
                    <option value="{{ $selected_category->id }}" selected>{{ $selected_category->name }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="add_item_color">
                <h2>Color</h2>
                <select name="item[color_id]">
                    <option value="{{ $selected_color->id }}" selected>{{ $selected_color->name }}</option>
                    @foreach($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                </select>
            </div>
            <input id="save_button" class="add_item_category_and_save" type="submit" value="save"/>
        </form>
    </body>
</html>

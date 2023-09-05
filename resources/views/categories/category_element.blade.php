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
        <a href="/cloths/items/add_items">ADD+</a>
        <div class='cloths'>
            <div class='categories'>
                <h2>CATEGORY</h2>
                    <h3><a href="/cloths/categories/1">〇Accessories</a></h3>
                    <h3><a href="/cloths/categories/2">〇Tops</a></h3>
                    <h3><a href="/cloths/categories/3">〇Botoms</a></h3>
                    <h3><a href="/cloths/categories/4">〇Shoes</a></h3>
                    <h3><a href="/cloths/categories/5">〇Bags/ohters</a></h3>
                <h3><a href="/cloths/items">〇ALL</a></h3>
            </div>
            <div class='item_img'>
                <h2>{{ $select_category->name }}</h2>
                @foreach($items as $item)
                    <img src="{{ $item->item_img }}" alt="画像が読み込めません。"/>
                @endforeach
            </div>
        </div>
    </body>
</html>

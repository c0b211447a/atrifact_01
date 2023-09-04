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
        <a href="items/add_items">ADD+</a>
        <div class='cloths'>
            <div class='categories'>
                <h2>CATEGORY</h2>
                @foreach($categories as $category)
                    <h3>{{ $category->name }}</h3>
                @endforeach
            </div>
            <div class='item_img'>
                <h2>ALL</h2>
                @foreach($items as $item)
                    <img src="{{ $item->item_img }}" alt="画像が読み込めません。"/>
                    {{ $item->item_img }}
                @endforeach
            </div>
        </div>
    </body>
</html>

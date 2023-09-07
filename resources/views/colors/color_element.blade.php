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
                @foreach($categories as $category)
                    <h3><a href="/cloths/categories/{{ $category->id }}">{{ $category->name }}</a></h3>
                @endforeach
                <h3><a href="/cloths/items">〇ALL</a></h3>
            </div>
            <div class='colors'>
                <h2>COLOR</h2>
                @foreach($colors as $color)
                    <h3><a href="/cloths/colors/{{ $color->id }}">
                        <ul>
                            <li>{{ $color->name }}</li>
                        </ul>
                    </a></h3>
                @endforeach
            </div>
            <div class='item_img'>
                <h2>{{ $select_color->name }}</h2>
                @foreach($items as $item)
                    <img src="{{ $item->item_img }}" alt="画像が読み込めません。"/>
                    <div class="edit_item"><a href="/cloths/items/{{ $item->id }}/edit">edit</a></div>
                    <form action="/cloths/items/{{ $item->id }}" id="form_{{ $item->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deleteItem({{ $item->id }})">delete</button>
                    </form>
                @endforeach
            </div>
        </div>
        <script>
            function deleteItem(id) {
                'use strict'
                
                if (confirm('Really delete this item??')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>

let itemPath;
let itemId;
let itemColorId;
let itemCategoryId;
let coordinates_canvas = document.getElementById('coordinates_canvas');
let x;
let y;
let item_x;
let item_y;
let item_count=0;
let tops_count=0;
let botoms_count=0;
let shoes_count=0;
let others_count=0;
//othersアイテムに区別をつけるための工夫
let save_others_count=1;

//1の時createモード、2の時clearモード
let mode = 1;
//サーバーサイドに送るためのデータを入れるための連想配列
let data_pack = {};

//コーディネート作成エリアにアイテムをドラッグしたときのエフェクトを設定する
let add_area = document.getElementById('add_patterns');
add_area.addEventListener('dragover', function(e){
    if (mode==1){
        e.preventDefault();
        e.stopPropagation();
        e.dataTransfer.dropEffect = 'copy';
    }
});


let count_area;
let area_has_item;
let area_has_item_num;
//ページ読み込み時コーディネートに使われているアイテムの数をカウント
window.onload = countItems();

function countItems(){
    count_area = document.getElementById("coordinates_canvas");
    area_has_item = count_area.children;
    area_has_item_num = area_has_item.length;
    
    for (let i=0; i<area_has_item_num; i++){
        if (area_has_item[i].dataset.category==1){
            others_count += 1;
        } else if (area_has_item[i].dataset.category==2){
            tops_count += 1;
        } else if (area_has_item[i].dataset.category==3){
            botoms_count += 1;
        } else if (area_has_item[i].dataset.category==4){
            shoes_count += 1;
        } else if (area_has_item[i].dataset.category==5){
            others_count += 1;
        }
        
        item_count += 1;
    }
    // console.log(has_tops);
}
//ドラッグアンドドロップしようとしているアイテムの
//画像URL,id,color_id,category_idを取得
function getItemInfo(t){
    itemPath = t.src;
    itemId = t.id;
    itemColorId = t.dataset.color;
    itemCategoryId = t.dataset.category;
    return itemPath, itemId, itemColorId, itemCategoryId;
}

//ドロップされた位置にアイテムの画像を表示させる処理
coordinates_canvas.addEventListener('drop', function(e){
    if (itemPath==undefined){
        return;
    }
    
    if (item_count==5){
        alert("Permission error");
        return;
    }
    
    if (mode==2){
        return;
    }

    e.stopPropagation();
    e.preventDefault();
    
    //coordinates_canvas内に登録できるアイテム数が上限に達しているかどうかを判定
    if (itemCategoryId==1 && others_count!=2){
        item_count += 1;
        others_count += 1;
    } else if (itemCategoryId==2 && tops_count!=1){
        item_count += 1;
        tops_count += 1;
    } else if (itemCategoryId==3 && botoms_count!=1){
        item_count += 1;
        botoms_count += 1;
    } else if (itemCategoryId==4 && shoes_count!=1){
        item_count += 1;
        shoes_count += 1;
    } else if (itemCategoryId==5 && others_count!=2){
        item_count += 1;
        others_count += 1;
    } else {
        if ((itemCategoryId==1 || itemCategoryId==5) && others_count==2){
            alert("bags or accesories can add only 2 items");
            return;
        } else if (itemCategoryId==2 && tops_count==1){
            alert("tops can add only 1 item");
            return;
        } else if (itemCategoryId==3 && botoms_count==1){
            alert("botoms can add only 1 item");
            return;
        } else if (itemCategoryId==4 && shoes_count==1){
            alert("shoes can add only 1 item");
            return;
        }
    }
    
    x = e.clientX - 576-75;
    y = e.clientY - 100-100;
    draw();
    add_color();
    
    function draw(){
        /*global Image*/
        const image = new Image();
        image.src = itemPath;
        image.id = itemId;
        image.dataset.color = itemColorId;
        image.dataset.category = itemCategoryId;
        image.classList.add("select_item_class");
        image.classList.add("draggable");
        image.classList.add("resize_drag");
        image.setAttribute('onclick', `delete_item(${itemCategoryId}, this)`);
        image.setAttribute('x', x);
        image.setAttribute('y', y);
        image.style.position = 'absolute';
        image.style.transform = `translate(${x}px, ${y}px)`;
        image.style.width = "150px";
        image.style.height = "200px";
        image.style.touchAction = 'none';
        image.style.userSelect = 'none';
        image.style.boxSizing = 'border-box';
        coordinates_canvas.appendChild(image);
        
        
        //既に領域内に表示済みの画像が複製されないようにするための工夫
        itemPath = null;
        
    }
    
    function add_color(){
        let select_category_name;
        if (itemCategoryId==2){
            select_category_name = "tops";
        } else if (itemCategoryId==3){ 
            select_category_name = "botoms";
        } else if (itemCategoryId==4){
            select_category_name = "shoes";
        } else {
            return;
        }
        
        let select_category_color_name;
        let select_category_color;
        if (itemColorId==1){
            select_category_color_name = "Blue";
            select_category_color = "#2C72B0";
        } else if (itemColorId==2){
            select_category_color_name = "Blue-green";
            select_category_color = "#0A96BA";
        } else if (itemColorId==3){
            select_category_color_name = "Green";
            select_category_color = "#018D5C";
        } else if (itemColorId==4){
            select_category_color_name = "Yellow-green";
            select_category_color = "#8BBA2C";
        } else if (itemColorId==5){
            select_category_color_name = "Yellow";
            select_category_color = "#F4E41B";
        } else if (itemColorId==6){
            select_category_color_name = "Yellow-orange";
            select_category_color = "#FBC51B";
        } else if (itemColorId==7){
            select_category_color_name = "Orange";
            select_category_color = "#F18C20";
        } else if (itemColorId==8){
            select_category_color_name = "Red-orange";
            select_category_color = "#EA6021";
        } else if (itemColorId==9){
            select_category_color_name = "Red";
            select_category_color = "#E12323";
        } else if (itemColorId==10){
            select_category_color_name = "Red-violet";
            select_category_color = "#C3087B";
        } else if (itemColorId==11){
            select_category_color_name = "Violet";
            select_category_color = "#6D398B";
        } else if (itemColorId==12){
            select_category_color_name = "Blue-violet";
            select_category_color = "#454D98";
        } else if (itemColorId==13){
            select_category_color_name = "Black";
            select_category_color = "black";
        } else if (itemColorId==14){
            select_category_color_name = "Gray";
            select_category_color = "gray";
        } else if (itemColorId==15){
            select_category_color_name = "White";
            select_category_color = "white";
        }
        
        let parent_element = document.getElementById(select_category_name);
        let new_parent_element = document.createElement("div");
        let div_frame = document.createElement("div");
        let div_color_background = document.createElement("div");
        let div_color_name = document.createElement("div");
        let div_color_delete_button = document.createElement("div");
        let p_color_name = document.createElement("p");
        let p_color_delete_button = document.createElement("p");
        
        new_parent_element.classList.add("select_category_class");
        
        div_frame.classList.add("select_color_frame");
        div_frame.style.border = "1px solid";
        
        div_color_background.classList.add("select_color_background");
        div_color_background.style.backgroundColor = select_category_color;
        
        div_color_name.classList.add("select_color_name");
        p_color_name.innerHTML = select_category_color_name;
        p_color_name.style.fontWeight = "bold";
        div_color_name.appendChild(p_color_name);
        
        div_color_delete_button.classList.add("select_color_delete_button");
        p_color_delete_button.innerHTML = "×";
        p_color_delete_button.style.fontWeight = "bold";
        p_color_delete_button.style.fontSize = "30px";
        p_color_delete_button.style.margin = "3.5px 0px 3.5px 0px";
        p_color_delete_button.style.textAlign = "center";
        p_color_delete_button.setAttribute('onclick', `delete_color_item(${itemId}, this)`);
        div_color_delete_button.appendChild(p_color_delete_button);
        
        new_parent_element.appendChild(div_frame);
        new_parent_element.appendChild(div_color_background);
        new_parent_element.appendChild(div_color_name);
        new_parent_element.appendChild(div_color_delete_button);
        parent_element.appendChild(new_parent_element);
    }
});

/*global interact*/
interact('.resize_drag').resizable({
    edges: { left:true, right:true, bottom:true, top:true },
    onmove: function(event){
        //createモードの時のみリサイズ可
        if (mode==1){
            let target = event.target;
            item_x = (parseFloat(target.getAttribute('x')) || 0);
            item_y = (parseFloat(target.getAttribute('y')) || 0);
        
            target.style.width = event.rect.width + 'px';
            target.style.height = event.rect.height + 'px';
            
            item_x += event.deltaRect.left;
            item_y += event.deltaRect.top;
            
            target.setAttribute('x', item_x);
            target.setAttribute('y', item_y);
            
            target.style.transform = 'translate(' + item_x + 'px,' + item_y + 'px)'
        }
    }
})

interact('.draggable').draggable({
    inertia: false,
    modifiers: [
        interact.modifiers.restrictRect({
            restriction: 'parent',
            endOnly: true
        })    
    ],
    onmove: function(event){
        //createモードの時のみドラッグ可
        if (mode==1){
            //ドラッグ操作している対象の要素を取得し
            //その要素に対してcssプロパティ（transform)を探索
            var item_transform = window.getComputedStyle(event.target).getPropertyValue('transform');
            //transformプロパティの中のデータを正規表現により抽出
            var item_xy = item_transform.match(/^matrix\((.+)\)$/)[1].split(', ');
            //抽出したデータの中のx座標、y座標をそれぞれ数値化し
            //現在のアイテムの初期値として設定する
            var item_position = {x: Number(item_xy[4]), y: Number(item_xy[5])};
            item_position.x += event.dx;
            item_position.y += event.dy;
            
            event.target.setAttribute('x', item_position.x);
            event.target.setAttribute('y', item_position.y);
            
            event.target.style.transform = `translate(${item_position.x}px, ${item_position.y}px)`;
        }
    }
});

function delete_color_item(select_item_id, t){
   let delete_target_candidates = document.getElementsByClassName("select_item_class");
   let parent_node = t.parentNode.parentNode;
   let count_decrement_item_id = parent_node.parentNode.id;
   
   for (let i=0; i<item_count; i++){
       if (select_item_id==delete_target_candidates[i].id){
           delete_target_candidates[i].remove();
           parent_node.remove();
           break;
       }
   }
   
   if (count_decrement_item_id=="tops"){
       tops_count -= 1;
       item_count -= 1;
   } else if(count_decrement_item_id=="botoms"){
       botoms_count -= 1;
       item_count -= 1;
   } else if(count_decrement_item_id=="shoes"){
       shoes_count -= 1;
       item_count -= 1;
   }
   
}

function delete_all_item(){
    item_count = 0;
    others_count = 0;
    tops_count = 0;
    botoms_count = 0;
    shoes_count = 0;
    let old_div_coordinates_canvas = document.getElementById("coordinates_canvas");
    old_div_coordinates_canvas.innerHTML = "";
    let div_tops_item_color = document.getElementById("tops");
    let div_botoms_item_color = document.getElementById("botoms");
    let div_shoes_item_color = document.getElementById("shoes");
    if (div_tops_item_color != undefined || 
        div_botoms_item_color != undefined || 
        div_shoes_item_color != undefined){
            div_tops_item_color.innerHTML = "";
            div_botoms_item_color.innerHTML = "";
            div_shoes_item_color.innerHTML = "";
    }
}

   
function delete_item(categoryId, t){
    //clearモードの時のみ有効
    if (mode==2){
        let remove_target_node;
        if (categoryId==1 || categoryId==5){
            others_count -= 1;
        } else if (categoryId==2){
            remove_target_node = document.getElementById("tops");
            remove_target_node.innerHTML = "";
            tops_count -= 1;
        } else if (categoryId==3){
            remove_target_node = document.getElementById("botoms");
            remove_target_node.innerHTML = "";
            botoms_count -= 1;
        } else if (categoryId==4){
            remove_target_node = document.getElementById("shoes");
            remove_target_node.innerHTML = "";
            shoes_count -= 1;
        }
        t.remove();
        item_count -= 1;
   } 
}

function save_coordinates(){
    let target_item_parent_node = document.getElementById("coordinates_canvas");
    let target_item_children = target_item_parent_node.children;
    let target_item_child;
    let target_item_img;
    let target_item_img_src;
    let target_item_id;
    let target_item_category_id;
    let target_item_color_id;
    let target_item_x;
    let target_item_y;
    let target_item_width;
    let target_item_height;
    let sumbnail_data;
    let save_item_info;
    let save_item_id_list;
    let coordination_id;
    let exist_category_list = [];
    
    for (let i=0; i<target_item_children.length; i++){
        target_item_child = target_item_children[i];
        target_item_id = target_item_child.id;
        target_item_x = target_item_child.getAttribute('x');
        target_item_y = target_item_child.getAttribute('y');
        target_item_width = target_item_child.style.width;
        target_item_height = target_item_child.style.height;
        save_item_info = {
            "item_id":target_item_id,
            "size_width":target_item_width,
            "size_height":target_item_height,
            "locate_x":target_item_x,
            "locate_y":target_item_y,
        }
        
        //tops,botoms,shoesのときは色カテゴリidを設定
        // if (target_item_child.dataset.category == 2 ||
        //     target_item_child.dataset.category == 3 ||
        //     target_item_child.dataset.category == 4 )
        // {
        //     target_item_color_id = target_item_child.dataset.color;
        //     save_item_info["color_id"] = target_item_color_id;
        // }
        
        target_item_color_id = target_item_child.dataset.color;
        save_item_info["color_id"] = target_item_color_id;
        
        
        if (target_item_child.dataset.category == 1 || target_item_child.dataset.category == 5){
            //others_itemの判別がつかなくならないようにする
            if (save_others_count == 1){
                data_pack["others1"] = save_item_info;
                save_others_count += 1;
            } else if (save_others_count == 2){
                data_pack["others2"] = save_item_info;
            }
        } else if (target_item_child.dataset.category == 2){
            data_pack["tops"] = save_item_info;
        } else if (target_item_child.dataset.category == 3){
            data_pack["botoms"] = save_item_info;
        } else if (target_item_child.dataset.category == 4){
            data_pack["shoes"] = save_item_info;
        }
        
        exist_category_list.push(Number(target_item_child.dataset.category));
        
    }
    
    //編集前と編集後でアイテムが減った場合はそのアイテムの情報をnullで初期化
    for (let i=1; i<6; i++){
        if (exist_category_list.includes(i)){
            continue;
        }
        
        save_item_info = {
            "item_id":null,
            "size_width":null,
            "size_height":null,
            "locate_x":null,
            "locate_y":null,
        }
        
        if (i==1){
            data_pack["others1"] = save_item_info;
            data_pack["others1"]["color_id"] = null;
        } else if (i==2){
            data_pack["tops"] = save_item_info;
            data_pack["tops"]["color_id"] = null;
        } else if (i==3){
            data_pack["botoms"] = save_item_info;
            data_pack["botoms"]["color_id"] = null;
        } else if (i==4){
            data_pack["shoes"] = save_item_info;
            data_pack["shoes"]["color_id"] = null;
        } else if (i==5){
            data_pack["others2"] = save_item_info;
            data_pack["others2"]["color_id"] = null;
        } 
    }
    
    sumbnail_data = getDisplayImage();
    
    function getDisplayImage(){
            //html2canvas実行
            /*global html2canvas */
            html2canvas(document.getElementById("coordinates_canvas"),{
                width: 768,
                height: 831,
                proxy: true,
                useCORS: true,
            }).then(function(canvas){
                downloadImageAndSendData(canvas.toDataURL());
            });
            
    
        function downloadImageAndSendData (data) {
            var fname ="coordinates.png";
            var encdata= atob(data.replace(/^.*,/, ''));
            var outdata = new Uint8Array(encdata.length);
            for (var i = 0; i < encdata.length; i++) {
                outdata[i] = encdata.charCodeAt(i);
            }
            var blob = new Blob([outdata], ["image/png"]);
            
            sumbnail_data = data;
            data_pack["coordinations_img"] = sumbnail_data;
            
            let url = new URL(window.location.href);
            let params = url.searchParams;
            
            coordination_id = params.get('id');
            data_pack["id"] = coordination_id;
            
            /* global fetch */
            fetch("../update_patterns/",{
                method: "PUT",
                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json"
                }, 
                body: JSON.stringify(data_pack)
            })
            .then(response => response.text())
            .then(res => {
                window.location.href = "../";
            })
            .catch(error => {
                console.log(error);
                console.log(JSON.stringify(data_pack));
                
            })
            
            
            
            
            /*
            let test_tag = document.createElement("img");
            test_tag.src = sumbnail_data;
            let target_tag = document.getElementById("coordinates_canvas");
            target_tag.appendChild(test_tag);
            console.log(sumbnail_data);
            */
            /*
            canvas2htmlのデバッグ用
            document.getElementById("getImage").href=data;            //base64そのまま設定
            document.getElementById("getImage").download=fname;        //ダウンロードファイル名設定
            document.getElementById("getImage").click();             //自動クリック
            */            
        }
    
    }
}

function mode_change(){
    let now_add_pattern_area_button_content = document.getElementsByClassName("add_pattern_area_button_content")[0];
    if (mode==1){
        now_add_pattern_area_button_content.innerHTML = "mode:clear";
        mode=2;
    } else if(mode==2){
        now_add_pattern_area_button_content.innerHTML = "mode:create";
        mode=1;
    }
}
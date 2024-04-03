let item_img_add_area = document.getElementById("item_img_add_area");
let item_img = document.getElementById("item_img");
let item_img_flg = false;
let item_color_flg = false;
let edit_mode = false;

//主にedit_item向け
//ページロード時にすでにアイテムの画像が登録されていれば
// item_img_flgをtrueにする
function check_item_img(){
    if(document.getElementById("select_img")==undefined){
        return;
    }
    item_img_flg = true;
    
    // 編集モードにおいてはすでにアイテムの色は設定されている
    item_color_flg = true;
    edit_mode = true;
}
window.onload = check_item_img();


// 「Click to add imgae」をクリックすると
// ファイル選択ダイアログを開くことができる
item_img_add_area.addEventListener('click', function(){
    item_img.click();
    console.log(item_img);
    return;
})


// サーバーに送るためのform領域を取得する
let formData = new FormData(document.getElementById("send_form"));


// 選択された画像を指定領域に表示する
item_img.addEventListener('change', function(){
    let img_files = item_img.files;
    let img_file = img_files[0];
    let img_filename = img_file.name;
    
    console.log(img_file);
    
    // new Compressor(img_file, {
    //     quality: 0.6,
    //     success(result){
    //         console.log(result);
    //         let img_url = URL.createObjectURL(result)
    //         item_img_add_area.innerHTML = `<img id=show_item_img src=${img_url}>`;
    //         item_img_flg = true;
    //     },
    //     maxWidth: 500,
    //     maxHeight: 600,
    //     mimeType: 'image/png',
    //     error(err){
    //         console.log(err);
    //     }
    // });
    
    new Compressor(img_file, {
        quality: 0.4,
        success(result){
            console.log(result);
            let img_url = URL.createObjectURL(result);
            document.getElementById("new_item_img").setAttribute("value", result);
            console.log(document.getElementById("new_item_img"));
            
            // let form = document.getElementById("send_form");
            // let formData = new FormData(form);
            
            // let obj = document.getElementById("item_img_container");
            // let sto = obj.innerHTML;
            // obj.innerHTML = sto;
            
            formData.delete("item[item_img]");
            // formData.append('_method', 'PATCH');
            formData.set("item[new_item_img]", result, result.name);
            console.log(formData);
            for (var [key, value] of formData.entries()) {
                console.log(key, value);
            }
            item_img_add_area.innerHTML = `<img id=show_item_img src=${img_url}>`;
            item_img_flg = true;
        },
        maxWidth: 500,
        maxHeight: 600,
        mimeType: 'image/png',
        error(err){
            console.log(err);
        }
    });
    return;
})

// userが選択したカテゴリをformに追加する
let category_select = document.getElementById("category_select");
category_select.addEventListener("change", function(){
    formData.set("item[category_id]", this.value);
    console.log("now change category")
    return;
})

// userが選択した色にchoicecolorareaを変化させる
function changeColor(color_num){
        let select_category_color_name;
        let select_category_color;
        let color_options = document.getElementById("color_select").options;
        
        if (color_num==1){
            select_category_color_name = "Blue";
            select_category_color = "#2C72B0";
        } else if (color_num==2){
            select_category_color_name = "Blue-green";
            select_category_color = "#0A96BA";
        } else if (color_num==3){
            select_category_color_name = "Green";
            select_category_color = "#018D5C";
        } else if (color_num==4){
            select_category_color_name = "Yellow-green";
            select_category_color = "#8BBA2C";
        } else if (color_num==5){
            select_category_color_name = "Yellow";
            select_category_color = "#F4E41B";
        } else if (color_num==6){
            select_category_color_name = "Yellow-orange";
            select_category_color = "#FBC51B";
        } else if (color_num==7){
            select_category_color_name = "Orange";
            select_category_color = "#F18C20";
        } else if (color_num==8){
            select_category_color_name = "Red-orange";
            select_category_color = "#EA6021";
        } else if (color_num==9){
            select_category_color_name = "Red";
            select_category_color = "#E12323";
        } else if (color_num==10){
            select_category_color_name = "Red-violet";
            select_category_color = "#C3087B";
        } else if (color_num==11){
            select_category_color_name = "Violet";
            select_category_color = "#6D398B";
        } else if (color_num==12){
            select_category_color_name = "Blue-violet";
            select_category_color = "#454D98";
        } else if (color_num==13){
            select_category_color_name = "Black";
            select_category_color = "black";
        } else if (color_num==14){
            select_category_color_name = "Gray";
            select_category_color = "gray";
        } else if (color_num==15){
            select_category_color_name = "White";
            select_category_color = "white";
        }
        
        document.getElementById("choicecolorname").innerHTML = select_category_color_name;
        document.getElementById("choicecolorarea").style.backgroundColor = select_category_color;
        color_options[color_num-1].selected = true;
        item_color_flg = true;
        formData.set("item[color_id]", document.getElementById("color_select").value);
        
        return;
}

// save_buttonをクリックしたら隠してあるsubmitボタンをクリックさせる
let save_button = document.getElementById("save_button");

save_button.addEventListener("click", function(){
    if (item_img_flg==false){
        alert("Please choice any item's img...")
        return;
    }
    
    if (item_color_flg==false){
        alert("Please choice any item's color...")
        return;
    }
    let store = document.getElementById("store");
    let loading = document.getElementById("loading");
    loading.classList.remove("loaded");
    // store.click();
    // let formData = new FormData(document.getElementById("send_form"));
    for (var [key, value] of formData.entries()) {
                console.log(key, value);
    }
    
    
    if (edit_mode){
        let url = new URL(window.location.href);
        let params = url.searchParams;
        let item_id = params.get('id');
        fetch (`/cloths/items/${item_id}`,{
            method: "POST",
            mode: "cors",
            headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }, 
            body: formData
        }).then((data) => {
            window.location.href = "/cloths/items";
        }
            );
    }
    else {
        fetch ("../items",{
            method: "POST",
            mode: "cors",
            headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }, 
            body: formData
        }).then((data) => {
            window.location.href = "/cloths/items";
        }
            );
    }
    return;
})
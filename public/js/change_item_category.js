function changeItems(name){
    let new_item_name = document.getElementById("categories_name");
    let new_image = document.getElementsByClassName("item_img");
    new_image = new_image[0];
    new_image.innerHTML = ' ';
    
    if (name==blue){
        new_item_name.innerHTML = "BLUE";
    } else if (name==blue_green){
        new_item_name.innerHTML = "BLUE-GREEN";
    } else if (name==green){
        new_item_name.innerHTML = "GREEN";
    } else if (name==yellow_green){
        new_item_name.innerHTML = "YELLOW-GREEN";
    } else if (name==yellow){
        new_item_name.innerHTML = "YELLOW";
    } else if (name==yellow_orange){
        new_item_name.innerHTML = "YELLOW-ORANGE";
    } else if (name==orange){
        new_item_name.innerHTML = "ORANGE";
    } else if (name==red_orange){
        new_item_name.innerHTML = "RED-ORANGE";
    } else if (name==red){
        new_item_name.innerHTML = "RED";
    } else if (name==red_violet){
        new_item_name.innerHTML = "RED-VIOLET";
    } else if (name==violet){
        new_item_name.innerHTML = "VIOLET";
    } else if (name==blue_violet){
        new_item_name.innerHTML = "BLUE-VIOLET";
    } else if (name==white){
        new_item_name.innerHTML = "WHITE";
    } else if (name==gray){
        new_item_name.innerHTML = "GRAY";
    } else if (name==black){
        new_item_name.innerHTML = "BLACK";
    } else if (name=="Accessories"){
        new_item_name.innerHTML = "Accessories";
        name = accessories;
    } else if (name=="Tops"){
        new_item_name.innerHTML = "Tops";
        name = tops;
    } else if (name=="Botoms"){
        new_item_name.innerHTML = "Botoms";
        name = botoms;
    } else if (name=="Shoes"){
        new_item_name.innerHTML = "Shoes";
        name = shoes;
    } else if (name=="Bags/others"){
        new_item_name.innerHTML = "Bags/others";
        name = bags_others;
    } else if (name==all_items){
        new_item_name.innerHTML = "ALL";
    } 
    for (let name_ele in name){
         let new_src = name[name_ele].item_img;
         let id = name[name_ele].id;
         let color_id = name[name_ele].color_id;
         let category_id = name[name_ele].category_id;
         new_image.insertAdjacentHTML('beforeend', `<img id=${id} data-color=${color_id} data-category=${category_id} class="item_img" src=${new_src} alt="Not Found Image" onmousedown="getItemInfo(this)">`);
    }
}
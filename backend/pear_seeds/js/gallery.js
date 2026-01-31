let lightbox = document.querySelector(".gallery-grid-container");



lightbox.childNodes[0].onclick = function(event) {
    setTimeout(function() {

        var articleDiv = document.querySelector(".w-lightbox-frame");
        var elem_h2 = document.createElement("h2");
        var elem_p = document.createElement("p");
        elem_h2.className += "gallery_h2";
        elem_p.className += "gallery_p2";


        var elemText_h2 = document.createTextNode("Веселинка");

        elem_h2.appendChild(elemText_h2);
        articleDiv.appendChild(elem_h2);

        var elemText_p = document.createTextNode("Самый ранний сорт, плоды 40-60 г, вкус сладкий с сильным ароматом.");

        elem_p.appendChild(elemText_p);
        articleDiv.appendChild(elem_p);

    }, 250);
};

lightbox.childNodes[1].onclick = function(event) {
    setTimeout(function() {

        var articleDiv = document.querySelector(".w-lightbox-frame");
        var elem_h2 = document.createElement("h2");
        var elem_p = document.createElement("p");
        elem_h2.className += "gallery_h2";
        elem_p.className += "gallery_p2";

        var elemText_h2 = document.createTextNode("Красуля");

        elem_h2.appendChild(elemText_h2);
        articleDiv.appendChild(elem_h2);

        var elemText_p = document.createTextNode("Самый ранний сорт, плоды до 110 г., мякоть сочная, отличного вкуса.");

        elem_p.appendChild(elemText_p);
        articleDiv.appendChild(elem_p);

    }, 250);
};

lightbox.childNodes[2].onclick = function(event) {
    setTimeout(function() {

        var articleDiv = document.querySelector(".w-lightbox-frame");
        var elem_h2 = document.createElement("h2");
        var elem_p = document.createElement("p");
        elem_h2.className += "gallery_h2";
        elem_p.className += "gallery_p2";

        var elemText_h2 = document.createTextNode("Лада");

        elem_h2.appendChild(elemText_h2);
        articleDiv.appendChild(elem_h2);

        var elemText_p = document.createTextNode("Ранне-летний сорт, плоды до100 г., мякоть кисло-сладкого вкуса со слабым ароматом. Сорт с отличными плодами, но не зимостойкий. Я выращиваю в стланцевой форме.");

        elem_p.appendChild(elemText_p);
        articleDiv.appendChild(elem_p);

    }, 250);
};


lightbox.childNodes[3].onclick = function(event) {
    setTimeout(function() {

        var articleDiv = document.querySelector(".w-lightbox-frame");
        var elem_h2 = document.createElement("h2");
        var elem_p = document.createElement("p");
        elem_h2.className += "gallery_h2";
        elem_p.className += "gallery_p2";

        var elemText_h2 = document.createTextNode("Малиновка");

        elem_h2.appendChild(elemText_h2);
        articleDiv.appendChild(elem_h2);

        var elemText_p = document.createTextNode("Ранне-осенний сорт с красивыми и сладкими плодами массой до 60 г.");

        elem_p.appendChild(elemText_p);
        articleDiv.appendChild(elem_p);

    }, 250);
};

lightbox.childNodes[4].onclick = function(event) {
    setTimeout(function() {

        var articleDiv = document.querySelector(".w-lightbox-frame");
        var elem_h2 = document.createElement("h2");
        var elem_p = document.createElement("p");
        elem_h2.className += "gallery_h2";
        elem_p.className += "gallery_p2";

        var elemText_h2 = document.createTextNode("Осенняя Котова");

        elem_h2.appendChild(elemText_h2);
        articleDiv.appendChild(elem_h2);

        var elemText_p = document.createTextNode("Плоды до 120 г., жёлтые, с нежной маслянистой мякотью.");

        elem_p.appendChild(elemText_p);
        articleDiv.appendChild(elem_p);

    }, 250);
};

lightbox.childNodes[5].onclick = function(event) {
    setTimeout(function() {

        var articleDiv = document.querySelector(".w-lightbox-frame");
        var elem_h2 = document.createElement("h2");
        var elem_p = document.createElement("p");
        elem_h2.className += "gallery_h2";
        elem_p.className += "gallery_p2";

        var elemText_h2 = document.createTextNode("Сварог");

        elem_h2.appendChild(elemText_h2);
        articleDiv.appendChild(elem_h2);

        var elemText_p = document.createTextNode("Алтайский ранне-осенний сорт, плоды до 200 г., хорошего кисло-сладкого вкуса. Сорт зимостойкий, высокорожайный.");

        elem_p.appendChild(elemText_p);
        articleDiv.appendChild(elem_p);

    }, 250);
};

lightbox.childNodes[6].onclick = function(event) {
    setTimeout(function() {

        var articleDiv = document.querySelector(".w-lightbox-frame");
        var elem_h2 = document.createElement("h2");
        var elem_p = document.createElement("p");
        elem_h2.className += "gallery_h2";
        elem_p.className += "gallery_p2";

        var elemText_h2 = document.createTextNode("Уралочка");

        elem_h2.appendChild(elemText_h2);
        articleDiv.appendChild(elem_h2);

        var elemText_p = document.createTextNode("Уральский поздне-осенний сорт, плоды до 45 г., мякоть сочная, кисло-сладкая, хорошего вкуса. Дерево не высокое, очень зимостойкое. Хранятся плоды до ноября.");

        elem_p.appendChild(elemText_p);
        articleDiv.appendChild(elem_p);

    }, 250);
};
//sort items in table
function zoradenie(stlpec,typ,typ_hodnoty) {
    let tabulka, riadky, switching, i, x, y, shouldSwitch, r1, r2;
    tabulka = document.getElementById("tabulka");
    switching = true;
    while (switching) {
        switching = false;
        riadky = tabulka.rows;
        for (i = 1; i < (riadky.length - 1); i++) {
            shouldSwitch = false;
            x = riadky[i].getElementsByTagName("td")[stlpec];
            y = riadky[i + 1].getElementsByTagName("td")[stlpec];
            if (typ_hodnoty===0){
                if ((x.textContent.toLowerCase() > y.textContent.toLowerCase())&&typ===false) {
                    shouldSwitch = true;
                    break;
                }
                else if ((x.textContent.toLowerCase() < y.textContent.toLowerCase())&&typ===true) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (typ_hodnoty===1){
                let p,p2;
                if (y.textContent != null) {
                    let [d, m, y] = (x.textContent).split('.');
                    p = new Date(y, m - 1, d);
                }
                else
                    p = new Date();
                if (y.textContent != null){
                    [d, m, y] = (y.textContent).split('.');
                    p2=new Date(y,m-1,d);
                }
                else
                    p2=new Date();
                if ((p - p2 > 0)&&typ===false) {
                    shouldSwitch = true;
                    break;
                }
                if ((p - p2 < 0)&&typ===true) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            riadky[i].parentNode.insertBefore(riadky[i + 1], riadky[i]);
            switching = true;
        }
    }
}


function go_back(){
    document.getElementById("modal_background").style.display="none";
    document.getElementsByClassName("modal_div")[0].style.display="none";
}
function go_back2(){
    document.getElementById("modal_background3").style.display="none";
    document.getElementsByClassName("modal_div3")[0].style.display="none";
}
$('input#searchBar').quicksearch('table#tabulka tbody tr',{
		selector: '.searchedValue',
		delay: 200
	}
);
//skrytie a odkrytie contentu pre všeobecné formy slovies
$(function () {
    $('.verbFormTableHideLi').on('click', function (e) {
        let id=(this.id).split("_", 1)[0];
        $('.verbFormTableHideLi').css("background-color","transparent")
        $('#'+this.id).css("background-color","deepskyblue")

        $('.verbFormTableDiv').css("display" , "none");
        $('#'+id).css("display" , "block");
    });
});
//pridanie ďalšieho kroku ku receptu
$('#addStep').on('click', function (e) {
    e.preventDefault();
    var stepNumber=($('.stepContainer').length)+1;
    var step = ($("<div class='stepContainer'>" +
        "<label class='green' for='recipe_steps'>Znenie "+stepNumber+".kroku receptu</label>" +
        "<input class='form-control' type='text' name='recipe_steps[]' maxlength='128' required>" +
        "</div>"));
    step.insertBefore('#addStep').slideDown("fast");
});
//pridanie ingrediencie ku receptu
$('#addIngredient').on('click', function (e) {
    e.preventDefault();
    var types=['polievkové lyžice','čajové lyžice','kusy','balenia','kilogramy','gramy','mililitre','decilitre','litre','trochu','veľa'];
    var typesOption='';
    for (let i = 0; i < types.length; i++) {
        typesOption= typesOption + "<option value='"+types[i]+"'>"+types[i]+"</option>";
    }
    var ingredientNumber=($('.ingredientContainer').length)+1;
    var ingredient = ($("<div class='ingredientContainer'> <label class='red' >Ingrediencia č."+ingredientNumber+" </label><br>" +
    "<label class='green'>Názov<input class='form-control ingredientInput1' type='text' name='recipe_ingredient_names[]' maxLength='32' required></label>" +
    "<label class='green'>Počet<input class='form-control ingredientInput2' type='number' name='recipe_ingredient_counts[]' min='1' max='128' required></label>" +
    "<label class='green'>Typ<select class='form-control ingredientInput1'  name='recipe_ingredient_types[]'  required>" + typesOption))

    ingredient.append("</select></label></div>");
    console.log(ingredient);
    ingredient.insertBefore('#addIngredient').slideDown("fast");

});


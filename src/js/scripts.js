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
$(function () {
	$('.editRecipeButton').on('click', function(){
		//var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
		//var csrfHash = $('.txt_csrfname').val(); // CSRF hash		
		$.ajax({
			type: 'post',
			url: '/public/recipeEditForm',
			headers: {'X-Requested-With': 'XMLHttpRequest'},
			data: {id: (((this.id).split("_"))[0])},
			success: function (data) {
				//$('.txt_csrfname').val(result.token);
				$("#modal_background").css("display","block");
				$(".modal_div").first().css("display","flex");
				$("#modal_text").html(data);
			},
			error: function (){
				alert ("Nastala chyba skúste to znova")
			}
		});
	})
});
//edit
$(function () {
    $('.editForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: '/public/recipeEdit',
            data: $('.editForm').serialize(),
            success: function (data) {
                try {
                    let result = JSON.parse(data)
                    if(result.scs===false){
						$("#modal_background3").css("display","block");
						$(".modal_div3").first().css("display","flex");
						$("#modal_text3").html(result.msg);
                    }
                    else{
						$("#modal_background").css("display","none");
						$(".modal_div").first().css("display","none");
						$("#modal_background2").css("display","block");
						$(".modal_div2").first().css("display","flex");
						$("#result").html(result.msg);
                    }
                }
                catch{
					$("#modal_background3").css("display","block");
					$(".modal_div3").first().css("display","flex");
					$("#modal_text3").html(data);
                }
            },
            error: function (xhr, status, error){
				alert(xhr.responseText);
            }
        });
    })
});

//delete
$(function () {
    $('.deleteX').on('click', function (e) {
        e.preventDefault();
        let type;
        if (this.classList.contains('word'))
            type=0;
        else
            type=1
        $.ajax({
            type: 'post',
            url: '/public/recipeDelete',
            data: {id:this.id},
            success: function (data) {
                try {
                    let result = JSON.parse(data)
                    if(result.scs===true){
                        document.getElementById("modal_background2").style.display="block";
                        document.getElementsByClassName("modal_div2")[0].style.display="flex";
                        document.getElementById("result").innerHTML=result.msg;
                    }
                    else{
                        document.getElementById("modal_background").style.display="block";
                        document.getElementsByClassName("modal_div")[0].style.display="flex";
                        document.getElementById("modal_text").innerHTML=result.msg;
                    }
                }
                catch{
                    alert (data)
                }
            },
            error: function (){
                alert ("Nastala chyba skúste to znova")
            }
        });
    })
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
    ingredient.insertBefore('#addIngredient').slideDown("fast");

});


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

//check answers of exam
$(function (){
    $('.exam').submit (function (e){
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'postHandlers/answersChecker.php',
            data:$('.exam').serialize(),
            success: function (data){
                try {
                    let result = JSON.parse(data)
                    let i,j;
                    for (i=1;i<=10;i++){
                        let answerString="question".concat(i);
                        let rightAnswer=result[answerString];
                        let label=answerString.concat("_label");
                        let x = document.getElementsByClassName(label);
                        for (j=0;j<4;j++){
                            let answer = x[j].innerText;
                            if (answer.replace(/\s/g, '')===rightAnswer.replace(/\s/g, ''))
                                x[j].style.color="green";
                            else
                                x[j].style.color="red";
                        }
                    }
                    document.getElementById("countAnswer").style.display="block";
                    document.getElementById("countValue").innerText=result.rightAnswers;
                }
                catch{
                    alert (data)
                    document.getElementById("countAnswer").style.display="none";
                }
            },
            error: function (){
                alert ("Nastala chyba skúste to znova")
            }
        });
    })
});

//generate noun option
$(function () {
    $(".wordType").change(function(){
        let index = $(".wordType option:selected").index();
        let nounType=document.getElementById("nounType");
        let nounTypeLabel=document.getElementById("nounTypeLabel");
        if (index===0){
            nounType.style.display="block";
            nounTypeLabel.style.display="block";
        }
        else{
            nounType.style.display="none";
            nounTypeLabel.style.display="none";
        }
    })
});

//add new words manual
$(function () {
    $('.addForm').submit( function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'postHandlers/add.php',
            data: $('.addForm').serialize(),
            success: function (data) {
                try {
                    let result = JSON.parse(data)
                    if(result.scs===true){
                        document.getElementById("modal_background2").style.display="block";
                        document.getElementsByClassName("modal_div2")[0].style.display="flex";
                        document.getElementById("modal_text2").innerHTML=result.msg;
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

//add new words from csv
$(function () {
    $('.addFormCSV').submit( function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'postHandlers/importCSV.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
                try {
                    let result = JSON.parse(data)
                    if(result.scs===true){
                        document.getElementById("modal_background2").style.display="block";
                        document.getElementsByClassName("modal_div2")[0].style.display="flex";
                        document.getElementById("modal_text2").innerHTML=result.msg;
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
            url: 'postHandlers/delete.php',
            data: {id:this.id,type:type},
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

//edit
$(function () {
    $('.editForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'postHandlers/edit.php',
            data: $('.editForm').serialize(),
            success: function (data) {
                try {
                    let result = JSON.parse(data)
                    if(result.scs===false){
                        document.getElementById("modal_background3").style.display="block";
                        document.getElementsByClassName("modal_div3")[0].style.display="flex";
                        document.getElementById("modal_text3").innerHTML=result.msg;
                    }
                    else{
                        document.getElementById("modal_background").style.display="none";
                        document.getElementsByClassName("modal_div")[0].style.display="none";
                        document.getElementById("modal_background2").style.display="block";
                        document.getElementsByClassName("modal_div2")[0].style.display="flex";
                        document.getElementById("result").innerHTML=result.msg;
                    }
                }
                catch{
                    document.getElementById("modal_background3").style.display="block";
                    document.getElementsByClassName("modal_div3")[0].style.display="flex";
                    document.getElementById("modal_text3").innerHTML=data;
                }
            },
            error: function (){
                alert ("Nastala chyba skúste to znova")
            }
        });
    })
});

//generate edit word form
function generateEditForm(id,type){
    $.ajax({
        type: 'post',
        url: 'postHandlers/editForm.php',
        data: {id : id,type:type},
        success: function (data) {
            document.getElementById("modal_background").style.display="block";
            document.getElementsByClassName("modal_div")[0].style.display="flex";
            document.getElementById("modal_text").innerHTML=data
            $(".wordType").change(function(){
                let index = $(".wordType option:selected").index();
                let nounType=document.getElementById("nounType");
                let nounTypeLabel=document.getElementById("nounTypeLabel");
                if (index===0){
                    nounType.style.display="block";
                    nounTypeLabel.style.display="block";
                }
                else{
                    nounType.style.display="none";
                    nounTypeLabel.style.display="none";
                }
            })
        },
        error: function (){
            alert ("Nastala chyba skúste to znova")
        }
    });
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

function addClick(id) {
    var xhr = getXMLHttpRequest(); // Pour récupérer un objet XMLHTTPRequest
    // -- bordel habituel (readyState == 4, etc, etc.)
    xhr.open('GET', 'click.php?id=' + id, true);
    xhr.send(null);
}

function getXMLHttpRequest() {
    var xhr = null;

    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else {
            xhr = new XMLHttpRequest();
        }
    } else {
        alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
        return null;
    }

    return xhr;
}

function displayRowClass(tableId, rowClass, Nb) {
    var table = document.getElementById(tableId);
    var display = 'none';
    var ClassName = rowClass + Nb;
    for (var i in table.rows) {
        row = table.rows[i];
        if (row.className === ClassName) {
            if (row.style.display === 'none') {
                /**Test si c'est IE ou pas*/
                display = document.all !== undefined ? 'block' : 'table-row';
            } else {
                display = 'none';
            }
            row.style.display = display;
        }
        /*
         if(rowClass == 'child'){
         if(row.idName == ClassName){
         row.style.display = 'none';
         }
         }*/
    }
}

function swapImg(swap) {
    obj = document.getElementById(swap);
    obj.src = !(obj.src == img_minus) ? img_minus : img_plus;
}
/*
function moduleSelect(sel, url) {
	var mod_id = sel.options[sel.selectedIndex].value;
	window.location.href = url+mod_id;
}

function selectModule(sel, url) {
	var mod_id = sel.options[sel.selectedIndex].value;				
	myMod = document.location.href = url+mod_id;		
	myMod.focus();
}

function showImgSelected2(imgId, selectId, imgDir, extra, xoopsUrl)
{
	if (xoopsUrl == null) {
		xoopsUrl = "./";
	}
	imgDom = xoopsGetElementById(imgId);
	selectDom = xoopsGetElementById(selectId);
	if (selectDom.options[selectDom.selectedIndex].value != "") {
		imgDom.src = xoopsUrl + imgDir + "/" + selectDom.options[selectDom.selectedIndex].value + extra;
	} else {
		imgDom.src = xoopsUrl + "/images/blank.gif";
	}
}
*/

$(document).ready( function() {    
	$('.toggleTables').click( function(e) {
        e.preventDefault();
		$(this).nextAll('tr').each( function() {
			if ($(this).is('.toggleTables')) {
				return false;
			}
			$(this).toggle();
		});
	});
});
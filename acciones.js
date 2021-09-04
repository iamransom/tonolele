		function irPagina(url) {
		  window.location.href = url;
		}

		function mostrarDiv(nombreDiv) {

		  var div = document.getElementById(nombreDiv);
		  if (div.style.display != 'block') {
		    div.style.display = 'block';
		  } else {
		    div.style.display = 'none';
		  }
		}

		function traducir(stringorig, tonodestino, menor) {
		  var vuelta;
		  var modo = 1;
		  if (menor == 1) {
		    modo = 2;
		  }
		  if (tonodestino == 0) {
		    vuelta = stringorig;
		  } else {
		    stringorig = stringorig.replace(/iii/gi, gradoatono(3, tonodestino, modo));
		    stringorig = stringorig.replace(/viib/gi, gradoatono(7, tonodestino, 2));
		    stringorig = stringorig.replace(/vii/gi, gradoatono(7, tonodestino, modo));
		    stringorig = stringorig.replace(/vi/gi, gradoatono(6, tonodestino, modo));
		    stringorig = stringorig.replace(/iv/gi, gradoatono(4, tonodestino, modo));
		    stringorig = stringorig.replace(/ii/gi, gradoatono(2, tonodestino, modo));
		    stringorig = stringorig.replace(/i/gi, gradoatono(1, tonodestino, modo));
		    stringorig = stringorig.replace(/v/gi, gradoatono(5, tonodestino, modo));
		    stringorig = stringorig.replace(/mM/g, '');
		    stringorig = stringorig.replace(/mm/g, 'm');
		    stringorig = stringorig.replace(/mm/g, 'MM');
		    stringorig = stringorig.replace(/m#M/g, '#');
		    stringorig = stringorig.replace(/mbM/g, 'b');
		    stringorig = stringorig.replace(/#b/g, '');
		    stringorig = stringorig.replace(/b#/gi, '');
		    stringorig = stringorig.replace(/x/gi, 'MI');
		    stringorig = stringorig.replace(/w/gi, 'SI');
		    stringorig = stringorig.replace(/siol/gi, 'SOL');
		    vuelta = stringorig;
		  }

		  return vuelta;
		  //imprimirtodo();
		}

		function gradoatono(grado, tono, modo) {
		  var devuelvo;
		  if (modo == 1) {
		    switch (grado) {
		      case 1:
		        devuelvo = nota(tono);
		        break;
		      case 2:
		        devuelvo = nota(tono + 2);
		        devuelvo += 'm';
		        break;
		      case 3:
		        devuelvo = nota(tono + 4);
		        devuelvo += 'm';
		        break;
		      case 4:
		        devuelvo = nota(tono + 5);
		        break;
		      case 5:
		        devuelvo = nota(tono + 7);
		        break;
		      case 6:
		        devuelvo = nota(tono + 9);
		        devuelvo += 'm';
		        break;
		      case 7:
		        devuelvo = nota(tono + 11);
		        devuelvo += 'm';
		        break;
		    }
		  }
		  if (modo == 2) {
		    switch (grado) {
		      case 1:
		        devuelvo = nota(tono);
		        devuelvo += 'm';
		        break;
		      case 2:
		        devuelvo = nota(tono + 2);
		        devuelvo += 'm';
		        break;
		      case 3:
		        devuelvo = nota(tono + 3);
		        break;
		      case 4:
		        devuelvo = nota(tono + 5);
		        devuelvo += 'm';
		        break;
		      case 5:
		        devuelvo = nota(tono + 7);
		        break;
		      case 6:
		        devuelvo = nota(tono + 8);
		        break;
		      case 7:
		        devuelvo = nota(tono + 10);
		        break;
		    }
		  }
		  return devuelvo
		}

		function nota(num) {
		  var tono;
		  if (num > 12) {
		    num = num - 12;
		  }
		  switch (num) {
		    case 1:
		      return ('DO');
		      break;
		    case 2:
		      return ('REb');
		      break;
		    case 3:
		      return ('RE');
		      break;
		    case 4:
		      return ('Xb');
		      break;
		    case 5:
		      return ('X');
		      break;
		    case 6:
		      return ('FA');
		      break;
		    case 7:
		      return ('FA#');
		      break;
		    case 8:
		      return ('SOL');
		      break;
		    case 9:
		      return ('LAb');
		      break;
		    case 10:
		      return ('LA');
		      break;
		    case 11:
		      return ('Wb');
		      break;
		    case 12:
		      return ('W');
		      break;
		  }
		}


		var taptimes = new Array();

		function taptempo() {
		  var place = document.getElementById('tempo');
		  var d = new Date();
		  taptimes.push(d.getTime());
		  if (true) {
		    tempo = 60000 * 4 / (taptimes[taptimes.length - 1] - taptimes[taptimes.length - 5]);
		    place.value = Math.round(tempo);
		  }


		}

		function agregaralista() {
		  var checkboxes = document.getElementsByName('sel[]');
		  var vals = "";
		  for (var i = 0, n = checkboxes.length; i < n; i++) {
		    if (checkboxes[i].checked) {
		      vals += "," + checkboxes[i].value;
		    }
		  }
		  if (vals) vals = vals.substring(1);
		  console.log(vals);
		}

		function bajarTXTs() {
		  var checkboxes = document.getElementsByName('sel[]');
		  //		    var checkboxes = document.getElementsByClassName('is-checked');
		  var vals = "";
		  for (var i = 0, n = checkboxes.length; i < n; i++) {
		    if (checkboxes[i].checked) {
		      console.log(checkboxes[i].id.substring(3));
		      bajartxt(checkboxes[i].id.substring(3));
		      checkboxes[i].checked = false;

		      //vals += ","+checkboxes[i].value;
		    }
		  }
		  if (vals) vals = vals.substring(1);
		  console.log(vals);
		}

		function imprimirmultiple() {
		  var checkboxes = document.getElementsByName('sel[]');
		  console.log(checkboxes);
		  var vals = "";
		  for (var i = 0, n = checkboxes.length; i < n; i++) {
		    if (checkboxes[i].checked) {
		      imprimirtema(checkboxes[i].id.substring(3));
		      checkboxes[i].checked = false;

		      //vals += ","+checkboxes[i].value;
		    }
		  }
		  if (vals) vals = vals.substring(1);
		  console.log(vals);
		}

		function imprimirtema(tm) {
		  var win = window.open('http://www.lagram.com.ar/tonolele/cancionimp.php?idcancion=' + tm, '_blank');
		  if (win) {
		    //Browser has allowed it to be opened
		    win.focus();
		  } else {
		    //Browser has blocked it
		    alert('Please allow popups for this website');
		  }
		}


		function checkAll(ele) {
		  var checkboxes = document.getElementsByName('sel[]');

		  if (ele.checked) {
		    for (var i = 0; i < checkboxes.length; i++) {
		      if (checkboxes[i].type == 'checkbox') {
		        if (checkboxes[i].checked == false) {
		          checkboxes[i].click();
		        }
		        // element.MaterialCheckbox.check();
		      }
		    }

		    //
		    //     checkboxes[i].checked = true;
		    //     // checkboxes[i].parentElement.materialcheckbox.check();
		    // }
		  } else {
		    for (var i = 0; i < checkboxes.length; i++) {
		      if (checkboxes[i].type == 'checkbox') {
		        if (checkboxes[i].checked == true) {
		          checkboxes[i].click();
		        }
		      }
		    }
		  }
		}

		function solotexto(letrap) {
		  letraPrnt = ""; //letrap.split("*");
		  tonosPrnt = letrap.split("*");
		  //letraPrnt.unshift("*");
		  //tonosPrnt.unshift("*");

		  var stringCompleto = "";
		  var esmenor = 0;
		  var stringtono = 0;

		  for (var i = 0; i < tonosPrnt.length; i++) {
		    stringCompleto += tonosPrnt[i];
		    if (stringtono.length + 1 > tonosPrnt[i].length) {
		      for (var e = 0; e < stringtono.length + 2 - tonosPrnt[i].length; e++) {
		        // stringCompleto +=  "-";
		      }
		    }
		    i++;

		  }
		  stringCompleto = stringCompleto.replace(/\\r\\n/g, "\r\n");
		  stringCompleto = stringCompleto.replace(/\\n/g, "\r\n");
		  stringCompleto = stringCompleto.replace(/\\r/g, "\r\n");
		  stringCompleto = stringCompleto.replace(/@([^@]*)@/g, " "); //----$1");//TITULO DE MOMENTO
		  //    stringCompleto = stringCompleto.replace(/\r\n/g,"sssss");
		  //    stringCompleto = stringCompleto.replace(/\r/g,"sssssss");
		  //    stringCompleto = stringCompleto.replace(/\n/g,"sssssss");
		  //    stringCompleto = stringCompleto.replace(/<br>/g, "SSSSS");

		  for (var i = 0; i < letraPrnt.length; i++) {

		    letraPrnt[i] = letraPrnt[i].replace(/\r\n/g, "<\/br>");
		    letraPrnt[i] = letraPrnt[i].replace(/\r/g, "<\/br>");
		    letraPrnt[i] = letraPrnt[i].replace(/\n/g, "<\/br>");
		    try {
		      tonosPrnt[i] = tonosPrnt[i].replace(/\r\n/g, "");
		      tonosPrnt[i] = tonosPrnt[i].replace(/\r/g, "");
		      tonosPrnt[i] = tonosPrnt[i].replace(/\n/g, "");
		    } catch (err) {
		      //Handle errors here
		    }

		    if (letraPrnt[i].indexOf('@') != -1) {
		      letraPrnt[i] = letraPrnt[i].replace(/<br>/g, "");
		      letraPrnt[i] = letraPrnt[i].replace(/@([^@]*)@/g, " $1  ");
		      //SETEA ESTILO DE SEPARADOR DE MOMENTO
		      letraPrnt[i] = letraPrnt[i].replace(/@([^@]*)@/g, " $1  ");
		    }
		    //letraPrnt[i] = letraPrnt[i].replace(/&/g,"<br><br>");

		    if (tonosPrnt[i]) {
		      tonosPrnt[i] = tonosPrnt[i] + ' ';
		    }

		    if (tonosPrnt[i]) {
		      while (tonosPrnt[i].length > letraPrnt[i].length) {}
		    }


		    stringCompleto += letraPrnt[i];
		  }

		  return stringCompleto;

		}


		function download(filename, text) {
		  var element = document.createElement('a');
		  element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
		  element.setAttribute('download', filename);

		  element.style.display = 'none';
		  document.body.appendChild(element);

		  element.click();

		  document.body.removeChild(element);
		}

		function bajartxt(id) {

		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		      var tema = JSON.parse(this.responseText);
		      console.log(this.responseText);
		      download(tema["titulo"] + ".txt", solotexto(tema["letra"]));

		    }
		  };
		  xhttp.open("GET", 'APIcancioncruda.php?idcancion=' + id, true);
		  xhttp.send();
		}

		//download("hello.txt","This is the content of my file :)");
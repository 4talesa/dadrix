  /////////////////////
 // PRINT FUNCTIONS //
/////////////////////

var gAutoPrint = true; // Flag for whether or not to automatically call the print function
 
function printSpecial()
{
if (document.getElementById != null)
{
var html = '<HTML>\n<HEAD>\n';
 
if (document.getElementsByTagName != null)
{
//var headTags = document.getElementsByTagName("head");
//if (headTags.length > 0)
//html += headTags[0].innerHTML;
}
 
html += '\n</HE>\n<BODY style="background-image:none; margin:10px;">\n';
var printReadyElem = document.getElementById("printReady");
if (printReadyElem != null)
{
html += printReadyElem.innerHTML;
}
else
{
alert("Could not find the printReady section in the HTML");
return;
}
 
html += '\n</BO>\n</HT>';
var printWin = window.open("","printSpecial");
printWin.document.open();
printWin.document.write(html);
printWin.document.close();
if (gAutoPrint)
printWin.print();
}
else
{
alert("Sorry, the print ready feature is only available in modern browsers.");
}
}


  //////////////////////
 // SWITCH FUNCTIONS //
//////////////////////

function hightlighted(my_id, my_id2) {
	
	document.getElementById('switch1').style.display = 'none';
	document.getElementById('switch2').style.display = 'none';
	document.getElementById('switch3').style.display = 'none';		
	document.getElementById(my_id).style.display = 'block';		

	document.getElementById('link1').className = 'hightlighted';
	document.getElementById('link2').className = 'hightlighted';
	document.getElementById('link3').className = 'hightlighted';		
	document.getElementById(my_id2).className = 'hightlighted_down';		


}


// switch styles

function setActiveStyleSheet(title) {
  var i, a, main;
  for (i=0; (a = document.getElementsByTagName("link")[i]); i++) {
    if (a.getAttribute("rel") &&
        a.getAttribute("rel").indexOf("style") != -1 &&
        a.getAttribute("title")) {
      a.disabled = true;
      if(a.getAttribute("title") == title) a.disabled = false;
    }
  }
}

function getActiveStyleSheet() {
  var i, a;
  for (i=0; (a = document.getElementsByTagName("link")[i]); i++) {
    if (a.getAttribute("rel") &&
        a.getAttribute("rel").indexOf("style") != -1 &&
        a.getAttribute("title") &&
        !a.disabled
        ) return a.getAttribute("title");
  }
  return null;
}

function getPreferredStyleSheet() {
  var i, a;
  for (i=0; (a = document.getElementsByTagName("link")[i]); i++) {
    if (a.getAttribute("rel") &&
        a.getAttribute("rel").indexOf("style") != -1 &&
        a.getAttribute("rel").indexOf("alt") == -1 &&
        a.getAttribute("title")
        ) return a.getAttribute("title");
  }
  return null;
}

function createCookie(name,value,days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
  }
  else expires = "";
  document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}

window.onload = function(e) {
  var cookie = readCookie("style");
  var title = cookie ? cookie : getPreferredStyleSheet();
  setActiveStyleSheet(title);
}

window.onunload = function(e) {
  var title = getActiveStyleSheet();
  createCookie("style", title, 365);
}

var cookie = readCookie("style");
var title = cookie ? cookie : getPreferredStyleSheet();
setActiveStyleSheet(title);











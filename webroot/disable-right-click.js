var isNS = (navigator.appName == "Netscape") ? 1 : 0;

if(navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);

function mischandler(){
alert('Mouse right click is disabled in this screen.');
return false;

}

function mousehandler(e){

var myevent = (isNS) ? e : event;

var eventbutton = (isNS) ? myevent.which : myevent.button;

if((eventbutton==2)||(eventbutton==3)) 
{
	alert('Mouse right click is disabled in this screen.');
	return false;
}

}

document.oncontextmenu = mischandler;

document.onmousedown = mousehandler;

document.onmouseup = mousehandler;
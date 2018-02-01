<script>
// *Utillity Functions
function Display_Text(ID,txt,app)
{
var ActiveObject = document.getElementById(ID);
if (app == "t")
    {ActiveObject.innerHTML = txt + ActiveObject.innerHTML }
else
    {ActiveObject.innerHTML = txt};
};


function Display_TextAsc(ID,txt,app)
{
var ActiveObject = document.getElementById(ID);
if (app == "t")
    {ActiveObject.innerHTML =  ActiveObject.innerHTML + txt }
else
    {ActiveObject.innerHTML = txt};
};


function parsrecordval(rec)
{myString = new String(rec)
 val = myString.substr(myString.indexOf(",")+1,(myString.length - myString.indexOf(",")	))
	return val
};

function parsrecordDesc(rec)
{myString = new String(rec)
 val = myString.substr(0,myString.indexOf(","))
	return val
};


function GetStatStathndl(id)
{   var ActiveObject = parent.Stats.document.getElementById(id)
    return ActiveObject
};

function GetWindowStathndl(id)
{   var ActiveObject = top.frames[0].document.getElementById(id)
    return ActiveObject
};

function Getdochndl(id)
{   var ActiveObject = document.getElementById(id)
    return ActiveObject
};


function ReFormatString(This_String)
{	var ResStr =  new String(This_String)
	var	myRegExp = new RegExp("\~\~","g") 
	results = ResStr.replace(myRegExp, "'")
	return results
};

function ToLobby()
{
//alert(GetWindowStathndl('P_ID').value )
top.frames[1].location = "../asp/lobby.asp?P_ID=" + GetWindowStathndl('P_ID').value + "," 
}

function proxy(result)
{var myRes = new String(result) 

};

</Script>
//Qusetion object
	var question = new Object();
	initialize_object( );
	
//Other globals
	var password="";
	
function initialize_object()
{
	question.id = "";
	question.text = "";
	question.level = "";
	question.type = "";
	question.options = new Array();
	question.answers = new Array();
	question.meta = new Array();
}	
	
	
function read_inputs( )
	{
	initialize_object();
	
	password 	   = $("#key").val();
	question.id  = $("#qid").val();
	question.text  = $("#question").val();
	question.level = $("#level").val();
	question.type  = $("#ans_type").val();
	
	//Read options
	var ans="";
	var i=0;
	do{
	i = i - 0 + 1;
	ans = $("#ans_txt_"+i).val();
	if( ans != "" &&  ans!=undefined ) { question.options.push( ans ); }
	if($("#ans_opt_"+i).attr('checked') == "checked" ) question.answers.push( i );
	}while(ans!="" && ans!=undefined);
	
	var tags = new Array();
	var str = $("#tags").val();
	if(str.charAt(str.length) == ",") str = str.substring(0,(str.length-1));
	if(str != "") tags = str.split(",");
	for(i=0;i<tags.length;i++)
	{
		question.meta[i] = new Array();
		question.meta[i][0] = "tag";
		question.meta[i][1] = tags[i];
	}

	/*
	If Free is checked, then Free and Premium should be inserted
	If Premium is checked, then only Premium should be inserted
	*/
	
	question.meta[i] = new Array();
	question.meta[i][0] = "sync";
	question.meta[i][1] = "Premium"; //Premium is always inserted
	
	if($("#cat_free").attr('checked') == "checked") // If free category is checked, sync to free version as well
	{
	i = question.meta.length;
	question.meta[i] = new Array();
	question.meta[i][0] = "sync";
	question.meta[i][1] = "Free"; //free sync	
	}
	
	}
	
function validate()
{
var message="";
var i=1;

if( question.text == "" ) message += i+++".Enter a question\n";
if( question.level == "" ) message += i+++".Select question level\n"; 
if( question.type == "0" ) message += i+++".Select answer type\n";
if( question.options.length == 0 ) message += i+++".Insert some options\n";
else if( question.answers.length == 0 ) message += i+++".Select atleast one answer\n";

if(message != "") //something missing
{
 alert("Please perform the following actions before save \n\n"+message);
 return false;
}
else return true;

}	

function save_insert()
{
	read_inputs();
	if( validate() ) insert(); // if validated and can continue, then insert
}	
	
function insert()
{
//Save in DB
		$.post("CreateData.php", 
		{
		pwd:password,
		question_text:question.text,
		level:question.level,
		type:question.type,
		options:JSON.stringify(question.options),
		answers:JSON.stringify(question.answers),
		meta:JSON.stringify(question.meta),
		},function(data,status)
				{	
					$("#output").append(JSON.stringify(data));
				});	
}

function save_update( )
{
	read_inputs( );
	if( validate() ) update();
}


function update()
{
	//Save in DB
		$.post("UpdateData.php",{
		pwd:password,
		qid:question.id,
		question_text:question.text,
		level:question.level,
		type:question.type,
		options:JSON.stringify(question.options),
		answers:JSON.stringify(question.answers),
		meta:JSON.stringify(question.meta),
		},function(data,status){
					document.getElementById("output").innerHTML = "";
					document.getElementById("output").innerHTML = JSON.stringify(data);
					refresh_ui( );
				});

}

function read_from_db(pwd,id)
{
	$.post("ReadData.php",{
						secret_key:pwd,
						qid:id
						},function(data,status){
										
					var quest_data = data;
					if( quest_data.status == "RESTRICTED" ) { document.getElementById("output").innerHTML = JSON.stringify(quest_data.message); return false; }
					else if(quest_data.status == "FAIL") { document.getElementById("output").innerHTML = "Question ID "+$qid+" not found !"; return false; }
					else // data found, put it to the attributes
					{				
					initialize_object( ); //reset question object
					question.text = quest_data.question;
					question.level = quest_data.level;
					question.type = quest_data.type;
					
					question.meta = new Array( );
					question.meta = quest_data.meta;
					question.options = new Array( );
					question.options = quest_data.options;
					question.answers = new Array( );
					question.answers = quest_data.answers;
					
					set_data( ); //Object values were set, now set data in UI
					}
				});				
}

//This function will set data in UI from question object
function set_data( )
{
document.getElementById("qid").disabled = true; //let question ID be disabled now !
document.getElementById("data").style.display = ""; //Display data 
document.getElementById("data").style.visibility = "visible"; //Display data 

document.getElementById("question").value = question.text;
document.getElementById("level").value = question.level;
document.getElementById("ans_type").value = question.type;
answer_type(question.type);

var tags="";
var premium=false;

for(i=0;i<question.meta.length;i++)
	{
	if(question.meta[i][0] == "tag") { tags += ","+question.meta[i][1]; }
	else if(question.meta[i][0] == "sync" && question.meta[i][1] == "Premium" ) premium=true;
	}

document.getElementById("tags").value = tags.substring(1,tags.length);//removing first comma through substring
if(premium == true) document.getElementById("cat_premium").checked = "checked";

no_of_ans = 0;
for(i=0;i<question.options.length;i++)
	{
	add_answer();
	document.getElementById("ans_txt_"+question.options[i][0]).value = question.options[i][1];
	}
					
for(i=0;i<question.answers.length;i++)
	{
	document.getElementById("ans_opt_"+question.answers[i]).checked = "checked";
	}
}

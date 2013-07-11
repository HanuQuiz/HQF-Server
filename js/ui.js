// Global Variables
var ans_type=1; //Answer type selected
var no_of_ans=2; //No of Answers, defaulted to 2 (Minimum number)
var display_ans=""; //Display answer
var hide_ans="none"; //Hide answer, display property="none"
var max_answers=10; //Maximum no of answers=10
var ans_content="";

// Once answer type is changed, this method is triggered parameter:type , type : 0-nothing, 1-Single Choice, 2-Multichoice
function answer_type(type)
{

ans_type = type; //Set global variable
if(type == 0 || type == "0") //IF type = 0, nothing, then clear everything !
	{
	for(i=1;i<=max_answers;i++)
		{
			clear_answer(i); //clear all answers
		}
	no_of_ans = 2;
	return;
	}

var dom;
for(i=1;i<=max_answers;i++)
	{
		dom = document.getElementById("ans_opt_"+i);
		if(type == 2) dom.type = "checkbox";
		else if(type == 1) dom.type = "radio";
		if(i<=no_of_ans) document.getElementById("ans"+i).style.display = display_ans; //display 
	}	
	
	
}

// Clear and hide answer specified, ind=index to hide and clear
function clear_answer(ind)
{
		document.getElementById("ans_opt_"+ind).checked = "";
		document.getElementById("ans_txt_"+ind).value = "";
		document.getElementById("ans"+ind).style.display = hide_ans;
}

// Increment answer counter and un-hide the new answer
function add_answer()
{
if(ans_type == 0) return;
if(no_of_ans >= max_answers) return;  //if exceeds maximum answers, then return, do not add
no_of_ans = no_of_ans - 0 + 1;
document.getElementById("ans"+no_of_ans).style.display = "";
}

// Decrement answer counter, and clear and hide the last answer
function remove_answer()
{
if(no_of_ans == 2) return;
clear_answer(no_of_ans);
no_of_ans = no_of_ans - 0 - 1;
}

// Clear all inputs : Clears and resets to default
function clear_all_inputs()
{
document.getElementById("question").value = "";
document.getElementById("tags").value = "";
document.getElementById("level").value = "1";
answer_type(0);
document.getElementById("type_0").selected = true;
document.getElementById("cat_free").checked = "checked";
}

// Handle the key pressed on an answer, DOWN arrow/ENTER->Move to next visible answer , UP arrow->Move to previous answer
function handle(e,id)
{
if(e.keyCode == 40 || e.keyCode == 13) //DOWN Arrow pressed OR Enter Key Pressed
	{
	next_id = id.replace("ans_txt_","");
	next_id = next_id - 0 + 1;
	if( document.getElementById("ans"+next_id).style.display != hide_ans ) document.getElementById("ans_txt_"+next_id).focus( );
	}
else if(e.keyCode == 38)  // UP Arrow pressed
	{
	prev_id = id.replace("ans_txt_","");
	prev_id = prev_id - 0 - 1;
	if( document.getElementById("ans"+prev_id).style.display != hide_ans ) document.getElementById("ans_txt_"+prev_id).focus( );
	}
}

function refresh_update_ui()
{
document.getElementById("qid").value = "";
document.getElementById("data").style.display = "none";
document.getElementById("qid").disabled = false;
document.getElementById("qid").focus( );
}
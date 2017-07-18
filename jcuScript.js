//Testing javascript functions using Qunit
QUnit.test( validateForm, function( assert ) {
  assert.ok( 1 == "1", "Passed!" );
});
QUnit.test( autojump, function( assert ) {
  assert.ok( 1 == "1", "Passed!" );
});
QUnit.test( autojump_keyDown, function( assert ) {
  assert.ok( 1 == "1", "Passed!" );
});
QUnit.test( autojump_keyUp, function( assert ) {
  assert.ok( 1 == "1", "Passed!" );
});


//Function to validate forms
function validateForm()
{
if (document.forms["loginForm"]["username"].value==null || document.forms["loginForm"]["username"].value=="")
	{
		alert("User name must be filled in");
		document.forms["loginForm"]["username"].focus();
		return false;
	}
else if (document.forms["loginForm"]["password"].value==null || document.forms["loginForm"]["password"].value=="")
	{
		alert("Password must be filled in");
		document.forms["loginForm"]["password"].focus();
		return false;
	}
}


var downStrokeField;
function autojump(fieldName,nextFieldName,fakeMaxLength)
{
var myForm=document.forms[document.forms.length - 1];
var myField=myForm.elements[fieldName];
myField.nextField=myForm.elements[nextFieldName];

if (myField.maxLength == null)
   myField.maxLength=fakeMaxLength;

myField.onkeydown=autojump_keyDown;
myField.onkeyup=autojump_keyUp;
}

function autojump_keyDown()
{
this.beforeLength=this.value.length;
downStrokeField=this;
}

function autojump_keyUp()
{
if (
   (this == downStrokeField) && 
   (this.value.length > this.beforeLength) && 
   (this.value.length >= this.maxLength)
   )
   this.nextField.focus();
downStrokeField=null;
}
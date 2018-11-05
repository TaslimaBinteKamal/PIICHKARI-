
function CheckPassword(password1,password2){
	
	var password1Len = password1.value.length;
	var password2Len = password2.value.length;
	if (password1Len < 8 || password1Len > 16)
	{
		 alert("Password should not be empty / length be minimum 8 characters and maximum 16 characters");
        password1.focus();
		return false;
	}
	if (password2.value != password1.value)
	{
		 alert("password doesn't match");
        password2.focus();
		return false;
	}
	return true;
	
	
	
}

function checkPasswordModification(){
	var password1 = document.passwordChange.newpassword1;
	var password2 = document.passwordChange.newpassword2;
	if(CheckPassword(password1,password2)){
		return true;
	}
	return false;
}

function checkPasswordSignUp(){
	var password1 = document.register.password1;
	var password2 = document.register.password2;
	if(CheckPassword(password1,password2)){
		return true;
	}
	return false;
}
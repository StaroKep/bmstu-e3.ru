let elem = document.getElementById('find_by_surname');
elem.onkeyup = function(e){
	let surname = document.getElementById('find_by_surname').value;
	FindStudent(surname);
}

function FindStudent(surname){
	let students = document.getElementsByClassName('student_a');
	if (surname == "") {
		for (let i = 0; i <= students.length; i++) {
			students[i].style.display = 'inline';
		}
		
	} else {
		for (let i = 0; i <= students.length; i++) {
			let string = students[i].innerHTML;
				string = string.substr(0, string.indexOf(" "));
				//alert(string);
			if ((string != surname) && (string.indexOf(surname) == -1)) {
				students[i].style.display = 'none';
			} else {
				students[i].style.display = 'inline';
			}
		}
	}
}
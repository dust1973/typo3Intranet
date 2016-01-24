function checkBoxes(objThis){
  // Checkbox selected? (true/false)
  var blnChecked = objThis.checked;
  // parent node
  var objHelp = objThis.parentNode;

  while(objHelp.nodeName.toUpperCase() != "LI"){
    // next parent node
    objHelp = objHelp.parentNode;
  }

  var arrInput = objHelp.getElementsByTagName("input");
  var intLen = arrInput.length;

  for(var i=0; i<intLen; i++){
    // select/unselect Checkbox
    if(arrInput[i].type == "checkbox"){
      arrInput[i].checked = blnChecked;
    }
  }
}

$(document).ready(function() {

	$('.woehrlseminare-category input').change(function() {
		$('#calendar').fullCalendar('refetchEvents');
	});

	 $('.woehrlseminare-discipline input').change(function() {
		$('#calendar').fullCalendar('refetchEvents');
	});
});






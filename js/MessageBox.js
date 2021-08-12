let getById = (id, parent) => parent ? parent.getElementById(id) : getById(id, document);
let getByClass = (className, parent) => parent ? parent.getElementsByClassName(className) : getByClass(className, document);

const DOM =  {
	messageInput: getById("messageBox"),
};

let sendMessage = () => {
	let message = DOM.messageInput.value;
	DOM.messageInput.value = "";
	if (message === "") return;

	let msg = {
		sender: 6,
		body: message,
		status: 1,
		recvId: 2,
	};
	
	$.ajax({
		type: 'POST',		
		url: 'Includes/sendMessage.inc.php?action=sendMessage',
		cache: false,
		dataType: 'json',
		data: {msg},
        success: function(data) {
			window.location.reload();
	    }
	});
	window.location.reload();
};


let openChat = (recevId) => {

	if (recevId === "") return;

	let msg = {
		receiverId: recevId,
	};
	
	$.ajax({
		type: 'POST',		
		url: 'Includes/sendMessage.inc.php?action=openChat',
		cache: false,
		dataType: 'json',
		data: {msg},
        success: function(data) {
			window.location.reload();
	    }
	});
	window.location.reload();
};
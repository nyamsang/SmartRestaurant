class SmartFn {	
	static pad(n, width, z) {
		console.log("fn: SmartFn.pad");
		z = z || '0';
		n = n + '';
		return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
	}
	
	static getGetParam(param_name) {
		console.log("fn: SmartFn.getGetParam");
		var url = new URL(window.location.href);
		return url.searchParams.get(param_name);
	}
	
}

function print_order_batch(order_batch_id) {
	window.print();
}

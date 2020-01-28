class SmartFn {
	static initPage() {
		console.log("fn: SmartFn.initPage");
		$(document).attr("title", "Smart Restaurant - Supplier");
		var current_date = new Date();
		var str_date = current_date.getUTCFullYear()+"-"+SmartFn.pad(current_date.getMonth()+1, 2)+"-"+current_date.getDate();
		$("#order_date").val(str_date);
		$("#order_date").change(function () {
			console.log("jq: #order_date.change = "+$("#order_date").val());
		});
	}
	
	static getOrderBatchList() {
		console.log("fn: SmartFn.getOrderBatchList");
	}
	
	static pad(n, width, z) {
		z = z || '0';
		n = n + '';
		return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
	}
}

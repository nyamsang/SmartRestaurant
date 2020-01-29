$(document).ready(function() {
	initPage();
});

function initPage() {
	console.log("fn: initPage");
	$(document).attr("title", "Smart Restaurant - Supplier");
	var current_date = new Date();
	var str_date = current_date.getUTCFullYear()+"-"+SmartFn.pad(current_date.getMonth()+1, 2)+"-"+current_date.getDate();
	$("#order_date").val(str_date);
	$("#order_date").change(function () {
		console.log("jq: #order_date.change = "+$("#order_date").val());
	});
	resetOrderBatchList();
}

function resetOrderBatchList() {
	console.log("fn: resetOrderBatchList");
	$("#tbody_order_batch_list").empty();
	$.ajax({
		url: "smart_form/tr_order_batch_list.html", 
		success: function(tr_tag) {
			$.getJSON(config["service_path"]+"get_order_batch_list.php?branch_id="+SmartFn.getGetParam("branch_id")+"&is_printed=false", function(order_batch_response) {
				var order_batch_list = order_batch_response["fn_output"];
				for(var i=0; i<order_batch_list.length; i++) {
					var order_batch = order_batch_list[i];
					var record_tag = tr_tag;
					record_tag = record_tag.replace("[order_batch_id]", order_batch["order_batch"]["id"]);
					record_tag = record_tag.replace("[order_batch_id]", order_batch["order_batch"]["id"]);
					record_tag = record_tag.replace("[order_batch_id]", order_batch["order_batch"]["id"]);
					record_tag = record_tag.replace("[branch_id]", SmartFn.getGetParam("branch_id"));
					record_tag = record_tag.replace("[time]", order_batch["order_batch"]["order_datetime"]);
					record_tag = record_tag.replace("[table_name]", order_batch["table"]["name"]);
					record_tag = record_tag.replace("[status]", order_batch["order_batch"]["is_printed"]==true? "Printed": "Unprinted");
					$("#tbody_order_batch_list").append(record_tag);
				}
			});
		}
	});
}

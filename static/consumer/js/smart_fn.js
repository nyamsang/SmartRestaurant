class SmartFn {
	static intiPage() {
		$(document).attr("title", "Saphan Sung");
		SmartFn.initProductListTable();
	};
	
	static getHtmlForm(formName, callBackFn) {
		var filePath = "smart_form/"+formName+".html";
	    var rawFile = new XMLHttpRequest();
	    rawFile.open("GET", filePath, false);
	    rawFile.onreadystatechange = function ()
	    {
	        if(rawFile.readyState === 4)
	        {
	            if(rawFile.status === 200 || rawFile.status == 0)
	            {
	                var allText = rawFile.responseText;
	                callBackFn(allText);
	            }
	        }
	    }
	    rawFile.send(null);
	};
	
	static initProductListTable(element, formName) {
		SmartFn.getHtmlForm("product_list_table", function(content) {
			$("#smart_table_container").html(content);
			SmartFn.refreshSupplierProductList();
		});
	}
	
	static refreshSupplierProductList() {
		SmartFn.getHtmlForm("product_list_item", function(content) {
			$("#menu_table_body").empty();
			for(var i=0; i<10; i++) {
				$("#menu_table_body").append(content);
			}
		});
	}
}

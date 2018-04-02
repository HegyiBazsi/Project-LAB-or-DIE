$(document).delegate("ul.dropdown-content [data-keepOpenOnClick]", "click", function(e) {
	e.stopPropagation();
});
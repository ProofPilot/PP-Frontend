Handlebars.registerHelper('ischecked', function(checked) {
    if(checked)
        return "checked";
    else
        return "";
});

Handlebars.registerHelper('show', function(checked) {
    if(checked)
        return 'style="display:block"';
    else
        return 'style="display:none"';
});

Handlebars.registerHelper('sizeActive', function(val,size) {
    if((val==4)&&(!size)) return "active";
    if(val==size) return "active";
    return "";
});

Handlebars.registerHelper('equal', function(lvalue, rvalue, options) {
    if (arguments.length < 3)
        throw new Error("Handlebars Helper equal needs 2 parameters");
    if( lvalue!=rvalue ) {
        return options.inverse(this);
    } else {
        return options.fn(this);
    }
});

Handlebars.registerHelper('notEmpty', function(obj, options) {
    if(jQuery.isEmptyObject(obj)) {
         return options.inverse(this);
    } else {
    	return options.fn(this);
    }
});

Handlebars.registerHelper('stringify', function(obj) {
	return JSON.stringify(obj);
});
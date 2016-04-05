/**
 * functions.js
 *
 * Public and useful functions that are called using the reveling 
 * module pattern.  All functions are to be organized into a single
 * object literal and returned.  
*/
define(function(){

	var my_funcs = {

		// Selects all dom elements and performs a callback function.
		'walkTheDom': function(node, func){
			func(node);
			node = node.firstChild;
			while (node){
				this.walkTheDom(node, func);
				node = node.nextSibling;
			}
		}
	}

	return my_funcs;

});
jQuery.validator.addMethod("alphanumeric", function(value, element) {
  return !/[\.?,!/:\*-\+\\=\(\)\]\[_&"'#]/.test(value);
}, "Please use alphanumeric characteres");

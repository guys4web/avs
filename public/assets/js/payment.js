$(document).ready(function(){
   
    $("#wizard-validation").validate({
                errorPlacement: function (error, element) {
                    element.before(error);
                },
                rules: {
                    confirm: {
                        equalTo: "#password"
                    } ,
                    cardnum : {
                        required:function(element) {
                          return $("#payment_type").val() == "cc";
                        },
                        number: function(element) {
                          return $("#payment_type").val() == "cc";
                        }
                    },
                    ccv : {
                        required:function(element) {
                          return $("#payment_type").val() == "cc";
                        } ,
                        number: function(element) {
                          return $("#payment_type").val() == "cc";
                        } ,
                        rangelength:function(element) {
                          return ($("#payment_type").val() == "cc")? [3, 3] : false ;
                        }
                    },
                    "expDate-month" : {
                      required:function(element) {
                        return $("#payment_type").val() == "cc";
                      }
                    },
                    "expDate-year" : {
                      required:function(element) {
                        return $("#payment_type").val() == "cc";
                      }
                    },
                    bname : {
                      required : function(element) {
                        return $("#payment_type").val() == "cc";
                      }
                    },
                    baddress : {
                      required : function(element) {
                        return $("#payment_type").val() == "cc";
                      }
                    },
                    bcity : {
                      required:function(element) {
                        return $("#payment_type").val() == "cc";
                      }
                    },
                    bstates : {
                      required:function(element) {
                        return $("#payment_type").val() == "cc";
                      }
                    },
                    postal :{
                      required : function(element) {
                        return $("#payment_type").val() == "cc";
                      }
                    },
                    services : {
                        required:true
                    },
                    qty : {
                      required:true,
                      min:1,
                      number: true
                    },
                    visa :{
                        required:true
                    },
                },
                messages: {
                  ccv : {
                      rangelength:  "Must be 3 characteres"
                  },
                }
    }); 
    
    
    $("select[data-select2!='false']").select2();

    $('#expDate').datepicker({
        format:"yyyy-mm" ,
        minViewMode : "months"
    });
    
    
});
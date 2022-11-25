var url = $("#b_url").val();
var table;
var user = new Vue({
	el: '#vue-ad',
	data: {
		
    posts:[],
   
	},
  mounted: function(){
    	this.getPost();
  },
	methods: {
		
        change_type_1:function(i){
            if($("#at"+i).is(":checked")){
                $("#image-ad"+i).show();
                $("#script-ad"+i).hide();
            }else{
                $("#image-ad"+i).hide();
                $("#script-ad"+i).show();
            }
        }
		
	}

})

var r_id = -1;
function removeUser(i){
    r_id = i;
    $("#remove").modal('show');
}
$("#yes").click(function(){
    user.removeUser(r_id);
})
  






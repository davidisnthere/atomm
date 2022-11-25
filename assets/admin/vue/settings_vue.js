
var url = $("#b_url").val();
var setting = new Vue({
	el: '#vue-setting',
	data: {
       
	},
  mounted: function(){
    	
  },
	methods: {
		
    updatePassword: function(){
        var soldpswd = $("#soldpswd").val();
        var snewpswd = $("#snewpswd").val();
        var sconpswd = $("#sconp").val();
        var arr = [
            {id: 'soldpswd',validate: {required: 1,email: 0,mobile: 0,length:0},msg:'Old Password' },
            {id: 'snewpswd',validate: {required: 1,email: 0,mobile: 0,length:0},msg:'New Password' },
            {id: 'sconp',validate: {required: 1,email: 0,mobile: 0,length:0},msg:' Password' },
        ]
        var v = smart_validate(arr);
        if(v){
            if(snewpswd == sconpswd){
                arr = {'old':soldpswd,'pswd':snewpswd}
                axios.post(url+'admin/changePassword',arr).then(function(e){
                    if(e.data == 'err'){
                        $("#err").show();
                    }else{
                        $("#err").hide();
                        alert('Password Changed Sucessfully');
                    }
                })
            }
        }else{

        }
       
        
    },
    
	}



})


var setting = new Vue({
    el: '#app-setting',
    data: {
       
    },
  mounted: function(){
       
  },
    methods: {
        
    updateActivation: function(){
      if($('#aemail').is(':checked')){
          axios.post(url+'settings/update_activation',{activation:1}).then(function(e){

          })  
      }else{
         axios.post(url+'settings/update_activation',{activation:0}).then(function(e){
                
         })  
      }
     
    },
    updatePostNotification: function(){
       if($('#remail').is(':checked')){
          axios.post(url+'settings/update_activation',{ replay:1}).then(function(e){
            
          })  
      }else{
         axios.post(url+'settings/update_activation',{replay:0}).then(function(e){
                
         })  
      }
    },
    updateReplayNotification: function(){
       if($('#lemail').is(':checked')){
          axios.post(url+'settings/update_activation',{like:1}).then(function(e){
            
          })  
      }else{
         axios.post(url+'settings/update_activation',{like:0}).then(function(e){
                
         })  
      }
    },
    changePostPerPage: function(){
        var val = $("#myRange").val();
        axios.post(url+'settings/changePostPerPage',{'pp':val}).then(function(e){
                
        }) 
    },
    changeSMTP: function(){
        if($('#smtp').is(':checked')){
          axios.post(url+'settings/update_smtp',{smtp:1}).then(function(e){
            
          }) 
          $("#smtp_setting").show();
      }else{
         axios.post(url+'settings/update_smtp',{smtp:0}).then(function(e){
                
         }) 
         $("#smtp_setting").hide(); 
      }
    },
    update_smtp_settings: function(){
        var host = $("#host").val();
        var port = $("#port").val();
        var user = $("#user").val();
        var pswd = $("#pswd").val();
        var arr = {'host':host,'port':port,'user':user,'pswd':pswd}
        axios.post(url+'settings/update_smtp_sttings',arr).then(function(e){
             $.notify("SMTP Settings Updated Sucessfully", "success"); 
        }) 
    }
}



})

 $('#aemail').change(function() {
       setting.updateActivation(); 
 })
$('#remail').change(function() {
       setting.updatePostNotification(); 
 })
 $('#lemail').change(function() {
       setting.updateReplayNotification(); 
 })
 $("#myRange").change(function(){
    setting.changePostPerPage();
 })
  $("#smtp").change(function(){
    setting.changeSMTP();
 })



 $(document).ready(function(){
    var slider = document.getElementById("myRange");
    var output = document.getElementById("rangval");
    output.innerHTML = slider.value;

    slider.oninput = function() {
      output.innerHTML = this.value;
    }
 })
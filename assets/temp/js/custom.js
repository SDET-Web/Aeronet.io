//****************** YOUR CUSTOMIZED JAVASCRIPT **********************//
var customJS = function(){
   return {
      connect : function($this){
         $this.parent().parent().parent().parent().parent().parent().fadeOut();
         generate('topLeft', '', '<div class="alert alert-success media fade in"><p><strong>Well done!</strong> Invitations has been sent to user.</p></div>');
      }
   }
}();
;(function($){
    var exitmodals = [];
    var popupsDisplayed = false;
    $(document).ready( function(){
        PlainModal.closeByEscKey = false;
        PlainModal.closeByOverlay = false;

        var modalels = document.querySelectorAll('.modal-content');
        // var modals = [];
        for( i=0; i<modalels.length; i++ ){
            var content = modalels[i];
            var modal = new PlainModal(content);
            modal.closeButton = content.querySelector('.close-button');
            if(modalels[i].getAttribute("data-exit" ) == '1' ){
                modal.open();
            }else{
                exitmodals.push( modal );
            }
        }
    });
    window.onbeforeunload = function(){
        if(!popupsDisplayed ){
            for( i in exitmodals ){
                exitmodals[i].open();
            }
            popupsDisplayed = true;
            return 'random';
        }
    }
})(jQuery);
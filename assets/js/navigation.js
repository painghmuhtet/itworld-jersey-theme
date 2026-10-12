(function($){
    $(document).ready(function(){
        // simple navigation toggle for small screens
        var menu = $('#primary-menu');
        if(!menu.length) return;
        $('<button class="menu-toggle">Menu</button>').insertBefore('#primary-menu').on('click', function(){
            menu.toggle();
        });
    });
})(jQuery);

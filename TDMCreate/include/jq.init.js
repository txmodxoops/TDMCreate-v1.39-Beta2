$(document).ready(function(){
        // Hide/Show Modules Tables
        $('#modtab').hide();
        $('td#modtabs').click(function(){
           $(this).next('#modtab').slideToggle('slow');});
});
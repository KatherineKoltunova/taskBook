window.onload = function() {
    var status=$("input[name='status']");
    status.change(function(){
        status.each(function(){
            if($(this).is(':checked')){
                document.location.replace('task/editStatus/?task='+$(this).val()+location.search.replace('?','&'));
            }
        });
    });
}
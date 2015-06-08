/**
 * Created by vagur on 07.06.15.
 */
$(function(){
    $('.widget-table-grid-delete').on('click', function(e){
        e.preventDefault();
        if(confirm("Удалить сотрудника?")){
            location.href=$(this).attr('href');
        }
    })
})
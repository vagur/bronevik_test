/**
 * Created by vagur on 05.06.15.
 */
$(function(){
    $('#phone').mask('+7(000)000-00-00');
    $('#passport').mask('0000 000000');
    $('#birthdate').datetimepicker({
        lang:'ru',
        i18n:{
            de:{
                months:[
                    'Январь','Февраль','Март','Апрель',
                    'Май','Июнь','Июль','Август',
                    'Сентябрь','Октябрь','Ноябрь','Декабрь',
                ],
                dayOfWeek:[
                    "Вс", "Пн", "Вт", "Ср",
                    "Чт", "Пт", "Сб",
                ]
            }
        },
        timepicker:false,
        format:'d.m.Y'
    });
})
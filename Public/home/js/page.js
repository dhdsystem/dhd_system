$(document).ready(function() {
    // 所有的时间插件控制
    $('#sdd').calendar({
        trigger: '#starttime',
        zIndex: 999,
        format: 'yyyy-mm-dd',
    });
    $('#edd').calendar({
        trigger: '#endtime',
        zIndex: 999,
        format: 'yyyy-mm-dd',
    });
    $('#sdd2').calendar({
        trigger: '#starttime2',
        zIndex: 999,
        format: 'yyyy-mm-dd',
    });
    $('#edd2').calendar({
        trigger: '#endtime2',
        zIndex: 999,
        format: 'yyyy-mm-dd',
    });
    $('#sdd3').calendar({
        trigger: '#starttime3',
        zIndex: 999,
        format: 'yyyy-mm-dd',
    });
    $('#edd3').calendar({
        trigger: '#endtime3',
        zIndex: 999,
        format: 'yyyy-mm-dd',
    }); 

    $('#gathDate').calendar({
        trigger: '#dateofcollect',
        zIndex: 999,
        format: 'yyyy-mm-dd',
    });
    $('#expendDate').calendar({
        trigger: '#expendipt',
        zIndex: 999,
        format: 'yyyy-mm-dd',
    });
});
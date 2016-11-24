"use strict";
function showFormModal(data) {

    $.fancybox( {
        content	: data,
        scrolling : 'none',
        padding: 5,
        type : 'data',
        autoWidth: true,
        autoHeight: true,
        autoResize: false,
        closeBtn	: false,
        modal		: true,
        transitionIn	 : 'elastic',
        transitionOut	 : 'elastic',
        topRatio	: 0.3, // по центру для регистрации
        leftRatio	: 0.3,
        title		: 'Знаком (*) помечены поля обязательные для ввода!',
        autoDimensions: true,
        overlayShow: true,
        helpers		: {
            overlay : { showEarly  : true },
            title	: { type : 'float'
            }
        }
    });

    return false;
}

// проверка запоолнения обязательных полей
//   TODO: добавить попозже проверку типов полей!
function validateReguiredFields(thisForm) {

    var result = true;

    $('input[required]:visible', thisForm).each(
        function (index) {
            if ( !this.value ) {
                result = false;
                alert( 'Заполните поле - ' + $('label[for="' + this.id + '"]').text() );
                $(this).css( { border: '1px red solid' } ).focus();

                return false;
            }
            else {
                $(this).css( { border: '' } );
            }
        }
    );

    return result;
}

function saveForm(thisForm, successFunction)
{
    var $out = $('output', thisForm),
        $loading = $('.loading', thisForm),
        $progress = $('progress', thisForm);

    if (validateReguiredFields(thisForm) !== true)
        return false;

    $(thisForm).ajaxSubmit({
        beforeSubmit: function(a,f,o) {
            o.dataType = "json";
            $out.html('Начинаю отправку...');
            $progress.show();
            $loading.show();
        },
        uploadProgress: function(event, position, total, percentComplete) {
            $out.html( 'Progress - ' + percentComplete + '%' );
            $progress.val( percentComplete );
        },
        success: function(data, status) {
            $out.html('Успешно изменили запись.');
            successFunction( data );
            $.fancybox.close();
        },
        error: function(error, status) {
            $out.html( error.responseText );
        },
        complete: function(data, status) {
            $progress.hide();
            $loading.hide();
            console.log(status);
            console.log(data);
        }
    });

    return false;
}
function showAddToolsForm(thisElem, notSaved) {
    var dataElem = $(thisElem).data(),
        props = dataElem.props,

        inputName = '<label class="required">Название</label><input type="text" name="name" required placeholder="Например, место его расположения"/>',
        propsValue = '', comma = '',
        endform = '<input id="isAdding" type="checkbox" checked/><label>Добавить в текущую комнату</label><button>Добавить в реестр</button>',
        text = '<form method="post" class="login" action="/user/usertools/add" onsubmit="return saveForm(this, afterSaveTools);">'
                + '<input hidden name="id_tools" value="' + dataElem.id + '"/>'
                + (notSaved ? inputName : '<figcaption>' + thisElem.title + '</figcaption>'),
        prefixText = notSaved ? 'Введите ' : '',
        rflog = '';

    for (var i in props ) {

        if ( props[i]== "?" || !notSaved) {
            text +=  '<div><label ' + (notSaved ? 'class="required"' : '') + '>' + prefixText + getNameFromID(i)
                    + '</label><input type="text" required name="props:' + i
                    + (notSaved ? '' : '" value="' + props[i] ) + '"/></div>';
        } else {
            propsValue += comma + '\"' + i + '\":\"' + props[i] +'\"';
            comma = ',';
        }
    }
    // если есть свойства, которые не редактируют, то их сохраняем в отдельном параметре
    if (propsValue) {
        propsValue = "<input hidden name='props' value='" + propsValue + "'/>";
    }

    $.fancybox( text + propsValue + endform + rflog + '</form>',
        {
            title: 'Данные для прибора ' + thisElem.title,
            transitionIn	 : 'elastic',
            transitionOut	 : 'elastic',
            helpers		: {
                overlay : { showEarly  : true },
                title	: { type : 'float'
                }
            },
            'onClosed': function (currentArray, currentIndex, currentOpts) {
                // Use closedParam here
                if (notSaved && confirm( 'Вы внесли изменения и не сохранили результат. Закрыть форму?' ))
                    return false;
            }
        });

    $(thisElem).parent('div').slideUp();

    return false;

}
function saveRoom(thisForm)
{
    var props = '',
        comma = '';

    $('.draggable').each( function () {
        var coords    = getCoords(this),
            propsData = $(this).data();
        props += comma + '{' + '"left":' + coords.left + ',"top":' + coords.top ;
        for (var i in propsData ) {
            props += ',' + '"' + i + '":"' + propsData[i] + '"';
        }
        props += '}';
        comma = ',';
    });
    $('input[name=props]', thisForm).val(props);

    saveForm(thisForm, afterSaveRoom);

    return false;
}
// ПОСЛЕ сохранения инструмента
function afterSaveTools(data) {
    $('#dMyTools').load('/user/usertools/menu');

    if ($('#isAdding:checked').length > 0)
        AddItem( data );

}
// ПОСЛЕ сохранение комнаты
function afterSaveRoom(data) {
    $('#dMyRooms').load('/user/rooms/menu');
}

function changeLoginForm() {
    $('#fLogin').attr('action', '/user/login/signup');
    $('#fLogin figcaption').toggle();

    return false;
}



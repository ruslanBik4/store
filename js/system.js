/**
 * Created by rus on 12.10.16.
 */
"use strict";
var imgItem, divContent, default_page = 'img/logo2.svg', notSaved;
$(function() {

//     imgItem = document.getElementById('imgItem');
    divContent = $('#content');
//     imgItem.onmousedown = readyForDragAndDrop;

    $.get('/user/login/', function (data) {
        if (data.substr(0,5) == '<form') {
            showFormModal(data);
        } else { // уже залогинен, обрабатываем данные
            afterLogin( JSON.parse(data) );
        }
    });

});
// после загрузки новой страницы
function SitePostShow() {
}
// перед загрузкой новой страницы, чистим хвосты
function beforeLoadContent() {
    $('canvas, .rmpPlayer, img.draggable').detach();
    $('#dRoomtools').html('');
    divContent.css({background: ''});
}
function afterLogin(data)
{
    if (!data)
     return false;

    $('#sTitle').html( ( data === null ? '' : 'Добро пожаловать, ' + data[0].login + '!') );
    $('#fTools > output').text( 'Можете добавить устройство из меню и перенести его в нужное Вам место.');
    loginToggle();

    $('#dMyTools').load('/user/usertools/menu');
    $('#dMyRooms').load('/user/rooms/menu');

    ShowOkno('img/logo2.svg');
}
function logOut(thisElem) {
    $('canvas').detach();
    loginToggle();
    $('#sTitle').html( 'Для начала работы Вам необходимо ' );
    $.get( thisElem.href, function (data) {
        if (data.substr(0,5) == '<form') {
            showFormModal(data);
        } else {
            alert(data);
        }
    } );

    return false;
}
function loginToggle() {
    $('#bLogOut, #dLogin').toggle();
}
function roomsRead(thisElem)
{
    var dataElem = $(thisElem).data(),
        props    = dataElem.props,
        width = ( dataElem.width ? dataElem.width : "98%"),
        height = ( dataElem.height ? dataElem.height : "98%"),
        text = '';

    beforeLoadContent();

    for (var i in props ) {
        AddItem( props[i] );
    }
    if( dataElem.image === undefined) {
        divContent.css( {backgroundImage: ''} ).html('<svg class="room"><rect width="' + width + '" height="' + height + '" fill="rgb(234,234,234)" stroke-width="1" stroke="rgb(0,0,0)"/></svg>');
    } else {
        divContent.css( {
            backgroundImage: 'url("' + dataElem.image + '")',
            backgroundSize : width + 'px ' + height + 'px '
        } ).html('');
    }

    $('#dMyRooms').hide();
    $('#dRoomForm').load('user/rooms/edit', {id : dataElem['id'] })
    .mousedown( readyForDragAndDrop ).slideDown('fast').slideUp('fast').slideDown('slow');

    return false;
}

function newRoom(thisElem, cloneId) {
    var dataElem = $(thisElem).data();

    beforeLoadContent();
    $('#dMyRooms').hide();
    $('#dRoomForm').load(
        'user/rooms/edit',
        cloneId  ? {cloneId : dataElem.id} : {}
    );
    // $('#fRoom input[name=parent_id]').val(parentID);
    $('#dRoomForm').mousedown( readyForDragAndDrop ).slideDown('fast').slideUp('fast').slideDown('slow');
    divContent.css( {backgroundImage: ''} ).html('<svg class="room"><rect width="98%" height="98%" fill="rgb(234,234,234)" stroke-width="1" stroke="rgb(0,0,0)"/></svg>');

    return false;
}
function resizeRoom(thisElem) {
    $('svg.room').css({
        width:  $('#fRoom input[name=width]').val(),
        height: $('#fRoom input[name=height]').val()
    });
}
// добавление фото для новой комнаты
function handleFileSelect(evt) {
    var files = evt.files || evt.target.files, // FileList object
        $progress = $('#progress').show(),
        reader = new FileReader(),
        f = files[0];

    if (files.length < 1)
        return false;

    reader.onload = (function(theFile) {
        return function(e) {
            // Render thumbnail.
            divContent.css( { backgroundImage: 'url(' + e.target.result + ')' } ).html('');
            // $('svg', divContent).append("<img class='new_photo' src='" + e.target.result +
            //     "' title='" + escape(theFile.name) + "' alt='" + escape(theFile.name) + '/>');
        };
    })(f);

    // Read in the image file as a data URL.
    reader.readAsDataURL(f);
}

function showFlat(thisElem) {
    var images = '',
        bkgPos = '0% 0%, 50% 0%, 0% 50%, 50% 50%',
        bkgSize= '25%',
        comma  = '';

    beforeLoadContent();

    $('ul > li > a', thisElem.parentElement).each( function() {
        var dataElem = $(this).data();

        if (dataElem.image === undefined)
            images += comma + "url('img/room.svg')";
        else
            images += comma + "url('" + dataElem.image.substr(3) + "')";

        for (var i in dataElem.props ) {
            AddItem( dataElem.props[i] );
        }
        comma   = ',';
    });

    divContent.css( { backgroundImage: images, backgroundPosition: bkgPos, backgroundSize: bkgSize  }).html('');

    return false;
}

function failAjax(data, status) {
    console.Log(data);
    alert(status);
}


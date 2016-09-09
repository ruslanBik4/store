$(function () {

    divContent = $('#pane');
    divCatalog = $('#catalog_pane');

    divCatalog.load('/category/', afterLoadCatalog);

    divContent.load('/product/new/', function (data,status) {  if (status != 'success') alert(status)} );


    $('header a:not(".fromCatalog"):not([onclick])').click( loadToContent );
    $('a.fromCatalog').click( loadToCatalog );
    $('a.fromCatalog').hover( function() { if (this.style.color == 'red') this.style.color = 'black'; else this.style.color = 'red'; } );
    $('a.fromCatalog').blur( function() { this.style.color = 'black'} );
})

function showForm(this_a) {

    $('nav').append('<div id="loadForm" style="position:static; top:300px; left: 150px; border: dashed 1px red; " > </div>');
    $('#loadForm').load(this_a.href);

    return false;
}
function afterLoadCatalog(data, status) {
    if (status == 'success')
        $('a', this).click( loadToCatalog );
}

function loadToCatalog() {
    divCatalog.load( this.href, afterLoadCatalog );
    return false;
}

function loadToContent() {
    divContent.load( this.href );
    return false;
}

function Validate(thisForm) {

    if (thisForm.id == 'adminLogin') {
        result = true;
        $('input[type!=submit]:visible', thisForm).each(
            function (index) {
                if ( !this.value ) {
                    result = false;
                    alert( 'Заполните поле - ' + this.name);
                    $(this).css( { border: '1px red solid' } ).focus();

                    return false;
                }
                else {
                    $(this).css( { border: '' } );
                }
            }
        );

        if (result && (divPassword.style.display == 'none') )  {
            divPassword.style.display = 'block';
            alert('А теперь введите пароль!');

            return false;
        }

        return result && (confirm('Хотите ли Вы отправить форму?'));
    }
}
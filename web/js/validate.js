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
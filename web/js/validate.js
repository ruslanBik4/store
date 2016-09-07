function Validate(thisForm) {

    if (thisForm.id = 'adminLogin') {
        result = ($('input[name=login]').val() > '') && ($('input[name=password]').val() > '');
        if (!result) {
            alert('Неверные данные');
        }
        return result && (confirm('Хотите ли Вы отправить форму?'));
    }
}
var emailRegex = /([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/;
$(document).ready(function (){

    $('button').on('click',function(e){
        let messages = [];
        let emailValue = $('#email').val();
        let password = $('#password').val();
        let username = $('#username').val();

        if (emailValue !== undefined) {
            if (!emailRegex.test(emailValue))
                messages.push('ایمیل معتبر نمی باشد');
        }
        
        if (password !== undefined) {
            if (password.length < 5)
                messages.push('طول رمز عبور کوتاه است');
        }

        if (username !== undefined) {
            if ( username.length < 1)
                messages.push('نام کاربری اجباریست');
        }
        console.log(messages)
        setErrors(messages);

        if (messages.length > 0) {
            e.preventDefault();
            return;
        }
    });
})

function  setErrors(errors) {
    let errorHtml = '';
    if (errors.length > 0)
    {
        errors.forEach(msg => {
            errorHtml += `<p
                style="background:#3e4649;color: red;text-align: right;direction: rtl;
                padding: 8px;margin:5px;border-radius: 5px;">
            ${msg}</p>`;
        })
    }

    $('#errorContainer').html(errorHtml);
}

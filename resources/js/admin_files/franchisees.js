$(function(){
    $('.js-franchisees-user-handler').click(function (){
        $('.js-franchisees-user-hidden').toggleClass('d-none', !$(this).prop('checked'));
    });
});

function validateForm(){
    var email = $('#epasts').val();
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var columbian = /.*\.(co)$/;
    if(email == ""){
        $('.msg').text('Email address is required');
        return false;
    } else if(!filter.test(email)){
        $('.msg').text('Please provide a valid e-mail address');
        return false;
    }else if(columbian.test(email)){
        $('.msg').text('We are not accepting subscriptions from Colombia emails');
        return false;
    } else if(!document.getElementById('terms').checked){
        $('.msg').text('You must accept the terms and conditions');
        return false;
    } else{
        $('.msg').addClass('hidden');
        return true;
    }
}
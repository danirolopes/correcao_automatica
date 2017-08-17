server = false;
prefixUrl = "";
url = "";

if(server){
    url = "";
}else{
    prefixUrl = "/hum61-1";
    url = "http://localhost";
}

function simpleToastr(title, text, type){
    toastr[type](text, title);
}

function simpleAlert(title, text, type, functionToBeCalled){
    swal({
        title: title,
        text: text,
        type: type
    },
    function (isConfirm) {
        if (isConfirm) {
            if (typeof functionToBeCalled != "undefined"){ 
                functionToBeCalled();
            }
        } 
    });
}

function confirmAlert(title, text, type, confirmButtonText, functionToBeCalled, functionParameters){    
    swal({
        title: title,
        text: text,
        type: type,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: confirmButtonText,
        closeOnConfirm: true,
        closeOnCancel: true
    },
    function (isConfirm) {
        if (isConfirm) {
            if (typeof functionParameters != "undefined"){ 
                functionToBeCalled(functionParameters);
            }else{                
                functionToBeCalled();
            }
        }
    });
}

function portugueseDateToEnglish(str){
    str = str.replace('Janeiro', 'January');
    str = str.replace('Fevereiro', 'February');
    str = str.replace('Março', 'March');
    str = str.replace('Abril', 'April');
    str = str.replace('Maio', 'May');
    str = str.replace('Junho', 'June');
    str = str.replace('Julho', 'July');
    str = str.replace('Agosto', 'August');
    str = str.replace('Setembro', 'September');
    str = str.replace('Outubro', 'October');
    str = str.replace('Novembro', 'November');
    return str.replace('Dezembro', 'December');
}
function printResponse(response){
    if(!server){
        console.log(response);
    }
}
function urlify(inputText) {

    var replacedText, replacePattern1, replacePattern2, replacePattern3;

    //URLs starting with http://, https://, or ftp://
    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
    replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">$1</a>');

    //URLs starting with "www." (without // before it, or it'd re-link the ones done above).
    replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
    replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank">$2</a>');

    //Change email addresses to mailto:: links.
    replacePattern3 = /(([a-zA-Z0-9\-\_\.])+@[a-zA-Z\_]+?(\.[a-zA-Z]{2,6})+)/gim;
    replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');


    // return markdown.toHTML(replacedText);
    return replacedText;
}

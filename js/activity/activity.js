$(document).ready(function(){

    buildFormValidate();

    //Form
    buildActivityFormSubmit();
    buildActivityEditFormSubmit();

    //View Activities
    buildActivityEdit();
    buildActivityDelete();

    $('input[name=name]').on('blur', function(){
        if (typeof localStorage.edit == "undefined"){ 
            checkIfExistsActivity();
        }
    });

});

function checkIfExistsActivity(){
    var name = $('input[name=name]').val();   

    $.ajax({
        success: function(response){
            printResponse(response);
            if(response.exists){
                $('input[name=name]').val('');
                simpleToastr('Hey!', 'Já existe uma ativade igual.', 'warning');         
                return false;
            }else{
                return true;
            }

        },
        error: function(response){
            printResponse(response);
            simpleToastr('Oops!', 'Algo deu errado! Tente novamente.', 'error');
        },
        url: prefixUrl + '/activity/checkIfExistsActivity',
        type: 'POST',
        data: {name: name, 'form-submitted': 'true'},
        dataType: 'json'
    });
}

function buildActivityFormSubmit(){  

    if (typeof localStorage.edit == "undefined"){  
        $('#activity-form').ajaxForm({
            beforeSubmit: function(){
                checkIfExistsActivity();
                $('button[name=submit]').button('loading');
            },
            success: function(response){
                printResponse(response);
                if(response.successful){
                    simpleToastr('Yay!', 'Atividade adicionada com sucesso! :D', 'success');
                }else{
                    simpleToastr('Oops!', 'Algo deu errado! Tente novamente.', 'error');
                } 
                $('button[name=submit]').button('reset');
            },
            error: function(response){
                printResponse(response);            
                simpleToastr('Oops!', 'Algo deu errado! Tente novamente.', 'error');
                $('button[name=submit]').button('reset');
            },
            url: prefixUrl + '/activity/saveNew',
            type: 'POST',
            dataType: 'json',
            clearForm: true,
            resetForm: true
        });
    }

}

function buildActivityEditFormSubmit(){  
    
    if (typeof localStorage.edit != "undefined"){  
        $('input[name=id]').val(localStorage.id);
        $('input[name=name]').val(localStorage.name);
        $('textarea[name=description]').html(localStorage.description);
        $('option[value=' + localStorage.type + ']').attr('selected', 'selected');
        $('input[name=duration]').val(localStorage.duration);
        $('textarea[name=goal]').html(localStorage.goal);
        $('textarea[name=requirement]').html(localStorage.requirement);

        $('button[name=submit]').html('Editar');
        $('button[name=submit]').attr('data-loading-text', 'Editando...');

        $('#activity-form').ajaxForm({
            beforeSubmit: function(){
                checkIfExistsActivity();
                $('button[name=submit]').button('loading');
            },
            success: function(response){
                printResponse(response);
                if(response.successful){
                    lastPage = localStorage.lastPage;
                    delete localStorage.lastPage; 
                    simpleAlert('Yay!', 'Atividade editada com sucesso! :D', 'success', function(){window.location.href = lastPage;});
                }else{
                    simpleToastr('Oops!', 'Algo deu errado! Tente editar novamente.', 'error');
                } 
                $('button[name=submit]').button('reset');
            },
            error: function(response){
                printResponse(response);           
                simpleToastr('Oops!', 'Algo deu errado! Tente editar novamente.', 'error');
                $('button[name=submit]').button('reset');
            },
            url: prefixUrl + '/activity/edit',
            type: 'POST',
            dataType: 'json',
            clearForm: true,
            resetForm: true
        });

        delete localStorage.edit; 
        delete localStorage.id; 
        delete localStorage.name; 
        delete localStorage.description; 
        delete localStorage.type; 
        delete localStorage.duration; 
        delete localStorage.goal; 
        delete localStorage.requirement;  
    }

}

function buildFormValidate(){
    $("#activity-form").validate({
         rules: {
             name: {
                 required: true,
                 maxlength: 50
             },
             description: {
                 required: true
             },
             especificacoes: {
                 required: true
             },
             type: {
                 required: true
             },
             duration: {
                 required: true,
                 digits: true
             },
             goal: {
                 required: true
             }
        }
    });
}

function buildActivityEdit(){
    $('.edit').on('click.edit', function(e){
        e.preventDefault();
        var id = $(this).attr('activity');
        editActivity(id);
    });
}

function buildActivityDelete(){
    $('.delete').on('click.delete', function(e){
        e.preventDefault();
        var id = $(this).attr('activity');
        confirmAlert('Tem certeza?', 'A atividade será apagada pra sempre!', 'warning', 'Tenho certeza!', deleteActivity, id);
    });
}

function editActivity(id){

    $.ajax({
        success: function(response){
            printResponse(response);
            if(response.successful){
                localStorage.edit = true;
                localStorage.id = response.id;
                localStorage.name = response.name;
                localStorage.description = response.description;
                localStorage.type = response.type;
                localStorage.duration = response.duration;
                localStorage.goal = response.goal;
                localStorage.requirement = response.requirement;
                localStorage.lastPage = window.location.href.split('/').last();
                window.location.href = "edit";
            }

        },
        error: function(response){
            printResponse(response);
            simpleToastr('Oops!', 'Algo deu errado! Tente editar novamente.', 'error');
        },
        url: prefixUrl + '/activity/selectById',
        type: 'POST',
        data: {id: id, 'form-submitted': 'true'},
        dataType: 'json'
    });
}

function deleteActivity(id){

    $.ajax({
        success: function(response){
            printResponse(response);
            if(response.successful){
                simpleToastr('Yay!', 'Atividade foi excluida por toda eternidade!', 'success');  
                $('div[activity=' + id + ']').remove();
            }

        },
        error: function(response){
            printResponse(response);
            simpleToastr('Oops!', 'Algo deu errado! Tente deletar novamente.', 'error');
        },
        url: prefixUrl + '/activity/delete',
        type: 'POST',
        data: {id: id, 'form-submitted': 'true'},
        dataType: 'json'
    });
}
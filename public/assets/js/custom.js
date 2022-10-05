Notiflix.Loading.pulse();
$(document).ready(function () {
    Notiflix.Loading.remove()

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let url = '',
        dataTable = $('#dataTable'),
        formData;


    //============================ APPLICATION FUNCTIONS =======================================

    function pushToastMessage(msg, code) {

        if (code === 200) {
            Notiflix.Notify.success(msg);
        } else {
            Notiflix.Notify.failure(msg);
        }
    }


    function submitFormData(url, form, withDatatable = false, triggerClass = null){

        Notiflix.Block.pulse(triggerClass);

        $.ajax({

            url: url,
            method: 'POST',
            data: form,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,

        }).done((response) => {

            if(response.code === 200){

                pushToastMessage(response.msg, response.code);

                if(withDatatable === true){

                    $('#dataTable').DataTable().ajax.reload();

                }

                Notiflix.Block.remove(triggerClass);

                setTimeout(function () {

                    $(triggerClass).closest('.modal').modal('hide');

                }, 1000)

                $(triggerClass).trigger("reset");

                // $("select").val(null).trigger("change");

            }else{

                pushToastMessage(response.msg, response.code)

                Notiflix.Block.remove(triggerClass);
            }
        })
    }


    function promptDialog(url, status = null){
        Notiflix.Block.pulse('#dataTable');

        let msg = 'You won\'t be able to revert this!';

        if(status === 'change'){
            msg = 'Are you sure you want to change the status of this number?'
        }

        Notiflix.Confirm.show(
            'Are You Sure?',
            msg,
            'Yes',
            'No',
            function okCb() {
                $.post(url, function (response){
                    if(response.code === 200){
                        Notiflix.Report.success(
                            'Success',
                            response.msg,
                            'Okay',
                        );
                        dataTable.DataTable().ajax.reload();

                    }else{
                        pushToastMessage(response.msg, response.code)
                    }
                });

            },
            {
                width: '320px',
                borderRadius: '8px',
            },
        );
        Notiflix.Block.remove('#dataTable');

    }

    function toggleEditModal(editModalElement, editModalForm, editUrl){

        $(editModalForm).attr('action', editUrl)

        $(editModalElement).modal('show');

    }

    $('.addItem').submit(function (e){
        e.preventDefault();

        url = $(this).attr('action');

        let type = $(this).attr('title');

        formData = new FormData(this);

        submitFormData(url, formData, true, '.addItem');
    });


    dataTable.on('click', '.previewBtn', function (e){
        e.preventDefault();

        Notiflix.Block.pulse('#dataTable');

        $.post($(this).attr('href'), function (response) {
            $('#editNumber').val(response.data.number);

            if(response.data.is_whitelist == 1){
                $('#editWhitelist').val('yes').trigger('change')
            }else{
                $('#editWhitelist').val('no').trigger('change')
            }

            Notiflix.Block.remove('#dataTable');

            toggleEditModal('#editNumberModal', '#editNumberForm', response.url)
        })

    })

    dataTable.on('click', '.deleteNumber', function (e){
        e.preventDefault();
        promptDialog($(this).attr('href'));
    });

    dataTable.on('click', '.changeStatus', function (e){
        e.preventDefault();
        promptDialog($(this).attr('href'), 'change');
    });

});

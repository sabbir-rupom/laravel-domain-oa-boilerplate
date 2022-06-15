const { trim } = require("lodash");

$(function ()
{
    'use strict'

    $('form.needs-validation').each(function ()
    {

        $(this).validate();

        let rInputs = $(this).find('[required]'), $this = $(this);

        for (const i in rInputs) {
            if (Object.hasOwnProperty.call(rInputs, i)) {
                let e = rInputs[i];
                if (e instanceof HTMLInputElement) {
                    $(e).on('input', function ()
                    {
                        if ($(this).val() === '') {
                            $this.find('[type="submit"]').attr('disabled', 'disabled')
                        } else {
                            $this.find('[type="submit"]').removeAttr('disabled');
                        }
                    })
                } else if (e instanceof HTMLSelectElement) {
                    $(e).on('change', function ()
                    {
                        if ($(this).val() === '') {
                            $this.find('[type="submit"]').attr('disabled', 'disabled')
                        } else {
                            $this.find('[type="submit"]').removeAttr('disabled');
                        }
                    })

                }

            }
        }
    })


    $(document).on('submit', 'form', function (e)
    {
        e.preventDefault();

        let url = $(this).attr('action'),
            formData = new FormData(this),
            method = $(this).attr('method');
        const param = Object.fromEntries(formData);

        let res = callAjax(url, param, method);

        if (res) {

            $(this).find('.form-reset').trigger('click');
        }

    });

    $(document).on('keyup', '.search > input', function ()
    {
        let value = $(this).val();

        let url = $(this).data('url');

        callAjax(url, { term: value }, 'post', this);

    });

    $(document).on('click', '.form-reset', function ()
    {
        let url = $(this).data('url');

        if (url) {
            callAjax(url, {}, 'GET', this);
        } else {
            let parentForm = $(this).parents('form');
            parentForm.trigger('reset')
            if (parentForm.hasClass('needs-validation')) {
                parentForm.find('[type="submit"]').attr('disabled', 'disabled');

                parentForm.find('input').removeClass('error');
                parentForm.find('label.error').remove();
            }
        }

    });

    $(document).on('click', '.btn-action', function ()
    {
        let url = $(this).data('url'),
            method = trim($(this).data('method'));

        if ($(this).hasClass('need-confirmation')) {

            let confirm = handleConfirmation(this);

            if (confirm instanceof Error) {
                return;
            } else {
                confirm.then(value =>
                {
                    if (value) {
                        callAjax(url, {}, method, this);
                    }
                });
            }
        } else {
            callAjax(url, {}, method, this);
        }

    });

});

function callAjax(url, param, method, obj = null)
{
    const response = fetchCall(url, param, method, null, '');

    if (response instanceof Error) {
        toastr.error('Ajax request failed', 'Sorry!');
        return false;
    } else {
        response.then(json =>
        {
            if (json.success) {
                if (json.message.length > 0) {
                    toastr.success(json.message, 'Success!');
                }

                if (json.html) {
                    let action = $(obj).data('action');
                    if (action === 'form') {
                        $('.product-form').html(json.data);
                    } else {
                        $('.product-list').html(json.data);
                    }
                } else {

                    if (obj !== null && method.toUpperCase() === 'DELETE') {
                        $(obj).parents('tr').remove();
                        let c = parseInt($('.item-count').html());
                        $('.item-count').html(c - 1);

                        $('form').trigger('reset');
                    }
                }

            } else {
                toastr.error(json.message, 'Error!');
            }

        });

        return true
    }
}
$(function ()
{
    console.log('app.js is working');
});

/**
 * Process & handle fetch call request asynchronously
 *
 * @param {string} url
 * @param {array|object} data
 * @param {string} method
 * @param {array|object} headers
 * @returns {object} Fetch object
 */
async function fetchCall(url, data = [], method = 'POST', headers, callback = '')
{
    let ajaxUrl = (url.indexOf("http://") == 0 || url.indexOf("https://") == 0) ? url : $('#baseUrl').val() + url;

    var fetchResult = null,
        requestHeaders = {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'url': ajaxUrl,
            "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
        };

    if (headers) {
        for (var key in headers) {
            if (key === 'token') {
                requestHeaders['X-CSRF-Token'] = headers[key];
            } else {
                requestHeaders[key] = headers[key];
            }
        }
    }

    var sendObj = {
        method: method,
        headers: requestHeaders,
        credentials: "same-origin",
    };

    if (method == '' || typeof method === undefined) {
        method = 'POST';
    }

    if (method.toUpperCase() !== 'GET') {
        sendObj.body = JSON.stringify(data);
    }

    try {
        fetchResult = await fetch(ajaxUrl, sendObj);

        const result = await fetchResult.json();

        if (fetchResult.ok) {

            if (result['refresh-csrf']) {
                $('meta[name="csrf-token"]').attr('content', result['refresh-csrf'])
            }
            if (callback != '') {
                (new Function('return ' + callback)())();
                return true;
            } else {
                return result;
            }
        } else {
            let message = result.message.replace(/\n/g, ' ') || 'Something went wrong';
            return new Error(message);
        }
    } catch (err) {

        console.log(err.message);

        return new Error('Something went wrong');
    }
}

/**
 * Sweet alert confirmation dialogue handle promise async
 *
 * @param {object} obj Dom element
 * @returns
 */
async function handleConfirmation(obj)
{
    return new Promise(resolve =>
    {
        let title = text = confirmText = '';

        if (obj instanceof HTMLElement) {
            title = $(obj).data('title'),
                text = $(obj).data('text'),
                confirmText = $(obj).data('confirm_text');
        }

        Swal.fire({
            title: title ? title : 'Are you sure?',
            text: text ? text : "Your data will be lost!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirmText ? confirmText : 'Yes, Proceed'
        }).then((result) =>
        {
            if (result.value) {
                resolve(true);
            } else {
                resolve(false);
            }
        });
    });
}
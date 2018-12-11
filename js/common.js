var common = {
    request: {
        fnAjax: function(sUrl, sType, sDataType, oData, fnBeforeSend, fnSuccess, fnError) {
            return $.ajax({
                url: sUrl,
                type: sType,
                dataType: sDataType,
                data: oData,
                beforeSend: function() {
                    if (typeof fnBeforeSend == 'function') {
                        fnBeforeSend();
                    }
                },
                success: function(response) {
                    if (typeof fnSuccess == 'function') {
                        fnSuccess(response);
                    }
                },
                error: function(xhr) {
                    if (xhr.responseText) {
                        console.log(xhr.responseText);
                    }
                    if (typeof fnError == 'function') {
                        fnError(xhr);
                    }
                }
            });
        }
    }
};

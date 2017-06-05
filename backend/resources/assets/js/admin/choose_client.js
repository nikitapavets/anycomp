(() => {

    const chooseClientField = $('#chooseClientField');
    const clients = $('.choose-client__client');
    const notFound = $('#chooseClientNotFound');
    const clientInfo = $('#clientInfo');
    const addOrder = $('#chooseClientAddOrder');

    // pressed key in search clients field
    chooseClientField.keyup((event) => {
        searchClient(event.target.value);
    });

    $.each(clients, (number, client) => {
        $(client).click(() => {
            setSelectedClientData(client);

        })
    });

    const setSelectedClientData = (currentClient) => {
        $.each(clients, (number, client) => {
            $(client).removeClass('active');
        });
        $(currentClient).addClass('active');
        clientInfo.find('#clientInfoSecondName').text($(currentClient).data('second_name') ? $(currentClient).data('second_name') : '-');
        clientInfo.find('#clientInfoFirstName').text($(currentClient).data('first_name') ? $(currentClient).data('first_name') : '-');
        clientInfo.find('#clientInfoFatherName').text($(currentClient).data('father_name') ? $(currentClient).data('father_name') : '-');
        clientInfo.find('#clientInfoOrganization').text($(currentClient).data('organization') ? $(currentClient).data('organization') : '-');
        clientInfo.find('#clientInfoMobilePhone').text($(currentClient).data('mobile_phone') ? $(currentClient).data('mobile_phone') : '-');
        clientInfo.find('#clientInfoHomePhone').text($(currentClient).data('home_phone') ? $(currentClient).data('home_phone') : '-');
        clientInfo.find('#clientInfoAddress').text($(currentClient).data('address') ? $(currentClient).data('address') : '-');
        clientInfo.find('#clientInfoRepairs').text($(currentClient).data('repairs') ? $(currentClient).data('repairs') : '-');
        clientInfo.find('#clientInfoLastRepair').text($(currentClient).data('last-repair') ? $(currentClient).data('last-repair') : '-');
        addOrder.attr('href', addOrder.attr('href').substr(0, addOrder.attr('href').indexOf('client_id=') + 'client_id='.length) + $(currentClient).data('id'));
    };

    const searchClient = (searchValue) => {
        searchValue = searchValue.toLowerCase();
        let searchStatus = -1;

        $.each(clients, (number, client) => {
            let searchElementStatus = -1;

            // search by full name
            const firstName = $(client).data('first_name').toLowerCase();
            const secondName = $(client).data('second_name').toLowerCase();
            const fatherName = $(client).data('father_name').toLowerCase();
            const name = `${secondName} ${firstName} ${fatherName}`;
            searchElementStatus = name.indexOf(searchValue);

            if (searchElementStatus !== -1) {
                clients.eq(number).removeClass('hidden');
                searchStatus === -1 ? setSelectedClientData(client) : null;
                searchStatus++;
            } else {
                clients.eq(number).addClass('hidden');
            }
        });

        if (searchStatus === -1) {
            notFound.addClass('active');
            notFound.removeClass('hidden');
        } else {
            notFound.removeClass('active');
            notFound.addClass('hidden');
        }
    };
})();




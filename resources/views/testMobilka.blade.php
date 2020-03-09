<!DOCTYPE html>
<head>

    <title>Status</title>
</head>

<body>
<div class="card-body p-0 pb-3 text-center">
    <button class="btn" onclick="submitForm()">submit</button>
    <button class="btn" onclick="submitForm1()">submitCard</button>
    <button class="btn" onclick="submitForm3()">URL</button>

</div>
<div class="loader"></div>

</body>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const token = urlParams.get('token');
    function submitForm() {
        var myHeaders = new Headers();
        myHeaders.append("Authorization", `Bearer ${token}`);
        var requestOptions = {
            method: 'GET',
            headers: myHeaders,
            redirect: 'follow'
        };

        // fetch("http://192.168.0.101:8000/api/v1/pay?subscription_type_id=1", requestOptions)
        fetch("https://tensend.me/api/v1/pay?subscription_type_id=1", requestOptions)

            .then(result => result.text()).then(result => {

            document.open();
            document.write(result);
            document.close();


        })

            .catch(error => console.log('error', error));

    }

    function submitForm1() {
        var myHeaders = new Headers();
        myHeaders.append("Authorization", `Bearer ${token}`);

        var requestOptions = {
            method: 'GET',
            headers: myHeaders,
            redirect: 'follow'
        };
        // fetch("http://127.0.0.1:8000/api/v1/saveCard", requestOptions)
        fetch("https://tensend.me/api/v1/saveCard", requestOptions)

            .then(result => result.text()).then(result => {

            document.open();
            document.write(result);
            document.close();


        })

            .catch(error => console.log('error', error));

    }


    function submitForm3() {
        const urlParams = new URLSearchParams(window.location.search);


        var url = new URL(window.location.href);

        var query_string = url.search;

        var search_params = new URLSearchParams(query_string);

        search_params.append('id', '101');

        search_params.append('id', '102');

        url.search = search_params.toString();

        var new_url = url.toString();

        // console.log(new_url);
        window.location.href = new_url;
    }
</script>





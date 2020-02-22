<!DOCTYPE html>
<head>
    <title>Status</title>
</head>
<body>
<div class="card-body p-0 pb-3 text-center">
    <button class="btn" onclick="submitForm()">submit</button>
    <button class="btn" onclick="submitForm1()">submitCard</button>
</div>

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
        // fetch("http://192.168.0.101:8000/api/v1/saveCard", requestOptions)
        fetch("https://tensend.me/api/v1/saveCard", requestOptions)

            .then(result => result.text()).then(result => {

            document.open();
            document.write(result);
            document.close();


        })

            .catch(error => console.log('error', error));

    }
</script>




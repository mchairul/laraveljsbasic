@extends('layouts.main')

@section('css')

@endsection

@section('main-content')
<form action="">
    <table>
        <tr>
            <td>User </td><td>:</td><td> <input type="text" id="user" name="user"></td>
        </tr>
        <tr>
            <td>Pesan </td><td>:</td><td><textarea name="description" id="description" cols="30" rows="10" onpaste="parseClipboardData()"></textarea></td>
        </tr>
        <tr>
            <td></td><td></td><td>
                <div class="container">
                </div>
            </td>
        </tr>
        <tr>
            <td></td><td></td><td> <button type="button" onclick="submitTicket()">Submit</button></td>
        </tr>
    <table>
</form>

@endsection

@section('js')
<script>
    let csrf = '{{ csrf_token() }}';
    let base64Image = '';

    async function parseClipboardData() {
        var items = await navigator.clipboard.read().catch((err) => {
            console.error(err);
        });
        console.log("items:", items);
        for (let item of items) {
            console.log("item.type", item.types);

            for (let type of item.types) {

                if (type.startsWith("image/")) {

                    item.getType(type).then((imageBlob) => {

                        console.log(imageBlob);
                        var reader = new FileReader();
                        reader.readAsDataURL(imageBlob);

                        reader.onloadend = function () {
                            var base64String = reader.result;
                            base64Image = base64String;
                            console.log('Base64 String - ', base64String);
                            var image = `<img src="${base64String}" width="300px"/>`;
                            $container.innerHTML = image;
                        }
                    });
                }
            }
        }
    }
    var $container = document.querySelector(".container");

    function submitTicket() {
        var user = document.getElementById('user').value;
        var description = document.getElementById('description').value;

        let formData = new FormData();
        formData.append('user', user);
        formData.append('description', description);
        formData.append('att', base64Image);
        formData.append('_token', csrf);

        postData('addtickets', formData);

    }

    async function postData(url = '', data) {
        var response = await fetch(url, {
            method: 'POST',
            body: data
        });
        return response.json();
    }

</script>
@endsection
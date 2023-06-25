@extends('layouts.main')

@section('css')

@endsection

@section('main-content')
<form action="postdom" method="POST" id="form">
    @csrf
    nama : <input type="text" name="nama" required><br><br>
    Pesanan :
    <div id="divpesanan">
        <div id="inputpesanan">
            menu : <input type="text" name="menu[]"> harga : <input type="text" name="harga[]">
        </div>
    </div>
    <br>
    <button onclick="addPesanan()" type="button">tambah</button>

    <br><br>
    <input type="submit" value="Simpan">
</form>
@endsection

@section('js')
<script>
    var idDiv = 1;
    function addPesanan() {
        var divPesanan = document.getElementById('inputpesanan');
        //console.log(divPesanan);
        var clone = divPesanan.cloneNode(true);
        //console.log(typeof clone);
        var strHtml = '<div id="inputpesanan'+idDiv+'">menu : <input type="text" name="menu[]"> harga : <input type="text" name="harga[]"><button type="button" onclick="removeElementId('+idDiv+')">x</button></div>';
        document.getElementById("divpesanan").insertAdjacentHTML('beforeend', strHtml);
        idDiv++;
    }

    function removeElementId(id) {
        var ele = document.getElementById('inputpesanan' + id);
        ele.remove();
    }

    //handle event form ketika disubmit
    form.onsubmit = async (e) => {
        //cegah form untuk submit
        e.preventDefault();

        //fetch ke server
        let response = await fetch('postdom', {
            method: 'POST',
            body: new FormData(form)
        });

        //json 
        let result = await response.json();

        //redirect
        window.location.href = 'struk/?id=' + result.id;
    };
</script>
@endsection
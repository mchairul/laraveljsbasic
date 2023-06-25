@extends('layouts.main')

@section('css')
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    body {
    margin: 0 auto;
    max-width: 800px;
    padding: 0 20px;
    }
    .container {
    border: 2px solid #dedede;
    background-color: #f1f1f1;
    border-radius: 5px;
    padding: 10px;
    margin: 10px 0;
    }

    .darker {
    border-color: #ccc;
    background-color: #ddd;
    }

    .container::after {
    content: "";
    clear: both;
    display: table;
    }

    .container img {
    float: left;
    max-width: 60px;
    width: 100%;
    margin-right: 20px;
    border-radius: 50%;
    }

    .container img.right {
    float: right;
    margin-left: 20px;
    margin-right:0;
    }

    .time-right {
    float: right;
    color: #aaa;
    }

    .time-left {
    float: left;
    color: #999;
    }
    #chat{
      margin-bottom:20%;
    }
</style>
@endsection

@section('main-content')
<h2>Chat Messages</h2>

<div id="chat">
  @forelse ($chats as $chat)
  @if($chat->user === $user)
  <div class="container darker">
      <img src="{{ asset('pic.svg') }}" alt="Avatar" class="right" style="width:100%;">
      <p>{!! $chat->chat !!}</p>
      <span class="time-left">{{ $chat->tanggal }}</span>
  </div>
  @else
  <div class="container">
    <img src="{{ asset('pic.svg') }}" alt="Avatar" style="width:100%;">
    <p>{!! $chat->chat !!}</p>
    <span class="time-right">{{ $chat->tanggal }}</span>
  </div>
  @endif
  @empty
  <p>no data</p>
  @endforelse
</div>

<div style="position: fixed;
    bottom: 15px;
    width: 50%;">
    <input type="text" style="width:80%;height:50px;" id="isichat" onpaste="pasteImage()">
    <button type="button" onclick="sendChat()">Send</button>
</div>
@endsection

@section('js')
<script>
  var csrf = '{{ csrf_token() }}';
  var user = '{{ $user }}';
  var idconv = '{{ $idconv }}';
  var divChat = document.getElementById('chat');

  setInterval(function () {
    getChat()
  }, 3000);

  function sendChat() {
    var isiChat = document.getElementById('isichat').value;
    //alert(isiChat);
    if(isiChat != '') {
      //form ala javascript
      let formData = new FormData();
      formData.append('user', user);
      formData.append('idconv', idconv);
      formData.append('chat', isiChat);
      formData.append('_token', csrf);

      postData('{{ route("addchat") }}', formData).then((data) => {

        var currentdate = new Date(); 
        var datetime =  (currentdate.getFullYear()+1)  + "-" 
                        + currentdate.getMonth() + "-"
                        + currentdate.getDate() + "-"
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds();
            console.log(data);

            csrf = data.csrf;

            //alert('success kirim chat');

            var divChat = document.getElementById('chat');
            var strChat = '<div class="container darker">';
            strChat +=  '<img src="{{ asset("pic.svg") }}" alt="Avatar" class="right" style="width:100%;">';
            strChat +=  '<p>' + isiChat + '</p>';
            strChat +=  '<span class="time-left">' + datetime + '</span>';
            strChat += '</div></div>';
          divChat.insertAdjacentHTML( 'beforeend',strChat);
          document.getElementById('isichat').value = '';

      });

    }
  }


  function getChat() {
    let formData = new FormData();
    formData.append('idconv', idconv);
    formData.append('user', user);
    formData.append('_token', csrf);
    postData('{{ route("getchat") }}', formData).then((data) => {
      data.chat.forEach(function(currentValue, index, arr){
        //console.log(currentValue);
        var classTime = 'time-right';
        var addContainer = '';
        var classAvatar = '';
        if(currentValue.user == user) {
          classTime = 'time-left';
          addContainer = 'darker';
          classAvatar = 'class="right"';
        }
        var strChat = '<div class="container '+addContainer+'">';
        strChat +=  '<img src="{{ asset("pic.svg") }}" alt="Avatar" '+classAvatar+' style="width:100%;">';
        strChat +=  '<p>' + currentValue.chat + '</p>';
        strChat +=  '<span class="'+classTime+'">' + currentValue.tanggal + '</span>';
        strChat += '</div></div>';
        divChat.insertAdjacentHTML( 'beforeend',strChat);
        
      });
    });
  }

  async function pasteImage() {
        var items = await navigator.clipboard.read().catch((err) => {
            console.error(err);
        });
        console.log("items:", items);

        //iterasi items yang didapat dari clipboard data
        for (let item of items) {
            console.log("item.type", item.types);

            //iterasi types
            for (let type of item.types) {

                //jika awalan type dimulai dengan 'image/'
                if (type.startsWith("image/")) {

                    item.getType(type).then((imageBlob) => {

                        console.log(imageBlob);

                        var reader = new FileReader();

                        //ubah blob jadi base64
                        reader.readAsDataURL(imageBlob);

                        //callback ketika reader selesai (pada onloadend)
                        reader.onloadend = function () {
                            var base64String = reader.result;
                            base64Image = base64String;
                            console.log('Base64 String - ', base64String);
                            var image = `<img src="${base64String}" width="300px"/>`;
                            //$container.innerHTML = image;

                            var formData = new FormData();
                            formData.append('user', user);
                            formData.append('idconv', idconv);
                            formData.append('chat', image);
                            formData.append('_token', csrf);


                            postData('{{ route("addchat") }}', formData).then((data) => {

                              var currentdate = new Date(); 
                              var datetime =  (currentdate.getFullYear()+1)  + "-" 
                                            + currentdate.getMonth() + "-"
                                            + currentdate.getHours() + ":"  
                                            + currentdate.getMinutes() + ":" 
                                            + currentdate.getSeconds();
                                console.log(data);

                                csrf = data.csrf;

                                var divChat = document.getElementById('chat');
                                var strChat = '<div class="container darker">';
                                strChat +=  '<img src="{{ asset("pic.svg") }}" alt="Avatar" class="right" style="width:100%;">';
                                strChat +=  '<p>' + image + '</p>';
                                strChat +=  '<span class="time-left">' + datetime + '</span>';
                                strChat += '</div></div>';
                              divChat.insertAdjacentHTML( 'beforeend',strChat);
                              document.getElementById('isichat').value = '';

                            });
                        }
                    });
                }
            }
        }
    }

  //post data dengan fetch
  async function postData(url = '', data) {
        var response = await fetch(url, {
            method: 'POST',
            body: data
        });
        return response.json();
  }
</script>
@endsection
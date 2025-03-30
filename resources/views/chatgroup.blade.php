<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="current-user-id" content="{{ auth()->id() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/js/app.js'])
</head>
<body>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .chat-container {
            width: 50%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .message {
            padding: 10px 15px;
            margin: 10px 0;
            border-radius: 20px;
            max-width: 70%;
            display: inline-block;
            clear: both;
        }

        .my-message {
            background: #4CAF50;
            color: white;
            float: right;
            text-align: right;
        }

        .other-message {
            background: #ddd;
            color: black;
            float: left;
            text-align: left;
        }

        .username {
            font-size: 12px;
            color: #777;
            display: block;
            margin-bottom: 5px;
        }

        .clearfix {
            clear: both;
        }
    </style>
    <div class="container mt-5">
       
        <div class="chat-container">
    <h2>رسائل الجروب</h2>
    <div id="chat-box" class="border p-3" style="height: 400px; overflow-y: scroll;">
    @foreach($messages as $message)
        @php $isMyMessage = $message->user_id == auth()->id(); @endphp
        <div class="message {{ $isMyMessage ? 'my-message' : 'other-message' }}">
            <span class="username">{{ $message->user->name }}</span>
            {{ $message->message }}
        </div>
        <div class="clearfix"></div>
    @endforeach
</div>
        <div id="typing-indicator" class="mt-2 text-muted" style="display: none;"> is typing...</div>
        <form id="message-form" class="mt-3">
            @csrf
            <div class="input-group">
                <input type="text" id="message-input" class="form-control" placeholder="Type a message...">
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
    </div>



    
    <script>


document.addEventListener('DOMContentLoaded', function () {
          var groupId = {{ $groupId }};
          let messageInput = document.getElementById('message-input');
          let chatBox = document.getElementById('chat-box');
          let messageForm = document.getElementById('message-form');
          const currentUserId = document.querySelector('meta[name="current-user-id"]').content;
           // subscribe to chat channel
           window.Echo.channel('group.'+groupId)
                        .listen('GrouptoMessage', (e) => {
                            // show the message
                  
                            console.log("📩 Received event data:", e); // ✅ تأكد من البيانات المستلمة
        
        if (!e.message) {
            console.error("⚠️ ERROR: Received undefined message!");
            return;
        }

        const messageDiv = document.createElement('div');
        messageDiv.className = e.user_id === currentUserId ? 'mb-2 text-end' : 'mb-2 text-start';
        messageDiv.innerHTML = `
            <span class="badge  ${e.user_id === currentUserId ? 'message  other-message' : 'message my-message '}">
                ${e.user}: ${e.message}
            </span>
        `;
        chatBox.appendChild(messageDiv);
        chatBox.scrollTop = chatBox.scrollHeight;
        
                        });

                     

            messageForm.addEventListener('submit', function (e) { 
                e.preventDefault();
                const message = messageInput.value;

                if (message) {
                    fetch(`/chat/${groupId}/sendtogroup`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ message })
                    });
                
                    // const messageDiv = document.createElement('div');
                    // messageDiv.className = 'mb-2 ';
                    // messageDiv.innerHTML = `<span >${message}</span>`;
                    // chatBox.appendChild(messageDiv);
                    // chatBox.scrollTop = chatBox.scrollHeight;
                    // messageInput.value = '';
                }
            });

        });
    </script>




</body>
    </html>
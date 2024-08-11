@extends('layouts.pet-owner.layout')

@section('title', 'Chat')

@section('content')
   <section class="p-4">
      <h1 class="text-xl font-bold text-center mb-4">Chat with Admin</h1>
      <div id="chat-box" class="h-72 overflow-y-auto border p-4 bg-gray-50 rounded-md mb-4">
      </div>

      <form id="chat-form" class="flex">
         @csrf
         <input type="hidden" name="sessionId" id="sessionId" value="{{ $sessionId }}">
         <input type="text" name="message" id="message" placeholder="Type a message"
            class="flex-grow p-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
         <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600">Send</button>
      </form>
   </section>
@endsection

@section('js-footer')
<script>
   function fetchMessages(scrollToBottom=false) {
         $.ajax({
            url: "{{ route("fetch-message", ':id') }}".replace(":id", $('#sessionId').val()),
            method: 'GET',
            success: function(data) {
               const chatBox = $('#chat-box');
               chatBox.empty();
               const userId = "{{ auth()->user()->id }}";

               data.forEach(msg => {
                  const messageClass =  msg.user_id === userId ? 'bg-green-200 ms-auto text-end': 'bg-blue-200 text-start';
                  const sender = msg.user_id === userId  ? 'You' : 'Admin';
                  chatBox.append(`
                            <div class="mb-2 p-2 rounded-md ${messageClass} w-fit max-w-[50%]">
                                ${msg.message}
                            </div>
                        `);
               });

               if(scrollToBottom) {
                  chatBox.scrollTop(chatBox[0].scrollHeight);
               }
            }
         });
      }
   $(document).ready(function() {
       fetchMessages(true);
       setInterval(fetchMessages, 2000);

       $('#chat-form').submit(function(e) {
           e.preventDefault();
           $.ajax({
               url: '{{ route("send-message") }}',
               method: 'POST',
               data: $(this).serialize(),
               success: function(response) {
                   $('#message').val('');
                   fetchMessages(true);
               }
           });
       });
   });
</script>
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-[#1A2B42] leading-tight">Conversation avec {{ $user->name }}</h2>
                <p class="text-sm text-[#6B7280]">Échangez des messages en temps réel.</p>
            </div>
            <a href="{{ route('messages.index') }}" class="inline-flex items-center justify-center rounded-full border border-[#1A2B42] px-4 py-2 text-sm font-semibold text-[#1A2B42] hover:bg-[#1A2B42] hover:text-white">Retour aux conversations</a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl space-y-6 px-4 sm:px-6 lg:px-8">
            <div id="chat-box" class="space-y-4 rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                @foreach($messages as $message)
                    <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[80%] rounded-3xl px-5 py-4 text-sm {{ $message->sender_id === auth()->id() ? 'bg-[#1A2B42] text-white' : 'bg-[#F3F4F6] text-[#1A2B42]' }}">
                            <p>{{ $message->content }}</p>
                            <p class="mt-2 text-xs text-white/70 {{ $message->sender_id === auth()->id() ? 'text-white/70' : 'text-[#475569]' }}">{{ $message->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <form id="message-form" action="{{ route('messages.store', $user) }}" class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                @csrf
                <div class="space-y-4">
                    <textarea name="content" rows="4" class="block w-full rounded-3xl border border-gray-200 bg-[#F8FAFC] px-4 py-3 text-sm text-[#1A2B42] focus:border-[#1A2B42] focus:outline-none" placeholder="Écrire un message..."></textarea>
                    <div class="flex items-center justify-end gap-3">
                        <button type="submit" class="inline-flex items-center justify-center rounded-full bg-[#1A2B42] px-6 py-3 text-sm font-semibold text-white hover:bg-[#15203a]">Envoyer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('message-form').addEventListener('submit', async function(event) {
            event.preventDefault();

            const form = event.target;
            const action = form.action;
            const formData = new FormData(form);
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const response = await fetch(action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                },
                body: formData,
            });

            if (!response.ok) {
                return;
            }

            const result = await response.json();
            const chatBox = document.getElementById('chat-box');
            const messageRow = document.createElement('div');
            messageRow.className = 'flex justify-end';
            messageRow.innerHTML = `
                <div class="max-w-[80%] rounded-3xl bg-[#1A2B42] px-5 py-4 text-sm text-white">
                    <p>${result.data.content}</p>
                    <p class="mt-2 text-xs text-white/70">${result.data.created_at}</p>
                </div>
            `;

            chatBox.appendChild(messageRow);
            form.reset();
            chatBox.scrollTop = chatBox.scrollHeight;
        });
    </script>
</x-app-layout>

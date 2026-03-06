<div>

<!-- Floating Button -->
<button id="chat-toggle"
class="fixed bottom-6 right-6 bg-blue-600 text-white p-4 rounded-full shadow-lg">
    <i class="fas fa-comment"></i>
</button>

<!-- Chat Window -->
<div id="chat-window"
class="hidden fixed bottom-20 right-6 w-80 bg-white shadow-xl rounded-xl flex flex-col">

    <div class="bg-blue-600 text-white p-3 rounded-t-xl flex justify-between">
        <span>Assistant</span>
        <button id="chat-close">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div id="chat-messages"
    class="h-80 overflow-y-auto p-3 space-y-2 bg-gray-50"></div>

    <div class="p-2 border-t flex">
        <input id="chat-input"
        maxlength="200"
        type="text"
        placeholder="Ask something..."
        class="flex-1 border rounded px-2 py-1 text-sm">

        <button id="chat-send"
        class="ml-2 bg-blue-600 text-white px-3 rounded">
            Send
        </button>
    </div>

</div>

</div>

@once
<script>

document.addEventListener("DOMContentLoaded", () => {

const toggle = document.getElementById("chat-toggle");
const windowChat = document.getElementById("chat-window");
const closeBtn = document.getElementById("chat-close");
const sendBtn = document.getElementById("chat-send");
const input = document.getElementById("chat-input");
const messages = document.getElementById("chat-messages");

toggle.onclick = () => windowChat.classList.toggle("hidden");
closeBtn.onclick = () => windowChat.classList.add("hidden");

sendBtn.onclick = sendMessage;

input.addEventListener("keypress", e => {
    if (e.key === "Enter") sendMessage();
});

function appendMessage(text, type) {

    const div = document.createElement("div");

    div.className = type === "user"
        ? "text-right"
        : "text-left";

    div.innerHTML = `
        <span class="inline-block px-3 py-2 rounded-lg text-sm
        ${type === "user"
        ? "bg-blue-600 text-white"
        : "bg-gray-200 text-black"}">
        ${text}
        </span>
    `;

    messages.appendChild(div);
    messages.scrollTop = messages.scrollHeight;
}

async function sendMessage() {

    const question = input.value.trim();
    if (!question) return;

    appendMessage(question, "user");
    input.value = "";

    const res = await fetch("/chatbot", {
        method: "POST",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            question: question
        })
    });

    const data = await res.json();

    appendMessage(data.answer ?? "No response", "bot");
}

});

</script>
@endonce

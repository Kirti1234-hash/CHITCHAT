let typing = false;
let typingTimeout;

// Handle input event for typing status
document.querySelector('input[name="message"]').addEventListener('input', () => {
    if (!typing) {
        typing = true;
        updateTyping(true);
    }

    clearTimeout(typingTimeout);
    typingTimeout = setTimeout(() => {
        typing = false;
        updateTyping(false);
    }, 1000);
});

// Send typing status to server
function updateTyping(isTyping) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'typing.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('typing=' + (isTyping ? 1 : 0));
}

// Check if someone else is typing
function checkTypingStatus() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'typing_status.txt?cache=' + new Date().getTime(), true);
    xhr.onload = function () {
        const name = xhr.responseText.trim();
        const myName = document.body.getAttribute('data-username'); // we’ll set this in PHP

        if (name && name !== myName) {
            document.getElementById('typingStatus').innerText = name + " is typing...";
        } else {
            document.getElementById('typingStatus').innerText = '';
        }
    };
    xhr.send();
}

// Load chat messages
function loadMessages() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'loadMessages.php', true);
    xhr.onload = function () {
        document.getElementById('chathist').innerHTML = xhr.responseText;
        document.getElementById('chathist').scrollTop = document.getElementById('chathist').scrollHeight;
    };
    xhr.send();
}

// Auto-refresh messages and typing status every second
setInterval(loadMessages, 1000);
setInterval(checkTypingStatus, 1000);

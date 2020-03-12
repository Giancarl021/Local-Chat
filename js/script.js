let lastData, lastUpdate;
const updateTimeRate = 10;
const SERVER_IP = window.location.href.replace(/\?.*/g, '');

async function ajax(url, parameters = '') {
    return new Promise(resolve => {
        const request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                resolve(this.responseText);
            }
        };

        request.open('POST', `${url}?${parameters}`, true);
        request.send();
    });
}

async function digitFx(element, text, milliseconds, start = 0) {
    if (start) {
        await delay(start);
    }
    if (text.length === 0) return;
    element.innerHTML += text.charAt(0).replace(' ', '&nbsp');
    await delay(milliseconds);
    digitFx(element, text.substr(1), milliseconds).catch(console.log);
}

async function delay(milliseconds) {
    return new Promise(resolve => setTimeout(resolve, milliseconds));
}

function sendMessage() {
    const input = document.getElementById('message-field');
    const message = input.value;
    if(!message.length) return;
    const nickname = document.getElementById('nickname').value || 'Anônimo';
    ajax(`${SERVER_IP}/php/message.php`, `author=${nickname}&message=${message}`);
    input.value = '';
}

async function getData(timestamp) {
    const data = JSON.parse(await ajax(`${SERVER_IP}/php/update.php`));

    const diff = lastData ? data.filter(message => {
        for(const item of lastData) {
            if(item.timestamp === message.timestamp && item.author === message.author) return false;
        }
        return true;
    }) : data;
    appendMessages(diff);

    lastData = data;
    lastUpdate = timestamp;

    function appendMessages(messages) {
        const panel = document.getElementById('chat-panel');
        for(const message of messages) {
            panel.insertAdjacentHTML('beforeend', `<div class="message"><span>${message.author}</span><div class="message-text">${message.message}</div></div>`);
        }
        panel.scrollTo(0, panel.scrollHeight);
    }
}

async function updateListener() {
    const timestamp = await ajax(`${SERVER_IP}/php/status.php`);
    if (lastUpdate !== timestamp) await getData(timestamp);
    setTimeout(updateListener, updateTimeRate);
}

function init() {
    const digitDivs = document.getElementsByClassName('digit-text');
    for (const div of digitDivs) {
        digitFx(div, div.getAttribute('data-text'), div.getAttribute('data-milliseconds'), div.getAttribute('data-start')).catch(console.log);
    }
    updateListener();
}

document.addEventListener('DOMContentLoaded', init);
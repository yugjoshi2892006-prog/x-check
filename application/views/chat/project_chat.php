<style>
    .xc-chat-wrapper {
        background: #f4f7f8;
        padding: 24px;
        min-height: 100%;
    }

    .xc-chat-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e4e6ea;
        box-shadow: 0 2px 10px rgba(15, 180, 160, 0.06);
        overflow: hidden;
    }

    .xc-chat-header {
        background: linear-gradient(135deg, #0fb4a0, #0d9c8a);
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        position: relative;
        overflow: hidden;
    }

    .xc-chat-header::after {
        content: '';
        position: absolute;
        right: -40px;
        top: -60px;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.06);
        pointer-events: none;
    }

    .xc-chat-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
        z-index: 1;
    }

    .xc-chat-header .xc-chat-icon {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        background: rgba(255, 255, 255, 0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        position: relative;
    }

    .xc-chat-header .xc-chat-icon svg {
        width: 20px;
        height: 20px;
        stroke: #ffffff;
    }

    .xc-live-dot {
        position: absolute;
        bottom: -2px;
        right: -2px;
        width: 11px;
        height: 11px;
        border-radius: 50%;
        background: #2ee6a8;
        border: 2px solid #0d9c8a;
    }

    .xc-chat-header h4 {
        color: #ffffff;
        font-weight: 700;
        font-size: 18px;
        margin: 0;
        line-height: 1.2;
    }

    .xc-chat-header-sub {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 2px;
    }

    .xc-chat-header-sub span {
        color: rgba(255, 255, 255, 0.85);
        font-size: 12.5px;
        font-weight: 500;
    }

    .xc-chat-header-sub .xc-pulse-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #2ee6a8;
        box-shadow: 0 0 0 0 rgba(46, 230, 168, 0.6);
        animation: xc-pulse 1.8s infinite;
        flex-shrink: 0;
    }

    @keyframes xc-pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(46, 230, 168, 0.55);
        }

        70% {
            box-shadow: 0 0 0 6px rgba(46, 230, 168, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(46, 230, 168, 0);
        }
    }

    .xc-chat-header-right {
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .xc-icon-btn {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: rgba(255, 255, 255, 0.14);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.15s;
    }

    .xc-icon-btn:hover {
        background: rgba(255, 255, 255, 0.24);
    }

    .xc-icon-btn svg {
        width: 16px;
        height: 16px;
        stroke: #ffffff;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .xc-chat-body {
        padding: 20px 24px 16px;
    }

    #chat-box {
        height: 420px;
        overflow-y: auto;
        background:
            radial-gradient(circle at top right, rgba(15, 180, 160, 0.04), transparent 60%),
            #f8fafa;
        border: 1px solid #e4e6ea;
        border-radius: 12px;
        padding: 18px;
        font-size: 14px;
        color: #1a1a2e;
        scroll-behavior: smooth;
        line-height: 1.7;
    }

    #chat-box::-webkit-scrollbar {
        width: 6px;
    }

    #chat-box::-webkit-scrollbar-thumb {
        background: #cfd4d8;
        border-radius: 10px;
    }

    #chat-box::-webkit-scrollbar-track {
        background: transparent;
    }

    /* Generic message line styling - matches existing "name : message" markup from load_messages */
    #chat-box b,
    #chat-box strong {
        color: #0fb4a0;
        font-weight: 700;
    }

    .xc-scroll-bottom-btn {
        position: absolute;
        right: 36px;
        bottom: 90px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #0fb4a0;
        border: none;
        box-shadow: 0 4px 12px rgba(15, 180, 160, 0.35);
        display: none;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 2;
    }

    .xc-scroll-bottom-btn.xc-show {
        display: flex;
    }

    .xc-scroll-bottom-btn svg {
        width: 16px;
        height: 16px;
        stroke: #ffffff;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .xc-chat-input-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 18px;
    }

    .xc-input-wrap {
        flex: 1;
        position: relative;
    }

    .xc-chat-input-row input[type="text"] {
        width: 100%;
        height: 46px;
        border: 1px solid #e4e6ea;
        border-radius: 10px;
        padding: 0 16px;
        font-size: 14px;
        color: #1a1a2e;
        background: #ffffff;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .xc-chat-input-row input[type="text"]:focus {
        border-color: #0fb4a0;
        box-shadow: 0 0 0 3px rgba(15, 180, 160, 0.12);
    }

    .xc-chat-input-row input[type="text"]::placeholder {
        color: #9aa3a9;
    }

    .xc-typing-hint {
        font-size: 11.5px;
        color: #9aa3a9;
        margin-top: 8px;
        padding-left: 2px;
        height: 14px;
    }

    .xc-send-btn {
        height: 46px;
        min-width: 110px;
        border: none;
        border-radius: 10px;
        background: #0fb4a0;
        color: #ffffff;
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        transition: background 0.2s, transform 0.1s;
    }

    .xc-send-btn:hover {
        background: #0d9c8a;
    }

    .xc-send-btn:active {
        transform: scale(0.97);
    }

    .xc-send-btn svg {
        width: 16px;
        height: 16px;
        fill: #ffffff;
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <div class="xc-chat-wrapper">
            <div class="xc-chat-card">

                <div class="xc-chat-header">
                    <div class="xc-chat-header-left">
                        <div class="xc-chat-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                </path>
                            </svg>
                            <span class="xc-live-dot"></span>
                        </div>
                        <div>
                            <h4><?= $project->project_name ?></h4>
                            <div class="xc-chat-header-sub">
                                <span class="xc-pulse-dot"></span>
                                <span>Live project chat</span>
                            </div>
                        </div>
                    </div>
                    <div class="xc-chat-header-right">
                        <button type="button" class="xc-icon-btn" title="Refresh" onclick="loadMessages()">
                            <svg viewBox="0 0 24 24">
                                <polyline points="23 4 23 10 17 10"></polyline>
                                <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="xc-chat-body">

                    <div style="position: relative;">

                        <div id="chat-box"></div>

                        <button type="button" class="xc-scroll-bottom-btn" id="xc-scroll-bottom"
                            title="Scroll to latest">
                            <svg viewBox="0 0 24 24">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>

                    </div>

                    <div class="xc-chat-input-row">

                        <div class="xc-input-wrap">
                            <input type="text" id="message" placeholder="Type message">
                        </div>

                        <button class="xc-send-btn" id="xc-send-btn" onclick="sendMessage()">
                            <span class="xc-send-btn-label">Send</span>
                            <svg viewBox="0 0 24 24">
                                <path d="M2 21l21-9L2 3v7l15 2-15 2z"></path>
                            </svg>
                        </button>

                    </div>

                    <div class="xc-typing-hint">Press Enter to send</div>

                </div>

            </div>
        </div>
    </div>
</div>

<script>

    var xcUserScrolledUp = false;

    function loadMessages() {

        var box = document.getElementById('chat-box');
        var wasNearBottom = box
            ? (box.scrollHeight - box.scrollTop - box.clientHeight < 60)
            : true;

        $("#chat-box").load(
            "<?= site_url('chat/load_messages/' . $project->id) ?>",
            function () {

                if (wasNearBottom && !xcUserScrolledUp) {
                    box.scrollTop = box.scrollHeight;
                }

                xcUpdateScrollButton();
            }
        );
    }

    loadMessages();

    setInterval(function () {

        loadMessages();

    }, 3000);

    function sendMessage() {
        var msg = $("#message").val();

        if (msg == "") {
            return;
        }

        var $btn = $("#xc-send-btn");
        $btn.prop('disabled', true).css('opacity', '0.7');

        $.ajax({

            url: "<?= site_url('chat/send_message') ?>",

            type: "POST",

            data: {
                project_id: <?= $project->id ?>,
                message: msg
            },

            success: function (response) {
                console.log(response);

                $("#message").val('');

                xcUserScrolledUp = false;

                loadMessages();
            },

            error: function (xhr) {
                console.log(xhr.responseText);
            },

            complete: function () {
                $btn.prop('disabled', false).css('opacity', '1');
                $("#message").focus();
            }

        });
    }

    // Allow pressing Enter to send, without touching existing send logic
    $(document).on('keypress', '#message', function (e) {
        if (e.which === 13) {
            sendMessage();
        }
    });

    // Scroll-to-bottom floating button
    function xcUpdateScrollButton() {

        var box = document.getElementById('chat-box');
        var btn = document.getElementById('xc-scroll-bottom');

        if (!box || !btn) {
            return;
        }

        var nearBottom = (box.scrollHeight - box.scrollTop - box.clientHeight < 60);

        if (nearBottom) {
            btn.classList.remove('xc-show');
            xcUserScrolledUp = false;
        } else {
            btn.classList.add('xc-show');
        }
    }

    $(document).on('scroll', '#chat-box', function () {

        var box = document.getElementById('chat-box');
        var nearBottom = (box.scrollHeight - box.scrollTop - box.clientHeight < 60);

        xcUserScrolledUp = !nearBottom;

        xcUpdateScrollButton();
    });

    $(document).on('click', '#xc-scroll-bottom', function () {

        var box = document.getElementById('chat-box');

        box.scrollTop = box.scrollHeight;

        xcUserScrolledUp = false;

        xcUpdateScrollButton();
    });

</script>
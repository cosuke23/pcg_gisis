<aside id="sidebar" class="sidebar">

    <!-- Logo -->
    <div class="sidebar-top">
        <img src="{{ \App\Support\ClaudePane::logo() }}" class="sidebar-logo" alt="PCG">

        <div class="sidebar-title">
            <h5>PCG</h5>
            <small>MEPIOS</small>
        </div>
    </div>

    <!-- Menu -->
    <ul class="sidebar-menu">

        <!-- Floating Chat Button -->
        <button id="chatButton" class="btn btn-primary rounded-circle shadow"
            style="position:fixed;bottom:20px;right:20px;width:60px;height:60px;z-index:9999;">
            💬
        </button>

        <li>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="menu-title">
            REPORTING
        </li>

        <li>
            <a href="{{ route('contact_points.index') }}">
                <i class="fas fa-address-book"></i>
                <span>Contact Points</span>
            </a>
        </li>

        <li>
            <a href="{{ route('dump_sites.index') }}">
                <i class="fas fa-map-location-dot"></i>
                <span>Dump Sites</span>
            </a>
        </li>

        <li>
            <a href="{{ route('annual_activities.index') }}">
                <i class="fas fa-ship"></i>
                <span>Annual Activities</span>
            </a>
        </li>

        <li>
            <a href="{{ route('oil_spill_incidents.index') }}">
                <i class="fas fa-water"></i>
                <span>Oil Spill Incidents</span>
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fas fa-industry"></i>
                <span>CO₂ Storage</span>
            </a>
        </li>

        <li>
            <a href="{{ route('gis.dashboard') }}">
                <i class="fas fa-earth-asia"></i>
                <span>GIS Dashboard</span>
            </a>
        </li>

        <li class="menu-title">
            ADMINISTRATION
        </li>

        <li>
            <a href="{{ route('reports.index') }}">
                <i class="fas fa-chart-line"></i>
                <span>Reports</span>
            </a>
        </li>

        <li>
            <a href="{{ route('users.index') }}">
                <i class="fas fa-users-cog"></i>
                <span>User Management</span>
            </a>
        </li>

    </ul>

    <!-- Footer -->
    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="logout-btn">
                <i class="fas fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>

</aside>

<!-- Chat Box -->
<div id="chatBox" class="card shadow"
    style="display:none;position:fixed;bottom:90px;right:20px;width:400px;height:550px;z-index:9999;">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <span>MEPPY AI Assistant</span>

        <button type="button" class="btn btn-sm btn-light" id="closeChat">
            &times;
        </button>
    </div>

    <div class="card-body" id="chatMessages" style="overflow-y:auto;height:400px;">
        <p class="text-muted">Hello, I'm MEPPY! How can I help you today?</p>
    </div>

    <div class="card-footer">
        <div class="input-group">
            <input type="text" id="message" class="form-control" placeholder="Ask anything...">

            <button class="btn btn-success" id="sendMessage">
                Send
            </button>
        </div>
    </div>

</div>

<!-- jQuery (include only if not already loaded) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {

        // Open Chat
        $('#chatButton').on('click', function() {
            $('#chatBox').toggle();
        });

        // Close Chat
        $('#closeChat').on('click', function() {
            $('#chatBox').hide();
        });

        // Function to send message
        function sendMessage() {

            let message = $('#message').val().trim();

            if (message === '') {
                return;
            }

            // User Message
            $('#chatMessages').append(`
            <div class="d-flex justify-content-end mb-3">
                <div class="bg-primary text-white rounded-3 shadow-sm p-3"
                     style="max-width:75%; line-height:1.5;">
                    <strong>You</strong><br><br>
                    ${message}
                </div>
            </div>
        `);

            $('#message').val('');

            $('#chatMessages').scrollTop($('#chatMessages')[0].scrollHeight);

            // Optional typing indicator
            $('#chatMessages').append(`
            <div id="typing" class="d-flex justify-content-start mb-3">
                <div class="bg-light border rounded-3 shadow-sm p-3"
                     style="max-width:85%; line-height:1.5;">
                    🤖 <strong>MEPPY AI</strong><br><br>
                    <em>Typing...</em>
                </div>
            </div>
        `);

            $('#chatMessages').scrollTop($('#chatMessages')[0].scrollHeight);

            $.ajax({

                url: '/chatbot',

                type: 'POST',

                data: {
                    message: message,
                    _token: '{{ csrf_token() }}'
                },

                success: function(res) {

                    $('#typing').remove();

                    $('#chatMessages').append(`
                    <div class="d-flex justify-content-start mb-3">
                        <div class="bg-light border rounded-3 shadow-sm p-3"
                             style="max-width:85%; line-height:1.5; white-space:normal;">
                            🤖 <strong>MEPPY AI</strong><br><br>
                            ${res.answer}
                        </div>
                    </div>
                `);

                    $('#chatMessages').scrollTop($('#chatMessages')[0].scrollHeight);

                },

                error: function(xhr) {

                    $('#typing').remove();

                    $('#chatMessages').append(`
                    <div class="d-flex justify-content-start mb-3">
                        <div class="bg-danger text-white rounded-3 shadow-sm p-3"
                             style="max-width:85%; line-height:1.5;">
                            Unable to contact the AI assistant.
                        </div>
                    </div>
                `);

                    console.log(xhr);

                }

            });

        }

        // Send button
        $('#sendMessage').on('click', function() {
            sendMessage();
        });

        // Enter key
        $('#message').on('keypress', function(e) {

            if (e.which === 13) {

                e.preventDefault();

                sendMessage();

            }

        });

    });
</script>
